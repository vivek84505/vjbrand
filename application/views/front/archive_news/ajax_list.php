<!-- Blog posts  -->
<div class="products list">
    <!-- / -->
    <?php
        foreach($news as $rows){
         	echo $this->Html_model->news_box('archive','1',$rows); 
    ?>
	<hr class="list_gap">
    <?php 
		} 
	?>
</div>
<!-- /Products list -->

<!-- /Blog posts -->

<!-- Pagination -->
<div class="pagination-wrapper">
    <?php echo $this->ajax_pagination->create_links();  ?>
</div>
<!-- /Pagination -->

<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
    load_iamges();
});
</script>