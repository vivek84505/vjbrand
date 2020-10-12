<div class="widget shop-categories thin-border">
    <h4 class="widget-title">
        <?php echo translate('categories');?>
    </h4>
    <div class="widget-content">
        <ul>
            <li class="<?php if($blog_category=='0' && $blog_sub_category =='0'){?>active<?php }?>">
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
                    <li class="<?php if($blog_category==$row['blog_category_id']){?>active<?php }?>">
                        <a href="<?php echo base_url();?>home/blog_category/<?php echo $row['blog_category_id'];?>/0" onClick="get_blog_list('<?php echo $row['blog_category_id'];?>','0')" >
                            <?php echo translate($row['name']);?>
                        </a>
                    </li>
                <?php
                }else{
                    ?>
                    <li class="<?php if($blog_category==$row['blog_category_id']){?>active<?php }?>">
                        <span class="arrow"><i class="fa fa-angle-down"></i></span>
                        <span class="cat_search <?php if($blog_category==$row['blog_category_id']){?>active<?php }?>">
                            <a href="<?php echo base_url();?>home/blog_category/<?php echo $row['blog_category_id'];?>/0" onClick="get_blog_list('<?php echo $row['blog_category_id'];?>','0')" >
                            <?php echo translate($row['name']);?>
                            </a>
                        </span>
                        <ul class="children <?php if($blog_category==$row['blog_category_id']){?>active<?php }?>">
                            <?php 
                                foreach($sub_cat as $rows){
                                    $total_sub_cat_blog = $this->db->get_where('blog',array('blog_sub_category_id' => $rows['blog_sub_category_id'], 'status' => 'published', 'hide_status' => 'false'))->result_array();
                                    $x = sizeof($total_sub_cat_blog);
                            ?>
                            <li class="<?php if($blog_sub_category==$rows['blog_sub_category_id']){?>active<?php }?>">
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
                <?php
                }
            }?>
        </ul>
    </div>
</div>