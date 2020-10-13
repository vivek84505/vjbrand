<div id="content-container">
    <div id="page-title">
        <h1 class="page-header text-overflow">
            <?php echo translate('manage_advertisement_payments'); ?>
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
                                        <th><?php echo translate('page_name'); ?></th>
                                        <th><?php echo translate('position'); ?></th>
                                        <th><?php echo translate('amount'); ?></th>
                                        <th><?php echo translate('payment_method'); ?></th>
                                        <th><?php echo translate('payment_status'); ?></th>
                                        <th><?php echo translate('validity'); ?></th>
                                        <th class="text-right"><?php echo translate('options'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $i = 0;
                                        $this->db->order_by('advertisement_payment_id','desc');
                                        $payment_list   = $this->db->get('advertisement_payment')->result_array();
                                        foreach ($payment_list as $row) {
                                            $i++;
                                            $ad_details = $this->db->get_where('advertisement', array('advertisement_id' => $row['advertisement_id']))->row();
                                    ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td>
                                                <?php
                                                    $user_info = $this->db->get_where('user',array('user_id' => $row['user_id']))->row();
                                                    if($user_info != null)
                                                    echo $user_info->firstname;
                                                ?>
                                            </td>
                                            <td><?php echo $this->Crud_model->get_type_name_by_id('ad_page', $ad_details->page_id); ?></td>
                                            <td><?php echo $ad_details->position; ?></td>
                                            <td><?php echo currency('','def').' '. $row['amount'];?></td>
                                            <td><?php echo $row['payment_type'];?></td>
                                            <td>
                                                <label class="label <?php if($row['payment_status'] == 'paid'){ echo 'label-success'; }else{ echo 'label-danger';} ?>">
                                                    <?php echo $row['payment_status'];?>
                                                </label>
                                            </td>
                                            <td>
                                                <label class="label <?php if($row['expire'] == 'no'){ echo 'label-success';}else{echo 'label-danger';}?>">
                                                    <?php
                                                        if($row['expire'] == 'no'){
                                                            echo translate('valid');
                                                        }
                                                        else echo translate('expired');
                                                    ?>
                                                </label>
                                            </td>
                                            <td class="text-right">
                                                <a class="btn btn-info btn-xs btn-labeled fa fa-check" data-toggle="tooltip"
                                                    onclick="ajax_modal('view','<?php echo translate('view_payment_details'); ?>','<?php echo translate('successfully_viewed!'); ?>','ad_payment_view','<?php echo $row['advertisement_payment_id']; ?>')" data-original-title="View" data-container="body">
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
    var module = 'payments';
    var list_cont_func = '';
    var dlt_cont_func = '';


function set_switchery() {
        $(".approval").each(function () {
            new Switchery($(this).get(0), {
                color: 'rgb(100, 189, 99)', secondaryColor: '#cc2424', jackSecondaryColor: '#c8ff77'});
            var changeCheckbox = $(this).get(0);
            var false_msg = $(this).data('fm');
            var true_msg = $(this).data('tm');
            changeCheckbox.onchange = function () {
                $.ajax({url: base_url + '' + user_type + '/' + module + '/approval/' + $(this).data('set') + '/' + changeCheckbox.checked,
                    success: function (result) {
                        if (changeCheckbox.checked == true) {
                            $.activeitNoty({
                                type: 'success',
                                icon: 'fa fa-check',
                                message: true_msg,
                                container: 'floating',
                                timer: 3000
                            });
                            sound('approved');
                        } else {
                            $.activeitNoty({
                                type: 'danger',
                                icon: 'fa fa-check',
                                message: false_msg,
                                container: 'floating',
                                timer: 3000
                            });
                            sound('postponed');
                        }
                    }
                });
            };
        });
    }
</script>
