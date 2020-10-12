<?php
	$this->db->limit(8);
	$this->db->order_by('photo_id','desc');
	if($page_name == 'photo_description'){
		$this->db->where('photo_id !=',$photo_id);
	}
	$this->db->where('status','published');
	$recent_photo			= $this->db->get('photo')->result_array();
?>
<section class="page-section pad-t-5">
    <a href="<?php echo base_url(); ?>home/photo_gallery" class="button-custom-btn-1 btn-browse-more custom-btn-1 custom-btn-1-round-s custom-btn-1-text-thick custom-btn-1-text-upper custom-btn-1-size-s" data-text="<?php echo translate('see_more'); ?>">		
        <span><?php echo translate('see_more'); ?></span>
    </a>
    <h2 class="block-title"><span><?php echo translate('latest_photos'); ?></span></h2>
    <div class="row mar-lr--5">
    	<?php
        	foreach($recent_photo as $row){
		?>
        <div class="col-md-3 pad-lr-5 mar-t-5">
        	<?php
            	echo $this->Html_model->photo_box('1',$row);
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
		set_bottom_photos();
	},1000);
});
function set_bottom_photos(){
	var max_height = 0;
	$('.photo_box_1').each(function(){
        var current_height= parseInt($(this).css('height'));
		if(current_height >= max_height){
			max_height = current_height;
		}
    });
	$('.photo_box_1').css('height',max_height);	
}
</script>