<?php 
	$i = 0;
	foreach ($query as $row1) {
		$i++;
?>         
	<tr>
		<td class="description">
			<?php echo $row1['subject'];?>
			<?php
				$num = $this->Crud_model->ticket_unread_messages($row1['ticket_id'],'user');
				if($num > 0){
			?>
				<span class="btn btn-info btn-xs" style="margin-left:10px">
					<?php 
						echo translate('new_message').' '.'('.' ';
						echo $num .' '.')'; 
					?>
				</span>
			<?php }?>
		</td>
		<td class="add">
            <span data-id="<?php echo $row1['ticket_id']?>" class="button-custom-btn-1 message_view custom-btn-1 custom-btn-1-round-s custom-btn-1-text-thick custom-btn-1-text-upper custom-btn-1-size-s" data-text="<?php echo translate('view_message');?>">		
                <span><i class="fa fa-envelope"></i></span>
            </span>
		</td>
	</tr>
										 
<?php 
	}
?>


<tr class="text-center" style="display:none;" >
	<td id="pagenation_set_links" ><?php echo $this->ajax_pagination->create_links(); ?></td>
</tr>
<!--/end pagination-->


<script>
	$(document).ready(function(){ 
		$('.pagination_box').html($('#pagenation_set_links').html());
	});
</script>