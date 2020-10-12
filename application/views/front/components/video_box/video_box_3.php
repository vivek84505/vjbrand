<div class="thumbnail video_box_3 hover2">
    <div class="media">
        <?php if($type == 'upload'){?>
            <video height="150">
                <source src="<?php echo base_url();?><?php echo $video_src;?>">
            </video>
        <?php }else{?>
            <iframe height="150" src="<?php echo $video_src;?>" frameborder="0" >
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