@extends('layouts.admin')

@section('title', trans_choice('general.flat', 1))


@section('content')





    <!-- Add Room Modal -->
    <div class="modal fade" id="roomModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add Room</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <form method="POST" action="{{ route('inventory.warehouse.addRoom') }}">
                                            {{ csrf_field() }}

                                            <div class="modal-body">

                                                <div class="form-group">
                                                    <label> Flat Name: &nbsp</label>
                                                     <span id="wname"></span>
                                                     
                                                     <input type="hidden" name="id" class="form-control" id="wid" >           
                                                </div>

                                                <div class="form-group">
                                                    <label> Room Name</label>
                                                    <input type="text" name="rname" class="form-control">
                                                                
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
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Flat</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <form method="POST" action="{{ route('inventory.warehouse.editFlat') }}">
                                            {{ csrf_field() }}

                                            <div class="modal-body">

                                                <div class="form-group">
                                                    <label> Flat Name</label>
                                                    <input type="text" name="fname" class="form-control" id="flatname">
                                                    <input type="hidden" name="id" class="form-control" id="flatid" >           
                                                </div>

                                               

                                            <!-- {{ csrf_field() }} -->

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
        <div class="table-responsive">
            <table class="table table-flush table-hover">
                <thead class="thead-light">
                    <tr class="row table-head-line">
                    <th class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 d-none d-sm-block"> Warehouse Name</th>
                        <th class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 d-none d-sm-block text-center"> Flat Name</th>
                        
                        <th class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3  d-none d-sm-block text-center">Address</th>
                      
                        <th class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3  text-center">{{ trans('general.actions') }}</th>
                    </tr>
                </thead>

                <tbody>
                @if(count($data) != 0)
                @foreach($data as $item)

                                                        
                        <tr class="row align-items-center border-top-1">
                        <td class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3  d-none d-sm-block">
                             {{$name}}
                            </td>

                            <td class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3  d-none d-sm-block text-center">
                             {{$item->name}}
                            </td>
                            
                            <td class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3  d-none d-sm-block text-center">{{$address}}</td>
                            
                            <td class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3  text-center">
                                <div class="dropdown">
                                    <a class="btn btn-neutral btn-sm text-light items-align-center py-2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-ellipsis-h text-muted"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                        <button type="button" class="dropdown-item" data-toggle="modal" data-target="#roomModal" onclick="booking(event,' {{$item->name}}',' {{$item->id}}')">Add Room </button>
                                        <a class="dropdown-item" href="{{ route('inventory.warehouse.room',$item->id) }}">View Room</a>
                                        <button type="button" class="dropdown-item" data-toggle="modal" data-target="#editModal" onclick="booking(event,' {{$item->name}}',' {{$item->id}}')">Edit</button>
                                        
                                       
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
            console.log(id);
            document.getElementById("wname").innerHTML = wname;
            document.getElementById("wid").value = id;
            document.getElementById("flatname").value = wname;
            document.getElementById("flatid").value = id;

            }

                
    
</script>
