
<?php
foreach ($product_type_data as $row) {
    ?>
    <div class="tab-pane fade active in" id="edit">
        <?php
        echo form_open(base_url() . 'admin/product_type/update/' . $row['product_type_id'], array(
            'class' => 'form-horizontal',
            'method' => 'post',
            'id' => 'product_type_edit',
            'enctype' => 'multipart/form-data'
        ));

        $data1 = $this->Crud_model->get_type_name_by_id('product_type', $row['product_type_id'], 'details');
        $details = json_decode($data1);
        $shown_for = explode('-', $details->s_for);
        $featured_for = explode('-', $details->f_for);
        ?>
        <div class="panel-body">
            <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-1">
                    <?php echo translate('name'); ?>
                </label>
                <div class="col-sm-6">
                    <input type="text" name="name" id="demo-hor-1" 
                           class="form-control required"value="<?php echo $row['name'] ?>" placeholder="<?php echo translate('name'); ?>" >
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-1">
                    <?php echo translate('featured_for'); ?>
                </label> 
                <div class="col-sm-4">
                    <input type="text" name="tym" value="<?php echo $featured_for[0]; ?>" id="demo-hor-1" 
                           class="form-control required" placeholder="<?php echo translate('numeber'); ?>" >
                </div>
                <div class="col-sm-4">
                    <select class="demo-chosen-select" 
                            title="Choose one of the following..." data-width="100%"           
                            name="tym_typ">
                        <option value=""><?php echo translate('Select One'); ?></option>
                        <option value="day" <?php
                        if ($featured_for[1] == 'day') {
                            echo 'selected';
                        }
                        ?>><?php echo translate('day'); ?></option>
                        <option value="month" <?php
                    if ($featured_for[1] == 'month') {
                        echo 'selected';
                    }
                        ?>><?php echo translate('month'); ?></option>
                        <option value="year" <?php
                            if ($featured_for[1] == 'year') {
                                echo 'selected';
                            }
                            ?>><?php echo translate('year'); ?></option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-1">
    <?php echo translate('shown_for'); ?>
                </label>
                <div class="col-sm-4">
                    <input type="text" value="<?php echo $shown_for[0]; ?>" name="tym1" id="demo-hor-1" 
                           class="form-control required" placeholder="<?php echo translate('number'); ?>" >
                </div>
                <div class="col-sm-4">
                    <select class="demo-chosen-select" 
                            title="Choose one of the following..." data-width="100%"           
                            name="tym_typ1">
                        <option value=""><?php echo translate('Select One'); ?></option>
                        <option value="day" <?php
                        if ($shown_for[1] == 'day') {
                            echo 'selected';
                        }
                        ?>><?php echo translate('day'); ?></option>
                        <option value="month" <?php
                        if ($shown_for[1] == 'month') {
                            echo 'selected';
                        }
                        ?>><?php echo translate('month'); ?></option>
                        <option value="year" <?php
                if ($shown_for[1] == 'year') {
                    echo 'selected';
                }
                ?>><?php echo translate('year'); ?></option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-1">
    <?php echo translate('price'); ?>
                </label>
                <div class="col-sm-6">
                    <input type="text" name="price" id="demo-hor-1" 
                           class="form-control required" value="<?php echo $row['price'] ?>" placeholder="<?php echo translate('price'); ?>" >
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
        $('.demo-chosen-select').chosen();
        $('.demo-cs-multiselect').chosen({
            width: '100%'
        });

        $("form").submit(function (e) {
            return false;
        });
    });
</script>