<div id="content-container">
    <div id="page-title">
        <h1 class="page-header text-overflow" ><?php echo translate('blog_post'); ?></h1>
    </div>
    <div class="tab-base">
        <div class="panel">
            <div class="panel-body">
                <div class="tab-content">
                    <div class="row">
					    <div class="col-lg-12">
					        <!--Default Tabs (Left Aligned)-->
					        <!--===================================================-->
					        <div class="tab-base">

					            <!--Nav Tabs-->
					            <ul class="nav nav-tabs">
					                <li class="active">
					                    <a data-toggle="tab" href="#demo-lft-tab-1"><h4><?php echo translate('blog_post'); ?></h4> </a>
					                </li>
					                <li>
					                    <a data-toggle="tab" href="#demo-lft-tab-2"><h4><?php echo translate('blog_image_post'); ?></h4> </a>
					                </li>
					                <li>
					                    <a data-toggle="tab" href="#demo-lft-tab-3"><h4><?php echo translate('blog_video_post'); ?></h4> </a>
					                </li>
					            </ul>

					            <!--Tabs Content-->
					            <div class="tab-content">
					                <div id="demo-lft-tab-1" class="tab-pane fade active in">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <?php
                                                echo form_open(base_url() . 'admin/blog_post/blog_post/do_add/', array(
                                                    'class' => 'form-horizontal',
                                                    'method' => 'post',
                                                    'id' => 'blog_post_add',
                                                    'enctype' => 'multipart/form-data'
                                                ));
                                                ?>
                                                <div class="panel-body">
                                                    <div class="form-group btm_border">
                                                        <label class="col-sm-2 control-label">
                                                            <?php echo translate('title'); ?>
                                                        </label>
                                                        <div class="col-sm-8">
                                                            <input type="text" name="title" placeholder="<?php echo translate('title'); ?>"
                                                                   class="form-control required">
                                                        </div>
                                                    </div>
                                                    <div class="form-group btm_border">
                                                        <label class="col-sm-2 control-label">
                                                            <?php echo translate('summary'); ?>
                                                        </label>
                                                        <div class="col-sm-8">
                                                            <textarea class="required" rows="5" cols="153" name="summary" ></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group btm_border">
                                                        <label class="col-sm-2 control-label">
                                                            <?php echo translate('description'); ?>
                                                        </label>
                                                        <div class="col-sm-8 abstract">
                                                            <textarea class="summernotes" data-height="300" name="description" data-name="description"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group btm_border">
                                                        <label class="col-sm-2 control-label">
                                                            <?php echo translate('category'); ?>
                                                        </label>
                                                        <div class="col-sm-8">
                                                            <?php echo $this->Crud_model->select_html('blog_category', 'blog_category', 'name', 'add', 'demo-chosen-select required', '', '', '', 'get_cat') ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group btm_border" id="sub_cat" style="display:none;">
                                                        <label class="col-sm-2 control-label">
                                                            <?php echo translate('sub-category'); ?>
                                                        </label>

                                                        <div class="col-sm-8" id="sub_cat_name">

                                                        </div>
                                                    </div>
                                                    <div class="form-group btm_border">
                                                        <label class="col-sm-2 control-label" for="news_tag">
                                                            <?php echo translate('tags'); ?>
                                                        </label>
                                                        <div class="col-sm-8">
                                                            <input type="text" name="tag" id="tag"  data-role="tagsinput"
                                                                   placeholder="<?php echo translate('tags'); ?>" class="bootstrap-tagsinput form-control required"  >
                                                        </div>
                                                    </div>
                                                    <div class="form-group btm_border">
                                                        <label class="col-sm-2 control-label">
                                                            <?php echo translate('date'); ?>
                                                        </label>
                                                        <div class="col-sm-8">
                                                            <div class="input-group date" id="datetimepicker">
                                                                <input type="text" class="form-control" name="date"/>
                                                                <span class="input-group-addon">
                                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label" for="demo-is-inputsmall">
                                                            <?php echo translate('image'); ?>
                                                        </label>
                                                        <div class="img_features col-sm-10">
                                                            <div class="col-sm-3" style="border:1px solid #ccc; border-radius:5px;margin-right:10px; margin-bottom:10px;">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <center>
                                                                            <div class="col-sm-12" style="padding:10px;">
                                                                                <img class="img-responsive img-border blah"  src="<?php echo base_url(); ?>uploads/others/default_image.png" style="width:100%;"  >
                                                                            </div>
                                                                        </center>
                                                                    </div>
                                                                    <div class="col-sm-12">
                                                                        <span class="pull-left btn btn-sm btn-default btn-file btn-block">
                                                                            <?php echo translate('select_image') . ' (' . translate('main') . ')*'; ?>
                                                                            <input type="file" name="nimg[0]" accept="image/*" class="form-control imgInp">
                                                                            <input type="hidden" name="cnt[0]" id="cnt" class="form-control">
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group btm_border">
                                                        <div class="btn btn-sm btn-success col-sm-offset-10" id="add_images">
                                                            <?php echo translate('add_more_image') ?>
                                                        </div>
                                                    </div>
                                                    <div class="panel-footer">
                                                        <div class="row">
                                                            <div class="col-md-10">
                                                            </div>
                                                            <div class="col-md-1" style="margin-left:1%">
                                                                <span class="btn btn-success btn-md btn-labeled fa fa-upload pull-right" onclick="form_submit('blog_post_add', '<?php echo translate('successfully_added!'); ?>'); proceed('to_add');" >
                                                                    <?php echo translate('upload'); ?>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
					                </div>
					                <div id="demo-lft-tab-2" class="tab-pane fade">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <?php
                                                echo form_open(base_url() . 'admin/blog_post/blog_image_post/', array(
                                                    'class' => 'form-horizontal',
                                                    'method' => 'post',
                                                    'id' => 'blog_image_post_add',
                                                    'enctype' => 'multipart/form-data'
                                                ));
                                                ?>
                                                <div class="panel-body">
                                                    <div class="form-group btm_border">
                                                        <label class="col-sm-2 control-label">
                                                            <?php echo translate('title'); ?>
                                                        </label>
                                                        <div class="col-sm-8">
                                                            <input type="text" name="title" placeholder="<?php echo translate('title'); ?>"
                                                                   class="form-control required">
                                                        </div>
                                                    </div>
                                                    <div class="form-group btm_border">
                                                        <label class="col-sm-2 control-label">
                                                            <?php echo translate('description'); ?>
                                                        </label>
                                                        <div class="col-sm-8 abstract">
                                                            <textarea class="summernotes" data-height="300" data-name="description" name="description" ></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label" for="demo-is-inputsmall">
                                                            <?php echo translate('image'); ?>
                                                        </label>
                                                        <div class="img_features col-sm-10">
                                                            <div class="col-sm-3" style="border:1px solid #ccc; border-radius:5px;margin-right:10px; margin-bottom:10px;">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <center>
                                                                            <div class="col-sm-12" style="padding:10px;">
                                                                                <img class="img-responsive img-border blah"  src="<?php echo base_url(); ?>uploads/others/default_image.png" style="width:100%;"  >
                                                                            </div>
                                                                        </center>
                                                                    </div>
                                                                    <div class="col-sm-12">
                                                                        <span class="pull-left btn btn-sm btn-default btn-file btn-block">
                                                                            <?php echo translate('select_image') . ' (' . translate('main') . ')*'; ?>
                                                                            <input type="file" name="nimg[0]" accept="image/*" class="form-control imgInp required" >
                                                                            <input type="hidden" name="cnt[0]" id="cnt" class="form-control">
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="panel-footer">
                                                        <div class="row">
                                                            <div class="col-md-10">
                                                            </div>
                                                            <div class="col-md-1" style="margin-left:1%">
                                                                <span class="btn btn-success btn-md btn-labeled fa fa-upload pull-right" onclick="form_submit('blog_image_post_add', '<?php echo translate('successfully_added!'); ?>'); proceed('to_add');" >
                                                                    <?php echo translate('upload'); ?>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
					                </div>
					                <div id="demo-lft-tab-3" class="tab-pane fade">
                                        <div class="row">
                                            <div class="col-md-12">
                                                    <div class="tab-pane fade active in" id="edit">
                                                        <?php
                                                        echo form_open(base_url() . 'admin/blog_post/blog_video_post/', array(
                                                            'class' => 'form-horizontal',
                                                            'method' => 'post',
                                                            'id' => 'blog_video_post_add',
                                                            'enctype' => 'multipart/form-data'
                                                        ));
                                                        ?>
                                                        <div class="form-group btm_border">
                                                            <label class="col-sm-2 control-label">
                                                                <?php echo translate('title'); ?>
                                                            </label>
                                                            <div class="col-sm-8">
                                                                <input type="text" name="title" placeholder="<?php echo translate('title'); ?>"
                                                                       class="form-control required">
                                                            </div>
                                                        </div>
                                                        <div class="form-group btm_border">
                                                            <label class="col-sm-2 control-label">
                                                                <?php echo translate('summary'); ?>
                                                            </label>
                                                            <div class="col-sm-8">
                                                                <textarea class="required" rows="5" cols="158" name="summary" ></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="form-group btm_border">
                                                            <label class="col-sm-2 control-label">
                                                                <?php echo translate('video_options'); ?>
                                                            </label>
                                                            <div class="col-sm-8">
                                                                <select class="demo-chosen-select required" name="upload_method" onchange="video_sector(this.value)">
                                                                    <option selected disabled><?php echo translate('choose_an_option'); ?></option>
                                                                    <option value="upload"><?php echo translate('upload_video') ?></option>
                                                                    <option value="share"><?php echo translate('share_link'); ?></option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12" id="video_upload" style="display:none">
                                                            <div class="form-group btm_border">
                                                                <label class="col-sm-2 control-label">
                                                                    <?php echo translate('upload_video'); ?>
                                                                </label>
                                                                <div class="col-sm-8 abstract">
                                                                    <input type="file" name="upload_video" class="videoInp" accept="video/*"/>
                                                                    <p style="color:red"><?php echo translate('maximum_vedio_file_size').' : '.'2097152'.' '.translate('bytes'); ?></p>
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
                                                                <div class="col-sm-8 abstract">
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
                                                                <div class="col-sm-8 abstract blah">
                                                                    <input type="text" name="video_link" class="form-control video_link" onchange="preview(this.value)" />
                                                                </div>
                                                            </div>
                                                            <div class="form-group btm_border">
                                                                <label class="col-sm-2 control-label">
                                                                    <?php echo translate('video_preview'); ?>
                                                                </label>
                                                                <div class="col-sm-8" id="video_preview">

                                                                </div>
                                                            </div>
                                                            <input type="hidden" value="" id="vl" name="vl" />

                                                        </div>
                                                        <div class="form-group btm_border">
                                                            <div class="col-md-10">
                                                            </div>
                                                            <div class="col-md-1" style="margin-left:1%">
                                                                <span class="btn btn-success btn-md btn-labeled fa fa-upload pull-right" onclick="form_submit('blog_video_post_add', '<?php echo translate('successfully_added!'); ?>'); proceed('to_add');" >
                                                                    <?php echo translate('upload'); ?>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
					                </div>
					            </div>
					        </div>
					        <!--===================================================-->
					        <!--End Default Tabs (Left Aligned)-->
					    </div>

					</div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="news_image_dummy" style="display:none; margin-top:10px">
    <div class="rem">
        <div class="col-sm-3" style="border:1px solid #ccc; border-radius:5px; margin-right:10px; margin-bottom:10px;">
            <div class="form-group">
                <div class="col-sm-12">
                    <center>
                        <div class="col-sm-12" style="padding:10px;">
                            <img class="img-responsive img-border blah"  src="<?php echo base_url(); ?>uploads/others/default_image.png" style="height:150px; width:100%;" >
                        </div>
                    </center>
                </div>
                <div class="col-sm-12">
                    <div class="col-sm-6" style="margin-left:9px">
                        <span class="pull-left btn btn-sm btn-default btn-file" style="margin-left:-5px">
                            <?php echo translate('optional_image'); ?>
                            <input type="file" name="nimg[{{i}}]" class="form-control imgInp">
                        </span>
                        <input type="hidden" name="cnt[{{i}}]" class="form-control">
                    </div>
                    <div class="col-sm-6" style="margin-left:-12px">
                        <span class="pull-right btn btn-sm btn-danger removal" style="margin-left:5px">
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
<script src="<?php echo base_url(); ?>template/back/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
<script>
    var base_url = '<?php echo base_url(); ?>'
    var user_type = 'admin';
    var dlt_cont_func = 'delete';
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
            var news_image_dummy_html = $('#news_image_dummy').html();
            var l = $('#img_count').val();
            ln = parseInt(Number(l) + 1);
            news_image_dummy_html = news_image_dummy_html.replace(/{{i}}/g, ln);
            $('.img_features').append(news_image_dummy_html);
            $('#img_count').val(ln);
            $('#cnt').val(ln);
        });

        $('body').on('click', '.removal', function () {
            $(this).closest('.rem').remove();
        });
    });
</script>
<script>
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
$(document).ready(function () {
    $(".bootstrap-tagsinput").prop("class","bootstrap-tagsinput custom-input-field-1");
    set_select();
    set_summer();
});
function set_select() {
    $('.demo-chosen-select').chosen();
    $('.demo-cs-multiselect').chosen({width: '100%'});
}
function get_cat(id) {
    $.ajax({
        url: "<?=base_url()?>admin/blog_post/blog_post/sub_by_cat/"+id,
        success: function(result){
            $("#sub_cat_name").html(result);
            $("#sub_cat").show('slow');
            set_select();
        }
    });
}

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
        $('#video_preview').load('<?php echo base_url(); ?>admin/blog_video/preview/' + site + '/' + video_link);
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
