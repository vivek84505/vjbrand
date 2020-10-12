<?php 
    $imgs = json_decode($img_features,true);
    foreach ($imgs as $roq) {
        if($roq['index'] == '0'){
            $img = $roq['img'];
        }
    }
    $image = base_url().'uploads/photo_image/'.$img;
?>
<div class="thumbnail photo_box_1 hover2">
    <div class="media">
        <img class="media-object img-responsive image_delay" src="<?php echo img_loading(); ?>" data-src="<?php echo $image; ?>" alt="">
        <div class="caption hovered">
            <div class="caption-wrapper div-table">
                <div class="caption-inner div-cell">
                    <p class="caption-buttons hidden-xs">
                        <span class="btn caption-zoom" onClick="image_modal('<?php echo $image; ?>');">
                            <i class="fa fa-search"></i>
                        </span>
                        <a href="<?php echo $this->Crud_model->photo_link($photo_id); ?>" class="btn caption-link"><i class="fa fa-link"></i></a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="caption">
        <h3 class="caption-title">
            <a href="<?php echo $this->Crud_model->photo_link($photo_id); ?>">
                <?php echo word_limiter($title, 5); ?>
            </a>
        </h3>
    </div>
</div>