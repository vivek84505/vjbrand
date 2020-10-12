<aside class="col-md-3 sidebar pull-left close_now pad-tb-5" id="sidebar">
    <div class="box_shadow">
        <div class="widget shop-categories thin-border">
            <h4 class="widget-title"><?php echo translate('categories')?></h4>
            <div class="widget-content">
                <ul>
                    <li>
                        <span data-cat="0" class="cat_search">
                            <?php echo translate('all_blogs');?>
                        </span>
                    </li>
                <?php
                    $cat = $this->db->get('blog_category')->result_array();
                    foreach($cat as $row){
                        $sub_cat = $this->db->get_where('blog_sub_category',array('parent_category_id'=> $row['blog_category_id']))->result_array();
                        if(count($sub_cat) == 0){
                ?>
                    <li>
                        <span data-cat="<?php echo $row['blog_category_id']; ?>" class="cat_search">
                            <?php echo $row['name'];?>
                        </span>
                    </li>
                <?php
                        }else{
                ?>
                    <li class="parent">
                        <span class="arrow"><i class="fa fa-angle-down"></i></span>
                        <span data-cat="<?php echo $row['blog_category_id']; ?>" class="cat_search">
                            <?php echo $row['name'];?>
                        </span>
                        <ul class="children">
                            <?php 
                                foreach($sub_cat as $rows){
                                    $total_sub_cat_blog = $this->db->get_where('blog',array('blog_sub_category_id' => $rows['blog_sub_category_id']))->result_array();
                                    $x = sizeof($total_sub_cat_blog);
                            ?>
                            <li>
                                <span data-sub="<?php echo $rows['blog_sub_category_id']; ?>" class="subcat_search"> 
                                    <?php echo $rows['name'];?>
                                    <span class="count"><?php echo $x; ?></span>
                                </span>
                            </li>
                            <?php 
                                }
                            ?>
                        </ul>
                    </li>
                <?php }}?>
                </ul>
            </div>
        </div>
        <div class="widget_box">
            <div style="width: 100%; height: 250px; background-color: #247BE5 !important">
                <div class="text-center" style="color: white; font-size: 18px; padding-top: 45%">
                    Google Adsense
                </div>
            </div>
        </div>
        <div class="widget thin-border shop-categories">
            <h4 class="widget-title">
            Follow Us <span class="btn btn-theme-transparent pull-left hidden-lg hidden-md" onclick="close_sidebar();" style="border-radius:50%; position: absolute; top:40px; right:10px;">
            <i class="fa fa-times"></i>
            </span>
            </h4>
            <div class="widget-content">
                <button class="btn btn-block btn-primary btn-icon-left"><i class="fa fa-facebook"></i>Follow in Facebook</button>
                <button class="btn btn-block btn-info btn-icon-left"><i class="fa fa-twitter"></i>Follow in Twitter</button>
                <button class="btn btn-block btn-danger btn-icon-left"><i class="fa fa-google-plus"></i>Follow in Google+</button>
            </div>
        </div>
        <script>
            function vote_poll(){
                var poll_id = $("#poll_id").val();
                var index=$('input[name="answer"]:checked').val();
                $.ajax({
                    url: 'http://localhost/active_blogpaper/home/poll/vote/'+poll_id+'/'+index
                });
                if(typeof(index) !== "undefined"){
                    if (typeof(Storage) !== "undefined") {
                        var poll_list=localStorage.getItem("poll_storage");
                        if(poll_list == null){
                        var set=['0'];
                            localStorage.setItem("poll_storage",JSON.stringify(set));
                            poll_list=localStorage.getItem("poll_storage");
                        }
                        var poll= JSON.parse(poll_list);
                        if(jQuery.inArray(poll_id, poll) == -1)
                        {
                            poll.push(poll_id);
                        }
                        localStorage.setItem("poll_storage",JSON.stringify(poll));
                    }
                    setTimeout(function() {
                        result_show();
                        setTimeout(function() {
                            $('#back_to_option').hide();
                        },300);
                    },500);
                }
            }
            function result_show(){
                $('#poll_vote').hide();
                $('#poll_res').show();
                var poll_id = $("#poll_id").val();
                $('#poll_res').load('http://localhost/active_blogpaper/home/poll/res/'+poll_id);
            }
            function option_show(){
                $('#poll_res').hide();
                $('#poll_vote').show();
            }
            function display(){
                var poll_list=localStorage.getItem("poll_storage");
                if(poll_list == null){
                    var set=['0'];
                    localStorage.setItem("poll_storage",JSON.stringify(set));
                    poll_list=localStorage.getItem("poll_storage");
                }
                var poll_id = $("#poll_id").val();
                var polls= JSON.parse(poll_list);
                if(jQuery.inArray(poll_id, polls) !== -1){
                    var user_ext= "true";
                }
                else{
                    var user_ext= "false";
                }
                if(user_ext=="true"){
                    $('#poll_vote').hide();
                    result_show();
                    setTimeout(function() {
                        $('#back_to_option').hide();
                    },1000);
                }
                else if(user_ext=="false"){
                    $('#poll_res').hide();
                    $('#poll_vote').show();
                }
            }
            $(document).ready(function() {
                display();
            });
        </script>
    </div>
<!-- /widget shop categories -->
</aside>
