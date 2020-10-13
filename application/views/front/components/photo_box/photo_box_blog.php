<?php 
    $imgs = json_decode($img_features,true);
    foreach ($imgs as $roq) {
        if($roq['index'] == '0'){
            $img = $roq['img'];
        }
    }
    $image = base_url().'uploads/blog_photo_image/'.$img;
?>
<div class="thumbnail photo_box_2">
    <div class="media">
        <div class="media-object img-responsive image_delay" data-src="<?php echo $image; ?>" style="height: 180px; background-image: url('<?php echo img_loading();?>');background-repeat: no-repeat; background-position: center; background-size: cover;"></div>
        <div class="caption hovered">
            <div class="caption-wrapper div-table">
                <div class="caption-inner div-cell">
                    <p class="caption-buttons hidden-xs">
                        <span class="btn caption-zoom" onClick="image_modal('<?php echo $image; ?>');">
                            <i class="fa fa-search"></i>
                        </span>
                        <a href="<?php echo $this->Crud_model->blog_photo_link($blog_photo_id);?>" class="btn caption-link"><i class="fa fa-link"></i></a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="caption title">
        <h3 class="caption-title">
            <a href="<?php echo $this->Crud_model->blog_photo_link($blog_photo_id);?>">
                <?php echo word_limiter($title, 5); ?>
            </a>
        </h3>
    </div>
</div>
