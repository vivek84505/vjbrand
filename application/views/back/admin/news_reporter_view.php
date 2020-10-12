<?php
    foreach ($news_reporter_data as $row) {
        $images = json_decode($row['image'], true);
        $social_account = json_decode($row['social_account'],true);
        
?>
    <div id="content-container" style="padding-top:0px !important;">
        <div class="text-center pad-all">
            <div class="pad-ver">
                <?php
                if (file_exists('uploads/news_reporter_image/' . $images[0]['thumb'])) {
                    ?>
                    <center>
                        <img class="img-responsive img-border img-md img-circle" src="<?php echo base_url(); ?>uploads/news_reporter_image/<?php echo $images[0]['thumb']; ?>"  />
                    </center>
                    <?php
                } else {
                    ?>
                    <center>
                        <img class="img-responsive img-border img-md img-circle" src="<?php echo base_url(); ?>uploads/others/default_image.png"  >

                    </center>
                    <?php
                }
                ?>
            </div>
            <h4 class="text-lg text-overflow mar-no"><?php echo $row['name'] ?></h4>
            <p class="text-sm"><?php echo translate('news_reporter'); ?></p>
            <?php
                if(!empty($social_account)){
            ?>
                <p>
                    <center>
                        <?php
                            foreach($social_account as $sa){
                                if(!empty($sa['value'])){
                        ?>
                                <a href="http://<?php echo $sa['value'];?>" class="btn btn-sm btn-black" target="_blank">
                                     <i class="fa fa-<?php echo $sa['type'];?> fa-2x"></i>
                                </a>
                        <?php
                                }
                            }
                        ?>
                    </center>
                </p>
            <?php
                }
            ?>
            <hr>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="panel-body">
                    <table class="table table-striped" style="border-radius:3px;">
                        <tr>
                            <th class="custom_td "><?php echo translate('name'); ?></th>
                            <td class="custom_td "><?php echo $row['name']; ?></td>
                        </tr>
                        <tr>
                            <th class="custom_td"><?php echo translate('fathers_name'); ?></th>
                            <td class="custom_td"><?php echo $row['fathers_name']; ?></td>
                        </tr>
                        <tr>
                            <th class="custom_td"><?php echo translate('mothers_name'); ?></th>
                            <td class="custom_td"><?php echo $row['mothers_name']; ?></td>
                        </tr>
                        <tr>
                            <th class="custom_td"><?php echo translate('email'); ?></th>
                            <td class="custom_td"><?php echo $row['email'] ?></td>
                        </tr>
                        <tr>
                            <th class="custom_td"><?php echo translate('phone_number'); ?></th>
                            <td class="custom_td"><?php echo $row['phone'] ?></td>
                        </tr>
                        <tr>
                            <th class="custom_td"><?php echo translate('national_id'); ?></th>
                            <td class="custom_td"><?php echo $row['national_id']; ?></td>
                        </tr>
                        <tr>
                            <th class="custom_td"><?php echo translate('permanent_address'); ?></th>
                            <td class="custom_td"><?php echo $row['permanent_address']; ?></td>
                        </tr>
                        <tr>
                            <th class="custom_td"><?php echo translate('present_address'); ?></th>
                            <td class="custom_td"><?php echo $row['present_address']; ?></td>
                        </tr>
                        <tr>
                            <th class="custom_td"><?php echo translate('appointment_date'); ?></th>
                            <td class="custom_td"><?php echo $row['appointment_date']; ?></td>
                        </tr>
                        <tr>
                            <th class="custom_td"><?php echo translate('designation'); ?></th>
                            <td class="custom_td"><?php echo $row['designation']; ?></td>
                        </tr>
                        <tr>
                            <th class="custom_td"><?php echo translate('computer_ip'); ?></th>
                            <td class="custom_td"><?php echo $row['computer_ip']; ?></td>
                        </tr>

                    </table>
                </div>
            </div>
        </div>					
    </div>					
    <?php
}
?>

<style>
    .custom_td{
        border-left: 1px solid #ddd;
        border-right: 1px solid #ddd;
        border-bottom: 1px solid #ddd;
    }
    .modal-body{
        height: 100vh;
        overflow-y: scroll;
    }
</style>