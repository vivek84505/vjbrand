<?php
     foreach($user_info as $row){
?>
<div class="">
    <div class="col-md-12">
        <div class="details-wrap">
            <div class="details-box orders">
                <h3 class="block-title"><span><?php echo translate('profile_information');?></span></h3>
                <table class="table">
                    <tbody>
                        <tr>
                            <td class="description">
                                <?php echo translate('name');?>
                            </td>
                            <td>:</td>
                            <td class="diliver-date"> <?php echo $row['firstname'].' '.$row['lastname'];?> </td>
                        </tr>
                        <tr>
                            <td class="description">
                                <?php echo translate('email');?>
                            </td>
                            <td>:</td>
                            <td class="diliver-date"> <?php echo $row['email'];?> </td>
                        </tr>
                        <tr>
                            <td class="description">
                                <?php echo translate('address');?>
                            </td>
                            <td>:</td>
                            <td class="diliver-date"> <?php echo $row['address1'];?> <?php echo $row['address2'];?> </td>
                        </tr>
                        <tr>
                            <td class="description">
                                <?php echo translate('contact_no');?>
                            </td>
                            <td>:</td>
                            <td class="diliver-date"> <?php echo $row['phone'];?> </td>
                        </tr>
                        <tr>
                            <td class="description">
                                <?php echo translate('city');?>
                            </td>
                            <td>:</td>
                            <td class="diliver-date"> <?php echo $row['city'];?> </td>
                        </tr>
                        <tr>
                            <td class="description">
                                <?php echo translate('state');?>
                            </td>
                            <td>:</td>
                            <td class="diliver-date"> <?php echo $row['state'];?> </td>
                        </tr>
                        <tr>
                            <td class="description">
                                <?php echo translate('country');?>
                            </td>
                            <td>:</td>
                            <td class="diliver-date"> <?php echo $row['country'];?> </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php if ($row['is_blogger'] == 'yes'): ?>
  
    <div class="col-md-12">
        <div class="details-wrap">
            <div class="details-box orders">
                <h3 class="block-title"><span><?php echo translate('package_information');?></span></h3>
                <div class="row widget widget-categories" style="padding-bottom:25px">
                    <div class="col-lg-4 col-md-6">
                        <ul>
                            <li><a href="#"><?php echo translate('blog_post_amount');?>: <?php echo $row['post_amount'];?></a></li>
                            <li><a href="#"><?php echo translate('blog_image_post_amount');?>: <?php echo $row['photo_amount'];?></a></li>
                            <li><a href="#"><?php echo translate('blog_video_post_amount');?>: <?php echo $row['video_amount'];?></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif ?>
<div class="row">
    <div class="col-md-8 col-md-offset-2">

    </div>
</div>
<?php
    }
?>
