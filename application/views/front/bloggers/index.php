<?php
	$bloggers_page = json_decode($this->Crud_model->get_settings_value('ui_settings','category_blog','value'),true);
?>
<!-- CONTENT AREA -->
<div class="content-area">
    <!-- PAGE WITH SIDEBAR -->
    <section class="page-section with-sidebar pad-t-15 bloggers">
        <div class="container">
            <div class="row mar-lr--5">
                <?php include 'sidebar.php';?>
                <!-- CONTENT -->
                <div class="col-md-9 content pad-lr-5" id="content">
                	<div class="row">
                		<div class="col-sm-12">
                			<span class="btn btn-theme-transparent pull-left hidden-lg hidden-md" style="position:relative; z-index:100;padding: 5px 12px; border-radius:4px;width: 100%; margin-bottom: 15px;" onClick="open_sidebar();">
		                        <i class="fa fa-bars"></i>
		                    </span>
                		</div>
                	</div>
                    
                    <ol class="breadcrumb breadcrumb-custom hidden-sm hidden-xs">
                        <li>
                        	<a href="<?php echo base_url(); ?>">
                            	<i class="fa fa-home"></i>
                            </a>
                        </li>
                        <li class="active">
                            <span>
                                <?php echo translate('all_bloggers'); ?>
                            </span>
                        </li>
                    </ol>
                    <div id="result">
                    </div>
                    <?php
						echo $this->Html_model->bottom_part($bloggers_page['page_bottom']);
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
function get_bloggers(){	
	$("#result").load("<?php echo base_url()?>home/get_bloggers_list/");
}
$(document).ready(function(){
	close_sidebar();
	get_bloggers();
	
	setTimeout(function(){
		set_blogger_box();
	},1000);
});
function open_sidebar(){
	$('.sidebar').removeClass('close_now');
	$('.sidebar').addClass('open');
}
function close_sidebar(){
	$('.sidebar').removeClass('open');
	$('.sidebar').addClass('close_now');
}
function set_blogger_box(){
	var max_height_image = 0;
	$('.reporter_box_1 .media').each(function(){
        var current_height_image= parseInt($(this).css('height'));
		if(current_height_image >= max_height_image){
			max_height_image = current_height_image;
		}
    });
	$('.reporter_box_1 .media').css('height',max_height_image);
}
</script>
<style>
.bloggers .social-icons a:hover {
	color:inherit;
}
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