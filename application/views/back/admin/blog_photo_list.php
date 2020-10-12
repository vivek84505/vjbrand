<div class="panel-body" id="demo_s">
    <table id="demo-table" class="table table-striped"  data-pagination="true" data-show-refresh="true" data-ignorecol="0,6" data-show-toggle="false" data-show-columns="false" data-search="true" >
        <thead>
            <tr>
                <th data-align="center">#</th>
                <th data-align="center"><?php echo translate('photo'); ?></th>
                <th data-align="center"><?php echo translate('uploader'); ?></th>
                <th data-align="center"><?php echo translate('title'); ?></th>
                <th data-align="center"><?php echo translate('status'); ?></th>
                <th data-align="center" class="text-right"><center><?php echo translate('options'); ?></center></th>
        </tr>
        </thead>

        <tbody>
            <?php
            $i = 0;
            foreach ($photo_list as $row) {
                $i++;
                ?>
                <tr>
                    <td>
                        <?php echo translate($i); ?>
                    </td>
                    <td>
                        <?php
                            $img_features = json_decode($row['img_features'], true);
                            if(isset($img_features[0]['thumb'])){
                                $thumb = $img_features[0]['thumb'];
                            }
                            if(!file_exists('uploads/blog_photo_image/'.$thumb)){
                                $thumb = 'default.jpg';
                            }
                        ?>
                        <img class="img-sm thumbnail" src="<?php echo base_url().'uploads/blog_photo_image/'.$thumb; ?>" />
                    </td>
                    <td>
                        <?php if($row['blog_photo_uploader_type'] == 'admin') { echo translate('admin'); } else { echo translate('user'); }  ?>
                    </td>
                    <td>
                        <?php echo $row['title']; ?>
                    </td>
                    <td>
                    <center>
                        <input class='aiz_switchery' type="checkbox" id="sw"
                               data-set='status'
                               data-id='<?php echo $row['blog_photo_id']; ?>'
                               data-tm='<?php echo translate('photo_published'); ?>'
                               data-fm='<?php echo translate('photo_unpublished'); ?>'
                               <?php if ($row['status'] == 'published') { ?>checked<?php } ?> />
                    </center>
                    </td>
            <td class="text-right">
            <center>
                <a class="btn btn-info btn-xs btn-labeled fa fa-wrench" data-toggle="tooltip"
                   onclick="ajax_set_full('edit', '<?php echo translate('edit_photo'); ?>', '<?php echo translate('successfully_edited!'); ?>', 'blog_photo_edit', '<?php echo $row['blog_photo_id']; ?>', proceed('to_list'))" data-original-title="Edit" data-container="body">
                       <?php echo translate('edit'); ?>
                </a>

                <a onclick="delete_confirm('<?php echo $row['blog_photo_id']; ?>', '<?php echo translate('really_want_to_delete_this?'); ?>')"
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
