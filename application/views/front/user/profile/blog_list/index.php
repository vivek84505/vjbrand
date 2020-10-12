<div class="information-title">
    <?php echo translate('my_blogs'); ?>
</div>
<div class="details-wrap">
    <div class="details-box">
        <div class="row">
            <div class="col-md-12">
                <div class="tabs-wrapper content-tabs">
                    <nav class="menu tab-menu-1">
                        <ul id="tabs" class="menu-list">
                            <li class="menu-item" id="a_blog">
                                <a class="menu-link uppercase" href="#tab1" data-toggle="tab" onclick="get_tab_data('blog_edit')"><?php echo translate('blog_edit');?></a>
                            </li>
                            <li class="menu-item" id="a_image">
                                <a class="menu-link uppercase" href="#tab2" data-toggle="tab" onclick="get_tab_data('blog_image_edit')"><?php echo translate('blog_image_edit');?></a>
                            </li>
                            <li class="menu-item" id="a_video">
                                <a class="menu-link uppercase" href="#tab3" data-toggle="tab" onclick="get_tab_data('blog_video_edit')"><?php echo translate('blog_video_edit');?></a>
                            </li>
                        </ul>
                    </nav>
                    <div class="tab-content">
                        <div class="tab-pane fade active in" id="">
                            <div class="details-wrap">
                                <div class="details-box" id="tab_load">
                                    <?php
                                        //include 'ajax_blog_list.php';
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>            
        </div>
    </div>
</div>

<script>
    function get_tab_data(page){
        $('#a_blog').removeClass('active');
        $('#a_image').removeClass('active');
        $('#a_video').removeClass('active');
        if (page == 'blog_edit') {
            $('#a_blog').addClass('active');
        } else if (page == 'blog_image_edit') {
            $('#a_image').addClass('active');
        } else if (page == 'blog_video_edit') {
            $('#a_video').addClass('active');
        }

        if (page == 'blog_edit' || page == 'blog_image_edit' || page == 'blog_video_edit') {
            $("#tab_load").load("<?php echo base_url()?>home/get_blog_edit_tab/"+page);
        }
    }

    $(document).ready(function () {
        load_iamges();
        set_switchery();
        get_tab_data('blog_edit');
    });
</script>

<style>
    select.input-sm, select.form-group-sm .form-control {
        height: 40px !important;
        line-height: 15px !important;
    }
    .as{
        margin-top:0px !important;
    }
    td .sm{
        height:50px;
    }
</style>