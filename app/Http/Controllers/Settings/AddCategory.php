<?php

namespace App\Http\Controllers\Settings;

use App\Abstracts\Http\Controller;
use Illuminate\Http\Request as Request;
use App\Jobs\Setting\CreateCategory;

use App\Models\Setting\Category;
use App\Http\Controllers\Modals\Categories;
use App\Business;
use App\BusinessAccount;
use App\ChartAccount;
use Illuminate\Support\Facades\DB;


class AddCategory extends Controller
{

    public function __construct()
    {
        // Add CRUD permission check
        $this->middleware('permission:create-AddCategory')->only(['create', 'store', 'duplicate', 'import']);
        $this->middleware('permission:read-AddCategory')->only(['show']);
        $this->middleware('permission:update-AddCategory')->only(['index', 'edit', 'export', 'update', 'enable', 'disable', 'share']);
        $this->middleware('permission:delete-AddCategory')->only('destroy');
    }

    

    function addCategory(Request $request)
    {

        // $data = array();
        // $data['company_id'] = 1;
        // $data['name'] = 'wahid';
        // $data['type'] = 'Assets';
        // $data['color'] ='#fff';
        // $data['enabled'] = 1;
        // DB::table('categories')->insert($data);
        //echo $request->type;
        //echo $request->b_type;   

        $company_id = session('company_id');
        $myquery = DB::table('categories')->select('name')->get();
        $array = array();
        
        foreach ($myquery as $account) {
            array_push($array, $account->name);           
            }


        
        $business = Business::find($request->b_type);      
        
     
        foreach ($business->chartAccount as $account) {
            
               if (in_array($account->account_name,  $array))
                    {
                    
                    }
                    else
                    {
                    $data = array();
                    $data['company_id'] = session('company_id');
                    $data['name'] = $account->account_name;
                    $data['type'] = $account->type;
                    $data['color'] ='#55588b';
                    $data['enabled'] = 1;
                    DB::table('categories')->insert($data);
                    }
            
           
              }

              return redirect()->route('categories.index'); 

    //         foreach($totalCategory as $category)
    //    {
    //     $sql="select * from products where categories ='$category'";
    //     $records = \DB::select($sql);
    //     dd($records);
    //    }
    
        //  
    
        //  foreach ($business->chartAccount as $account) {
        //     $categories =DB::table('categories')->select('name')->where('name',$account->name)->get();
        //      echo $categories->name;
        //      echo "<br>";
        // }

        // foreach ($business->chartAccount as $account) {
        //     echo $account->type;
        //     echo "<br>";
        // }
      
        
        // $cat = new Category();
     
        // //$cat->company_id = 1;
        // $cat->type = $request->type;
        // $cat->name = $request->name;
        // $cat->color = "#efad32";
        // $cat->enabled = 1;
        
        // $category = Category::create($cat);

       // dd($request->color);

        // $response = $this->ajaxDispatch(new CreateCategory($cat));

        // if ($response['success']) {
        //     $response['redirect'] = route('categories.index');

        //     $message = trans('messages.success.added', ['type' => trans_choice('general.categories', 1)]);

        //     flash($message)->success();
        // } else {
        //     $response['redirect'] = route('categories.create');

        //     $message = $response['message'];

        //     flash($message)->error();
        // }

        // return response()->json($response);
        
        
        //dd($req->account_name);

       //echo "wahid";
        
        // 

    //    return redirect()->route('categories.index');


       
    }
}
