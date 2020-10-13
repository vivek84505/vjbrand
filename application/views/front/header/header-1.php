<link href="<?php echo base_url(); ?>template/front/assets/custom/mega_menu/mega_menu.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>template/front/assets/custom/mega_menu/mega_menu.js"></script>
<?php
    $header_style = json_decode($this->Crud_model->get_settings_value('ui_settings', 'header_style'), true);
    $fb_login_set = $this->Crud_model->get_settings_value('third_party_settings', 'fb_login_set', 'value');
    $g_login_set = $this->Crud_model->get_settings_value('third_party_settings', 'g_login_set', 'value');

?>
<!-- Header top bar -->
<div class="top-bar">
    <div class="container">
        <div style="display:table; width:100%;">
            <div style="display:table-row;">
                <div class="top-bar-left" style="display:table-cell; float:none; text-align:left;">
                    <ul class="list-inline">
                        <li class="dropdown flags">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <?php
                                    if ($set_lang = $this->session->userdata('language')) {

                                    } else {
                                        $set_lang = $this->db->get_where('general_settings', array('type' => 'language'))->row()->value;
                                    }
                                    $lid = $this->db->get_where('language_list', array('db_field' => $set_lang))->row()->language_list_id;
                                    $lnm = $this->db->get_where('language_list', array('db_field' => $set_lang))->row()->name;
                                ?>
                                <img src="<?php echo $this->Crud_model->file_view('language_list', $lid, '', '', 'no', 'src', '', '', '.jpg') ?>" width="20px;" alt=""/>
                                <span class="hidden-xs"><?php echo $lnm; ?></span>
                                <i class="fa fa-caret-down"></i>
                            </a>
                            <ul role="menu" class="dropdown-menu">
                                <?php
                                    $langs = $this->db->get_where('language_list', array('status' => 'ok'))->result_array();
                                    foreach ($langs as $row) {
                                ?>
                                    <li <?php if ($set_lang == $row['db_field']) { ?>class="active"<?php } ?> >
                                        <a class="set_langs" data-href="<?php echo base_url(); ?>home/set_language/<?php echo $row['db_field']; ?>">
                                            <img src="<?php echo $this->Crud_model->file_view('language_list', $row['language_list_id'], '', '', 'no', 'src', '', '', '.jpg') ?>" width="20px;" alt=""/>
                                            <?php echo $row['name']; ?>
                                            <?php if ($set_lang == $row['db_field']) { ?>
                                                <i class="fa fa-check"></i>
                                            <?php } ?>
                                        </a>
                                    </li>
                                <?php
                                    }
                                ?>
                            </ul>
                        </li>
                        <li class="dropdown flags">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <?php
                                    if($currency_id = $this->session->userdata('currency'))
                                    {}
                                    else {
                                        $currency_id = $this->db->get_where('business_settings', array('type' => 'currency'))->row()->value;
                                    }
                                    $symbol = $this->db->get_where('currency_settings',array('currency_settings_id'=>$currency_id))->row()->symbol;
                                    $c_name = $this->db->get_where('currency_settings',array('currency_settings_id'=>$currency_id))->row()->name;
                                ?>
                                <span class="hidden-xs"><?php echo $c_name; ?></span> (<?php echo $symbol; ?>)
                                <i class="fa fa-caret-down"></i>
                            </a>
                            <ul role="menu" class="dropdown-menu">
                                <?php
                                    $currencies = $this->db->get_where('currency_settings',array('status'=>'ok'))->result_array();
                                    foreach ($currencies as $row)
                                    {
                                ?>
                                    <li <?php if($currency_id == $row['currency_settings_id']){ ?>class="active"<?php } ?> >
                                        <a class="set_langs" data-href="<?php echo base_url(); ?>home/set_currency/<?php echo $row['currency_settings_id']; ?>">
                                            <?php echo $row['name']; ?> (<?php echo $row['symbol']; ?>)
                                            <?php if($currency_id == $row['currency_settings_id']){ ?>
                                                <i class="fa fa-check"></i>
                                            <?php } ?>
                                        </a>
                                    </li>
                                <?php
                                    }
                                ?>
                            </ul>
                        </li>
                        <li class="hidden-sm hidden-xs">
                            <a href="<?php echo base_url(); ?>home/marketing" class="link">
                                <i class="fa fa-bullhorn"></i>
                                <?php echo translate('apply_for_advertise'); ?>
                            </a>
                        </li>
                        <?php if (@$this->db->get_where('user',array('user_id' => $this->session->userdata('user_id')))->row()->is_blogger == 'yes'): ?>
                        <li class="hidden-sm hidden-xs">
                            <a href="<?php echo base_url(); ?>home/profile/pfp" class="link">
                                <i class="fa fa-credit-card"></i>
                                <?php echo translate('blog_posting'); ?>
                            </a>
                        </li>
                        <?php endif ?>

                    </ul>
                </div>
                <div class="top-bar-middle" style="display:table-cell; float:none; text-align:center;">
                    <ul class="list-inline">
                        <li class="header_clock hidden-sm  hidden-xs">
                            <ul>
                                <li class="number" id="hours"></li>
                                <li id="point">:</li>
                                <li class="number" id="min"></li>
                                <li id="point">:</li>
                                <li class="number" id="sec"></li>
                                <li id="period"></li>
                            </ul>
                        </li>
                        <li class="hidden-sm hidden-xs">
                            <div id="Date" class="date"></div>
                        </li>
                    </ul>
                </div>
                <div class="top-bar-right" style="display:table-cell; float:none; text-align:right;">

                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Header top bar -->
