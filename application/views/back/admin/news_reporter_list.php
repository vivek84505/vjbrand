<div class="panel-body" id="demo_s">
    <table id="demo-table" class="table table-striped"  data-pagination="true" data-show-refresh="true" data-ignorecol="0,6" data-show-toggle="false" data-show-columns="false" data-search="true" >
        <thead>
            <tr>
                <th><center>#</center></th>
        <th><center><?php echo translate('image'); ?></center></th>
        <th><center><?php echo translate('name'); ?></center></th>
        <th><center><?php echo translate('total_no_of_uploaded_news'); ?></center></th>
        <th><center><?php echo translate('total_no_of_uploaded_news_in_current_month'); ?></center></th>
        <th class="text-right"><?php echo translate('options'); ?></th>
        </tr>
        </thead>

        <tbody >
            <?php
            $i = 0;
            foreach ($all_news_reporters as $row) {
                $images = json_decode($this->db->get_where('news_reporter', array('news_reporter_id' => $row['news_reporter_id']))->row()->image, true);
                $i++;
                ?>
                <tr>
                    <td><center><?php echo $i; ?></center></td>
            <td>
            <?php
                if (file_exists('uploads/news_reporter_image/' . $images[0]['thumb'])) {
                    ?>
                    <center>
                        <img class="img-responsive img-border img-sm img-circle" src="<?php echo base_url(); ?>uploads/news_reporter_image/<?php echo $images[0]['thumb']; ?>"  />
                    </center>
                    <?php
                } else {
                    ?>
                    <center>
                        <img class="img-responsive img-border img-sm img-circle" src="<?php echo base_url(); ?>uploads/news_reporter_image/default.jpg"  >

                    </center>
                    <?php
                }
            ?>
            </td>
            <td><center><?php echo $row['name']; ?></center></td>
            <td>
            <center>
                <?php echo $this->db->get_where('news', array('news_reporter_id' => $row['news_reporter_id']))->num_rows(); ?>
            </center>
            </td>

            <td><center>
                <?php
                $query = $this->db->query("select * from news where month(date) = month(NOW()) and news_reporter_id = '" . $row['news_reporter_id'] . "' ");
                echo $query->num_rows();
                ?>
            </center></td>

            <td class="text-right">
                <?php
                if ($row['admin_status'] == 0) {
                    ?>
                    <a class="btn btn-success btn-xs btn-labeled fa fa-check" data-toggle="tooltip"
                       onclick="ajax_modal('make_admin', '<?php echo translate('make_admin'); ?>', '<?php echo translate('successfully_added!'); ?>', 'make_admin', '<?php echo $row['news_reporter_id']; ?>')"
                       data-original-title="Edit" data-container="body">
                           <?php echo translate('make_admin'); ?>
                    </a>
                    <?php
                }
                ?>
                <a class="btn btn-primary btn-xs btn-labeled fa fa-user" data-toggle="tooltip"
                   onclick="ajax_modal('view', '<?php echo translate('news_reporter_profile'); ?>', '', 'news_reporter_view', '<?php echo $row['news_reporter_id']; ?>')"
                   data-original-title="Edit" data-container="body">
                       <?php echo translate('profile'); ?>
                </a>

                <a class="btn btn-info btn-xs btn-labeled fa fa-wrench" data-toggle="tooltip"
                   onclick="ajax_set_full('edit', '<?php echo translate('edit_news_reporter'); ?>', '<?php echo translate('successfully_edited!'); ?>', 'news_reporter_edit', '<?php echo $row['news_reporter_id']; ?>', proceed('to_list'))" data-original-title="Edit" data-container="body">
                       <?php echo translate('edit'); ?>
                </a>

                <a onclick="delete_confirm('<?php echo $row['news_reporter_id']; ?>', '<?php echo translate('really_want_to_delete_this?'); ?>')"
                   class="btn btn-danger btn-xs btn-labeled fa fa-trash" data-toggle="tooltip" data-original-title="Delete" data-container="body">
                    <?php echo translate('delete'); ?>
                </a>
            </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
</div>
