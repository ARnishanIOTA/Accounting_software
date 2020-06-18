<div id="widget-{{ $class->model->id }}" class="{{ $class->model->settings->width }}">
    <div class="card bg-gradient-info card-stats">
        @include($class->views['header'], ['header_class' => 'border-bottom-0'])
        @if($class->model->name == 'Total Purchases')

            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="font-16">{{ $class->model->name }}</h5>
                        <span class="font-weight-bold setColor  mb-0 font-25">{{ $totals['grand'] }}</span>
                    </div>

                    <div class="col-auto">
                        <div class="income-icon">
                            <i class="flaticon-cart setColor setMargin"></i>
                        </div>
                    </div>
                </div>
                <p class="mt-3 mb-0 text-sm cursor-default">
                    <span class="text-danger mr-2">
                        <span class="material-icons font-16">trending_down</span> <span class="font-13"> 6.28%  </span> </span><span>Since last month</span>
                </p>

                {{--                <p class="mt-3 mb-0 text-sm cursor-default">--}}
                {{--                    <span class="">{{ trans('widgets.receivables') }}</span>--}}
                {{--                    <el-tooltip--}}
                {{--                            content="{{ trans('widgets.open_invoices') }}: {{ $totals['open'] }} / {{ trans('widgets.overdue_invoices') }}: {{ $totals['overdue'] }}"--}}
                {{--                            effect="dark"--}}
                {{--                            :open-delay="100"--}}
                {{--                            placement="top">--}}
                {{--                        <span class="font-weight-bold float-right">{{ $totals['open'] }} / {{ $totals['overdue'] }}</span>--}}
                {{--                    </el-tooltip>--}}
                {{--                </p>--}}

            </div>

        @else

            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="font-16">{{ $class->model->name }}</h5>
                        <span class="font-weight-bold setColor  mb-0 font-25">{{ $totals['grand'] }}</span>
                    </div>

                    <div class="col-auto">
                        <div class="income-icon">
                            <i class="flaticon-money-bag setColor setMargin"></i>
                        </div>
                    </div>
                </div>
                <p class="mt-3 mb-0 text-sm cursor-default">
                    <span class="<?php if($trending == 'trending_up'){ echo 'text-success';}else{ echo 'text-danger'; }?> mr-2">
                        <span class="material-icons font-16">{{ $trending }}</span> <span class="font-13"> {{ $ratio }}%  </span> </span><span>Since last month</span>
                </p>

{{--                <p class="mt-3 mb-0 text-sm cursor-default">--}}
{{--                    <span class="">{{ trans('widgets.receivables') }}</span>--}}
{{--                    <el-tooltip--}}
{{--                            content="{{ trans('widgets.open_invoices') }}: {{ $totals['open'] }} / {{ trans('widgets.overdue_invoices') }}: {{ $totals['overdue'] }}"--}}
{{--                            effect="dark"--}}
{{--                            :open-delay="100"--}}
{{--                            placement="top">--}}
{{--                        <span class="font-weight-bold float-right">{{ $totals['open'] }} / {{ $totals['overdue'] }}</span>--}}
{{--                    </el-tooltip>--}}
{{--                </p>--}}

            </div>

        @endif
    </div>
</div>
