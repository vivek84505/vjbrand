<!-- CONTENT AREA -->
<?php
$listing_news_data = json_decode($this->Crud_model->get_settings_value('ui_settings', 'listing_news', 'value'), true);
?>
<input type="hidden" value="<?php echo $news_category; ?>" id="cat" />
<input type="hidden" value="<?php echo $news_sub_category; ?>" id="subcat" />
<input type="hidden" value="<?php if (isset($start_date)) { echo $start_date; } ?>" id="st_date" />
<input type="hidden" value="<?php if (isset($end_date)) { echo $end_date; } ?>" id="en_date" />
<input type="hidden" value="<?php if (isset($header_search_text)) { echo $header_search_text; } ?>" id="header_search_text" />
<div class="content-area">
    <!-- PAGE WITH SIDEBAR -->
    <section class="page-section with-sidebar pad-t-15">
        <div class="container">
            <div class="row mar-lr--5">
                <?php include 'sidebar.php'; ?>
                <!-- CONTENT -->
                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 content pad-lr-5" id="content">
                    <span class="btn btn-theme-transparent pull-left hidden-lg hidden-md" style="width:100%; padding: 5px 12px; border-radius:4px;" onClick="open_sidebar();">
                        <i class="fa fa-bars"></i>
                    </span>
                    <div id="intro" class="hidden-sm hidden-xs">
                    </div>
                    <div class="news_content" id="result">

                    </div>
                    <!-- /advertisement space -->
                    <div class="advertise_space2">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pad-t-15">
                                <?php echo $this->Html_model->advertise_rect('news_list_2'); ?>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pad-t-15">
                                <?php echo $this->Html_model->advertise_rect('news_list_3'); ?>
                            </div>
                        </div>
                    </div>
                    <!-- /advertisement space -->
                    <?php
                        echo $this->Html_model->bottom_part($listing_news_data['page_bottom']);
                    ?>
                </div>
                <!-- /CONTENT -->
            </div>
        </div>
    </section>
    <!-- /PAGE WITH SIDEBAR -->
</div>
<!-- /CONTENT AREA-->
<script>
    $(document).ready(function () {
        setTimeout(function () {
            close_sidebar();
            set_category_news_box();
        }, 500);
    });
    function open_sidebar() {
        $('.sidebar').removeClass('close_now');
        $('.sidebar').addClass('open');
    }
    function close_sidebar() {
        $('.sidebar').removeClass('open');
        $('.sidebar').addClass('close_now');
    }
    function set_category_news_box() {
        var max_height = 0;
        $('.sp_news_tab2 .news_list').each(function () {
            var current_height = parseInt($(this).css('height'));
            if (current_height >= max_height) {
                max_height = current_height;
            }
        });
        $('.sp_news_tab2 .news_list').css('height', max_height);
    }
</script>
<style>
    .sidebar.close_now{
        position: relative;
        left:0px;
        opacity:1;
    }
    @media(max-width: 991px) {
        .sidebar.open{
            opacity:1;
            position: fixed;
            z-index: 9999;
            top: -30px;
            background: #f5f5f5;
            height: 100vh;
            overflow-y: auto;
            padding-top: 50px;
            left:0px;
            overflow-x: hidden;
            transition: all .6s ease-out;
        }
        .sidebar.close_now{
            position: fixed;
            left:-500px;
            opacity:0;
        }
        .view_select_btn{
            margin-top: 10px !important;
        }
    }
</style>
