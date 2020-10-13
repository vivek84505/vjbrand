<!-- Bootstrap DateTime Picker -->
<link href="<?php echo base_url(); ?>template/back/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css" rel="stylesheet">
<div class="information-title">
    <?php echo translate('pay_for_post');?>
</div>
<div class="details-wrap">
    <div class="row">
        <div class="col-md-12">
            <div class="tabs-wrapper content-tabs">
                <nav class="menu tab-menu-1">
                    <ul id="tabs" class="menu-list">
                        <li class="menu-item active">
                            <a class="menu-link uppercase" href="#tab1" data-toggle="tab"><?php echo translate('blog_post');?></a>
                        </li>
                        <li class="menu-item">
                            <a class="menu-link uppercase" href="#tab2" data-toggle="tab"><?php echo translate('blog_image_post');?></a>
                        </li>
                        <li class="menu-item">
                            <a class="menu-link uppercase" href="#tab3" data-toggle="tab"><?php echo translate('blog_video_post');?></a>
                        </li>
                    </ul>
                </nav>
                <div class="tab-content">
                    <div class="tab-pane fade active in" id="tab1">
                        <div class="details-wrap">
                            <div class="details-box">
                                <div class="row">
                                    <?php
                                        echo form_open(base_url().'home/profile/pay_for_post/do_add', array(
                                            'id' => 'pfp_form',
                                            'class' => 'form-delivery',
                                            'method' => 'post',
                                            'enctype' => 'multipart/form-data'
                                        ));
                                    ?>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12">
                                                    <span class="inputt custom-input-1 input-filled">
                                                        <input class="custom-input-field-1" type="text" id="input-1" name="title" required/>
                                                        <label class="input-label custom-input-label-1" for="input-1" style="left:0;">
                                                            <span class="input-label-content custom-input-label-content" data-content="<?php echo translate('title');?>"><?php echo translate('title');?></span>
                                                        </label>
                                                    </span>
                                                </div>
                                                <div class="col-md-12 col-sm-12">
                                                    <span class="inputt custom-input-1 input-filled">
                                                        <textarea class="custom-input-field-1" cols="25" id="input-2" name="summary" required></textarea>
                                                        <label class="input-label custom-input-label-1" for="input-2" style="left:0;">
                                                            <span class="input-label-content custom-input-label-content" data-content="<?php echo translate('summary');?>"><?php echo translate('summary');?></span>
                                                        </label>
                                                    </span>
                                                </div>
                                                <div class="col-md-12 col-sm-12">
                                                    <span class="inputt custom-input-1 input-filled">
                                                        <textarea class="custom-input-field-1 txt_editor" cols="25" id="input-3" name="description" required></textarea>
                                                        <label class="input-label custom-input-label-1" for="input-3" style="left:0;">
                                                            <span class="input-label-content custom-input-label-content" data-content="<?php echo translate('description');?>"><?php echo translate('description');?></span>
                                                        </label>
                                                    </span>
                                                </div>
                                                <div class="col-md-12 col-sm-12">
                                                    <span class="inputt custom-input-1 input-filled">
                                                        <?php echo $this->Crud_model->select_html('blog_category', 'blog_category', 'name', 'add', 'custom-input-field-1', '', '', '', 'get_cat') ?>
                                                        <label class="input-label custom-input-label-1" for="input-3" style="left:0;">
                                                            <span class="input-label-content custom-input-label-content" data-content="<?php echo translate('category');?>"><?php echo translate('category');?></span>
                                                        </label>
                                                    </span>
                                                </div>
                                                <div class="col-md-12 col-sm-12" id="sub_cat" style="display: none;">
                                                    <span class="inputt custom-input-1 input-filled">
                                                        <div id="sub_cat_name">

                                                        </div>
                                                        <label class="input-label custom-input-label-1" for="input-4">
                                                            <span class="input-label-content custom-input-label-content" data-content="<?php echo translate('sub-category');?>"><?php echo translate('sub-category');?></span>
                                                        </label>
                                                    </span>
                                                </div>
                                                 <div class="col-md-12 col-sm-12">
                                                    <span class="inputt custom-input-1 input-filled">
                                                        <input class="custom-input-field-1" type="text" id="input-6" name="tag" data-role="tagsinput" required />
                                                        <label class="input-label custom-input-label-1" for="input-6" style="width: 100%">
                                                            <span class="input-label-content custom-input-label-content" data-content="<?php echo translate('tags');?>"><?php echo translate('tags');?></span>
                                                        </label>
                                                    </span>
                                                </div>
                                                <div class="col-md-12 col-sm-12">
                                                    <span class="inputt custom-input-1 input-filled">
                                                        <div class="input-group date" id="datetimepicker">
                                                            <input class="custom-input-field-1" type="text" id="input-5" name="date" value="<?=date('d/m/Y h:i:s A');?>" required />
                                                            <span class="input-group-addon">
                                                                <span class="glyphicon glyphicon-calendar"></span>
                                                            </span>
                                                        </div>

                                                        <label class="input-label custom-input-label-1" for="input-5">
                                                            <span class="input-label-content custom-input-label-content" data-content="<?php echo translate('date');?>"><?php echo translate('date');?></span>
                                                        </label>
                                                    </span>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label" for="demo-is-inputsmall">
                                                        <?php echo translate('image'); ?>
                                                    </label>
                                                    <div class="img_features col-sm-12">
                                                        <div class="col-sm-4" style="margin-bottom:10px;">
                                                            <div class="form-group">
                                                                <div class="col-sm-12">
                                                                    <center>
                                                                        <img class="img-responsive img-border blah" src="<?php echo base_url(); ?>uploads/others/default_image.png" style="width:100%; border: 1px solid #ccc; height: 150px">
                                                                    </center>
                                                                </div>
                                                                <div class="col-sm-12" style="margin-top: 10px; margin-bottom: 10px;">
                                                                    <label for="main_img" class="pull-left btn btn-xs btn-blue btn-file btn-block" style="text-transform: none;"><?php echo translate('select_image') . ' (' . translate('main') . ')*'; ?></label>
                                                                    <input type="file" name="nimg[0]" accept="image/*" id="main_img" class="form-control imgInp" style="display: none;">
                                                                    <input type="hidden" name="cnt[0]" id="cnt" class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-sm-12" style="padding-left: 45px">
                                                        <button type="button" class="btn btn-sm btn-blue" id="add_images">
                                                            <i class="fa fa-plus"></i>
                                                            <?php echo translate('add_more_image') ?>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-sm-12">
                                                    <span class="button-custom-btn-1 pull-right custom-btn-1-round-l custom-btn-1 custom-btn-1-text-thick custom-btn-1-text-upper custom-btn-1-size-s" data-text="<?php echo translate('submit');?>" onclick="preview_remainings(<?=$this->session->userdata('user_id')?>)">
                                                        <span><i class="fa fa-check"></i></span>
                                                    </span>
                                                    <!-- Hidden button to Submit the Form -->
                                                    <span id="pfp_submit" class="hidden button-custom-btn-1 signup_btn enterer pull-right custom-btn-1-round-l custom-btn-1 custom-btn-1-text-thick custom-btn-1-text-upper custom-btn-1-size-s" data-unsuccessful='<?php echo translate('submit_unsuccessful!'); ?>' data-success='<?php echo translate('submitted_successfully!'); ?>' data-ing='<?php echo translate('submitting..') ?>' data-text="<?php echo translate('submit');?>" data-reload="blog_list" >
                                                        <span><i class="fa fa-check"></i></span>
                                                    </span>
                                                    <!-- Hidden button to Submit the Form -->
                                                </div>
                                            </div>
                                        </div>
                                    <?php echo form_close(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab2">
                        <div class="details-wrap">
                            <div class="details-box">
                                <div class="row">
                                    <?php
                                        echo form_open(base_url().'home/profile/pay_for_image_post/do_add', array(
                                            'id' => 'pfp_image_form',
                                            'class' => 'form-delivery',
                                            'method' => 'post',
                                            'enctype' => 'multipart/form-data'
                                        ));
                                    ?>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12">
                                                    <span class="inputt custom-input-1 input-filled">
                                                        <input class="custom-input-field-1" type="text" id="image_title" name="title" required/>
                                                        <label class="input-label custom-input-label-1" for="input-1" style="left:0;">
                                                            <span class="input-label-content custom-input-label-content" data-content="<?php echo translate('title');?>"><?php echo translate('title');?></span>
                                                        </label>
                                                    </span>
                                                </div>
                                                <div class="col-md-12 col-sm-12">
                                                    <span class="inputt custom-input-1 input-filled">
                                                        <textarea class="custom-input-field-1 txt_editor" cols="25" id="image_description" name="description" required></textarea>
                                                        <label class="input-label custom-input-label-1" for="input-3" style="left:0;">
                                                            <span class="input-label-content custom-input-label-content" data-content="<?php echo translate('description');?>"><?php echo translate('description');?></span>
                                                        </label>
                                                    </span>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label" for="demo-is-inputsmall">
                                                        <?php echo translate('image'); ?>
                                                    </label>
                                                    <div class="image_img_features col-sm-12">
                                                        <div class="col-sm-4" style="margin-bottom:10px;">
                                                            <div class="form-group">
                                                                <div class="col-sm-12">
                                                                    <center>
                                                                        <img class="img-responsive img-border blah"  src="<?php echo base_url(); ?>uploads/others/default_image.png" style="width:100%; border: 1px solid #ccc; height: 150px">
                                                                    </center>
                                                                </div>
                                                                <div class="col-sm-12" style="margin-top: 10px; margin-bottom: 10px;">
                                                                    <label for="image_main_img" class="pull-left btn btn-xs btn-blue btn-file btn-block" style="text-transform: none;"><?php echo translate('select_image') . ' (' . translate('main') . ')*'; ?></label>
                                                                    <input type="file" name="nimg[0]" accept="image/*" id="image_main_img" class="form-control imgInp" style="display: none;">
                                                                    <input type="hidden" name="cnt[0]" id="image_cnt" class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-sm-12">
                                                    <span class="button-custom-btn-1 pull-right custom-btn-1-round-l custom-btn-1 custom-btn-1-text-thick custom-btn-1-text-upper custom-btn-1-size-s" data-text="<?php echo translate('submit');?>" onclick="preview_image_remainings(<?=$this->session->userdata('user_id')?>)">
                                                        <span><i class="fa fa-check"></i></span>
                                                    </span>
                                                    <!-- Hidden button to Submit the Form -->
                                                    <span id="pfp_image_submit" class="hidden button-custom-btn-1 signup_btn enterer pull-right custom-btn-1-round-l custom-btn-1 custom-btn-1-text-thick custom-btn-1-text-upper custom-btn-1-size-s" data-unsuccessful='<?php echo translate('submit_unsuccessful!'); ?>' data-success='<?php echo translate('submitted_successfully!'); ?>' data-ing='<?php echo translate('submitting..') ?>' data-text="<?php echo translate('submit');?>" data-reload="blog_list" >
                                                        <span><i class="fa fa-check"></i></span>
                                                    </span>
                                                    <!-- Hidden button to Submit the Form -->
                                                </div>
                                            </div>
                                        </div>
                                    <?php echo form_close(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab3">
                        <div class="details-wrap">
                            <div class="details-box">
                                <div class="row">

                                    <?php
                                        echo form_open(base_url().'home/profile/pay_for_video_post/do_add', array(
                                            'id' => 'pfp_video_form',
                                            'class' => 'form-delivery',
                                            'method' => 'post',
                                            'enctype' => 'multipart/form-data'
                                        ));
                                    ?>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12">
                                                    <span class="inputt custom-input-1 input-filled">
                                                        <input class="custom-input-field-1" type="text" id="video_title" name="video_title" required/>
                                                        <label class="input-label custom-input-label-1" for="input-1" style="left:0;">
                                                            <span class="input-label-content custom-input-label-content" data-content="<?php echo translate('title');?>"><?php echo translate('title');?></span>
                                                        </label>
                                                    </span>
                                                </div>
                                                <div class="col-md-12 col-sm-12">
                                                    <span class="inputt custom-input-1 input-filled">
                                                        <textarea class="custom-input-field-1 txt_editor" cols="25" id="video_description" name="video_description" required></textarea>
                                                        <label class="input-label custom-input-label-1" for="input-2" style="left:0;">
                                                            <span class="input-label-content custom-input-label-content" data-content="<?php echo translate('description');?>"><?php echo translate('description');?></span>
                                                        </label>
                                                    </span>
                                                </div>
                                                <div class="col-md-12 col-sm-12">
                                                    <span class="inputt custom-input-1 input-filled">
                                                        <select class="custom-input-field-1" name="upload_method" onchange="video_sector(this.value)">
                                                            <option selected disabled><?php echo translate('choose_an_option'); ?></option>
                                                            <option value="upload"><?php echo translate('upload_video') ?></option>
                                                            <option value="share"><?php echo translate('share_link'); ?></option>
                                                        </select>
                                                        <label class="input-label custom-input-label-1" for="input-3" style="left:0;">
                                                            <span class="input-label-content custom-input-label-content" data-content="<?php echo translate('video_options');?>"><?php echo translate('video_options');?></span>
                                                        </label>
                                                    </span>
                                                </div>
                                                <div class="" id="video_upload" style="display:none">
                                                    <div class="col-sm-12">
                                                        <label class="input-label custom-input-label-1" style="left:0;">
                                                            <span class="input-label-content custom-input-label-content" data-content="<?php echo translate('upload_video');?>"><?php echo translate('upload_video');?></span>
                                                        </label>
                                                    </div>
                                                    <div class="col-md-12 col-sm-12">
                                                        <span class="inputt custom-input-1 input-filled">
                                                            <input type="file" name="upload_video" class="videoInp" accept="video/*"/>
                                                            <p style="color:red"><?php echo ' '.translate('maximum_vedio_file_size').' : '.'2097152'.' '.translate('byte'); ?></p>
                                                        </span>
                                                    </div>
                                                    <div class="col-md-12 col-sm-12">
                                                        <span class="inputt custom-input-1 input-filled">
                                                            <div id="message"></div>
                                                            <video controls id="upload_blog_video" width="400">

                                                            </video>
                                                        </span>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <label class="input-label custom-input-label-1" style="left:0;">
                                                            <span class="input-label-content custom-input-label-content" data-content="<?php echo translate('video_preview');?>"><?php echo translate('video_preview');?></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="" id="video_share" style="display:none;">
                                                    <div class="col-md-12 col-sm-12">
                                                        <span class="inputt custom-input-1 input-filled">
                                                            <select class="custom-input-field-1 site" name="site">
                                                                <option selected disabled><?php echo translate('choose_an_option'); ?></option>
                                                                <option value="youtube"><?php echo translate('youtube') ?></option>
                                                                <option value="dailymotion"><?php echo translate('dailymotion'); ?></option>
                                                                <option value="vimeo"><?php echo translate('vimeo'); ?></option>
                                                            </select>
                                                            <label class="input-label custom-input-label-1" for="input-3" style="left:0;">
                                                                <span class="input-label-content custom-input-label-content" data-content="<?php echo translate('sharing_site');?>"><?php echo translate('sharing_site');?></span>
                                                            </label>
                                                        </span>
                                                    </div>
                                                    <div class="col-md-12 col-sm-12">
                                                        <span class="inputt custom-input-1 input-filled">
                                                            <input class="custom-input-field-1" type="text" name="video_link" onchange="preview(this.value)"/>
                                                            <label class="input-label custom-input-label-1" style="left:0;">
                                                                <span class="input-label-content custom-input-label-content" data-content="<?php echo translate('link');?>"><?php echo translate('link');?></span>
                                                            </label>
                                                        </span>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <label class="input-label custom-input-label-1" style="left:0;">
                                                            <span class="input-label-content custom-input-label-content" data-content="<?php echo translate('video_preview');?>"><?php echo translate('video_preview');?></span>
                                                        </label>
                                                    </div>
                                                    <div class="col-md-12 col-sm-12">
                                                        <div class="col-sm-10" id="video_preview">

                                                        </div>
                                                    </div>
                                                    <input type="hidden" value="" id="vl" name="vl" />
                                                </div>


                                                <div class="col-md-12 col-sm-12">
                                                    <span class="button-custom-btn-1 pull-right custom-btn-1-round-l custom-btn-1 custom-btn-1-text-thick custom-btn-1-text-upper custom-btn-1-size-s" data-text="<?php echo translate('submit');?>" onclick="preview_video_remainings(<?=$this->session->userdata('user_id')?>)">
                                                        <span><i class="fa fa-check"></i></span>
                                                    </span>
                                                    <!-- Hidden button to Submit the Form -->
                                                    <span id="pfp_video_submit" class="hidden button-custom-btn-1 signup_btn enterer pull-right custom-btn-1-round-l custom-btn-1 custom-btn-1-text-thick custom-btn-1-text-upper custom-btn-1-size-s" data-unsuccessful='<?php echo translate('submit_unsuccessful!'); ?>' data-success='<?php echo translate('submitted_successfully!'); ?>' data-ing='<?php echo translate('submitting..') ?>' data-text="<?php echo translate('submit');?>" data-reload="blog_list" >
                                                        <span><i class="fa fa-check"></i></span>
                                                    </span>
                                                    <!-- Hidden button to Submit the Form -->
                                                </div>
                                            </div>
                                        </div>

                                    <?php echo form_close(); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- DUMMY IMAGE FOR BLOG POST -->
<div id="blog_image_dummy" style="display:none; margin-top:10px">
    <div class="rem">
        <div class="col-sm-4" style="margin-bottom:10px;">
            <div class="form-group">
                <div class="col-sm-12">
                    <center>
                        <img class="img-responsive img-border blah"  src="<?php echo base_url(); ?>uploads/others/default_image.png" style="width:100%; border: 1px solid #ccc; height: 150px">
                    </center>
                </div>
                <div class="col-sm-12" style="margin-top: 10px; margin-bottom: 10px; padding: 0px">
                    <div class="col-sm-7" style="margin:0px; padding-right: 5px">
                        <label for="opt_img[{{i}}]" class="pull-left btn btn-xs btn-blue btn-file btn-block" style="text-transform: none; width: 100%"><?php echo translate('optional_image'); ?></label>
                        <input type="file" name="nimg[{{i}}]" id="opt_img[{{i}}]" class="form-control imgInp" style="display: none;">
                        <input type="hidden" name="cnt[{{i}}]" class="form-control">
                    </div>
                    <div class="col-sm-5" style="margin:0px; padding-left: 0px ">
                        <span class="pull-right btn btn-xs btn-danger removal" style="padding: 3px 2px 2px; width: 100%">
                            <?php echo translate('remove'); ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="img_count" id="img_count" value="0" />
<input type="hidden" id="nums" value='1' />
<!-- DUMMY IMAGE FOR BLOG POST -->

<!-- DUMMY IMAGE FOR IMAGE POST -->
<div id="image_dummy_image" style="display:none; margin-top:10px">
    <div class="rem">
        <div class="col-sm-4" style="margin-bottom:10px;">
            <div class="form-group">
                <div class="col-sm-12">
                    <center>
                        <img class="img-responsive img-border blah"  src="<?php echo base_url(); ?>uploads/others/default_image.png" style="width:100%; border: 1px solid #ccc; height: 150px">
                    </center>
                </div>
                <div class="col-sm-12" style="margin-top: 10px; margin-bottom: 10px; padding: 0px">
                    <div class="col-sm-7" style="margin:0px; padding-right: 5px">
                        <label for="image_opt_img[{{i}}]" class="pull-left btn btn-xs btn-blue btn-file btn-block" style="text-transform: none; width: 100%"><?php echo translate('optional_image'); ?></label>
                        <input type="file" name="nimg[{{i}}]" id="image_opt_img[{{i}}]" class="form-control imgInp" style="display: none;">
                        <input type="hidden" name="cnt[{{i}}]" class="form-control">
                    </div>
                    <div class="col-sm-5" style="margin:0px; padding-left: 0px ">
                        <span class="pull-right btn btn-xs btn-danger removal" style="padding: 3px 2px 2px; width: 100%">
                            <?php echo translate('remove'); ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="image_img_count" id="image_img_count" value="0" />
<input type="hidden" id="image_nums" value='1' />
<!-- DUMMY IMAGE FOR IMAGE POST -->

<!-- Bootstrap Date Time Picker -->

<script src="<?php echo base_url(); ?>template/back/plugins/moment/moment.js"></script>
<script src="<?php echo base_url(); ?>template/back/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js"></script>

<script src="<?php echo base_url(); ?>template/back/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>

<script>
    $(function () {
        //bootstrap WYSIHTML5 - text editor
        $('.txt_editor').wysihtml5({
            toolbar: {
                "image": false // Button to insert an image.
            }
        });
    })
</script>

<script type="text/javascript">
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
        $(".panel-body").on('change', '.imgInp', function () {
            readURL_all(this);
        });

        $('#add_images').click(function () {
            var blog_image_dummy_html = $('#blog_image_dummy').html();
            var l = $('#img_count').val();
            ln = parseInt(Number(l) + 1);
            blog_image_dummy_html = blog_image_dummy_html.replace(/{{i}}/g, ln);
            $('.img_features').append(blog_image_dummy_html);
            $('#img_count').val(ln);
            $('#cnt').val(ln);
        });

        $('#image_add_images').click(function () {
            var image_dummy_image_html = $('#image_dummy_image').html();
            var m = $('#image_img_count').val();
            mn = parseInt(Number(m) + 1);
            image_dummy_image_html = image_dummy_image_html.replace(/{{i}}/g, mn);
            $('.image_img_features').append(image_dummy_image_html);
            $('#image_img_count').val(mn);
            $('#image_cnt').val(mn);
        });

        $('body').on('click', '.removal', function () {
            $(this).closest('.rem').remove();
        });
    });
