<nav id="mainnav-container">
    <div id="mainnav">
        <!--Menu-->
        <div id="mainnav-menu-wrap">
            <div class="nano">
                <div class="nano-content" style="overflow-x:auto;">
                    <ul id="mainnav-menu" class="list-group">
                        <li class="list-header"></li>
                        <!--Menu list item-->
                        <li <?php if ($page_name == "dashboard") { ?> class="active-link" <?php } ?>
                                                                      style="border-top:1px solid rgba(69, 74, 84, 0.7);">
                            <a href="<?php echo base_url(); ?>admin/">
                                <i class="fa fa-tachometer"></i>
                                <span class="menu-title">
                                    <?php echo translate('dashboard'); ?>
                                </span>
                            </a>
                        </li>
                        <!-- Manage News Starts -->
                        <?php
                            if ($this->Crud_model->admin_permission('news_category') ||
                                    $this->Crud_model->admin_permission('news_sub_category') ||
                                    $this->Crud_model->admin_permission('news_speciality') ||
                                    $this->Crud_model->admin_permission('all_news') ||
                                    $this->Crud_model->admin_permission('news_archive')){
                                ?>
                                <li <?php
                                        if ($page_name == "category" ||
                                                $page_name == "sub_category" ||
                                                $page_name == "news_speciality" ||
                                                $page_name == "news" ||
                                                $page_name == "news_archive" ||
                                                $page_name == "news_bulk_add") {
                                    ?>
                                        class="active-sub"
                                    <?php } ?> >
                                    <a href="#">
                                        <i class="fa fa-folder"></i>
                                        <span class="menu-title">
                                            <?php echo translate('news'); ?>
                                        </span>
                                        <i class="fa arrow"></i>
                                    </a>
                                    <ul class="collapse <?php
                                    if ($page_name == "category" ||
                                            $page_name == "sub_category" ||
                                            $page_name == "news_speciality" ||
                                            $page_name == "news" ||
                                            $page_name == "news_archive" ||
                                            $page_name == 'news_serial' ||
                                            $page_name == "news_bulk_add" ) {
                                        ?>
                                            in
                                        <?php } ?>" >

                                        <?php
                                            if($this->Crud_model->admin_permission('news_category')) {
                                        ?>
                                            <li <?php if ($page_name == "category") { ?> class="active-link" <?php } ?> >
                                                <a href="<?php echo base_url(); ?>admin/category">
                                                    <i class="fa fa-circle fs_i"></i>
                                                    <?php echo translate('news_category'); ?>
                                                </a>
                                            </li>
                                        <?php
                                            }if ($this->Crud_model->admin_permission('news_sub_category')) {
                                        ?>
                                            <li <?php if ($page_name == "sub_category") { ?> class="active-link" <?php } ?> >
                                                <a href="<?php echo base_url(); ?>admin/sub_category">
                                                    <i class="fa fa-circle fs_i"></i>
                                                    <?php echo translate('news_sub-category'); ?>
                                                </a>
                                            </li>
                                        <?php
                                            } if($this->Crud_model->admin_permission('news_speciality')) {
                                        ?>
                                            <li <?php if ($page_name == "news_speciality") { ?> class="active-link" <?php } ?> >
                                                <a href="<?php echo base_url(); ?>admin/news_speciality">
                                                    <i class="fa fa-circle fs_i"></i>
                                                    <?php echo translate('news_speciality'); ?>
                                                </a>
                                            </li>
                                        <?php
                                            } if ($this->Crud_model->admin_permission('all_news')) {
                                        ?>
                                            <li <?php if ($page_name == "news") { ?> class="active-link" <?php } ?> >
                                                <a href="<?php echo base_url(); ?>admin/news">
                                                    <i class="fa fa-circle fs_i"></i>
                                                    <?php echo translate('all_news'); ?>
                                                </a>
                                            </li>
                                        <?php
                                            } if ($this->Crud_model->admin_permission('bulk_news_add')) {?>
                                            <li <?php if ($page_name == "news_bulk_add") { ?> class="active-link" <?php } ?> >
                                                <a href="<?php echo base_url(); ?>admin/news_bulk_add">
                                                    <i class="fa fa-circle fs_i"></i>
                                                    <?php echo translate('news_bulk_add'); ?>
                                                </a>
                                            </li>
                                        <?php } if ($this->Crud_model->admin_permission('news_archive')) {
                                        ?>
                                            <li <?php if ($page_name == "news_archive") { ?> class="active-link" <?php } ?> >
                                                <a href="<?php echo base_url(); ?>admin/news_archive">
                                                    <i class="fa fa-circle fs_i"></i>
                                                    <?php echo translate('archive_news'); ?>
                                                </a>
                                            </li>
                                        <?php
                                            }if ($this->Crud_model->admin_permission('news_serial')) {
                                        ?>
                                            <li <?php if ($page_name == "news_serial") { ?> class="active-link" <?php } ?> >
                                                <a href="<?php echo base_url(); ?>admin/news_serial">
                                                    <i class="fa fa-circle fs_i"></i>
                                                    <?php echo translate('news_serial'); ?>
                                                </a>
                                            </li>
                                        <?php
                                            }
                                        ?>
                                    </ul>
                                </li>

                                <?php
                            }
                        ?>
                        <!-- Manage News Ends -->

                        <!-- Media Starts -->
                        <?php
                            if ($this->Crud_model->admin_permission('media') ||
                                    $this->Crud_model->admin_permission('video') ||
                                    $this->Crud_model->admin_permission('audio') ||
                                    $this->Crud_model->admin_permission('photo')) {
                                ?>

                                <li <?php
                                if ($page_name == "video" ||
                                        $page_name == "audio" ||
                                        $page_name == "photo") {
                                    ?> class="active-sub" <?php } ?> >
                                    <a href="#">
                                        <i class="fa fa-newspaper-o"></i>
                                        <span class="menu-title">
                                            <?php echo translate('media'); ?>
                                        </span>
                                        <i class="fa arrow"></i>
                                    </a>
                                    <ul class="collapse <?php
                                    if ($page_name == "video" ||
                                            $page_name == "audio" ||
                                            $page_name == "photo") {
                                        ?> in <?php } ?>">
                                        <?php
                                        if ($this->Crud_model->admin_permission('photo')) {
                                            ?>
                                            <li <?php if ($page_name == "photo") { ?> class="active-link" <?php } ?>>
                                                <a href="<?php echo base_url(); ?>admin/photo">
                                                    <i class="fa fa-file-picture-o"></i>
                                                    <?php echo translate('photo_gallery'); ?>
                                                </a>
                                            </li>
                                            <?php
                                        }
                                        ?>
                                        <?php
                                        if ($this->Crud_model->admin_permission('video')) {
                                            ?>
                                            <li <?php if ($page_name == "video") { ?> class="active-link" <?php } ?> >
                                                <a href="<?php echo base_url(); ?>admin/video">
                                                    <i class="fa fa-file-video-o"></i>
                                                    <?php echo translate('video_gallery'); ?>
                                                </a>
                                            </li>
                                            <?php
                                        }
                                        ?>
                                    </ul>
                                </li>
                                <?php
                            }
                        ?>
                        <!-- Media Ends -->
                        <!-- Manage Blog Starts -->
                        <?php
                            if ($this->Crud_model->admin_permission('blog_category') ||
                                    $this->Crud_model->admin_permission('blog_sub_category') ||
                                    $this->Crud_model->admin_permission('blogs') ||
                                    $this->Crud_model->admin_permission('blog_gallery') ||
                                    $this->Crud_model->admin_permission('blog_videos')){
                                ?>
                                <li <?php
                                        if ($page_name == "blog_category" ||
                                                $page_name == "blog_sub_category" ||
                                                $page_name == "blog" ||
                                                $page_name == "blog_photo" ||
                                                $page_name == "blog_video" ||
                                                $page_name == "blog_post" ) {
                                    ?>
                                        class="active-sub"
                                    <?php } ?> >
                                    <a href="#">
                                        <i class="fa fa-folder"></i>
                                        <span class="menu-title">
                                            <?php echo translate('blog'); ?>
                                        </span>
                                        <i class="fa arrow"></i>
                                    </a>
                                    <ul class="collapse <?php
                                    if ($page_name == "blog_category" ||
                                            $page_name == "blog_sub_category" ||
                                            $page_name == "blog" ||
                                            $page_name == "blog_photo" ||
                                            $page_name == 'blog_video' ||
                                            $page_name == "blog_post" ) {
                                        ?>
                                            in
                                        <?php } ?>" >

                                        <?php
                                            if($this->Crud_model->admin_permission('blog_category')) {
                                        ?>
                                            <li <?php if ($page_name == "blog_category") { ?> class="active-link" <?php } ?> >
                                                <a href="<?php echo base_url(); ?>admin/blog_category">
                                                    <i class="fa fa-circle fs_i"></i>
                                                    <?php echo translate('blog_category'); ?>
                                                </a>
                                            </li>
                                        <?php
                                            }if ($this->Crud_model->admin_permission('blog_sub_category')) {
                                        ?>
                                            <li <?php if ($page_name == "blog_sub_category") { ?> class="active-link" <?php } ?> >
                                                <a href="<?php echo base_url(); ?>admin/blog_sub_category">
                                                    <i class="fa fa-circle fs_i"></i>
                                                    <?php echo translate('blog_sub-category'); ?>
                                                </a>
                                            </li>
                                        <?php
                                            } if($this->Crud_model->admin_permission('blogs')) {
                                        ?>
                                            <li <?php if ($page_name == "blog") { ?> class="active-link" <?php } ?> >
                                                <a href="<?php echo base_url(); ?>admin/blog">
                                                    <i class="fa fa-circle fs_i"></i>
                                                    <?php echo translate('blogs'); ?>
                                                </a>
                                            </li>
                                        <?php
                                            } if ($this->Crud_model->admin_permission('blog_gallery')) {
                                        ?>
                                            <li <?php if ($page_name == "blog_photo") { ?> class="active-link" <?php } ?> >
                                                <a href="<?php echo base_url(); ?>admin/blog_photo">
                                                    <i class="fa fa-circle fs_i"></i>
                                                    <?php echo translate('blog_gallery'); ?>
                                                </a>
                                            </li>
                                        <?php
                                            }if ($this->Crud_model->admin_permission('blog_videos')) {
                                        ?>
                                            <li <?php if ($page_name == "blog_video") { ?> class="active-link" <?php } ?> >
                                                <a href="<?php echo base_url(); ?>admin/blog_video">
                                                    <i class="fa fa-circle fs_i"></i>
                                                    <?php echo translate('blog_videos'); ?>
                                                </a>
                                            </li>
                                        <?php
                                    }if ($this->Crud_model->admin_permission('blog_post')) {
                                        ?>
                                            <li <?php if ($page_name == "blog_post") { ?> class="active-link" <?php } ?> >
                                                <a href="<?php echo base_url(); ?>admin/blog_post">
                                                    <i class="fa fa-circle fs_i"></i>
                                                    <?php echo translate('blog_post'); ?>
                                                </a>
                                            </li>
                                        <?php
                                            }
                                        ?>
                                    </ul>
                                </li>

                                <?php
                            }
                        ?>
                        <!-- Manage Blog Ends -->

                        <!--  Poll Starts  -->
                        <?php
                            if ($this->Crud_model->admin_permission('poll')) {
                                ?>
                                <li <?php if ($page_name == "poll") { ?> class="active-link" <?php } ?>>
                                    <a href="<?php echo base_url(); ?>admin/poll/">
                                        <i class="fa fa-list-alt"></i>
                                        <span class="menu-title">
                                            <?php echo translate('poll'); ?>
                                        </span>
                                    </a>
                                </li>
                                <?php
                            }
                        ?>
                        <!-- Poll Ends -->

                        <li <?php
                            if ($page_name == "report" ||
                                    $page_name == "report_wish" ||
                                    $page_name == "report_most_viewed") {
                                ?>
                                    class="active-sub"
                                <?php } ?> >
                            <a href="#">
                                <i class="fa fa-file-text"></i>
                                <span class="menu-title">
                                    <?php echo translate('reports'); ?>
                                </span>
                                <i class="fa arrow"></i>
                            </a>
                            <!-- REPORT -->
                            <ul class="collapse <?php
                                if ($page_name == "report" ||
                                        $page_name == "report_wish" ||
                                        $page_name == "report_date_wise_news" ||
                                        $page_name == "report_last_30_days" ||
                                        $page_name == "report_most_viewed") {
                                    ?>
                                        in
                                    <?php } ?> ">
                                <li <?php if ($page_name == "report") { ?> class="active-link" <?php } ?> >
                                    <a href="<?php echo base_url(); ?>admin/report/">
                                        <i class="fa fa-circle fs_i"></i>
                                        <?php echo translate('category_news_report'); ?>
                                    </a>
                                </li>
                                <li <?php if ($page_name == "report_most_viewed") { ?> class="active-link" <?php } ?> >
                                    <a href="<?php echo base_url(); ?>admin/report_most_viewed/">
                                        <i class="fa fa-circle fs_i"></i>
                                        <?php echo translate('most_viewed_news_report'); ?>
                                    </a>
                                </li>
                                <li <?php if ($page_name == "report_date_wise_news") { ?> class="active-link" <?php } ?> >
                                    <a href="<?php echo base_url(); ?>admin/report_date_wise_news">
                                        <i class="fa fa-circle fs_i"></i>
                                        <?php echo translate('date_wise_news_report'); ?>
                                    </a>
                                </li>
                                <li <?php if ($page_name == "report_last_30_days") { ?> class="active-link" <?php } ?> >
                                    <a href="<?php echo base_url(); ?>admin/report_last_30_days/">
                                        <i class="fa fa-circle fs_i"></i>
                                        <?php echo translate('last_30_days_news_report'); ?>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <?php if ($this->Crud_model->admin_permission('news_reporter')) { ?>
                                <li <?php if ($page_name == "news_reporter") { ?> class="active-link" <?php } ?>>
                                    <a href="<?php echo base_url(); ?>admin/news_reporter/">
                                        <i class="fa fa-male"></i>
                                        <span class="menu-title">
                                            <?php echo translate('news_reporter'); ?>
                                        </span>
                                    </a>
                                </li>
                            <?php } ?>

                        <!-- Manage User Starts -->
                        <?php
                            if ($this->Crud_model->admin_permission('user')) {
                                ?>
                                <li <?php if ($page_name == "user") { ?> class="active-link" <?php } ?>>
                                    <a href="<?php echo base_url(); ?>admin/user/">
                                        <i class="fa fa-user"></i>
                                        <span class="menu-title">
                                            <?php echo translate('manage_user'); ?>
                                        </span>
                                    </a>
                                </li>
                                <?php
                            }
                        ?>
                        <!-- Manage User Ends -->

                        <!-- Support Ticket Starts -->
                        <!-- <?php
                            if ($this->Crud_model->admin_permission('ticket')) {
                                ?>
                                <li <?php if ($page_name == "ticket") { ?> class="active-link" <?php } ?>>
                                    <a href="<?php echo base_url(); ?>admin/ticket/">
                                        <i class="fa fa-life-ring"></i>
                                        <span class="menu-title">
                                            <?php echo translate('support_ticket'); ?>
                                        </span>
                                    </a>
                                </li>
                                <?php
                            }
                        ?> -->
                        <!-- Support Ticket Ends -->

                        <!-- Messaging Starts -->
                        <?php
                            if ($this->Crud_model->admin_permission('newsletter') ||
                                    $this->Crud_model->admin_permission('contact_message')) {
                                ?>
                                <li <?php
                                if ($page_name == "newsletter" ||
                                        $page_name == "contact_message") {
                                    ?>
                                        class="active-sub"
                                    <?php } ?> >
                                    <a href="#">
                                        <i class="fa fa-envelope"></i>
                                        <span class="menu-title">
                                            <?php echo translate('messaging'); ?>
                                        </span>
                                        <i class="fa arrow"></i>
                                    </a>
                                    <ul class="collapse <?php if ($page_name == "newsletter" || $page_name == "contact_message") { ?> in <?php } ?>" >
                                        <?php
                                        if ($this->Crud_model->admin_permission('newsletter')) {
                                            ?>
                                            <li <?php if ($page_name == "newsletter") { ?> class="active-link" <?php } ?> >
                                                <a href="<?php echo base_url(); ?>admin/newsletter">
                                                    <i class="fa fa-circle fs_i"></i>
                                                    <?php echo translate('newsletters'); ?>
                                                </a>
                                            </li>
                                            <?php
                                        }
                                        ?>
                                        <?php
                                        if ($this->Crud_model->admin_permission('contact_message')) {
                                            ?>
                                            <li <?php if ($page_name == "contact_message") { ?> class="active-link" <?php } ?> >
                                                <a href="<?php echo base_url(); ?>admin/contact_message">
                                                    <i class="fa fa-circle fs_i"></i>
                                                    <?php echo translate('contact_messages'); ?>
                                                </a>
                                            </li>
                                            <?php
                                        }
                                        ?>
                                    </ul>
                                </li>
                                <?php
                            }
                        ?>
                        <?php
                            if ($this->Crud_model->admin_permission('role') ||
                                    $this->Crud_model->admin_permission('admin')) {
                                ?>
                                <li <?php if ($page_name == "role" || $page_name == "admin") { ?> class="active-sub" <?php } ?> >
                                    <a href="#">
                                        <i class="fa fa-users"></i>
                                        <span class="menu-title">
                                            <?php echo translate('staffs_panel'); ?>
                                        </span>
                                        <i class="fa arrow"></i>
                                    </a>

                                    <ul class="collapse <?php if ($page_name == "admin" || $page_name == "role") { ?> in <?php } ?>" >
                                        <?php if ($this->Crud_model->admin_permission('admin')) { ?>
                                            <li <?php if ($page_name == "admin") { ?> class="active-link" <?php } ?> >
                                                <a href="<?php echo base_url(); ?>admin/admins/">
                                                    <i class="fa fa-circle fs_i"></i>
                                                    <?php echo translate('all_staffs'); ?>
                                                </a>
                                            </li>
                                        <?php } ?>

                                        <?php if ($this->Crud_model->admin_permission('role')) { ?>
                                            <li <?php if ($page_name == "role") { ?> class="active-link" <?php } ?> >
                                                <a href="<?php echo base_url(); ?>admin/role/">
                                                    <i class="fa fa-circle fs_i"></i>
                                                    <?php echo translate('manage_roles'); ?>
                                                </a>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </li>
                            <?php } ?>
                        <!-- Messaging Ends -->
                        <!-- Manage Ads Starts -->
                        <?php
                            if ($this->Crud_model->admin_permission('advertisement')) {
                                ?>
                                <li <?php if ($page_name == "post_ad" || $page_name == "promo_ad" || $page_name == "ad_payment_list" || $page_name == "ongoing_ads" || $page_name == "google_adsense_settings" || $page_name == "ads_settings") { ?> class="active-sub" <?php } ?>>
                                    <a href="#">
                                        <i class="fa fa-bullhorn"></i>
                                        <span class="menu-title">
                                            <?php echo translate('advertisement'); ?>
                                        </span>
                                        <i class="fa arrow"></i>
                                    </a>
                                    <ul class="collapse <?php if ($page_name == "post_ad" || $page_name == "promo_ad" || $page_name == "ad_payment_list" || $page_name == "ongoing_ads" || $page_name == "ads_settings" || $page_name == "google_adsense_settings" || $page_name == "ads_log") { ?> in <?php } ?>" >

                                        <?php if ($this->Crud_model->admin_permission('ads_log')) { ?>
                                            <li <?php if ($page_name == "ads_log") { ?> class="active-link" <?php } ?> >
                                                <a href="<?php echo base_url(); ?>admin/ads_log/">
                                                    <i class="fa fa-circle fs_i"></i>
                                                    <?php echo translate('ads_log'); ?>
                                                </a>
                                            </li>
                                        <?php } ?>

                                        <?php if ($this->Crud_model->admin_permission('ad_payment_list')) { ?>
                                            <li <?php if ($page_name == "ad_payment_list") { ?> class="active-link" <?php } ?> >
                                                <a href="<?php echo base_url(); ?>admin/payments/">
                                                    <i class="fa fa-circle fs_i"></i>
                                                    <?php echo translate('ad_payment_list'); ?>
                                                </a>
                                            </li>
                                        <?php } ?>

                                        <?php if ($this->Crud_model->admin_permission('ads_settings')) { ?>
                                            <li <?php if ($page_name == "ads_settings") { ?> class="active-link" <?php } ?> >
                                                <a href="<?php echo base_url(); ?>admin/ads_settings/">
                                                    <i class="fa fa-circle fs_i"></i>
                                                    <?php echo translate('ads_settings'); ?>
                                                </a>
                                            </li>
                                        <?php } ?>

                                        <!-- <li <?php if ($page_name == "google_adsense_settings") { ?> class="active-link" <?php } ?> >
                                            <a href="<?php echo base_url(); ?>admin/google_adsense_settings/">
                                                <i class="fa fa-circle fs_i"></i>
                                                <?php echo translate('google_adsense_settings'); ?>
                                            </a>
                                        </li> -->
                                    </ul>
                                </li>

                                <?php
                            }
                        ?>
                        <!-- Manage Ads Ends -->
                        <!-- Subscription Starts -->
                        <?php
                            if ($this->Crud_model->admin_permission('subscription')) {
                                ?>
                                <li <?php if ($page_name == "subscription") { ?> class="active-link" <?php } ?>>
                                    <a href="#">
                                        <i class="fa fa-book"></i>
                                        <span class="menu-title">
                                            <?php echo translate('subscription'); ?>
                                        </span>
                                        <i class="fa arrow"></i>
                                    </a>

                                    <ul class="collapse <?php if ($page_name == "subscription" || $page_name == "subscription_payment") { ?> in <?php } ?>" >
                                        <?php if ($this->Crud_model->admin_permission('subscription')) { ?>
                                            <li <?php if ($page_name == "subscription") { ?> class="active-link" <?php } ?> >
                                                <a href="<?php echo base_url(); ?>admin/subscription/">
                                                    <i class="fa fa-circle fs_i"></i>
                                                    <?php echo translate('packages'); ?>
                                                </a>
                                            </li>
                                        <?php } ?>

                                        <?php if ($this->Crud_model->admin_permission('subscription')) { ?>
                                            <li <?php if ($page_name == "subscription_payment") { ?> class="active-link" <?php } ?> >
                                                <a href="<?php echo base_url(); ?>admin/subscription_payment/">
                                                    <i class="fa fa-circle fs_i"></i>
                                                    <?php echo translate('subscription_payment_list'); ?>
                                                </a>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </li>
                                <?php
                            }
                        ?>
                        <!-- Subscription Ends -->
                        <?php
                            if ($this->Crud_model->admin_permission('display_settings') ||
                                    $this->Crud_model->admin_permission('third_party_settings') ||
                                    $this->Crud_model->admin_permission('site_settings') ||
                                    $this->Crud_model->admin_permission('email_template') ||
                                    $this->Crud_model->admin_permission('page')) {
                                ?>
                                <li <?php
                                if ($page_name == "display_theme_selection" ||
                                        $page_name == "display_theme_settings" ||
                                        $page_name == "display_others" ||
                                        $page_name == "site_settings" ||
                                        $page_name == "page" ||
                                        $page_name == "email_template" ||
                                        $page_name == "third_party_settings" ||
                                        $page_name == "faq_settings" ||
                                        $page_name == "default_images") {
                                    ?> class="active-sub" <?php } ?> >
                                    <a href="#">
                                        <i class="fa fa-desktop"></i>
                                        <span class="menu-title">
                                            <?php echo translate('frontend_settings'); ?>
                                        </span>
                                        <i class="fa arrow"></i>
                                    </a>
                                    <ul class="collapse <?php
                                    if ($page_name == "display_theme_selection" ||
                                            $page_name == "display_theme_settings" ||
                                            $page_name == "display_others" ||
                                            $page_name == "site_settings" ||
                                            $page_name == "page" ||
                                            $page_name == "email_template" ||
                                            $page_name == "google_analytics" ||
                                            $page_name == "third_party_settings" ||
                                            $page_name == "faq_settings" || $page_name == "default_images") {
                                        ?> in <?php } ?>">
                                        <?php
                                        if ($this->Crud_model->admin_permission('display_settings')) {
                                            $tab = $this->uri->segment(3);
                                            ?>
                                            <li <?php if ($page_name == "display_settings") { ?> class="active-sub" <?php } ?>>
                                                <a href="#">
                                                    <i class="fa fa-laptop"></i>
                                                    <span class="menu-title">
                                                        <?php echo translate('display_settings'); ?>
                                                    </span>
                                                    <i class="fa arrow"></i>
                                                </a>
                                                <ul class="display_settings collapse <?php
                                                if ($page_name == "display_theme_selection" ||
                                                        $page_name == "display_theme_settings" ||
                                                        $page_name == "display_others") {
                                                    ?> in <?php } ?>">
                                                    <li <?php if ($page_name == "display_theme_selection") { ?> class="active-sub" <?php } ?>>
                                                        <a href="<?php echo base_url(); ?>admin/display_theme_selection/theme">
                                                            <i class="fa fa-hand-pointer-o"></i>
                                                            <span class="menu-title">
                                                                <?php echo translate('theme_selection'); ?>
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li <?php if ($page_name == "display_theme_settings") { ?> class="active-sub" <?php } ?>>
                                                        <a href="#">
                                                            <i class="fa fa-wrench"></i>
                                                            <span class="menu-title">
                                                                <?php echo translate('theme_settings'); ?>
                                                            </span>
                                                            <i class="fa arrow"></i>
                                                        </a>
                                                        <ul class="collapse <?php if ($page_name == "display_theme_settings") { ?> in <?php } ?>">
                                                            <li <?php if ($tab == 'header') { ?> class="active-link" <?php } ?>>
                                                                <a href="<?php echo base_url(); ?>admin/display_theme_settings/header">
                                                                    <i class="fa fa-circle fs_i"></i>
                                                                    <span class="menu-title">
                                                                        <?php echo translate('header'); ?>
                                                                    </span>
                                                                </a>
                                                            </li>
                                                            <li <?php if ($tab == 'page_elements') { ?> class="active-link" <?php } ?>>
                                                                <a href="<?php echo base_url(); ?>admin/display_theme_settings/page_elements">
                                                                    <i class="fa fa-circle fs_i"></i>
                                                                    <span class="menu-title">
                                                                        <?php echo translate('pages'); ?>
                                                                    </span>
                                                                </a>
                                                            </li>
                                                            <li <?php if ($tab == 'footer') { ?> class="active-link" <?php } ?>>
                                                                <a href="<?php echo base_url(); ?>admin/display_theme_settings/footer">
                                                                    <i class="fa fa-circle fs_i"></i>
                                                                    <span class="menu-title">
                                                                        <?php echo translate('footer'); ?>
                                                                    </span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li <?php if ($page_name == "display_others") { ?> class="active-sub" <?php } ?>>
                                                        <a href="#">
                                                            <i class="fa fa-puzzle-piece"></i>
                                                            <span class="menu-title">
                                                                <?php echo translate('others_appearance'); ?>
                                                            </span>
                                                            <i class="fa arrow"></i>
                                                        </a>
                                                        <ul class="collapse <?php if ($page_name == "display_others") { ?> in <?php } ?>">
                                                            <li <?php if ($tab == 'color') { ?> class="active-link" <?php } ?>>
                                                                <a href="<?php echo base_url(); ?>admin/display_others/color">
                                                                    <i class="fa fa-circle fs_i"></i>
                                                                    <span class="menu-title">
                                                                        <?php echo translate('theme_color'); ?>
                                                                    </span>
                                                                </a>
                                                            </li>
                                                            <li <?php if ($tab == 'favicon') { ?> class="active-link" <?php } ?>>
                                                                <a href="<?php echo base_url(); ?>admin/display_others/favicon">
                                                                    <i class="fa fa-circle fs_i"></i>
                                                                    <span class="menu-title">
                                                                        <?php echo translate('favicon'); ?>
                                                                    </span>
                                                                </a>
                                                            </li>
                                                            <li <?php if ($tab == 'logo') { ?> class="active-link" <?php } ?>>
                                                                <a href="<?php echo base_url(); ?>admin/display_others/logo">
                                                                    <i class="fa fa-circle fs_i"></i>
                                                                    <span class="menu-title">
                                                                        <?php echo translate('logo'); ?>
                                                                    </span>
                                                                </a>
                                                            </li>
                                                            <li <?php if ($tab == 'preloader') { ?> class="active-link" <?php } ?>>
                                                                <a href="<?php echo base_url(); ?>admin/display_others/preloader">
                                                                    <i class="fa fa-circle fs_i"></i>
                                                                    <span class="menu-title">
                                                                        <?php echo translate('preloader'); ?>
                                                                    </span>
                                                                </a>
                                                            </li>
                                                            <li <?php if ($tab == 'font') { ?> class="active-link" <?php } ?>>
                                                                <a href="<?php echo base_url(); ?>admin/display_others/font">
                                                                    <i class="fa fa-circle fs_i"></i>
                                                                    <span class="menu-title">
                                                                        <?php echo translate('fonts'); ?>
                                                                    </span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                        <?php } ?>

                                        <?php
                                        if ($this->Crud_model->admin_permission('site_settings')) {
                                            ?>
                                            <li <?php
                                            if ($page_name == "site_settings" ||
                                                    $page_name == "third_party_settings" ||
                                                    $page_name == "email_template" ||
                                                    $page_name == "faq_settings") {
                                                ?> class="active-sub" <?php } ?>>
                                                <a href="#">
                                                    <i class="fa fa-gears"></i>
                                                    <span class="menu-title">
                                                        <?php echo translate('site_settings'); ?>
                                                    </span>
                                                    <i class="fa arrow"></i>
                                                </a>
                                                <ul class="collapse <?php
                                                if ($page_name == "site_settings" ||
                                                        $page_name == "third_party_settings" ||
                                                        $page_name == "email_template" ||
                                                        $page_name == "google_analytics" ||
                                                        $page_name == "faq_settings") {
                                                    ?> in <?php } ?>">
                                                    <?php
                                                    if ($this->Crud_model->admin_permission('site_settings')) {
                                                        ?>
                                                        <li <?php if ($page_name == "general_settings") { ?> class="active-link" <?php } ?>>
                                                            <a href="<?php echo base_url(); ?>admin/site_settings/general_settings/" >
                                                                <i class="fa fa-circle fs_i"></i>
                                                                <span class="menu-title">
                                                                    <?php echo translate('general_settings'); ?>
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <?php
                                                    }
                                                    ?>
                                                    <?php
                                                    if ($this->Crud_model->admin_permission('email_template')) {
                                                        ?>
                                                        <li <?php if ($page_name == "email_template") { ?> class="active-link" <?php } ?> >
                                                            <a href="<?php echo base_url(); ?>admin/email_template/">
                                                                <i class="fa fa-circle fs_i"></i>
                                                                <?php echo translate('email_templates'); ?>
                                                            </a>
                                                        </li>
                                                        <?php
                                                    }
                                                    ?>
                                                    <?php
                                                        if ($this->Crud_model->admin_permission('google_analytics')) {
                                                    ?>
                                                        <li <?php if ($page_name == "google_analytics") { ?> class="active-link" <?php } ?> >
                                                            <a href="<?php echo base_url(); ?>admin/google_analytics/">
                                                                <i class="fa fa-circle fs_i"></i>
                                                                <?php echo translate('google_analytics_settings'); ?>
                                                            </a>
                                                        </li>
                                                    <?php } ?>
                                                    <?php
                                                    if ($this->Crud_model->admin_permission('third_party_settings')) {
                                                        ?>
                                                        <li <?php if ($page_name == "third_party_settings") { ?> class="active-link" <?php } ?>>
                                                            <a href="<?php echo base_url(); ?>admin/third_party_settings/" >
                                                                <i class="fa fa-circle fs_i"></i>
                                                                <span class="menu-title">
                                                                    <?php echo translate('third_party_settings'); ?>
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <?php
                                                    }
                                                    ?>
                                                    <?php
                                                    if ($this->Crud_model->admin_permission('faq')) {
                                                        ?>
                                                        <li <?php if ($page_name == "faq_settings") { ?> class="active-link" <?php } ?>>
                                                            <a href="<?php echo base_url(); ?>admin/faqs/" >
                                                                <i class="fa fa-circle fs_i"></i>
                                                                <span class="menu-title">
                                                                    <?php echo translate('FAQ'); ?>
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <?php
                                                    }
                                                    ?>
                                                </ul>
                                            </li>
                                        <?php } ?>

                                        <?php
                                        if ($this->Crud_model->admin_permission('default_images')) {
                                            ?>
                                            <li <?php if ($page_name == "default_images") { ?> class="active-link" <?php } ?>>
                                                <a href="<?php echo base_url(); ?>admin/default_images">
                                                    <i class="fa fa-image"></i>
                                                    <span class="menu-title">
                                                        <?php echo translate('default_images'); ?>
                                                    </span>
                                                </a>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </li>
                                <?php
                            }
                        ?>

                        <!-- Currency Settings -->
                        <?php
                        if ($this->Crud_model->admin_permission('currency')) {
                            ?>
                            <li <?php if ($page_name == "curency_settings") { ?> class="active-link" <?php } ?> >
                                <a href="<?php echo base_url(); ?>admin/curency_settings">
                                    <i class="fa fa-money"></i>
                                    <span class="menu-title">
                                        <?php echo translate('currency_settings'); ?>
                                    </span>
                                </a>
                            </li>
                        <?php } ?>
                        <!-- Currency Setting -->

                        <?php if ($this->Crud_model->admin_permission('ads_payment_settings')) { ?>
                            <li <?php if ($page_name == "ads_payment_settings") { ?> class="active-link" <?php } ?> >
                                <a href="<?php echo base_url(); ?>admin/ads_payment_settings/">
                                    <i class="fa fa-credit-card"></i>
                                        <span class="menu-title">
                                            <?php echo translate('payment_settings'); ?>
                                        </span>
                                </a>
                            </li>
                        <?php } ?>

                        <?php if ($this->Crud_model->admin_permission('seo')) { ?>
                            <li <?php if ($page_name == "seo_settings") { ?> class="active-link" <?php } ?> >
                                <a href="<?php echo base_url(); ?>admin/seo_settings">
                                    <i class="fa fa-search-plus"></i>
                                    <span class="menu-title">
                                        <?php echo translate('SEO_report'); ?>
                                    </span>
                                </a>
                            </li>
                        <?php } ?>

                        <?php if ($this->Crud_model->admin_permission('rss')) { ?>
                                <li <?php if ($page_name == "rss") { ?> class="active-link" <?php } ?> >
                                    <a href="<?php echo base_url(); ?>admin/rss">
                                        <i class="fa fa-rss"></i>
                                        <span class="menu-title">
                                            <?php echo translate('RSS'); ?>
                                        </span>
                                    </a>
                                </li>
                            <?php } ?>

                        <?php if ($this->Crud_model->admin_permission('language')) { ?>
                                <li <?php if ($page_name == "language") { ?> class="active-link" <?php } ?> >
                                    <a href="<?php echo base_url(); ?>admin/language_settings">
                                        <i class="fa fa-language"></i>
                                        <span class="menu-title">
                                            <?php echo translate('language'); ?>
                                        </span>
                                    </a>
                                </li>
                            <?php } ?>

                        <li <?php if ($page_name == "manage_admin") { ?> class="active-link" <?php } ?> >
                            <a href="<?php echo base_url(); ?>admin/manage_admin/">
                                <i class="fa fa-lock"></i>
                                <span class="menu-title">
                                    <?php echo translate('manage_admin_profile'); ?>
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
<style>
    .activate_bar{
        border-left: 3px solid #1ACFFC;
        transition: all .6s ease-in-out;
    }
    .activate_bar:hover{
        border-bottom: 3px solid #1ACFFC;
        transition: all .6s ease-in-out;
        background:#1ACFFC !important;
        color:#000 !important;
    }
    ul ul ul li a{
        padding-left:80px !important;
    }
    ul ul ul li a:hover{
        background:#2f343b !important;
    }
    .display_settings ul li a{
        padding-left:100px !important;
    }
    .display_settings ul ul li a:hover{
        background:#2f343b !important;
    }
</style>
