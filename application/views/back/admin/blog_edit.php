<?php
foreach ($blog_data as $row) {
    ?>
    <div class="row">
        <div class="col-md-12">
            <?php
            echo form_open(base_url() . 'admin/blog/update/' . $row['blog_id'], array(
                'class' => 'form-horizontal',
                'method' => 'post',
                'id' => 'blog_edit',
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
                               class="form-control required" value="<?php echo $row['title']; ?>">
                    </div>
                </div>
                <div class="form-group btm_border">
                    <label class="col-sm-2 control-label">
                        <?php echo translate('summary'); ?>
                    </label>
                    <div class="col-sm-10">
                        <textarea rows="10" cols="135" class="required" name="summary" ><?php echo $row['summary']; ?></textarea>
                    </div>
                </div>
                <div class="form-group btm_border">
                    <label class="col-sm-2 control-label">
                        <?php echo translate('description'); ?>
                    </label>
                    <div class="col-sm-10 abstract">
                        <textarea class="summernotes required" data-height="300" data-name="description">
                            <?php echo $row['description']; ?>
                        </textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">
                        <?php echo translate('image'); ?>
                    </label>
                    <div class="img_features col-sm-10">
                        <?php
                        $img_features = json_decode($row['img_features'], true);
                        $count = 0;
                        foreach ($img_features as $row1) {
                            ?>
                            <div class="col-sm-3 rem_div" style="border:1px solid #ccc; border-radius:5px;margin-right:10px; margin-bottom:10px;">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <center>
                                            <div class="col-sm-12" style="padding:10px;">
                                                <?php
                                                if (file_exists('uploads/blog_image/' . $row1['thumb'])) {
                                                    ?>
                                                    <img class="img-responsive img-border blah"  src="<?php echo base_url(); ?>uploads/blog_image/<?php echo $row1['thumb']; ?>" style="width:100%;"  >
                                                    <?php
                                                } else {
                                                    ?>
                                                    <img class="img-responsive img-border blah"  src="<?php echo base_url(); ?>uploads/blog_image/default.jpg" style="width:100%;" >
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </center>
                                    </div>
                                    <div class="col-sm-12">
                                        <?php
                                        if ($row1['index'] !== 0) {
                                            ?>
                                            <div class="col-sm-6">
                                                <span class="pull-left btn btn-sm btn-default btn-file">
                                                    <?php echo translate('select_image'); ?>
                                                    <input type="file" name="nimg[<?php echo $row1['index']; ?>]" class="form-control imgInp">
                                                </span>
                                            </div>
                                            <div class="col-sm-6">
                                                <span class="pull-right btn btn-sm btn-danger remove_data" data-img_name="<?php echo $row1['img']; ?>">
                                                    <?php echo translate('remove'); ?>
                                                </span>
                                            </div>
                                            <?php
                                        } else {
                                            ?>
                                            <span class="pull-left btn btn-sm btn-default btn-file btn-block">
                                                <?php echo translate('select_image') . ' (' . translate('main') . ')*'; ?>
                                                <input type="file" name="nimg[<?php echo $row1['index']; ?>]" class="form-control imgInp">
                                                <input type="hidden" name="cnt[<?php echo $row1['index']; ?>]" id="cnt" class="form-control" />
                                            </span>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>               
                            </div>
                            <?php
                        $count = $row1['index'];
                        }
                        ?>
                        <input type="hidden" id="img_count" value="<?php echo $count; ?>" />
                    </div>
                </div>

                <div class="form-group btm_border">
                    <button class="btn btn-sm btn-success col-sm-offset-10" id="add_images">
                        <?php echo translate('add_more_image') ?>
                    </button>
                </div>
                <div class="clearfix"></div>

                <div class="form-group btm_border">
                    <label class="col-sm-2 control-label">
                        <?php echo translate('blog_category'); ?>
                    </label>
                    <div class="col-sm-10">
                        <?php echo $this->Crud_model->select_html('blog_category', 'blog_category', 'name', 'edit', 'demo-chosen-select required', $row['blog_category_id'], '', '', 'get_cat'); ?>
                    </div>
                </div>
                <div class="form-group btm_border" id="sub">
                    <label class="col-sm-2 control-label">
                        <?php echo translate('blog_sub-category'); ?>
                    </label>
                    <div class="col-sm-10" id="sub_cat_db">
                        <?php echo $this->Crud_model->select_html('blog_sub_category', 'blog_sub_category', 'name', 'edit', 'demo-chosen-select', $row['blog_sub_category_id'], '', '', '') ?>
                    </div>
                    <div class="col-sm-10" id="sub_cat" style="display:none">

                    </div>
                </div>

                <div class="form-group btm_border">
                    <label class="col-sm-2 control-label">
                        <?php echo translate('date'); ?>
                    </label>
                    <div class="col-sm-10">
                        <div class="input-group date" id="datetimepicker">
                            <input type="text" class="form-control" name="date" 
                                   value="<?php echo date("m/d/Y g:i a", $row['date']); ?>"/>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="form-group btm_border">
                    <label class="col-sm-2 control-label">
                        <?php echo translate('tags'); ?>
                    </label>
                    <div class="col-sm-10">
                        <input type="text" name="tag" data-role="tagsinput" class="form-control required"
                               placeholder="<?php echo translate('tags'); ?>" value="<?php echo $row['tag']; ?>">
                    </div>
                </div>
                <div class="form-group btm_border">
                    <label class="col-sm-2 control-label">
                        <?php echo translate('publish_/_unpublish'); ?>
                    </label>
                    <div class="col-sm-6">
                        <input class='aiz_switchery1' value="published" type="checkbox" name="status" id="id2"
                               data-set='status2' 
                               data-id='<?php echo $row['blog_id']; ?>' 
                               data-tm='<?php echo translate('blog_published'); ?>' 
                               data-fm='<?php echo translate('blog_unpublished'); ?>' 
                               <?php if ($row['status'] == 'published') { ?>checked<?php } ?> />
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <div class="row">
                    <div class="col-md-11">
                        <span class="btn btn-purple btn-labeled fa fa-refresh pro_list_btn pull-right" 
                              onclick="ajax_set_full('edit', '<?php echo translate('edit_blog'); ?>', '<?php echo translate('successfully_edited!'); ?>', 'blog_edit', '<?php echo $row['blog_id']; ?>')"><?php echo translate('reset'); ?>
                        </span>
                    </div>
                    <div class="col-md-1">
                        <span class="btn btn-success btn-md btn-labeled fa fa-upload pull-right enterer" onclick="form_submit('blog_edit', '<?php echo translate('successfully_edited!'); ?>'); proceed('to_add');" ><?php echo translate('edit'); ?></span>
                    </div>
                </div>
            </div>                   

            <input type="hidden" id="id5" value="<?php echo $row['status'] ?>" name="">
            </form>
        </div>
    </div>
    <input type="hidden" id="nums" value='1' />                                    
    <?php
}
?>
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
<script src="<?php echo base_url(); ?>template/back/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>    

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

        $('body').on('click', '.removal', function () {
            $(this).closest('.rem').remove();
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
        $('body').on('click', '.remove_data', function () {
            $(this).addClass('disabled');
            var img_name = $(this).data('img_name');
            var now = $(this);
            setTimeout(function () {
                bootbox.confirm('Really Want to Delete this Image?', function (result) {
                    if (result) {
                        $.ajax({
                            url: "<?php echo base_url(); ?>admin/blog/delete_img/<?php echo $row['blog_id']; ?>/" + img_name,
                            beforeSend: function () {
                                now.closest('.rem_div').css('opacity', '.5');
                            },
                            success: function (result) {
                                now.closest('.rem_div').remove();
                                $.activeitNoty({
                                    type: 'danger',
                                    icon: 'fa fa-check',
                                    message: 'Image Deleted!',
                                    container: 'floating',
                                    timer: 3000
                                });
                            }
                        });
                        sound('delete');
                    } else {
                        $.activeitNoty({
                            type: 'danger',
                            icon: 'fa fa-minus',
                            message: 'Cncelled!',
                            container: 'floating',
                            timer: 3000
                        });
                        sound('cancelled');
                        now.removeClass('disabled');
                    }
                    ;
                });
            }, 500)
        });
    });
</script>
<script>
    function other_forms() {}
    function get_cat(id) {
        $('#sub').hide();
        $('#sub_cat_db').html('');
        ajax_load(base_url + 'admin/blog/sub_by_cat/' + id, 'sub_cat', 'other');
    }
    function other() {
        set_select();
        $('#sub').show('slow');
        $('#sub_cat').show('slow');
    }
    function set_select() {
        $('.demo-chosen-select').chosen();
        $('.demo-cs-multiselect').chosen({width: '100%'});
    }
    function save_draft() {
        $('#status').val('not_published');
        setTimeout(form_submit('blog_edit', '<?php echo translate('successfully_edited!'); ?>'), 500);
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

    $(document).ready(function () {
        set_select();
        set_summer();

        $('.blog_select').each(function (index, element) {
            var a = $(this).val();
            $(this).closest('.sets').find('.hidd').val(a);
        });

    });

    $("#blog_name").blur(function () {
        var val = $(this).val();
        val = val.split(' ').join('_');
        $("#blog_code").val(val);
    });

    $('body').on('click', '.rmc', function () {
        $(this).closest('.sets').remove();
    });

    $('body').on('change', '.blog_select', function () {
        var a = $(this).val();
        $(this).closest('.sets').find('.hidd').val(a);
    });

    $('body').on('change', '.size', function () {
        var a = $(this).val();
        var p = $(this).parent().parent().parent().parent();
        p.attr('class', '');
        p.addClass('sets');
        p.addClass('col-md-' + a);
    });

    $('body').on('change', '.type', function () {
        var h = $(this);
        var a = h.val();
        if (a == 'blog') {
            h.parent().parent().find('.blog').show();
            h.parent().parent().find('.content').hide();
        } else if (a == 'content') {
            h.parent().parent().find('.blog').hide();
            h.parent().parent().find('.content').show();
        }
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









