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
                        foreach($blog_photo_description as $rows){
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
                        <div class="post-meta">
                            <?php if($rows['blog_photo_uploader_type'] == 'admin'){ ?> <a href="#"> <i class="fa fa-user"></i> <?php echo translate('admin'); ?> </a>
                            <?php } else { ?>
                                <a href="<?php echo $this->Crud_model->bloggers_link($rows['blog_photo_uploader_id']);?>"> <i class="fa fa-user"></i> <?=$this->Crud_model->get_type_name_by_id('user', $rows['blog_photo_uploader_id'],'firstname').' '.$this->Crud_model->get_type_name_by_id('user', $rows['blog_photo_uploader_id'],'lastname');?> </a>
                            <?php } ?>
                            <span class="divider">|</span>
                            <a href="#"> <i class="fa fa-clock-o"></i> <?=date("F j, Y",$rows['timestamp']);?> </a>
                            <span class="divider">|</span>
                            <a href="#"><i class="fa fa-eye"></i> <?=$rows['view_count'].' '.translate('views')?> </a>
                        </div>
                        <div class="post-media" style="padding-top: 10px">
                            <?php
                                $imgs = json_decode($rows['img_features'],true);
                                $img_url = base_url()."uploads/blog_photo_image/default.jpg";
                                if (!empty($imgs)) {
                                    $i=0;
                                    foreach ($imgs as $roq) {
                                        if($i == 0){
                                            $img = $roq['img'];
                                        }
                                        $i++;
                                    }
                                    $img_url = base_url()."uploads/blog_photo_image/".$img;
                                }
                            ?>
                            <span onClick="image_modal('<?php echo $img_url; ?>');">
								<div class="item-image cursorPointer image_delay" data-src="<?php echo $img_url; ?>" style="background-image:url('<?php echo img_loading(); ?>')"></div>
                            </span>

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
