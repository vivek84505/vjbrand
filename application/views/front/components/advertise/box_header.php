<?php
    $data = $this->db->get_where('advertisement', array('type' => $type, 'status' => 'ok'));
    if ($data->num_rows() > 0) {
        $result = $data->row();
        $default_post = json_decode($result->default_post,true);
        ?>

        <?php
            if($result->google_adsense == 'ok' && $result->status == 'ok'){
                echo $result->google_adsense_code;
            }
            else
            {
                if($result->approval == 'ok'){
                    if($result->user_status == 'ok'){
                        $result_details = json_decode($result->post_details, true);
                        if(!empty($result_details)){
                            foreach ($result_details as $row) { ?>
                                <a href="<?php echo $row['url']; ?>" target="_blank">
                                    <div class="img-bg img-responsive image_delay" style="height:60px;background-image: url(<?php echo img_loading(); ?>);" data-src="<?php echo base_url(); ?>uploads/default_banner/<?php echo $row['img']; ?>" alt="advertise" ></div>
                                </a>
                            <?php
                            }
                        }
                        else{
                            foreach($default_post as $post){ ?>
                                <a href="<?php echo $post['url'];?>">
                                    <div class="img-bg img-responsive image_delay" style="height:60px;background-image: url(<?php echo img_loading(); ?>);" data-src="<?php echo base_url(); ?>uploads/default_banner/<?php echo $post['img'];?>" alt="advertise" ></div>
                                </a>
                            <?php
                            }
                        }
                    }
                    else{
                        foreach($default_post as $post){ ?>
                            <a href="<?php echo $post['url'];?>">
                                <div class="img-bg img-responsive image_delay" style="height:60px;background-image: url(<?php echo img_loading(); ?>);" data-src="<?php echo base_url(); ?>uploads/default_banner/<?php echo $post['img'];?>" alt="advertise" ></div>
                            </a>
                        <?php
                        }
                    }
                }
                else {
                    foreach($default_post as $post){ ?>
                        <a href="<?php echo $post['url'];?>">
                            <div class="img-bg img-responsive image_delay" style="height:60px;background-image: url(<?php echo img_loading(); ?>);" data-src="<?php echo base_url(); ?>uploads/default_banner/<?php echo $post['img'];?>" alt="advertise" ></div>
                        </a>
                    <?php
                    }
                }
            }
    }
?>
