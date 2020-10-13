<div class="widget shop-categories thin-border">
    <h4 class="widget-title">
        <?php echo translate('categories');?>
    </h4>
    <div class="widget-content">
        <ul>
        <?php
            $cat = $this->db->get('news_category')->result_array();
            foreach($cat as $row){
                $sub_cat = $this->db->get_where('news_sub_category',array('parent_category_id'=> $row['news_category_id']))->result_array();
                if(count($sub_cat) == 0){
        ?>
            <li>
                <a href="<?php echo base_url(); ?>home/news/<?php echo $row['news_category_id']; ?>/0" onClick="get_news_list('<?php echo $row['news_category_id'];?>','0')" >
                    <?php echo translate($row['name']);?>
                </a>
            </li>
        <?php
                }else{
        ?>
            <li>
                <span class="arrow"><i class="fa fa-angle-down"></i></span>
                <a href="<?php echo base_url();?>home/news/<?php echo $row['news_category_id'];?>/0" onClick="get_news_list('<?php echo $row['news_category_id'];?>','0')" >
                    <?php echo translate($row['name']);?>
                </a>
                <ul class="children">
                    <?php
                        foreach($sub_cat as $rows){
                            $total_sub_cat_news = $this->db->get_where('news',array('news_sub_category_id' => $rows['news_sub_category_id']))->result_array();
                            $x = sizeof($total_sub_cat_news);
                    ?>
                    <li>
                        <a href="<?php echo base_url();?>home/news/<?php echo $row['news_category_id'];?>/<?php echo $rows['news_sub_category_id'];?>" onClick="get_news_list('<?php echo $row['news_category_id']; ?>','<?php echo $rows['news_sub_category_id'];?>');" >
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
