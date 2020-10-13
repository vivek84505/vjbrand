<div class="thumbnail video_box_3 hover2">
    <div class="embed-responsive embed-responsive-16by9 media">
        <?php if($type == 'upload'){?>
            <video height="150">
                <source src="<?php echo base_url();?><?php echo $video_src;?>">
            </video>
        <?php }else{?>
            <iframe src="<?php echo $video_src;?>" frameborder="0" class="embed-responsive-item">
            </iframe>
        <?php }?>
    </div>
    <div class="caption">
        <h6 class="caption-title">
        	<a href="<?php echo $this->Crud_model->video_link($video_id);?>">
				<?php echo word_limiter($title,3);?>
            </a>
        </h6>
    </div>
</div>
