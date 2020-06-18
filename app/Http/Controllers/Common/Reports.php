<?php

namespace App\Http\Controllers\Common;

use App\Abstracts\Http\Controller;
use App\Http\Requests\Common\Report as Request;
use App\Jobs\Common\CreateReport;
use App\Jobs\Common\DeleteReport;
use App\Jobs\Common\UpdateReport;
use App\Models\Banking\Transaction;
use App\Models\Common\Report;
use App\Utilities\Reports as Utility;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use App\KoolReports\MyReport;
use DB;


class Reports extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $totals = $icons = $categories = [];

        $reports = Report::orderBy('name')->get();

        foreach ($reports as $report) {
            if (!Utility::canRead($report->class)) {
                continue;
            }

            $class = Utility::getClassInstance($report, false);

            if (empty($class)) {
                continue;
            }

            $ttl = 3600 * 6; // 6 hours

            $totals[$report->id] = Cache::remember('reports.totals.' . $report->id, $ttl, function () use ($class) {
                return $class->getGrandTotal();
            });

            $icons[$report->id] = $class->getIcon();
            $categories[$class->getCategory()][] = $report;
        }

//        $report = new MyReport;
//        $report->run();
//        return view("common.reports.index");
        return view('common.reports.index', compact('categories', 'totals', 'icons','report'));
    }

    /**
     * Show the form for viewing the specified resource.
     *
     * @param  Report $report
     * @return Response
     */
    public function show(Report $report)
    {
        if (!Utility::canRead($report->class)) {
            abort(403);
        }

        $class = Utility::getClassInstance($report);

        // Update cache
        Cache::put('reports.totals.' . $report->id, $class->getGrandTotal());

        return $class->show();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $classes = Utility::getClasses();

        return view('common.reports.create', compact('classes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $response = $this->ajaxDispatch(new CreateReport($request));

        if ($response['success']) {
            $response['redirect'] = route('reports.index');

            $message = trans('messages.success.added', ['type' => trans_choice('general.reports', 1)]);

            flash($message)->success();
        } else {
            $response['redirect'] = route('reports.create');

            $message = $response['message'];

            flash($message)->error();
        }

        return response()->json($response);
    }

    /**
     * Duplicate the specified resource.
     *
     * @param  Report  $report
     *
     * @return Response
     */
    public function duplicate(Report $report)
    {
        $clone = $report->duplicate();

        $message = trans('messages.success.duplicated', ['type' => trans_choice('general.reports', 1)]);

        flash($message)->success();

        return redirect()->route('reports.edit', $clone->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Report  $report
     *
     * @return Response
     */
    public function edit(Report $report)
    {
        $classes = Utility::getClasses();

        $class = Utility::getClassInstance($report, false);

        return view('common.reports.edit', compact('report', 'classes', 'class'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Report $report
     * @param  $request
     * @return Response
     */
    public function update(Report $report, Request $request)
    {
        $response = $this->ajaxDispatch(new UpdateReport($report, $request));

        if ($response['success']) {
            $response['redirect'] = route('reports.index');

            $message = trans('messages.success.updated', ['type' => $report->name]);

            flash($message)->success();
        } else {
            $response['redirect'] = route('reports.edit', $report->id);

            $message = $response['message'];

            flash($message)->error();
        }

        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Report $report
     *
     * @return Response
     */
    public function destroy(Report $report)
    {
        $response = $this->ajaxDispatch(new DeleteReport($report));

        $response['redirect'] = route('reports.index');

        if ($response['success']) {
            $message = trans('messages.success.deleted', ['type' => $report->name]);

            flash($message)->success();
        } else {
            $message = $response['message'];

            flash($message)->error();
        }

        return response()->json($response);
    }

    /**
     * Print the report.
     *
     * @param  Report $report
     * @return Response
     */
    public function print(Report $report)
    {
        if (!Utility::canRead($report->class)) {
            abort(403);
        }

        return Utility::getClassInstance($report)->print();
    }

    /**
     * Export the report.
     *
     * @param  Report $report
     * @return Response
     */
    public function export(Report $report)
    {
        if (!Utility::canRead($report->class)) {
            abort(403);
        }

        return Utility::getClassInstance($report)->export();
    }

    /**
     * Get fields of the specified resource.
     *
     * @return Response
     */
    public function fields()
    {
        $class = request('class');

        if (!class_exists($class)) {
            return response()->json([
                'success' => false,
                'error' => true,
                'message' => 'Class does not exist',
                'html' => '',
            ]);
        }

        $fields = (new $class())->getFields();

        $html = view('partials.reports.fields', compact('fields'))->render();

        return response()->json([
            'success' => true,
            'error' => false,
            'message' => '',
            'html' => $html,
        ]);
    }

    /**
     * Clear the cache of the resource.
     *
     * @return Response
     */
    public function clear()
    {
        Report::all()->each(function ($report) {
            if (!Utility::canRead($report->class)) {
                return;
            }

            Cache::put('reports.totals.' . $report->id, Utility::getClassInstance($report)->getGrandTotal());
        });

        return redirect()->back();
    }

    /**
     * Implement By Nishan
     */
    public function incomeByCustomer($startDate, $endDate){


        $transactions = DB::table('transactions')
            ->select('contact_id', DB::raw('SUM(amount) as Amount'))
            ->where('type', '=', 'income')
            ->whereBetween('created_at', array($startDate, $endDate))
            ->groupBy('contact_id');

        $report = DB::table('contacts')
            ->joinSub($transactions, 'transactions', function ($join) {
                $join->on('contacts.id', '=', 'transactions.contact_id');
            })->get();

        echo "<pre>";
        print_r($report);
        echo "</pre>";
//        //return $revenue;
    }
    public function purchaseByVendor($startDate, $endDate){
        $transactions = DB::table('transactions')
            ->select('contact_id', DB::raw('SUM(amount) as Amount'))
            ->where('type', '=', 'expense')
            ->whereBetween('created_at', array($startDate, $endDate))
            ->groupBy('contact_id');

        $report = DB::table('contacts')
            ->joinSub($transactions, 'transactions', function ($join) {
                $join->on('contacts.id', '=', 'transactions.contact_id');
            })->get();

        echo "<pre>";
        print_r($report);
        echo "</pre>";
    }
    public function profitAndLoss($startDate, $endDate){
        $result = array();
        $revenue = Transaction::income()
            ->isNotTransfer()
            ->monthly($startDate,$endDate)
            ->sum('amount');
        $expenseByVendor = Transaction::expense()
            ->isNotTransfer()
            ->monthly($startDate,$endDate)
            ->where('contact_id', '!=', null)
            ->sum('amount');
        $OtherExpense = Transaction::expense()
            ->isNotTransfer()
            ->monthly($startDate,$endDate)
            ->where('contact_id', '=', null)
            ->sum('amount');

        $totalExpense = $expenseByVendor + $OtherExpense;
        $profit = $revenue - $totalExpense;

        $result['revenue'] = $revenue;
        $result['expenseByVendor'] = $expenseByVendor;
        $result['OtherExpense'] = $OtherExpense;
        $result['profit'] = $profit;

       // return $profit;
        echo "<pre>";
        print_r($result);
        echo "</pre>";

    }



}
