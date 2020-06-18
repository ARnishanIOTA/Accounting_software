<div id="widget-{{ $class->model->id }}" class="{{ $class->model->settings->width }}">
    <div class="card bg-gradient-danger card-stats">
        @include($class->views['header'], ['header_class' => 'border-bottom-0'])

        <div class="card-body">
            <div class="row">
                <div class="col">
                    <h5 class="font-16">{{ $class->model->name }}</h5>
                    <span class="font-weight-bold setColor  mb-0 font-25">{{ $totals['grand'] }}</span>
                </div>

                <div class="col-auto">
                    <div class="income-icon">
                        <i class="fas fa-wallet setColor setFwIcon"></i>
                    </div>
                </div>
            </div>

            <p class="mt-3 mb-0 text-sm cursor-default">
            <span class="<?php if($trending == 'trending_up'){ echo 'text-danger';}else{ echo 'text-success'; }?> mr-2">
                        <span class="material-icons font-16">{{ $trending }}</span> <span class="font-13"> {{ $ratio }}%  </span> </span><span>Since last month</span>
            </p>

{{--            <p class="mt-3 mb-0 text-sm cursor-default">--}}
{{--                <span class="text-white">{{ trans('widgets.payables') }}</span>--}}
{{--                <el-tooltip--}}
{{--                content="{{ trans('widgets.open_bills') }}: {{ $totals['open'] }} / {{ trans('widgets.overdue_bills') }}: {{ $totals['overdue'] }}"--}}
{{--                effect="dark"--}}
{{--                :open-delay="100"--}}
{{--                placement="top">--}}
{{--                    <span class="text-white font-weight-bold float-right">{{ $totals['open'] }} / {{ $totals['overdue'] }}</span>--}}
{{--                </el-tooltip>--}}
{{--            </p>--}}
        </div>
    </div>
</div>
