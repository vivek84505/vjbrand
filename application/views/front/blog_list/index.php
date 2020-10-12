<section class="page-section with-sidebar pad-t-15">
	<div class="container">
		<div class="row mar-lr--5">
			<!-- LEFT SIDEBAR -->
			<?php include 'left_aside.php'; ?>
			<!-- /LEFT SIDEBAR -->
			<input type="hidden" id="cur_cat" value="0">
			<input type="hidden" id="cur_subcat" value="0">
			<form action="<?=base_url()?>
				home/ajax_blog_list/" class="form-horizontal" method="post" id="filter_form" accept-charset="utf-8"> <input type="hidden" name="csrf_test_name" value="808ce4ad851dad47b192d654c2fa0756">
				<input type="hidden" name="blog_category" id="blog_category" value="0">
				<input type="hidden" name="blog_sub_category" id="blog_sub_category" value="0">
				<input type="hidden" name="search_text" id="search_text" value="">
				<input type="hidden" name="order_by" id="order_by_value" value="none">
				<input type="hidden" name="start_date" id="start_date" value="">
				<input type="hidden" name="end_date" id="end_date" value="">
			</form>
			<!-- CONTENT -->
			<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 content pad-lr-5" id="content">
				<span class="btn btn-theme-transparent pull-left hidden-lg hidden-md" style="padding: 5px 12px; border-radius:4px;" onclick="open_sidebar();">
				<i class="fa fa-bars"></i>
				</span>
				<div id="intro" class="hidden-sm hidden-xs">
					<ol class="breadcrumb breadcrumb-custom">
						<li>
						<a href="<?=base_url()?>"> <i class="fa fa-home"></i>
						</a>
						</li>
						<li class="active">
						<span>
						All Blog Posts </span>
						</li>
					</ol>
				</div>
				<div class="content" id="result" style="display: block;">
					<!-- Blog posts -->
					<?php
					$row_index = 1;
					$item_index = 1;
					$get_blog = $this->db->get_where('blog', array('status' => 'published', 'hide_status' => 'false'))->result();
					foreach ($get_blog as $value) {
						$pad_class = "";
						if ($row_index == 1 || $row_index % 2 != 0) { 
						?>
							<div class="row <?php if($row_index != 1){echo 'mar-t-15';}?>">
						<?php 
						}
							if($item_index == 1 || $item_index % 2 != 0) {
								$pad_class = "col-md-6 pad-r-0";
							} else {
								$pad_class = "col-md-6 pad-l-0";
							}
							?>
								<div class="<?=$pad_class?>">
									<div class="box_shadow mar-lr-0">
										<article class="post-wrap">
					                        <div class="post-media">
												<?php
												$imgs = json_decode($value->img_features,true);
					                            $img_url = base_url()."uploads/blog_image/default.jpg";
					                            if (!empty($imgs)) {
					                                $i=0;
					                                foreach ($imgs as $roq) {
					                                    if($i == 0){
					                                        $img = $roq['img'];
					                                    }
					                                    $i++;
					                                }
					                                $img_url = base_url()."uploads/blog_image/".$img;
					                            }
					                            ?>
					                            <img src="<?=$img_url?>" alt="" style="height: 228px">
					                        </div>					                        
					                        <div class="post-header">
					                            <h2 class="post-title"><a href="<?php echo $this->Crud_model->blog_link($value->blog_id);?>"><?=$value->title?></a></h2>
					                            <div class="post-meta">
													<a href="<?=base_url()?>home/reporter_description/1/Robin-Milford"> <i class="fa fa-user"></i> <?=$this->Crud_model->get_type_name_by_id('user', $value->blog_uploader_id,'firstname');?> </a>
													<span class="divider">|</span>
													<a href="<?=base_url()?>home/blog/0/0/2017-04-10/2017-04-10"> <i class="fa fa-clock-o"></i> <?php echo date("F j, Y",$value->date);?> </a>
													<span class="divider">|</span>
													<a href="<?php echo $this->Crud_model->blog_link($value->blog_id);?>"><i class="fa fa-comments"></i> 17 Comments </a>
													<span class="divider">|</span>
													<a href="<?php echo $this->Crud_model->blog_link($value->blog_id);?>"><i class="fa fa-thumbs-o-up"></i> 105 Likes </a>
												</div>
					                        </div>
					                        <div class="post-body">
					                            <div class="post-excerpt">
					                                <p><?=$value->summary?></p>
					                            </div> 
					                        </div>
					                    	<div class="row">
					                    		<div class="col-md-12">
					                    			<div class="pull-right">
					                    				<a class="btn btn-readmore btn-icon-left" href="<?php echo $this->Crud_model->blog_link($value->blog_id);?>"> <i class="fa fa-file-text-o"></i> Read More </a>
													</div>
					                    		</div>
											</div>
					                    </article>
					                </div>
								</div>	
							<?php
						if ($row_index % 2 == 0) { 
						?>
							</div>
						<?php 
						}
						$row_index ++;
						$item_index ++;
					}
					?>
					<!-- Pagination -->
					<div class="row">
						<div class="col-xs-12">
							<div class="pagination-wrapper">
								<ul class="pagination">
									<li class="active"><a>1<span class="sr-only">(current)</span></a></li>
									<li><a onclick="filter_blog(((this.innerHTML-1)*7))">2</a></li>
									<li><a onclick="filter_blog(((this.innerHTML-1)*7))">3</a></li>
									<li><a onclick="filter_blog('7')">›</a></li>
									<li><a onclick="filter_blog('42')">»</a></li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Pagination -->

					<script>
						$(document).ready(function(){
						    $('[data-toggle="tooltip"]').tooltip(); 
						    load_iamges();
						});
					</script>					
				</div>
			</div>
		</div>
	</div>
</section>
<script>
/*	function get_blogs(){	
		$("#result").load("<?php echo base_url()?>home/get_blog_list/");
}*/
    $(document).ready(function () {
        setTimeout(function () {
            close_sidebar();
            //get_blogs();
            set_category_blog_box();
        }, 500);
    });
    function open_sidebar() {
        $('.sidebar').removeClass('close_now');
        $('.sidebar').addClass('open');
    }
    function close_sidebar() {
        $('.sidebar').removeClass('open');
        $('.sidebar').addClass('close_now');
    }
    function set_category_blog_box() {
        var max_height = 0;
        $('.sp_blog_tab2 .blog_list').each(function () {
            var current_height = parseInt($(this).css('height'));
            if (current_height >= max_height) {
                max_height = current_height;
            }
        });
        $('.sp_blog_tab2 .blog_list').css('height', max_height);
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