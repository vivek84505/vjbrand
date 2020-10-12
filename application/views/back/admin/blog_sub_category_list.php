<div class="panel-body" id="demo_s">
    <table id="demo-table" class="table table-striped"  data-pagination="true" data-show-refresh="true" data-ignorecol="0,3" data-show-toggle="true" data-show-columns="false" data-search="true" >
        <thead>
            <tr>
                <th><?php echo translate('no'); ?></th>
                <th><?php echo translate('name'); ?></th>
                <th><?php echo translate('blog_category'); ?></th>
                <th class="text-right"><?php echo translate('options'); ?></th>
            </tr>
        </thead>                
        <tbody >
            <?php
            $i = 0;
            foreach ($all_sub_categories as $row) {
                $i++;
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $this->Crud_model->get_field('blog_category', $row['parent_category_id'], 'name'); ?></td>
                    <td class="text-right">
                        <a class="btn btn-info btn-xs btn-labeled fa fa-wrench" data-toggle="tooltip" 
                           onclick="ajax_modal('edit', '<?php echo translate('edit_sub-category'); ?>', '<?php echo translate('successfully_edited!'); ?>', 'blog_sub_category_edit', '<?php echo $row['blog_sub_category_id']; ?>')" data-original-title="Edit" data-container="body">
                               <?php echo translate('edit'); ?>
                        </a>
                        <a onclick="delete_confirm('<?php echo $row['blog_sub_category_id']; ?>', '<?php echo translate('really_want_to_delete_this?'); ?>')" 
                           class="btn btn-danger btn-xs btn-labeled fa fa-trash" data-toggle="tooltip"
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
    <h1 style="display:none;"><?php echo translate('blog_sub_category'); ?></h1>
    <table id="export-table" data-name='sub_category' data-orientation='p' style="display:none;">
        <thead>
            <tr>
                <th><?php echo translate('no'); ?></th>
                <th><?php echo translate('name'); ?></th>
                <th><?php echo translate('blog_category'); ?></th>
            </tr>
        </thead>

        <tbody >
            <?php
            $i = 0;
            foreach ($all_sub_categories as $row) {
                $i++;
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $this->Crud_model->get_field('blog_category', $row['parent_category_id'], 'name'); ?></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>
