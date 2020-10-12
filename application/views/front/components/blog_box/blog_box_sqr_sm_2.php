<?php 
	$img = json_decode($img_features,true);
	foreach($img as $row){
		if($row['index'] == 0){
			$image_link = $this->Crud_model->file_view('blog',$blog_id,'','','no','src','multi','one');
		}
	}
?>

<div class="thumbnail news_box_sqr_2 sm image_delay" data-src="<?php echo $image_link; ?>"  style="background-image:url('<?php echo img_loading(); ?>');">
    <div class="caption">
        <h4 class="caption-title">
            <a href="<?php echo $this->Crud_model->blog_link($blog_id);?>">
                <?php echo word_limiter($title,10);?>
            </a>
        </h4>
        <div class="media-meta">
            <?php /*?><a href="<?php echo $this->Crud_model->blogger_link($blog_blogger_id);?>">
            	<i class="fa fa-user"></i>
				<?php echo $this->Crud_model->get_type_name_by_id('blog_blogger',$blog_blogger_id);?>
            </a>
            <span class="divider">|</span><?php */?>
            <a href="<?php echo base_url(); ?>home/blog/0/0/<?php echo date("Y-m-d",$date);?>/<?php echo date("Y-m-d",$date);?>"><i class="fa fa-clock-o"></i><?php echo date("F j, Y",$date);?></a>
        </div>
    </div>
</div>