<?php

namespace App\Http\Controllers\Settings;

use App\Abstracts\Http\Controller;
use App\Http\Requests\Setting\Category as Request;
use App\Jobs\Setting\CreateCategory;
use App\Jobs\Setting\DeleteCategory;
use App\Jobs\Setting\UpdateCategory;
use App\Models\Setting\Category;
use App\Business;
use App\BusinessAccount;
use App\ChartAccount;
use Illuminate\Support\Facades\DB;


class Categories extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$categories = Category::collect();
        $categories =Category::where('type', "item")->get();
        $categories1 =Category::where('type', "expense")->get();
        $categories2 =Category::where('type', "liability")->get();
        $categories3 =Category::where('type', "income")->get();
        $categories4 =Category::where('type', "equity")->get();

        $business=Business::all();
       // dd($categories);
        //$categories = Category::all();
       // $categories =Category::where('type', "income")->get();

        $transfer_id = Category::transfer();

        $types = collect([
            'expense' => trans_choice('general.expenses', 1),
            'income' => trans_choice('general.incomes', 1),
            'item' => trans_choice('general.items', 1),
            'equity' => trans_choice('general.equity', 1),
            'liability' => trans_choice('general.liability', 1),
        ]);

        return view('settings.categories.index', compact('categories','categories1','categories2','categories3','categories4', 'types', 'transfer_id','business'));
    }

    /**
     * Show the form for viewing the specified resource.
     *
     * @return Response
     */
    public function show()
    {
        return redirect()->route('categories.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $types = [
            'expense' => trans_choice('general.expenses', 1),
            'income'  =>  trans_choice('general.incomes', 1),
            'item'    =>    trans_choice('general.items', 1),
            'equity'  =>  trans_choice('general.equity', 1),
            'liability' => trans_choice('general.liability', 1),
        ];

        return view('settings.categories.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     *
     * @return Response
     */
    public function store(Request $request)
    {

       
        $response = $this->ajaxDispatch(new CreateCategory($request));

        if ($response['success']) {
            $response['redirect'] = route('categories.index');

            $message = trans('messages.success.added', ['type' => trans_choice('general.categories', 1)]);

            flash($message)->success();
        } else {
            $response['redirect'] = route('categories.create');

            $message = $response['message'];

            flash($message)->error();
        }

        return response()->json($response);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Category  $category
     *
     * @return Response
     */
    public function edit(Category $category)
    {
        $types = [
            'expense' => trans_choice('general.expenses', 1),
            'income' => trans_choice('general.incomes', 1),
            'item' => trans_choice('general.items', 1),
            'other' => trans_choice('general.others', 1),
        ];

        $type_disabled = (Category::where('type', $category->type)->count() == 1) ?: false;

        return view('settings.categories.edit', compact('category', 'types', 'type_disabled'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Category $category
     * @param  Request $request
     *
     * @return Response
     */
    public function update(Category $category, Request $request)
    {
        $response = $this->ajaxDispatch(new UpdateCategory($category, $request));

        if ($response['success']) {
            $response['redirect'] = route('categories.index');

            $message = trans('messages.success.updated', ['type' => $category->name]);

            flash($message)->success();
        } else {
            $response['redirect'] = route('categories.edit', $category->id);

            $message = $response['message'];

            flash($message)->error();
        }

        return response()->json($response);
    }

    /**
     * Enable the specified resource.
     *
     * @param  Category $category
     *
     * @return Response
     */
    public function enable(Category $category)
    {
        $response = $this->ajaxDispatch(new UpdateCategory($category, request()->merge(['enabled' => 1])));

        if ($response['success']) {
            $response['message'] = trans('messages.success.enabled', ['type' => $category->name]);
        }

        return response()->json($response);
    }

    /**
     * Disable the specified resource.
     *
     * @param  Category $category
     *
     * @return Response
     */
    public function disable(Category $category)
    {
        $response = $this->ajaxDispatch(new UpdateCategory($category, request()->merge(['enabled' => 0])));

        if ($response['success']) {
            $response['message'] = trans('messages.success.disabled', ['type' => $category->name]);
        }

        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Category $category
     *
     * @return Response
     */
    public function destroy(Category $category)
    {
        $response = $this->ajaxDispatch(new DeleteCategory($category));

        $response['redirect'] = route('categories.index');

        if ($response['success']) {
            $message = trans('messages.success.deleted', ['type' => $category->name]);

            flash($message)->success();
        } else {
            $message = $response['message'];

            flash($message)->error();
        }

        return response()->json($response);
    }

    public function category(Request $request)
    {
        $category = $this->dispatch(new CreateCategory($request));

        return response()->json($category);
    }

    function fetch($id)
    {
        
        // $data =BusinessAccount::where('business_id', $id)->get();
        // //echo $data;
        // return response()->json($data);

        // $data = DB::table('chart_of_accounts')->select('account_name')->where('business_id', $id)->get();
      
        // return response()->json($data);
        $company_id = session('company_id');
         echo $company_id;
    
        $business = Business::find($id);
        // dd($business);
        foreach ($business->chartAccount as $account) {
            echo $account->account_name;
            echo "<br>";
        }

        foreach ($business->chartAccount as $account) {
            echo $account->type;
            echo "<br>";
        }
      


    // $data=DB::table('chart_of_accounts')
    // ->whereIn('account_id', function($query)
    // {
    //     $query->select(DB::raw('account_id'))
    //           ->from('business_account')
    //           ->whereRaw('business.business_id = business_account.business_id');
    // })
    // ->get();
    // dd($data);
   
            

    }

    function fetchType($type)
    {
        
        // $data =BusinessAccount::where('business_id', $id)->get();
        // //echo $data;
        // return response()->json($data);

        $data = DB::table('chart_of_accounts')->select('account_name')->where('parent_id', $type)->get();
      
        return response()->json($data);

       
    }

    function addCategory(Request $req)
    {
        
        // $cat = new Category();
     
        // $cat->sname = $req->name;
        // $cat->cowner = $req->type;
    //    dd($req->name);

       echo "wahid";
        
       // $cat->save();

    //    return redirect()->route('categories.index');

       
    }
}
