<!-- photo list  -->
<div class="row mar-lr--5">
    <?php
		foreach($bloggers as $row){
	?>
	<div class="col-md-6 pad-lr-5 mar-t-5">
		<?php
			echo $this->Html_model->blogger_box('1',$row);
		?>
	</div>
	<?php
		}
	?>
</div>
<!-- /photo list -->

<!-- Pagination -->
<div class="pagination-wrapper">
    <?php echo $this->ajax_pagination->create_links();  ?>
</div>
<!-- /Pagination -->
<script>
    $(document).ready(function(){
        load_iamges();
    });
</script>