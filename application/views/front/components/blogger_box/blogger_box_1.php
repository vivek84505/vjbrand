<?php
	/*$photos = json_decode($image,true);
	foreach($photos as $rows){
		$main = $rows['img'];
		$thumb = $rows['thumb'];
	}*/
?>
<div class="thumbnail reporter_box_1 hover4">
	<div class="row">
        <div class="col-md-4 pad-lr-5">
            <div class="media">
                <?php
                    if(file_exists('uploads/user_image/user_'.$user_id.'_thumb.jpg'))
                    {
                ?>
                <center>
                    <div style="background-image: url(<?php echo base_url(); ?>uploads/user_image/user_<?=$user_id?>_thumb.jpg); height: 122px; width: 122px; border-radius: 50%; background-repeat: no-repeat; background-position: center; background-size: cover;"></div>
                </center>
                <?php 
                    }else {
                ?>
                    <center>
                        <div style="background-image: url(<?php echo base_url(); ?>uploads/user_image/default.jpg); height: 122px; width: 122px; border-radius: 50%; background-repeat: no-repeat; background-position: center; background-size: cover;"></div>
                    </center>
                <?php
                    }
                ?>
            </div>
        </div>
        <div class="col-md-8 pad-lr-5">
            <div class="caption text-center" style="margin-top: 45px">
                <h3 class="caption-title">
                    <a href="<?php echo $this->Crud_model->bloggers_link($user_id);?>">
                        <?php echo $firstname." ".$lastname; ?>
                    </a>
                </h3>
            </div>
        </div>
    </div>
</div>