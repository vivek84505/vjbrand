<div class="panel">
    <?php
    $header_color = $this->db->get_where('ui_settings', array('type' => 'header_color'))->row()->value;
    ?>
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo translate('choose_theme'); ?></h3>
    </div>
    <?php
    echo form_open(base_url() . 'admin/general_settings/color', array(
        'class' => 'form-horizontal',
        'method' => 'post',
        'id' => '',
        'enctype' => 'multipart/form-data'
    ));
    ?>
    <div class="panel-body">
        <div class="form-group">
            <div class="row">
                <?php
                $colors = array(
                    'default-color' => '#470467',
                    'blue-1' =>'#247BE5',
                    'dark-1' => '#343D46',
                    'green-1' => '#159A09',
                    'purple-1' => '#8D34C6',
                    'red-1' => '#C23A2C'
                );

                foreach ($colors as $n => $color) {
                    ?>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                        <div class="delete-div-wrap cc-selector col-sm-12" style="border:0px;">
                            <input id="theme_color_<?php echo $n; ?>" type="radio" value="<?php echo $n; ?>" name="header_color" <?php
                            if ($header_color == $n) {
                                echo 'checked';
                            }
                            ?> >
                            <label class="tr-bg drinkcard-cc" for="theme_color_<?php echo $n; ?>"
                                   style="margin-bottom:0px;  height:300px; width:100%;
                                   background-image:url('<?php echo base_url(); ?>uploads/themes/theme-<?php echo $n; ?>.jpg');background-size:cover;">
                            </label>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
    <div class="panel-footer text-right">
        <span class="btn btn-success btn-labeled fa fa-check submitter enterer"  data-ing='<?php echo translate('saving'); ?>' data-msg='<?php echo translate('theme_updated!'); ?>'>
<?php echo translate('save'); ?>
        </span>
    </div>
</form>
</div>
