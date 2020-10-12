<div class="panel-body" id="demo_s">
    <table id="demo-table" class="table table-striped"  data-pagination="true" data-show-refresh="true" data-ignorecol="0,2" data-show-toggle="true" data-show-columns="false" data-search="true" >

        <thead>
            <tr>
                <th><center><?php echo translate('no'); ?></center></th>
        <th><center><?php echo translate('name'); ?></center></th>
        <th class="text-right"><center><?php echo translate('options'); ?></center></th>
        </tr>
        </thead>

        <tbody >
            <?php
            $i = 0;
            foreach ($all_news_specialities as $row) {
                $i++;
                ?>
                <tr>
                    <td><center><?php echo $i; ?><center></td>
                    <td><center><?php echo $row['name']; ?></center></td>
                    <td class="text-right">
                    <center>
                        <a class="btn btn-info btn-xs btn-labeled fa fa-wrench" data-toggle="tooltip" 
                           onclick="ajax_modal('edit', '<?php echo translate('edit_news_speciality'); ?>', '<?php echo translate('successfully_edited!'); ?>', 'news_speciality_edit', '<?php echo $row['news_speciality_id']; ?>')" 
                           data-original-title="Edit" data-container="body">
                               <?php echo translate('edit'); ?>
                        </a>
                        <a style="display:none;" onclick="delete_confirm('<?php echo $row['news_speciality_id']; ?>', '<?php echo translate('really_want_to_delete_this?'); ?>')" class="btn btn-danger btn-xs btn-labeled fa fa-trash" data-toggle="tooltip" 
                           data-original-title="Delete" data-container="body">
                               <?php echo translate('delete'); ?>
                        </a>
                    </center>
                    </td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
                </table>
                </div>

