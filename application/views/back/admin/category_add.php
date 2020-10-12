<div>
    <?php
    echo form_open(base_url() . 'admin/category/do_add/', array(
        'class' => 'form-horizontal',
        'method' => 'post',
        'id' => 'category_add',
        'enctype' => 'multipart/form-data'
    ));
    ?>
    <div class="panel-body">
        <div class="form-group">
            <label class="col-sm-4 control-label" for="demo-hor-1">
                <?php echo translate('news_category_name'); ?>
            </label>
            <div class="col-sm-6">
                <input type="text" name="name" id="demo-hor-1" 
                       class="form-control required" placeholder="<?php echo translate('news_category_name'); ?>" >
            </div>
        </div>
    </div>
</form>
</div>

<script>
    $(document).ready(function () {
        $("form").submit(function (e) {
            return false;
        });
    });
</script>