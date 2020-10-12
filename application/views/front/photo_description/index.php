<?php
	$photo_detail_page = json_decode($this->Crud_model->get_settings_value('ui_settings','photo_detail_page','value'),true);
?>
<!-- CONTENT AREA -->
<div class="content-area">
    <!-- PAGE WITH SIDEBAR -->
    <section class="page-section with-sidebar pad-t-15">
        <div class="container">
            <div class="row mar-lr--5">
                <!-- SIDEBAR -->
                <?php include 'sidebar.php';?>
                <!-- /SIDEBAR -->
                <!-- CONTENT -->
                <div class="col-md-9 pad-lr-5 content" id="content">
                    <!-- Blog post -->
                    <?php 
                        foreach($photo_description as $rows){
							$img = json_decode($rows['img_features'],true);
							$i = sizeof($img);
                    ?>
                    <article class="post-wrap post-single box_shadow mar-lr-0">
                        <span class="btn btn-theme-transparent pull-left hidden-lg hidden-md" style="position:relative; z-index:100;padding: 5px 12px; border-radius:4px;width: 100%; margin-bottom: 15px;" onClick="open_sidebar();">
                            <i class="fa fa-bars"></i>
                        </span>
                        <div class="post-header">
                            <h2 class="post-title">
                             	<?php echo $rows['title'];?>
                            </h2>
                        </div>
                        <div class="post-media">
                        	<?php 
								if($i > 1 ){
							?>
                            <div class="owl-carousel img-carousel">
                                <?php 
									//$images = $this->Crud_model->file_view('photo',$rows['photo_id'],'','','no','src','multi','all');
                                    foreach($img as $row){
                                ?>
                                    <div class="item">
                                        <?php
                                            if (file_exists('uploads/photo_image/' . $row['thumb'])) {
                                                ?>
                                        <span onClick="image_modal('<?php echo base_url(); ?>uploads/photo_image/<?php echo $row['thumb']; ?>');">
                                        	<div class="item-image cursorPointer image_delay" data-src="<?php echo base_url(); ?>uploads/photo_image/<?php echo $row['thumb']; ?>" style="background-image:url('<?php echo img_loading(); ?>')"></div>
                                        </span>
                                        <?php
                                            }
                                            else {
                                            ?>
                                            <span onClick="image_modal('<?php echo base_url(); ?>uploads/photo_image/default.jpg');">
                                                <div class="item-image cursorPointer image_delay" data-src="<?php echo base_url(); ?>uploads/photo_image/default.jpg"  style="background-image:url('<?php echo img_loading(); ?>')"></div>
                                            </span>
                                            <?php
                                            }
                                        ?>
                                    </div>
                                <?php 
									}
								?>
                            </div>
                            <?php 
                                }else{
							?>
                            <span onClick="image_modal('<?php echo $this->Crud_model->file_view('photo',$rows['photo_id'],'','','no','src','multi','one');?>');">
								<img class="img-thumbnail img-responsive cursorPointer image_delay" src="<?php echo img_loading(); ?>" data-src="<?php echo $this->Crud_model->file_view('photo',$rows['photo_id'],'','','no','src','multi','one');?>"  />
                            </span>
							<?php
								}
							?>
                        </div>
                        <div class="post-body">
                            <div class="post-excerpt">
                                <p class="text-summary">
                                    <?php echo $rows['description'];?>
                                </p>
                            </div>
                        </div>
                        <div class="post-body"> 
                            <div id="share"></div>
                        </div>
                    </article>
                    <!-- /Blog post -->
                    <?php
						}
					?>
                    <!-- /advertisement space -->
                    <div class="advertise_space2">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <?php echo $this->Html_model->advertise_rect('photo_description_2'); ?>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <?php echo $this->Html_model->advertise_rect('photo_description_3'); ?>
                            </div>
                        </div>
                    </div>
                    <!-- /advertisement space -->
                    <?php
						echo $this->Html_model->bottom_part($photo_detail_page['page_bottom']);
					?>
                </div>
                <!-- /CONTENT -->
            </div>
        </div>
    </section>
    <!-- /PAGE WITH SIDEBAR -->
</div>
<!-- /CONTENT AREA -->
<script>
$(document).ready(function() {
	close_sidebar();
	$('#share').share({
		networks: ['facebook','googleplus','twitter','linkedin','tumblr','in1','stumbleupon','digg'],
		theme: 'square'
	});
});

function open_sidebar(){
	$('.sidebar').removeClass('close_now');
	$('.sidebar').addClass('open');
}
function close_sidebar(){
	$('.sidebar').removeClass('open');
	$('.sidebar').addClass('close_now');
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