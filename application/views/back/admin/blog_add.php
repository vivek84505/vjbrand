<div class="row">
    <div class="col-md-12">
        <?php
        echo form_open(base_url() . 'admin/blog/do_add/', array(
            'class' => 'form-horizontal',
            'method' => 'post',
            'id' => 'blog_add',
            'enctype' => 'multipart/form-data'
        ));
        ?>
        <div class="panel-body">
            <div class="form-group btm_border">
                <label class="col-sm-2 control-label">
                    <?php echo translate('title'); ?>
                </label>
                <div class="col-sm-10">
                    <input type="text" name="title" placeholder="<?php echo translate('title'); ?>" 
                           class="form-control required">
                </div>
            </div>
            <div class="form-group btm_border">
                <label class="col-sm-2 control-label">
                    <?php echo translate('summary'); ?>
                </label>
                <div class="col-sm-10">
                    <textarea class="required" rows="10" cols="135" name="summary" ></textarea>
                </div>
            </div>
            <div class="form-group btm_border">
                <label class="col-sm-2 control-label">
                    <?php echo translate('description'); ?>
                </label>
                <div class="col-sm-10 abstract">
                    <textarea class="summernotes" data-height="300" data-name="description"></textarea>
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
                <button class="btn btn-sm btn-success col-sm-offset-10" id="add_images">
                    <?php echo translate('add_more_image') ?>
                </button>
            </div>
            <div class="clearfix">
            </div>
            <div class="form-group btm_border">
                <label class="col-sm-2 control-label">
                    <?php echo translate('blog_category'); ?>
                </label>
                <div class="col-sm-10">
                    <?php echo $this->Crud_model->select_html('blog_category', 'blog_category', 'name', 'add', 'demo-chosen-select required', '', '', '', 'get_cat') ?>
                </div>
            </div>
            <div class="form-group btm_border" id="sub_cat" style="display:none;">
                <label class="col-sm-2 control-label">
                    <?php echo translate('blog_sub-category'); ?>
                </label>

                <div class="col-sm-10" id="sub_cat_name">

                </div>
            </div>
            <div class="form-group btm_border">
                <label class="col-sm-2 control-label">
                    <?php echo translate('date'); ?>
                </label>
                <div class="col-sm-10">
                    <div class="input-group date" id="datetimepicker">
                        <input type="text" class="form-control" name="date"/>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
            </div>
            <div class="form-group btm_border">
                <label class="col-sm-2 control-label" for="blog_tag">
                    <?php echo translate('tags'); ?>
                </label>
                <div class="col-sm-10">
                    <input type="text" name="tag" id="tag"  data-role="tagsinput" 
                           placeholder="<?php echo translate('tags'); ?>" class="form-control required"  >
                </div>
            </div>
            <div class="form-group btm_border">
                <label class="col-sm-2 control-label">
                    <?php echo translate('publish_/_unpublish'); ?>
                </label>
                <div class="col-sm-10" id="latest_blog">
                    <input class="aiz_switchery1" value="published" type="checkbox" name="status" data-set="status" id="id2" />  
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <div class="row">
                <div class="col-md-10">
                    <span class="btn btn-purple btn-labeled fa fa-refresh pro_list_btn pull-right" 
                          onclick="ajax_set_full('add', '<?php echo translate('add_blog'); ?>', '<?php echo translate('successfully_added!'); ?>', 'blog_add', '');
                          ">
                              <?php echo translate('reset'); ?>
                    </span>
                </div>
                <div class="col-md-1" style="margin-left:1%">
                    <span class="btn btn-success btn-md btn-labeled fa fa-upload pull-right" onclick="form_submit('blog_add', '<?php echo translate('successfully_added!'); ?>'); proceed('to_add');" >
                        <?php echo translate('upload'); ?>
                    </span>
                </div>
            </div>
        </div>    
        </form>
    </div>
</div>
<div id="blog_image_dummy" style="display:none; margin-top:10px">
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
</div>
<script src="<?php echo base_url(); ?>template/back/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js">
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
            var blog_image_dummy_html = $('#blog_image_dummy').html();
            var l = $('#img_count').val();
            ln = parseInt(Number(l) + 1);
            blog_image_dummy_html = blog_image_dummy_html.replace(/{{i}}/g, ln);
            $('.img_features').append(blog_image_dummy_html);
            $('#img_count').val(ln);
            $('#cnt').val(ln);
        });

        $('body').on('click', '.removal', function () {
            $(this).closest('.rem').remove();
        });
    });
</script>
<script>
    function get_cat(id) {
        ajax_load(base_url + 'admin/blog/sub_by_cat/' + id, 'sub_cat_name', 'other');
        //$('#sub_cat').show();
    }
    function save_draft() {
        $('#status').val('not_published');
        setTimeout(form_submit('blog_add', '<?php echo translate('successfully_added!'); ?>'), 500);
    }

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
    function set_select() {
        $('.demo-chosen-select').chosen();
        $('.demo-cs-multiselect').chosen({width: '100%'});
    }
    function other() {
        $('#sub_cat').hide();
        set_select();
        $('#sub_cat').show('slow');
    }
    $(document).ready(function () {
        set_select();
        set_summer();
    });

    $(document).ready(function () {

        $("form").submit(function (e) {
            return false;
        });
    });
</script>

<script>
    $(".aiz_switchery1").each(function () {
        new Switchery($(this).get(0), {
            color: 'rgb(100, 189, 99)', secondaryColor: '#cc2424', jackSecondaryColor: '#c8ff77'});
    });
</script>
<style>
    .btm_border{
        border-bottom: 1px solid #ebebeb;
        padding-bottom: 15px;
    }
    .remove{
        color:#FFF !important;
        margin-right:5px !important;
        font-size:20px !important;
        transition: all .4s ease-in-out;
    }
    .remove:hover{
        color:#003376 !important;
    }
</style>
