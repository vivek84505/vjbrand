<div class="thumbnail news_box_sqr_1">
    <div class="row">
        <div class="col-md-12">
            <div class="media">
                <span class="media-link">
                    <?php 
                        $img = json_decode($rows['img_features'],true);
                        foreach($img as $row){
                            if($row['index'] == 0){
                    ?>
                        <img class="img-thumbnail image_delay" style="height:260px;" src="<?php echo img_loading(); ?>" data-src="<?php echo base_url();?>uploads/blog_image/<?php echo $row['thumb'];?>" alt=""/>
                    <?php }}?>
                </span> 
            </div>
        </div>
    </div>
    <div class="caption">
        <h4 class="caption-title">
            <a href="<?php echo base_url();?>home/blog_description/<?php echo $rows['blog_id'] ;?>">
                <?php echo word_limiter($rows['title'],20);?>
            </a>
        </h4>
        <div class="media-meta">
            <a href="#"><i class="fa fa-user"></i><?php echo $this->Crud_model->get_type_name_by_id('blog_blogger',$rows['blog_blogger_id']);?></a>
            <span class="divider">|</span>
            <a href="#"><i class="fa fa-clock-o"></i><?php echo date("l, jS \of F, Y", $rows['timestamp']);?></a>
        </div>
    </div>
</div>