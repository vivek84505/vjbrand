<?php 
	$img = json_decode($img_features,true);
	foreach($img as $row){
		if($row['index'] == 0){
			$image_link = $this->Crud_model->file_view('news',$news_id,'','','thumb','src','multi','one');
		}
	}
?>

<div class="thumbnail news_box_sqr_2 xs image_delay" data-src="<?php echo $image_link; ?>"  style="background-image:url('<?php echo img_loading(); ?>');">
    <div class="caption">
        <h4 class="caption-title">
            <a href="<?php echo $this->Crud_model->news_link($news_id);?>">
                <?php echo word_limiter($title,5);?>
            </a>
        </h4>
        <div class="media-meta">
            <a href="<?php echo base_url(); ?>home/news/0/0/<?php echo date("Y-m-d",$date);?>/<?php echo date("Y-m-d",$date);?>"><i class="fa fa-clock-o"></i><?php echo date("F j, Y",$date);?></a>
        </div>
    </div>
</div>