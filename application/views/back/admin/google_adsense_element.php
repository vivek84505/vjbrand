
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
                                        <td><?php echo translate('728*90'); ?></td>
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
                        echo form_open(base_url() . 'admin/google_adsense_settings/set_google_adsense/'.$ad_data->advertisement_id, array(
                            'class' => 'form-horizontal',
                            'method' => 'post',
                            'id' => '',
                            'enctype' => 'multipart/form-data'
                        ));
                    ?>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" >
                                <?php echo translate('google_adsense_activation'); ?>
                            </label>
                            <div class="col-sm-6" style="padding-top: 5px;">

                                <input type="checkbox" class="ad_switchery" name="google_adsense" data-ajax="no" data-set="<?php echo $ad_data->google_adsense; ?>" id="google_<?php echo $ad_data->type; ?>"
                                    data-tm="<?php echo translate('google_adsense_is_activated!'); ?>"
                                    data-fm="<?php echo translate('google_adsense_is_disabled!'); ?>"
                                    <?php if($ad_data->google_adsense == "ok"){ ?>checked<?php } ?>
                                />
                            </div>
                        </div>

                        <div class="panel-body">
                            <div class="form-group margin-top-10">
                                <label class="col-sm-3 control-label"><?php echo translate('google_adsense_code');?></label>
                                <div class="col-sm-9">
                                    <textarea type="text" class="form-control required " name="google_adsense_code" rows="10" placeholder="<?php echo translate('google_adsense_code')?>" /><?php echo $ad_data->google_adsense_code;?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer text-right">
                            <span class="btn btn-success btn-labeled fa fa-check submitter enterer" data-ing='<?php echo translate('saving'); ?>' data-msg='<?php echo translate('saved!'); ?>'>
                                <?php echo translate('save'); ?>
                            </span>
                        </div>
                    </form>
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