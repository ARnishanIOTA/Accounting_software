@extends('layouts.admin')

@section('title', trans_choice('general.reports', 2))

@section('new_button')
    @permission('create-common-reports')
        <a href="{{ route('reports.create') }}" class="btn btn-success btn-sm header-button-top"><span class="fa fa-plus"></span> &nbsp;{{ trans('general.add_new') }}</a>
    @endpermission
    <a href="{{ route('reports.clear') }}" class="btn btn-warning btn-sm header-button-top"><span class="fa fa-history"></span> &nbsp;{{ trans('general.clear_cache') }}</a>
@endsection
@stack('head_css_start')
<style>
    * {
        box-sizing: border-box;
    }

    /* Create two equal columns that floats next to each other */
    .column1 {
        float: left;
        width: 47%;
        padding: 10px;
        height: 350px; /* Should be removed. Only for demonstration */

    }

    .column2 {
        float: right;
        width: 47%;
        padding: 10px;
        height: 250px; /* Should be removed. Only for demonstration */

    }
    .column3 {
        float: left;
        width: 47%;
        padding: 10px;
        height: 150px; /* Should be removed. Only for demonstration */

    }

    .column4 {
        float: right;
        width: 47%;
        padding: 10px;
        height: 150px; /* Should be removed. Only for demonstration */

    }

    .column5 {
        float: left;
        width: 47%;
        padding: 10px;
        height: 150px; /* Should be removed. Only for demonstration */

    }

    .column6 {
        float: right;
        width: 47%;
        padding: 10px;
        height: 150px; /* Should be removed. Only for demonstration */

    }

    .column7 {
        float: right;
        width: 47%;
        padding: 10px;
        height: 500px; /* Should be removed. Only for demonstration */

    }


    /* Clear floats after the columns */
    .row1:after {

        content: "";
        display: table;
        clear: both;
    }

    .row1 {

        margin: 5px;
        padding: 20px ;
        border: 1px solid black;
        border-radius: 10px;
        width: 100%;
        margin-top: 25px;
        color: black;
     
      
        

    }



    @media only screen and (max-width: 768px) {
  
  .column2 {height: 450px;}
  .column4 {height: 160px;}
  .column6 {height: 160px;}
  .column7 {height: 620px;}
  
}

@media only screen and (max-width: 375px) {
  
  .column2 {height: 920px ;}
  body {
  
   
    font-size: 12px !important;
    font-weight: 300 !important;
    line-height: 1;
  
}
  .column4 {height: 290px;}
  .column6 {height: 290px;}
  .column7 {height: 950px;}
  
}

@media only screen and (min-width: 1024px) {
  
  .column2 {height: 410px;}
  .column4 {height: 140px;}
  .column6 {height: 140px;}
  .column7 {height: 520px;}
  
}

@media only screen and (min-width: 1368px) {
  
  .column2 {height: 350px;}
  .column4 {height: 110px;}
  .column6 {height: 110px;}
  .column7 {height: 500px;}
  
}



    /* a:-webkit-any-link {
        color: #136acd;
        cursor: pointer;
        text-decoration: none;
        font-weight: normal;
    } */

</style>
@stack('head_css_end')
@section('content')

  <div>

    <div class="row1">
        <div class="column1">
            <h1>Get the big picture</h1>
            <p >How much profit are you making? Are your assets growing faster than your liabilities? Is cash flowing, or getting stuck?</p>
        </div>
        <div class="column2" >
            <div>
                <h2>
                    <?php
                    $currentYear = date('Y');
                    $currentDate = date('Y-m-d');
                    ?>
                    <a href="{{ url('report/profitAndLoss/'.$currentYear.'-01-01/'.$currentDate.'/1') }}">
                        Profit & Loss (Income Statement)
                    </a>
                </h2>

                <p >Summary of your revenue and expenses that determine the profit you made.</p>
                <hr>
            </div>

            <div>
                <h2>
                    <a href="#">
                        Balance Sheet
                    </a>
                </h2>

                <p >Snapshot of what your business owns or is due to receive from others (assets), what it owes to others (liabilities), and what you've invested or retained in your company (equity).</p>
                
            </div>

           

        </div>
    </div>

    <div class="row1">
        <div class="column3">
            <h1>Stay on top of taxes</h1>
            <p style=>Find out how much tax you’ve collected and how much tax you owe back to tax agencies.</p>
        </div>
        <div class="column4" >
            <div>
                <h2>
                    <a href="{{ url('report/salesTaxReport/'.$currentYear.'-01-01/'.$currentDate.'/1') }}">
                        Sales Tax
                    </a>
                </h2>

                <p >Taxes collected from sales and paid on purchases to help you file sales tax returns.</p>

            </div>




        </div>
    </div>

    <div class="row1">
        <div class="column5">
            <h1>Focus on customers</h1>
            <p >Find out how much tax you’ve collected and how much tax you owe back to tax agencies.</p>
        </div>
        <div class="column6" >
            <div>
                 <h2>
                    <a href="{{ url('report/incomeByCustomer/'.$currentYear.'-01-01/'.$currentDate) }}">

                        Income by Customer

                    </a>
                </h2>

                <p >Paid or unpaid income broken down by customer.</p>
            
            </div>

            



        </div>
    </div>

    <div class="row1">
        <div class="column5">
            <h1>Focus on vendors</h1>
            <p >Understand business spending, where you spend, and how much you owe to your vendors.</p>
        </div>
        <div class="column6" >
            <div>
                 <h2>
                    <a href="{{ url('report/purchaseByVendor/'.$currentYear.'-01-01/'.$currentDate) }}">

                        Purchases by Vendor


                    </a>
                </h2>

                <p >Business purchases, broken down by who you bought from.</p>
               
            </div>

           



        </div>
    </div>

    <div class="row1">
        <div class="column1">
            <h1>Dig deeper</h1>
            <p >Drill into the detail of financial transactions over the life of your company.</p>
        </div>
        <div class="column7" >
            <div>
                <h2>
                    <a href="{{ route('reports.account_balance') }}">

                        Account Balances

                    </a>
                </h2>

                <p >Summary view of balances and activity for all accounts.</p>
                <hr>
            </div>

            <div>
                <h2>
                    <a href="#">


                        Trial Balance

                    </a>
                </h2>

                <p >Balance of all your accounts on a specified date.</p>
                <hr>
            </div>

            <div>
                <h2>
                    <a href="#">
                        Account Transactions (General Ledger)

                    </a>
                </h2>

                <p >Detailed list of all transactions and their total by account everything in your Chart of Accounts.</p>

            </div>

        </div>
    </div>
