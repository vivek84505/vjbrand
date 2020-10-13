<?php
	$archive_listing_page = json_decode($this->Crud_model->get_settings_value('ui_settings','archive_listing_page','value'),true);
?>
<!-- CONTENT AREA -->
<input type="hidden" value="<?php echo $news_category; ?>" id="cat" />
<input type="hidden" value="<?php echo $news_sub_category; ?>" id="subcat" />
<input type="hidden" value="<?php if(isset($start_date)){ echo $start_date; } ?>" id="st_date" />
<input type="hidden" value="<?php if(isset($end_date)){ echo $end_date; } ?>" id="en_date" />
<input type="hidden" value="<?php if(isset($header_search_text)){ echo $header_search_text; } ?>" id="header_search_text" />
<div class="content-area">
    <!-- PAGE WITH SIDEBAR -->
    <section class="page-section with-sidebar pad-t-15">
        <div class="container">
            <div class="row mar-lr--5">
                <?php include 'sidebar.php';?>
                <!-- CONTENT -->
                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 content pad-lr-5" id="content">
                    <span class="btn btn-theme-transparent pull-left hidden-lg hidden-md" style="position:relative; z-index:100;padding: 5px 12px; border-radius:4px;width: 100%; margin-bottom: 15px;" onClick="open_sidebar();">
                        <i class="fa fa-bars"></i>
                    </span>
                    <ol class="breadcrumb breadcrumb-custom hidden-sm hidden-xs">
                        <li>
                        	<a href="<?php echo base_url(); ?>">
                            	<i class="fa fa-home"></i>
                            </a>
                        </li>
                        <li class="active">
                            <span>
                                <?php echo translate('archive_search'); ?>
                            </span>
                        </li>
                    </ol>
                    <div class="archive_search_box">
                        <div class="row">
                        	<div class="col-md-12">
                            	<div class="row">
                                	<div class="col-md-12" style="margin-bottom:15px;">
                                    	<form>
                                            <input class="form-control" id="search_input" type="text" placeholder="<?php echo translate('search_that_you_are_looking_for'); ?>...">
                                            <span id="text_search_btn" class="enterer"><i class="fa fa-search"></i></span>
                                        </form>
                                    </div>
                                	<div class="col-md-4">
                                    	<select class="selectpicker" name="category" data-live-search="true" data-width="100%" id="archive_category">
                                            <option disabled="" selected="" value="0"><?php echo translate('categories'); ?>....</option>
                                            <?php
                                                $cat = $this->db->get('news_category')->result_array();
                                                foreach($cat as $row){
                                                     $subcat=$this->db->get_where('news_sub_category',array('parent_category_id'=> $row['news_category_id']))->result_array();
                                                     $subcat_ids = array();
                                                     foreach($subcat as $row1){
                                                         $subcat_ids[]=$row1['news_sub_category_id'];
                                                     }
                                            ?>
                                            <option value="<?php echo $row['news_category_id']; ?>" <?php if($news_category == $row['news_category_id']){ echo 'selected'; } ?>
                                                data-sub="<?php if(count($subcat)!==0){ echo implode("::",$subcat_ids);}else{ echo 0; }?>"><?php echo $row['name']; ?></option>
                                            <?php
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-4" id="archive_subcat_place">
                                    	<select class="selectpicker" name="sub_category" data-live-search="true" data-width="100%" id="archive_sub_category">
                                            <option disabled="" selected="" value="0"><?php echo translate('sub-categories'); ?>....</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                    	<select class="selectpicker" name="category" data-live-search="false" data-width="100%" id="order_by" onChange="set_select();">
                                            <option disabled="" selected="" value="none"><?php echo translate('order_by'); ?>....</option>
                                            <option value="newest"><?php echo translate('newest'); ?></option>
                                            <option value="oldest"><?php echo translate('oldest'); ?></option>
                                            <option value="most_viewed"><?php echo translate('most_viewed'); ?></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12" style="margin-top: 15px;" id="date_place">
                            </div>
                        </div>
                    </div>
                    <div class="news_content" id="result">

                    </div>
                    <!-- /advertisement space -->
                    <div class="advertise_space2">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pad-t-15">
                                <?php echo $this->Html_model->advertise_rect('archive_news_2'); ?>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pad-t-15">
                                <?php echo $this->Html_model->advertise_rect('archive_news_3'); ?>
                            </div>
                        </div>
                    </div>
                    <!-- /advertisement space -->
                    <?php
						echo $this->Html_model->bottom_part($archive_listing_page['page_bottom']);
					?>
                </div>
                <!-- /CONTENT -->
            </div>
        </div>
    </section>
    <!-- /PAGE WITH SIDEBAR -->
</div>
<!-- /CONTENT AREA-->
<input type="hidden" id="cur_cat" value="<?php echo $news_category; ?>">
<input type="hidden" id="cur_subcat" value="<?php echo $news_sub_category; ?>">
<input type="hidden" value="<?php echo $start_date; ?>" id="date_start" />
<input type="hidden" value="<?php  echo $end_date; ?>" id="date_end" />
<?php include 'search_script.php'; ?>
<script>
$(document).ready(function(){
	setTimeout(function(){
		close_sidebar();
		set_category_news_box();
	},500);
});
function open_sidebar(){
	$('.sidebar').removeClass('close_now');
	$('.sidebar').addClass('open');
}
function close_sidebar(){
	$('.sidebar').removeClass('open');
	$('.sidebar').addClass('close_now');
}
function set_category_news_box(){
	var max_height = 0;
	$('.sp_news_tab2 .news_list').each(function(){
        var current_height= parseInt($(this).css('height'));
		if(current_height >= max_height){
			max_height = current_height;
		}
    });
	$('.sp_news_tab2 .news_list').css('height',max_height);
}
</script>
<style>
#search_input{
	width: 95%;
    display: inline;
    float: left;
	border-radius: 4px 0px 0px 4px;
}
#text_search_btn{
    position: relative;
    float: left;
    display: inline;
    width: 5%;
    top: 1px;
    border: none;
    padding: 5px 10px;
    line-height: 28px;
    font-size: 16px;
    cursor: pointer;
    z-index: 2;
    background: #ffffff;
	border-radius: 0px 4px 4px 0px;
}
@media(max-width: 991px) {
	#search_input{
		width: 90% !important;
	}
	#text_search_btn{
		width: 10% !important;
	}
}
.archive_search_box{
	position:relative;
    margin-top: 15px;
    border: 1px solid #eaeaea;
    padding: 15px;
    background: #eaeaea;
    border-radius: 4px;
}
</style>

<style>
	.sidebar.close_now{
		position: relative;
		left:0px;
		opacity:1;
	}
	@media(max-width: 991px) {
		.sidebar.open{
			opacity:1;
			position: fixed;
			z-index: 9999;
			top: -30px;
			background: #f5f5f5;
			height: 100vh;
			overflow-y: auto;
			padding-top: 50px;
			left:0px;
			overflow-x: hidden;
                        transition: all .6s ease-out;
		}
		.sidebar.close_now{
			position: fixed;
			left:-500px;
			opacity:0;
		}
		.view_select_btn{
			margin-top: 10px !important;
		}
	}
</style>
