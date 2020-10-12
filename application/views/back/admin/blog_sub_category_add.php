<div>
    <?php
    echo form_open(base_url() . 'admin/blog_sub_category/do_add', array(
        'class' => 'form-horizontal',
        'method' => 'post',
        'id' => 'blog_sub_category_add',
        'enctype' => 'multipart/form-data'
    ));
    ?>
    <div class="panel-body">
        <div class="form-group">
            <label class="col-sm-4 control-label" for="demo-hor-1">
                <?php echo translate('blog_sub-category_name'); ?>
            </label>
            <div class="col-sm-6">
                <input type="text" name="name" placeholder="<?php echo translate('blog_sub-category_name'); ?>" class="form-control required">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label"><?php echo translate('blog_category'); ?></label>
            <div class="col-sm-6">
                <?php echo $this->Crud_model->select_html('blog_category', 'parent_category_id', 'name', 'add', 'demo-chosen-select required'); ?>
            </div>
        </div>
    </div>
</form>
</div>
<script>
    $(document).ready(function () {
        $('.demo-chosen-select').chosen();
        $('.demo-cs-multiselect').chosen({width: '100%'});
    });

    $(document).ready(function () {
        $("form").submit(function (e) {
            return false;
        });
    });
</script>

<!--Bootstrap Tags Input [ OPTIONAL ]-->