</script>

<script>
    function video_sector(upload_type) {
        if (upload_type == 'upload') {
            $('#video_share').hide('slow');
            $('#video_upload').show('slow');
        } else if (upload_type == 'share') {
            $('#video_upload').hide('slow');
            $('#video_share').show('slow');
        }
    }
    function preview(v_link) {
        var site = $('.site').val();
        if (site == 'youtube') {
            var x = v_link.split('=');
            var video_link = x[1];
        } else if (site == 'dailymotion') {
            var temp = v_link.split('/');
            var x = temp[4].split('_');
            var video_link = x[0];
        } else if (site == 'vimeo') {
            var x = v_link.split('/');
            var video_link = x[3];
        }
        $('#vl').val(video_link);
        $('#video_preview').load('<?php echo base_url(); ?>home/profile/pay_for_video_post/preview/' + site + '/' + video_link);
    }
</script>
<script>
    (function localFileVideoPlayer() {
        'use strict'
        var URL = window.URL || window.webkitURL;
        var displayMessage = function (message, isError) {
            var element = document.querySelector('#message');
            element.innerHTML = message;
            element.className = isError ? 'error' : 'info';
        }
        var playSelectedFile = function (event) {
            var file = this.files[0];
            var type = file.type;
            var videoNode = document.querySelector('#upload_blog_video');
            var canPlay = videoNode.canPlayType(type);
            if (canPlay === '')
                canPlay = 'no';
            //var message = 'Can play type "' + type + '": ' + canPlay ;
            var isError = canPlay === 'no';
            //displayMessage(message, isError) ;

            if (isError) {
                return
            }

            var fileURL = URL.createObjectURL(file);
            videoNode.src = fileURL;
        }
        var inputNode = document.querySelector('.videoInp');
        inputNode.addEventListener('change', playSelectedFile, false);
    })();
