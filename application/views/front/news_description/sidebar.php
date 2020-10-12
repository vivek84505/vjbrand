<!-- SIDEBAR -->
    <aside class="col-md-3 sidebar pull-<?php echo $news_description_data['sidebar']; ?>" id="sidebar">
    	<div class="box_shadow">
            <span class="btn btn-theme-transparent pull-left hidden-lg hidden-md" onClick="close_sidebar();" style="border-radius:50%; position: absolute; top:30px; right:0px; z-index:99;">
                <i class="fa fa-times"></i>
            </span>
            <!-- /advertisement space -->
            <div class="advertise_space1">
                <div class="row">
                    <div class="col-md-12">
                    	<?php echo $this->Html_model->advertise_sqr('news_description_1'); ?>
                    </div>
                </div>
            </div>
            <!-- /advertisement space -->
            <?php
				$widgets = $news_description_data['widgets'];
				foreach($widgets as $row){
            		echo $this->Html_model->widget($row);
				}
			?> 
        </div>
        <!-- /widget shop categories -->
    </aside>
<!-- /SIDEBAR -->