<!-- Blog posts -->
<?php
$row_index = 1;
$item_index = 1;
$get_blog = $this->db->get_where('blog', array('status' => 'published', 'hide_status' => 'false'))->result();
foreach ($get_blog as $value) {
	$pad_class = "";
	if ($row_index == 1 || $row_index % 2 != 0) { 
	?>
		<div class="row <?php if($row_index != 1){echo 'mar-t-15';}?>">
	<?php 
	}
		if($item_index == 1 || $item_index % 2 != 0) {
			$pad_class = "col-md-6 pad-r-0";
		} else {
			$pad_class = "col-md-6 pad-l-0";
		}
		?>
			<div class="<?=$pad_class?>">
				<div class="box_shadow mar-lr-0">
					<article class="post-wrap">
                        <div class="post-media">
							<?php
							$imgs = json_decode($value->img_features,true);
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
                            <img src="<?=$img_url?>" alt="" style="height: 228px">
                        </div>					                        
                        <div class="post-header">
                            <h2 class="post-title"><a href="<?php echo $this->Crud_model->blog_link($value->blog_id);?>"><?=$value->title?></a></h2>
                            <div class="post-meta">
								<a href="<?=base_url()?>home/reporter_description/1/Robin-Milford"> <i class="fa fa-user"></i> <?=$this->Crud_model->get_type_name_by_id('user', $value->blog_uploader_id,'firstname');?> </a>
								<span class="divider">|</span>
								<a href="<?=base_url()?>home/blog/0/0/2017-04-10/2017-04-10"> <i class="fa fa-clock-o"></i> <?php echo date("F j, Y",$value->date);?> </a>
								<span class="divider">|</span>
								<a href="<?php echo $this->Crud_model->blog_link($value->blog_id);?>"><i class="fa fa-comments"></i> 17 Comments </a>
								<span class="divider">|</span>
								<a href="<?php echo $this->Crud_model->blog_link($value->blog_id);?>"><i class="fa fa-thumbs-o-up"></i> 105 Likes </a>
							</div>
                        </div>
                        <div class="post-body">
                            <div class="post-excerpt">
                                <p><?=$value->summary?></p>
                            </div> 
                        </div>
                    	<div class="row">
                    		<div class="col-md-12">
                    			<div class="pull-right">
                    				<a class="btn btn-readmore btn-icon-left" href="<?php echo $this->Crud_model->blog_link($value->blog_id);?>"> <i class="fa fa-file-text-o"></i> Read More </a>
								</div>
                    		</div>
						</div>
                    </article>
                </div>
			</div>	
		<?php
	if ($row_index % 2 == 0) { 
	?>
		</div>
	<?php 
	}
	$row_index ++;
	$item_index ++;
}
?>
<div class="row">
	<div class="col-xs-12">
		<div class="pagination-wrapper">
			<ul class="pagination">
				<li class="active"><a>1<span class="sr-only">(current)</span></a></li>
				<li><a onclick="filter_blog(((this.innerHTML-1)*7))">2</a></li>
				<li><a onclick="filter_blog(((this.innerHTML-1)*7))">3</a></li>
				<li><a onclick="filter_blog('7')">›</a></li>
				<li><a onclick="filter_blog('42')">»</a></li>
			</ul>
		</div>
	</div>
</div>

<script>
	$(document).ready(function(){
	    $('[data-toggle="tooltip"]').tooltip(); 
	    load_iamges();
	});
</script>

