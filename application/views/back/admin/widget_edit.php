<?php
foreach ($widget_data as $row) {
    ?>
    <div class="tab-pane fade active in" id="edit">
        <?php
        echo form_open(base_url() . 'admin/widget/update/' . $row['widget_id'], array(
            'class' => 'form-horizontal',
            'method' => 'post',
            'id' => 'widget_edit',
            'enctype' => 'multipart/form-data'
        ));
        ?>
        <div class="panel-body">
            <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-1">
                    <?php echo translate('widget_name'); ?>
                </label>
                <div class="col-sm-6">
                    <input type="text" name="title" id="demo-hor-1" value="<?php echo $row['title'] ?>" 
                           class="form-control required" placeholder="<?php echo translate('widget_name'); ?>" >
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-1">
                    <?php echo translate('code'); ?>
                </label>
                <div class="col-sm-6">
                    <textarea name="code" id="demo-hor-2" cols="38" rows="10"
                              class="form-control required" placeholder="<?php echo translate('enter_code_here.....'); ?>" ><?php echo $row['code'] ?></textarea>
                </div>
            </div>
        </div>
    </form>
    </div>
    <?php
}
?>

<script>
    $(document).ready(function () {
        $("form").submit(function (e) {
            return false;
        });
    });
</script>