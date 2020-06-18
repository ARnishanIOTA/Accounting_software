@extends('layouts.admin')

@section('title', trans_choice('general.invoices', 2))

@section('new_button')
    @permission('create-sales-invoices')
    <span><a href="{{ route('invoices.create') }}" class="btn btn-primary btn-sm btn-success header-button-top"><span class="fa fa-plus"></span> &nbsp;{{ trans('general.add_new') }}</a></span>
    <span><a href="{{ route('import.create', ['group' => 'sales', 'type' => 'invoices']) }}" class="btn btn-white btn-sm header-button-top"><span class="fa fa-upload"></span> &nbsp;{{ trans('import.import') }}</a></span>
    @endpermission
    <span><a href="{{ route('invoices.export', request()->input()) }}" class="btn btn-white btn-sm header-button-top"><span class="fa fa-download"></span> &nbsp;{{ trans('general.export') }}</a></span>
@endsection

@section('content')
    @if ($invoices->count())
        <div class="card">
            <div class="card-header border-bottom-0" :class="[{'bg-gradient-primary': bulk_action.show}]">
                {!! Form::open([
                    'method' => 'GET',
                    'route' => 'invoices.index',
                    'role' => 'form',
                    'class' => 'mb-0'
                ]) !!}
                <div class="align-items-center" v-if="!bulk_action.show">
                    <akaunting-search
                            :placeholder="'{{ trans('general.search_placeholder') }}'"
                            :options="{{ json_encode([]) }}"
                    ></akaunting-search>
                </div>

                {{ Form::bulkActionRowGroup('general.invoices', $bulk_actions, ['group' => 'sales', 'type' => 'invoices']) }}
                {!! Form::close() !!}
            </div>
{{--            <div class="exampleModal" id="modalData" style="position: relative;z-index: 1000;margin-top: -25%;margin-left: -21%;margin-bottom: -2%; " >--}}
{{--                <div class="modal-dialog" role="document">--}}
{{--                    <div style="width: 450px; height: 230px; margin-left: 30%;" class="modal-content">--}}
{{--                        <div style="padding:1.25rem; padding-right:0; margin-left: 2%; border-bottom: 1px solid;margin-right: 2%;" class="">--}}
{{--                            <div style="width: 100%" class="row">--}}
{{--                                <div style="font-size: 13px; font-family: Averta-Bold;" class="col-lg-3">Due</div>--}}
{{--                                <div style="font-size: 13px; font-family: Averta-Bold;" class="col-lg-3">Last sent</div>--}}
{{--                                <div style="font-size: 13px; font-family: Averta-Bold;" class="col-lg-3">Last viewed</div>--}}
{{--                                <div style="font-size: 13px; font-family: Averta-Bold;" class="col-lg-3">Total</div>--}}
{{--                            </div>--}}
{{--                            <div style="width: 100%" class="row">--}}
{{--                                <div style="font-size: 12px; " class="col-lg-3">Due</div>--}}
{{--                                <div style="font-size: 12px; " class="col-lg-3">Last sent</div>--}}
{{--                                <div style="font-size: 12px; " class="col-lg-3">Last viewed</div>--}}
{{--                                <div style="font-size: 12px; " class="col-lg-3">Total</div>--}}
{{--                            </div>--}}
{{--                            <button type="button" style="margin-top: -42px;margin-right: 16px;" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                                <span aria-hidden="true">&times;</span>--}}
{{--                            </button>--}}

