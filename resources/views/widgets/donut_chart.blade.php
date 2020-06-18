<div id="widget-{{ $class->model->id }}" class="{{ $class->model->settings->width }}">
    <div class="card box-shadow">
        @include($class->views['header'])
        <style>
            .chart-donut{
                width: 100%;
                height: 100%;
                margin: 0;
                padding: 0;
            }
        </style>

        <div class="card-body" id="widget-donut-{{ $class->model->id }}">
            <div class="chart-donut" id="<?php echo $idName;?>">
             <?php //echo $title;?>
              {{--                {!! $chart->container() !!}--}}

            </div>
        </div>
    </div>
</div>

<script>

    anychart.onDocumentReady(function () {
        // create pie chart with passed data
        // var chart = anychart.pie([
        //     ['Rouge', 80540],
        //     ['Foundation', 94190],
        //     ['Mascara', 102610],
        //     ['Lip gloss', 110430],
        //     ['Lipstick', 128000],
        //     ['Nail polish', 143760],
        //     ['Demo', 243760]
        // ]);
        var chart = anychart.pie([
            <?php echo $Data;?>
        ]);

        // create range color palette with color ranged between light blue and dark blue
        var palette = anychart.palettes.rangeColors();
        palette.items([{ color: '#64b5f6' }, { color: '#455a64' }]);

        // set chart title text settings
        chart
            .title('ACME corp. sales chart. The share of products.')
            // set chart radius
            .innerRadius('40%')
            // set palette to the chart
            .palette(palette);

        // set container id for the chart

        chart.container(<?php echo $idName;?>);
        // initiate chart drawing
        chart.draw();
    });

</script>

@push('body_scripts')
    {!! $chart->script() !!}
@endpush
