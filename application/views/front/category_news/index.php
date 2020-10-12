<?php
	$category_news_data = json_decode($this->Crud_model->get_settings_value('ui_settings','category_news','value'),true);
?>
<!-- CONTENT AREA -->
<input type="hidden" value="<?php echo $news_category; ?>" id="cat" />
<input type="hidden" value="<?php echo $news_sub_category; ?>" id="sub_cat" />
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
                        <?php
                            if($news_sub_category == '0'){
                        ?>
                        	<li class="active">
                            	<span>
                                	<?php echo $this->Crud_model->get_type_name_by_id('news_category',$news_category); ?>
                                </span>
                            </li>
                        <?php
							}else{
						?>
                            <li>
                                <a href="<?php echo base_url(); ?>home/news/<?php echo $news_category;?>/0">
                                    <?php echo $this->Crud_model->get_type_name_by_id('news_category',$news_category); ?>
                                </a>
                            </li>
                        	<li class="active">
                            	<span>
                                	<?php echo $this->Crud_model->get_type_name_by_id('news_sub_category',$news_sub_category); ?>
                                </span>
                            </li>
                        <?php
                            }
                        ?>
                    </ol>
                    <div class="news_content" id="result">
                       <?php include 'news.php';?> 
                    </div>
                    <div class="row">
                    	<div class="col-md-12">
                            <a href="<?php echo base_url();?>home/news/<?php echo $news_category;?>/<?php echo $news_sub_category;?>" class="button-custom-btn-1 btn-block custom-btn-1 custom-btn-1-text-thick custom-btn-1-text-upper custom-btn-1-round-s custom-btn-1-size-s" data-text="<?php echo translate('see_all_news'); ?>">		
                                <span><?php echo translate('see_all_news'); ?></span>
                            </a>
                        </div>
                    </div>
                    <!-- /advertisement space -->
                    <div class="advertise_space2">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <?php echo $this->Html_model->advertise_rect('news_category_2'); ?>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <?php echo $this->Html_model->advertise_rect('news_category_3'); ?>
                            </div>
                        </div>
                    </div>
                    <!-- /advertisement space -->
                    <?php
						echo $this->Html_model->bottom_part($category_news_data['page_bottom']);
					?>
                </div>
                <!-- /CONTENT -->
            </div>
        </div>
    </section>
    <!-- /PAGE WITH SIDEBAR -->
</div>
<!-- /CONTENT AREA-->

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
	var max_height1 = 0;
	$('.news_box_sqr_1.sm').each(function(){
        var current_height= parseInt($(this).css('height'));
		if(current_height >= max_height1){
			max_height1 = current_height;
		}
    });
	$('.news_box_sqr_1.sm').css('height',max_height1);
	
	var max_height2 = 0;
	$('.news_box_rect_1.sm').each(function(){
        var current_height= parseInt($(this).css('height'));
		if(current_height >= max_height2){
			max_height2 = current_height;
		}
    });
	$('.news_box_rect_1.sm').css('height',max_height2);
	
	var max_height3 = 0;
	$('.news_box_rect_1.thumb').each(function(){
        var current_height= parseInt($(this).css('height'));
		if(current_height >= max_height3){
			max_height3 = current_height;
		}
    });
	$('.news_box_rect_1.thumb').css('height',max_height3);
}
</script>

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