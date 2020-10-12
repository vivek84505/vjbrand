<div>
    <?php
    echo form_open(base_url() . 'admin/product_type/do_add/', array(
        'class' => 'form-horizontal',
        'method' => 'post',
        'id' => 'product_type_add',
        'enctype' => 'multipart/form-data'
    ));
    ?>
    <div class="panel-body">
        <div class="form-group">
            <label class="col-sm-4 control-label" for="demo-hor-1">
                <?php echo translate('name'); ?>
            </label>
            <div class="col-sm-6">
                <input type="text" name="name" id="demo-hor-1" 
                       class="form-control required" placeholder="<?php echo translate('name'); ?>" >
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label" for="demo-hor-1">
                <?php echo translate('featured_for'); ?>
            </label>

            <div class="col-sm-3">
                <input type="text" name="tym" id="demo-hor-1" 
                       class="form-control required" placeholder="<?php echo translate('numeber'); ?>" >
            </div>
            <div class="col-sm-3">
                <select class="demo-chosen-select" 
                        title="Choose one of the following..." data-width="100%"           
                        name="tym_typ">
                    <option value=""><?php echo translate('Select One'); ?></option>
                    <option value="day"><?php echo translate('day'); ?></option>
                    <option value="month"><?php echo translate('month'); ?></option>
                    <option value="year"><?php echo translate('year'); ?></option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label" for="demo-hor-1">
                <?php echo translate('shown_for'); ?>
            </label>

            <div class="col-sm-3">
                <input type="text" name="tym1" id="demo-hor-1" 
                       class="form-control required" placeholder="<?php echo translate('number'); ?>" >
            </div>
            <div class="col-sm-3">
                <select class="demo-chosen-select" 
                        title="Choose one of the following..." data-width="100%"           
                        name="tym_typ1">
                    <option value=""><?php echo translate('Select One'); ?></option>
                    <option value="day"><?php echo translate('day'); ?></option>
                    <option value="month"><?php echo translate('month'); ?></option>
                    <option value="year"><?php echo translate('year'); ?></option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label" for="demo-hor-1">
                <?php echo translate('price'); ?>
            </label>
            <div class="col-sm-6">
                <input type="text" name="price" id="demo-hor-1" 
                       class="form-control required" placeholder="<?php echo translate('price'); ?>" >
            </div>
        </div>

    </div>
</form>
</div>

<script>
    $(document).ready(function () {
        $('.demo-chosen-select').chosen();
        $('.demo-cs-multiselect').chosen({
            width: '100%'
        });
        $("form").submit(function (e) {
            return false;
        });
    });
</script>