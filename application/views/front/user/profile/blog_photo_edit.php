<div class="information-title">
    <?php echo translate('edit_blog_photo');?>
</div>
<div class="details-wrap">
    <div class="row">
        <div class="col-md-12">
        	<div class="details-wrap">
                <div class="details-box">
                    <div class="row">
                    	<div class="col-md-12">
	                    	<?php
	                            echo form_open(base_url().'home/profile/pay_for_image_post/update', array(
	                                'id' => 'pfp_image_edit_form',
	                                'class' => 'form-delivery',
	                                'method' => 'post',
	                                'enctype' => 'multipart/form-data'
	                            ));
	                        ?>
	                        	<?php
				                    foreach ($get_blog_photo as $value) {
				                    ?>
		                        	<div class="panel-body">
		                        		<div class="row">
		                        			<div class="col-md-12 col-sm-12">
			                                    <span class="inputt custom-input-1 input-filled">
			                                    	<input class="" type="hidden" name="blog_photo_id" value="<?=$value->blog_photo_id?>"/>
			                                        <input class="custom-input-field-1" type="text" id="title" name="title" value="<?=$value->title?>" required/>
			                                        <label class="input-label custom-input-label-1" style="left:0;">
			                                            <span class="input-label-content custom-input-label-content" data-content="<?php echo translate('title');?>"><?php echo translate('title');?></span>
			                                        </label>
			                                    </span>
			                                </div>
			                                <div class="col-md-12 col-sm-12">
			                                    <span class="inputt custom-input-1 input-filled">
			                                        <textarea class="custom-input-field-1 txt_editor" cols="25" id="description" name="description" required><?=$value->description?></textarea>
			                                        <label class="input-label custom-input-label-1" style="left:0;">
			                                            <span class="input-label-content custom-input-label-content" data-content="<?php echo translate('description');?>"><?php echo translate('description');?></span>
			                                        </label>
			                                    </span>
			                                </div>
			                                <div class="form-group">
			                                    <label class="col-sm-2 control-label" for="demo-is-inputsmall" style="left:0;">
			                                        <?php echo translate('image'); ?>
			                                    </label>
			                                    <div class="img_features col-sm-12">
			                                        <?php
			                                        $images = json_decode($value->img_features,true);
			                                        $count = 0;
													$i = 0;
			                                        foreach ($images as $row) {
														$i++;
			                                        ?>
			                                            <div class="col-sm-4 rem_div" style="margin-bottom:10px;">
			                                                <div class="form-group">
			                                                    <div class="col-sm-12">
			                                                        <center>
			                                                            <?php
			                                                            if (file_exists('uploads/blog_photo_image/' . $row['thumb'])) {
			                                                                ?>
			                                                                <img class="img-responsive img-border blah"  src="<?php echo base_url(); ?>uploads/blog_photo_image/<?php echo $row['thumb']; ?>" style="width:100%; border: 1px solid #ccc; height: 150px">
			                                                                <?php
			                                                            } else {
			                                                                ?>
			                                                                <img class="img-responsive img-border blah"  src="<?php echo base_url(); ?>uploads/blog_photo_image/default.jpg" style="width:100%; border: 1px solid #ccc; height: 150px">
			                                                                <?php
			                                                            }
			                                                            ?>
			                                                        </center>
			                                                    </div>
			                                                    <!-- <div class="row" style="margin-top: 10px; margin-bottom: 10px;"> -->
			                                                        <?php
			                                                        if ($row['index'] !== 0) {
			                                                            ?>
			                                                            <div class="col-sm-7" style="margin:10px 0; padding-right: 5px">
			                                                                <!-- <span class="pull-left btn btn-sm btn-default btn-file"> -->
			                                                                    <?php //echo translate('select_image'); ?>
			                                                                <!-- </span> -->
			                                                                <label for="ext_img[<?=$row['index']?>]" class="pull-left btn btn-xs btn-blue btn-file btn-block" style="text-transform: none;"><?php echo translate('select_image'); ?></label>
			                                                                <input type="file" id="ext_img[<?=$row['index']?>]" name="nimg[<?php echo $row['index']; ?>]" class="form-control imgInp" style="display: none;">
			                                                            </div>
			                                                            <?php
			                                                        } else {
			                                                            ?>
			                                                            <div class="col-sm-12" style="margin: 10px 0;">
			                                                                <label for="main_img" class="pull-left btn btn-xs btn-blue btn-file btn-block" style="text-transform: none;"><?php echo translate('select_image') . ' (' . translate('main') . ')*'; ?>
			                                                                </label>
			                                                                <input type="file" id="main_img" name="nimg[<?php echo $row['index']; ?>]" class="form-control imgInp" style="display: none;">
			                                                                <input type="hidden" name="cnt[<?php echo $row['index']; ?>]" id="cnt" class="form-control" />
			                                                            </div>
			                                                            <?php
			                                                        }
			                                                        ?>
			                                                    <!-- </div> -->
			                                                </div>
			                                            </div>
			                                        <?php
			                                        	$count = $row['index'];
			                                        }
													if($i == 0){
			                                        ?>
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

	                                                <?php
													}
													?>
			                                    </div>
			                                </div>
			                                <div class="col-md-12 col-sm-12">
			                                    <span class="button-custom-btn-1 signup_btn enterer pull-right custom-btn-1-round-l custom-btn-1 custom-btn-1-text-thick custom-btn-1-text-upper custom-btn-1-size-s" data-unsuccessful='<?php echo translate('submit_unsuccessful!'); ?>' data-success='<?php echo translate('submitted_successfully!'); ?>' data-ing='<?php echo translate('submitting..') ?>' data-text="<?php echo translate('submit');?>" data-reload="blog_list">
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

        $('body').on('click', '.removal', function () {
            $(this).closest('.rem').remove();
        });
    });
</script>
