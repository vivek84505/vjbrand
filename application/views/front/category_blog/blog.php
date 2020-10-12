<div class="products list">
    <div class="" style="margin-top: 10px">
        <?php
            $i=0; 
            foreach ($blogs as $blog): ?>
            <?php
                $i++;
                if($i%2==1){
                ?>
                    <div class="row mar-lr--5" style="margin-bottom: 10px">
                <?php
                }
                ?>
                    <div class="col-md-6">
                        <?php
                            echo $this->Html_model->blog_box('rect_sm', '1', $blog);
                        ?>
                    </div>
                <?php 
                    if($i%2==0){
                    ?>
                        </div>
                    <?php
                    } 
                ?>
        <?php endforeach ?>
    </div>
</div>
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