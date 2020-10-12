<?php
$this->db->limit(10);
$this->db->order_by('view_count','desc');
$this->db->where('status','published');
$popular_news			= $this->db->get('news')->result_array();

$this->db->limit(10);
$this->db->order_by('news_id','desc');
$this->db->where('status','published');
$recent_news			= $this->db->get('news')->result_array();
?>

<div class="widget widget_box widget-tabs sp_news_tab2 border-topx3 alt">
    <div class="widget-content">
        <nav class="menu tab-menu-1">
            <ul id="tabs" class="menu-list">
                <li class="menu-item">
                	<a class="menu-link" href="#tab2-s1" data-toggle="tab"><?php echo translate('recent'); ?></a>
                </li>
                <li class="menu-item active">
                	<a class="menu-link" href="#tab2-s2" data-toggle="tab"><?php echo translate('popular'); ?></a>
                </li>
            </ul>
        </nav>
        <div class="tab-content">
            <!-- tab 1 -->
            <div class="tab-pane fade" id="tab2-s1">
			<?php
				$i=0;
                foreach($recent_news as $row){
					$i++;
            ?>
                <div class="news_list hover3">
                    <div class="media">
                        <span class="pull-right media-num">
                        	<?php
                            	echo $i;
							?>
                        </span>
                        <div class="media-body">
                            <h4 class="media-heading">
                                <a href="<?php echo $this->Crud_model->news_link($row['news_id']);?>">
                                    <?php echo word_limiter($row['title'],10);?>
                                </a>
                            </h4>
                        </div>
                    </div>
                </div>
            <?php
                }
            ?>
            </div>
            <!-- tab 2 -->
            <div class="tab-pane fade in active" id="tab2-s2">
                <?php
					$i=0;
					foreach($popular_news as $row){
						$i++;
				?>
					<div class="news_list hover3">
						<div class="media">
							<span class="pull-right media-num">
								<?php
									echo $i;
								?>
							</span>
							<div class="media-body">
								<h4 class="media-heading">
									<a href="<?php echo $this->Crud_model->news_link($row['news_id']);?>">
										<?php echo word_limiter($row['title'],10);?>
									</a>
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
