<div class="content-area">
    <!-- PAGE WITH SIDEBAR -->
    <section class="page-section with-sidebar pad-t-15">
        <div class="container">
            <div class="row mar-lr--5">
                <!-- CONTENT -->
                <!-- SIDEBAR -->
                <aside class="col-md-3 sidebar pull-left" id="sidebar">
                    <div class="box_shadow">
                        <span class="btn btn-theme-transparent pull-left hidden-lg hidden-md" onClick="close_sidebar();" style="border-radius:50%; position: absolute; top:30px; right:0px; z-index:99;">
                            <i class="fa fa-times"></i>
                        </span>
                        <div class="widget shop-categories thin-border">
                            <h4 class="widget-title">
                                <?php echo translate('pages'); ?>
                            </h4>
                            <div class="widget-content">
                                <ul>
                                    <?php
                                        foreach ($pages as $row) {
                                    ?>
                                        <li class="" id="page_<?php echo $row['ad_page_id'];?>" style="cursor:pointer;" onclick="get_ad_content('<?php echo $row['ad_page_id']; ?>')">
                                            <?php echo translate($row['name']); ?>
                                        </li>                                    
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </aside>
                <!-- /SIDEBAR -->
                <div class="col-md-9 content pad-lr-5" id="content">
                    <span class="btn btn-theme-transparent pull-left hidden-lg hidden-md mob-con" style="position:relative; z-index:100;padding: 5px 12px; border-radius:4px;width: 100%; margin-bottom: 15px;" onClick="open_sidebar();">
                        <i class="fa fa-bars"></i>
                    </span>
                    <ol class="breadcrumb breadcrumb-custom hidden-sm hidden-xs">
                        <li>
                            <a href="<?php echo base_url(); ?>">
                                <i class="fa fa-home"></i>
                            </a>
                        </li>
                        <li class="active">
                            <span>
                                <?php echo translate('apply_for_advertisement'); ?>
                            </span>
                        </li>
                    </ol>
                    <div class="" id="result">
                         
                    </div>
                </div>
                <!-- /CONTENT -->
            </div>
        </div>
    </section>
    <!-- /PAGE WITH SIDEBAR -->
</div>
<!-- /CONTENT AREA-->
<script>
    $(document).ready(function () {
        close_sidebar();
        get_ad_content(1);
    });
    function get_ad_content(id) {
        $('.widget-content').children().find('.active').removeClass('active');
        $('#page_'+id).addClass('active');
        $('#result').load('<?php echo base_url();?>home/marketing/page/'+id);
    }
    function open_sidebar() {
        $('.sidebar').removeClass('close_now');
        $('.sidebar').addClass('open');
    }
    function close_sidebar() {
        $('.sidebar').removeClass('open');
        $('.sidebar').addClass('close_now');
    }
    function apply_ad(ad_id){
        $('#popup-3').hide();
        var state   = check_login_stat('state');
        state.success(function (data) {
            if(data == 'hypass'){
                if(ad_id != null){
                    location.replace('<?php echo base_url(); ?>home/profile/ad/'+ad_id);
                }else{	
                    notify('<?php echo translate('choose_a_position_and_click_again'); ?>','warning','bottom','right');	
                }
            } 
            else{
                signin('quick');
            }
        });
    }
	
</script>
<style>
    .information-title span{
        text-transform: capitalize;
        color: #232323;
        background: #efefef;
    }.sidebar.close_now{
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
            opacity: 0;
            transition: all .6s ease-in;
        }
        .view_select_btn{
            margin-top: 10px !important;
        }
    }
</style>