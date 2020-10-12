<aside class="col-md-3 sidebar pull-left close_now pad-tb-5" id="sidebar">
    <div class="box_shadow">
        <div class="widget shop-categories thin-border">
            <h4 class="widget-title">
                <?php echo translate('categories');?>
            </h4>
            <div class="widget-content">
                <ul>
                    <li>
                        <span data-cat="0" class="cat_search">
                            <a href="<?php echo base_url();?>home/blog_category/0/0"><?php echo translate('all_blogs');?></a>
                        </span>
                    </li>
                <?php
                    $cat = $this->db->get('blog_category')->result_array();
                    foreach($cat as $row){
                        $sub_cat = $this->db->get_where('blog_sub_category',array('parent_category_id'=> $row['blog_category_id']))->result_array();
                        if(count($sub_cat) == 0){
                ?>
                    <li>
                        <a href="<?php echo base_url();?>home/blog_category/<?php echo $row['blog_category_id'];?>/0" onClick="get_blog_list('<?php echo $row['blog_category_id'];?>','0')" >
                            <?php echo translate($row['name']);?>
                        </a>
                    </li>
                <?php
                        }else{
                ?>
                    <li>
                        <span class="arrow"><i class="fa fa-angle-down"></i></span>
                        <a href="<?php echo base_url();?>home/blog_category/<?php echo $row['blog_category_id'];?>/0" onClick="get_blog_list('<?php echo $row['blog_category_id'];?>','0')" >
                            <?php echo translate($row['name']);?>
                        </a>
                        <ul class="children">
                            <?php 
                                foreach($sub_cat as $rows){
                                    $total_sub_cat_blog = $this->db->get_where('blog',array('blog_sub_category_id' => $rows['blog_sub_category_id'], 'status' => 'published', 'hide_status' => 'false'))->result_array();
                                    $x = sizeof($total_sub_cat_blog);
                            ?>
                            <li>
                                <a href="<?php echo base_url();?>home/blog_category/<?php echo $row['blog_category_id'];?>/<?php echo $rows['blog_sub_category_id'];?>" onClick="get_blog_list('<?php echo $row['blog_category_id']; ?>','<?php echo $rows['blog_sub_category_id'];?>');" > 
                                    <?php echo translate($rows['name']);?>
                                    <span class="count"><?php echo $x; ?></span>
                                </a>
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
        <div class="widget thin-border shop-categories">
            <h4 class="widget-title">
            Follow Us <span class="btn btn-theme-transparent pull-left hidden-lg hidden-md" onclick="close_sidebar();" style="border-radius:50%; position: absolute; top:40px; right:10px;">
            <i class="fa fa-times"></i>
            </span>
            </h4>
            <div class="widget-content">
                <a href="<?php echo $this->Crud_model->get_type_name_by_id('blogs_social_links', '1', 'value'); ?>" target="_blank" class="btn btn-block btn-primary btn-icon-left"><i class="fa fa-facebook"></i>Follow in Facebook</a>
                <a href="<?php echo $this->Crud_model->get_type_name_by_id('blogs_social_links', '3', 'value'); ?>" target="_blank" class="btn btn-block btn-info btn-icon-left"><i class="fa fa-twitter"></i>Follow in Twitter</a>
                <a href="<?php echo $this->Crud_model->get_type_name_by_id('blogs_social_links', '2', 'value'); ?>" target="_blank" class="btn btn-block btn-danger btn-icon-left"><i class="fa fa-google-plus"></i>Follow in Google+</a>
            </div>
        </div>
        <script>
            function vote_poll(){
                var poll_id = $("#poll_id").val();
                var index=$('input[name="answer"]:checked').val();
                $.ajax({
                    url: 'http://localhost/active_newspaper/home/poll/vote/'+poll_id+'/'+index
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
                $('#poll_res').load('http://localhost/active_newspaper/home/poll/res/'+poll_id);
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
