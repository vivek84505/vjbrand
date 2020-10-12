<?php foreach ($photo_data as $row) { ?>
    <div class="row">
        <div class="col-md-12">
            <?php
            echo form_open(base_url() . 'admin/photo/update/' . $row['photo_id'], array(
                'class' => 'form-horizontal',
                'method' => 'post',
                'id' => 'photo_edit',
                'enctype' => 'multipart/form-data'
            ));
            ?>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label">
                        <?php echo translate('image'); ?>
                    </label>
                    <div class="img_features col-sm-10">
                        <?php
                        $img_features = json_decode($row['img_features'], true);
                        foreach ($img_features as $row1) {
                            ?>
                            <div class="col-sm-3 rem_div" style="border:1px solid #ccc; border-radius:5px;margin-right:10px; margin-bottom:10px;">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <center>
                                            <div class="col-sm-12" style="padding:10px;">
                                                <?php
                                                if (file_exists('uploads/photo_image/' . $row1['thumb'])) {
                                                    ?>
                                                    <img class="img-responsive img-border blah"  src="<?php echo base_url(); ?>uploads/photo_image/<?php echo $row1['thumb']; ?>" style="height:150px; width:100%;"  >
                                                    <?php
                                                } else {
                                                    ?>
                                                    <img class="img-responsive img-border blah"  src="<?php echo base_url(); ?>uploads/others/default_image.png" style="height:150px; width:100%;" >
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
                        <textarea class="summernotes" data-height="300" data-name="description"><?php echo $row['description']; ?></textarea>
                    </div>
                </div>
            </div>

            <div class="panel-footer">
                <div class="row">
                    <div class="col-md-10">
                        <span class="btn btn-purple btn-labeled fa fa-refresh pro_list_btn pull-right" 
                              onclick="ajax_set_full('edit', '<?php echo translate('add_photo'); ?>', '<?php echo translate('successfully_added!'); ?>', 'photo_edit', '<?php echo $row['photo_id']; ?>');
                              ">
                                  <?php echo translate('reset'); ?>
                        </span>
                    </div>
                    <div class="col-md-1" style="margin-left:1%">
                        <span class="btn btn-success btn-md btn-labeled fa fa-upload pull-right" onclick="form_submit('photo_edit', '<?php echo translate('successfully_added!'); ?>');
                                proceed('to_add');" >
                                  <?php echo translate('upload'); ?>
                        </span>
                    </div>
                </div>
            </div>    
            </form>
        </div>
    </div>
    <input type="hidden" id="photo_id" value="<?php echo $row['photo_id']; ?>" />
<?php } ?>

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
            var news_image_dummy_html = $('#news_image_dummy').html();
            var l = $('#img_count').val();
            ln = parseInt(Number(l) + 1);
            news_image_dummy_html = news_image_dummy_html.replace(/{{i}}/g, ln);
            $('.img_features').append(news_image_dummy_html);
            $('#img_count').val(ln);
            $('#cnt').val(ln);
        });
        $('body').on('click', '.remove_data', function () {
            $(this).addClass('disabled');
            var photo_id = $('#photo_id').val();
            var img_name = $(this).data('img_name');
            var now = $(this);
            setTimeout(function () {
                bootbox.confirm('Really Want to Delete this Image?', function (result) {
                    if (result) {
                        $.ajax({
                            url: "<?php echo base_url(); ?>admin/photo/delete_img/" + photo_id + "/" + img_name,
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
    $(document).ready(function (e) {
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