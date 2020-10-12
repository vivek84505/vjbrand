<div class="panel">
    <?php
    $header_color = $this->db->get_where('ui_settings', array('type' => 'header_color'))->row()->value;
    ?>
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo translate('choose_color'); ?></h3>
    </div>

    <div class="panel-body">
        <div class="form-group">
            <div class="row">
                <?php
                $colors = array(
                    'default-color' => '#BB1919',
                    'blue-1' => '#247BE5',
                    'purple-1' => '#9B58B5',
                    'dark-1' => '#343D46',
                    'green-1' => '#159A09',
                    'red-1' => '#C23A2C'
                );

                foreach ($colors as $n => $color) {
                    ?>
                    <?php
                    echo form_open(base_url() . 'admin/general_settings/color', array(
                        'class' => 'form-horizontal',
                        'method' => 'post',
                        'id' => '',
                        'enctype' => 'multipart/form-data'
                    ));
                    ?>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 tc_wrp_ech" style="padding:30px;">
                        <div class="" style="border:0px; width:100%; margin: 0px ; margin-bottom:10px;">
                            <input id="theme_color_<?php echo $n; ?>" type="hidden" value="<?php echo $n; ?>" name="header_color" >
                            <label <?php if ($header_color == $n) { ?> class="selected" <?php } ?> for="theme_color_<?php echo $n; ?>" 
                                                                       style="margin-bottom:0px;  height:180px; width:100%; background-size:cover; background-position:center; background-repeat:no-repeat;
                                                                       background-image:url(<?php echo base_url(); ?>uploads/themes/theme-<?php echo $n; ?>.jpg);">
                            </label>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <span class="btn btn-xs btn-info btn-labeled fa fa-desktop btn-block" 
                                      onclick="ajax_preview_modal('theme','<?php echo translate('preview_theme_color'); ?>','<?php echo $n;?>')">
                                          <?php echo translate('preview'); ?>
                                </span>
                            </div>
                            <div class="col-md-6">
                                <span class="btn btn-xs btn-success btn-labeled fa fa-check submitter btn-block <?php
                                if ($header_color == $n) {
                                    echo 'disabled';
                                }
                                ?>" data-ing='<?php echo translate('saving'); ?>' data-msg='<?php echo translate('theme_updated!'); ?>'>
                                          <?php
                                          if ($header_color == $n) {
                                              echo translate('selected');
                                          } else {
                                              echo translate('select');
                                          }
                                          ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    </form>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>
<script>
    var base_url = '<?php echo base_url(); ?>'
    var user_type = 'admin';
    var module = 'display_others';
    $('.submitter').on('click',function(){
        var nw = this;
        $('.submitter').each(function(){
            $(this).html('<?php echo translate('select'); ?>');
            $(this).removeClass('disabled');
            $(this).closest('.tc_wrp_ech').find('label').removeClass('selected');
        });
        setTimeout(function(){
            $(nw).closest('.tc_wrp_ech').find('label').addClass('selected');
            $(nw).html('<?php echo translate('selected'); ?>');
            $(nw).addClass('disabled');
        }, 500);
    });
</script>
<style>
    .selected{   
        border: 3px solid #fff;
        box-shadow: 0px 0px 5px #000;
    }
    .modal-body {
        height:100vh;
        overflow-y: scroll;
    }
</style>