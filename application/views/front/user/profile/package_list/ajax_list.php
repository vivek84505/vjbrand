<div class="row">
    <div class="col-md-12">
        <table class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th><?php echo translate('no')?></th>
                    <th><?php echo translate('seal'); ?></th>
                    <th><?php echo translate('package_name'); ?></th>
                    <th><?php echo translate('amount'); ?></th>
                    <th><?php echo translate('payment_method'); ?></th>
                    <th><?php echo translate('payment_status'); ?></th>
                    <th><?php echo translate('option'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $i=0;
                    foreach($packages_list as $list){
                        $package_list_data = $this->db->get_where('subscription',array('subscription_id'=>$list['subscription_id']))->result_array();
                        foreach($package_list_data as $package_list){
                        	$i++;
    						$name = $package_list['name'];
    						$seal = json_decode($package_list['image'], true);
    						$img = $seal[0]['thumb'];
    						$price = $package_list['amount'];
                ?>
                <tr>
                    <td><?php echo $i;?></td>
                    <td>
                        <img class="img-responsive img-circle img-thumbnail" style="width: 40px;height: 40px;" src="<?php echo base_url();?>uploads/subscription_image/<?php echo $img;?>" data-src="<?php echo base_url();?>uploads/subscription_image/<?php echo $img;?>"/>
                    </td>
                    <td>
                        <?php echo $name;?>
                    </td>
                    <td><?php echo currency($price);?></td>
                    <td><?php echo $list['payment_type'];?></td>
                    <td><?php echo $list['payment_status'];?></td>
                    <td>
    					<a href="#" onclick="package_details('<?php echo $list['subscription_payment_id'];?>');" data-toggle="tooltip" title="<?=translate('payment_details')?>" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
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
<!-- Pagination -->
<div class="pagination-wrapper">
    <?php echo $this->ajax_pagination->create_links();  ?>
</div>
<!-- /Pagination -->
