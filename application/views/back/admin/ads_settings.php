<div id="content-container">
    <div id="page-title">
        <h1 class="page-header text-overflow">
            <?php echo translate('manage_ad_settings') ?>
        </h1>
    </div>
    <div class="tab-base">
        <div class="panel">
            <div class="panel-heading">
                <h1 class="panel-title"><?php echo translate('page_wise_ad_settings'); ?></h1>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <!--Panel heading-->
                        <div class="tab-base tab-stacked-left">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a data-toggle="tab" href="#tabo-1"><?php echo translate('header'); ?></a>
                                </li>
                                <li class="">
                                    <a data-toggle="tab" href="#tabo-2"><?php echo translate('home'); ?></a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#tabo-3"><?php echo translate('news_description'); ?></a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#tabo-5"><?php echo translate('news_listing'); ?></a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#tabo-6"><?php echo translate('photo_gallery'); ?></a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#tabo-7"><?php echo translate('photo_description'); ?></a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#tabo-8"><?php echo translate('video_gallery'); ?></a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#tabo-9"><?php echo translate('video_description'); ?></a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#tabo-10"><?php echo translate('all_reporters'); ?></a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#tabo-11"><?php echo translate('reporter_details'); ?></a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#tabo-12"><?php echo translate('archive_news'); ?></a>
                                </li>
                            </ul>
                            <!--Tabs Content-->
                            <div class="tab-content">
                                <span id="ad_set"></span>
                                <div id="tabo-1" class="tab-pane fade active in">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php
                                            $this->Ads_model->show_ad_element('header_1');
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div id="tabo-2" class="tab-pane fade">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="panel outer">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <!--Panel heading-->
                                                        <div class="tab-base horizontal-tab">
                                                            <ul class="nav nav-tabs">
                                                                <li class="active">
                                                                    <a data-toggle="tab" href="#tabb-1"><?php echo translate('after_top_news'); ?></a>
                                                                </li>
                                                                <li>
                                                                    <a data-toggle="tab" href="#tabb-2"><?php echo translate('top_sliding_news'); ?></a>
                                                                </li>
                                                                <li>
                                                                    <a data-toggle="tab" href="#tabb-3"><?php echo translate('detail_news'); ?></a>
                                                                </li>
                                                                <li>
                                                                    <a data-toggle="tab" href="#tabb-4"><?php echo translate('photo_gallery'); ?></a>
                                                                </li>
                                                                <li>
                                                                    <a data-toggle="tab" href="#tabb-5"><?php echo translate('special_category_with_sidebar'); ?></a>
                                                                </li>
                                                                <li>
                                                                    <a data-toggle="tab" href="#tabb-6"><?php echo translate('video_gallery'); ?></a>
                                                                </li>
                                                                <li>
                                                                    <a data-toggle="tab" href="#tabb-7" style="padding-bottom:12px;"><?php echo translate('category_wise_news'); ?></a>
                                                                </li>
                                                            </ul>
                                                            <!--Tabs Content-->                    
                                                            <div class="tab-content">
                                                                <div id="tabb-1" class="tab-pane fade active in">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <?php
                                                                            $this->Ads_model->show_ad_element('home_1');
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12 form-horizontal">
                                                                            <?php
                                                                            $this->Ads_model->show_ad_element('home_2');
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div id="tabb-2" class="tab-pane fade">
                                                                    <div class="row">
                                                                        <div class="col-md-12 form-horizontal">
                                                                            <?php
                                                                            $this->Ads_model->show_ad_element('home_3');
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <?php
                                                                            $this->Ads_model->show_ad_element('home_4');
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div id="tabb-3" class="tab-pane fade">
                                                                    <div class="row">
                                                                        <div class="col-md-12 form-horizontal">
                                                                            <?php
                                                                            $this->Ads_model->show_ad_element('home_5');
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <?php
                                                                            $this->Ads_model->show_ad_element('home_6');
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <?php
                                                                            $this->Ads_model->show_ad_element('home_7');
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div id="tabb-4" class="tab-pane fade">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <?php
                                                                            $this->Ads_model->show_ad_element('home_8');
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <?php
                                                                            $this->Ads_model->show_ad_element('home_9');
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div id="tabb-5" class="tab-pane fade">
                                                                    <div class="row">
                                                                        <div class="col-md-12 form-horizontal">
                                                                            <?php
                                                                            $this->Ads_model->show_ad_element('home_10');
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <?php
                                                                            $this->Ads_model->show_ad_element('home_11');
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <?php
                                                                            $this->Ads_model->show_ad_element('home_12');
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div id="tabb-6" class="tab-pane fade">
                                                                    <div class="row">
                                                                        <div class="col-md-12 form-horizontal">
                                                                            <?php
                                                                            $this->Ads_model->show_ad_element('home_13');
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <?php
                                                                            $this->Ads_model->show_ad_element('home_14');
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div id="tabb-7" class="tab-pane fade">
                                                                    <div class="row">
                                                                        <div class="col-md-12 form-horizontal">
                                                                            <?php
                                                                            $this->Ads_model->show_ad_element('home_15');
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <?php
                                                                            $this->Ads_model->show_ad_element('home_16');
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div id="tabb-8" class="tab-pane fade">
                                                                    <div class="row">
                                                                        <div class="col-md-12 form-horizontal">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>     
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="tabo-3" class="tab-pane fade">
                                    <!-- 1st ad of news description page -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php
                                            $this->Ads_model->show_ad_element('news_description_1');
                                            ?>
                                        </div>
                                    </div>
                                    <!-- 2nd ad of news description page -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php
                                            $this->Ads_model->show_ad_element('news_description_2');
                                            ?>
                                        </div>
                                    </div>
                                    <!-- 3rd ad of news description page -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php
                                            $this->Ads_model->show_ad_element('news_description_3');
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div id="tabo-5" class="tab-pane fade">
                                    <!-- 1st ad of news list page -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php
                                            $this->Ads_model->show_ad_element('news_list_1');
                                            ?>
                                        </div>
                                    </div>
                                    <!-- 2nd ad of news list page -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php
                                            $this->Ads_model->show_ad_element('news_list_2');
                                            ?>
                                        </div>
                                    </div>
                                    <!-- 3rd ad of news list page -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php
                                            $this->Ads_model->show_ad_element('news_list_3');
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div id="tabo-6" class="tab-pane fade">
                                    <!-- 1st ad of photo gallery page -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php
                                            $this->Ads_model->show_ad_element('photo_gallery_1');
                                            ?>
                                        </div>
                                    </div>
                                    <!-- 2nd ad of photo gallery page -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php
                                            $this->Ads_model->show_ad_element('photo_gallery_2');
                                            ?>
                                        </div>
                                    </div>
                                    <!-- 3rd ad of photo gallery page -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php
                                            $this->Ads_model->show_ad_element('photo_gallery_3');
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div id="tabo-7" class="tab-pane fade">
                                    <!-- 1st ad of photo description page -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php
                                            $this->Ads_model->show_ad_element('photo_description_1');
                                            ?>
                                        </div>
                                    </div>
                                    <!-- 2nd ad of photo description page -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php
                                            $this->Ads_model->show_ad_element('photo_description_2');
                                            ?>
                                        </div>
                                    </div>
                                    <!-- 3rd ad of photo description page -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php
                                            $this->Ads_model->show_ad_element('photo_description_3');
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div id="tabo-8" class="tab-pane fade">
                                    <!-- 1st ad of video gallery page -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php
                                            $this->Ads_model->show_ad_element('video_gallery_1');
                                            ?>
                                        </div>
                                    </div>
                                    <!-- 2nd ad of video gallery page -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php
                                            $this->Ads_model->show_ad_element('video_gallery_2');
                                            ?>
                                        </div>
                                    </div>
                                    <!-- 3rd ad of video gallery page -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php
                                            $this->Ads_model->show_ad_element('video_gallery_3');
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div id="tabo-9" class="tab-pane fade">
                                    <!-- 1st ad of video description page -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php
                                            $this->Ads_model->show_ad_element('video_description_1');
                                            ?>
                                        </div>
                                    </div>
                                    <!-- 2nd ad of video description page -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php
                                            $this->Ads_model->show_ad_element('video_description_2');
                                            ?>
                                        </div>
                                    </div>
                                    <!-- 3rd ad of video description page -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php
                                            $this->Ads_model->show_ad_element('video_description_3');
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div id="tabo-10" class="tab-pane fade">
                                    <!-- 1st ad of all reporters page -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php
                                            $this->Ads_model->show_ad_element('all_reporter_1');
                                            ?>
                                        </div>
                                    </div>
                                    <!-- 2nd ad of all reporters page -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php
                                            $this->Ads_model->show_ad_element('all_reporter_2');
                                            ?>
                                        </div>
                                    </div>
                                    <!-- 3rd ad of all reporters page -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php
                                            $this->Ads_model->show_ad_element('all_reporter_3');
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div id="tabo-11" class="tab-pane fade">
                                    <!-- 1st ad of reporter detail page -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php
                                            $this->Ads_model->show_ad_element('reporter_detail_1');
                                            ?>
                                        </div>
                                    </div>
                                    <!-- 2nd ad of reporter detail page -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php
                                            $this->Ads_model->show_ad_element('reporter_detail_2');
                                            ?>
                                        </div>
                                    </div>
                                    <!-- 3rd ad of reporter detail page -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php
                                            $this->Ads_model->show_ad_element('reporter_detail_3');
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div id="tabo-12" class="tab-pane fade">
                                    <!-- 1st ad of archive news page -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php
                                            $this->Ads_model->show_ad_element('archive_news_1');
                                            ?>
                                        </div>
                                    </div>
                                    <!-- 2nd ad of archive news page -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php
                                            $this->Ads_model->show_ad_element('archive_news_2');
                                            ?>
                                        </div>
                                    </div>
                                    <!-- 3rd ad of archive news page -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php
                                            $this->Ads_model->show_ad_element('archive_news_3');
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="dummy_html" style="display:none;">
    <div class="form-group">
        <label class="col-sm-2 control-label"><?php echo translate('time'); ?> (<?php echo translate('in_days'); ?>) : </label>
        <div class="col-sm-3">
            <input type="number" class="form-control" name="time[]" value="" placeholder="<?php echo translate('enter time duration'); ?>">
        </div>
        <label class="col-sm-2 control-label" ><?php echo translate('amount'); ?> : </label>
        <div class="col-sm-3">
            <input type="number" class="form-control" name="amount[]" value="" placeholder="<?php echo translate('enter amount'); ?>">
        </div>
        <div class="col-sm-2"><span class="btn btn-danger btn-icon icon-lg fa fa-trash btn-remove"></span></div>
    </div>