</script>

<script>
$(document).ready(function(e) {
    $('#tabs a').click(function (e) {
      e.preventDefault();
      $(this).tab('show');
    });
    ( function( window ) {

        'use strict';

        function classReg( className ) {
          return new RegExp("(^|\\s+)" + className + "(\\s+|$)");
        }

        var hasClass, addClass, removeClass;

        if ( 'classList' in document.documentElement ) {
          hasClass = function( elem, c ) {
            return elem.classList.contains( c );
          };
          addClass = function( elem, c ) {
            elem.classList.add( c );
          };
          removeClass = function( elem, c ) {
            elem.classList.remove( c );
          };
        }
        else {
          hasClass = function( elem, c ) {
            return classReg( c ).test( elem.className );
          };
          addClass = function( elem, c ) {
            if ( !hasClass( elem, c ) ) {
              elem.className = elem.className + ' ' + c;
            }
          };
          removeClass = function( elem, c ) {
            elem.className = elem.className.replace( classReg( c ), ' ' );
          };
        }

        function toggleClass( elem, c ) {
          var fn = hasClass( elem, c ) ? removeClass : addClass;
          fn( elem, c );
        }


        var classie = {
          hasClass: hasClass,
          addClass: addClass,
          removeClass: removeClass,
          toggleClass: toggleClass,
          has: hasClass,
          add: addClass,
          remove: removeClass,
          toggle: toggleClass
        };

        if ( typeof define === 'function' && define.amd ) {
          define( classie );
        } else {
          window.classie = classie;
        }
        })( window );

});
</script>

