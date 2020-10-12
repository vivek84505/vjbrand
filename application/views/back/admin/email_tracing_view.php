<?php
foreach ($email_tracing_data as $row) {
    ?>
    <div id="content-container" style="padding-top:0px !important;">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel-body">
                    <table class="table table-striped" style="border-radius:3px;">
                        <tr>
                            <th class="custom_td"><?php echo translate('email'); ?></th>
                            <td class="custom_td"><?php echo $row['email']; ?></td>
                        </tr>
                        <tr>
                            <th class="custom_td"><?php echo translate('phone'); ?></th>
                            <td class="custom_td">
                                <?php echo $row['phone'] ?>
                            </td>
                        </tr>
                        <tr>
                            <th class="custom_td"><?php echo translate('massage'); ?></th>
                            <td class="custom_td">
                                <?php echo $row['massage'] ?>
                            </td>
                        </tr>
                        <tr>
                            <th class="custom_td"><?php echo translate('product'); ?></th>
                            <td class="custom_td"><a href="<?php echo base_url(); ?>home/product_view/<?php echo $row['product'] ?>" target="_blank"><?php echo $this->Crud_model->get_type_name_by_id('product', $row['product'], 'title'); ?></a></td>
                        </tr>

                        <tr>
                            <th class="custom_td"><?php echo translate('product_owner'); ?></th>
                            <td class="custom_td">
                                <?php
                                if ($row['product_owner'] !== 'guest') {
                                    echo $this->Crud_model->get_type_name_by_id('user', $row['product_owner'], 'username');
                                } else {
                                    echo translate('email') . ': ';
                                    echo $this->Crud_model->get_type_name_by_id('product', $row['product'], 'email');
                                    echo '<br>' . translate('phone') . ': ';
                                    echo $this->Crud_model->get_type_name_by_id('product', $row['product'], 'phone');
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <th class="custom_td"><?php echo translate('date'); ?></th>
                            <td class="custom_td"><?php echo $row['date'] ?></td>
                        </tr>
                        <tr>
                            <th class="custom_td"><?php echo translate('sender_info'); ?></th>
                            <td class="custom_td">
                                <?php
                                if ($row['sender_info'] !== '') {
                                    $info = json_decode($row['sender_info'], true);
                                    foreach ($info as $i => $row1) {
                                        echo '<b>' . $i . '</b> :' . $row1 . '<br>';
                                    }
                                }
                                ?>
                            </td>
                        </tr>

                    </table>
                </div>
            </div>
        </div>					
    </div>					
    <?php
}
?>

<style>
    .custom_td{
        border-left: 1px solid #ddd;
        border-right: 1px solid #ddd;
        border-bottom: 1px solid #ddd;
    }
</style>