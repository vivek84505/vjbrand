<div class="panel-body" id="demo_s">
    <table id="demo-table" class="table table-striped"  data-pagination="true" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" >
        <thead>
            <tr>
                <th><?php echo translate('no'); ?></th>
                <th><?php echo translate('email'); ?></th>
                <th class="text-right"><?php echo translate('options'); ?></th>
            </tr>
        </thead>				
        <tbody >
            <?php
            $i = 0;
            foreach ($all_email_tracings as $row) {
                $i++;
                ?>                
                <tr>
                    <td><?php echo $i; ?></td>

                    <td><?php echo $row['email']; ?></td>
                    <td class="text-right">
                        <a class="btn btn-mint btn-xs btn-labeled fa fa-location-arrow" data-toggle="tooltip" 
                           onclick="ajax_modal('view', '<?php echo translate('view_email_tracing'); ?>', '<?php echo translate('successfully_viewed!'); ?>', 'email_tracing_view', '<?php echo $row['email_tracing_id']; ?>')" data-original-title="View" data-container="body">
                               <?php echo translate('Email_tracing'); ?>
                        </a>

                        <a onclick="delete_confirm('<?php echo $row['email_tracing_id']; ?>', '<?php echo translate('really_want_to_delete_this?'); ?>')" class="btn btn-xs btn-danger btn-labeled fa fa-trash" data-toggle="tooltip" 
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

                <th><?php echo translate('e-mail'); ?></th>
            </tr>
        </thead>



        <tbody >
            <?php
            $i = 0;
            foreach ($all_email_tracings as $row) {
                $i++;
                ?>
                <tr>
                    <td><?php echo $i; ?></td>

                    <td><?php echo $row['email']; ?></td>          	
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>
