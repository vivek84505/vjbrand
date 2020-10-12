<?php
foreach ($user_data as $row) {
    ?>
    <div id="content-container" style="padding-top:0px !important;">
        <div class="text-center pad-all">
            <div class="pad-ver">
                <img src="<?php echo $this->Crud_model->file_view('user', $row['user_id'], '100', '100', 'no', 'src', '', '', '.jpg'); ?>" class="img-md img-border img-circle" alt="Profile Picture">
            </div>
            <h4 class="text-lg text-overflow mar-no"><?php echo $row['firstname'] . ' ' . $row['lastname']; ?></h4>
            <p class="text-sm"><?php echo translate('user'); ?></p>
            <div class="pad-ver btn-group">
                <?php if ($row['facebook'] != '') { ?>
                    <a href="<?php echo $row['facebook']; ?>" target="_blank" class="btn btn-icon btn-hover-primary fa fa-facebook icon-lg"></a>
                <?php } if ($row['skype'] != '') { ?>
                    <a href="<?php echo $row['skype']; ?>" target="_blank" class="btn btn-icon btn-hover-info fa fa-twitter icon-lg"></a>
                <?php } if ($row['google'] != '') { ?>
                    <a href="<?php echo $row['google']; ?>" target="_blank" class="btn btn-icon btn-hover-danger fa fa-google-plus icon-lg"></a>
                <?php } ?>
                <a href="#" class="btn btn-icon btn-hover-mint fa fa-envelope icon-lg"></a>
            </div>
            <hr>
        </div>


        <div class="row">
            <div class="col-sm-12">
                <div class="panel-body">
                    <table class="table table-striped" style="border-radius:3px;">
                        <tr>
                            <th class="custom_td"><?php echo translate('name'); ?></th>
                            <td class="custom_td"><?php echo $row['firstname'] . ' ' . $row['lastname']; ?></td>
                        </tr>
                        <tr>
                            <th class="custom_td"><?php echo translate('address'); ?></th>
                            <td class="custom_td">
                                <?php echo $row['address1'] ?><br>
                                <?php echo $row['address2'] ?><br>
                                <?php echo $row['city'] ?>-<?php echo $row['zip'] ?>
                            </td>
                        </tr>
                        <tr>
                            <th class="custom_td"><?php echo translate('email'); ?></th>
                            <td class="custom_td"><?php echo $row['email'] ?></td>
                        </tr>
                        <tr>
                            <th class="custom_td"><?php echo translate('phone_number'); ?></th>
                            <td class="custom_td"><?php echo $row['phone'] ?></td>
                        </tr>
                        <?php if ($row['skype'] != '') { ?>
                            <tr>
                                <th class="custom_td"><?php echo translate('skype'); ?></th>
                                <td class="custom_td"><?php echo $row['skype'] ?></td>
                            </tr>
                        <?php } if ($row['facebook'] != '') { ?>
                            <tr>
                                <th class="custom_td"><?php echo translate('facebook'); ?></th>
                                <td class="custom_td"><?php echo $row['facebook'] ?></td>
                            </tr>
                        <?php } if ($row['google'] != '') { ?>
                            <tr>
                                <th class="custom_td"><?php echo translate('google'); ?></th>
                                <td class="custom_td"><?php echo $row['google'] ?></td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <th class="custom_td"><?php echo translate('user_since'); ?></th>
                            <td class="custom_td"><?php echo date('d M,Y', $row['creation_date']); ?></td>
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
</style>
<script>
    $(document).ready(function (e) {
        $('.modal-footer').find('.btn-purple').hide();
    });
</script>