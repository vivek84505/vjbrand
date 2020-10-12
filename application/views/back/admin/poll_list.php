<div class="panel-body" id="demo_s">
    <table id="demo-table" class="table table-striped"  data-pagination="true" data-show-refresh="true" data-ignorecol="0,6" data-show-toggle="false" data-show-columns="false" data-search="true" >
        <thead>
            <tr>
                <th><center><?php echo translate('no'); ?></center></th>
        <th><center><?php echo translate('question'); ?></th>
            <th><center><?php echo translate('status'); ?></th>		
                <th class="text-right"><center><?php echo translate('options'); ?></th>
                    </tr>
                    </thead>

                    <tbody>
                        <?php
                        $i = 0;
                        foreach ($all_polls as $row) {
                            $i++;
                            ?>
                            <tr>
                                <td><center><?php echo $i; ?></center></td>
                        <td><center><?php echo limit_chars($row['question'], 230); ?></center></td>
                        <td>
                        <center>
                            <input class='aiz_switchery' type="checkbox" 
                                   data-set='status' 
                                   data-id='<?php echo $row['poll_id']; ?>' 
                                   data-tm='<?php echo translate('poll_published'); ?>' 
                                   data-fm='<?php echo translate('poll_unpublished'); ?>' 
                                   <?php if ($row['status'] == 'published') { ?>checked<?php } ?> />
                        </center>
                        </td>

                        <td class="text-right">
                        <center>
                            <a class="btn btn-primary btn-xs btn-labeled fa fa-eye" data-toggle="tooltip" 
                               onclick="ajax_set_full('view', '<?php echo translate('view_poll'); ?>', '<?php echo translate(''); ?>', 'poll_view', '<?php echo $row['poll_id']; ?>', proceed('to_list'))" data-original-title="View" data-container="body">
                                   <?php echo translate('Preview'); ?>
                            </a>

                            <a class="btn btn-info btn-xs btn-labeled fa fa-wrench" data-toggle="tooltip" 
                               onclick="ajax_set_full('edit', '<?php echo translate('edit_poll'); ?>', '<?php echo translate('successfully_edited!'); ?>', 'poll_edit', '<?php echo $row['poll_id']; ?>', proceed('to_list'))" data-original-title="Edit" data-container="body">
                                   <?php echo translate('edit'); ?>
                            </a>
                            <a onclick="delete_confirm('<?php echo $row['poll_id']; ?>', '<?php echo translate('really_want_to_delete_this?'); ?>')" 
                               class="btn btn-danger btn-xs btn-labeled fa fa-trash" data-toggle="tooltip" data-original-title="Delete" data-container="body">
                                <?php echo translate('delete'); ?>
                            </a>
                            <center>
                                </td>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                            </table>
                            </div>
                            <script>
                                function set_switchery() {
                                    $(".aiz_switchery").each(function () {
                                        new Switchery($(this).get(0), {color: 'rgb(100, 189, 99)', secondaryColor: '#cc2424', jackSecondaryColor: '#c8ff77'});
                                        var changeCheckbox = $(this).get(0);
                                        var false_msg = $(this).data('fm');
                                        var true_msg = $(this).data('tm');

                                        changeCheckbox.onchange = function () {
                                            $('#sw').load(base_url + '' + user_type + '/' + module + '/' + $(this).data('set') + '/' + $(this).data('id') + '/' + changeCheckbox.checked);

                                            if (changeCheckbox.checked == true) {
                                                $.activeitNoty({
                                                    type: 'success',
                                                    icon: 'fa fa-check',
                                                    message: true_msg,
                                                    container: 'floating',
                                                    timer: 3000
                                                });
                                                sound('published');
                                            } else {
                                                $.activeitNoty({
                                                    type: 'danger',
                                                    icon: 'fa fa-check',
                                                    message: false_msg,
                                                    container: 'floating',
                                                    timer: 3000
                                                });
                                                sound('unpublished');
                                            }
                                        };
                                    });
                                }
                            </script>
