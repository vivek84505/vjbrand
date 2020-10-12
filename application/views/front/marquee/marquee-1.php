<?php
	$scrolling_news = json_decode($this->Crud_model->get_settings_value('ui_settings','scrolling_news','value'),true);
?>
<?php
	if($scrolling_news['status']=='ok'){
?>
<section class="page-section marquee" id="marquee_section">
    <div class="container">
    	<div class="row">
        	<div class="col-md-12 col-sm-12 col-xs-12 custom-marquee">
        		<div class="marquee1">
                    <div class="heading">
                        <span class="hidden-xs hidden-sm"><?php echo translate($scrolling_news['title']); ?></span>
                        <span class="hidden-lg hidden-md">
                        	<i class="fa fa-bullhorn"></i>
                        </span>
                    </div>
                    <div class="marquee_body">
                        <marquee behavior="scroll" direction="left" id="marquee1" onmouseover="this.stop();" onmouseout="check_switch_onmouseout();" style="display:inline-block;overflow: hidden;text-align: initial;white-space: nowrap;">
                            <?php
                                $this->db->limit($scrolling_news['count']);
                                $this->db->order_by('serial_breaking','desc');
                                $this->db->order_by('news_id','desc');
								$this->db->where('breaking_news','ok');
                                $this->db->where('status','published');
                                $top_news = $this->db->get('news')->result_array();
                                foreach($top_news as $row){
                            ?>
                            <div class="marquee_items">
                                <a href="<?php echo $this->Crud_model->news_link($row['news_id']);?>" data-title="<?php echo $row['title'];?>">
                                    <i class="fa fa-angle-double-right"></i>
                                    <?php echo $row['title'];?>
                                </a>
                            </div>
                            <?php }?>
                            
                        </marquee>
                    </div>
                    <div class="buttons">
                        <span id="btn-switch" class="hidden-xs">
                            <i class="fa fa-pause"></i>
                        </span>
                        <span id="btn-close">
                            <i class="fa fa-times"></i>
                        </span>
                    </div>
                </div>
        	</div>
        </div>
    </div>
</section>
<script type="text/javascript">
$('#btn-switch').on('click',function(e){
	if($(this).find('.fa').hasClass('fa-pause')){
		$(this).find('.fa').removeClass('fa-pause');
		$(this).find('.fa').addClass('fa-play');
		document.getElementById('marquee1').stop();
	}else if($(this).find('.fa').hasClass('fa-play')){
		$(this).find('.fa').removeClass('fa-play');
		$(this).find('.fa').addClass('fa-pause');
		document.getElementById('marquee1').start();
	}
});

function check_switch_onmouseout(){
	if($('#btn-switch').find('.fa').hasClass('fa-play')){
		document.getElementById('marquee1').stop();
	}else if($('#btn-switch').find('.fa').hasClass('fa-pause')){
		document.getElementById('marquee1').start();
	}
	$('.popover').hide('slow');
	$('.popover').popover("destroy");
}

$('#btn-close').on('click',function(e){
	$('#marquee_section').hide('slow');
});
</script>
<?php
	}
?>