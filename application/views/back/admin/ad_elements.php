<?php
    $default_post = json_decode($ad_data->default_post,true);
    if(!empty($default_post)){
        foreach($default_post as $post){
            $url = $post['url'];
            $img = $post['img'];
        }
    }else{
        $url = '';
        $img = '';
    }

?>
<div class="panel outer">
    <div class="panel-heading">
        <h1 class="panel-title">
            <?php echo translate($ad_data->title); ?>
        </h1>
    </div>

    <div class="panel-body">
        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-dark panel-colorful">
                    <div class="panel-heading">
                        <h1 class="panel-title text-center "><?php echo translate('information'); ?></h1>
                    </div>
                    <div class="panel-body" style="padding:0px;">
                        <div class="pad-all">
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <td><?php echo translate('position'); ?></td>
                                        <td>:</td>
                                        <td><?php echo translate($ad_data->position); ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo translate('page'); ?></td>
                                        <td>:</td>
                                        <td><?php echo translate($this->Ads_model->getPageNameByID($ad_data->page_id)); ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo translate('format'); ?> </td>
                                        <td>:</td>
                                        <td><?php echo translate($ad_data->format); ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo translate('size'); ?></td>
                                        <td>:</td>
                                        <td><?php echo translate($ad_data->size); ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo translate('status'); ?></td>
                                        <td>:</td>
                                        <td>
                                            <input type="checkbox" class="ad_switchery" name="status" data-set="<?php echo $ad_data->type; ?>" id="<?php echo $ad_data->type; ?>"
                                                data-tm="<?php echo translate($ad_data->title . '_is_enabled!'); ?>"
                                                data-fm="<?php echo translate($ad_data->title . '_is_disabled!'); ?>"
                                                <?php if ($ad_data->status == 'ok') { echo 'checked'; } ?>
                                            />
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="panel">
                    <?php
                        echo form_open(base_url() . 'admin/ads_settings/set_default/'.$ad_data->advertisement_id, array(
                            'class' => 'form-horizontal',
                            'method' => 'post',
                            'id' => '',
                            'enctype' => 'multipart/form-data'
                        ));
                    ?>
                    <div class="panel-body">
                        <div class="form-group margin-top-10">
                            <label class="col-sm-3 control-label"><?php echo translate('redirect_url');?></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="redirect_url" placeholder="<?php echo translate('redirect_url')?>" value="<?php echo $url;?>"/>
                            </div>
                        </div>
                        <div class="form-group margin-top-10">
                            <label class="col-sm-3 control-label"><?php echo translate('image');?></label>
                            <div class="col-sm-9">
                                <center>
                                    <?php
                                        if (file_exists('uploads/default_banner/' . $img) && $img !== '') {
                                    ?>
                                            <img class="img-responsive img-border blah" src="<?php echo base_url();?>uploads/default_banner/<?php echo $img; ?>"/>
                                    <?php
                                        }
                                        else{
                                    ?>
                                            <img class="img-responsive img-border blah" src="<?php echo base_url(); ?>uploads/default_banner/<?php echo $ad_data->type;?>.jpg">
                                    <?php
                                        }
                                    ?>
                                    <br />
                                    <span class="btn btn-default btn-file margin-top-10">
                                        <?php echo translate('select_default_image'); ?>
                                        <input type="file" name="default_image" class="form-control imgInp">
                                    </span>
                                </center>
                            </div>
                        </div>
                    </div>
                    <?php if($ad_data->google_adsense == 'ok') { ?>
                        <div class="panel-footer text-right">
                            <span class="btn btn-success">
                                <?php echo translate('already_booked_for_google_adsence'); ?>
                            </span>
                        </div>
                    <?php } else { ?>
                        <div class="panel-footer text-right">
                            <span class="btn btn-success btn-labeled fa fa-check submitter enterer"  data-ing='<?php echo translate('saving'); ?>' data-msg='<?php echo translate('updated!'); ?>'>
                                <?php echo translate('update'); ?>
                            </span>
                        </div>
                    <?php } ?>
                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h1 class="panel-title text-center "><?php echo translate('subscription_package'); ?></h1>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="panel">
                                    <?php
                                        echo form_open(base_url() . 'admin/ads_settings/package/' . $ad_data->advertisement_id . '/1', array(
                                            'class' => 'form-horizontal',
                                            'method' => 'post',
                                            'id' => '',
                                            'enctype' => 'multipart/form-data'
                                        ));
                                    ?>
                                    <?php
                                        $package1 = $this->Ads_model->package_data($ad_data->advertisement_id,1);
                                    ?>
                                    <div class="panel-heading">
                                        <h3 class="panel-title text-center"><?php echo translate("1_week");?></h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label"><?php echo translate('package_name'); ?> : </label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="name" value="<?php echo $package1['name'];?>" placeholder="<?php echo translate('package_name'); ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label"><?php echo translate('package_price').' ('.currency('','def').')'; ?> : </label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="price" value="<?php echo $package1['price'];?>" placeholder="<?php echo translate('package_price'); ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label"><?php echo translate('package_seal'); ?> : </label>
                                                <div class="col-sm-4">
                                                    <center>
                                                        <?php
                                                            if (file_exists('uploads/default_banner/' . $package1['seal']) && $package1['seal'] !== '') {
                                                        ?>
                                                        <img class="img-responsive img-circle img-border blah" style="width:64px !important; height: 64px!important;" src="<?php echo base_url();?>uploads/default_banner/<?php echo $package1['seal']; ?>"/>
                                                        <?php
                                                            }
                                                            else{
                                                        ?>
                                                                <img class="img-responsive img-circle img-border blah" style="width:64px !important; height: 64px!important;" src="<?php echo base_url(); ?>uploads/others/default_image.png">
                                                        <?php
                                                            }
                                                        ?>
                                                        <br />
                                                        <span class="btn btn-default btn-file margin-top-10">
                                                            <?php echo translate('choose_seal'); ?>
                                                            <input type="file" name="seal" class="form-control imgInp">
                                                        </span>
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label"><?php echo translate('activate'); ?> : </label>
                                                <div class="col-sm-8 checkbox">
                                                    <label class="form-checkbox form-icon form-text active">
                                                        <input type="checkbox" class="form-control" name="activation" <?php if($package1['activation']== 'ok'){echo 'checked';}?>/>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-footer text-right">
                                        <span class="btn btn-success btn-labeled fa fa-check submitter enterer"  data-ing='<?php echo translate('saving'); ?>' data-msg='<?php echo translate('settings_updated!'); ?>'>
                                            <?php echo translate('save'); ?>
                                        </span>
                                    </div>
                                    <?php echo form_close();?>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="panel">
                                    <?php
                                        echo form_open(base_url() . 'admin/ads_settings/package/' . $ad_data->advertisement_id.'/2', array(
                                            'class' => 'form-horizontal',
                                            'method' => 'post',
                                            'id' => '',
                                            'enctype' => 'multipart/form-data'
                                        ));
                                    ?>
                                    <div class="panel-heading">
                                        <h3 class="panel-title text-center"><?php echo translate("1_month");?></h3>
                                    </div>
                                    <?php
                                        $package2 = $this->Ads_model->package_data($ad_data->advertisement_id,2);
                                    ?>
                                    <div class="panel-body">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label"><?php echo translate('package_name'); ?> : </label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="name" value="<?php echo $package2['name'];?>" placeholder="<?php echo translate('package_name'); ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label"><?php echo translate('package_price').' ('.currency('','def').')'; ?> : </label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="price" value="<?php echo $package2['price'];?>" placeholder="<?php echo translate('package_price'); ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label"><?php echo translate('package_seal'); ?> : </label>
                                                <div class="col-sm-4">
                                                    <center>
                                                        <?php
                                                            if (file_exists('uploads/default_banner/' . $package2['seal'] ) && $package2['seal'] !== '') {
                                                        ?>
                                                        <img class="img-responsive img-circle img-border blah" style="width:64px !important; height: 64px!important;" src="<?php echo base_url();?>uploads/default_banner/<?php echo $package2['seal']; ?>"/>
                                                        <?php
                                                            }
                                                            else{
                                                        ?>
                                                                <img class="img-responsive img-circle img-border blah" style="width:64px !important; height: 64px!important;" src="<?php echo base_url(); ?>uploads/others/default_image.png">
                                                        <?php
                                                            }
                                                        ?>
                                                        <br />
                                                        <span class="btn btn-default btn-file margin-top-10">
                                                            <?php echo translate('choose_seal'); ?>
                                                            <input type="file" name="seal" class="form-control imgInp">
                                                        </span>
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label"><?php echo translate('activate'); ?> : </label>
                                                <div class="col-sm-8 checkbox">
                                                    <label class="form-checkbox form-icon form-text active">
                                                        <input type="checkbox" class="form-control" name="activation" <?php if($package2['activation']== 'ok'){echo 'checked';}?>/>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-footer text-right">
                                        <span class="btn btn-success btn-labeled fa fa-check submitter enterer"  data-ing='<?php echo translate('saving'); ?>' data-msg='<?php echo translate('settings_updated!'); ?>'>
                                            <?php echo translate('save'); ?>
                                        </span>
                                    </div>
                                    <?php echo form_close();?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="panel">
                                    <?php
                                        echo form_open(base_url() . 'admin/ads_settings/package/' . $ad_data->advertisement_id.'/3', array(
                                            'class' => 'form-horizontal',
                                            'method' => 'post',
                                            'id' => '',
                                            'enctype' => 'multipart/form-data'
                                        ));
                                    ?>
                                    <div class="panel-heading">
                                        <h3 class="panel-title text-center"><?php echo translate("6_month");?></h3>
                                    </div>
                                    <?php
                                        $package3 = $this->Ads_model->package_data($ad_data->advertisement_id,3);
                                    ?>
                                    <div class="panel-body">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label"><?php echo translate('package_name'); ?> : </label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="name" value="<?php echo $package3['name'];?>" placeholder="<?php echo translate('package_name'); ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label"><?php echo translate('package_price').' ('.currency('','def').')'; ?> : </label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="price" value="<?php echo $package3['price'];?>" placeholder="<?php echo translate('package_price'); ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label"><?php echo translate('package_seal'); ?> : </label>
                                                <div class="col-sm-4">
                                                    <center>
                                                        <?php
                                                            if (file_exists('uploads/default_banner/' .$package3['seal']) && $package3['seal'] !== '') {
                                                        ?>
                                                        <img class="img-responsive img-circle img-border blah" style="width:64px !important; height: 64px!important;" src="<?php echo base_url();?>uploads/default_banner/<?php echo $package3['seal']; ?>"/>
                                                        <?php
                                                            }
                                                            else{
                                                        ?>
                                                                <img class="img-responsive img-circle img-border blah" style="width:64px !important; height: 64px!important;" src="<?php echo base_url(); ?>uploads/others/default_image.png">
                                                        <?php
                                                            }
                                                        ?>
                                                        <br />
                                                        <span class="btn btn-default btn-file margin-top-10">
                                                            <?php echo translate('choose_seal'); ?>
                                                            <input type="file" name="seal" class="form-control imgInp">
                                                        </span>
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label"><?php echo translate('activate'); ?> : </label>
                                                <div class="col-sm-8 checkbox">
                                                    <label class="form-checkbox form-icon form-text active">
                                                        <input type="checkbox" class="form-control" name="activation" <?php if($package3['activation'] == 'ok'){ echo 'checked'; }?>/>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-footer text-right">
                                        <span class="btn btn-success btn-labeled fa fa-check submitter enterer"  data-ing='<?php echo translate('saving'); ?>' data-msg='<?php echo translate('settings_updated!'); ?>'>
                                            <?php echo translate('save'); ?>
                                        </span>
                                    </div>
                                    <?php echo form_close();?>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="panel">
                                    <?php
                                        echo form_open(base_url() . 'admin/ads_settings/package/' . $ad_data->advertisement_id .'/4', array(
                                            'class' => 'form-horizontal',
                                            'method' => 'post',
                                            'id' => '',
                                            'enctype' => 'multipart/form-data'
                                        ));
                                    ?>
                                    <div class="panel-heading">
                                        <h3 class="panel-title text-center"><?php echo translate("1_year");?></h3>
                                    </div>
                                    <?php
                                        $package4 = $this->Ads_model->package_data($ad_data->advertisement_id,4);
                                    ?>
                                    <div class="panel-body">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label"><?php echo translate('package_name'); ?> : </label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="name" value="<?php echo $package4['name'];?>" placeholder="<?php echo translate('package_name'); ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label"><?php echo translate('package_price').' ('.currency('','def').')'; ?> : </label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="price" value="<?php echo $package4['price'];?>" placeholder="<?php echo translate('package_price'); ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label"><?php echo translate('package_seal'); ?> : </label>
                                                <div class="col-sm-4">
                                                    <center>
                                                        <?php
                                                            if (file_exists('uploads/default_banner/' . $package4['seal']) && $package4['seal'] !== '') {
                                                        ?>
                                                        <img class="img-responsive img-circle img-border blah" style="width:64px !important; height: 64px!important;" src="<?php echo base_url();?>uploads/default_banner/<?php echo $package4['seal']; ?>"/>
                                                        <?php
                                                            }
                                                            else{
                                                        ?>
                                                                <img class="img-responsive img-circle img-border blah" style="width:64px !important; height: 64px!important;" src="<?php echo base_url(); ?>uploads/others/default_image.png">
                                                        <?php
                                                            }
                                                        ?>
                                                        <br />
                                                        <span class="btn btn-default btn-file margin-top-10">
                                                            <?php echo translate('choose_seal'); ?>
                                                            <input type="file" name="seal" class="form-control imgInp">
                                                        </span>
                                                    </center>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label"><?php echo translate('activate'); ?> : </label>
                                                <div class="col-sm-8 checkbox">
                                                    <label class="form-checkbox form-icon form-text active">
                                                        <input type="checkbox" class="form-control" name="activation" <?php if($package4['activation']== 'ok'){echo 'checked';}?>/>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-footer text-right">
                                        <span class="btn btn-success btn-labeled fa fa-check submitter enterer"  data-ing='<?php echo translate('saving'); ?>' data-msg='<?php echo translate('settings_updated!'); ?>'>
                                            <?php echo translate('save'); ?>
                                        </span>
                                    </div>
                                    <?php echo form_close();?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .panel-mint .panel-body table tr{
        background-color: #18af92;
    }
</style>
