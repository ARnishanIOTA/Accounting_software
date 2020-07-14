<?php

namespace App\Http\Controllers\Inventory;

use App\Abstracts\Http\Controller;
use Illuminate\Http\Request as Request;
use App\Warehouse;
use Illuminate\Support\Facades\DB;


class Warehouses extends Controller
{

    public function __construct()
    {
        // Add CRUD permission check
        $this->middleware('permission:create-Warehouse ')->only(['create', 'store', 'duplicate', 'import']);
        $this->middleware('permission:read-Warehouse ')->only(['show']);
        $this->middleware('permission:update-Warehouse ')->only(['index', 'edit', 'export', 'update', 'enable', 'disable', 'share']);
        $this->middleware('permission:delete-Warehouse ')->only('destroy');
    }

    

    

    public function view()
    {
        $data =Warehouse::where('parent_id', 0)->get();
        return view('inventory.warehouse.index',compact('data'));
       
       
    }

    public function addWarehouse(Request $request)
    {
        
     

         $data = array();
       
          $data['name'] = $request->name;
          $data['parent_id'] = 0;
          $data['address'] =$request->address;
      
          DB::table('warehouses')->insert($data);

         return redirect()->route('inventory.warehouse.index'); 
       
       
    }

    public function addFlat(Request $request)
    {
        
     
        
        $data['name'] = $request->fname;
        $data['parent_id'] = $request->id;
        DB::table('warehouses')->insert($data);
        return redirect()->route('inventory.warehouse.index'); 
       
    }

    public function viewFlat($id)
    {

      
        $address = DB::table('warehouses')->where('id',$id)->get();
       
         $data =Warehouse::where('parent_id', $id)->get();

        return view('inventory.warehouse.flat',compact('data','address'));
       
       
    }

    public function viewRoom($id)
    {
        $data2 = DB::table('warehouses')->where('id',$id)->get();
        
        $data1 = DB::table('warehouses')->where('id',$data2[0]->parent_id)->get();
        
         $data =Warehouse::where('parent_id', $id)->get();
         return view('inventory.warehouse.room',compact('data','data1'));
       
       
    }

    public function addRoom(Request $request)
    {
        
        $data['name'] = $request->rname;
        $data['parent_id'] = $request->id;
        DB::table('warehouses')->insert($data);
        return redirect()->route('inventory.warehouse.index'); 

         
       
       
    }

}
