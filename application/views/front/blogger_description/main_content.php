<div class="content">
    <article class="post-wrap">
        <div class="post-media">
            <div class="cover form-body pic_changer window_set">
                <?php
                    if($blogger_id == $this->session->userdata('user_id')){
                        echo form_open(base_url() . 'home/change_blogger_cover/' . $row['user_id'], array(
                            'class' => '',
                            'method' => 'post',
                            'id' => 'fff',
                            'enctype' => 'multipart/form-data'
                        ));
                    ?>
                        <span id="inppic2" class="set_image">
                            <label class="btn btn-theme btn-theme-sm" for="imgInp2" style="margin-top: 5px; margin-right: 5px; float: right;">
                                <span><?php echo translate('change_picture'); ?></span>
                            </label>
                            <input type="file" style="display:none;" id="imgInp2" name="cvr_img" />
                        </span>
                        <span id="savepic2" style="display:none;">
                            <span class="btn btn-theme btn-theme-sm signup_btn" onclick="abnv2('inppic2'); change_state2('normal');"  data-ing="<?php echo translate('saving'); ?>..." data-success="<?php echo translate('cover_picture_saved_successfully!'); ?>" data-unsuccessful="<?php echo translate('edit_failed!'); ?> <?php echo translate('try_again!'); ?>" data-reload="no" style="margin-top: 5px; margin-right: 5px; float: right;">
                                <span><?php echo translate('save_changes'); ?></span>
                            </span>
                        </span>
                    </form>
                    <?php
                    }
                ?>
            </div>
            <input type="hidden" id="state2" value="normal" />
            <?php 
                if (file_exists('uploads/blogger_cover_image/cover_image_'.$row['user_id'].'.jpg')) {
                ?>
                    <div id="blah2" style="height:280px; background-size: cover; background-position: center; background-image: url(<?=base_url()?>uploads/blogger_cover_image/cover_image_<?=$row['user_id']?>.jpg)">
                    </div>
                <?php
                } else {
                ?>
                    <div id="blah2" style="height:280px; background-size: cover; background-position: center; background-image: url(<?=base_url()?>uploads/blogger_cover_image/default.jpg)">
                    </div>
                <?php
                }
            ?>
        </div>
        <?php
        if($blogger_id == $this->session->userdata('user_id')){ ?>
        <div class="row blocks shop-info-banners">
            <div class="col-md-12">
                <div class="col-md-4" style="cursor: pointer;">
                    <a href="<?php echo base_url() ?>home/profile/pfp">
                        <div class="block theme_block">
                            <div class="media">
                                <div class="pull-right"><i class="fa fa-credit-card theme_icon"></i></div>
                                <div class="media-body">
                                    <h4 class="media-heading theme_m_heading" style="font-size: 15px; line-height: 55px;"><?=translate('post_my_blogs')?></h4>
                                </div>
                            </div>
                        </div>
                    </a> 
                </div>
                <div class="col-md-4" style="cursor: pointer;">
                    <a href="<?php echo base_url() ?>home/profile/blog_lst">
                        <div class="block theme_block">
                            <div class="media">
                                <div class="pull-right"><i class="fa fa-list-ul theme_icon"></i></div>
                                <div class="media-body">
                                    <h4 class="media-heading theme_m_heading" style="font-size: 15px; line-height: 55px;"><?=translate('my_blog_list')?></h4>
                                </div>
                            </div>
                        </div>
                    </a>  
                </div>
                <div class="col-md-4" style="cursor: pointer;"> 
                    <a href="<?php echo base_url() ?>home/profile/pp">
                        <div class="block theme_block">
                            <div class="media">
                                <div class="pull-right"><i class="fa fa-gift theme_icon"></i></div>
                                <div class="media-body">
                                    <h4 class="media-heading theme_m_heading" style="font-size: 15px; line-height: 55px;"><?=translate('premium_packages')?></h4>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <?php } ?>
    </article>
   
    <div class="row">
        <div class="col-md-12">
            <div class="col-xs-6 col-sm-4">
                <div class="widget thin-border shop-categories" style="margin-top: 13px">
                    <h4 class="widget-title"><?php echo translate('blogs'); ?></h4>
                    <div class="widget-content">
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="" style="font-size: 12px; width: 100%">
                                    <tr>
                                        <td width="80"><b><?php echo translate('total_blog');?></b></td>
                                        <td><b>:</b></td>
                                        <td align="right">
                                            <?php echo $this->Crud_model->blog_counter('blog',$blogger_id,'count'); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="80"><b><?php echo translate('total_visitors');?></b></td>
                                        <td><b>:</b></td>
                                        <td align="right">
                                            <?php echo $this->Crud_model->blog_counter('blog',$blogger_id,'views'); ?>
                                        </td>
                                    </tr>
                                </table>
                                <div class="row pad-t-5">
                                    <div class="col-md-12">
                                        <button class="button-custom-btn-1 btn-block custom-btn-1 custom-btn-1-round-s letter-spacing-none custom-btn-1-text-thick custom-btn-1-text-upper custom-btn-1-size-s" data-text="<?=translate('view_blogs')?>" onclick="filter_blog_profile('0')" style="min-width: 100% !important">     
                                            <span id="archive_date_search_btn"><?=translate('view_blogs')?></span>
                                        </button> 
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-4">
                <div class="widget thin-border shop-categories" style="margin-top: 13px">
                    <h4 class="widget-title"><?php echo translate('images'); ?></h4>
                    <div class="widget-content">
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="" style="font-size: 12px; width: 100%">
                                    <tr>
                                        <td width="80"><b><?php echo translate('total_images');?></b></td>
                                        <td><b>:</b></td>
                                        <td align="right">
                                            <?php echo $this->Crud_model->blog_counter('blog_photo',$blogger_id,'count'); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="80"><b><?php echo translate('total_visitors');?></b></td>
                                        <td><b>:</b></td>
                                        <td align="right">
                                            <?php echo $this->Crud_model->blog_counter('blog_photo',$blogger_id,'views'); ?>
                                        </td>
                                    </tr>
                                </table>
                                <div class="row pad-t-5">
                                    <div class="col-md-12">
                                        <button class="button-custom-btn-1 btn-block custom-btn-1 custom-btn-1-round-s letter-spacing-none custom-btn-1-text-thick custom-btn-1-text-upper custom-btn-1-size-s" data-text="<?=translate('view_images')?>" onclick="filter_blog_photo('0')" style="min-width: 100% !important">     
                                            <span id="archive_date_search_btn"><?=translate('view_images')?></span>
                                        </button> 
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-4">
                <div class="widget thin-border shop-categories" style="margin-top: 13px">
                    <h4 class="widget-title"><?php echo translate('videos'); ?></h4>
                    <div class="widget-content">
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="" style="font-size: 12px; width: 100%">
                                    <tr>
                                        <td width="80"><b><?php echo translate('total_videos');?></b></td>
                                        <td><b>:</b></td>
                                        <td align="right">
                                            <?php echo $this->Crud_model->blog_counter('blog_video',$blogger_id,'count'); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="80"><b><?php echo translate('total_visitors');?></b></td>
                                        <td><b>:</b></td>
                                        <td align="right">
                                            <?php echo $this->Crud_model->blog_counter('blog_video',$blogger_id,'views'); ?>
                                        </td>
                                    </tr>
                                </table>
                                <div class="row pad-t-5">
                                    <div class="col-md-12">
                                        <button class="button-custom-btn-1 btn-block custom-btn-1 custom-btn-1-round-s letter-spacing-none custom-btn-1-text-thick custom-btn-1-text-upper custom-btn-1-size-s" data-text="<?=translate('view_videos')?>" onclick="filter_blog_video('0')" style="min-width: 100% !important">     
                                            <span id="archive_date_search_btn"><?=translate('view_videos')?></span>
                                        </button> 
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php //print_r($blogs);?>
    <div class="col-md-12" style="margin-top: 13px; padding: 0px 10px">
        <h2 class="block-title mar-t-10">
            <span id='profile_blog_title'><?php echo translate('posted_blogs'); ?></span>
        </h2>
        <div id="result">
            
        </div>
        <?php
            echo form_open(base_url() . 'home/ajax_blogger_profile_list/'.$blogger_id.'/', array(
                'class' => 'form-horizontal',
                'method' => 'post',
                'id' => 'filter_form'
            ));
        ?>
        </form>
        <?php
            echo form_open(base_url() . 'home/ajax_blogger_photo_list/'.$blogger_id.'/', array(
                'class' => 'form-horizontal',
                'method' => 'post',
                'id' => 'filter_form_photo'
            ));
        ?>
        </form>
        <?php
            echo form_open(base_url() . 'home/ajax_blogger_video_list/'.$blogger_id.'/', array(
                'class' => 'form-horizontal',
                'method' => 'post',
                'id' => 'filter_form_video'
            ));
        ?>
        </form>
    </div>
