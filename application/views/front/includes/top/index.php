<?php
    $description     =  $this->Crud_model->get_settings_value('general_settings','meta_description');
    $keywords        =  $this->Crud_model->get_settings_value('general_settings','meta_keywords');
    $author          =  $this->Crud_model->get_settings_value('general_settings','meta_author');
    $system_name     =  $this->Crud_model->get_settings_value('general_settings','system_name');
    $system_title    =  $this->Crud_model->get_settings_value('general_settings','system_title');
    $revisit_after   =  $this->Crud_model->get_settings_value('general_settings','revisit_after');
    $image 			 =  $this->Crud_model->logo('home_top_logo');
    $url 			 =  current_url();
?>
<?php include 'meta/'.$asset_page.'.php';?>
<?php
	$description = str_replace('justify;"=""', '', $description);
	$description = str_replace('[removed]=""', '', $description);
?>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="<?php echo str_replace('"',"'",strip_tags($description)); ?>">
<meta name="keywords" content="<?php echo $keywords; ?>">
<meta name="author" content="<?php echo $author; ?>">
<meta name="revisit-after" content="<?php echo $revisit_after; ?> days">

<!-- Schema.org markup for Google+ -->
<meta itemprop="name" content="<?php echo $page_title; ?> || <?php echo $system_title; ?>">
<meta itemprop="description" content="<?php echo str_replace('"',"'",strip_tags($description)); ?>">
<meta itemprop="image" content="<?php echo $image; ?>">

<!-- Twitter Card data -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="@publisher_handle">
<meta name="twitter:title" content="<?php echo $page_title; ?> || <?php echo $system_title; ?>">
<meta name="twitter:description" content="<?php echo str_replace('"',"'",strip_tags($description)); ?>">
<!-- Twitter summary card with large image must be at least 280x150px -->
<meta name="twitter:image:src" content="<?php echo $image; ?>">

<!-- Open Graph data -->
<meta property="og:title" content="<?php echo $page_title; ?> || <?php echo $system_title; ?>" />
<meta property="og:type" content="article" />
<meta property="og:url" content="<?php  echo $url; ?>" />
<meta property="og:image" content="<?php echo $image; ?>" />
<meta property="og:description" content="<?php echo str_replace('"',"'",strip_tags($description)); ?>" />
<meta property="og:site_name" content="<?php echo $page_title; ?> || <?php echo $system_title; ?>" />

<!-- Google Analytics -->
    <script>
	    <?php $g_set = $this->db->get_where('general_settings',array('type'=>'google_analytics_set'))->row()->value;
	        if ($g_set == "yes") {
	            $g_key = $this->db->get_where('third_party_settings',array('type'=>'google_analytics_key'))->row()->value;
	        }
	        else {
	            $g_key = " ";
	        }
	    ?>
	    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

	    ga('create', "<?php echo $g_key; ?>", 'auto');
	    ga('send', 'pageview');
    </script>
<!-- End Google Analytics -->

<title><?php echo $page_title; ?> || <?php echo $system_title; ?> </title>

<!-- Favicon -->
<?php $ext =  $this->db->get_where('ui_settings',array('type' => 'fav_ext'))->row()->value;?>
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url();?>uploads/others/favicon.png">
<link rel="shortcut icon" href="<?php echo base_url();?>uploads/others/favicon.<?php echo $ext; ?>">
<!-- Favicon Ends -->

<!-- CSS Global -->
<link href="<?php echo base_url();?>template/front/assets/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>template/front/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>template/front/assets/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>template/front/assets/plugins/fontawesome/css/font-awesome.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>template/front/assets/modal/css/sm.css" rel="stylesheet">

<link href="<?php echo base_url();?>template/front/assets/plugins/animate/animate.min.css" rel="stylesheet">
<!-- CSS Global Ends -->

<!-- Theme CSS -->
<link href="<?php echo base_url();?>template/front/assets/css/theme.css" rel="stylesheet">
<link href="<?php echo base_url();?>template/front/assets/css/custom-theme.css" rel="stylesheet">
<link href="<?php echo base_url();?>template/front/assets/custom/buttons/custom-1.css" rel="stylesheet">
<link href="<?php echo base_url();?>template/front/assets/custom/buttons/bootstrap-social.css" rel="stylesheet">
<link href="<?php echo base_url();?>template/front/assets/custom/input-form/custom-1.css" rel="stylesheet">
<link href="<?php echo base_url();?>template/front/assets/custom/smedia/custom-1.css" rel="stylesheet">
<link href="<?php echo base_url();?>template/front/assets/custom/checkbox_radio/custom-1.css" rel="stylesheet">
<link href="<?php echo base_url();?>template/front/assets/custom/tab_menu/tab_menu-1.css" rel="stylesheet">
<?php $theme =  $this->db->get_where('ui_settings',array('type' => 'header_color'))->row()->value;?>
<link href="<?php echo base_url();?>template/front/assets/css/theme-<?php echo $theme; ?>.css" rel="stylesheet">
<!-- Theme CSS Ends -->

<?php
	$font =  $this->db->get_where('ui_settings',array('type' => 'font'))->row()->value;
?>
<link href='https://fonts.googleapis.com/css?family=<?php echo $font; ?>:400,500,600,700,800,900' rel='stylesheet' type='text/css'>
<style>
	*{
		font-family: '<?php echo str_replace('+',' ',$font); ?>', sans-serif;
	}
	.remove_one{
		cursor:pointer;
		padding-left:5px;
	}
</style>

<?php include $asset_page.'.php';?>

<!-- Head Libs -->
<script src="<?php echo base_url();?>template/front/assets/plugins/jquery/jquery-1.11.1.min.js"></script>
<script src="<?php echo base_url();?>template/front/assets/plugins/modernizr.custom.js"></script>
