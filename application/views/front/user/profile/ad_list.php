<div class="information-title">
    <?php echo translate('advertisement_information'); ?>
</div>
<div class="details-wrap">
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th><?php echo translate('no')?></th>
                        <th><?php echo translate('seal'); ?></th>
                        <th><?php echo translate('package_name'); ?></th>
                        <th><?php echo translate('page_name'); ?></th>
                        <th><?php echo translate('position'); ?></th>
                        <th><?php echo translate('amount'); ?></th>
                        <th><?php echo translate('payment_method'); ?></th>
                        <th><?php echo translate('payment_status'); ?></th>
                        <th><?php echo translate('status'); ?></th>
                        <th><?php echo translate('option'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $i=0;
                        foreach($paid_ad_list as $list){
                            $ad_list_data = $this->db->get_where('advertisement',array('advertisement_id'=>$list['advertisement_id']))->result_array();
                            foreach($ad_list_data as $ad_list){
                                $i++;
                                $package_list = json_decode($ad_list['package'],true);
                                foreach($package_list as $package){
                                    if($package['index'] == $list['package_id']){
                                       $name = $package['name'];
                                       $seal = $package['seal'];
                                       $price = $package['price'];
                                    }
                                }
                    ?>
                    <tr>
                        <td><?php echo $i;?></td>
                        <td>
                            <img class="img-responsive img-circle img-thumbnail image_delay" style="width: 40px;height: 40px;" src="<?php echo img_loading(); ?>" data-src="<?php echo base_url();?>uploads/default_banner/<?php echo $seal;?>"/>
                        </td>
                        <td>
                            <?php echo $name;?>
                        </td>
                        <td><?php echo $this->db->get_where('ad_page',array('ad_page_id'=>$ad_list['page_id']))->row()->name;?></td>
                        <td><?php echo $ad_list['position'];?></td>
                        <td><?php echo currency($price);?></td>
                        <td><?php echo $list['payment_type'];?></td>
                        <td><?php echo $list['payment_status'];?></td>
                        <td>
                            <?php
                                if($list['expire_timestamp'] > time() && $ad_list['approval'] == 'ok'){
                            ?>
                                <input class='aiz_switchery' type='checkbox' id="status_<?php echo $ad_list['advertisement_id'];?>" data-id="<?php echo $ad_list['advertisement_id'];?>" <?php if($ad_list['user_status'] == 'ok'){echo 'checked';}?> data-tm="<?php echo translate('successfully_published')?>" data-fm="<?php echo translate('successfully_unpublished')?>"/>
                            <?php
                                } else {
                                }
                            ?>
                        </td>
                        <td>
                            <div class="pull-right">
                            <?php
                                if($list['expire_timestamp'] > time() && $ad_list['approval'] == 'ok'){
                            ?>
                                <a href="#" onclick="edit_ad('<?php echo $list['advertisement_id'];?>');" data-toggle="tooltip" title="Edit" class="btn btn-success btn-sm"><i class="fa fa-wrench"></i></a>
                            <?php
                                } else {
                            ?>
                                <a href="#" class="btn btn-danger btn-sm"><?php echo translate('expired'); ?></a>
                            <?php
                                }
                            ?>
                            </div>
                        </td>
                    </tr>
                    <?php
                            }
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        load_iamges();
        set_switchery();
    });
</script>
<style>
    select.input-sm, select.form-group-sm .form-control {
        height: 40px !important;
        line-height: 15px !important;
    }
    .as{
        margin-top:0px !important;
    }
    td .sm{
        height:50px;
    }
</style>
