<div class="thumbnail news_box_sqr_1 hover2">
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
        <h4 class="caption-title">
            <a href="<?php echo $this->Crud_model->blog_link($blog_id);?>">
                <?php echo word_limiter($title,20);?>
            </a>
        </h4>
        <div class="media-meta">
            <a href="<?php echo $this->Crud_model->blogger_link($blog_uploader_id);?>">
            	<i class="fa fa-user"></i>
				<?php echo $this->Crud_model->get_type_name_by_id('user',$blog_uploader_id,'firstname');?>
            </a>
            <span class="divider">|</span>
            <a href="<?php echo base_url(); ?>home/blog/0/0/<?php echo date("Y-m-d",$date);?>/<?php echo date("Y-m-d",$date);?>"><i class="fa fa-clock-o"></i><?php echo date("F j, Y",$date);?></a>
            <span class="divider">|</span>
            <span class="read_later" onclick="to_readlater(<?php echo $blog_id; ?>,event)" data-toggle="tooltip" title="<?php echo translate('read_later'); ?>" data-placement="bottom">
            	<i class="fa fa-bookmark"></i>
           	</span>
        </div>
    </div>
</div>