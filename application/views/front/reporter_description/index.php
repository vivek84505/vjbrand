<?php
$reporter_detail_page = json_decode($this->Crud_model->get_settings_value('ui_settings', 'reporter_detail_page', 'value'), true);
?>
<!-- CONTENT AREA -->
<div class="content-area">
    <!-- PAGE WITH SIDEBAR -->
    <section class="page-section with-sidebar reporter pad-t-15">
        <div class="container">
            <div class="row mar-lr--5">
                <!-- SIDEBAR -->
                <?php include 'sidebar.php'; ?>
                <!-- /SIDEBAR -->
                <!-- CONTENT -->
                <div class="col-md-9 content pad-lr-5" id="content">
                    <span class="btn btn-theme-transparent pull-left hidden-lg hidden-md" style="position:relative; z-index:100;padding: 5px 12px; border-radius:4px;width: 100%; margin-bottom: 15px;" onClick="open_sidebar();">
                        <i class="fa fa-bars"></i>
                    </span>
                    <!-- Blog post -->
                    <?php
                        foreach ($reporter_description as $row) {
                            $img = json_decode($row['image'], true);
                            foreach ($img as $rows) {
                                $main = $rows['img'];
                                $thumb = $rows['thumb'];
                            }
                    ?>
                        <ol class="breadcrumb breadcrumb-custom mar-b-15">
                            <li class="hidden-sm hidden-xs">
                                <a href="<?php echo base_url(); ?>">
                                    <i class="fa fa-home"></i>
                                </a>
                            </li>
                            <li class="hidden-sm hidden-xs">
                                <a href="<?php echo base_url(); ?>home/reporters">
                                    <?php echo translate('all_reporters'); ?>
                                </a>
                            </li>
                            <li class="active hidden-sm hidden-xs">
                                <span>
                                    <?php echo $row['name']; ?>
                                </span>
                            </li>
                        </ol>
                        <article class="post-wrap post-single box_shadow mar-lr-0">
                            <div class="post-media">
                                <div class="row mar-lr--5">
                                    <div class="col-md-4 pad-lr-5">
                                        <div class="row mar-lr--5">
                                            <div class="col-md-12 pad-lr-5">
                                                <?php
                                                    if (file_exists('uploads/news_reporter_image/' . $thumb)) {
                                                ?>
                                                    <center>
                                                        <img class="img-thumbnail img-responsive image_delay" style="width:300px;" src="<?php echo img_loading(); ?>" data-src="<?php echo base_url(); ?>uploads/news_reporter_image/<?php echo $thumb; ?>"  />
                                                    </center>
                                                <?php
                                                    } else {
                                                ?>
                                                    <center>
                                                        <img class="img-thumbnail img-responsive image_delay" style="width:300px;" src="<?php echo img_loading(); ?>" data-src="<?php echo base_url(); ?>uploads/others/default_image.png">

                                                    </center>
                                                <?php
                                                    }
                                                ?>
                                            </div>
                                            <div class="col-md-12 pad-lr-5 wishlist">
                                                <table class="table" style="font-size:12px;">
                                                    <tbody>
                                                        <tr>
                                                            <th>
                                                                <?php echo translate('name'); ?> : 
                                                                <span><?php echo $row['name']; ?></span>
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th>
                                                                <?php echo translate('designation'); ?> : 
                                                                <span><?php echo $row['designation']; ?></span>
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th>
                                                                <?php echo translate('email'); ?> : 
                                                                <span><?php echo $row['email'] ?></span>
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th>
                                                                <?php echo translate('contact'); ?> : 
                                                                <span><?php echo $row['phone'] ?></span>
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <td class="reporter_box_1" style="padding:7px 0px; border-bottom:none;">
                                                                <ul class="social-icons" style="margin-top:0px;">
                                                                    <?php
                                                                        $socials = json_decode($row['social_account'], true);
                                                                        foreach ($socials as $sa) {
                                                                            if (!empty($sa['value'])) {
                                                                    ?>
                                                                            <li>
                                                                                <a href="<?php echo $sa['value']; ?>" class="<?php echo $sa['type']; ?>" target="_blank">
                                                                                    <i class="fa fa-<?php echo $sa['type']; ?>"></i>
                                                                                </a>
                                                                            </li>
                                                                    <?php
                                                                            }
                                                                        }
                                                                    ?>
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-md-12 pad-lr-5 mar-t-10">
                                                <h2 class="block-title">
                                                    <span>
                                                        <?php echo translate('about'); ?>
                                                    </span>
                                                </h2>
                                                <div class="about_box">
                                                    <?php echo $row['about']; ?>
                                                </div>
                                            </div>
                                            <div class="col-md-12 pad-lr-5 mar-t-5">
                                                <div class="thumbnail no-border no-padding thumbnail-banner size-1x3" style="height:auto;">
                                                    <div class="media">
                                                        <div class="media-link">
                                                            <div class="caption text-left">
                                                                <div class="caption-wrapper div-table">
                                                                    <div class="caption-inner div-cell">
                                                                        <h3 class="caption-sub-title">
                                                                            <span>
                                                                                <?php echo translate('total_uploads'); ?> : 
                                                                                <?php echo $this->db->get_where('news', array('news_reporter_id' => $row['news_reporter_id']))->num_rows(); ?>
                                                                            </span>
                                                                        </h3>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 pad-lr-5 mar-t-5">
                                                <div class="thumbnail no-border no-padding thumbnail-banner size-1x3" style="height:auto;">
                                                    <div class="media">
                                                        <div class="media-link">
                                                            <div class="caption text-left">
                                                                <div class="caption-wrapper div-table">
                                                                    <div class="caption-inner div-cell">
                                                                        <h3 class="caption-sub-title">
                                                                            <span>
                                                                                <?php echo translate('last_month_uploads'); ?> : 
                                                                                <?php
                                                                                $query = $this->db->query("select * from news where month(date) = month(NOW()) and news_reporter_id = '" . $row['news_reporter_id'] . "' ");
                                                                                echo $query->num_rows();
                                                                                ?>
                                                                            </span>
                                                                        </h3>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8 pad-lr-5">
                                        <div class="row mar-lr--5">
                                            <div class="col-md-12 pad-lr-5 mar-t-5">
                                                <h2 class="block-title">
                                                    <span>
                                                        <?php echo translate('latest_news_of') . ' ' . $row['name']; ?>
                                                    </span>
                                                </h2>
                                                <div class="row mar-lr--5">
                                                    <?php
                                                        foreach ($reporter_news as $rowww) {
                                                    ?>
                                                        <div class="col-md-12 pad-lr-0 mar-t-5">
                                                            <?php
                                                            echo $this->Html_model->news_box('rect_sm', '1', $rowww);
                                                            ?>
                                                        </div>
                                                    <?php
                                                        }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
                    <?php
                        }
                    ?>
                    <!-- /advertisement space -->
                    <div class="advertise_space2">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <?php echo $this->Html_model->advertise_rect('reporter_detail_2'); ?>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <?php echo $this->Html_model->advertise_rect('reporter_detail_3'); ?>
                            </div>
                        </div>
                    </div>
                    <!-- /advertisement space -->
                    <?php
                        echo $this->Html_model->bottom_part($reporter_detail_page['page_bottom']);
                    ?>
                </div>
            </div>
        </div>
    </section>
    <!-- /PAGE WITH SIDEBAR -->
</div>
<!-- /CONTENT AREA -->
<script>
    $(document).ready(function () {
        setTimeout(function () {
            close_sidebar();
            set_news_box();
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
    function set_news_box() {
        var max_height_img = 0;
        $('.news_box_sqr_1 img').each(function () {
            var current_height_img = parseInt($(this).css('height'));
            if (current_height_img >= max_height_img) {
                max_height_img = current_height_img;
            }
        });
        $('.news_box_sqr_1 img').css('height', max_height_img);

        var max_height = 0;
        $('.news_box_sqr_1').each(function () {
            var current_height = parseInt($(this).css('height'));
            if (current_height >= max_height) {
                max_height = current_height;
            }
        });
        $('.news_box_sqr_1').css('height', max_height);
    }
</script>
<style>
    table span{
        font-weight: 400 !important;
    }
    .reporter .social-icons a:hover {
        color:inherit;
    }
</style>
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