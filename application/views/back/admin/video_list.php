<div class="panel-body" id="demo_s">
    <table id="demo-table" class="table table-striped"  data-pagination="true" data-show-refresh="true" data-ignorecol="0,6" data-show-toggle="false" data-show-columns="false" data-search="true" >
        <thead>
            <tr>
                <th data-align="center">#</th>
                <th data-align="center"><?php echo translate('video'); ?></th>
                <th data-align="center"><?php echo translate('title'); ?></th>
                <th data-align="center"><?php echo translate('video_source'); ?></th>	
                <th data-align="center"><?php echo translate('status'); ?></th>			
                <th class="text-right"><center><?php echo translate('options'); ?></center></th>
        </tr>
        </thead>

        <tbody >
            <?php
            $i = 0;
            foreach ($all_videos as $row) {
                $i++;
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td>
                        <?php if ($row['type'] == 'upload') { ?>
                            <video width="100" height="70">
                                <source src="<?php echo base_url(); ?><?php echo $row['video_src']; ?>">
                            </video>
                        <?php } else { ?>
                            <iframe width="100" height="70" src="<?php echo $row['video_src']; ?>" frameborder="0" >
                            </iframe>
                        <?php } ?>
                    </td>
                    <td>
                        <h5><?php echo word_limiter($row['title'], 10); ?></h5>
                    </td>
                    <td class="video_source">
                        <?php
                        if ($row['type'] == 'upload') {
                            ?>
                <center>
                    <i class="fa fa-upload" aria-hidden="true" title="<?php echo translate('local_pc'); ?>"></i>
                </center>
                <?php
            } else {
                if ($row['from'] == 'youtube') {
                    ?>
                    <center>
                        <i class="fa fa-youtube" aria-hidden="true" title="Youtube"></i>
                    </center>
                    <?php
                } else if ($row['from'] == 'vimeo') {
                    ?>
                    <center>
                        <i class="fa fa-vimeo" aria-hidden="true" title="Vimeo"></i>
                    </center>
                    <?php
                } else if ($row['from'] == 'dailymotion') {
                    ?>
                    <center>
                        <i class="fa fa-dailymotion" aria-hidden="true" title="Dailymotion">d</i>
                    </center>
                    <?php
                }
            }
            ?>
            </td>
            <td>
            <center>
                <input class='aiz_switchery' type="checkbox" id="sw"
                       data-set='status' 
                       data-id='<?php echo $row['video_id']; ?>' 
                       data-tm='<?php echo translate('video_published'); ?>' 
                       data-fm='<?php echo translate('video_unpublished'); ?>' 
                       <?php if ($row['status'] == 'published') { ?>checked<?php } ?> />
            </center>
            </td>
            <td class="text-right">
            <center>
                <a class="btn btn-info btn-xs btn-labeled fa fa-wrench" data-toggle="tooltip" 
                   onclick="ajax_set_full('edit', '<?php echo translate('edit_video'); ?>', '<?php echo translate('successfully_edited!'); ?>', 'video_edit', '<?php echo $row['video_id']; ?>', proceed('to_list'))" data-original-title="Edit" data-container="body">
                       <?php echo translate('edit'); ?>
                </a>

                <a onclick="delete_confirm('<?php echo $row['video_id']; ?>', '<?php echo translate('really_want_to_delete_this?'); ?>')" 
                   class="btn btn-danger btn-xs btn-labeled fa fa-trash" data-toggle="tooltip" data-original-title="Delete" data-container="body">
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
<style>
    .video_source i{
        font-size:36px;
    }
    .fa-youtube{
        color:#E62117;
    }
    .fa-vimeo{
        color:#00B3EC;
    }
    .fa-upload{
        color:#646FC7;
    }
    .fa-dailymotion{
        font-family: Righteous;
        color: #ffffff;
        background: #0066DC;
        padding: 2px 4px 2px 12px;
        font-weight: 700;
        cursor:default;
    }
</style>
<link href="https://fonts.googleapis.com/css?family=Righteous" rel="stylesheet">