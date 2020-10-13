<section class="page-section with-sidebar pad-tb-5">
    <div class="container">
		<?php
			$i=0;
            foreach($cats as $row){
				$i++;
				$this->db->limit(5);
				$this->db->order_by('news_id','desc');
				$this->db->where('news_category_id',$row);
				$this->db->where('status','published');
				$news	= $this->db->get('news')->result_array();
        ?>
        <?php
        	if($i % 3 == 1){
		?>
        <div class="row mar-lr--5">
        <?php
			}
		?>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <h2 class="block-title">
                    <span>
                        <?php echo $this->Crud_model->get_type_name_by_id('news_category',$row); ?>
                    </span>
                </h2>
                <div class="row">
                    <div class="col-md-12">
                        <?php
                            if(isset($news[0])){
                                echo $this->Html_model->news_box('sqr_md','1',$news[0]); 
                            }
                        ?>
                    </div>
                    <div class="col-md-12 mar-t-5">
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
                    <div class="col-md-12 mar-t-5">
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
        <?php
        	if($i % 3 == 0){
		?>
        </div>
        <?php
			}
		?>
        <?php
			}
		?>
        <?php
        	if($i % 3 !== 0){
				echo '</div>';
			}
		?>
    </div>
</section>
<!-- /PAGE WITH SIDEBAR -->