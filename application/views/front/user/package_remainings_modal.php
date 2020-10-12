<div class="modal_wrap">
    <div class="row get_into" id="ad_info">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="row box_shape2">
                <div class="title">
                    <?php echo translate('confirm_your_post');?>
                </div>
                <hr>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                	<center>
                        <?php if ($type == 'blog'){
                            $remain_text = translate('your_remaining_blog_post_is')." : ". $user_info->post_amount;
                            $warning_text = translate('every_blog_post_will_cost_1_from_your_remaining_blog_post');
                        } elseif ($type == 'image') {
                            $remain_text = translate('your_remaining_blog_image_post_is')." : ". $user_info->photo_amount;
                            $warning_text = translate('every_blog_image_post_will_cost_1_from_your_remaining_blog_image_post');
                        } elseif ($type == 'video') {
                            $remain_text = translate('your_remaining_blog_video_post_is')." : ". $user_info->video_amount;
                            $warning_text = translate('every_blog_video_post_will_cost_1_from_your_remaining_blog_video_post');
                        }
                        ?>

                        <?php if ($user_info->post_amount > 0): ?>
                            <p><b><?php echo $remain_text;?></b></p>
                            <p class="text-danger">**<?php echo $warning_text;?>**</p>
                        <?php endif ?>

                        <?php if ($user_info->post_amount <= 0): ?>
                            <p class="text-danger"><?php echo translate('you_have_no_remaining_post._please_purchase_package_from_premium_post_package');?></p>
                        <?php endif ?>
                    </center>
                </div>
                <hr>
                <div class="col-lg-8 col-md-8 col-md-offset-2 col-sm-8 col-xs-12 text-center">
                    <?php if ($type == 'blog'){
                        $css_text = "pfp_submit";
                    } elseif ($type == 'image'){
                        $css_text = "pfp_image_submit";
                    } elseif ($type == 'video'){
                        $css_text = "pfp_video_submit";
                    }
                    ?>

                    <?php
                        if ($type == 'blog' && $user_info->post_amount > 0) {
                        ?>
                            <button type="button" class="btn btn-blue btn-sm <?=$css_text?>" style="width: 50%">
                                <span><?php echo translate('confirm');?></span>
                            </button>
                        <?php
                        } elseif ($type == 'image' && $user_info->photo_amount > 0) {
                        ?>
                            <button type="button" class="btn btn-blue btn-sm <?=$css_text?>" style="width: 50%">
                                <span><?php echo translate('confirm');?></span>
                            </button>
                        <?php
                        } elseif ($type == 'video' && $user_info->video_amount > 0) {
                        ?>
                            <button type="button" class="btn btn-blue btn-sm <?=$css_text?>" style="width: 50%">
                                <span><?php echo translate('confirm');?></span>
                            </button>
                        <?php
                        }
                    ?>

                    <?php
                        if ($type == 'blog' && $user_info->post_amount <= 0) {
                        ?>
                            <a href="<?=base_url()?>home/profile/pp" class="btn btn-blue btn-sm">
                                <span><?php echo translate('premium_post_package');?></span>
                            </a>
                        <?php
                        } elseif ($type == 'image' && $user_info->photo_amount <= 0) {
                        ?>
                            <a href="<?=base_url()?>home/profile/pp" class="btn btn-blue btn-sm">
                                <span><?php echo translate('premium_post_package');?></span>
                            </a>
                        <?php
                        } elseif ($type == 'video' && $user_info->video_amount <= 0) {
                        ?>
                            <a href="<?=base_url()?>home/profile/pp" class="btn btn-blue btn-sm">
                                <span><?php echo translate('premium_post_package');?></span>
                            </a>  
                        <?php
                        }
                    ?>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<style>
	.modal_wrap{
		padding: 20px 0px;
	}
	.get_into hr {
		border: 1px solid #e8e8e8  !important;
		height: 0px !important;
		background-image: none !important;
		margin:10px 0px;
	}
	.box_shape2 {
		padding: 15px;
		border: solid 1px #e9e9e9;
		background-color: #ffffff;
		margin: -25px 20px;
	}
	label ol{
		margin-bottom:0px;
	}
</style>