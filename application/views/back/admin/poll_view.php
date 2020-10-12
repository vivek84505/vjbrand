<?php
foreach ($poll_data as $row) {
    ?>
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
            <div class="panel-body">
                <table class="table table-striped" style="border-radius:3px;">
                    <tr>
                        <th class="custom_td"><?php echo translate('Question'); ?></th>
                        <td class="custom_td"><?php echo $row['question']; ?></td>
                    </tr>



                    <?php
                    $key_features = json_decode($row['options'], true);
                    foreach ($key_features as $row1) {
                        ?>

                        <tr>
                            <th class="custom_td"><?php echo translate('Options'); ?></th>
                            <td class="custom_td"> 
                                <?php echo $row1['title']; ?> 

                            </td>
                        </tr>
                    <?php } ?>

                    <tr>
                        <th class="custom_td"><?php echo translate('Uploaded By'); ?></th>
                        <td class="custom_td"><?php echo $this->db->get_where('admin', array('admin_id' => $row['uploader']))->row()->name; ?></td>
                    </tr>

                    <?php
                    $key_features = json_decode($row['edited_by'], true);
                    foreach ($key_features as $row2) {
                        ?>

                        <tr>
                            <th class="custom_td"><?php echo translate('Edits History'); ?></th>
                            <td class="custom_td"> 

                                <?php echo $this->db->get_where('admin', array('admin_id' => $row2['admin']))->row()->name; ?>
                                <br />
                                Date: <?php echo date('d M ,Y', $row2['timestamp']); ?>
                                <br />
                                Time: <?php echo date('h:i A', $row2['timestamp']); ?>
                            </td>
                        </tr>
                    <?php } ?>




                </table>
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