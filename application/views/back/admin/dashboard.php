<link rel="stylesheet" href="<?php echo base_url(); ?>template/back/amcharts/style.css" type="text/css">
<script src="<?php echo base_url(); ?>template/back/amcharts/amcharts.js" type="text/javascript"></script>
<script src="https://www.amcharts.com/lib/3/serial.js"></script>
<script src="<?php echo base_url(); ?>template/back/amcharts/pie.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>template/back/plugins/gauge-js/gauge.min.js"></script>


<div id="content-container">
    <div id="page-title">
        <h1 class="page-header text-overflow"><?php echo translate('dashboard'); ?></h1>
    </div>
    <div id="page-content">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="col-md-3 col-sm-6" onclick="load_link('<?php echo base_url(); ?>admin/news');">
                    <div class="panel panel-dark panel-colorful">
                        <div class="pad-all media">
                            <div class="media-left">
                                <span class="icon-wrap icon-wrap-xs">
                                    <i class="fa fa-file-text fa-3x"></i>
                                </span>
                            </div>
                            <div class="media-body">
                                <p class="h3 text-thin media-heading">
                                    <?php
                                        $total = $this->db->get('news')->num_rows();
                                        $published = $this->db->get_where('news',array('status'=>'published'))->num_rows();

                                        $this->db->where('status',NULL);
                                        $this->db->or_where('status','unpublished');
                                        $unpublished = $this->db->get('news')->num_rows();
                                        echo $total;
                                    ?>
                                </p>
                                <small class="text-uppercase"><?php echo translate('total_live_news'); ?></small>
                            </div>
                        </div>

                        <div class="progress progress-xs progress-dark-base mar-no">
                            <div role="progressbar" aria-valuenow="<?php echo $published; ?>" aria-valuemin="0" aria-valuemax="<?php echo $total; ?>" class="progress-bar progress-bar-light" style="width: 100%"></div>
                        </div>

                        <div class="pad-all text-right panel_button">
                            <small><span class="text-semibold"><i class="fa fa-unlock-alt fa-fw"></i> <?php echo $unpublished; ?> </span> <?php echo translate('unpublished_news'); ?></small>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6" onclick="load_link('<?php echo base_url(); ?>admin/news_archive');">
                    <div class="panel panel-dark panel-colorful">
                        <div class="pad-all media">
                            <div class="media-left">
                                <span class="icon-wrap icon-wrap-xs">
                                    <i class="fa fa-archive fa-3x"></i>
                                </span>
                            </div>
                            <div class="media-body">
                                <p class="h3 text-thin media-heading">
                                    <?php
                                        $total = $this->db->get('news_archive')->num_rows();
                                        $published = $this->db->get_where('news_archive',array('status'=>'published'))->num_rows();

                                        $this->db->where('status',NULL);
                                        $this->db->or_where('status','unpublished');
                                        $unpublished = $this->db->get('news_archive')->num_rows();

                                        //$unpublished = $this->db->get_where('news_archive',array('status !='=>'published'))->num_rows();
                                        echo $total;
                                    ?>
                                </p>
                                <small class="text-uppercase"><?php echo translate('total_archived_news'); ?></small>
                            </div>
                        </div>

                        <div class="progress progress-xs progress-dark-base mar-no">
                            <div role="progressbar" aria-valuenow="<?php echo $published; ?>" aria-valuemin="0" aria-valuemax="<?php echo $total; ?>" class="progress-bar progress-bar-light" style="width: 100%"></div>
                        </div>

                        <div class="pad-all text-right panel_button">
                            <small><span class="text-semibold"><i class="fa fa-unlock-alt fa-fw"></i> <?php echo $unpublished; ?> </span> <?php echo translate('unpublished_archived_news'); ?></small>
                        </div>
                    </div>
                </div>


                <div class="col-md-3 col-sm-6" onclick="load_link('<?php echo base_url(); ?>admin/ads_settings');">
                    <div class="panel panel-dark panel-colorful">
                        <div class="pad-all media">
                            <div class="media-left">
                                <span class="icon-wrap icon-wrap-xs">
                                    <i class="fa fa-bullhorn fa-3x"></i>
                                </span>
                            </div>
                            <div class="media-body">
                                <p class="h3 text-thin media-heading">
                                    <?php
                                        $total = $this->db->get('advertisement')->num_rows();
                                        $published = $this->db->get_where('advertisement',array('availability !='=>'available'))->num_rows();
                                        $unpublished = $this->db->get_where('advertisement',array('availability'=>'available'))->num_rows();
                                        echo $total;
                                    ?>
                                </p>
                                <small class="text-uppercase"><?php echo translate('total_advertisements'); ?></small>
                            </div>
                        </div>

                        <div class="progress progress-xs progress-dark-base mar-no">
                            <div role="progressbar" aria-valuenow="<?php echo $published; ?>" aria-valuemin="0" aria-valuemax="<?php echo $total; ?>" class="progress-bar progress-bar-light" style="width: 100%"></div>
                        </div>

                        <div class="pad-all text-right panel_button">
                            <small><span class="text-semibold"><i class="fa fa-unlock-alt fa-fw"></i> <?php echo $unpublished; ?> </span> <?php echo translate('unrented_advertisements'); ?></small>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6" onclick="load_link('<?php echo base_url(); ?>admin/photo');">
                    <div class="panel panel-dark panel-colorful">
                        <div class="pad-all media">
                            <div class="media-left">
                                <span class="icon-wrap icon-wrap-xs">
                                    <i class="fa fa-film fa-3x"></i>
                                </span>
                            </div>
                            <div class="media-body">
                                <p class="h3 text-thin media-heading">
                                    <?php
                                        $total_video = $this->db->get('video')->num_rows();
                                        $total_audio = $this->db->get('audio')->num_rows();
                                        $total_photo = $this->db->get('photo')->num_rows();
                                        $published_video = $this->db->get_where('video',array('status'=>'published'))->num_rows();
                                        $published_audio = $total_audio;
                                        $published_photo = $this->db->get_where('photo',array('status'=>'published'))->num_rows();
                                        $unpublished_video = $this->db->get_where('video',array('status !='=>'published'))->num_rows();
                                        $unpublished_audio = 0;
                                        $unpublished_photo = $this->db->get_where('photo',array('status !='=>'published'))->num_rows();
                                        $total = $total_video+$total_audio+$total_photo;
                                        $published = $published_video+$published_audio+$published_photo;
                                        $unpublished = $unpublished_video+$unpublished_audio+$unpublished_photo;
                                        echo $total;
                                    ?>
                                </p>
                                <small class="text-uppercase"><?php echo translate('total_media_uploads'); ?></small>
                            </div>
                        </div>

                        <div class="progress progress-xs progress-dark-base mar-no">
                            <div role="progressbar" aria-valuenow="<?php echo $published; ?>" aria-valuemin="0" aria-valuemax="<?php echo $total; ?>" class="progress-bar progress-bar-light" style="width: 100%"></div>
                        </div>

                        <div class="pad-all text-right panel_button">
                            <small><span class="text-semibold"><i class="fa fa-unlock-alt fa-fw"></i> <?php echo $unpublished; ?> </span> <?php echo translate('unpublished_media_uploads'); ?></small>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="col-md-12 col-sm-12">
                    <div class="panel panel-light panel-colorful">
                        <div class="panel-heading">
                            <h3 class="panel-title"><?php echo translate('category_wise_news'); ?></h3>
                        </div>
                        <div class="pad-all media">
                            <div id="category_products"></div>
                            <div>
                                <table id="demo-table" class="table table-striped"  data-pagination="true" data-show-refresh="true" data-ignorecol="0,2" data-show-toggle="true" data-show-columns="false" data-search="true" >
                                    <thead>
                                        <tr>
                                            <th data-align="center"><?php echo translate('no'); ?></th>
                                            <th data-align="center"><?php echo translate('name'); ?></th>
                                            <th data-align="center"><?php echo translate('number_of_news'); ?></th>
                                        </tr>
                                    </thead>

                                    <tbody >
                                        <?php
                                        $i = 0;
                                        $all_categories = $this->db->get('news_category')->result_array();
                                        foreach ($all_categories as $row) {
                                            $i++;
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $i; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['name']; ?>
                                                </td>
                                                <td>
                                                    <?php
                                                        $archived = $this->db->get_where('news_archive',array('news_category_id'=>$row['news_category_id']))->num_rows();
                                                        $live = $this->db->get_where('news',array('news_category_id'=>$row['news_category_id']))->num_rows();
                                                        echo $archived+$live;
                                                    ?>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div>
</div>

<script type="text/javascript">
    var user_type = 'admin';
</script>

<style>
    #map-container {
        padding: 6px;
        border-width: 1px;
        border-style: solid;
        border-color: #ccc #ccc #999 #ccc;
        -webkit-box-shadow: rgba(64, 64, 64, 0.5) 0 2px 5px;
        -moz-box-shadow: rgba(64, 64, 64, 0.5) 0 2px 5px;
        box-shadow: rgba(64, 64, 64, 0.1) 0 2px 5px;
        width: 100%;
    }
    #map {
        width: 100%;
        height: 400px;
    }
    #map1 {
        width: 100%;
        height: 400px;
    }
    #actions {
        list-style: none;
        padding: 0;
    }
    #inline-actions {
        padding-top: 10px;
    }
    .item {
        margin-left: 20px;
    }
    #user_packages {
        width: 100%;
        height: 300px;
        margin: auto;
    }
    #product_packages {
        width: 100%;
        height: 300px;
        margin: auto;
    }
    /*
    #category_products{
        width		: 100%;
        height		: 435px;
        font-size	: 11px;
    }
    */
