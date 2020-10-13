<?php
$this->db->limit($special_category_data['count']);
$this->db->order_by('news_id','desc');
$this->db->where('news_category_id',$special_category_data['cat1']);
$this->db->where('status','published');
$cat1	= $this->db->get('news')->result_array();

$this->db->limit($special_category_data['count']);
$this->db->order_by('news_id','desc');
$this->db->where('news_category_id',$special_category_data['cat2']);
$this->db->where('status','published');
$cat2	= $this->db->get('news')->result_array();
?>
<section class="page-section with-sidebar pad-tb-5">
    <div class="container">
        <div class="row mar-lr--5">
            <!-- SIDEBAR -->
            <aside class="col-md-3 hidden-sm hidden-xs sidebar <?php if($special_category_data['sidebar'] == 'right'){ echo 'pull-right'; } ?>" id="sidebar">
                <div class="box_shadow">
                	<?php
						$widgets = $special_category_data['widgets'];
						foreach($widgets as $row){
							echo $this->Html_model->widget($row);
						}
					?>     
                </div>
                <!-- /widget shop categories -->
            </aside>
            <!-- /SIDEBAR -->
            <!-- CONTENT -->
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 content" id="content">
                <div class="row">
                	<div class="col-md-6 col-sm-6 col-xs-12">
                    	<h2 class="block-title">
                        	<span>
								<?php echo $this->Crud_model->get_type_name_by_id('news_category',$special_category_data['cat1']); ?>
                            </span>
                        </h2>
                        <div class="row">
                        <?php
							$i=0;
                        	foreach($cat1 as $row1){
								$i++;
								if($i==1){
						?>
                            <div class="col-md-12">
                                <?php
                                 	echo $this->Html_model->news_box('sqr_md','1',$row1);
                                ?>
                            </div>
                            <?php
								}else{
							?>
                            <div class="col-md-12 mar-t-5">
                                <?php
                                    echo $this->Html_model->news_box('rect_sm','1',$row1);
                                ?>
                            </div>
                            <?php
								}
							}
							?>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                    	<h2 class="block-title">
                        	<span>
								<?php echo $this->Crud_model->get_type_name_by_id('news_category',$special_category_data['cat2']); ?>
                            </span>
                        </h2>
                        <div class="row">
                        <?php
							$j=0;
                        	foreach($cat2 as $row2){
								$j++;
								if($j==1){
						?>
                            <div class="col-md-12">
                                <?php
                                 	echo $this->Html_model->news_box('sqr_md','1',$row2);
                                ?>
                            </div>
                            <?php
								}else{
							?>
                            <div class="col-md-12 mar-t-5">
                                <?php
                                    echo $this->Html_model->news_box('rect_sm','1',$row2);
                                ?>
                            </div>
                            <?php
								}
							}
							?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /CONTENT -->
        </div>
    </div>
</section>
<!-- /PAGE WITH SIDEBAR -->
<style>
.block-title{
	margin-bottom:10px;
}
</style>