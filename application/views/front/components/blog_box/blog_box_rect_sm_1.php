<div class="thumbnail news_box_rect_1 sm hover2">
    <div class="caption top">
        <h4 class="caption-title">
            <a href="<?php echo $this->Crud_model->blog_link($blog_id);?>">
                <?php echo word_limiter($title,10);?>
            </a>
        </h4>
        <div class="media-meta sm">
            <?php if($blog_uploader_type == 'admin'){ ?> <a href="#"><i class="fa fa-user"></i><?php echo translate('admin'); ?></a><?php } else{ ?>
                <a href="<?php echo $this->Crud_model->bloggers_link($blog_uploader_id);?>">
                	<i class="fa fa-user"></i>
    				<?php echo $this->Crud_model->get_type_name_by_id('user',$blog_uploader_id,'firstname').' '.$this->Crud_model->get_type_name_by_id('user', $blog_uploader_id,'lastname');?>
                </a>
            <?php } ?>
            <span class="divider">|</span>
            <a href="<?php echo base_url(); ?>home/blog_category/0/0/<?php echo date("Y-m-d", $date) ?>"><i class="fa fa-clock-o"></i><?php echo date("F j, Y",$date);?></a>
            <span class="divider">|</span>
            <a href="<?php echo $this->Crud_model->blog_link($blog_id);?>"><i class="fa fa-eye"></i><?php echo $this->Crud_model->get_type_name_by_id('blog',$blog_id,'view_count').' '.translate('views');?></a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="media">
                <span class="media-link">
                    <?php
                        $imgs = json_decode($img_features, true);
                        $img_url = base_url()."uploads/blog_image/default.jpg";
                        if (!empty($imgs)) {
                            $i=0;
                            foreach ($imgs as $roq) {
                                if($i == 0){
                                    $img = $roq['img'];
                                }
                                $i++;
                            }
                            $img_url = base_url()."uploads/blog_image/".$img;
                        }
                    ?>
                        <img class="img-thumbnail img-responsive image_delay" src="<?php echo img_loading(); ?>" data-src="<?=$img_url?>" alt=""/>
                </span>
            </div>
        </div>
        <div class="col-md-8 pad-l-0 hidden-sm hidden-xs">
            <div class="caption down">
                <div class="caption-text">
                    <?php echo word_limiter($summary,15);?>
                </div>
            </div>
        </div>
    </div>
</div>
