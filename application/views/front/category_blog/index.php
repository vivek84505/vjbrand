<?php
	$category_blog_data = json_decode($this->Crud_model->get_settings_value('ui_settings','category_blog','value'),true);
?>
<!-- CONTENT AREA -->
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
                        	<a href="<?php echo base_url(); ?>home/blog">
                            	<i class="fa fa-home"></i>
                            </a>
                        </li>
                        <?php
                            if($blog_sub_category == '0'){
                        ?>
                        	<li class="active">
                            	<span>
                                    <?php 
                                    if ($blog_category == '0') {
                                        echo translate('all_blogs');
                                    } else {
                                        echo $this->Crud_model->get_type_name_by_id('blog_category',$blog_category);
                                    } 
                                    ?>
                                </span>
                            </li>
                        <?php
							}else{
						?>
                            <li>
                                <?php 
                                    if ($blog_category == '0') {
                                        ?>
                                        <a href="<?php echo base_url(); ?>home/blog_category/0/0">
                                            <?php echo translate('all_blogs'); ?>
                                        </a>
                                        <?php 
                                    } else {
                                        ?>
                                        <a href="<?php echo base_url(); ?>home/blog_category/<?php echo $blog_category;?>/0">
                                            <?php echo $this->Crud_model->get_type_name_by_id('blog_category',$blog_category); ?>
                                        </a>
                                        <?php
                                    }?>
                                
                            </li>
                        	<li class="active">
                            	<span>
                                	<?php echo $this->Crud_model->get_type_name_by_id('blog_sub_category',$blog_sub_category); ?>
                                </span>
                            </li>
                        <?php
                            }
                        ?>
                    </ol>
                    <div class="blog_content" id="blog_result">
                       
                    </div>
                    <?php
                        echo form_open(base_url() . 'home/ajax_blog_list/', array(
                            'class' => 'form-horizontal',
                            'method' => 'post',
                            'id' => 'filter_form'
                        ));
                    ?>
                        <input type="hidden" value="<?php echo $blog_category; ?>" id="cat" />
                        <input type="hidden" value="<?php echo $blog_sub_category; ?>" id="sub_cat" />
                        <input type="hidden" name="blog_date" value="<?php echo $blog_date; ?>"/>
                        <input type="hidden" name="date_from" value="<?php if (isset($start_date)) { echo $start_date; } ?>" id="st_date" />
                        <input type="hidden" name="date_to" value="<?php if (isset($end_date)) { echo $end_date; } ?>" id="en_date" />
                        <input type="hidden" name="search_text" value="<?php if (isset($blog_search_text)) { echo $blog_search_text; } ?>" id="blog_search_text" />
                    </form>
                    <?php
						echo $this->Html_model->bottom_part($category_blog_data['page_bottom']);
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
		/*set_category_blog_box();
        set_blog_box();*/
	},500);

    filter_blog('0');
});

function set_blog_box(){
    // alert();
    var max_height_image = 0;
    $('.news_box_rect_1 .media').each(function(){
        var current_height_image= parseInt($(this).css('height'));
        if(current_height_image >= max_height_image){
            max_height_image = current_height_image;
        }
    });
    $('.news_box_rect_1 .media').css('height',max_height_image);
}

function open_sidebar(){
	$('.sidebar').removeClass('close_now');
	$('.sidebar').addClass('open');
}
function close_sidebar(){
	$('.sidebar').removeClass('open');
	$('.sidebar').addClass('close_now');
}
function set_category_blog_box(){
	var max_height1 = 0;
	$('.blog_box_sqr_1.sm').each(function(){
        var current_height= parseInt($(this).css('height'));
		if(current_height >= max_height1){
			max_height1 = current_height;
		}
    });
	$('.blog_box_sqr_1.sm').css('height',max_height1);
	
	var max_height2 = 0;
	$('.blog_box_rect_1.sm').each(function(){
        var current_height= parseInt($(this).css('height'));
		if(current_height >= max_height2){
			max_height2 = current_height;
		}
    });
	$('.blog_box_rect_1.sm').css('height',max_height2);
	
	var max_height3 = 0;
	$('.blog_box_rect_1.thumb').each(function(){
        var current_height= parseInt($(this).css('height'));
		if(current_height >= max_height3){
			max_height3 = current_height;
		}
    });
	$('.blog_box_rect_1.thumb').css('height',max_height3);
}
</script>
<script>        
    function filter_blog(page){
        var cat = '<?=$blog_category?>';
        var sub_cat = '<?=$blog_sub_category?>';

        var form = $('#filter_form');
        var alert = $('#blog_result');
        var formdata = false;
        if (window.FormData){
            formdata = new FormData(form[0]);
        }
        $.ajax({
            url: form.attr('action')+page+'/'+cat+'/'+sub_cat, // form action url
            type: 'POST', // form submit method get/post
            dataType: 'html', // request type html/json/xml
            data: formdata ? formdata : form.serialize(), // serialize form data 
            cache       : false,
            contentType : false,
            processData : false,
            beforeSend: function() {
                alert.fadeOut();
                alert.html('loading...').fadeIn(); // change submit button text
            },
            success: function(data) {
                setTimeout(function(){
                    alert.html(data); // fade in response data
                    set_category_blog_box();
                    set_blog_box();
                }, 20);
                setTimeout(function(){
                    alert.fadeIn(); // fade in response data
                }, 30);
            },
            error: function(e) {
                console.log(e)
            }
        });        
    }
</script>
<script>
    $('#date_start').change(function(){
        $('#st_date').val($('#date_start').val());
    });
    $('#date_end').change(function(){
        $('#en_date').val($('#date_end').val());
    });
    $('#search_input').change(function(){
        $('#blog_search_text').val($('#search_input').val());
    });
</script>

<style>
	.sidebar.close_now{
		position: relative;
		left:0px;
		opacity:1;
	}
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