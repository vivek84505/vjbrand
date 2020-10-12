<!-- SIDEBAR -->
    <aside class="col-md-3 sidebar pull-<?php echo $category_blog_data['sidebar']; ?>" id="sidebar">
    	<div class="box_shadow">
            <span class="btn btn-theme-transparent pull-left hidden-lg hidden-md" onClick="close_sidebar();" style="border-radius:50%; position: absolute; top:30px; right:0px; z-index:99;">
                <i class="fa fa-times"></i>
            </span>
            <!-- /advertisement space -->
            <div class="advertise_space1">
                <div class="row">
                    <div class="col-md-12">
                    	<?php echo $this->Html_model->advertise_sqr('blog_category_1'); ?>
                    </div>
                </div>
            </div>
            <!-- /advertisement space -->
            <?php
				$widgets = $category_blog_data['widgets'];
				foreach($widgets as $row){
            		echo $this->Html_model->widget($row);
				}
			?>
            <div class="widget_box">
                <form>
                    <div class="widget" style="margin-bottom:15px;">
                        <div class="widget-search">
                            <input class="form-control" id="search_input" style="margin-bottom:15px; border-radius: 4px;" type="text" placeholder="<?php echo translate('search'); ?>">
                            <span id="text_search_btn" class="" onclick="filter_blog('0')"><i class="fa fa-search"></i></span>
                        </div>
                    </div>
                    <div class="input-group" id="datepicker" style="width:100%;">
                        <input type="date" id="date_start" class="form-control" name="start" value="" style="margin-bottom:15px; border-radius: 4px;" placeholder="<?php echo translate('from'); ?>:" />
                        <input type="date" id="date_end" class="form-control" name="end" value="" style="margin-bottom:15px; border-radius: 4px;" placeholder="<?php echo translate('to'); ?>:" />
                        <button type="button" id="date_search_btn" class="button-custom-btn-1 btn-block custom-btn-1 custom-btn-1-text-thick letter-spacing-none custom-btn-1-round-s custom-btn-1-text-upper custom-btn-1-size-s" data-text="<?php echo translate('search'); ?>" onclick="filter_blog('0')">
                        <span><?php echo translate('search'); ?></span>
                        </button>
                    </div>
                </form>
            </div>  
        </div>
        <!-- /widget shop categories -->
    </aside>
<!-- /SIDEBAR -->