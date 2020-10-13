<!DOCTYPE html>
<html lang="en">
    <head>
    	<?php include 'includes/top/index.php' ;?>
    </head>
    <body id="home" class="wide">
        <!-- PRELOADER -->
        <?php include 'preloader.php' ;?>
        <!-- /PRELOADER -->

        <!-- WRAPPER -->
        <div class="wrapper">
			<?php include 'header/header-1.php' ;?>
            
            <?php
                if ($page_name == "blog" || $page_name == "blog_list" || $page_name == "blog_detail") {
                }
                else {
                    include 'marquee/marquee-1.php';
                }
            ?>
            
            <?php include $page_name.'/index.php' ;?>

            <?php include 'footer/footer-1.php' ;?>

        </div>
        <!-- /WRAPPER -->
        <?php
            include 'script_texts.php';
        ?>
        <?php include 'includes/bottom/index.php' ;?>
    </body>
</html>