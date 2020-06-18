<div id="widget-{{ $class->model->id }}" class="{{ $class->model->settings->width }}">
    <div class="card box-shadow">
        @include($class->views['header'])
        <div class="card-body" id="widget-line-{{ $class->model->id }}">
            <div class="chart" id="lineChart" >
                <?php // echo $title;?>
{{--                {!! $chart->container() !!}--}}
            </div>
        </div>
    </div>
</div>
{{-- JavaScript For Any Chart --}}
<script>

    anychart.onDocumentReady(function () {
        // set chart theme
        anychart.theme('lightBlue');
        // create data set on our data
        var dataSet = anychart.data.set(getData());

        // map data for the first series, take x from the zero area and value from the first area of data set
        var firstSeriesData = dataSet.mapAs({ x: 0, value: 1 });

        // map data for the second series, take x from the zero area and value from the second area of data set
        var secondSeriesData = dataSet.mapAs({ x: 0, value: 2 });

        // map data for the third series, take x from the zero area and value from the third area of data set
        var thirdSeriesData = dataSet.mapAs({ x: 0, value: 3 });

        // map data for the third series, take x from the zero area and value from the third area of data set
        var fourthSeriesData = dataSet.mapAs({ x: 0, value: 4 });

        // create area chart
        var chart = anychart.area();

        // turn on chart animation
        chart.animation(true);

        // turn on the crosshair
        var crosshair = chart.crosshair();
        crosshair.enabled(true).yLabel(false).yStroke(null).xStroke('#fff');

        // set chart title text settings
        chart.title(
            'Company Income Profit & Expense Data Flow'
        );

        // set interactivity and tooltips settings
        chart.interactivity().hoverMode('by-x');
        chart.tooltip().displayMode('union');

        // set Y axis title
        chart.yAxis(0).title('Cash flow of your company');

        // set custom formatter for Y axis labels
        chart.yAxis(0).labels().format('{%Value}$');

        // create additional xAxis to place category labels on top
        chart.xAxis(1).orientation('top');

        // create additional xAxis to place category labels on top
        chart.yAxis(1).orientation('right').labels(false);

        chart.tooltip().format('{%SeriesName}: {%Value}$');

        // helper function to setup label settings for all series
        var setupSeries = function (series, name) {
            series.name(name);
            series.markers().zIndex(100);
            series
                .hovered()
                .markers()
                .enabled(true)
                .type('circle')
                .size(4)
                .stroke('1.5 #fff');
        };

        // temp variable to store series instance
        var series;

        // create first series with mapped data
        series = chart.area(firstSeriesData);
        setupSeries(series, 'Total Income');

        // create second series with mapped data
        series = chart.area(secondSeriesData);
        setupSeries(series, 'Total Profit');

        // create third series with mapped data
        series = chart.area(thirdSeriesData);
        setupSeries(series, 'Total Expenses');


        // turn on legend
        chart.legend().enabled(true).fontSize(13).padding([0, 0, 20, 0]);

        // enable grids
        chart.yGrid().stroke('#ddd');
        chart.xGrid().stroke('#ddd');

        // set container id for the chart
        chart.container('lineChart');

        // initiate chart drawing
        chart.draw();
    });

    function getData() {
        return [
           <?php echo $Data;?>
        ];
    }

</script>
{{-- End JavaScript For Any Chart --}}
{{--@push('body_scripts')--}}
{{--    {!! $chart->script() !!}--}}
{{--@endpush--}}
