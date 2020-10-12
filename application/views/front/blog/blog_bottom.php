<div class="container">
	<div class="row">
		<div class="col-md-4">
			<div class="widget widget_box widget-tabs sp_news_tab1 border-topx3 alt">
				<div class="widget-content">
					<div class="text-center">
						<h4 class="widget-title"><?=translate('most_popular_blogs')?></h4>
					</div>
					<div class="tab-content">
						<div class="tab-pane fade active in" id="tab-1">
							<?php
								$this->db->order_by('view_count','DESC');
								$this->db->limit(5);
			                	$populars = $this->db->get_where('blog',array('status'=>'published','hide_status'=>'false'))->result_array();
								foreach($populars as $popular){
							?>
								<div class="news_box_rect_1 thumb hover3">
									<div class="media">
										<span class="pull-left media-link">
										<?php
				                            $imgs = json_decode($popular['img_features'], true);
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
											<a href="<?php echo $this->Crud_model->blog_link($popular['blog_id']);?>">
											<?=$popular['title']?></a>
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
		</div>
		<div class="col-md-4">
			<div class="widget widget_box widget-tabs sp_news_tab1 border-topx3 alt">
				<div class="widget-content">
					<div class="text-center">
						<h4 class="widget-title"><?=translate('recent_blogs')?></h4>
					</div>
					<div class="tab-content">
						<div class="tab-pane fade active in" id="tab-1">
							<?php
								$this->db->order_by('blog_id','DESC');
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
		</div>
		<div class="col-md-4">
			<div class="widget widget_box widget-tabs sp_news_tab1 border-topx3 alt">
				<div class="widget-content">
					<div class="text-center">
						<h4 class="widget-title"><?=translate('trending_blogs')?></h4>
					</div>
					<div class="tab-content">
						<div class="tab-pane fade active in" id="tab-1">
							<?php
								$trends = $this->db->select('*')
									->from('(SELECT * FROM blog ORDER BY publish_timestamp ASC LIMIT 50) AS temp_tbl')
		                			->where('temp_tbl.status', 'published')
		                			->where('temp_tbl.hide_status', 'false')
		                			->order_by('temp_tbl.view_count','DESC')
									->limit(5)->get()
		                			->result_array();
								foreach($trends as $trend){
							?>
							<div class="news_box_rect_1 thumb hover3">
								<div class="media">
									<span class="pull-left media-link">
									<?php
			                            $imgs = json_decode($trend['img_features'], true);
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
										<a href="<?php echo $this->Crud_model->blog_link($trend['blog_id']);?>">
										<?=$trend['title']?></a>
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
		</div>
	</div>
</div>
