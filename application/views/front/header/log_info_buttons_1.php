
                    <?php
                        $header_style = json_decode($this->Crud_model->get_settings_value('ui_settings', 'header_style'), true);
                        if ($this->session->userdata('user_login') !== 'yes') {
                    ?>
                    <li>
                        <a href="<?php echo base_url(); ?>home/login_set/login">
                            <i class="fa fa-user-circle" style="width:auto; margin-right:5px;"></i>
                            <?php echo translate('sign_in'); ?>
                        </a>
                        <!-- drop down with grid column 5 + offset-1 -->
                        <div class="drop-down grid-col-4 <?php if($header_style['menu_links'] == 'left'){echo 'offset-4';} ?> offset-5-vertical pchange1 signin_box"> <!--grid row-->
                            <div class="grid-row">
                                <div class="grid-col-12 get_into">
                                    <?php
                                        echo form_open(base_url() . 'home/login/do_login/', array(
                                            'class' => 'form-login',
                                            'method' => 'post',
                                            'id' => ''
                                        ));
                                    ?>
                                    <div class="row box_shape">
                                        <div class="title">
                                            <?php echo translate('sign_in'); ?>
                                            <div class="option">
                                                    <?php echo translate('not_a_member_yet'); ?>?
                                                <a href="<?php echo base_url(); ?>home/login_set/registration">
                                                    <?php echo translate('sign_up_now'); ?>!
                                                </a>
                                                    <?php echo translate('or'); ?>
                                                <a href="<?php echo base_url(); ?>home/login_set/login">
                                                    <?php echo translate('click_here_for_social_login'); ?>!
                                                </a>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <input class="form-control" type="email" name="email" placeholder="<?php echo translate('email'); ?>" value="">
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <input class="form-control" type="password" name="password" placeholder="<?php echo translate('password'); ?>"value="">
                                            </div>
                                        </div>

                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right pull-right">
                                            <a class="forget_pass" href="<?php echo base_url(); ?>home/login_set/login/forget">
                                                <?php echo translate('forget_your_password'); ?>?
                                            </a>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <span  class="button-custom-btn-1 btn-block custom-btn-1 custom-btn-1-text-thick custom-btn-1-round-s custom-btn-1-text-upper custom-btn-1-size-s pull-right login_btn enterer" data-text="<?php echo translate('login'); ?>">
                                                <span><?php echo translate('login'); ?></span>
                                            </span>
                                        </div>
                                    </div>
                                    <?php echo form_close();?>
                                </div>
                            </div>
                        </div>
                    </li>
                    <?php
                        } else {
                    ?>
                    <li>
                        <a href="<?php echo base_url(); ?>home/profile/">
                            <i class="fa fa-user"></i>
                            <?php echo translate('my_profile'); ?>
                        </a>
                        <ul class="drop-down-multilevel">
                            <li>
                                <a href="<?php echo base_url(); ?>home/profile/gp">
                                    <i class="fa fa-tachometer"></i>
                                    <?php echo translate('profile_info'); ?>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url(); ?>home/profile/rl">
                                    <i class="fa fa-clock-o"></i>
                                    <?php echo translate('read_later'); ?>
                                </a>
                            </li>
                            <!-- <li>
                                <a href="<?php echo base_url(); ?>home/profile/st">
                                    <i class="fa fa-tags"></i>
                                    <?php echo translate('support_ticket'); ?>
                                </a>
                            </li> -->
                            <li>
                                <a href="<?php echo base_url(); ?>home/profile/up">
                                    <i class="fa fa-pencil-square"></i>
                                    <?php echo translate('update_profile'); ?>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url(); ?>home/profile/ad">
                                    <i class="fa fa-bullhorn"></i>
                                    <?php echo translate('ads_list'); ?>
                                </a>
                            </li>
                            <?php
                            $is_blogger = $this->Crud_model->get_type_name_by_id('user', $this->session->userdata('user_id'),'is_blogger');
                            if ($is_blogger == 'yes'): ?>
                                <li>
                                    <a href="<?php echo base_url(); ?>home/blog_profile">
                                        <i class="fa fa-user"></i>
                                        <?php echo translate('my_blog_profile'); ?>
                                    </a>
                                </li>
                            <?php endif ?>
                            <li>
                                <a href="<?php echo base_url(); ?>home/logout">
                                    <i class="fa fa-sign-out"></i>
                                    <?php echo translate('logout'); ?>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <?php
                        }
                    ?>

<script>
    $(document).ready(function () {
        function optionChange(logo, link, social, search, topfixed, position, sticky, effect, trigger) {
            $('#menu-1').megaMenu({
                logo_align: logo,
                links_align: link,
                socialBar_align: social,
                searchBar_align: search,
                trigger: trigger,
                effect: effect,
                top_fixed: topfixed,
                sticky_header: sticky,
                menu_position: position
            });
        }

        changer();
        function changer() {
            var logoLeft = 'left';
            var linkaign = '<?php echo $header_style['menu_links']; ?>';
            var social = '';
            var search = '<?php echo $header_style['search_bar']; ?>';
            var fixed = false;
            var position = 'horizontal';
            var sticky = <?php echo $header_style['sticky_header']; ?>;
            var effect = '<?php echo $header_style['effects']; ?>';
            var trigger = 'hover';
            optionChange(logoLeft, linkaign, social, search, fixed, position, sticky, effect, trigger);

            if (linkaign == 'right') {
                $('.signup').removeClass('pull-right');
                $('.signup').addClass('pull-left');
            }
            if (search == 'right') {
                $('.menu-search-bar li').addClass('menu_borderRight');
            } else {
                $('.menu-search-bar li').addClass('menu_borderLeft');
            }
        }
    });
</script>
