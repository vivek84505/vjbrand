<div class="panel-body" id="demo_s">
    <table id="demo-table" class="table table-striped"  data-pagination="true" data-show-refresh="true" data-ignorecol="0,6" data-show-toggle="false" data-show-columns="false" data-search="true" >
        <thead>
            <tr>
                <th data-align="center">No</th>
                <th data-align="center">Audio</th>
                <th data-align="center">Description</th>				
                <th class="text-right"><center><?php echo translate('options'); ?></center></th>
        </tr>
        </thead>

        <tbody>
            <?php
            $i = 0;
            foreach ($audio_list as $row) {
                $i++;
                ?>
                <tr>
                    <td>
                        <?php echo $i; ?>
                    </td>
                    <td>
                        <audio controls>
                            <source src="<?php echo base_url(); ?><?php echo $row['audio_src']; ?>" />
                        </audio>
                    </td>
                    <td>
                        <?php echo $row['description']; ?>
                    </td>
                    <td class="text-right">
            <center>
                <a class="btn btn-info btn-xs btn-labeled fa fa-wrench" data-toggle="tooltip" 
                   onclick="ajax_set_full('edit', '<?php echo translate('edit_audio'); ?>', '<?php echo translate('successfully_edited!'); ?>', 'audio_edit', '<?php echo $row['audio_id']; ?>', proceed('to_list'))" data-original-title="Edit" data-container="body">
                       <?php echo translate('edit'); ?>
                </a>

                <a onclick="delete_confirm('<?php echo $row['audio_id']; ?>', '<?php echo translate('really_want_to_delete_this?'); ?>')" 
                   class="btn btn-danger btn-xs btn-labeled fa fa-trash" data-toggle="tooltip" data-original-title="Delete" data-container="body">
                    <?php echo translate('delete'); ?>
                </a>
            </center>
            </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
