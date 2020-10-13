<div id="content-container">
    <div id="page-title">
        <h1 class="page-header text-overflow">
            <?php echo translate('manage_subscription_payments'); ?>
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
                                        <th><?php echo translate('user_name'); ?></th>

                                        <th><?php echo translate('amount'); ?></th>
                                        <th><?php echo translate('payment_method'); ?></th>
                                        <th><?php echo translate('payment_status'); ?></th>

                                        <th class="text-right"><?php echo translate('options'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $i = 0;
                                        $this->db->order_by('subscription_payment_id','desc');
                                        $payment_list   = $this->db->get('subscription_payment')->result_array();
                                        foreach ($payment_list as $row) {
                                            $i++;

                                    ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td>
                                                <?php
                                                    $user = $this->db->get_where('user',array('user_id' => $row['user_id']))->row();
                                                    if($user != null)
                                                        echo $user->firstname;
                                                ?>
                                            </td>
                                            <td><?php echo currency('','def').$row['amount'];?></td>
                                            <td><?php echo $row['payment_type'];?></td>
                                            <td>
                                                <label class="label <?php if($row['payment_status'] == 'paid'){ echo 'label-success'; }else{ echo 'label-danger';} ?>">
                                                    <?php echo $row['payment_status'];?>
                                                </label>
                                            </td>

                                            <td class="text-right">
                                                <a class="btn btn-info btn-xs btn-labeled fa fa-check" data-toggle="tooltip"
                                                    onclick="ajax_modal('view','<?php echo translate('view_payment_details'); ?>','<?php echo translate('successfully_viewed!'); ?>','subscription_payment_view','<?php echo $row['subscription_payment_id']; ?>')" data-original-title="View" data-container="body">
                                                        <?php echo translate('check_details'); ?>
                                                </a>
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
<script>
    var base_url = '<?php echo base_url(); ?>';
    var user_type = 'admin';
    var module = 'subscription_payment';
    var list_cont_func = '';
    var dlt_cont_func = '';
</script>
