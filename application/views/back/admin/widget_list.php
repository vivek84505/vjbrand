<div class="panel-body" id="demo_s">
    <table id="demo-table" class="table table-striped"  data-pagination="true" data-show-refresh="true" data-ignorecol="0,2" data-show-toggle="true" data-show-columns="false" data-search="true" >

        <thead>
            <tr>
                <th><?php echo translate('no'); ?></th>
                <th><?php echo translate('title'); ?></th>
                <th><?php echo translate('status'); ?></th>
                <th class="text-right"><?php echo translate('options'); ?></th>
            </tr>
        </thead>

        <tbody >
            <?php
            $i = 0;
            foreach ($all_widgets as $row) {
                $i++;
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td>
                        <?php
                        if ($row['widget_id'] == '1') {
                            echo translate('category');
                        } else if ($row['widget_id'] == '2') {
                            echo translate('advanced_search');
                        } else if ($row['widget_id'] == '3') {
                            echo translate('recently_viewed');
                        } else if ($row['widget_id'] == '4') {
                            echo translate('most_popular');
                        } else {
                            echo $row['title'];
                        }
                        ?>
                    </td>
                    <td>
                        <input id="wid_<?php echo $row['widget_id']; ?>" class='sw' type="checkbox" data-id='<?php echo $row['widget_id']; ?>' data-set="status" <?php if ($row['status'] == 'ok') { ?>checked<?php } ?> />
                    </td>
                    <td class="text-right">
                        <?php if ($i > 4) { ?>
                            <a class="btn btn-success btn-xs btn-labeled fa fa-wrench" data-toggle="tooltip" 
                               onclick="ajax_modal('edit', '<?php echo translate('edit_widget'); ?>', '<?php echo translate('successfully_edited!'); ?>', 'widget_edit', '<?php echo $row['widget_id']; ?>')" 
                               data-original-title="Edit" data-container="body">
                                   <?php echo translate('edit'); ?>
                            </a>
                            <a onclick="delete_confirm('<?php echo $row['widget_id']; ?>', '<?php echo translate('really_want_to_delete_this?'); ?>')" class="btn btn-danger btn-xs btn-labeled fa fa-trash" data-toggle="tooltip" 
                               data-original-title="Delete" data-container="body">
                                   <?php echo translate('delete'); ?>
                            </a>
                        <?php } ?>
                    </td>  
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>

<div id='export-div'>
    <h1 style="display:none;"><?php echo translate('widget'); ?></h1>
    <table id="export-table" data-name='widget' data-orientation='p' style="display:none;">
        <thead>
            <tr>
                <th><?php echo translate('no'); ?></th>
                <th><?php echo translate('title'); ?></th>
                <th><?php echo translate('status'); ?></th>
            </tr>
        </thead>

        <tbody >
            <?php
            $i = 0;
            foreach ($all_widgets as $row) {
                $i++;
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td>
                        <?php
                        if ($row['widget_id'] == '1') {
                            echo translate('category');
                        } else if ($row['widget_id'] == '2') {
                            echo translate('advanced_search');
                        } else if ($row['widget_id'] == '3') {
                            echo translate('recently_viewed');
                        } else if ($row['widget_id'] == '4') {
                            echo translate('most_popular');
                        } else {
                            echo $row['title'];
                        }
                        ?>
                    </td>
                    <td><?php echo $row['status']; ?></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>

