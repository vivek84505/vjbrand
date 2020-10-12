<?php 
    $i = 0;
    foreach ($query as $row1) {
        $i++;
?>
    <tr>
        <td><?php echo $i; ?></td>
        <td class="image">
            <a class="media-link" href="<?php echo $this->Crud_model->news_link($row1['news_id']); ?>">
                <i class="fa fa-link"></i>
                <img width="100" class="image_delay" src="<?php echo img_loading(); ?>" data-src="<?php echo $this->Crud_model->file_view('news',$row1['news_id'],'','','thumb','src','multi','one');?>" alt=""/>
            </a>
        </td>
        <td class="description">
            <a href="<?php echo $this->Crud_model->news_link($row1['news_id']); ?>">
            	<?php echo word_limiter($row1['title'],10); ?>
            </a>
        </td>
        <td class="add">
        	<a href="<?php echo base_url(); ?>home/news/0/0/<?php echo date("Y-m-d",$row1['date']);?>/<?php echo date("Y-m-d",$row1['date']);?>">
        		<?php echo date("F j, Y",$row1['date']);?>
            </a>
        </td>
        <td class="total">
            <span class="remove_from_wish" style="cursor:pointer;" data-id='<?php echo $row1['news_id']; ?>' >
                <i class="fa fa-trash" style="color: #f00;"></i>
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
		$('#readlater_count').html('( <?php echo $this->Crud_model->readlater_num();?> )');
        $('.pagination_box').html($('#pagenation_set_links').html());
        load_iamges();
    });
	
	$('.remove_from_wish').on('click',function(){
		var id = $(this).data('id');
		$.ajax({
			url: base_url+'home/readlater/remove/'+id
		});
		readlater_listed('0');
	});
</script>