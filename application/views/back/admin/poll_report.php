<script src="<?php echo base_url(); ?>template/back/amcharts/amcharts.js"></script>
<script src="<?php echo base_url(); ?>template/back/amcharts/funnel.js"></script>
<script src="<?php echo base_url(); ?>template/back/amcharts/themes/light.js"></script>



<div id="content-container">
    <div id="page-title">
        <h1 class="page-header text-overflow"><?php echo translate('NEWS VS SPECIALITY GRAPH'); ?></h1>
    </div>
    <div class="tab-base">
        <div class="panel">
            <div class="panel-body">
                <div class="tab-content">


                    <div id="chartdiv"></div>
                    <div class="container-fluid">
                        <div class="row text-center" style="overflow:hidden;">
                            <div class="col-sm-3" style=" ">
                                <label class="text-left">Angle:</label>
                                <input class="chart-input" data-property="angle" type="range" min="0" max="60" value="40" step="1"/>	
                            </div>

                            <div class="col-sm-3" style="float: none !important;display: inline-block;">
                                <label class="text-left">Depth:</label>
                                <input class="chart-input" data-property="depth3D" type="range" min="1" max="120" value="100" step="1"/>
                            </div>
                        </div>
                    </div>																							
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

    var chart = AmCharts.makeChart("chartdiv", {
        "type": "funnel",
        "theme": "light",
        "dataProvider": [{
                "title": "Website visits",
                "value": 200
            }, {
                "title": "Downloads",
                "value": 123
            }, {
                "title": "Requested price list",
                "value": 98
            }, {
                "title": "Contaced for more info",
                "value": 72
            }, {
                "title": "Purchased",
                "value": 35
            }, {
                "title": "Contacted for support",
                "value": 35
            }, {
                "title": "Purchased additional products",
                "value": 26
            }],
        "balloon": {
            "fixedPosition": true
        },
        "valueField": "value",
        "titleField": "title",
        "marginRight": 240,
        "marginLeft": 50,
        "startX": -500,
        "depth3D": 100,
        "angle": 40,
        "outlineAlpha": 1,
        "outlineColor": "#FFFFFF",
        "outlineThickness": 2,
        "labelPosition": "right",
        "balloonText": "[[title]]: [[value]]n[[description]]",
        "export": {
            "enabled": true
        }
    });
    jQuery('.chart-input').off().on('input change', function () {
        var property = jQuery(this).data('property');
        var target = chart;
        var value = Number(this.value);
        chart.startDuration = 0;

        if (property == 'innerRadius') {
            value += "%";
        }

        target[ property ] = value;
        chart.validateNow();
    });
</script>

<style type="text/css">
    #chartdiv {
        width		: 100%;
        height		: 435px;
        font-size	: 11px;
    }	

</style>