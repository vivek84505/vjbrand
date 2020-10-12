<div id="table3">
    <table class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th><?php echo translate('no')?></th>
                <th width="10%"><?php echo translate('video'); ?></th>
                <th width="40%"><?php echo translate('title'); ?></th>
                <th width="20%"><?php echo translate('date'); ?></th>
                <th width="10%"><?php echo translate('hide_blog'); ?></th>
                <th><?php echo translate('option'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php
                $i=1;
                foreach($blog_video_list as $video) { ?>
                    <tr>
                        <td><?php echo $cur_page+$i;?></td>
                        <td>
                            <?php if ($video['type'] == 'upload') { ?>
                                <video width="100" height="70">
                                    <source src="<?php echo base_url(); ?><?php echo $video['video_src']; ?>">
                                </video>
                            <?php } else { ?>
                                <iframe width="100" height="70" src="<?php echo $video['video_src']; ?>" frameborder="0" >
                                </iframe>
                            <?php } ?>
                            
                        </td>  
                        <td><?=$video['title']?></td>
                        <td><?=date('d/m/Y h:m A', $video['timestamp'])?></td>
                        <td>
                            <input class='aiz_switchery' type='checkbox' data-set="hide_status_video" data-id="<?php echo $video['blog_video_id'];?>" <?php if($video['hide_status'] == 'true'){echo 'checked';}?> data-tm="<?php echo translate('the_blog_video_is_successfully_hidden')?>" data-fm="<?php echo translate('successfully_published_the_blog_video')?>"/>
                        </td>
                        <td>
                            <a onclick="edit_blog_video('<?php echo $video['blog_video_id'];?>');" id="edit_blog_video" data-toggle="tooltip" title="Edit" class="btn btn-blue btn-sm"><i class="fa fa-wrench"></i></a>
                            <a data-burl="<?php echo base_url() ?>home/profile/blog_video_delete/<?php echo $video['blog_video_id'];?>" data-inside="blog_video_list" title="Delete Blog Photo" class="remove_data btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php
                $i++;
                }
            ?>
        </tbody>
    </table>
</div>
<!-- Pagination -->
<div class="pagination-wrapper">
    <?php echo $this->ajax_pagination->create_links();  ?>
</div>
<!-- /Pagination -->
<script>
    $(document).ready(function () {
        load_iamges();
        $('#table3').each(function(e){
            set_switchery_blog_video();
        });
    });
</script>