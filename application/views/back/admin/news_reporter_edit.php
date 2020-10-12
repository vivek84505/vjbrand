<?php
foreach ($news_reporter_data as $row) {
    $images = json_decode($this->db->get_where('news_reporter', array('news_reporter_id' => $row['news_reporter_id']))->row()->image, true);
    ?>
    <div class="row">
        <div class="col-md-12">
            <?php
            echo form_open(base_url() . 'admin/news_reporter/update/' . $row['news_reporter_id'], array(
                'class' => 'form-horizontal',
                'method' => 'post',
                'id' => 'news_uploader_edit',
                'enctype' => 'multipart/form-data'
            ));
            ?>
            <div class="panel-body">
                <div class="form-group ">
                    <label class="col-sm-3 control-label" for="news_uploader_photo">
                        <?php echo translate('news_reporter_photo'); ?>
                    </label>
                    <div class="col-sm-6">
                        <div class="col-sm-6" style="margin:2px; padding:2px;">
                            <?php
                            if (file_exists('uploads/news_reporter_image/' . $images[0]['thumb'])) {
                                ?>
                                <img class="img-responsive img-border blah" src="<?php echo base_url(); ?>uploads/news_reporter_image/<?php echo $images[0]['thumb']; ?>"  />
                                <?php
                            } else {
                                ?>
                                <img class="img-responsive img-border blah"  src="<?php echo base_url(); ?>uploads/others/default_image.png"  >
                                <?php
                            }
                            ?>
                        </div>
                        <div class="col-sm-3"></div>
                    </div>
                    <div class="col-sm-12 btm_border">
                        <div class="col-sm-6 col-sm-offset-3">
                            <span class="pull-left btn btn-default btn-file margin-top-10">
                                <?php echo translate('select_photo'); ?>
                                <input type="file" name="img" class="form-control imgInp">
                            </span>
                        </div>
                    </div>
                </div>

                <div class="form-group btm_border">
                    <label class="col-sm-3 control-label" for="email">
                        <?php echo translate('email'); ?>
                    </label>
                    <div class="col-sm-6">
                        <input type="email" name="email" id="email" 
                               placeholder="<?php echo translate('news_reporter_email'); ?>" class="form-control required" value="<?php echo $row['email']; ?>">
                    </div>
                </div>

                <div class="form-group btm_border">
                    <label class="col-sm-3 control-label" for="news_reporter_name"><?php echo translate('name'); ?></label>
                    <div class="col-sm-6">
                        <input type="text" name="name" id="name" 
                               placeholder="<?php echo translate('news_reporter_name'); ?>" class="form-control required" value="<?php echo $row['name']; ?>">
                    </div>
                </div>

                <div class="form-group abstract btm_border">
                    <label class="col-sm-3 control-label"><?php echo translate('fathers_name'); ?></label>
                    <div class="col-sm-6">
                        <input type="text" id="fathers_name"  class="form-control required" name="fathers_name"placeholder="<?php echo translate('fathers_name'); ?>" value="<?php echo $row['fathers_name']; ?>">
                    </div>
                </div> 

                <div class="form-group abstract btm_border">
                    <label class="col-sm-3 control-label"><?php echo translate('mothers_name'); ?></label>
                    <div class="col-sm-6">
                        <input type="text" id="mothers_name"  class="form-control required" name="mothers_name"placeholder="<?php echo translate('mothers_name'); ?>" value="<?php echo $row['mothers_name']; ?>">
                    </div>
                </div> 

                <div class="form-group abstract btm_border">
                    <label class="col-sm-3 control-label"><?php echo translate('national_id'); ?></label>
                    <div class="col-sm-6">
                        <input type="number" id="national_id"  class="form-control required" name="national_id"placeholder="<?php echo translate('national_id'); ?>" value="<?php echo $row['national_id']; ?>">
                    </div>
                </div>

                <div class="form-group abstract btm_border">
                    <label class="col-sm-3 control-label"><?php echo translate('present_address'); ?></label>
                    <div class="col-sm-6">
                        <textarea class="form-control required"  data-height="300" name="present_address" ><?php echo $row['present_address']; ?></textarea>
                    </div>
                </div>

                <div class="form-group abstract btm_border">
                    <label class="col-sm-3 control-label"><?php echo translate('permanent_address'); ?></label>
                    <div class="col-sm-6">
                        <textarea class="form-control required" data-height="300" name="permanent_address" ><?php echo $row['permanent_address']; ?></textarea>
                    </div>
                </div>

                <div class="form-group btm_border btm_border">
                    <label class="col-sm-3 control-label" for="news_reporter_phone"><?php echo translate('phone'); ?></label>
                    <div class="col-sm-6">
                        <input type="tel" name="phone" id="phone" 
                               placeholder="<?php echo translate('news_reporter_phone'); ?>" class="form-control required" value="<?php echo $row['phone']; ?>">
                    </div>
                </div>

                <div class="form-group abstract btm_border">
                    <label class="col-sm-3 control-label"><?php echo translate('appointment_date'); ?></label>
                    <div class="col-sm-6">
                        <input type="date" id="appointment_date"  class="form-control required" name="appointment_date"placeholder="<?php echo translate('appointment_date'); ?>" value="<?php echo $row['appointment_date']; ?>">
                    </div>
                </div>                                   

                <div class="form-group btm_border">
                    <label class="col-sm-3 control-label" for="news_reporter_designation"><?php echo translate('designation'); ?></label>
                    <div class="col-sm-6">
                        <input type="text" name="designation" id="designation" 
                               placeholder="<?php echo translate('news_reporter_designation'); ?>" class="form-control required" value="<?php echo $row['designation']; ?>">
                    </div>
                </div>

                <div class="form-group abstract btm_border">
                    <label class="col-sm-3 control-label"><?php echo translate('computer_IP'); ?></label>
                    <div class="col-sm-6">
                        <input type="number" id="computer_ip" class="form-control required" name="computer_ip" placeholder="<?php echo translate('computer_IP'); ?>" value="<?php echo $row['computer_ip']; ?>">
                    </div>
                </div>
                <div class="form-group abstract btm_border">
                    <label class="col-sm-3 control-label"><?php echo translate('about'); ?></label>
                    <div class="col-sm-6">
                        <textarea class="form-control required"  data-height="300" name="about" ><?php echo $row['about']; ?></textarea>
                    </div>
                </div>
                <?php
                    $social_account = json_decode($row['social_account'],true);
                    if(!empty($social_account)){
                        foreach($social_account as $sa){
                         
                ?>
                <div class="form-group btm_border abstract">
                    <label class="col-sm-3 control-label">
                        <?php echo translate($sa['type']); ?>
                    </label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="<?php echo $sa['type'];?>" value="<?php echo $sa['value']; ?>">
                    </div>
                </div>
                <?php
                        }
                    }
                ?>
            </div>
            <div class="panel-footer">
                <div class="row">
                    <div class="col-md-11">
                        <span class="btn btn-purple btn-labeled fa fa-refresh pro_list_btn pull-right" 
                              onclick="ajax_set_full('edit', '<?php echo translate('edit_news_reporter'); ?>', '<?php echo translate('successfully_edited!'); ?>', 'news_uploader_edit', '<?php echo $row['news_reporter_id']; ?>')">
                                  <?php echo translate('reset'); ?>
                        </span>
                    </div>
                    <div class="col-md-1">
                        <span class="btn btn-success btn-md btn-labeled fa fa-upload pull-right loc" onclick="form_submit('news_uploader_edit', '<?php echo translate('successfully_edited!'); ?>')" ><?php echo translate('upload'); ?></span>
                    </div>

                </div>
            </div>
            </form>
        </div>
    </div>
    <?php
}
?>

