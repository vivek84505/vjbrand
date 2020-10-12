<?php
	$blog_photo_gal_data = json_decode($this->Crud_model->get_settings_value('ui_settings','blog_photo_gal','value'),true);
	$blog_video_gal_data = json_decode($this->Crud_model->get_settings_value('ui_settings','blog_video_gal','value'),true);
	if (true) {
		include 'blog_posts.php';
	}
?>
<div class="container">
	<div class="row mar-lr--5">
		<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 content pad-lr-5" id="content">
			<?php
				if (true) {
					include 'photo_gallery.php';
				}
				if (true) {
					include 'video_gallery.php';
				}
			?>
		</div>
		<?php
			include 'categories.php';
		?>
	</div>
</div>
<?php
	if (true) {
		include 'blog_bottom.php';
	}
?>
<script>
    $(document).ready(function () {
        setTimeout(function () {
            close_sidebar();
            set_category_news_box();
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
    function set_category_news_box() {
        var max_height = 0;
        $('.sp_news_tab2 .news_list').each(function () {
            var current_height = parseInt($(this).css('height'));
            if (current_height >= max_height) {
                max_height = current_height;
            }
        });
        $('.sp_news_tab2 .news_list').css('height', max_height);
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
