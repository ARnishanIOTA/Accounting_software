@extends('layouts.admin')

@section('title', trans_choice('general.room', 1))


@section('content')





    <!-- Add Room Modal -->
    <div class="modal fade" id="roomModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                    <label> Room Name</label>
                                                    <input type="text" name="name" class="form-control">
                                                                
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





<div class="card">
        <div class="table-responsive">
            <table class="table table-flush table-hover">
                <thead class="thead-light">
                    <tr class="row table-head-line">
                        <th class="col-sm-2 col-md-1 col-lg-1 col-xl-4 d-none d-sm-block">Name</th>
                        
                        <th class="col-sm-2 col-md-2 col-lg-3 col-xl-4 d-none d-sm-block text-center">Address</th>
                      
                        <th class="col-xs-4 col-sm-2 col-md-2 col-lg-1 col-xl-4 text-center">{{ trans('general.actions') }}</th>
                    </tr>
                </thead>

                <tbody>
                @if(count($data) != 0)
                @foreach($data as $item)

                                                        
                        <tr class="row align-items-center border-top-1">
                            <td class="col-sm-2 col-md-1 col-lg-1 col-xl-4 d-none d-sm-block">
                             {{$item->name}}
                            </td>
                            @foreach($data1 as $value)
                            <td class="col-sm-2 col-md-2 col-lg-3 col-xl-4 d-none d-sm-block text-center">{{$value->address}}</td>
                            @endforeach
                            <td class="col-xs-4 col-sm-2 col-md-2 col-lg-1 col-xl-4 text-center">
                                <div class="dropdown">
                                    <a class="btn btn-neutral btn-sm text-light items-align-center py-2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-ellipsis-h text-muted"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                       
                                        <a class="dropdown-item" href="">View Room</a>
                                        
                            
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
