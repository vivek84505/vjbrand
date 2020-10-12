<aside class="col-lg-3 col-md-3 col-sm-12 col-xs-12 sidebar pull-left close_now" id="sidebar">
	<div class="box_shadow">
		<div class="widget thin-border shop-categories">
			<h4 class="widget-title">
			<?=translate('most_popular_blogs')?><span class="btn btn-theme-transparent pull-left hidden-lg hidden-md" onclick="close_sidebar();" style="border-radius:50%; position: absolute; top:40px; right:10px;">
			<i class="fa fa-times"></i>
			</span>
			</h4>
			<div class="widget-content">
				<div class="widget-pane fade active in">
					<?php
						$this->db->order_by('publish_timestamp','ASC');
						$this->db->limit(5);
	                	$recents = $this->db->get_where('blog',array('status'=>'published','hide_status'=>'false'))->result_array();
						foreach($recents as $recent){
					?>
					<div class="news_box_rect_1 thumb hover3">
						<div class="media">
							<span class="pull-left media-link">
							<?php
	                            $imgs = json_decode($recent['img_features'], true);
	                            $img_url = base_url()."uploads/blog_image/default.jpg";
	                            if (!empty($imgs)) {
	                                $i=0;
	                                foreach ($imgs as $row1) {
	                                    if($i == 0){
	                                        $img = $row1['img'];
	                                    }
	                                    $i++;
	                                }
	                                $img_url = base_url()."uploads/blog_image/".$img;
	                            }
	                        ?>
							<img class="media-object img-responsive image_delay" src="<?=base_url()?>uploads/news_image/news_84_1_thumb.jpg" data-src="<?=$img_url?>" alt="">
							</span>
							<div class="media-body">
								<h4 class="media-heading">
								<a href="<?php echo $this->Crud_model->blog_link($recent['blog_id']);?>">
								<?=$recent['title']?></a>
								</h4>
							</div>
						</div>
					</div>
					<?php
						}
					?>
				</div>
			</div>
		</div>
	</div>
</aside>