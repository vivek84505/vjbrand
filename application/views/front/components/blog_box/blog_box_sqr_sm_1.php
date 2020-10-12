<div class="thumbnail news_box_sqr_1 sm hover2">
    <div class="row">
        <div class="col-md-12">
            <div class="media">
                <span class="media-link">
                    <?php 
                        $img = json_decode($img_features,true);
						$i =0;
                        foreach($img as $row){
							$i++;
                            if($i == 1){
                    ?>
                        <img class="img-thumbnail img-responsive image_delay" src="<?php echo img_loading(); ?>" data-src="<?php echo $this->Crud_model->file_view('blog',$blog_id,'','','thumb','src','multi','one');?>" alt=""/>
                    <?php }}?>
                </span> 
            </div>
        </div>
    </div>
    <div class="caption">
        <h4 class="caption-title sm">
            <a href="<?php echo $this->Crud_model->blog_link($blog_id);?>">
                <?php echo word_limiter($title,10);?>
            </a>
        </h4>
        <?php /*?><div class="media-meta">
            <a href="#"><i class="fa fa-user"></i><?php echo $this->Crud_model->get_type_name_by_id('blog_blogger',$blog_blogger_id);?></a>
            <span class="divider">|</span>
            <a href="#"><i class="fa fa-clock-o"></i><?php echo date("l, jS \of F, Y", $timestamp);?></a>
        </div><?php */?>
    </div>
</div>