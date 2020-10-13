<!-- blog list  -->
<div id="table2">
    <table class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th><?php echo translate('no')?></th>
                <th width="10%"><?php echo translate('image'); ?></th>
                <th width="40%"><?php echo translate('title'); ?></th>
                <th width="20%"><?php echo translate('date'); ?></th>
                <th width="10%"><?php echo translate('hide_blog'); ?></th>
                <th><?php echo translate('option'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php
                $i=1;
                foreach($blog_photo_list as $photo) { ?>
                    <tr>
                        <td><?php echo $cur_page+$i;?></td>
                        <td>
                            <?php
                                $image = json_decode($photo['img_features'], true);
                                if (isset($image[0]['thumb'])) {
                                ?>
                                    <img class="img-responsive img-thumbnail image_delay" style="width: 64px;height: 50px;" src="<?php echo img_loading(); ?>" data-src="<?php echo base_url();?>uploads/blog_photo_image/<?php echo $image[0]['thumb'];?>"/>
                                <?php
                                } else {
                                ?>
                                    <img class="img-responsive img-thumbnail image_delay" style="width: 64px;height: 50px;" src="<?php echo img_loading(); ?>" data-src="<?php echo base_url();?>uploads/blog_photo_image/default.jpg"/>
                                <?php
                                }
                            ?>

                        </td>
                        <td><?=$photo['title']?></td>
                        <td><?=date('d/m/Y h:m A', $photo['timestamp'])?></td>
                        <td>
                            <input class='aiz_switchery' type='checkbox' data-set="hide_status_photo" data-id="<?php echo $photo['blog_photo_id'];?>" <?php if($photo['hide_status'] == 'true'){echo 'checked';}?> data-tm="<?php echo translate('the_blog_photo_is_successfully_hidden')?>" data-fm="<?php echo translate('successfully_published_the_blog_photo')?>"/>
                        </td>
                        <td>
                            <a onclick="edit_blog_photo('<?php echo $photo['blog_photo_id'];?>');" id="edit_blog_photo" data-toggle="tooltip" title="Edit" class="btn btn-blue btn-sm"><i class="fa fa-wrench"></i></a>
                             <a data-burl="<?php echo base_url() ?>home/profile/blog_photo_delete/<?php echo $photo['blog_photo_id'];?>" data-inside="blog_image_list" title="Delete Blog Photo" class="remove_data btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php
                $i++;
                }
            ?>
        </tbody>
    </table>
</div>
<!-- /photo list -->

<!-- Pagination -->
<div class="pagination-wrapper">
    <?php echo $this->ajax_pagination->create_links();  ?>
</div>
<!-- /Pagination -->
<script>
    $(document).ready(function(){
        load_iamges();
        $('#table2').each(function(e){
            set_switchery_blog_photo();
        });
    });
</script>
