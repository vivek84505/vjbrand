<div class="widget shop-categories user_panel_sidebar">
    <div class="user_details">
        <div class="user_img">
            <?php
                $user_info = $this->db->get_where('user', array('user_id' => $this->session->userdata('user_id')))->result_array();
                foreach ($user_info as $row) {
            ?>
                    <div class="cover form-body pic_changer window_set">
                        <?php
                        echo form_open(base_url() . 'home/registration/change_picture/' . $row['user_id'], array(
                            'class' => '',
                            'method' => 'post',
                            'id' => 'fff',
                            'enctype' => 'multipart/form-data'
                        ));
                        ?>
                        <span id="inppic" class="set_image">
                            <label class="btn btn-theme btn-theme-sm btn-block" for="imgInp">
                                <span><?php echo translate('change_picture'); ?></span>
                            </label>
                            <input type="file" style="display:none;" id="imgInp" name="img" />
                        </span>
                        <span id="savepic" style="display:none;">
                            <span class="btn btn-theme btn-block btn-theme-sm signup_btn" onclick="abnv('inppic'); change_state('normal');"  data-ing="<?php echo translate('saving'); ?>..." data-success="<?php echo translate('profile_picture_saved_successfully!'); ?>" data-unsuccessful="<?php echo translate('edit_failed!'); ?> <?php echo translate('try_again!'); ?>" data-reload="no" >
                                <span><?php echo translate('save_changes'); ?></span>
                            </span>
                        </span>
                        </form>
                    </div>
                    <input type="hidden" id="state" value="normal" />
                    <div class="img-box" id="blah"
                         style="height:300px; background-size: cover; background-image: url('<?php
                         if (file_exists('uploads/user_image/user_' . $row['user_id'] . '.jpg')) {
                             echo $this->Crud_model->file_view('user', $row['user_id'], '100', '100', 'no', 'src', '', '', '.jpg') . '?t=' . time();
                         } else if (!empty($row['fb_id'])) {
                             echo "https://graph.facebook.com/" . $row['fb_id'] . "/picture?type=large";
                         } else if (!empty($row['g_id'])) {
                             echo $row['g_photo'];
                         } else {
                             echo base_url() . "uploads/user_image/default.jpg";
                         }
                         ?>')">
                    </div>
            <?php
                }
            ?>
        </div>
    </div>
    <div class="widget-content user_panel_nav">
        <ul>
            <li class="" onClick="get_profile();" id="gp">
                <span>
                    <i class="fa fa-tachometer"></i>
                    <?php echo translate('profile'); ?>
                </span>
            </li>
            <li class="" onClick="get_read_later();" id="rl">
                <span>
                    <i class="fa fa-clock-o"></i>
                    <?php echo translate('read_later'); ?>
                    <span id="readlater_count">( <?php echo $this->Crud_model->readlater_num(); ?> )</span>
                </span>
            </li>
            <!-- <li class="" onClick="get_support();" id="st">
                <span>
                    <i class="fa fa-tags"></i>
                    <?php echo translate('support_ticket'); ?>
                </span>
            </li> -->
            <li class="" onClick="update_profile();" id="up">
                <span>
                    <i class="fa fa-pencil-square"></i>
                    <?php echo translate('update_profile'); ?>
                </span>
            </li>
            <li class="" onClick="apply();" id="ad">
                <span>
                    <i class="fa fa-bullhorn"></i>
                    <?php echo translate('apply_for_advertisement'); ?>
                </span>
            </li>
            <li class="" onClick="get_adList();" id="ad_list">
                <span>
                    <i class="fa fa-bullhorn"></i>
                    <?php echo translate('ads_list'); ?>
                </span>
            </li>
            <?php if ($row['is_blogger'] == 'no'): ?>
                <li class="" onClick="be_blogger();" id="be_blogger">
                    <span>
                        <i class="fa fa-user"></i>
                        <?php echo translate('i_want_to_be_a_blogger'); ?>
                    </span>
                </li>
            <?php endif ?>
            <?php if ($row['is_blogger'] == 'yes'): ?>
                <li class="" onClick="get_blog_profile();" id="blog_profile">
                    <span>
                        <i class="fa fa-user"></i>
                        <?php echo translate('my_blog_profile'); ?>
                    </span>
                </li>
                <li class="" onClick="pay_for_post();" id="pfp">
                    <span>
                        <i class="fa fa-credit-card"></i>
                        <?php echo translate('blog_post'); ?>
                    </span>
                </li>
                <li class="" onClick="get_packages();" id="pp">
                    <span>
                        <i class="fa fa-gift"></i>
                        <?php echo translate('premium_blog_packages'); ?>
                    </span>
                </li>
                <li class="" onClick="get_packages_list();" id="ppl">
                    <span>
                        <i class="fa fa-gift"></i>
                        <?php echo translate('purchased_packages'); ?>
                    </span>
                </li>
                <li class="" onClick="get_blog_list();" id="blog_lst">
                    <span>
                        <i class="fa fa-list-ul"></i>
                        <?php echo translate('my_blog_list'); ?>
                    </span>
                </li>
            <?php endif ?>

            <li class="" style="padding: 0;">
                <a href="<?php echo base_url(); ?>home/logout" style="padding: 10px 15px; color: #f00;">
                    <i class="fa fa-sign-out"></i>
                    <?php echo translate('logout'); ?>
                </a>
            </li>
        </ul>
    </div>
</div>
<style>
    .widget.shop-categories ul li {
        cursor: pointer;
    }
</style>
<script type="text/javascript">

    function abnv(thiss) {
        $('#savepic').hide();
        $('#inppic').hide();
        $('#' + thiss).show();
        $('.user_img').removeClass('hover');
    }
    function change_state(va) {
        $('#state').val(va);
    }

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah').css('backgroundImage', "url('" + e.target.result + "')");
                $('#blah').css('backgroundSize', "cover");
            }
            reader.readAsDataURL(input.files[0]);
            abnv('savepic');
            change_state('saving');
        }
    }

    $("#imgInp").change(function () {
        readURL(this);
        $('.user_img').addClass('hover');
    });

</script>
