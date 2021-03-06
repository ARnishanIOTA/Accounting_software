@extends('layouts.admin')

@section('title', trans_choice('general.categories', 2))


@permission('create-settings-categories')

@section('new_button')
    <button type="button" class="btn btn-success btn-sm btn-alone" data-toggle="modal" data-target="#exampleModal">Select Business Type
    </button>

    <span><a href="{{ route('categories.create') }}" class="btn btn-success btn-sm btn-alone"><span class="fa fa-plus"></span> &nbsp;{{ trans('general.add_new') }}</a></span>
@endsection
@endpermission

<style>


    .tablink {
        background-color: white;
        color: #777;
        float: left;
        border: 1px;
        outline: none;
        cursor: pointer;
        padding: 14px 16px;
        font-size: 17px;
        width: 18%;
        font-weight: bold;
        margin-left: 1%;
        margin-right: 1%;
    }

    .tablink:hover {
        border-bottom: 5px solid #D4DDE3;
        color: black;
    }

    /* Style the tab content (and add height:100% for full page content) */
    .tabcontent {
        color: black;
        height: 100%;
        width: 100%;
    }
    .el-select{
        width: 100%;
    }
    .active{
        border-bottom: 5px solid #136acd;
    }
    .active:hover{
        border-bottom: 5px solid #136acd;
    }
    .add-margin-tablink{
        margin-bottom: -32px;
    }

    #Assets {background-color: white;}
    #Liabilities{background-color: white;}
    #Income {background-color: white;}
    #Expenses {background-color: white;}
    #Equity {background-color: white;}
</style>



