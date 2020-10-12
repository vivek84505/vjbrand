<center>
	<img class="img-thumbnail image-responsive image_delay_now" src="<?php echo img_loading(); ?>" data-src="<?php echo base_url().'uploads/'.$folder.'/'.$name; ?>" alt="<?php echo translate('image'); ?>"/>
</center>
<script>
	$(document).ready(function(){
		$('body').find('.image_delay_now').each(function(){
			var src = $(this).data('src');
			if($(this).is('img')){
				$(this).attr('src',src);			
			} else {
				$(this).css('background-image',"url('"+src+"')");			
			}
		});	
	});
</script>