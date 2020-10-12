<!-- blog list  -->
<div id="table1">
    <table class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th><?php echo translate('no')?></th>
                <th width="10%"><?php echo translate('image'); ?></th>
                <th width="40%"><?php echo translate('blog_title'); ?></th>
                <th width="20%"><?php echo translate('date'); ?></th>
                <th width="10%"><?php echo translate('hide_blog'); ?></th>
                <th><?php echo translate('option'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php
                $i=1;

                foreach($blog_list as $list) { ?>
                    <tr>
                        <td><?php echo $cur_page+$i;?></td>
                        <td>
                            <?php
                                $image = json_decode($list['img_features'], true);
                                if(count($image) >0){
                                    if ($image[0]['thumb']) {
                            ?>
                                        <img class="img-responsive img-thumbnail image_delay" style="width: 64px;height: 50px;" src="<?php echo img_loading(); ?>" data-src="<?php echo base_url();?>uploads/blog_image/<?php echo $image[0]['thumb'];?>"/>
                                    <?php
                                        } else {
                                    ?>
                                        <img class="img-responsive img-thumbnail image_delay" style="width: 64px;height: 50px;" src="<?php echo img_loading(); ?>" data-src="<?php echo base_url();?>uploads/blog_image/default.jpg"/>
                                    <?php
                                        }
                                    ?>
                                <?php
                                    } else {
                                ?>
                                    <img class="img-responsive img-thumbnail image_delay" style="width: 64px;height: 50px;" src="<?php echo img_loading(); ?>" data-src="<?php echo base_url();?>uploads/blog_image/default.jpg"/>
                                <?php
                                    }
                                ?>
                            
                        </td>  
                        <td><?=$list['title']?></td>
                        <td><?=date('d/m/Y h:m A', $list['date'])?></td>
                        <td>
                            <input class='aiz_switchery' type='checkbox' data-set="hide_status" data-id="<?php echo $list['blog_id'];?>" <?php if($list['hide_status'] == 'true'){echo 'checked';}?> data-tm="<?php echo translate('the_blog_is_successfully_hidden')?>" data-fm="<?php echo translate('successfully_published_the_blog')?>"/>
                        </td>
                        <td>
                            <a onclick="edit_blog('<?php echo $list['blog_id'];?>');" id="edit_blog" data-toggle="tooltip" title="Edit" class="btn btn-blue btn-sm"><i class="fa fa-wrench"></i></a>
                            <a data-burl="<?php echo base_url() ?>home/profile/blog_delete/<?php echo $list['blog_id'];?>" data-inside="blog_list" title="Delete" class="remove_data btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                            
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
    $(document).ready(function () {
        load_iamges();
        $('#table1').each(function(e){
            set_switchery_blog();
        });
    });
</script>