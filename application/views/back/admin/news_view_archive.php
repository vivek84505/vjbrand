
<div class="col-md-12" style="border-bottom: 1px solid #ebebeb;padding: 5px;">
    <button class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn"  onclick="ajax_set_list();"><?php echo translate('back_to_list'); ?>
    </button>
</div>

<?php
foreach ($news_data as $row) {
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
                            <?php echo translate('news_date'); ?>
                        </th>
                        <td class="custom_td">
                            <?php echo date("F j, Y", $row['date']); ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="custom_td">
                            <?php echo translate('Uploaded date'); ?>
                        </th>
                        <td class="custom_td">
                            <?php echo date("F j, Y, g:i a", $row['timestamp']); ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="custom_td">
                            <?php echo translate('Uploaded by'); ?>
                        </th>
                        <td class="custom_td">
                            <?php echo $this->db->get_where('admin', array('admin_id' => $row['news_uploader_id']))->row()->name; ?>					
                        </td>
                    </tr>
                    <?php
                    $edited_by = json_decode($row['edited_by'], true);
                    foreach ($edited_by as $row2) {
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
                    <?php } ?>
                    <tr>
                        <th class="custom_td">
                            <?php echo translate('news_speciality'); ?>
                        </th>
                        <td class="custom_td">
                            <?php echo $this->db->get_where('news_speciality', array('news_speciality_id' => $row['news_speciality_id']))->row()->name; ?>	
                        </td>
                    </tr>
                    <tr>
                        <th class="custom_td">
                            <?php echo translate('news_category'); ?>
                        </th>
                        <td class="custom_td">
                            <?php echo $this->db->get_where('news_category', array('news_category_id' => $row['news_category_id']))->row()->name; ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="custom_td">
                            <?php echo translate('no_of_viewers'); ?>
                        </th>
                        <td class="custom_td">
                            <?php echo $row['view_count'] ?>
                        </td>
                    </tr>
                    <?php
                    $archived_by = json_decode($row['archived_by'], true);
                    foreach ($archived_by as $row2) {
                        ?>
                        <tr>
                            <th class="custom_td">
                                <?php echo translate('archive_history'); ?>
                            </th>
                            <td class="custom_td"> 
                                <?php echo $this->db->get_where('admin', array('admin_id' => $row2['admin']))->row()->name; ?>
                                <br />
                                <?php echo translate('date'); ?>:<?php echo date('d M,Y', $row2['timestamp']); ?>
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