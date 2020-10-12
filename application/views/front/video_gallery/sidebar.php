<!-- SIDEBAR -->
    <aside class="col-md-3 sidebar pull-<?php echo $videos_page['sidebar']; ?>" id="sidebar">
    	<div class="box_shadow">
            <span class="btn btn-theme-transparent pull-left hidden-lg hidden-md" onClick="close_sidebar();" style="border-radius:50%; position: absolute; top:30px; right:0px; z-index:99;">
                <i class="fa fa-times"></i>
            </span>
        	<div class="widget shop-categories thin-border">
    			<h4 class="widget-title">
				<?php echo translate('video_source');?>
                </h4>
                <div class="widget-content video_source">
                    <ul>
                        <li id="all" onClick="get_videos('all')">
                          	<?php echo translate('all_videos');?>
                        </li>
                        <li id="youtube" onClick="get_videos('youtube')">
                      		<?php echo translate('youtube');?>
                            <span class="video_icons"><i class="fa fa-youtube"></i></span>
                        </li>
                        <li id="dailymotion" onClick="get_videos('dailymotion')">
                        	<?php echo translate('dailymotion');?>
                            <span class="video_icons"><i class="fa fa-dailymotion">d</i></span>
                        </li>
                        <li id="vimeo" onClick="get_videos('vimeo')">
                        	<?php echo translate('vimeo');?>
                            <span class="video_icons"><i class="fa fa-vimeo"></i></span>
                        </li>
                        <li id="local" onClick="get_videos('local')">
                       		<?php echo translate('uploaded_videos');?>
                            <span class="video_icons"><i class="fa fa-upload"></i></span>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- /advertisement space -->
            <div class="advertise_space1" style="margin-top:15px;">
                <div class="row">
                    <div class="col-md-12">
                    	<?php echo $this->Html_model->advertise_sqr('video_gallery_1'); ?>
                    </div>
                </div>
            </div>
            <!-- /advertisement space -->
            <?php
				$widgets = $videos_page['widgets'];
				foreach($widgets as $row){
            		echo $this->Html_model->widget($row);
				}
			?>
            
        </div>
        <!-- /widget shop categories -->
    </aside>
<!-- /SIDEBAR -->