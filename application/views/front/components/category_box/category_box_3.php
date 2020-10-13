<?php
$this->db->limit(5);
$this->db->order_by('news_id','desc');
$this->db->where('news_category_id',$category);
$this->db->where('status','published');
$news	= $this->db->get('news')->result_array();
?>
<section class="page-section with-sidebar pad-tb-5">
    <div class="container">
        <h2 class="block-title">
            <span>
                <?php echo $this->Crud_model->get_type_name_by_id('news_category',$category); ?>
            </span>
        </h2>
        <div class="row mar-lr--5">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="row">
                    <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                    	<div class="row">
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <?php
                                            if(isset($news[1])){
                                                echo $this->Html_model->news_box('rect_sm','1',$news[1]); 
                                            }
                                        ?>
                                    </div>
                                    <div class="col-md-12 mar-t-5">
                                        <?php
                                            if(isset($news[2])){
                                                echo $this->Html_model->news_box('rect_sm','1',$news[2]); 
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <?php
                                            if(isset($news[3])){
                                                echo $this->Html_model->news_box('rect_sm','1',$news[3]); 
                                            }
                                        ?>
                                    </div>
                                    <div class="col-md-12 mar-t-5">
                                        <?php
                                            if(isset($news[4])){
                                                echo $this->Html_model->news_box('rect_sm','1',$news[4]); 
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                        <?php
                            if(isset($news[0])){
                                echo $this->Html_model->news_box('sqr_md','1',$news[0]); 
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /PAGE WITH SIDEBAR -->