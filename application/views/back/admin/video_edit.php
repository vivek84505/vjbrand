<div class="row">
    <div class="col-md-12">
        <?php
        foreach ($video_data as $row) {
            ?>
            <div class="tab-pane fade active in" id="edit">
                <?php
                echo form_open(base_url() . 'admin/video/update/' . $row['video_id'], array(
                    'class' => 'form-horizontal',
                    'method' => 'post',
                    'id' => 'video_edit',
                    'enctype' => 'multipart/form-data'
                ));
                ?>
                <div class="panel-body">
                    <div class="form-group btm_border">
                        <label class="col-sm-2 control-label">
                            <?php echo translate('title'); ?>
                        </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="<?php echo $row['title']; ?>" name="title" />
                        </div>
                    </div>
                    <div class="form-group btm_border">
                        <label class="col-sm-2 control-label">
                            <?php echo translate('description'); ?>
                        </label>
                        <div class="col-sm-10 abstract">
                            <textarea class="summernotes" data-height="400" data-name="vdo_desc"><?php echo $row['description']; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group btm_border" id="video_frame">
                        <label class="col-sm-2 control-label">
                            <?php echo translate('video_preview'); ?>
                        </label>
                        <div class="col-sm-10 abstract">
                            <?php
                            if ($row['type'] == 'upload') {
                                ?>
                                <video controls width="400">
                                    <source src="<?php echo base_url() . $row['video_src']; ?>">
                                </video>
                                <?php
                            } else {
                                ?>
                                <iframe controls="2" width="400" src="<?php echo $row['video_src']; ?>" frameborder="0">
                                </iframe>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="form-group btm_border" id="change_option">
                        <label class="col-sm-2 control-label">
                        </label>
                        <div class="col-sm-10 abstract">
                            <span class="btn btn-primary btn-labeled fa fa-folder pull-left" 
                                  onclick="change_video();"><?php echo translate('change_video'); ?>
                            </span>
                        </div>
                    </div>
                    <div  id="video_option">
                    </div>
                    <div class="col-sm-12" id="video_upload" style="display:none">
                        <div class="form-group btm_border">
                            <label class="col-sm-2 control-label">
                                <?php echo translate('upload_video'); ?>
                            </label>
                            <div class="col-sm-10 abstract">
                                <input type="file" name="upload_video" class="videoInp" accept="video/*"/>
                            </div>
                        </div>
                        <div class="form-group btm_border" style="">
                            <label class="col-sm-2 control-label"><?php echo translate('video_preview'); ?></label>
                            <div class="col-sm-10 abstract blah">
                                <div id="message"></div>
                                <video controls id="upload_video" width="400">

                                </video>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12" id="video_share" style="display:none; padding-left:0px; padding-right:0px;">
                        <div class="form-group btm_border">
                            <label class="col-sm-2 control-label">
                                <?php echo translate('sharing_site'); ?>
                            </label>
                            <div class="col-sm-10 abstract">
                                <select class="demo-chosen-select site" name="site">
                                    <option><?php echo translate('choose_one'); ?></option>
                                    <option value="youtube"><?php echo translate('youtube'); ?></option>
                                    <option value="dailymotion"><?php echo translate('dailymotion'); ?></option>
                                    <option value="vimeo"><?php echo translate('vimeo'); ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group btm_border">
                            <label class="col-sm-2 control-label">
                                <?php echo translate('link'); ?>
                            </label>
                            <div class="col-sm-10 abstract blah">
                                <input type="text" name="video_link" class="form-control video_link" onchange="preview(this.value)" />
                            </div>
                        </div>
                        <div class="form-group btm_border">
                            <label class="col-sm-2 control-label">
                                <?php echo translate('video_preview'); ?>
                            </label>
                            <div class="col-sm-10" id="video_preview">

                            </div>
                        </div>
                        <input type="hidden" value="" id="vl" name="vl" />
                    </div>
                    <input type="hidden" value="0" id="change_check" name="change_check" />
                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-md-11">
                            <span class="btn btn-purple btn-labeled fa fa-refresh pro_list_btn pull-right" 
                                  onclick="ajax_set_full('edit', '<?php echo translate('edit_video'); ?>', '<?php echo translate('successfully_edited!'); ?>', 'video_edit', '<?php echo $row['video_id']; ?>')"><?php echo translate('reset'); ?>
                            </span>
                        </div>
                        <div class="col-md-1">
                            <span class="btn btn-success btn-md btn-labeled fa fa-upload pull-right enterer" onclick="form_submit('video_edit', '<?php echo translate('successfully_edited!'); ?>');
                                    proceed('to_add');" ><?php echo translate('upload'); ?></span>
                        </div>
                    </div>
                </div> 
                </form>
            </div>
            <?php
        }
        ?>
    </div>
</div>
<div id="option_html_dummy" style="display:none;">
    <div class="form-group btm_border">
        <label class="col-sm-2 control-label">
            <?php echo translate('video_options'); ?>
        </label>
        <div class="col-sm-10">
            <select class="demo-chosen-select_o" name="upload_method" onchange="video_sector(this.value)">
                <option selected disabled><?php echo translate('choose_an_option'); ?></option>
                <option value="upload"><?php echo translate('upload_video') ?></option>
                <option value="share"><?php echo translate('share_link'); ?></option>
                <option value="cancel"><?php echo translate('back_to_previous_video'); ?></option>
            </select>
        </div>
    </div>
</div>
<script>
    function video_sector(upload_type) {
        if (upload_type == 'upload') {
            $('#video_share').hide('slow');
            $('#video_upload').show('slow');
        } else if (upload_type == 'share') {
            $('#video_upload').hide('slow');
            $('#video_share').show('slow');
        } else if (upload_type == 'cancel') {
            $('#video_upload').hide('slow');
            $('#video_share').hide('slow');
            $('#video_option').find('.form-group').remove();
            $('#change_option').show('slow');
            $('#video_frame').show('slow');
            $('#change_check').val(0);
        }
    }
    function change_video() {
        $('#change_option').hide('slow');
        $('#video_frame').hide('slow');
        $('#change_check').val(1);

        var option_html = $('#option_html_dummy').html();
        option_html = option_html.replace(/demo-chosen-select_o/g, 'demo-chosen-select');
        setTimeout(function () {
            $('#video_option').append(option_html);
            $('#video_option').find('.demo-chosen-select').chosen();
        }, 500);
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
        $('#video_preview').load('<?php echo base_url(); ?>admin/video/preview/' + site + '/' + video_link);
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
            var videoNode = document.querySelector('#upload_video');
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
    function other_forms() {}
    $(document).ready(function (e) {
        $('.demo-chosen-select').chosen();
        set_summer();
        $("form").submit(function (e) {
            return false;
        });
    });
    function set_summer() {
        $('.summernotes').each(function () {
            var now = $(this);
            var h = now.data('height');
            var n = now.data('name');
            if (now.closest('.abstract').find('.val').length) {
            } else {
                now.closest('.abstract').append('<input type="hidden" class="val" name="' + n + '">');
                now.summernote({
                    height: h,
                    onChange: function () {
                        now.closest('.abstract').find('.val').val(now.code());
                    }
                });
                now.closest('.abstract').find('.val').val(now.code());
            }
        });
    }
</script>
<style>
    .btm_border{
        border-bottom: 1px solid #ebebeb;
        padding-bottom: 15px;
    }
</style>