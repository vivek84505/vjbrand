<div class="thumbnail news_box_sqr_1 sm hover2">
    <div class="row">
        <div class="col-md-12">
            <div class="media">
                <span class="media-link">
                    <?php
                        $img = json_decode($img_features,true);
                        foreach($img as $row){
                            if($row['index'] == 0){
                    ?>
                        <img class="img-thumbnail img-responsive image_delay" src="<?php echo img_loading(); ?>" data-src="<?php echo $this->Crud_model->file_view('news',$news_id,'','','thumb','src','multi','one');?>" alt=""/>
                    <?php }}?>
                </span>
            </div>
        </div>
    </div>
    <div class="caption">
        <h4 class="caption-title sm">
            <a href="<?php echo $this->Crud_model->news_link($news_id);?>">
                <?php echo word_limiter($title,10);?>
            </a>
        </h4>
        <?php /*?><div class="media-meta">
            <a href="#"><i class="fa fa-user"></i><?php echo $this->Crud_model->get_type_name_by_id('news_reporter',$news_reporter_id);?></a>
            <span class="divider">|</span>
            <a href="#"><i class="fa fa-clock-o"></i><?php echo date("l, jS \of F, Y", $timestamp);?></a>
        </div><?php */?>
    </div>
</div>
