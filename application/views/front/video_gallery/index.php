<?php
	$videos_page = json_decode($this->Crud_model->get_settings_value('ui_settings','videos_page','value'),true);
?>
<!-- CONTENT AREA -->
<div class="content-area">
    <!-- PAGE WITH SIDEBAR -->
    <section class="page-section with-sidebar pad-t-15">
        <div class="container">
            <div class="row mar-lr--5">
                <?php include 'sidebar.php';?>
                <!-- CONTENT -->
                <div class="col-md-9 content pad-lr-5" id="content">
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
                                <?php echo translate('video_gallery'); ?>
                            </span>
                        </li>
                    </ol>
                    <div id="result">
                    </div>
                    <!-- /advertisement space -->
                    <div class="advertise_space2">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <?php echo $this->Html_model->advertise_rect('video_gallery_2'); ?>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <?php echo $this->Html_model->advertise_rect('video_gallery_3'); ?>
                            </div>
                        </div>
                    </div>
                    <!-- /advertisement space -->
                    <?php
						echo $this->Html_model->bottom_part($videos_page['page_bottom']);
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
	var type = '<?php echo $type; ?>';
	if(type == ''){
		get_videos('all');
	}else{
		get_videos(type);
	}
	
	close_sidebar();
	setTimeout(function(){
		set_video_frame();
		set_video_box();
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
function get_videos(type){
	$('.video_source li').removeClass('active');
	$('#'+type).addClass('active');
	$("#result").load("<?php echo base_url()?>home/get_video_list/"+type);
}
function set_video_box(){
	var max_height = 0;
	$('.video_box_1').each(function(){
        var current_height= parseInt($(this).css('height'));
		if(current_height >= max_height){
			max_height = current_height;
		}
    });
	$('.video_box_1').css('height',max_height);
}
function set_video_frame(){
	$('iframe').each(function(){
        var box_width= parseInt($(this).closest('.media').css('width'));
		$(this).css('width',box_width);
    });
	$('video').each(function(){
        var box_width= parseInt($(this).closest('.media').css('width'));
		$(this).css('width',box_width);
    });
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