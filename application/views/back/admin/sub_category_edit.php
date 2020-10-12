<?php
foreach ($sub_category_data as $row) {
    ?>

    <div>
        <?php
        echo form_open(base_url() . 'admin/sub_category/update/' . $row['news_sub_category_id'], array(
            'class' => 'form-horizontal',
            'method' => 'post',
            'id' => 'sub_category_edit',
            'enctype' => 'multipart/form-data'
        ));
        ?>
        <div class="panel-body">
            <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-inputemail">
                    <?php echo translate('news_sub-category_name'); ?>
                </label>
                <div class="col-sm-6">
                    <input type="text" name="name" value="<?php echo $row['name']; ?>" class="form-control required" placeholder="<?php echo translate('news_sub-category_name'); ?>" >
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label"><?php echo translate('news_category'); ?></label>
                <div class="col-sm-6">
                    <?php echo $this->Crud_model->select_html('news_category', 'parent_category_id', 'name', 'edit', 'demo-chosen-select required', $row['parent_category_id']); ?>
                </div>
            </div>
        </div>
    </form>
    </div>

    <script type="text/javascript">
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

    <?php
}
?>
	
