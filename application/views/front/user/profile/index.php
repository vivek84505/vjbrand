<!-- PAGE WITH SIDEBAR -->
<script src="<?php echo base_url(); ?>/template/back/plugins/bootbox/bootbox.min.js"></script>
<?php
    if($part == 'ad'){
?><script src="https://checkout.stripe.com/checkout.js"></script>

<?php
    }
?>
<section class="page-section with-sidebar pad-t-15">
    <div class="container">
        <div class="row">
            <!-- SIDEBAR -->
            <aside class="col-md-3 sidebar" id="sidebar">
                <?php
                    include 'navigation.php';
                ?>
            </aside>
            <!-- /SIDEBAR -->

            <!-- CONTENT -->

            <div class="col-md-9 content" id="content">
                <div id="profile-content" class="box_shadow">

                </div>
            </div>

            <!-- /CONTENT -->

        </div>
    </div>
</section>
<!-- /PAGE WITH SIDEBAR -->

<!-- for switchery -->
<link href="<?php echo base_url(); ?>template/back/plugins/switchery/switchery.min.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>template/back/plugins/switchery/switchery.js"></script>

<script>
    var top = Number(500);
    var loading_set = '<div style="text-align:center;width:100%;height:' + (top * 2) + 'px; position:relative;top:' + top + 'px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>';
    function get_profile() {
        $("#profile-content").html(loading_set);
        $('.widget-content li').removeClass('active');
        $('#gp').addClass('active');
        $("#profile-content").load("<?php echo base_url() ?>home/profile/profile");
    }
    function get_read_later() {
        $("#profile-content").html(loading_set);
        $('.widget-content li').removeClass('active');
        $('#rl').addClass('active');
        $("#profile-content").load("<?php echo base_url() ?>home/profile/read_later");
    }
    function pay_for_post() {
        $("#profile-content").html(loading_set);
        $('.widget-content li').removeClass('active');
        $('#pfp').addClass('active');
        $("#profile-content").load("<?php echo base_url() ?>home/profile/pay_for_post");
    }
    function get_packages() {
        $("#profile-content").html(loading_set);
        $('.widget-content li').removeClass('active');
        $('#pp').addClass('active');
        $("#profile-content").load("<?php echo base_url() ?>home/profile/premium_post_packages");
    }
    function get_packages_list() {
        $("#profile-content").html(loading_set);
        $('.widget-content li').removeClass('active');
        $('#ppl').addClass('active');
        $("#profile-content").load("<?php echo base_url() ?>home/profile/packages_list");
    }
    /*function get_support() {
        $("#profile-content").html(loading_set);
        $('.widget-content li').removeClass('active');
        $('#st').addClass('active');
        $("#profile-content").load("<?php echo base_url() ?>home/profile/support_ticket");
    }*/
    function update_profile() {
        $("#profile-content").html(loading_set);
        $('.widget-content li').removeClass('active');
        $('#up').addClass('active');
        $("#profile-content").load("<?php echo base_url() ?>home/profile/update_info/");
    }
    function apply(){
        window.location.replace("<?php echo base_url();?>home/marketing/");
    }
    function get_adList(){
        $("#profile-content").html(loading_set);
        $('.widget-content li').removeClass('active');
        $('#ad_list').addClass('active');
        $("#profile-content").load("<?php echo base_url() ?>home/profile/ad_list");
    }
    function get_blog_profile() {
        window.location.replace("<?php echo base_url();?>home/blog_profile");
    }
    function get_blog_list() {
        $("#profile-content").html(loading_set);
        $('.widget-content li').removeClass('active');
        $('#blog_list').addClass('active');
        $("#profile-content").load("<?php echo base_url() ?>home/profile/blog_list");
    }
    function edit_blog(id) {
        $("#profile-content").html(loading_set);
        $('#edit_blog').addClass('active');
        $("#profile-content").load("<?php echo base_url() ?>home/profile/blog_edit/edit/"+id);
    }
    function edit_blog_photo(id) {
        $("#profile-content").html(loading_set);
        $('#edit_blog_photo').addClass('active');
        $("#profile-content").load("<?php echo base_url() ?>home/profile/blog_photo_edit/edit/"+id);
    }
    function edit_blog_video(id) {
        $("#profile-content").html(loading_set);
        $('#edit_blog_video').addClass('active');
        $("#profile-content").load("<?php echo base_url() ?>home/profile/blog_video_edit/edit/"+id);
    }
    function set_switchery() {
        $(".aiz_switchery").each(function () {
            new Switchery($(this).get(0), {color: 'rgb(100, 189, 99)', secondaryColor: '#cc2424', jackSecondaryColor: '#c8ff77'});
            var changeCheckbox = document.querySelector('#status_' + $(this).data('id'));
            changeCheckbox.onchange = function () {
                $.ajax({
                    url: '<?php echo base_url(); ?>home/profile/ad_list/status/'+$(this).data('id')+'/' + changeCheckbox.checked
                });
                if(changeCheckbox.checked == true){
                    notify($(this).data('tm'),'success','bottom','right');
                }else{
                    notify($(this).data('fm'),'danger','bottom','right');
                }
            };
        });
    }
    function set_switchery_blog() {
        $(".aiz_switchery").each(function () {
            new Switchery($(this).get(0), {
                color: 'rgb(100, 189, 99)', secondaryColor: '#cc2424', jackSecondaryColor: '#c8ff77'});
            var changeCheckbox = $(this).get(0);
            var false_msg = $(this).data('fm');
            var true_msg = $(this).data('tm');
            changeCheckbox.onchange = function () {
                $.ajax({url: base_url + 'home/get_blog_edit_tab/'+ $(this).data('set') + '/' + $(this).data('id') + '/' + changeCheckbox.checked,
                    success: function (result) {
                        if(changeCheckbox.checked == true){
                            notify(true_msg,'danger','bottom','right');
                        }else{
                            notify(false_msg,'success','bottom','right');
                        }
                    }
                });
            };
        });
    }
    function set_switchery_blog_photo() {
        $(".aiz_switchery").each(function () {
            new Switchery($(this).get(0), {
                color: 'rgb(100, 189, 99)', secondaryColor: '#cc2424', jackSecondaryColor: '#c8ff77'});
            var changeCheckbox = $(this).get(0);
            var false_msg = $(this).data('fm');
            var true_msg = $(this).data('tm');
            changeCheckbox.onchange = function () {
                $.ajax({url: base_url + 'home/get_blog_edit_tab/'+ $(this).data('set') + '/' + $(this).data('id') + '/' + changeCheckbox.checked,
                    success: function (result) {
                        if(changeCheckbox.checked == true){
                            notify(true_msg,'danger','bottom','right');
                        }else{
                            notify(false_msg,'success','bottom','right');
                        }
                    }
                });
            };
        });
    }
    function set_switchery_blog_video() {
        $(".aiz_switchery").each(function () {
            new Switchery($(this).get(0), {
                color: 'rgb(100, 189, 99)', secondaryColor: '#cc2424', jackSecondaryColor: '#c8ff77'});
            var changeCheckbox = $(this).get(0);
            var false_msg = $(this).data('fm');
            var true_msg = $(this).data('tm');
            changeCheckbox.onchange = function () {
                $.ajax({url: base_url + 'home/get_blog_edit_tab/'+ $(this).data('set') + '/' + $(this).data('id') + '/' + changeCheckbox.checked,
                    success: function (result) {
                        if(changeCheckbox.checked == true){
                            notify(true_msg,'danger','bottom','right');
                        }else{
                            notify(false_msg,'success','bottom','right');
                        }
                    }
                });
            };
        });
    }
    function edit_ad(id){
        $("#profile-content").html(loading_set);
        $('.widget-content li').removeClass('active');
        $('#ad_list').addClass('active');
        $("#profile-content").load("<?php echo base_url() ?>home/profile/ad_list/edit/"+id);
    }
    $(document).ready(function () {
        $("#<?php echo $part; ?>").click();
    });
    $('body').on('click', '.remove_data', function () {
        $(this).addClass('disabled');
        var burl = $(this).data('burl');
        var inside = $(this).data('inside');
        var now = $(this);
        setTimeout(function () {
            bootbox.confirm('Really Want to Delete this?', function (result) {
                if (result) {
                    $.ajax({
                        url: burl,
                        success: function (result) {
                            if (inside == 'edit_blog') {
                                now.closest('.rem_div').remove();
                            } else if(inside == 'blog_list'){
                                get_blog_list();
                            } else if(inside == 'blog_image_list'){
                                get_tab_data('blog_image_edit');
                            } else if(inside == 'blog_video_list'){
                                get_tab_data('blog_video_edit');
                            }
                        }
                    });
                } else {
                    if (inside == 'edit_blog') {
                        now.removeClass('disabled');
                    }
                }
                ;
            });
        }, 500)
    });
</script>
