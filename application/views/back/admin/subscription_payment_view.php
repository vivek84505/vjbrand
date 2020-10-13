<?php
    $payment_details = $this->db->get_where('subscription_payment',array('subscription_payment_id' => $payment_id))->row();
?>
<div>
     <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <?php
                    if($payment_details->payment_status == 'paid'){
                ?>
                <tr>
                    <td><?php echo translate('user');?></td>
                    <td>
                        <?php
                            $user = $this->db->get_where('user',array('user_id' => $payment_details->user_id))->row();
                            if($user != null)
                                echo $user->firstname;
                        ?>
                    </td>
                </tr>
                <tr>
                    <td><?php echo translate('amount');?></td>
                    <td><?php echo currency('','def').$payment_details->amount; ?></td>
                </tr>

                <tr>
                    <td><?php echo translate('purchase_datetime');?> </td>
                    <td><?php echo date('d M,Y',$payment_details->purchase_datetime); ?></td>
                </tr>

                <tr>
                    <td><?php echo translate('payment_datetime');?> </td>
                    <td><?php echo date('d M,Y',$payment_details->payment_timestamp); ?></td>
                </tr>

                <tr>
                    <td><?php echo translate('payment_type');?></td>
                    <td><?php echo $payment_details->payment_type; ?></td>
                </tr>
                <tr>
                    <td><?php echo translate('details');?></td>
                    <td><?php echo $payment_details->payment_details; ?></td>
                </tr>
                <?php
                    }
                    else{
                ?>
                <tr>
                    <td><?php echo translate('user');?></td>
                    <td>
                        <?php
                            $user = $this->db->get_where('user',array('user_id' => $payment_details->user_id))->row();
                            if($user != null)
                                echo $user->firstname;
                        ?>
                    </td>
                </tr>
                <tr>
                    <td><?php echo translate('amount');?></td>
                    <td>$<?php echo $payment_details->amount; ?></td>
                </tr>
                <tr>
                    <td><?php echo translate('payment_status');?></td>
                    <td><?php echo $payment_details->payment_status; ?></td>
                </tr>
                <?php
                    }
                ?>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('.modal-content').find('.enterer').hide();
    });
</script>