</style>
<?php
$total_ads = $this->db->get('news')->num_rows();
$total_ads_published = $this->db->get_where('news', array('status' => 'published'))->num_rows();
$total_ads_unpublished = $this->db->get_where('news', array('status' => 'unpublished'))->num_rows();
?>
<script>
    function load_link(url){
        location.replace(url);
    }


    $(document).ready(function () {
/*
        var chart = AmCharts.makeChart("category_products", {
            "theme": "none",
            "type": "serial",
            "startDuration": 2,
            "dataProvider": [
<?php
$category = $this->db->get('news_category')->result_array();
foreach ($category as $row) {
    $num_user_category = $this->db->get_where('news', array('news_category_id' => $row['news_category_id']))->num_rows();
    ?>
                    {
                        "country": "<?php echo $row['name']; ?>",
                        "visits": <?php echo $num_user_category; ?>,
                        "color": "#99bdf9"
                    },
    <?php
}
?>
            ],
            "valueAxes": [{
                    "position": "left",
                    "title": "Visitors"
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
                "labelRotation": 90
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



        var opts_total_ads = {
            lines: 10, // The number of lines to draw
            angle: 0, // The length of each line
            lineWidth: 0.3, // The line thickness
            pointer: {
                length: 0.45, // The radius of the inner circle
                strokeWidth: 0.035, // The rotation offset
                color: '#242d3c' // Fill color
            },
            limitMax: 'true', // If true, the pointer will not go past the end of the gauge
            colorStart: '#177bbb', // Colors
            colorStop: '#177bbb', // just experiment with them
            strokeColor: '#ceefff', // to see which ones work best for you
            generateGradient: true
        };

        var target = document.getElementById('total_ads_gauge'); // your canvas element
        var gauge = new Gauge(target).setOptions(opts_total_ads); // create sexy gauge!
        gauge.maxValue = <?php echo round(($total_ads * 110) / 100); ?>; // set max gauge value
        gauge.animationSpeed = 32; // set animation speed (32 is default value)
        gauge.set(<?php echo $total_ads; ?>); // set actual value
        gauge.setTextField(document.getElementById("total_ads_gauge_txt"));


        var opts_total_ads_published = {
            lines: 10, // The number of lines to draw
            angle: 0, // The length of each line
            lineWidth: 0.3, // The line thickness
            pointer: {
                length: 0.45, // The radius of the inner circle
                strokeWidth: 0.035, // The rotation offset
                color: '#242d3c' // Fill color
            },
            limitMax: 'true', // If true, the pointer will not go past the end of the gauge
            colorStart: '#06a53e', // Colors
            colorStop: '#06a53e', // just experiment with them
            strokeColor: '#caffdd', // to see which ones work best for you
            generateGradient: true
        };

        var target = document.getElementById('total_ads_published_gauge'); // your canvas element
        var gauge = new Gauge(target).setOptions(opts_total_ads_published); // create sexy gauge!
        gauge.maxValue = <?php echo ($total_ads); ?>; // set max gauge value
        gauge.animationSpeed = 32; // set animation speed (32 is default value)
        gauge.set(<?php echo $total_ads_published; ?>); // set actual value
        gauge.setTextField(document.getElementById("total_ads_published_gauge_txt"));


        var opts_total_ads_unpublished = {
            lines: 10, // The number of lines to draw
            angle: 0, // The length of each line
            lineWidth: 0.3, // The line thickness
            pointer: {
                length: 0.45, // The radius of the inner circle
                strokeWidth: 0.035, // The rotation offset
                color: '#242d3c' // Fill color
            },
            limitMax: 'true', // If true, the pointer will not go past the end of the gauge
            colorStart: '#BB0000', // Colors
            colorStop: '#BB0000', // just experiment with them
            strokeColor: '#ffdbdb', // to see which ones work best for you
            generateGradient: true
        };

        var target = document.getElementById('total_ads_unpublished_gauge'); // your canvas element
        var gauge = new Gauge(target).setOptions(opts_total_ads_unpublished); // create sexy gauge!
        gauge.maxValue = <?php echo ($total_ads); ?>; // set max gauge value
        gauge.animationSpeed = 32; // set animation speed (32 is default value)
        gauge.set(<?php echo $total_ads_unpublished; ?>); // set actual value
        gauge.setTextField(document.getElementById("total_ads_unpublished_gauge_txt"));

    });

    (function () {

        function init() {
            var speed = 300,
                    easing = mina.backout;

            [].slice.call(document.querySelectorAll('#grid > a')).forEach(function (el) {
                var s = Snap(el.querySelector('svg')), path = s.select('path'),
                        pathConfig = {
                            from: path.attr('d'),
                            to: el.getAttribute('data-path-hover')
                        };

                el.addEventListener('mouseenter', function () {
                    path.animate({'path': pathConfig.to}, speed, easing);
                });

                el.addEventListener('mouseleave', function () {
                    path.animate({'path': pathConfig.from}, speed, easing);
                });
            });
        }

        //init();

    })();
*/
</script>
