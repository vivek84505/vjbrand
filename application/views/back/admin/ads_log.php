<div id="content-container">
    <div id="page-title">
        <h1 class="page-header text-overflow">
            <?php echo translate('ads_log'); ?>
        </h1>
    </div>
    <div class="tab-base">
        <div class="panel">
            <div class="panel-body">
                <div class="tab-content">
                    <div class="tab-pane fade active in" style="border:1px solid #ebebeb; border-radius:4px;">
                        <div class="panel-body" id="demo_s">
                            <table id="demo-table" class="table table-striped"  data-pagination="true" data-show-refresh="true" data-ignorecol="0,2" data-show-toggle="true" data-show-columns="true" data-search="true" >
                                <thead>
                                    <tr>
                                        <th><?php echo translate('no'); ?></th>
                                        <th><?php echo translate('image'); ?></th>
                                        <th><?php echo translate('position'); ?></th>
                                        <th><?php echo translate('availability'); ?></th>
                                        <th><?php echo translate('customer'); ?></th>
                                        <th><?php echo translate('package'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $i = 0;
                                        $this->db->order_by('advertisement_id','asc');
                                        $ads_list   = $this->db->get('advertisement')->result_array();
                                        foreach ($ads_list as $row) {
                                            $i++;
                                    ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td>
                                                <?php
                                                    $default_post = json_decode($row['default_post'], true);
                                                    $post_details = json_decode($row['post_details'], true);
                                                    if ($row['availability'] == 'booked') {
                                                        $img = $post_details[0]['img'];
                                                    }
                                                    else {
                                                        $img = $default_post[0]['img'];
                                                    }
                                                ?>
                                                <img class="img-sm" src="<?=base_url()?>uploads/default_banner/<?=$img?>" alt="">
                                            </td>
                                            <td><?=$row['position']?></td>
                                            <td><?=$row['availability']?></td>
                                            <td><?php
                                                if ($row['user_id'] != NULL && $row['user_id'] != 0) {
                                                  echo $this->db->get_where('user', array('user_id' => $row['user_id']))->row()->firstname .' '. $this->db->get_where('user', array('user_id' => $row['user_id']))->row()->lastname ;
                                                }
                                                else {
                                                    echo '-';
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                    if ($row['user_id'] != NULL && $row['user_id'] != 0) {
                                                        $packages = json_decode($row['package'], true);
                                                        $package_id = $this->db->get_where('advertisement_payment', array('user_id' => $row['user_id'], 'expire' => 'no'))->row()->package_id;
                                                        foreach ($packages as $package) {
                                                            if ($package['index'] == $package_id) {?>
                                                            <b><?=translate('name:_')?></b><?=$package['name'];?><br>
                                                            <b><?=translate('amount:_')?></b><?='$'.$package['price'];?>
                                                            <?php
                                                            }
                                                        }
                                                    }
                                                ?>
                                            </td>
                                        </tr>
                                    <?php
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
