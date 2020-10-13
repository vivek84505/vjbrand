<?php
	$photos = json_decode($image,true);
	foreach($photos as $rows){
		$main = $rows['img'];
		$thumb = $rows['thumb'];
	}
?>
<div class="thumbnail reporter_box_1 hover4">
	<div class="row">
        <div class="col-md-4 pad-lr-5">
            <div class="media">
                <?php
                    if(file_exists('uploads/news_reporter_image/'.$thumb))
                    {
                ?>
                <center>
                    <img class="media-object img-responsive image_delay" src="<?php echo img_loading(); ?>" data-src="<?php echo base_url(); ?>uploads/news_reporter_image/<?php echo $thumb;?>"  />
                </center>
                <?php
                    }else {
                ?>
                    <center>
                        <img class="media-object img-responsive image_delay" src="<?php echo img_loading(); ?>" data-src="<?php echo base_url(); ?>uploads/others/default_image.png">

                    </center>
                <?php
                    }
                ?>
            </div>
        </div>
        <div class="col-md-8 pad-lr-5">
            <div class="caption">
                <h3 class="caption-title">
                    <a href="<?php echo $this->Crud_model->reporter_link($news_reporter_id);?>">
                        <?php echo $name; ?>
                    </a>
                </h3>
                <p><?php echo $designation; ?></p>
                <ul class="social-icons">
                	<?php
                    	$socials = json_decode($social_account,true);
						if(!empty($socials)){
							foreach($socials as $sa){
                     			if(!empty($sa['value'])){
					?>
                    <li>
                    	<a href="<?php echo $sa['value'];?>" class="<?php echo $sa['type']; ?>" target="_blank">
                        	<i class="fa fa-<?php echo $sa['type']; ?>"></i>
                        </a>
                    </li>
                    <?php
								}
							}
						}
					?>
                </ul>
            </div>
        </div>
    </div>
</div>
