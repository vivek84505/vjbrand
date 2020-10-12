<?php
    $discus_id = $this->db->get_where('third_party_settings', array('type' => 'discus_id'))->row()->value;
    $fb_id = $this->db->get_where('third_party_settings', array('type' => 'fb_comment_api'))->row()->value;
    $comment_type = $this->db->get_where('third_party_settings', array('type' => 'comment_type'))->row()->value;
    $news_description_data = json_decode($this->Crud_model->get_settings_value('ui_settings', 'news_description', 'value'), true);
?>
<section class="page-section with-sidebar pad-t-15">
	<div class="container">
		<div class="row mar-lr--5">
			<?php include 'left_aside.php'; ?>
			<!-- CONTENT -->
			<?php include 'main_content.php'; ?>
			<!-- /CONTENT -->
			<!-- RIGHT SIDEBAR -->
			<?php include 'right_aside.php'; ?>
			<!-- /RIGHT SIDEBAR -->
		</div>
	</div>
</section>
<script>
    $(document).ready(function () {
        close_sidebar();
        $('#share').share({
            networks: ['facebook', 'googleplus', 'twitter', 'linkedin', 'tumblr', 'in1', 'stumbleupon', 'digg'],
            theme: 'square'
        });
    });
    $('.zoom-in').on('click', function (e) {
        var summary = parseFloat($('.text-summary').css('font-size'));
        var summary_line = parseFloat($('.text-summary').css('line-height'));

        var description = parseFloat($('.text-description').css('font-size'));
        var description_line = parseFloat($('.text-description').css('line-height'));

        if (summary <= 42) {
            summary = summary + 1;
            summary_line = summary_line + 1;

            description = description + 1;
            description_line = description_line + 1;
        }

        $('.text-summary').css('font-size', summary + 'px');
        $('.text-summary').css('line-height', summary_line + 'px');

        $('.text-description').css('font-size', description + 'px');
        $('.text-description').css('line-height', description_line + 'px');
    });

    $('.zoom-out').on('click', function (e) {
        var summary = parseFloat($('.text-summary').css('font-size'));
        var summary_line = parseFloat($('.text-summary').css('line-height'));

        var description = parseFloat($('.text-description').css('font-size'));
        var description_line = parseFloat($('.text-description').css('line-height'));

        if (summary >= 16) {
            summary = summary - 1;
            summary_line = summary_line - 1;

            description = description - 1;
            description_line = description_line - 1;
        }

        $('.text-summary').css('font-size', summary + 'px');
        $('.text-summary').css('line-height', summary_line + 'px');

        $('.text-description').css('font-size', description + 'px');
        $('.text-description').css('line-height', description_line + 'px');
    });
    function open_sidebar() {
        $('.sidebar').removeClass('close_now');
        $('.sidebar').addClass('open');
    }
    function close_sidebar() {
        $('.sidebar').removeClass('open');
        $('.sidebar').addClass('close_now');
    }
</script>
<style>
    .post-meta i{
        margin-right:5px;
    }
</style>
<script>
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });

    function print_news() {
        window.print();
    }
</script>
<style type="text/css">    
    @media print {
        .top-bar,
        header,
        footer,
        aside,
        .post-control,
        .breadcrumb,
        .bottom_part,
        .to-top,
        .advertise,
        .comments,
        .social_share,
        #marquee_section,
        .post-meta.to_show,
        .advertise_space2, 
        .mob-con{
            display: none !important;
        }
        .post-meta.print{
            display: block !important;
        }
        .invoice{
            padding: 0px;
        }
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
    .fb_ltr {
        width: 97% !important;
    }
</style>