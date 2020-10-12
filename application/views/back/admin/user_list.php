<div class="panel-body" id="demo_s">
    <table id="demo-table" class="table table-striped"  data-pagination="true" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" >
        <thead>
            <tr>
                <th><?php echo translate('no'); ?></th>
                <th><?php echo translate('image'); ?></th>
                <th><?php echo translate('name'); ?></th>
                <th><?php echo translate('email'); ?></th>
                <th><?php echo translate('user_since'); ?></th>
                <th class="text-right"><?php echo translate('options'); ?></th>
            </tr>
        </thead>				
        <tbody >
            <?php
            $i = 0;
            foreach ($all_users as $row) {
                $i++;
                ?>                
                <tr>
                    <td><?php echo $i; ?></td>
                    <td>
                        <img class="img-sm img-circle img-border" src="<?php echo $this->Crud_model->file_view('user', $row['user_id'], '100', '100', 'no', 'src', '', '', '.jpg'); ?>" />
                    </td>
                    <td><?php echo $row['firstname'] . ' ' . $row['lastname']; ?>
                        <?php if($row['is_blogger'] == 'yes') {?>
                        <label class="label label-dark pull-right">
                            <?=translate('blogger')?>                                       
                        </label>
                        <?php
                            }
                        ?>
                    </td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo date('d M, Y', $row['creation_date']); ?></td>
                    <td class="text-right">
                        <?php if($row['is_blogger'] == 'yes') {?>
                        <a class="btn btn-dark btn-xs btn-labeled fa fa-eye" href = "<?=base_url()?>home/blogger_description/<?=$row['user_id']?>" target = "_blank" data-toggle="tooltip" data-original-title="<?=translate('blogs')?>" data-container="body">
                               <?php echo translate('blogs'); ?>
                        </a>
                        <?php
                            }
                        ?>
                        <a class="btn btn-mint btn-xs btn-labeled fa fa-user" data-toggle="tooltip" 
                           onclick="ajax_modal('view', '<?php echo translate('view_profile'); ?>', '<?php echo translate('successfully_viewed!'); ?>', 'user_view', '<?php echo $row['user_id']; ?>')" data-original-title="View" data-container="body">
                               <?php echo translate('profile'); ?>
                        </a>
                        <a onclick="delete_confirm('<?php echo $row['user_id']; ?>', '<?php echo translate('really_want_to_delete_this?'); ?>')" class="btn btn-xs btn-danger btn-labeled fa fa-trash" data-toggle="tooltip" 
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

<div id='export-div' style="padding:40px;">
    <h1 id ='export-title' style="display:none;"><?php echo translate('users'); ?></h1>
    <table id="export-table" class="table" data-name='users' data-orientation='p' data-width='1500' style="display:none;">
        <colgroup>
            <col width="50">
            <col width="150">
            <col width="150">
            <col width="150">
        </colgroup>
        <thead>
            <tr>
                <th><?php echo translate('no'); ?></th>
                <th><?php echo translate('name'); ?></th>
                <th><?php echo translate('e-mail'); ?></th>
            </tr>
        </thead>



        <tbody >
            <?php
            $i = 0;
            foreach ($all_users as $row) {
                $i++;
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $row['username']; ?> <?php echo $row['surname']; ?></td>
                    <td><?php echo $row['email']; ?></td>           	
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>
