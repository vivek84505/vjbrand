<div class="row">
    <div class="col-md-12">
        <?php
        echo form_open(base_url() . 'admin/poll/do_add/', array(
            'class' => 'form-horizontal',
            'method' => 'post',
            'id' => 'poll_add'
        ));
        ?>
        <div class="panel-body">
            <div class="form-group btm_border">
                <label class="col-sm-4 control-label"><?php echo translate('poll_question'); ?></label>
                <div class="col-sm-6 abstract">
                    <textarea class="required" name="ques" rows="5" cols="100" data-height="200" data-name="" style="resize:none" ></textarea>
                </div>
            </div>
            <div class="form-group btm_border">
                <label class="col-sm-4 control-label"><?php echo translate('poll_options'); ?></label>
                <div class="col-sm-6 features">

                </div>
                <button class="btn btn-sm btn-success col-sm-offset-10" id="add_feature">
                    <?php echo translate('add_options') ?>
                </button>
            </div>
        </div>

        <div class="panel-footer">
            <div class="row">
                <div class="col-md-11">
                    <span class="btn btn-purple btn-labeled fa fa-refresh pro_list_btn pull-right" 
                          onclick="ajax_set_full('add', '<?php echo translate('add_poll'); ?>', '<?php echo translate('successfully_added!'); ?>', 'poll_add', '');">
                              <?php echo translate('reset'); ?>
                    </span>
                </div>
                <div class="col-md-1">
                    <span class="btn btn-success btn-md btn-labeled fa fa-upload pull-right" onclick="form_submit('poll_add', '<?php echo translate('successfully_added!'); ?>')" ><?php echo translate('upload'); ?></span>
                </div>
            </div>
        </div>
        </form>
    </div>
</div>

<div style="display:none;" id="feature_dummy">
    <div class="col-sm-12" style="margin-top:10px">                            
        <div class="col-sm-10">
            <div class="fg-line">
                <input type="text" name="ftitle[{{i}}]" class="form-control input-sm required" placeholder="Option">
            </div>
        </div>
        <div class="col-sm-2">
            <div class="fg-line">                                               
                <button class="pull-right btn btn-danger removal">X</button>
            </div>
        </div>
        <input type="hidden" name="opt_count" id="opt_count" value="0" />
    </div>
</div>
<input type="hidden" id="nums" value='1' />

<script src="<?php echo base_url(); ?>template/back/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
<script>
                        $('#add_feature').click(function () {

                            var feature_html = $('#feature_dummy').html();
                            var l = $('#opt_count').val();
                            ln = parseInt(Number(l) + 1);
                            feature_html = feature_html.replace(/{{i}}/g, ln);
                            $('.features').append(feature_html);
                            $('#opt_count').val(ln);
                        });

                        $('body').on('click', '.removal', function () {
                            $(this).closest('.col-sm-12').remove();
                        });

</script>
<script>
    window.preview = function (input) {
        if (input.files && input.files[0]) {
            $("#previewImg").html('');
            $(input.files).each(function () {
                var reader = new FileReader();
                reader.readAsDataURL(this);
                reader.onload = function (e) {
                    $("#previewImg").append("<div style='float:left;border:4px solid #303641;padding:5px;margin:5px;'><img height='80' src='" + e.target.result + "'></div>");
                }
            });
        }
    }

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


