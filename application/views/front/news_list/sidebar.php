<!-- SIDEBAR -->
    <aside class="col-lg-3 col-md-3 col-sm-12 col-xs-12 sidebar pull-<?php echo $listing_news_data['sidebar']; ?>" id="sidebar">
    	<div class="box_shadow">
            <div class="widget thin-border shop-categories">
                <h4 class="widget-title">
                    <?php echo translate('news_search');?>
                    <span class="btn btn-theme-transparent pull-left hidden-lg hidden-md" onClick="close_sidebar();" style="border-radius:50%; position: absolute; top:40px; right:10px;">
                        <i class="fa fa-times"></i>
                    </span>
                 </h4>
                <div class="widget-content">
                    <ul>
                    	<li>
                            <span data-cat="0" class="cat_search">
                                <?php echo translate('all_news');?>
                            </span>
                        </li>
                    <?php
                        $cat = $this->db->get('news_category')->result_array();
                        foreach($cat as $row){
                            $sub_cat = $this->db->get_where('news_sub_category',array('parent_category_id'=> $row['news_category_id']))->result_array();
                            if(count($sub_cat) == 0){
                    ?>
                        <li>
                            <span data-cat="<?php echo $row['news_category_id']; ?>" class="cat_search">
                                <?php echo $row['name'];?>
                            </span>
                        </li>
                    <?php
                            }else{
                    ?>
                        <li class="parent">
                            <span class="arrow"><i class="fa fa-angle-down"></i></span>
                            <span data-cat="<?php echo $row['news_category_id']; ?>" class="cat_search">
                                <?php echo $row['name'];?>
                            </span>
                            <ul class="children">
                                <?php 
                                    foreach($sub_cat as $rows){
                                        $total_sub_cat_news = $this->db->get_where('news',array('news_sub_category_id' => $rows['news_sub_category_id'], 'status'=> 'published'))->result_array();
                                        $x = sizeof($total_sub_cat_news);
                                ?>
                                <li>
                                    <span data-sub="<?php echo $rows['news_sub_category_id']; ?>" class="subcat_search"> 
                                        <?php echo $rows['name'];?>
                                        <span class="count"><?php echo $x; ?></span>
                                    </span>
                                </li>
                                <?php 
                                    }
                                ?>
                            </ul>
                        </li>
                    <?php }}?>
                    </ul>
                </div>
            </div>
            <div class="widget_box">
                <div class="widget" style="margin-bottom:15px;">
                    <div class="widget-search">
                        <form>
                            <input class="form-control" id="search_input" style="margin-bottom:15px; border-radius: 4px;" type="text" placeholder="<?php echo translate('search'); ?>">
                            <span id="text_search_btn" class="enterer"><i class="fa fa-search"></i></span>
                        </form>
                    </div>
                </div>
                <div class="widget" style="margin-top:0px; margin-bottom:15px;">
                	<select class="selectpicker" name="order_by" data-live-search="false" data-width="100%" data-toggle="tooltip" data-original-title="<?php echo translate('order_by'); ?>" id="order_by">
                        <option disabled="" selected="" value="none"><?php echo translate('order_by'); ?>....</option>
                        <option value="newest"><?php echo translate('newest'); ?></option>
                        <option value="oldest"><?php echo translate('oldest'); ?></option>
                        <option value="most_viewed"><?php echo translate('most_viewed'); ?></option>
                    </select>
                </div>
                <div id="date_place">
                </div>
            </div>
            <!-- /advertisement space -->
            <div class="advertise_space1">
                <div class="row">
                    <div class="col-md-12">
                    	<?php echo $this->Html_model->advertise_sqr('news_list_1'); ?>
                    </div>
                </div>
            </div>
            <!-- /advertisement space -->
            <div class=" hidden-sm hidden-xs">
            <?php
				$widgets = $listing_news_data['widgets'];
				foreach($widgets as $row){
            		echo $this->Html_model->widget($row);
				}
			?>
            </div>
        </div>
        <!-- /widget shop categories -->
    </aside>
<!-- /SIDEBAR -->
<input type="hidden" id="cur_cat" value="<?php echo $news_category; ?>">
<input type="hidden" id="cur_subcat" value="<?php echo $news_sub_category; ?>">
<?php include 'search_script.php'; ?>
<style>
#text_search_btn{
	position: absolute;
    right: 1px;
    top: 1px;
    border: none;
    padding: 5px 10px;
    line-height: 28px;
    font-size: 16px;
    cursor: pointer;
    z-index: 2;
    background: #ffffff;
}
</style>