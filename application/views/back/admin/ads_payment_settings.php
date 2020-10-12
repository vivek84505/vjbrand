<div id="content-container">
    <div id="page-title">
        <h1 class="page-header text-overflow">
            <?php echo translate('manage_ad_payment_settings'); ?>
        </h1>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-12">
                <div class="panel panel-bordered panel-dark">
                    <div class="panel-heading">
                        <center>
                            <h3 class="panel-title"><?php echo translate('payment_gateway_activation') ?></h3>
                        </center>
                    </div>
                    <div class="panel-body" style="background:#fffffb;">
                        <div class="col-md-5 col-md-offset-1">
                            <div class="panel">
                                <div class="panel-heading bg-white">
                                    <center>
                                        <h4 class="panel-title" style="padding: 0px;">
                                            <?php echo translate('paypal'); ?>
                                        </h4>
                                    </center>
                                </div>

                                <!--Panel body-->
                                <div class="panel-body">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <center>
                                                <input class='payment_switchery' type="checkbox" name="paypal_set" id="id1"	data-set="paypal_set"							data-set='paypal_set'  value="ok"
                                                   data-id=''
                                                   data-tm='<?php echo translate('paypal_payment_enabled'); ?>'
                                                   data-fm='<?php echo translate('paypal_payment_disabled'); ?>'
                                                   <?php if ($paypal_set == 'ok') { ?>checked<?php } ?> />
                                            </center>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="panel">
                                <div class="panel-heading bg-white">
                                    <center>
                                        <h4 class="panel-title" style="padding: 0px;">
                                            <?php echo translate('stripe'); ?>
                                        </h4>
                                    </center>
                                </div>

                                <!--Panel body-->
                                <div class="panel-body">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <center>
                                                <input class='payment_switchery' type="checkbox" name="stripe_set" id="id2"	data-set="stripe_set"
                                                   data-id=''
                                                   data-tm='<?php echo translate('stripe_payment_enabled'); ?>'
                                                   data-fm='<?php echo translate('stripe_payment_disabled'); ?>'
                                                   <?php if ($stripe_set == 'ok') { ?>checked<?php } ?> 
                                                />
                                            </center>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <span id="payment_set"></span>
            </div>
            <?php
            echo form_open(base_url() . 'admin/ads_payment_settings/set_payment_method/', array(
                'class' => 'form-horizontal',
                'method' => 'post',
                'id' => 'gen_set',
                'enctype' => 'multipart/form-data'
            ));
            ?>
            <div class="col-md-12">
                <div class="panel panel-bordered panel-dark">
                    <div class="panel-heading">
                        <center>
                            <h3 class="panel-title"><?php echo translate('payment_gateway_settings') ?></h3>
                        </center>
                    </div>
                    <div class="panel-body" style="background:#fffffb;">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="panel">
                                    <div class="panel-heading bg-white">
                                        <h4 class="panel-title"><?php echo translate('paypal_settings') ?></h4>
                                    </div>
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label"><?php echo translate('paypal_email'); ?></label>
                                            <div class="col-sm-8">
                                                <input type="text" name="paypal_email" value="<?php echo $paypal_email; ?>" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="demo-hor-inputemail">
                                                <?php echo translate('account_type'); ?>

                                            </label>
                                            <div class="col-sm-8">
                                                <?php
                                                $from = array('sandbox'=>'sandbox', 'original'=>'original');
                                                echo $this->Crud_model->select_html($from, 'paypal_account_type', '', 'edit', 'demo-chosen-select', $paypal_account_type);
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="panel">
                                    <div class="panel-heading bg-white">
                                        <h4 class="panel-title"><?php echo translate('stripe_settings') ?></h4>
                                    </div>

                                    <!--Panel body-->
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label"><?php echo translate('secret_key'); ?></label>
                                            <div class="col-sm-8">
                                                <input type="text" name="stripe_secret_key" value="<?php echo $stripe_secret_key; ?>" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label"><?php echo translate('publishable_key'); ?></label>
                                            <div class="col-sm-8">
                                                <input type="text" name="stripe_publishable_key" value="<?php echo $stripe_publishable_key; ?>" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer text-right">
                        <span class="btn btn-info submitter enterer" data-ing='<?php echo translate('saving'); ?>' data-msg='<?php echo translate('settings_updated!'); ?>' >
                            <?php echo translate('save'); ?>
                        </span>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<script>
    var base_url = '<?php echo base_url(); ?>';
    var user_type = 'admin';
    var module = 'ads_payment_settings';
    var list_cont_func = '';
    var dlt_cont_func = '';
    $(document).ready(function (e) {
        $('.demo-chosen-select').chosen();
    })
</script>
