<div id="content-container">
    <div id="page-title">
        <h1 class="page-header text-overflow">
            <?php echo translate('manage_post_ad'); ?>
        </h1>
    </div>
    <div class="tab-base">
        <div class="panel">
            <div class="panel-body">
                <div class="tab-content">
                    <div class="tab-pane fade active in" style="border:1px solid #ebebeb; border-radius:4px;">
                        <?php
                        echo form_open(base_url() . 'admin/post_ad/post/', array(
                            'class' => 'form-horizontal',
                            'method' => 'post',
                            'id' => 'post_ad'
                        ));
                        ?>
                        <div class="panel-body">
                            <div class="form-group btm-border">
                                <label class="col-sm-4 control-label" for="demo-hor-1">
                                    <?php echo translate('select_page'); ?>
                                </label>
                                <div class="col-sm-6">
                                    <?php
                                        echo $this->Crud_model->select_html('ad_page', 'ad_page', 'name', 'add', 'demo-chosen-select required', '', '', '', 'get_ad')
                                    ?>
                                </div>
                            </div>
                            <div class="form-group btm_border" id="position" style="display: none;">
                                <label class="col-sm-4 control-label">
                                    <?php echo translate('available_places'); ?>
                                </label>

                                <div class="col-sm-6" id="ad_position">

                                </div>
                            </div>
                            <div id="ad_details" style="display: none;">
                                <div class="form-group btm_border">
                                    <label class="col-sm-4 control-label">
                                        <?php echo translate('choose_image'); ?>
                                    </label>
                                    <div class="img_features col-sm-6">
                                        <div class="col-sm-6" style="border:1px solid #ccc; border-radius:5px;margin-right:10px; margin-bottom:10px;">
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <center>
                                                        <div class="col-sm-12" style="padding:10px;">
                                                            <img class="img-responsive img-border blah"  src="<?php echo base_url(); ?>uploads/others/default_image.png" style="width:100%;"  >
                                                        </div>
                                                    </center>
                                                </div>
                                                <div class="col-sm-12">
                                                    <span class="pull-left btn btn-sm btn-default btn-file btn-block">
                                                        <?php echo translate('select_image'); ?>
                                                        <input type="file" name="ad_img" accept="image/*" class="form-control imgInp">
                                                    </span>
                                                </div>
                                            </div>               
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group btm_border">
                                    <label class="col-sm-4 control-label">
                                        <?php echo translate('enter_link'); ?>
                                    </label>

                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="ad_url">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <div class="row">
                                <div class="col-md-offset-10 col-md-1">
                                    <span class="btn btn-success btn-md btn-labeled fa fa-upload pull-right" onclick="form_submit('post_ad', '<?php echo translate('successfully_posted!'); ?>')" >
                                        <?php echo translate('post'); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var base_url = '<?php echo base_url(); ?>';
    var user_type = 'admin';
    var module = 'post_ad';
    var list_cont_func = '';
    var dlt_cont_func = '';

    $(document).ready(function (e) {
        $("form").submit(function (e) {
            return false;
        });
        set_select();
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
    });
    function get_ad(id) {
        ajax_load(base_url + 'admin/post_ad/get_position/' + id, 'ad_position', 'other');
    }
    function set_select() {
        $('.demo-chosen-select').chosen();
        $('.demo-cs-multiselect').chosen({width: '100%'});
    }
    function other() {
        $('#position').hide();
        set_select();
        $('#position').show('slow');
    }

    function show_ad_form(id) {
        $('#ad_details').hide();
        $('#ad_details').show('slow');
    }
</script>
