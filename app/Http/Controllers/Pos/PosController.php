<?php


namespace App\Http\Controllers\Pos;


use App\Abstracts\Http\Controller;
use App\Http\Controllers\Modals\Categories;
use App\Jobs\Setting\CreateCategory;
use Illuminate\Http\Request as Request;
use App\Abstracts\Model\Category;
//use App\Http\Requests\Pos\Pos as Request;
use DB;

class PosController extends  Controller
{
    public function __construct()
    {
        // Add CRUD permission check
        $this->middleware('permission:create-PosController')->only(['create', 'store', 'duplicate', 'import']);
        $this->middleware('permission:read-PosController')->only(['show']);
//        $this->middleware('permission:update-PosController')->only(['index', 'edit', 'export', 'update', 'enable', 'disable', 'share']);
//        $this->middleware('permission:delete-PosController')->only('destroy');
    }
    public function index()
    {
           return view('pos.index');

    }
    public function nishan(Request $request){
//        dd($request);

        $data = array();
        $data['company_id'] = 1;
        $data['name'] = 'cash';
        $data['type'] = 'Assets';
        $data['color'] ='#fff';
        $data['enabled'] = 1;
        DB::table('categories')->insert($data);
//        if($category->save()){
//            echo "Category Inserted Successfully";
//        }
//        $category = new Category;
//        $category->company_id = 1;
//        $category->name = 'cash';
//        $category->type = 'Assets';
//        $category->color = '#fff';
//        $category->enabled = 1;
//        $response = $this->ajaxDispatch(new CreateCategory($category));
//
//        if ($response['success']) {
//            $response['redirect'] = route('categories.index');
//
//            $message = trans('messages.success.added', ['type' => trans_choice('general.categories', 1)]);
//
//            flash($message)->success();
//        } else {
//            $response['redirect'] = route('categories.create');
//
//            $message = $response['message'];
//
//            flash($message)->error();
//        }
//
//        return response()->json($response);
    }



}