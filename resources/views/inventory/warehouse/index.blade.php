@extends('layouts.admin')

@section('title', trans_choice('general.warehouses', 2))

@section('new_button')
   
    <button type="button" class="btn btn-success btn-sm btn-alone" data-toggle="modal" data-target="#exampleModal">Add new 
    </button>
       
   
@endsection

@section('content')


<!-- Add warehouse Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Warehouses</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form method="POST" action="{{ route('inventory.warehouse.addWarehouse') }}">
                    {{ csrf_field() }}

                    <div class="modal-body">

                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control">
                                        
                        </div>

                       

                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" name="address" class="form-control">
                                        
                        </div>




                   

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="save">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Add Flat Modal -->
    <div class="modal fade" id="flatModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add Flat</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <form method="POST" action="{{ route('inventory.warehouse.addFlat') }}">
                                            {{ csrf_field() }}

                                            <div class="modal-body">

                                               <div class="form-group">
                                                    <label> Warehouse Name: &nbsp</label>
                                                     <span id="wname"></span>
                                                     
                                                     <input type="hidden" name="id" class="form-control" id="wid" >           
                                                </div>

                                                <div class="form-group">
                                                    <label> Flat Name</label>
                                                    <input type="text" name="fname" class="form-control">
                                                                
                                                </div>





                                            <!-- {{ csrf_field() }} -->

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary" name="save">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                        </div>


                        <!-- Edit Flat Modal -->
                    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                     <div class="modal-dialog" role="document">
                                       <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Warehouse</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <form method="POST" action="{{ route('inventory.warehouse.editWarehouse') }}">
                                            {{ csrf_field() }}

                                            <div class="modal-body">

                                                <div class="form-group">
                                                    <label> Warehouse Name</label>
                                                    <input type="text" name="wname" class="form-control" id="warname">
                                                    <input type="hidden" name="id" class="form-control" id="warid" >           
                                                </div>

                                                <div class="form-group">
                                                    <label> Address</label>
                                                    <input type="text" name="address" class="form-control" id="address">
                                                                
                                                </div>



                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary" name="save">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                        </div>






<div class="card">
        <div class="table-responsive" >
            <table class="table table-flush table-hover" id="table">
                <thead class="thead-light">
                    <tr class="row table-head-line">
                        <th class=" col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 d-none d-sm-block">Name</th>
                        
                        <th class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 d-none d-sm-block text-center">Address</th>
                      
                        <th class=" col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 text-center">{{ trans('general.actions') }}</th>
                    </tr>
                </thead>

                <tbody >
                @if(count($data) != 0)
                @foreach($data as $item)

                                                        
                        <tr class="row align-items-center border-top-1">
                            <td class=" col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 d-none d-sm-block">
                             {{$item->name}}
                            </td>
                            
                            <td class=" col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 d-none d-sm-block text-center">{{$item->address}}</td>
                            
                            <td class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 text-center">
                                <div class="dropdown">
                                    <a class="btn btn-neutral btn-sm text-light items-align-center py-2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-ellipsis-h text-muted"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                        <button type="button" class="dropdown-item" data-toggle="modal" data-target="#flatModal" onclick="booking(event,' {{$item->name}}',' {{$item->id}}')">Add Flat </button>
                                        <a class="dropdown-item" href="{{ route('inventory.warehouse.flat',$item->id) }}">View Flat</a>
                                        <button type="button" class="dropdown-item" data-toggle="modal" data-target="#editModal" onclick="edit(event,' {{$item->name}}',' {{$item->id}}',' {{$item->address}}')">Edit </button>
                                       
                                      
                                    </div>
                                    
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="6"><div id="datatable-basic_info" role="status" aria-live="polite" class="text-muted nr-py text-center bold">
                                No records.
                            </div></td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>

       
    </div>
@endsection




@push('scripts_start')
    <script src="{{ asset('public/js/banking/accounts.js?v=' . version('short')) }}"></script>
@endpush

           <script>
    
              
            function booking(e,wname,id){
                e.preventDefault();

            document.getElementById("wname").innerHTML = wname;
            document.getElementById("wid").value = id;

            }

            function edit(e,wname,id,address){
                e.preventDefault();

            document.getElementById("warname").value = wname;
            document.getElementById("warid").value = id;
            document.getElementById("address").value = address;

            }

                
    
         </script>