{{--                        </div>--}}
{{--                        <div class="modal-body">--}}
{{--                            <div style="width: 100%" class="row">--}}
{{--                                <div style="font-size: 13px; font-family: Averta-Bold;padding-left: 87px;" class="col-lg-5">Customer : </div>--}}
{{--                                <div style="font-size: 13px; margin-left: -15px;" class="col-lg-7">--}}
{{--                                    <span>Mr Customer<span><br>--}}
{{--                                    <span>Dhaka Bangladesh<span><br>--}}
{{--                                    <span>Mr@email.com<span><br>--}}
{{--                                    <span>78934789723489<span><br>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div style="width: 100%" class="row">--}}
{{--                                <div style="font-size: 13px; font-family: Averta-Bold;padding-left: 87px;" class="col-lg-5">Summery : </div>--}}
{{--                                <div style="font-size: 13px; margin-left: -15px;" class="col-lg-7">--}}
{{--                                    <span>Summery<span><br>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div style="width: 100%" class="row">--}}
{{--                                <div style="font-size: 13px; font-family: Averta-Bold;padding-left: 110px;" class="col-lg-5">Notes : </div>--}}
{{--                                <div style="font-size: 13px; margin-left: -15px;" class="col-lg-7">--}}
{{--                                    <span>Notes<span><br>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

            <div class="table-responsive">
                <table class="table table-flush table-hover">
                    <thead class="thead-light">
                    <tr class="row table-head-line">
                        <th class="col-sm-2 col-md-1 col-lg-1 col-xl-1 d-none d-sm-block">{{ Form::bulkActionAllGroup() }}</th>
                        <th class="col-md-2 col-lg-2 col-xl-1 d-none d-md-block">@sortablelink('invoice_number', trans_choice('general.numbers', 1), ['filter' => 'active, visible'], ['class' => 'col-aka', 'rel' => 'nofollow'])</th>
                        <th class="col-xs-4 col-sm-4 col-md-4 col-lg-2 col-lg-customer text-left">@sortablelink('contact_name', trans_choice('general.customers', 1))</th>
                        <th class="col-xs-4 col-sm-4 col-md-3 col-lg-1 col-lg-ammount text-right">@sortablelink('amount', trans('general.amount'))</th>
                        <th class="col-lg-2 col-lg-invoice d-none d-lg-block text-left">@sortablelink('invoiced_at', trans('invoices.invoice_date'))</th>
                        <th class="col-lg-2 col-lg-due d-none d-lg-block text-left">@sortablelink('due_at', trans('invoices.due_date'))</th>
                        <th class="col-lg-1 col-lg-status d-none d-lg-block text-center">@sortablelink('status', trans_choice('general.statuses', 1))</th>
                        <th class="col-xs-4 col-sm-2 col-md-2 col-lg-1 col-xl-1 text-center"><a>{{ trans('general.actions') }}</a></th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($invoices as $item)
                        <?php
                        //                             echo "<pre>";
                        //                             print_r($item);
                        //                             echo "</pre>";
                        //                             exit();

                        ?>
                        @php $paid = $item->paid; @endphp
                        <tr class="row align-items-center border-top-1">
                            <td class="col-sm-2 col-md-1 col-lg-1 col-xl-1 d-none d-sm-block">{{ Form::bulkActionGroup($item->id, $item->invoice_number) }}</td>
                            <td class="col-md-2 col-lg-2 col-xl-1 d-none d-md-block"><a class="col-aka" href="{{ route('invoices.show' , $item->id) }}">{{ $item->invoice_number }}</a></td>
                            <td class="col-xs-4 col-sm-4 col-md-4 col-lg-2 col-lg-customer text-left" onmouseover="MouseOverInvoice('<?php echo $item->id; ?>');" onmouseout="MouseOutInvoice('<?php echo $item->id; ?>');">{{ $item->contact_name }}</td>
                            <td class="col-xs-4 col-sm-4 col-md-3 col-lg-1 col-lg-ammount text-right">@money($item->amount, $item->currency_code, true)</td>
                            <td class="col-lg-2 col-lg-invoice d-none d-lg-block text-left">@date($item->invoiced_at)</td>
                            <td class="col-lg-2 col-lg-due d-none d-lg-block text-left">@date($item->due_at)</td>
                            <td class="col-lg-1 col-lg-status d-none d-lg-block text-center">
                                <span class="badge badge-pill badge-{{ $item->status_label }}">{{ trans('invoices.statuses.' . $item->status) }}</span>
                            </td>
                            <td class="col-xs-4 col-sm-2 col-md-2 col-lg-1 col-xl-1 text-center">
                                <div class="dropdown">
                                    <a class="btn btn-neutral btn-sm text-light items-align-center py-2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-ellipsis-h text-muted"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                        <a class="dropdown-item" href="{{ route('invoices.show', $item->id) }}">{{ trans('general.show') }}</a>
                                        @if (!$item->reconciled)
                                            <a class="dropdown-item" href="{{ route('invoices.edit', $item->id) }}">{{ trans('general.edit') }}</a>
                                        @endif
                                        <div class="dropdown-divider"></div>

                                        @if ($item->status != 'cancelled')
                                            @permission('create-sales-invoices')
                                            <a class="dropdown-item" href="{{ route('invoices.duplicate', $item->id) }}">{{ trans('general.duplicate') }}</a>
                                            <div class="dropdown-divider"></div>
                                            @endpermission

                                            @permission('update-sales-invoices')
                                            <a class="dropdown-item" href="{{ route('invoices.cancelled', $item->id) }}">{{ trans('general.cancel') }}</a>
                                            @endpermission
                                        @endif

                                        @permission('delete-sales-invoices')
                                        @if (!$item->reconciled)
                                            {!! Form::deleteLink($item, 'invoices.destroy') !!}
                                        @endif
                                        @endpermission
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="card-footer table-action">
                <div class="row">
                    @include('partials.admin.pagination', ['items' => $invoices])
                </div>
            </div>
        </div>
    @else
        @include('partials.admin.empty_page', ['page' => 'invoices', 'docs_path' => 'sales/invoices'])
    @endif
@endsection

@push('scripts_start')
{{--    Commented BY Nishan--}}
    <script src="{{ asset('public/js/sales/invoices.js?v=' . version('short')) }}"></script>
@endpush


<!-- Latest compiled JavaScript -->
{{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>--}}
{{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>--}}


<script>
    // $(document).ready(function(){
    //     $("#exampleModal").modal('show');
    // });
</script>
<script>
    // jQuery.noConflict();
    // jQuery(document).ready(function(){
    //     // $( "#b1" ).hover(function() {
    //     //     jQuery('.modal').modal({
    //     //         show: true
    //     //     });
    //     // });
    //     jQuery.noConflict();
    //     $('#exampleModal').modal({
    //         show:true
    //     });
    // });
    // let exampleModal = document.getElementsByClassName("exampleModal");
    // console.log(exampleModal);
    // Array.from(exampleModal).forEach(m => {
    //     console.log('m');
    //     m.style.visibility = "hidden";
    // });
    // let modal = document.querySelector('.exampleModal');
    // console.log(modal);
    // modal.style.visibility = "hidden";
    function MouseOverInvoice(id){
        // console.log('Mouse Over '+id);
        // jQuery('#exampleModal').modal('show');
    }
    function MouseOutInvoice(id){
        // console.log('Mouse Out '+id);
    }


</script>