<!-- Demo note -->
<?php if(demo()){ ?>
    <div class="" style=" text-align: center;">
        <i class="text-danger blink_me fa fa-exclamation-triangle" style="font-size: 16px"></i>  For demo purpose many operations including deletion, emailing, file uploading are <b>DISABLED</b>
    </div>
<?php } ?>
<!-- Demo note end -->
<!-- HEADER -->
<div class="header1 hidden-sm hidden-xs" id="myHeader">
    <div class="container">
        <nav id="menu-1" class="mega-menu" data-color="color-0">
            <!-- menu list items container -->
            <section class="menu-list-items">
                <!-- menu links -->
                <ul class="menu-links"> <!-- active class -->
                    <li class="<?php if($page_name=='home/home-1'){echo "active";}?>">
                        <a href="<?php echo base_url(); ?>home">
                            <i class="fa fa-home"></i>
                            <?php echo translate('home'); ?>
                        </a>
                    </li>
                    <li class="<?php if($page_name=='category_news' || $page_name == 'news_list'){echo "active";}?>">
                        <a href="<?php echo base_url(); ?>home/news/0/0">
                            <?php echo translate('news'); ?>
                            <i class="fa fa-caret-down fa-indicator"></i>
                        </a> <!-- drop down full width -->
                        <div class="drop-down grid-col-12">
                            <?php
                                $i = 0;
                                $category = $this->db->get('news_category')->result_array();
                                foreach ($category as $row) {
                                    $i++;
                                    $sub_category = $this->db->get_where('news_sub_category', array('parent_category_id' => $row['news_category_id']))->result_array();
                                    if ($i % 6 == 1) {
                                    ?>
                                        <div class="grid-row">
                                    <?php
                                        }
                                    ?>
                                        <div class="grid-col-2">
                                            <a href="<?php echo base_url(); ?>home/news/<?php echo $row['news_category_id']; ?>/0">
                                                <h4><?php echo $row['name']; ?></h4>
                                            </a>
                                            <?php
                                                if (count($sub_category) !== 0) {
                                            ?>
                                                <ul>
                                                    <?php
                                                        foreach ($sub_category as $rows) {
                                                    ?>
                                                        <li>
                                                            <a href="<?php echo base_url(); ?>home/news/<?php echo $row['news_category_id']; ?>/<?php echo $rows['news_sub_category_id']; ?>">
                                                                <i class="fa fa-caret-right"></i>
                                                                <?php echo $rows['name']; ?>
                                                            </a>
                                                        </li>
                                                    <?php
                                                        }
                                                    ?>
                                                </ul>
                                            <?php
                                                }
                                            ?>
                                        </div>
                                <?php
                                    if ($i % 6 == 0 && $i > 0) {
                                ?>
                                    </div>
                            <?php
                                    }
                                }
                                if ($i % 6 !== 0) {
                                    echo '</div>';
                                }
                            ?>
                        </div>
                    </li>
                    <li class="<?php if($page_name=='archive_news'){echo "active";}?>">
                        <a href="<?php echo base_url(); ?>home/archive_news/0/0">
                            <?php echo translate('archive_news'); ?>
                        </a>
                    </li>

                    <li class="<?php if($page_name=='photo_gallery' || $page_name=='video_gallery'){echo "active";}?>">
                        <a href="#">
                            <?php echo translate('media'); ?>
                            <i class="fa fa-caret-down fa-indicator"></i>
                        </a> <!-- drop down full width -->
                        <div class="drop-down grid-col-2">
                            <div class="grid-row">
                                <ul>
                                    <li><a href="<?php echo base_url(); ?>home/photo_gallery"><i class="fa fa-caret-right"></i><?php echo translate('photo_gallery'); ?></a></li>
                                    <li><a href="<?php echo base_url(); ?>home/video_gallery"><i class="fa fa-caret-right"></i><?php echo translate('video_gallery'); ?></a></li>
                                </ul>
                            </div>
                        </div>
                    </li>

                    <li class="<?php if($page_name=='contact'){echo "active";}?>">
                        <a href="<?php echo base_url(); ?>home/contact">
                            <?php echo translate('contact'); ?>
                        </a>
                    </li>
                    <li class="<?php if($page_name=='blog' || $page_name=='blog_list' || $page_name=='blog_detail'){echo "active";}?>">
                        <a href="<?php echo base_url(); ?>home/blog">
                            <?php echo translate('blog'); ?>
                        </a>
                    </li>
                    <li class="<?php if($page_name=='blog_photo_gallery' || $page_name=='blog_video_gallery'){echo "active";}?>">
                        <a href="#">
                            <?php echo translate('blog_media'); ?>
                            <i class="fa fa-caret-down fa-indicator"></i>
                        </a> <!-- drop down full width -->
                        <div class="drop-down grid-col-2">
                            <div class="grid-row">
                                <ul>
                                    <li><a href="<?php echo base_url(); ?>home/blog_photo_gallery"><i class="fa fa-caret-right"></i><?php echo translate('photo_gallery'); ?></a></li>
                                    <li><a href="<?php echo base_url(); ?>home/blog_video_gallery"><i class="fa fa-caret-right"></i><?php echo translate('video_gallery'); ?></a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="<?php if($page_name=='reporters' || $page_name=='bloggers'){echo "active";}?>">
                        <a href="#">
                            <?php echo translate('more'); ?>
                            <i class="fa fa-caret-down fa-indicator"></i>
                        </a> <!-- drop down full width -->
                        <div class="drop-down grid-col-2">
                            <div class="grid-row">
                                <ul>
                                    <li><a href="<?php echo base_url(); ?>home/reporters"><i class="fa fa-caret-right"></i><?php echo translate('reporters'); ?></a></li>
                                    <li><a href="<?php echo base_url(); ?>home/bloggers"><i class="fa fa-caret-right"></i><?php echo translate('bloggers'); ?></a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
                <!-- menu social bar -->
                <ul class="menu-links signup pull-right">
                </ul>
                <!-- menu search bar -->
                <ul class="menu-search-bar">
                    <li>
                        <?php
                            echo form_open(base_url() . 'home/top_search/', array(
                                'class' => 'form-horizontal',
                                'method' => 'post',
                                'id' => 'top_search_form'
                            ));
                        ?>
                            <label>
                                <input name="menu_search_bar" id="top_search_input" placeholder="<?php echo translate('search'); ?>..." type="search">
                                <i id="top_search_button" class="fa fa-search enterer" style="cursor:pointer; margin-right:0px;"></i>
                            </label>
                        </form>
                    </li>
                </ul>
            </section>
        </nav>
    </div>
