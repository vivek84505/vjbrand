<div class="news_box_rect_1 thumb hover3">
    <div class="media">
        <span class="pull-left media-link">
        	<?php 
				$img = json_decode($img_features,true);
				foreach($img as $row){
					if($row['index'] == 0){
			?>
            <img class="media-object img-responsive image_delay" src="<?php echo img_loading(); ?>" data-src="<?php echo $this->Crud_model->file_view('blog',$blog_id,'','','thumb','src','multi','one');?>" alt="">
            <?php }}?>
        </span>
        <div class="media-body">
            <h4 class="media-heading">
            	<a href="<?php echo $this->Crud_model->blog_link($blog_id);?>">
            		<?php echo word_limiter($title,10);?>
                </a>
            </h4>
        </div>
    </div>
</div>