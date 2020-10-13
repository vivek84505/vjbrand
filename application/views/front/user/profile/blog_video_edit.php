<div class="information-title">
    <?php echo translate('edit_blog_video');?>
</div>
<div class="details-wrap">
    <div class="row">
        <div class="col-md-12">
        	<div class="details-wrap">
                <div class="details-box">
                    <div class="row">
                        <div class="col-md-12">
                        	<?php
                                echo form_open(base_url().'home/profile/pay_for_video_post/update', array(
                                    'id' => 'pfp_video_edit_form',
                                    'class' => 'form-delivery',
                                    'method' => 'post',
                                    'enctype' => 'multipart/form-data'
                                ));
                            ?>
                                <?php
                                    foreach ($get_blog_video as $value) {
                                    ?>
                                	<div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12">
                                                <span class="inputt custom-input-1 input-filled">
                                                    <input class="" type="hidden" name="blog_video_id" value="<?=$value->blog_video_id?>"/>
                                                    <input class="" type="hidden" id="change_check" name="change_check" value=""/>
                                                    <input class="custom-input-field-1" type="text" id="video_title" name="video_title" value="<?=$value->title?>" required/>
                                                    <label class="input-label custom-input-label-1" for="input-1" style="left:0;">
                                                        <span class="input-label-content custom-input-label-content" data-content="<?php echo translate('title');?>"><?php echo translate('title');?></span>
                                                    </label>
                                                </span>
                                            </div>
                                            <div class="col-md-12 col-sm-12">
                                                <span class="inputt custom-input-1 input-filled">
                                                    <textarea class="custom-input-field-1 txt_editor" cols="25" id="video_description" name="video_description" required><?=$value->description?></textarea>
                                                    <label class="input-label custom-input-label-1" for="input-2" style="left:0;">
                                                        <span class="input-label-content custom-input-label-content" data-content="<?php echo translate('description');?>"><?php echo translate('description');?></span>
                                                    </label>
                                                </span>
                                            </div>
                                            <div class="" id="video_hide">
                                                <?php
                                                    if ($value->type == 'upload') {
                                                ?>
                                                    <div class="col-md-12 col-sm-12">
                                                        <span class="inputt custom-input-1 input-filled">
                                                            <video controls width="400">
                                                                <source src="<?php echo base_url() . $value->video_src; ?>">
                                                            </video>
                                                        </span>
                                                    </div>
                                                <?php
                                                    }
                                                    elseif ($value->type == 'share') {
                                                ?>
                                                    <div class="col-md-12 col-sm-12">
                                                        <div class="col-sm-10" id="">
                                                            <iframe width="400" height="300" src="<?=$value->video_src?>" frameborder="0">

                                                            </iframe>
                                                        </div>
                                                    </div>

                                                <?php
                                                    }
                                                ?>
                                                <div class="col-md-12 col-sm-12" id="change_btn">
                                                    <button type="button" class="btn btn-sm btn-primary" onclick="change_video()">Change Video</button>
                                                </div>
                                            </div>
                                            <div id="change_vid" style="display: none">
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
                                                            <input class="videoInp" type="file" name="upload_video"  accept="video/*"/>
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
                                            </div>
                                            <div class="col-md-12 col-sm-12">
                                                <span class="button-custom-btn-1 signup_btn enterer pull-right custom-btn-1-round-l custom-btn-1 custom-btn-1-text-thick custom-btn-1-text-upper custom-btn-1-size-s" data-unsuccessful='<?php echo translate('submit_unsuccessful!'); ?>' data-success='<?php echo translate('submitted_successfully!'); ?>' data-ing='<?php echo translate('submitting..') ?>' data-text="<?php echo translate('submit');?>" data-reload="blog_list" >
                                                    <span><i class="fa fa-check"></i></span>
                                                </span>
                                            </div>
                                        </div>
                                	</div>
                                <?php
                                }
                                ?>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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

    function change_video()
    {
        $("#video_hide :input").attr("disabled", true);
        $('#video_hide').hide('slow');
        $('#change_vid').show('slow');
        $('#change_check').val('1');
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