<script src="<?php echo base_url(); ?>template/back/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js">
</script>

<script>
    function readURL_all(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            var parent = $(input).closest('.form-group');
            reader.onload = function (e) {
                parent.find('.wrap').hide('fast');
                parent.find('.blah').attr('src', e.target.result);
                parent.find('.wrap').show('fast');
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $(".panel-body").on('change', '.imgInp', function () {
        readURL_all(this);
    });

    function other_forms() {}

    $(document).ready(function () {
        $('.demo-chosen-select').chosen();
        $('.demo-cs-multiselect').chosen({width: '100%'});
    });

    function other() {
        $('.demo-chosen-select').chosen();
        $('.demo-cs-multiselect').chosen({width: '100%'});
    }

    $('body').on('click', '.rmc', function () {
        $(this).closest('.sets').remove();
    });

    $(document).ready(function () {
        $("form").submit(function (e) {
            return false;
        });
    });

</script>
<style>
    .btm_border{
        border-bottom: 1px solid #ebebeb;
        padding-bottom: 15px;	
    }
    .remove{
        color:#FFF !important;
        margin-right:5px !important;
        font-size:20px !important;
        transition: all .4s ease-in-out;	
    }
    .remove:hover{
        color:#003376 !important;	
    }
</style>

<!--Bootstrap Tags Input [ OPTIONAL ]-->