@section('content')

    <div>
        <!-- Button trigger modal -->

    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Select business type</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form method="POST" action="{{ route('categories.addCategory') }}">
                    {{ csrf_field() }}

                    <div class="modal-body">

                        <div class="form-group">
                            <label>Business Type</label>
                            <!-- <select class="form-control" name="type" placeholder="Select One"> -->
                            <select name="b_type" id="b_type" class="form-control">
                                <option value="" selected disabled>-Select-</option>
                                @foreach($business  as  $bus)
                                    <option value="{{ $bus->business_id}}">{{ $bus->business_name }}</option>
                                @endforeach
                            </select>
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
        <div class="card-header border-bottom-0" :class="[{'bg-gradient-primary': bulk_action.show}]">
            {!! Form::open([
                'method' => 'GET',
                'route' => 'categories.index',
                'role' => 'form',
                'class' => 'mb-0'
            ]) !!}
            <div class="align-items-center" v-if="!bulk_action.show">
                <akaunting-search
                        :placeholder="'{{ trans('general.search_placeholder') }}'"
                        :options="{{ json_encode([]) }}"
                ></akaunting-search>
            </div>

            {{ Form::bulkActionRowGroup('general.categories', $bulk_actions, ['group' => 'settings', 'type' => 'categories']) }}
            {!! Form::close() !!}
        </div>
        <div class="add-margin-tablink">
            <button class="tablink active" onclick="openPage('Assets', this, 'white')" id="defaultOpen">Assets</button>
            <button class="tablink" onclick="openPage('Liabilities', this, 'white')">Liabilities</button>
            <button class="tablink" onclick="openPage('Income', this, 'white')">Income</button>
            <button class="tablink" onclick="openPage('Expenses', this, 'white')">Expenses</button>
            <button class="tablink" onclick="openPage('Equity', this, 'white')">Equity</button>
        </div>
        <hr>



        <div class="tabcontent" id="Assets">

            <table class="table table-flush table-hover">
                <thead class="thead-light">
                <tr class="row table-head-line">
                    <th class="col-sm-2 col-md-2 col-lg-1 d-none d-sm-block">{{ Form::bulkActionAllGroup() }}</th>
                    <th class="col-xs-4 col-sm-3 col-md-2 col-lg-3">@sortablelink('name', trans('general.name'), ['filter' => 'active, visible'], ['class' => 'col-aka', 'rel' => 'nofollow'])</th>
                    <th class="col-sm-2 col-md-2 col-lg-2 d-none d-sm-block">@sortablelink('type', trans_choice('general.types', 1))</th>
                    <th class="col-md-2  col-lg-2 d-none d-md-block">{{ trans('general.color') }}</th>
                    <th class="col-xs-4 col-sm-3 col-md-2 col-lg-2">@sortablelink('enabled', trans('general.enabled'))</th>
                    <th class="col-xs-4 col-sm-2 col-md-2 col-lg-2 text-center">{{ trans('general.actions') }}</th>
                </tr>
                </thead>

                <tbody>
                @if(count($categories) != 0)
                    @foreach($categories as $item)
                        <tr class="row align-items-center border-top-1">
                            <td class="col-sm-2 col-md-2 col-lg-1 d-none d-sm-block">
                                {{ Form::bulkActionGroup($item->id, $item->name) }}
                            </td>
                            <td class="col-xs-4 col-sm-3 col-md-2 col-lg-3"><a class="col-aka" href="{{ route('categories.edit',  $item->id) }}">{{ $item->name }}</a></td>
                            <td class="col-sm-2 col-md-2 col-lg-2 d-none d-sm-block">{{ $types[$item->type] }}</td>
                            <td class="col-md-2  col-lg-2 d-none d-md-block"><i class="fa fa-2x fa-circle" style="color:{{ $item->color }};"></i></td>
                            <td class="col-xs-4 col-sm-3 col-md-2 col-lg-2">
                                @if (user()->can('update-settings-categories'))
                                    {{ Form::enabledGroup($item->id, $item->name, $item->enabled) }}
                                @else
                                    @if ($item->enabled)
                                        <badge rounded type="success" class="mw-60">{{ trans('general.yes') }}</badge>
                                    @else
                                        <badge rounded type="danger" class="mw-60">{{ trans('general.no') }}</badge>
                                    @endif
                                @endif
                            </td>
                            <td class="col-xs-4 col-sm-2 col-md-2 col-lg-2 text-center">
                                <div class="dropdown">
                                    <a class="btn btn-neutral btn-sm text-light items-align-center py-2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-ellipsis-h text-muted"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                        <a class="dropdown-item" href="{{ route('categories.edit',  $item->id) }}">{{ trans('general.edit') }}</a>
                                        @if ($item->id != $transfer_id)
                                            @permission('delete-settings-categories')
                                            <div class="dropdown-divider"></div>
                                            {!! Form::deleteLink($item, 'categories.destroy') !!}
                                            @endpermission
                                        @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6"><div id="datatable-basic_info" role="status" aria-live="polite" class="text-muted text-center bold nr-py">
                                No records.
                            </div></td>
                    </tr>
                @endif
                </tbody>
            </table>

        <!-- <div class="card-footer table-action">
            <div class="row">
            {{--    @include('partials.admin.pagination', ['items' => $categories])--}}
                </div>
            </div> -->
        </div>





        <div class="tabcontent" id="Liabilities" style="display:none">

            <table class="table table-flush table-hover">
                <thead class="thead-light">
                <tr class="row table-head-line">
                    <th class="col-sm-2 col-md-2 col-lg-1 d-none d-sm-block">{{ Form::bulkActionAllGroup() }}</th>
                    <th class="col-xs-4 col-sm-3 col-md-2 col-lg-3">@sortablelink('name', trans('general.name'), ['filter' => 'active, visible'], ['class' => 'col-aka', 'rel' => 'nofollow'])</th>
                    <th class="col-sm-2 col-md-2 col-lg-2 d-none d-sm-block">@sortablelink('type', trans_choice('general.types', 1))</th>
                    <th class="col-md-2  col-lg-2 d-none d-md-block">{{ trans('general.color') }}</th>
                    <th class="col-xs-4 col-sm-3 col-md-2 col-lg-2">@sortablelink('enabled', trans('general.enabled'))</th>
                    <th class="col-xs-4 col-sm-2 col-md-2 col-lg-2 text-center">{{ trans('general.actions') }}</th>
                </tr>
                </thead>

                <tbody>
                @if(count($categories2) != 0)
                    @foreach($categories2 as $item)
                        <tr class="row align-items-center border-top-1">
                            <td class="col-sm-2 col-md-2 col-lg-1 d-none d-sm-block">
                                {{ Form::bulkActionGroup($item->id, $item->name) }}
                            </td>
                            <td class="col-xs-4 col-sm-3 col-md-2 col-lg-3"><a class="col-aka" href="{{ route('categories.edit',  $item->id) }}">{{ $item->name }}</a></td>
                            <td class="col-sm-2 col-md-2 col-lg-2 d-none d-sm-block">{{ $types[$item->type] }}</td>
                            <td class="col-md-2  col-lg-2 d-none d-md-block"><i class="fa fa-2x fa-circle" style="color:{{ $item->color }};"></i></td>
                            <td class="col-xs-4 col-sm-3 col-md-2 col-lg-2">
                                @if (user()->can('update-settings-categories'))
                                    {{ Form::enabledGroup($item->id, $item->name, $item->enabled) }}
                                @else
                                    @if ($item->enabled)
                                        <badge rounded type="success" class="mw-60">{{ trans('general.yes') }}</badge>
                                    @else
                                        <badge rounded type="danger" class="mw-60">{{ trans('general.no') }}</badge>
                                    @endif
                                @endif
                            </td>
                            <td class="col-xs-4 col-sm-2 col-md-2 col-lg-2 text-center">
                                <div class="dropdown">
                                    <a class="btn btn-neutral btn-sm text-light items-align-center py-2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-ellipsis-h text-muted"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                        <a class="dropdown-item" href="{{ route('categories.edit',  $item->id) }}">{{ trans('general.edit') }}</a>
                                        @if ($item->id != $transfer_id)
                                            @permission('delete-settings-categories')
                                            <div class="dropdown-divider"></div>
                                            {!! Form::deleteLink($item, 'categories.destroy') !!}
                                            @endpermission
                                        @endif
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

        <!-- <div class="card-footer table-action">
            <div class="row">
            {{--    @include('partials.admin.pagination', ['items' => $categories])--}}
                </div>
            </div> -->
        </div>





        <div class="tabcontent" id="Income" style="display:none">

            <table class="table table-flush table-hover">
                <thead class="thead-light">
                <tr class="row table-head-line">
                    <th class="col-sm-2 col-md-2 col-lg-1 d-none d-sm-block">{{ Form::bulkActionAllGroup() }}</th>
                    <th class="col-xs-4 col-sm-3 col-md-2 col-lg-3">@sortablelink('name', trans('general.name'), ['filter' => 'active, visible'], ['class' => 'col-aka', 'rel' => 'nofollow'])</th>
                    <th class="col-sm-2 col-md-2 col-lg-2 d-none d-sm-block">@sortablelink('type', trans_choice('general.types', 1))</th>
                    <th class="col-md-2  col-lg-2 d-none d-md-block">{{ trans('general.color') }}</th>
                    <th class="col-xs-4 col-sm-3 col-md-2 col-lg-2">@sortablelink('enabled', trans('general.enabled'))</th>
                    <th class="col-xs-4 col-sm-2 col-md-2 col-lg-2 text-center">{{ trans('general.actions') }}</th>
                </tr>
                </thead>

                <tbody>
                @if(count($categories3) != 0)
                    @foreach($categories3 as $item)
                        <tr class="row align-items-center border-top-1">
                            <td class="col-sm-2 col-md-2 col-lg-1 d-none d-sm-block">
                                {{ Form::bulkActionGroup($item->id, $item->name) }}
                            </td>
                            <td class="col-xs-4 col-sm-3 col-md-2 col-lg-3"><a class="col-aka" href="{{ route('categories.edit',  $item->id) }}">{{ $item->name }}</a></td>
                            <td class="col-sm-2 col-md-2 col-lg-2 d-none d-sm-block">{{ $types[$item->type] }}</td>
                            <td class="col-md-2  col-lg-2 d-none d-md-block"><i class="fa fa-2x fa-circle" style="color:{{ $item->color }};"></i></td>
                            <td class="col-xs-4 col-sm-3 col-md-2 col-lg-2">
                                @if (user()->can('update-settings-categories'))
                                    {{ Form::enabledGroup($item->id, $item->name, $item->enabled) }}
                                @else
                                    @if ($item->enabled)
                                        <badge rounded type="success" class="mw-60">{{ trans('general.yes') }}</badge>
                                    @else
                                        <badge rounded type="danger" class="mw-60">{{ trans('general.no') }}</badge>
                                    @endif
                                @endif
                            </td>
                            <td class="col-xs-4 col-sm-2 col-md-2 col-lg-2 text-center">
                                <div class="dropdown">
                                    <a class="btn btn-neutral btn-sm text-light items-align-center py-2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-ellipsis-h text-muted"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                        <a class="dropdown-item" href="{{ route('categories.edit',  $item->id) }}">{{ trans('general.edit') }}</a>
                                        @if ($item->id != $transfer_id)
                                            @permission('delete-settings-categories')
                                            <div class="dropdown-divider"></div>
                                            {!! Form::deleteLink($item, 'categories.destroy') !!}
                                            @endpermission
                                        @endif
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
        <!-- <div class="card-footer table-action">
            <div class="row">
            {{--    @include('partials.admin.pagination', ['items' => $categories])--}}
                </div>
            </div> -->
        </div>





        <div class="tabcontent" id="Expenses" style="display:none">
            <table class="table table-flush table-hover">
                <thead class="thead-light">
                <tr class="row table-head-line">
                    <th class="col-sm-2 col-md-2 col-lg-1 d-none d-sm-block">{{ Form::bulkActionAllGroup() }}</th>
                    <th class="col-xs-4 col-sm-3 col-md-2 col-lg-3">@sortablelink('name', trans('general.name'), ['filter' => 'active, visible'], ['class' => 'col-aka', 'rel' => 'nofollow'])</th>
                    <th class="col-sm-2 col-md-2 col-lg-2 d-none d-sm-block">@sortablelink('type', trans_choice('general.types', 1))</th>
                    <th class="col-md-2  col-lg-2 d-none d-md-block">{{ trans('general.color') }}</th>
                    <th class="col-xs-4 col-sm-3 col-md-2 col-lg-2">@sortablelink('enabled', trans('general.enabled'))</th>
                    <th class="col-xs-4 col-sm-2 col-md-2 col-lg-2 text-center">{{ trans('general.actions') }}</th>
                </tr>
                </thead>

                <tbody>
                @if(count($categories1) != 0)
                    @foreach($categories1 as $item)
                        <tr class="row align-items-center border-top-1">
                            <td class="col-sm-2 col-md-2 col-lg-1 d-none d-sm-block">
                                {{ Form::bulkActionGroup($item->id, $item->name) }}
                            </td>
                            <td class="col-xs-4 col-sm-3 col-md-2 col-lg-3"><a class="col-aka" href="{{ route('categories.edit',  $item->id) }}">{{ $item->name }}</a></td>
                            <td class="col-sm-2 col-md-2 col-lg-2 d-none d-sm-block">{{ $types[$item->type] }}</td>
                            <td class="col-md-2  col-lg-2 d-none d-md-block"><i class="fa fa-2x fa-circle" style="color:{{ $item->color }};"></i></td>
                            <td class="col-xs-4 col-sm-3 col-md-2 col-lg-2">
                                @if (user()->can('update-settings-categories'))
                                    {{ Form::enabledGroup($item->id, $item->name, $item->enabled) }}
                                @else
                                    @if ($item->enabled)
                                        <badge rounded type="success" class="mw-60">{{ trans('general.yes') }}</badge>
                                    @else
                                        <badge rounded type="danger" class="mw-60">{{ trans('general.no') }}</badge>
                                    @endif
                                @endif
                            </td>
                            <td class="col-xs-4 col-sm-2 col-md-2 col-lg-2 text-center">
                                <div class="dropdown">
                                    <a class="btn btn-neutral btn-sm text-light items-align-center py-2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-ellipsis-h text-muted"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                        <a class="dropdown-item" href="{{ route('categories.edit',  $item->id) }}">{{ trans('general.edit') }}</a>
                                        @if ($item->id != $transfer_id)
                                            @permission('delete-settings-categories')
                                            <div class="dropdown-divider"></div>
                                            {!! Form::deleteLink($item, 'categories.destroy') !!}
                                            @endpermission
                                        @endif
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

        <!-- <div class="card-footer table-action">
            <div class="row">
            {{--    @include('partials.admin.pagination', ['items' => $categories])--}}
                </div>
            </div> -->
        </div>




        <div class="tabcontent" id="Equity" style="display:none">

            <table class="table table-flush table-hover">
                <thead class="thead-light">
                <tr class="row table-head-line">
                    <th class="col-sm-2 col-md-2 col-lg-1 d-none d-sm-block">{{ Form::bulkActionAllGroup() }}</th>
                    <th class="col-xs-4 col-sm-3 col-md-2 col-lg-3">@sortablelink('name', trans('general.name'), ['filter' => 'active, visible'], ['class' => 'col-aka', 'rel' => 'nofollow'])</th>
                    <th class="col-sm-2 col-md-2 col-lg-2 d-none d-sm-block">@sortablelink('type', trans_choice('general.types', 1))</th>
                    <th class="col-md-2  col-lg-2 d-none d-md-block">{{ trans('general.color') }}</th>
                    <th class="col-xs-4 col-sm-3 col-md-2 col-lg-2">@sortablelink('enabled', trans('general.enabled'))</th>
                    <th class="col-xs-4 col-sm-2 col-md-2 col-lg-2 text-center">{{ trans('general.actions') }}</th>
                </tr>
                </thead>

                <tbody>
                @if(count($categories4) != 0)
                    @foreach($categories4 as $item)
                        <tr class="row align-items-center border-top-1">
                            <td class="col-sm-2 col-md-2 col-lg-1 d-none d-sm-block">
                                {{ Form::bulkActionGroup($item->id, $item->name) }}
                            </td>
                            <td class="col-xs-4 col-sm-3 col-md-2 col-lg-3"><a class="col-aka" href="{{ route('categories.edit',  $item->id) }}">{{ $item->name }}</a></td>
                            <td class="col-sm-2 col-md-2 col-lg-2 d-none d-sm-block">{{ $types[$item->type] }}</td>
                            <td class="col-md-2  col-lg-2 d-none d-md-block"><i class="fa fa-2x fa-circle" style="color:{{ $item->color }};"></i></td>
                            <td class="col-xs-4 col-sm-3 col-md-2 col-lg-2">
                                @if (user()->can('update-settings-categories'))
                                    {{ Form::enabledGroup($item->id, $item->name, $item->enabled) }}
                                @else
                                    @if ($item->enabled)
                                        <badge rounded type="success" class="mw-60">{{ trans('general.yes') }}</badge>
                                    @else
                                        <badge rounded type="danger" class="mw-60">{{ trans('general.no') }}</badge>
                                    @endif
                                @endif
                            </td>
                            <td class="col-xs-4 col-sm-2 col-md-2 col-lg-2 text-center">
                                <div class="dropdown">
                                    <a class="btn btn-neutral btn-sm text-light items-align-center py-2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-ellipsis-h text-muted"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                        <a class="dropdown-item" href="{{ route('categories.edit',  $item->id) }}">{{ trans('general.edit') }}</a>
                                        @if ($item->id != $transfer_id)
                                            @permission('delete-settings-categories')
                                            <div class="dropdown-divider"></div>
                                            {!! Form::deleteLink($item, 'categories.destroy') !!}
                                            @endpermission
                                        @endif
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
        <!-- <div class="card-footer table-action">
            <div class="row">
            {{--    @include('partials.admin.pagination', ['items' => $categories])--}}
                </div>
            </div> -->
        </div>


    </div>
