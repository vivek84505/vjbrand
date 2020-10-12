<div class="col-md-12 col-sm-12">
    <div class="panel" style="margin-bottom: 100px;">
        <?php
        $header_style = json_decode($this->db->get_where('ui_settings', array('type' => 'header_style'))->row()->value, true);
        ?>
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo translate('header_settings'); ?></h3>
        </div>
        <?php
        echo form_open(base_url() . 'admin/general_settings/header_style', array(
            'class' => 'form-horizontal',
            'method' => 'post',
            'id' => '',
            'enctype' => 'multipart/form-data'
        ));
        ?>
        <div class="panel-body">
            <div class="form-group">
                <label class="col-sm-3 control-label" for="demo-hor-inputemail">
                    <?php echo translate('menu_links_position'); ?>
                </label>
                <div class="col-sm-6">
                    <select class="demo-chosen-select" name="menu_links">
                        <option value="left" <?php
                        if ($header_style['menu_links'] == 'left') {
                            echo 'selected';
                        }
                        ?>><?php echo translate('left'); ?></option>
                        <option value="right" <?php
                        if ($header_style['menu_links'] == 'right') {
                            echo 'selected';
                        }
                        ?>><?php echo translate('right'); ?></option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="demo-hor-inputemail">
                        <?php echo translate('search_bar_position'); ?>
                </label>
                <div class="col-sm-6">
                    <select class="demo-chosen-select" name="search_bar">
                        <option value="left" <?php
                                if ($header_style['search_bar'] == 'left') {
                                    echo 'selected';
                                }
                                ?>><?php echo translate('left'); ?></option>
                        <option value="right" <?php
                                if ($header_style['search_bar'] == 'right') {
                                    echo 'selected';
                                }
                                ?>><?php echo translate('right'); ?></option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="demo-hor-inputemail">
                        <?php echo translate('drop_down_effects'); ?>
                </label>
                <div class="col-sm-6">
                    <select class="demo-chosen-select" name="effects">
                        <option value="fade" <?php
                        if ($header_style['effects'] == 'fade') {
                            echo 'selected';
                        }
                        ?>><?php echo translate('fade'); ?></option>
                        <option value="scale" <?php
                                if ($header_style['effects'] == 'scale') {
                                    echo 'selected';
                                }
                                ?>><?php echo translate('scale'); ?></option>
                        <option value="expand-top" <?php
                                if ($header_style['effects'] == 'expand-top') {
                                    echo 'selected';
                                }
                                ?>><?php echo translate('expand_top'); ?></option>
                        <option value="expand-bottom" <?php
                                if ($header_style['effects'] == 'expand-bottom') {
                                    echo 'selected';
                                }
                                ?>><?php echo translate('expand_bottom'); ?></option>
                        <option value="expand-left" <?php
                                if ($header_style['effects'] == 'expand-left') {
                                    echo 'selected';
                                }
                                ?>><?php echo translate('expand_left'); ?></option>
                        <option value="expand-right" <?php
                                if ($header_style['effects'] == 'expand-right') {
                                    echo 'selected';
                                }
                                ?>><?php echo translate('expand_right'); ?></option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="demo-hor-inputemail">
<?php echo translate('sticky_header'); ?>
                </label>
                <div class="col-sm-6">
                    <select class="demo-chosen-select" name="sticky_header">
                        <option value="true" <?php
if ($header_style['sticky_header'] == 'true') {
    echo 'selected';
}
?>><?php echo translate('yes'); ?></option>
                        <option value="false" <?php
if ($header_style['sticky_header'] == 'false') {
    echo 'selected';
}
?>><?php echo translate('no'); ?></option>
                    </select>
                </div>
            </div>
        </div>
        <div class="panel-footer text-right">
            <span class="btn btn-success btn-labeled fa fa-check submitter"  data-ing='<?php echo translate('saving'); ?>' data-msg='<?php echo translate('settings_updated!'); ?>'>
<?php echo translate('save'); ?>
            </span>
        </div>
        </form>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('.demo-chosen-select').chosen();
    });

</script>