</div> 

{{--    <div class="row mb-4">--}}
{{--        @foreach($categories as $name => $reports)--}}
{{--            <div class="col-md-12">--}}
{{--                <h3>{{ $name }}</h3>--}}
{{--            </div>--}}

{{--            @foreach($reports as $report)--}}
{{--                <div class="col-md-4">--}}
{{--                    <div class="card card-stats">--}}
{{--                        <span>--}}
{{--                            <div class="dropdown card-action-button">--}}
{{--                                <a class="btn btn-sm items-align-center py-2 mr-0 shadow-none--hover" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                                    <i class="fa fa-ellipsis-v text-primary"></i>--}}
{{--                                </a>--}}
{{--                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">--}}
{{--                                    <a class="dropdown-item" href="{{ route('reports.edit', $report->id) }}">{{ trans('general.edit') }}</a>--}}
{{--                                    @permission('create-common-reports')--}}
{{--                                        <div class="dropdown-divider"></div>--}}
{{--                                        <a class="dropdown-item" href="{{ route('reports.duplicate', $report->id) }}">{{ trans('general.duplicate') }}</a>--}}
{{--                                    @endpermission--}}
{{--                                    @permission('delete-common-reports')--}}
{{--                                        <div class="dropdown-divider"></div>--}}
{{--                                        {!! Form::deleteLink($report, 'common/reports') !!}--}}
{{--                                    @endpermission--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </span>--}}

{{--                        <div class="card-body">--}}
{{--                            <div class="row">--}}
{{--                                <div class="col">--}}
{{--                                    <a href="{{ route('reports.show', $report->id) }}">--}}
{{--                                        <h5 class="card-title text-uppercase text-muted mb-0">{{ $report->name }}</h5>--}}
{{--                                        <h2 class="font-weight-bold mb-0">{{ $totals[$report->id] }}</h2>--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                                <div class="col-auto">--}}
{{--                                    <a href="{{ route('reports.show', $report->id) }}">--}}
{{--                                        <div class="icon icon-shape bg-orange text-white rounded-circle shadow">--}}
{{--                                            <i class="{{ $icons[$report->id] }}"></i>--}}
{{--                                        </div>--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <p class="mt-3 mb-0 text-sm">--}}
{{--                                <a class="text-default" href="{{ route('reports.show', $report->id) }}">--}}
{{--                                    <span class="pre">{{ $report->description }}</span>--}}
{{--                                </a>--}}
{{--                            </p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            @endforeach--}}

{{--        @endforeach--}}
{{--    </div>--}}
{{--<?php //echo $report->render(); ?>--}}
{{--    <form action="{{ route('report.nishan') }}" method="POST">--}}
{{--        @csrf--}}
{{--        <input type="text" name="name" />--}}
{{--        <input type="submit" value="Submit" />--}}
{{--    </form>--}}

{{--    {!! Form::open([ 'route' => 'report.nishan']) !!}--}}
{{--     {{ Form::token() }}--}}
{{--    {{  Form::text('email', 'example@gmail.com')  }}--}}
{{--    {{  Form::submit('Click Me!') }}--}}
{{--    {!! Form::close() !!}--}}
@endsection

@push('scripts_start')
    <script src="{{ asset('public/js/common/reports.js?v=' . version('short')) }}"></script>
@endpush

