<?php
foreach ($blog_data as $row) {
    ?>
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <div class="panel-body">
                <center>
                    <h1 class="page-header text-overflow">
                        <?php echo translate('headline'); ?>: <?php echo $row['title']; ?>
                    </h1>
                </center>
                <table class="table table-striped" style="border-radius:3px;">
                    <tr>
                        <th class="custom_td">
                            <?php echo translate('blog_date'); ?>
                        </th>
                        <td class="custom_td">
                            <?php echo date("F j, Y", $row['date']); ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="custom_td">
                            <?php echo translate('uploaded_date'); ?>
                        </th>
                        <td class="custom_td">
                            <?php echo date("F j, Y, g:i a", $row['timestamp']); ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="custom_td">
                            <?php echo translate('uploaded_by'); ?>
                        </th>
                        <td class="custom_td">
                            <?php if($row['blog_uploader_type'] == 'admin'){ echo translate('admin'); } else { ?>
                                <?php echo $this->db->get_where('user', array('user_id' => $row['blog_uploader_id']))->row()->firstname; ?>
                            <?php }?>				
                        </td>
                    </tr>
                    <?php
                    $edited_by = json_decode($row['edited_by'], true);
                    foreach ($edited_by as $row2) {
                        if (!empty($row2['admin'])) {
                        ?>
                            <tr>
                                <th class="custom_td">
                                    <?php echo translate('last_updated_history'); ?>
                                </th>
                                <td class="custom_td">
                                    <?php echo $this->db->get_where('admin', array('admin_id' => $row2['admin']))->row()->name; ?>
                                    <br />
                                    <?php echo translate('date'); ?>:<?php echo date('d M,Y', $row2['timestamp']); ?>
                                </td>
                            </tr>
                        <?php
                        }
                    }
                    ?>

                    <tr>
                        <th class="custom_td">
                            <?php echo translate('blog_category'); ?>
                        </th>
                        <td class="custom_td">
                            <?php echo $this->db->get_where('blog_category', array('blog_category_id' => $row['blog_category_id']))->row()->name; ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="custom_td">
                            <?php echo translate('no_of_viewers'); ?>
                        </th>
                        <td class="custom_td">
                            <?php if($row['view_count'] == '')echo 0;else echo $row['view_count'];?>
                        </td>
                    </tr>
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