</div>
<script>
    var base_url = '<?php echo base_url(); ?>'
    var user_type = 'admin';
    var module = 'ads_settings';
    var list_cont_func = '';
    var dlt_cont_func = '';

    $(document).ready(function () {
        $("form").submit(function (e) {
            return false;
        });

    });
    $(document).ready(function () {
        function readURL_all(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                var parent = $(input).closest('.form-group');
                reader.onload = function (e) {
                    parent.find('.wrap').hide('fast');
                    parent.find('.blah').attr('src', e.target.result);
                    parent.find('.wrap').show('fast');
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
        $(".tab-content").on('change', '.imgInp', function () {
            readURL_all(this);
        });
    });

</script>
<style>
    /*
    .tab-pane{
        margin-bottom: 200px;
    }*/
    .tab-stacked-left > .nav-tabs li:hover{
        border-left:2px solid #489eed;
        transition: all 0.4s ease;
    }
    .tab-stacked-left > .nav-tabs li{
        border-left:2px solid #ffffff;
    }
    .tab-stacked-left > .nav-tabs li.active{
        border-left:2px solid #489eed;
        transition: all 0.4s ease;
    }
    .tab-stacked-left > .nav-tabs li.active a{
        transition: all 0.4s ease;
    }
    .tab-stacked-left > .nav-tabs>li:not(.active) a:hover {
        border-color:#fff !important;
        transition: all 0.4s ease;
    }
    .panel.outer{
        border-top: 2px solid #a7a7a7;
    }
    .panel.page_space{
        padding: 50px 0;
    }
    .tab-stacked-left > .tab-content{
        background: #fafafa;
    }

    .tab-pane{
        margin-bottom: 200px;
    }
    .horizontal-tab{
        margin:15px;
    }
    .horizontal-tab .nav-tabs{
        border: 0;
        display:block !important;
        width:100%;
    }
    .horizontal-tab .nav-tabs li{
        float:left;
    }
    .horizontal-tab .nav-tabs li:hover{
        border-bottom:2px solid #489eed;
    }
    .horizontal-tab .nav-tabs li.active{
        border-bottom:2px solid #489eed;
    }
    .horizontal-tab .nav-tabs li.active a{
        background:#FFF;
    }
    .horizontal-tab .nav-tabs>li:not(.active) a:hover {
        border-color:#fff !important;
    }
    .horizontal-tab .tab-content{
        display:block !important;
    }
    .img_show{
        position:relative;
        height:400px;
        overflow:auto;
    }
    .img_show::-webkit-scrollbar{
        width: 3px;
        background: #737373;
    }
    .img_show::-webkit-scrollbar-thumb{
        background: #fff;
    }
    .img_show::-webkit-scrollbar{
        width: 3px;
        background: #737373;
    }
    .img_show::-webkit-scrollbar-thumb{
        background: #fff;
    }
    .home_title{
        display: block;
        text-align: center;
    }
    .home_title span i{
        opacity: 0;
    }
    .home_title.active span i{
        opacity: 1;
        color:#096;
    }
    .update_btn{
        padding: 0 10px;
        margin-top: 15px;
    }
</style>