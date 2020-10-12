<div class="panel-body" id="demo_s">
    <table id="demo-table" class="table table-striped"  data-pagination="true" data-show-refresh="true" data-ignorecol="0,2" data-show-toggle="true" data-show-columns="false" data-search="true" >

        <thead>
            <tr>
                <th><?php echo translate('no'); ?></th>
                <th><?php echo translate('name'); ?></th>
                <th><?php echo translate('featured_for'); ?></th>
                <th><?php echo translate('shown_for'); ?></th>
                <th><?php echo translate('price'); ?></th>
                <th><?php echo translate('status'); ?></th>
                <th class="text-right"><?php echo translate('options'); ?></th>
            </tr>
        </thead>

        <tbody >
            <?php
            $i = 0;
            foreach ($all_product_types as $row) {
                $i++;
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td>
                        <?php
                        $data1 = json_decode($row['details']);
                        echo str_replace('-', ' ', $data1->f_for);
                        ?>
                    </td>

                    <td>
                        <?php
                        echo str_replace('-', ' ', $data1->s_for);
                        ?>
                    </td>
                    <td><?php echo $row['price']; ?></td>
                    <td><input class='aiz_switchery' type="checkbox" 
                               data-set='status' 
                               data-id='<?php echo $row['product_type_id']; ?>' 
                               data-tm='<?php echo translate('product_package_published'); ?>' 
                               data-fm='<?php echo translate('product_package_unpublished'); ?>' 
                               <?php if ($row['status'] == 'ok') { ?>checked<?php } ?> />
                    </td>
                    <td class="text-right">
                        <a class="btn btn-success btn-xs btn-labeled fa fa-wrench" data-toggle="tooltip" 
                           onclick="ajax_modal('edit', '<?php echo translate('edit_product_package'); ?>', '<?php echo translate('successfully_edited!'); ?>', 'product_type_edit', '<?php echo $row['product_type_id']; ?>')" 
                           data-original-title="Edit" data-container="body">
                               <?php echo translate('edit'); ?>
                        </a>
                        <a onclick="delete_confirm('<?php echo $row['product_type_id']; ?>', '<?php echo translate('really_want_to_delete_this?'); ?>')" class="btn btn-danger btn-xs btn-labeled fa fa-trash" data-toggle="tooltip" 
                           data-original-title="Delete" data-container="body">
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

<div id='export-div'>
    <h1 style="display:none;"><?php echo translate('product_package'); ?></h1>
    <table id="export-table" data-name='product_package' data-orientation='p' style="display:none;">
        <thead>
            <tr>
                <th><?php echo translate('no'); ?></th>
                <th><?php echo translate('name'); ?></th>
            </tr>
        </thead>

        <tbody >
            <?php
            $i = 0;
            foreach ($all_product_types as $row) {
                $i++;
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $row['name']; ?></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>

