<?php foreach ($photo_data as $row) { ?>
    <div class="row">
        <div class="col-md-12">
            <?php
            echo form_open(base_url() . 'admin/blog_photo/update/' . $row['blog_photo_id'], array(
                'class' => 'form-horizontal',
                'method' => 'post',
                'id' => 'blog_photo_edit',
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
                                                if (file_exists('uploads/blog_photo_image/' . $row1['thumb'])) {
                                                    ?>
                                                    <img class="img-responsive img-border blah"  src="<?php echo base_url(); ?>uploads/blog_photo_image/<?php echo $row1['thumb']; ?>" style="height:150px; width:100%;"  >
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
                              onclick="ajax_set_full('edit', '<?php echo translate('add_photo'); ?>', '<?php echo translate('successfully_added!'); ?>', 'blog_photo_edit', '<?php echo $row['blog_photo_id']; ?>');
                              ">
                                  <?php echo translate('reset'); ?>
                        </span>
                    </div>
                    <div class="col-md-1" style="margin-left:1%">
                        <span class="btn btn-success btn-md btn-labeled fa fa-upload pull-right" onclick="form_submit('blog_photo_edit', '<?php echo translate('successfully_added!'); ?>');
                                proceed('to_add');" >
                                  <?php echo translate('upload'); ?>
                        </span>
                    </div>
                </div>
            </div>    
            </form>
        </div>
    </div>
    <input type="hidden" id="blog_photo_id" value="<?php echo $row['blog_photo_id']; ?>" />
<?php } ?>

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