@endsection
<div>
    @push('scripts_start')
        <script src="{{ asset('public/js/settings/categories.js?v=' . version('short')) }}"></script>
    @endpush
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>



<script>
    function openPage(pageName,elmnt,color) {
        // Add Active Class By Nishan
        let current = document.getElementsByClassName("active");
        Array.from(current).forEach(b => {
            b.className = b.className.replace(" active", "");
        });
        elmnt.className += " active";
        // End Of Add Active Class By Nishan
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablink");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].style.backgroundColor = "";
            tablinks[i].style.Color = "black";
        }
        document.getElementById(pageName).style.display = "block";
        elmnt.style.backgroundColor = color;
    }

    // Get the element with id="defaultOpen" and click on it
    //document.getElementById("defaultOpen").click();


    $(document).ready(function(){

        $(document).on('change','#b_type',function(){
            // console.log("hmm its change");

            var business_id=$(this).val();
            // console.log(cat_id);
            var div=$(this).parent();

            var op=" ";
            var _token = $('input[name="_token"]').val();
            $.ajax({

                type:'get',
                url:"http://localhost/Akaunting/settings/categories/fetch/"+business_id,
                // data:{'id':business_id,_token:_token},
                success:function(data){
                    console.log('data');

                    //     for(var i=0;i<data.length;i++){
                    //         console.log(data[i].account_name);
                    //    }

                    if(data){
                        $("#account_name").empty();
                        $("#account_name").append('<option>-Select-</option>');
                        for(var i=0;i<data.length;i++){
                            $("#account_name").append('<option value="'+data[i].account_name+'">'+data[i].account_name+'</option>');
                        }

                    }else{
                        $("#account_name").empty();
                    }
                },
                error:function(){
                    console.log('error');
                }
            });
        });

    });


    $(document).ready(function(){

        $(document).on('change','#type',function(){

            var type=$(this).val();

            $.ajax({
                type:'get',
                url:"http://localhost/Akaunting/settings/categories/fetchType/"+type,
                success:function(data){

                    if(data){
                        $("#account_name").empty();
                        $("#account_name").append('<option>-Select-</option>');
                        for(var i=0;i<data.length;i++){
                            $("#account_name").append('<option value="'+data[i].account_name+'">'+data[i].account_name+'</option>');
                        }

                    }else{
                        $("#account_name").empty();
                    }


                }

            });

        });



    });




</script>