</div>
<script>
$(document).ready(function() {
    var blog = $("#blog-post");
    blog.owlCarousel({
        slideSpeed: 300,
        paginationSpeed: 400,
        singleItem: true,
        mouseDrag: true,
        touchDrag: false,
        margin: 10,
        dots: true,
        nav: false,
        items: 1,
        navText : ["<i class='fa fa-arrow-left'></i>","<i class='fa fa-arrow-right'></i>"]
    });

    filter_blog_profile('0');
});
</script>
<script>        
    function filter_blog_profile(page){
        var form = $('#filter_form');
        var alert = $('#result');
        var formdata = false;
        if (window.FormData){
            formdata = new FormData(form[0]);
        }
        $.ajax({
            url: form.attr('action')+page+'/', // form action url
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

    function filter_blog_photo(page){
        var form = $('#filter_form_photo');
        var alert = $('#result');
        var formdata = false;
        if (window.FormData){
            formdata = new FormData(form[0]);
        }
        $.ajax({
            url: form.attr('action')+page+'/', // form action url
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

    function filter_blog_video(page){
        var form = $('#filter_form_video');
        var alert = $('#result');
        var formdata = false;
        if (window.FormData){
            formdata = new FormData(form[0]);
        }
        $.ajax({
            url: form.attr('action')+page+'/', // form action url
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
<script type="text/javascript">
    function abnv2(thiss) {
        $('#savepic2').hide();
        $('#inppic2').hide();
        $('#' + thiss).show();
    }
    function change_state2(va) {
        $('#state2').val(va);
    }

    function readURL2(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah2').css('backgroundImage', "url('" + e.target.result + "')");
                $('#blah2').css('backgroundSize', "cover");
            }
            reader.readAsDataURL(input.files[0]);
            abnv2('savepic2');
            change_state2('saving');
        }
    }

    $("#imgInp2").change(function () {
        readURL2(this);
    });
</script>