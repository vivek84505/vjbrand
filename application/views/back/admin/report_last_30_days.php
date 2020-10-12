<link rel="stylesheet" href="<?php echo base_url(); ?>template/back/amcharts/style.css"	type="text/css">
<script src="<?php echo base_url(); ?>template/back/amcharts/amcharts.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>template/back/amcharts/serial.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>template/back/amcharts/amstock.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>template/back/amcharts/themes/light.js"></script>

<div id="content-container">
    <div id="page-title">
        <h1 class="page-header text-overflow"><?php echo translate('last_30_days_news_report'); ?></h1>
    </div>
    <div class="tab-base">
        <div class="panel">
            <div class="panel-body">
                <div class="tab-content">

                    <!-- LIST -->
                    <div class="tab-pane fade active in" id="last_month" style="border:1px solid #ebebeb; border-radius:4px;">
                    </div>

<!--                    <div class="row text-center" style="overflow:hidden;">
                        <div class="col-sm-3" style="float: none !important;display: inline-block;">
                            <label class="text-left">Angle:</label>
                            <input class="chart-input" data-property="angle" type="range" min="0" max="89" value="30" step="1"/>	
                        </div>

                        <div class="col-sm-3" style="float: none !important;display: inline-block;">
                            <label class="text-left">Depth:</label>
                            <input class="chart-input" data-property="depth3D" type="range" min="1" max="120" value="20" step="1"/>
                        </div>
                    </div>-->

                </div>
            </div>
        </div>
    </div>
</div>

<style>
    #last_month {
        width		: 100%;
        height		: 435px;
        font-size	: 11px;
    }										
</style>

<script>
    var base_url = '<?php echo base_url(); ?>'
    var user_type = 'admin';
    var module = 'report_date_wise_news';
    var list_cont_func = 'list';
    var dlt_cont_func = 'delete';

    var chart = AmCharts.makeChart("last_month", {
        "theme": "light",
        "type": "serial",
        "startDuration": 2,
        "dataProvider": [
<?php
    $news_cat = $this->db->get('news_category')->result_array();

    $time1 = time() - 2592000;
    foreach ($news_cat as $row) {
        $last_30 = $this->db->get_where('news', array('news_category_id' => $row['news_category_id']))->result_array();
        $c = 0;
        foreach ($last_30 as $row1) {
            //$days = strtotime($row1['date']);

            if ($row1['date'] >= $time1) {
                $c++;
            }
        }
?>
                {
                    "country": "<?php echo $row['name']; ?>",
                    "visits": "<?php echo $c; ?>",
                    "color": "#99BDF9"
                },
<?php
    }
?>
        ],
        "valueAxes": [{
                "position": "left",
                "title": "Number of News"
            }],
        "graphs": [{
                "balloonText": "[[category]]: <b>[[value]]</b>",
                "fillColorsField": "color",
                "fillAlphas": 1,
                "lineAlpha": 0.1,
                "type": "column",
                "valueField": "visits"
            }],
        "depth3D": 20,
        "angle": 30,
        "chartCursor": {
            "categoryBalloonEnabled": false,
            "cursorAlpha": 0,
            "zoomable": false
        },
        "categoryField": "country",
        "categoryAxis": {
            "gridPosition": "start",
            "labelRotation": 90,
            "position": "bottom",
            "title": "News Category Name",
        },
        "export": {
            "enabled": true
        }

    });
    jQuery('.chart-input').off().on('input change', function () {
        var property = jQuery(this).data('property');
        var target = chart;
        chart.startDuration = 0;

        if (property == 'topRadius') {
            target = chart.graphs[0];
            if (this.value == 0) {
                this.value = undefined;
            }
        }

        target[property] = this.value;
        chart.validateNow();
    });
</script>