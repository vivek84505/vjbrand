<!-- Blog posts  -->
<div class="products list">
    <!-- / -->
    <?php
        foreach($news as $rows){
    ?>
	<?php
         echo $this->Html_model->news_box('rect_md','1',$rows);
    ?>
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
