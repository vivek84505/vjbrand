<!-- CONTENT AREA -->
<?php
    $discus_id = $this->db->get_where('third_party_settings', array('type' => 'discus_id'))->row()->value;
    $fb_id = $this->db->get_where('third_party_settings', array('type' => 'fb_comment_api'))->row()->value;
    $comment_type = $this->db->get_where('third_party_settings', array('type' => 'comment_type'))->row()->value;
    $news_description_data = json_decode($this->Crud_model->get_settings_value('ui_settings', 'news_description', 'value'), true);
?>
<div class="content-area">
    <!-- PAGE WITH SIDEBAR -->
    <section class="page-section with-sidebar pad-t-15">
        <div class="container">
            <div class="row mar-lr--5">
                <!-- SIDEBAR -->
                <?php include 'sidebar.php'; ?>
                <!-- /SIDEBAR -->
                <!-- CONTENT -->
                <div class="col-md-9 pad-lr-5 content" id="content">
                    <span class="btn btn-theme-transparent pull-left hidden-lg hidden-md mob-con" style="position:relative; z-index:100;padding: 5px 12px; border-radius:4px;width: 100%; margin-bottom: 15px;" onClick="open_sidebar();">
                        <i class="fa fa-bars"></i>
                    </span>
                    <!-- Blog post -->
                    <?php
                    foreach ($news_description as $rows) {
                        $img = json_decode($rows['img_features'], true);
                        $i = sizeof($img);
                    ?>
                        <ol class="hidden-sm hidden-xs breadcrumb breadcrumb-custom">
                            <li>
                                <a href="<?php echo base_url(); ?>">
                                    <i class="fa fa-home"></i>
                                </a>
                            </li>
                            <li class="active">
                                <a href="<?php echo base_url(); ?>home/news/<?php echo $rows['news_category_id']; ?>/0">
                                    <?php echo $this->Crud_model->get_type_name_by_id('news_category', $rows['news_category_id']); ?>
                                </a>
                            </li>
                            <?php
                            if ($rows['news_sub_category_id'] !== '0') {
                                ?>
                                <li class="active">
                                    <a href="<?php echo base_url(); ?>home/news/<?php echo $rows['news_category_id']; ?>/<?php echo $rows['news_sub_category_id']; ?>">
                                        <?php echo $this->Crud_model->get_type_name_by_id('news_sub_category', $rows['news_sub_category_id']); ?>
                                    </a>
                                </li>
                                <?php
                            }
                            ?>
                        </ol>
                        <article class="post-wrap post-single box_shadow mar-lr-0 mar-t-10">
                            <div class="post-header">
                                <h2 class="post-title">
                                    <?php echo $rows['title']; ?>
                                </h2>
                                <div class="post-meta to_show">
                                    <span> <?php if($news_mood == "news"){ ?>
                                        <a href="<?php echo base_url(); ?>home/news/0/0/<?php echo date("Y-m-d", $rows['date']); ?>/<?php echo date("Y-m-d", $rows['date']); ?>">
                                            <i class="fa fa-clock-o"></i>
                                            <?php echo date("F j, Y", $rows['date']); ?>
                                        </a>
                                        <?php }else{ ?>
                                        <a href="<?php echo base_url(); ?>home/archive_news/0/0/<?php echo date("Y-m-d", $rows['date']); ?>/<?php echo date("Y-m-d", $rows['date']); ?>">
                                            <i class="fa fa-clock-o"></i>
                                            <?php echo date("F j, Y", $rows['date']); ?>
                                        </a>
                                        <?php } ?>
                                    </span>
                                    <span class="divider">|</span>
                                    <span>
                                        <?php echo translate('reported_by'); ?> :
                                        <a href="<?php echo $this->Crud_model->reporter_link($rows['news_reporter_id']); ?>">
                                            <?php echo $this->Crud_model->get_type_name_by_id('news_reporter', $rows['news_reporter_id']); ?>
                                        </a>
                                    </span>
                                </div>
                                <div class="post-meta print" style="display:none;">
                                    <span>
                                        <i class="fa fa-clock-o"></i>
                                        <?php echo date("F j, Y", $rows['date']); ?>
                                    </span>
                                    <span class="divider">|</span>
                                    <span>
                                        <?php echo translate('reported_by'); ?> :
                                        <?php echo $this->Crud_model->get_type_name_by_id('news_reporter', $rows['news_reporter_id']); ?>
                                    </span>
                                </div>
                            </div>
                            <div class="post-media">
                                <?php
                                if ($i > 1) {
                                    ?>
                                    <div class="owl-carousel img-carousel">
                                        <?php
                                            foreach ($img as $row) {
                                                ?>
                                                <div class="item">
                                                    <?php
                                                    if (file_exists('uploads/news_image/' . $row['thumb'])) {
                                                        ?>
                                                        <span onClick="image_modal('<?php echo base_url(); ?>uploads/news_image/<?php echo $row['img']; ?>');">
                                                            <div class="item-image cursorPointer image_delay" data-src="<?php echo base_url(); ?>uploads/news_image/<?php echo $row['img']; ?>"  style="background-image:url('<?php echo img_loading(); ?>')"></div>
                                                        </span>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <span onClick="image_modal('<?php echo base_url(); ?>uploads/news_image/default.jpg');">
                                                            <div class="item-image cursorPointer image_delay" data-src="<?php echo base_url(); ?>uploads/news_image/default.jpg"  style="background-image:url('<?php echo img_loading(); ?>')"></div>
                                                        </span>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                                <?php
                                            }
                                        ?>
                                    </div>
                                    <?php
                                } else {
                                        ?>
                                        <span onClick="image_modal('<?php echo base_url(); ?>uploads/news_image/<?php echo $img[0]['img']; ?>');">
                                            <img class="img-thumbnail img-responsive cursorPointer image_delay" src="<?php echo img_loading(); ?>" data-src="<?php echo base_url(); ?>uploads/news_image/<?php echo $img[0]['img']; ?>"  />
                                        </span>
                                        <?php
                                }
                                ?>
                            </div>
                            <div class="post-control">
                                <div class="visitor">
                                    <?php echo translate('total_views'); ?> :
                                    <?php echo number_format($rows['view_count']); ?>
                                </div>
                                <div class="controls">
                                    <span class="zoom-in" data-toggle="tooltip" title="<?php echo translate('zoom_in'); ?>" data-placement="bottom" >
                                        <img class="img-responsive" src="<?php echo base_url(); ?>uploads/others/ZoomIn-icon.png" alt="<?php echo translate('zoom_in'); ?>" />
                                    </span>
                                    <span class="zoom-out" data-toggle="tooltip" title="<?php echo translate('zoom_out'); ?>" data-placement="bottom" >
                                        <img class="img-responsive" src="<?php echo base_url(); ?>uploads/others/ZoomOut-icon.png" alt="<?php echo translate('zoom_out'); ?>" />
                                    </span>
                                    <span class="read-later" onclick="to_readlater(<?php echo $news_id; ?>, event)"  data-toggle="tooltip" title="<?php echo translate('read_later'); ?>" data-placement="bottom" >
                                        <img class="img-responsive" src="<?php echo base_url(); ?>uploads/others/Read-later.png" alt="<?php echo translate('read_later'); ?>" />
                                    </span>
                                    <span class="print" onClick="print_news();" data-toggle="tooltip" title="<?php echo translate('print'); ?>" data-placement="bottom" >
                                        <img class="img-responsive" src="<?php echo base_url(); ?>uploads/others/Print-icon.png" alt="<?php echo translate('print'); ?>" />
                                    </span>
                                </div>
                            </div>
                            <div class="post-body">
                                <div class="post-excerpt">
                                    <p class="text-summary">
                                        <?php echo $rows['summary']; ?>
                                    </p>
                                </div>
                            </div>
                            <div class="post-body">
                                <div class="post-excerpt">
                                    <p class="text-description">
                                        <?php echo $rows['description']; ?>
                                    </p>
                                </div>
                            </div>
                            <div class="post-body social_share">
                                <div id="share"></div>
                            </div>
                        </article>
                        <!-- /Blog post -->

                        <!-- PAGE -->
                        <section class="page-section no-padding-bottom box_shadow mar-lr-0 comments">
                            <?php if ($comment_type == 'disqus') { ?>
                                <div id="disqus_thread"></div>
                                <script type="text/javascript">
                                    /* * * CONFIGURATION VARIABLES * * */
                                    var disqus_shortname = '<?php echo $discus_id; ?>';

                                    /* * * DON'T EDIT BELOW THIS LINE * * */
                                    (function () {
                                        var dsq = document.createElement('script');
                                        dsq.type = 'text/javascript';
                                        dsq.async = true;
                                        dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
                                        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
                                    })();
                                </script>
                                <script type="text/javascript">
                                    /* * * CONFIGURATION VARIABLES * * */
                                    var disqus_shortname = '<?php echo $discus_id; ?>';

                                    /* * * DON'T EDIT BELOW THIS LINE * * */
                                    (function () {
                                        var s = document.createElement('script');
                                        s.async = true;
                                        s.type = 'text/javascript';
                                        s.src = '//' + disqus_shortname + '.disqus.com/count.js';
                                        (document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
                                    }());
                                </script>
                                <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>
                                <?php
                            } else if ($comment_type == 'facebook') {
                                ?>

                                <div id="fb-root"></div>
                                <script>(function (d, s, id) {
                                        var js, fjs = d.getElementsByTagName(s)[0];
                                        if (d.getElementById(id))
                                            return;
                                        js = d.createElement(s);
                                        js.id = id;
                                        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4&appId=<?php echo $fb_id; ?>";
                                        fjs.parentNode.insertBefore(js, fjs);
                                    }(document, 'script', 'facebook-jssdk'));</script>
                                <div class="fb-comments" data-href="<?php echo $this->Crud_model->news_link($news_id); ?>" data-numposts="5"></div>

                                <?php
                            }
                        }
                        ?>

                    </section>
                    <!-- /PAGE -->
                    <!-- /advertisement space -->
                    <div class="advertise_space2">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pad-t-15">
                                <?php echo $this->Html_model->advertise_rect('news_description_2'); ?>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pad-t-15">
                                <?php echo $this->Html_model->advertise_rect('news_description_3'); ?>
                            </div>
                        </div>
                    </div>
                    <!-- /advertisement space -->
                    <div class="bottom_part">
                        <?php
                        echo $this->Html_model->bottom_part($news_description_data['page_bottom']);
                        ?>
                    </div>
                </div>
                <!-- /CONTENT -->
            </div>
        </div>
    </section>
    <!-- /PAGE WITH SIDEBAR -->
</div>
<!-- /CONTENT AREA -->
<script>
    $(document).ready(function () {
        close_sidebar();
        $('#share').share({
            networks: ['facebook', 'googleplus', 'twitter', 'linkedin', 'tumblr', 'in1', 'stumbleupon', 'digg'],
            theme: 'square'
        });
    });
    $('.zoom-in').on('click', function (e) {
        var summary = parseFloat($('.text-summary').css('font-size'));
        var summary_line = parseFloat($('.text-summary').css('line-height'));

        var description = parseFloat($('.text-description').css('font-size'));
        var description_line = parseFloat($('.text-description').css('line-height'));

        if (summary <= 42) {
            summary = summary + 1;
            summary_line = summary_line + 1;

            description = description + 1;
            description_line = description_line + 1;
        }

        $('.text-summary').css('font-size', summary + 'px');
        $('.text-summary').css('line-height', summary_line + 'px');

        $('.text-description').css('font-size', description + 'px');
        $('.text-description').css('line-height', description_line + 'px');
    });

    $('.zoom-out').on('click', function (e) {
        var summary = parseFloat($('.text-summary').css('font-size'));
        var summary_line = parseFloat($('.text-summary').css('line-height'));

        var description = parseFloat($('.text-description').css('font-size'));
        var description_line = parseFloat($('.text-description').css('line-height'));

        if (summary >= 16) {
            summary = summary - 1;
            summary_line = summary_line - 1;

            description = description - 1;
            description_line = description_line - 1;
        }

        $('.text-summary').css('font-size', summary + 'px');
        $('.text-summary').css('line-height', summary_line + 'px');

        $('.text-description').css('font-size', description + 'px');
        $('.text-description').css('line-height', description_line + 'px');
    });
    function open_sidebar() {
        $('.sidebar').removeClass('close_now');
        $('.sidebar').addClass('open');
    }
    function close_sidebar() {
        $('.sidebar').removeClass('open');
        $('.sidebar').addClass('close_now');
    }
</script>
<style>
    .post-meta i{
        margin-right:5px;
    }
</style>
<script>
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });

    function print_news() {
        window.print();
    }
</script>
<style type="text/css">
    @media print {
        .top-bar,
        header,
        footer,
        aside,
        .post-control,
        .breadcrumb,
        .bottom_part,
        .to-top,
        .advertise,
        .comments,
        .social_share,
        #marquee_section,
        .post-meta.to_show,
        .advertise_space2,
        .mob-con{
            display: none !important;
        }
        .post-meta.print{
            display: block !important;
        }
        .invoice{
            padding: 0px;
        }
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
