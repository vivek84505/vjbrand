<?php
    $this->db->limit(5);
    $this->db->order_by('serial_3','desc');
    $this->db->order_by('news_id','desc');
    $this->db->where('news_speciality_id',3);
    $this->db->where('status','published');
    $top_news	= $this->db->get('news')->result_array();
?>
<section class="page-section pad-tb-5">
    <div class="container">
        <div class="row mar-lr--5">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 <?php if($top_news_data['style']==2){ echo 'pull-right';} ?>">
				<?php
					if(isset($top_news[0])){
						echo $this->Html_model->news_box('sqr_md','2',$top_news[0]); 
					}
				?>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            	<div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
        				<?php
							if(isset($top_news[1])){
								echo $this->Html_model->news_box('sqr_sm','2',$top_news[1]); 
							}
						?>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <?php
							if(isset($top_news[2])){
								echo $this->Html_model->news_box('sqr_sm','2',$top_news[2]); 
							}
						?>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 mar-t-10">
        				<?php
							if(isset($top_news[3])){
								echo $this->Html_model->news_box('sqr_sm','2',$top_news[3]); 
							}
						?>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 mar-t-10">
                        <?php
							if(isset($top_news[4])){
								echo $this->Html_model->news_box('sqr_sm','2',$top_news[4]); 
							}
						?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>