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
     * Fetch Company Id
     */
    public function companyId(){
        $companyId = session('company_id');
       return $companyId;
    }
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
    public function MargeDataByCustomer($paid, $partial,$unPaid ){

        $allContactId = array();
        $PaidContactId = array();
        $PaidContactData = array();
        $partialPaidContactId = array();
        $partialContactData = array();
        $unPaidContactId = array();
        $unPaidContactData = array();
        $result = array();
        foreach ($paid as $uIncome){
            $contactId = $uIncome->contact_id;
            $contactName = $uIncome->contact_name;
            array_push($allContactId, $contactId.",".$contactName);
            array_push($PaidContactId, $contactId);
            $PaidContactData[$contactId] = $uIncome->Paid;
        }
        foreach ($partial as $uIncome){
            $contactId = $uIncome->contact_id;
            $contactName = $uIncome->contact_name;
            array_push($allContactId, $contactId.",".$contactName);
            array_push($partialPaidContactId, $contactId);
            $partialContactData[$contactId] = $uIncome->PartialAmount;
        }
        foreach ($unPaid as $uIncome){
            $contactId = $uIncome->contact_id;
            $contactName = $uIncome->contact_name;
            array_push($allContactId, $contactId.",".$contactName);
            array_push($unPaidContactId, $contactId);
            $unPaidContactData[$contactId] = $uIncome->unPaid;
        }
        $allContactId = array_unique($allContactId);
        // dd($allContactId);
        foreach ($allContactId as $value){
            $temp1 = array();
            $Contact = explode(",",$value);
            $contactId = $Contact['0'];
            $temp1['contact_name'] = $Contact['1'];
            if(in_array($contactId, $PaidContactId)){
                $temp1['Paid'] = $PaidContactData[$contactId];
            }else{
                $temp1['Paid'] = 0;
            }
            if(in_array($contactId, $partialPaidContactId)){
                $temp1['partialPaid'] = $partialContactData[$contactId];
            }else{
                $temp1['partialPaid'] =  0;
            }
            if(in_array($contactId, $unPaidContactId)){
                $temp1['unPaid'] = $unPaidContactData[$contactId];
            }else{
                $temp1['unPaid'] = 0;
            }
            array_push($result,$temp1);
        }
        return $result;
    }

    public function incomeByCustomer($startDate, $endDate){


        $paidIncome = DB::table('invoices')
            ->select('contact_name','contact_id', DB::raw('SUM(amount) as Paid'))
            ->where('status', '=', 'paid')
            ->where('company_id', '=', $this->companyId())
            ->whereBetween('created_at', array($startDate, $endDate))
            ->groupBy('contact_id')
            ->get();
        $transactions = DB::table('transactions')
            ->select('document_id','contact_id', DB::raw('SUM(amount) as PartialAmount'))
            ->where('type', '=', 'income')
            ->where('company_id', '=', $this->companyId())
            ->where('deleted_at', '=', null)
            ->whereBetween('created_at', array($startDate, $endDate))
            ->groupBy('document_id');

        $partialPaidIncome = DB::table('invoices')
            ->joinSub($transactions, 'transactions', function ($join) {
                $join->on('invoices.id', '=', 'transactions.document_id');
            })
            ->where('invoices.status', '=', 'partial')
            ->select('invoices.contact_id','invoices.contact_name', 'transactions.PartialAmount')
            ->get();
        $unpaidIncome = DB::table('invoices')
            ->select('contact_name','contact_id', DB::raw('SUM(amount) as unPaid'))
            ->where('status', '=', 'sent')
            ->where('company_id', '=', $this->companyId())
            ->whereBetween('created_at', array($startDate, $endDate))
            ->groupBy('contact_id')
            ->get();
        $result = $this->MargeDataByCustomer($paidIncome,$partialPaidIncome,$unpaidIncome);

//        echo "<pre>";
//        print_r($result);
//        echo "</pre>";
//           return $this->companyId();
        return view('reports.income_customer',compact('result','startDate','endDate'));
    }
    public function purchaseByVendor($startDate, $endDate){
        $paidIncome = DB::table('bills')
            ->select('contact_name','contact_id', DB::raw('SUM(amount) as Paid'))
            ->where('status', '=', 'paid')
            ->where('company_id', '=', $this->companyId())
            ->whereBetween('created_at', array($startDate, $endDate))
            ->groupBy('contact_id')
            ->get();
        $transactions = DB::table('transactions')
            ->select('document_id','contact_id', DB::raw('SUM(amount) as PartialAmount'))
            ->where('type', '=', 'expense')
            ->where('company_id', '=', $this->companyId())
            ->where('deleted_at', '=', null)
            ->whereBetween('created_at', array($startDate, $endDate))
            ->groupBy('document_id');

        $partialPaidIncome = DB::table('bills')
            ->joinSub($transactions, 'transactions', function ($join) {
                $join->on('bills.id', '=', 'transactions.document_id');
            })
            ->where('bills.status', '=', 'partial')
            ->select('bills.contact_id','bills.contact_name', 'transactions.PartialAmount')
            ->get();
        $unpaidIncome = DB::table('bills')
            ->select('contact_name','contact_id', DB::raw('SUM(amount) as unPaid'))
            ->where('status', '=', 'received')
            ->where('company_id', '=', $this->companyId())
            ->whereBetween('created_at', array($startDate, $endDate))
            ->groupBy('contact_id')
            ->get();
        $result = $this->MargeDataByCustomer($paidIncome,$partialPaidIncome,$unpaidIncome);

//        echo "<pre>";
//        print_r($result);
//        echo "</pre>";
        return view('reports.purchase_vendor',compact('result','startDate','endDate'));
    }
    public function profitAndLoss($startDate, $endDate,$reportType){
        if($reportType == 2) {
            $revenue = Transaction::income()
                ->isNotTransfer()
                ->monthly($startDate,$endDate)
                ->where('company_id', '=', $this->companyId())
                ->where('deleted_at', '=', null)
                ->sum('amount');
            $expenseByVendor = Transaction::expense()
                ->isNotTransfer()
                ->monthly($startDate,$endDate)
                ->where('company_id', '=', $this->companyId())
                ->where('deleted_at', '=', null)
                ->where('contact_id', '!=', null)
                ->sum('amount');
        }else{
            $paid = Transaction::income()
                ->isNotTransfer()
                ->monthly($startDate,$endDate)
                ->where('company_id', '=', $this->companyId())
                ->where('deleted_at', '=', null)
                ->sum('amount');
            $sent = DB::table('invoices')
                ->where('status', '=', 'sent')
                ->where('company_id', '=', $this->companyId())
                ->whereBetween('created_at', array($startDate, $endDate))
                ->sum('amount');

            $revenue = $paid + $sent;

            $paidBill = Transaction::expense()
                ->isNotTransfer()
                ->monthly($startDate,$endDate)
                ->where('company_id', '=', $this->companyId())
                ->where('deleted_at', '=', null)
                ->where('contact_id', '!=', null)
                ->sum('amount');

            $received = DB::table('bills')
                ->where('status', '=', 'received')
                ->where('company_id', '=', $this->companyId())
                ->whereBetween('created_at', array($startDate, $endDate))
                ->sum('amount');
            $expenseByVendor  = $paidBill + $received;


        }
        $result = array();

        $OtherExpense = Transaction::expense()
            ->isNotTransfer()
            ->monthly($startDate,$endDate)
            ->where('company_id', '=', $this->companyId())
            ->where('deleted_at', '=', null)
            ->where('contact_id', '=', null)
            ->sum('amount');

        $totalExpense = $expenseByVendor + $OtherExpense;
        $profit = $revenue - $totalExpense;
        $startDate = strtotime($startDate);
        $endDate = strtotime($endDate);
        $result['income'] = $revenue;
        $result['costOfGoodsSold'] = $expenseByVendor;
        $result['operatingExpense'] = $OtherExpense;
        $result['netProfit'] = $profit;
        $result['startDate'] = $startDate;
        $result['endDate'] = $endDate;
//        echo "<pre>";
//        print_r($result);
//        echo "</pre>";
        return view('reports.profit_loss',compact('result','reportType'));

    }

    public function groupBySum($invoice_item_taxes){
        $taxId = array();
        $report = array();
        foreach ($invoice_item_taxes as $data){
            if(in_array($data->tax_id, $taxId)){
                $taxAmount = $report[$data->tax_id]['taxAmount'];
                $Sales_Subject_to_Tax = $report[$data->tax_id]['Subject_to_Tax'];
                $taxAmount = $taxAmount + $data->taxAmount;
                $Sales_Subject_to_Tax = $Sales_Subject_to_Tax + $data->price;
                $report[$data->tax_id]['taxAmount'] = $taxAmount;
                $report[$data->tax_id]['Subject_to_Tax'] = $Sales_Subject_to_Tax;

            }else{
                array_push($taxId, $data->tax_id);
                $temp = array();
                $temp['TaxName'] = $data->name;
                $temp['taxAmount'] = $data->taxAmount;
                $temp['Subject_to_Tax'] = $data->price;
                $temp['TaxName'] = $data->name;
                $report[$data->tax_id] = $temp;
            }

        }
        return $report;
    }

    public function salesTaxReport($startDate,$endDate, $reportType){
        if($reportType == 2) {
            $invoice_item_taxes = DB::table('invoice_item_taxes')
                ->Join('invoice_items', 'invoice_item_taxes.invoice_item_id', '=', 'invoice_items.id')
                ->Join('invoices', 'invoice_item_taxes.invoice_id', '=', 'invoices.id')
                ->select('invoice_item_taxes.tax_id', 'invoice_item_taxes.name', 'invoice_item_taxes.amount as taxAmount', 'invoice_items.price')
                ->where('invoice_item_taxes.company_id', '=', $this->companyId())
                ->where('invoice_item_taxes.deleted_at', '=', null)
                ->where('invoices.status', '=', 'paid')
                ->whereBetween('invoice_item_taxes.created_at', array($startDate, $endDate))
                ->get();
        }else{
            $invoice_item_taxes = DB::table('invoice_item_taxes')
                ->Join('invoice_items', 'invoice_item_taxes.invoice_item_id', '=', 'invoice_items.id')
                ->select('invoice_item_taxes.tax_id', 'invoice_item_taxes.name', 'invoice_item_taxes.amount as taxAmount', 'invoice_items.price')
                ->where('invoice_item_taxes.company_id', '=', $this->companyId())
                ->where('invoice_item_taxes.deleted_at', '=', null)
                ->whereBetween('invoice_item_taxes.created_at', array($startDate, $endDate))
                ->get();
        }

        $salesTax = $this->groupBySum($invoice_item_taxes);

        if($reportType == 2) {
            $bill_item_taxes = DB::table('bill_item_taxes')
                ->Join('bill_items', 'bill_item_taxes.bill_item_id', '=', 'bill_items.id')
                ->Join('bills', 'bill_item_taxes.bill_id', '=', 'bills.id')
                ->select('bill_item_taxes.tax_id','bill_item_taxes.name','bill_item_taxes.amount as taxAmount', 'bill_items.price' )
                ->where('bill_item_taxes.company_id', '=', $this->companyId())
                ->where('bill_item_taxes.deleted_at', '=', null)
                ->where('bills.status', '=', 'paid')
                ->whereBetween('bill_item_taxes.created_at', array($startDate, $endDate))
                ->get();

        }else{
            $bill_item_taxes = DB::table('bill_item_taxes')
                ->Join('bill_items', 'bill_item_taxes.bill_item_id', '=', 'bill_items.id')
                ->select('bill_item_taxes.tax_id','bill_item_taxes.name','bill_item_taxes.amount as taxAmount', 'bill_items.price' )
                ->where('bill_item_taxes.company_id', '=', $this->companyId())
                ->where('bill_item_taxes.deleted_at', '=', null)
                ->whereBetween('bill_item_taxes.created_at', array($startDate, $endDate))
                ->get();
        }

         $billTax = $this->groupBySum($bill_item_taxes);

          $report = array();
          $SaleCount = count($salesTax);
          $BillCount = count($billTax);
          if( $SaleCount >= 1 || $BillCount >= 1) {
              if ($SaleCount >= $BillCount) {
                  $key = array_keys($salesTax);
              } else {
                  $key = array_keys($salesTax);
              }
              foreach ($key as $val){
                  $temp = array();
                  $taxName = '';
                  if(array_key_exists($val, $salesTax)){
                      $taxName = $salesTax[$val]['TaxName'];
                      $temp['Sales'] = $salesTax[$val];
                  }
                  if(array_key_exists($val, $billTax)){
                      $taxName = $billTax[$val]['TaxName'];
                      $temp['Bills'] = $billTax[$val];
                  }
                  if($temp != null){
                      $report[$taxName] = $temp;
                  }
              }

          }

        $startDate = strtotime($startDate);
        $endDate = strtotime($endDate);
//        echo "<pre>";
//        print_r($report);
//        echo "</pre>";
        return view('reports.sales_tax',compact('report','startDate','endDate','reportType'));
    }

    /**
     * End Implement By Nishan
     */


   

}
