<?php
$this->db->limit(5);
$this->db->order_by('view_count','desc');
$this->db->where('status','published');
$popular_news			= $this->db->get('news')->result_array();

$this->db->limit(5);
$this->db->order_by('news_id','desc');
$this->db->where('status','published');
$recent_news			= $this->db->get('news')->result_array();
?>
<div class="widget widget_box widget-tabs sp_news_tab1 border-topx3 alt">
    <div class="widget-content">
        <nav class="menu tab-menu-1">
            <ul id="tabs" class="menu-list">
                <li class="menu-item">
                	<a class="menu-link" href="#tab-1" data-toggle="tab"><?php echo translate('recent'); ?></a>
                </li>
                <li class="menu-item active">
                	<a class="menu-link" href="#tab-2" data-toggle="tab"><?php echo translate('popular'); ?></a>
                </li>
            </ul>
        </nav>
        <div class="tab-content">
            <!-- tab 1 -->
            <div class="tab-pane fade" id="tab-1">
                <?php
                    foreach($recent_news as $row){
                        echo $this->Html_model->news_box('rect_thumb','1',$row);
                    }
                ?>
            </div>
            <!-- tab 2 -->
            <div class="tab-pane fade in active" id="tab-2">
                <?php
                    foreach($popular_news as $row){
                        echo $this->Html_model->news_box('rect_thumb','1',$row);
                    }
                ?>
            </div>
        </div>
    </div>
</div>