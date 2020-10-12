<?php
	$this->db->limit(8);
	$this->db->order_by('video_id','desc');
	if($page_name == 'video_description'){
		$this->db->where('video_id !=',$video_id);
	}
	$this->db->where('status','published');
	$recent_video	= $this->db->get('video')->result_array();
?>
<section class="page-section pad-t-5">
    <a href="<?php echo base_url(); ?>home/video_gallery" class="button-custom-btn-1 btn-browse-more custom-btn-1 custom-btn-1-round-s custom-btn-1-text-thick custom-btn-1-text-upper custom-btn-1-size-s" data-text="<?php echo translate('see_more'); ?>">		
        <span><?php echo translate('see_more'); ?></span>
    </a>
    <h2 class="block-title"><span><?php echo translate('latest_videos'); ?></span></h2>
    <div class="row mar-lr--5">
    	<?php
        	foreach($recent_video as $row){
		?>
        <div class="col-md-3 pad-lr-5 mar-t-5">
        	<?php
            	echo $this->Html_model->video_box('1',$row);
			?>
        </div>
        <?php
			}
		?>
    </div>
</section>
<script>
$(document).ready(function(){
	setTimeout(function(){
		set_video_frame();
		set_video_box();
	},500);
});
function set_video_box(){
	var max_height = 0;
	$('.video_box_1').each(function(){
        var current_height= parseInt($(this).css('height'));
		if(current_height >= max_height){
			max_height = current_height;
		}
    });
	$('.video_box_1').css('height',max_height);
}
function set_video_frame(){
	$('iframe').each(function(){
        var box_width= parseInt($(this).closest('.media').css('width'));
		$(this).css('width',box_width);
    });
	$('video').each(function(){
        var box_width= parseInt($(this).closest('.media').css('width'));
		$(this).css('width',box_width);
    });
}
</script>