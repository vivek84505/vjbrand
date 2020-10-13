<div id="content-container">
    <div id="page-title">
        <h1 class="page-header text-overflow"></h1>
    </div>
    <div class="tab-base">
        <div class="panel">
            <div class="tab-base tab-stacked-left">


                <div class="tab-content bg_grey">

                    <span id="genset"></span>

                    <!-- SMTP SETTINGS -->
                    <div id="demo-stk-lft-tab-5" class="tab-pane fade active in">
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title"><?php echo translate('google_analytics'); ?></h3>
                            </div>
                            <?php
                            echo form_open(base_url() . 'admin/google_analytics/update', array(
                                'class' => 'form-horizontal',
                                'method' => 'post',
                                'id' => '',
                                'enctype' => 'multipart/form-data'
                            ));
                            ?>
                            <div class="panel-body">
                                 <div class="form-group">
                                    <label class="col-sm-3 control-label" >
                                        <?php echo translate('google_analytics_activation'); ?>
                                    </label>
                                    <div class="col-sm-6" style="padding-top: 5px;">
                                        <input id="google_analytics_set" class='sw4' data-set='google_analytics_set' type="checkbox" <?php if ($this->Crud_model->get_settings_value('general_settings', 'google_analytics_set', 'value') == 'yes') { ?>checked<?php } ?> />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">
                                        <?php echo translate('google_analytics_key'); ?>
                                    </label>
                                    <div class="col-sm-6">
                                        <input type="text" name="google_analytics_key" class="form-control"
                                               value="<?php echo $this->db->get_where('third_party_settings', array('type' => 'google_analytics_key'))->row()->value;?>">
                                    </div>
                                </div>

                            </div>
                            <!--SAVE---------->
                            <div class="panel-footer text-right">
                                <span class="btn btn-success btn-labeled fa fa-check submitter enterer"  data-ing='<?php echo translate('saving'); ?>' data-msg='<?php echo translate('settings_updated!'); ?>'>
                                    <?php echo translate('save'); ?>
                                </span>
                            </div>
                            </form>
                        </div>
                    </div>
                    <!-- SMTP SETTINGS ENDS -->

                </div>
            </div>
        </div>
    </div>
</div>

<div style="display:none;" id="site"></div>
<!-- for logo settings -->
<script>
    var base_url = '<?php echo base_url(); ?>'
    var user_type = 'admin';
    var module = 'google_analytics';
    var list_cont_func = '';
    var dlt_cont_func = '';

    $(document).ready(function () {
        $("form").submit(function (e) {
            return false;
        });
    });


</script>
<script src="<?php echo base_url(); ?>template/back/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js">
</script>