</div>
<header class="header">
    <div class="header-wrapper">
        <div class="container">
            <!-- Logo -->
            <div class="logo pull-left hidden-sm hidden-xs">
                <a href="<?php echo base_url(); ?>">
                    <img class="img-responsive" src="<?php echo $this->Crud_model->logo('home_top_logo'); ?>" >
                </a>
            </div>
            <div class="logo hidden-lg hidden-md" style="max-width: 60%; width: 60%; display:inline-block; float:left;">
                <a href="<?php echo base_url(); ?>">
                    <img class="img-responsive" src="<?php echo $this->Crud_model->logo('home_top_logo'); ?>" >
                </a>
            </div>
            <div class="logo hidden-lg hidden-md" style="max-width: 15%; width: 15%; display:inline-block; float:right;">
                <span class="menu-toggle btn btn-theme-transparent pull-right" style="padding: 5px 12px; border-radius:4px;"><i class="fa fa-bars"></i></span>
            </div>
            <!-- /Logo -->
            <div class="pull-right col-md-6 col-xs-12" style="padding:0;">
                <?php echo $this->Html_model->advertise_header('header_1'); ?>
            </div>
        </div>
    </div>
</header>
<nav class="navigation closed clearfix hidden-lg hidden-md">
    <a href="#" class="menu-toggle-close btn"><i class="fa fa-times"></i></a>
    <ul class="nav sf-menu">
        <li class="active">
            <a href="<?php echo base_url(); ?>home">
                <i class="fa fa-home"></i>
                <?php echo translate('home'); ?>
            </a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>home/news/0/0">
                <?php echo translate('news'); ?>
            </a> <!-- drop down full width -->
            <ul>
                <?php
                    $category = $this->db->get('news_category')->result_array();
                    foreach ($category as $row) {
                ?>
                    <li>
                        <a href="<?php echo base_url(); ?>home/news/<?php echo $row['news_category_id']; ?>/0">
                            <?php echo $row['name']; ?>
                        </a>
                    </li>
                <?php
                    }
                ?>
            </ul>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>home/archive_news/0/0">
                <?php echo translate('archive_news'); ?>
            </a>
        </li>

        <li>
            <a href="#">
                <?php echo translate('media'); ?>
            </a> <!-- drop down full width -->
            <ul>
                <li>
                    <a href="<?php echo base_url(); ?>home/photo_gallery">
                        <?php echo translate('photo_gallery'); ?>
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url(); ?>home/video_gallery">
                        <?php echo translate('video_gallery'); ?>
                    </a>
                </li>
            </ul>
        </li>

        <li>
            <a href="<?php echo base_url(); ?>home/contact">
                <?php echo translate('contact'); ?>
            </a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>home/blog">
                <?php echo translate('blog'); ?>
            </a>
        </li>
        <li>
            <a href="#">
                <?php echo translate('blog_media'); ?>
            </a> <!-- drop down full width -->
            <ul>
                <li>
                    <a href="<?php echo base_url(); ?>home/blog_photo_gallery">
                        <?php echo translate('photo_gallery'); ?>
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url(); ?>home/blog_video_gallery">
                        <?php echo translate('video_gallery'); ?>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#">
                <?php echo translate('more'); ?>
            </a> <!-- drop down full width -->
            <ul>
                <li>
                    <a href="<?php echo base_url(); ?>home/reporters">
                        <?php echo translate('reporters'); ?>
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url(); ?>home/bloggers">
                        <?php echo translate('bloggers'); ?>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</nav>
