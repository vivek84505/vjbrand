<?php
    foreach ($get_subscription as $value)
    {
?>
    <div class="row">
        <div class="col-md-12">
            <?php
            echo form_open(base_url() . 'admin/subscription/update/' . $value->subscription_id, array(
                'class' => 'form-horizontal',
                'method' => 'post',
                'id' => 'subscription_uploader_edit',
                'enctype' => 'multipart/form-data'
            ));
            ?>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="demo-hor-name"><b><?php echo translate('subscription_name');?></b></label>
                    <div class="col-sm-9">
                        <input type="hidden" class="form-control" name="subscription_id" value="<?=$value->subscription_id?>">
                        <input type="text" class="form-control" name="name" value="<?=$value->name?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="demo-hor-amount"><b><?php echo translate('amount');?> (<?php echo currency('','def'); ?>)</b></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="amount" value="<?=$value->amount?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="post_amount"><b><?php echo translate('amount_of_posts');?><?php echo translate('amount_of_posts');?></b></label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" name="post_amount" value="<?=$value->post_amount?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="video_amount"><b><?php echo translate('amount_of_videos');?></b></label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" name="video_amount" value="<?=$value->video_amount?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="photo_amount"><b><?php echo translate('amount_of-images');?></b></label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" name="photo_amount" value="<?=$value->photo_amount?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="image"><b><?php echo translate('subscription_image');?></b></label>
                    <div class="col-sm-10">
                        <div class="col-sm-6" style="margin:2px; padding:2px;">
                            <?php
                                $image = $value->image;
                                $images = json_decode($image, true);
                                //print_r($images);
                                if (file_exists('uploads/subscription_image/'.$images[0]['image'])) {
                                ?>
                                    <img class="img-responsive img-border blah" src="<?=base_url()?>uploads/subscription_image/<?=$images[0]['image']?>" class="img-sm">
                                <?php
                                }
                                else {
                                ?>
                                    <img class="img-responsive img-border blah" src="<?=base_url()?>uploads/subscription_image/default_image.png" class="img-sm">
                                <?php
                                }
                            ?>
                        </div>
                        <!-- <div class="col-sm-2"></div> -->
                    </div>
                    <div class="col-sm-12" style="margin-top: 10px">
                        <div class="col-sm-10 col-sm-offset-2" >
                            <span class="pull-left btn btn-default btn-file margin-top-10">
                                <?php echo translate('select_a_photo');?>
                                <input type="file" name="image" class="form-control imgInp">
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <div class="row">
                    <div class="col-md-11">
                        <span class="btn btn-purple btn-labeled fa fa-refresh pro_list_btn pull-right"
                              onclick="ajax_set_full('edit', '<?php echo translate('edit_subscription'); ?>', '<?php echo translate('successfully_edited!'); ?>', 'subscription_uploader_edit', '<?php echo $value->subscription_id; ?>')">
                                  <?php echo translate('reset'); ?>
                        </span>
                    </div>
                    <div class="col-md-1">
                        <span class="btn btn-success btn-md btn-labeled fa fa-upload pull-right loc" onclick="form_submit('subscription_uploader_edit', '<?php echo translate('successfully_edited!'); ?>')" ><?php echo translate('upload'); ?></span>
                    </div>

                </div>
            </div>
            </form>
        </div>
    </div>
    <?php
}
?>

<script>
    // SCRIT FOR IMAGE UPLOAD
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
</script>
