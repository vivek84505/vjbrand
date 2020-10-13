<!DOCTYPE html>
<html lang="en">
	<?php
        $system_name	 =  $this->db->get_where('general_settings',array('type' => 'system_name'))->row()->value;
		$system_title	 =  $this->db->get_where('general_settings',array('type' => 'system_title'))->row()->value;
        $version	     =  $this->db->get_where('general_settings',array('type' => 'version'))->row()->value;
    ?>

    <?php include 'includes_top.php'; ?>

    <body onbeforeunload="HandleBackFunctionality()">
        <div id="container" class="effect mainnav-<?php if($page_name == 'site_settings' ||
                                                            $page_name == 'news' ||
                                                            $page_name == 'ads_settings' ||
                                                            $page_name == 'display_others' ||
                                                            $page_name == 'display_theme_selection' ||
                                                            $page_name == 'display_theme_settings' ||
                                                            $page_name=="default_images"){ echo 'sm'; }else{ echo 'lg';} ?>">

            <!--NAVBAR-->
            <?php include 'header.php'; ?>
            <!--END NAVBAR-->
            <div class="boxed" id="fol">
                <!--CONTENT CONTAINER-->
                <?php include $this->session->userdata('title').'/'.$page_name.'.php' ?>
                <!--END CONTENT CONTAINER-->

                <!--MAIN NAVIGATION-->
                <?php include $this->session->userdata('title').'/navigation.php' ?>
                <!--END MAIN NAVIGATION-->
            </div>

            <!-- FOOTER -->
            <?php include 'footer.php'; ?>
            <?php include 'script_texts.php'; ?>
            <!-- END FOOTER -->

            <!-- SCROLL TOP BUTTON -->
            <button id="scroll-top" class="btn"><i class="fa fa-chevron-up"></i></button>
        </div>
        <!-- END OF CONTAINER -->
    	<?php include 'includes_bottom.php'; ?>

	</body>
</html>