<!-- /HEADER -->
<script type="text/javascript">
    $('#top_search_button').on('click', function (e){
        var top_search_text = $('#top_search_input').val();
        if (top_search_text !== "") {
            $('#top_search_form').submit();
            //location.replace("<?php echo base_url(); ?>home/news/0/0/0/0/" + top_search_text);
        }
    });
</script>

<script>
</script>
<script type="text/javascript">
    $(document).ready(function () {
        var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        var dayNames = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"]

        var newDate = new Date();
        newDate.setDate(newDate.getDate());
        $('#Date').html(dayNames[newDate.getDay()] + ", " + newDate.getDate() + ' ' + monthNames[newDate.getMonth()] + ' ' + newDate.getFullYear());

        setInterval(function () {
            var seconds = new Date().getSeconds();
            $("#sec").html((seconds < 10 ? "0" : "") + seconds);
        }, 1000);

        setInterval(function () {
            var minutes = new Date().getMinutes();
            $("#min").html((minutes < 10 ? "0" : "") + minutes);
        }, 1000);

        setInterval(function () {
            var hours = new Date().getHours();
            var period = 'am';
            if (hours >= 12) {
                hours = hours - 12;
                period = 'pm';
            }
            $("#hours").html((hours < 10 ? "0" : "") + hours);
            $("#period").html(period);
        }, 1000);
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.set_langs').on('click', function () {
            var lang_url = $(this).data('href');
            $.ajax({url: lang_url, success: function (result) {
                    location.reload();
                }});
        });
    });
</script>
<?php
	if($header_style['sticky_header'] == 'true') { ?>
	<script type="text/javascript">
		window.onscroll = function() {
		    scrollFunction();
		};
		var header = document.getElementById("myHeader");
		var sticky = header.offsetTop;

		function scrollFunction() {
		    if (window.pageYOffset > sticky) {
		        header.classList.add("sticky-header");
		    } else {
		        header.classList.remove("sticky-header");
		    }
		}
	</script>
<?php } ?>
<style>
    .blink_me {
        animation: blinker 1.5s linear infinite;
    }
    @keyframes blinker {
        50% {
            opacity: 0;
        }
    }
</style>