<script>
    (function() {
        if (!String.prototype.trim) {
            (function() {
                var rtrim = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g;
                String.prototype.trim = function() {
                    return this.replace(rtrim, '');
                };
            })();
        }

        [].slice.call( document.querySelectorAll( 'input.input-field' ) ).forEach( function( inputEl ) {
            if( inputEl.value.trim() !== '' ) {
                classie.add( inputEl.parentNode, 'input-filled' );
            }
            inputEl.addEventListener( 'focus', onInputFocus );
            inputEl.addEventListener( 'blur', onInputBlur );
        } );

        [].slice.call( document.querySelectorAll( 'textarea.input-field' ) ).forEach( function( inputEl ) {
            if( inputEl.value.trim() !== '' ) {
                classie.add( inputEl.parentNode, 'input-filled' );
            }
            inputEl.addEventListener( 'focus', onInputFocus );
            inputEl.addEventListener( 'blur', onInputBlur );
        } );

        function onInputFocus( ev ) {
            classie.add( ev.target.parentNode, 'input-filled' );
        }

        function onInputBlur( ev ) {
            if( ev.target.value.trim() === '' ) {
                classie.remove( ev.target.parentNode, 'input-filled' );
            }
        }
    })();

    function get_cat(id) {
        $.ajax({
            url: "<?=base_url()?>home/profile/pay_for_post/sub_by_cat/"+id,
            success: function(result){
                $("#sub_cat_name").html(result);
                $("#sub_cat").show('slow');
            }
        });
    }
</script>
<script type="text/javascript">
    $(function () {
        $('#datetimepicker').datetimepicker({
            widgetPositioning: {
                horizontal: 'left',
                vertical: 'bottom'
            }
        });
    });

    $(".bootstrap-tagsinput").prop("class","bootstrap-tagsinput custom-input-field-1");
</script>
<style>
.modal-backdrop, .modal-backdrop.in{
  display: none;
}
.custom-input-1 {
    margin-bottom: 20px;
}
.bootstrap-tagsinput input {
    border: none;
}
.bootstrap-tagsinput .tag [data-role="remove"]:hover {
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
}
.bootstrap-tagsinput .tag [data-role="remove"] {
    margin-left: 8px;
    cursor: pointer;
}
.bootstrap-tagsinput .tag [data-role="remove"]:after {
    /* content: "x"; */
    content: "\f057";
    font: normal normal normal 14px/1 FontAwesome;
    padding: 0px 2px;
}
.label-primary {
    background-color: #337ab7;
    padding: 5px 3px;
}
#datetimepicker {
    z-index: 99999999 !important;
}
.modal-dialog {
    width: 600px;
    margin: 10% auto !important;
    z-index: 99999999 !important;
}
</style>
