<div>
    <?php
    echo form_open(base_url() . 'admin/widget/do_add/', array(
        'class' => 'form-horizontal',
        'method' => 'post',
        'id' => 'widget_add',
        'enctype' => 'multipart/form-data'
    ));
    ?>
    <div class="panel-body">
        <div class="form-group">
            <label class="col-sm-4 control-label" for="demo-hor-1">
                <?php echo translate('widget_name'); ?>
            </label>
            <div class="col-sm-6">
                <input type="text" name="title" id="demo-hor-1" 
                       class="form-control required" placeholder="<?php echo translate('widget_name'); ?>" >
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label" for="demo-hor-1">
                <?php echo translate('code'); ?>
            </label>
            <div class="col-sm-6">
                <textarea name="code" id="demo-hor-2" cols="38" rows="10"
                          class="form-control required" placeholder="<?php echo translate('enter_code_here.....'); ?>" ></textarea>
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
    $(document).ready(function () {
        $('.demo-chosen-select').chosen();
        $('.demo-cs-multiselect').chosen({width: '100%'});
    });
</script>