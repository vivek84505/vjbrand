<div class="row">
    <div class="col-md-12">
        <?php
        echo form_open(base_url() . 'admin/audio/do_add/', array(
            'class' => 'form-horizontal',
            'method' => 'post',
            'id' => 'audio_add',
            'enctype' => 'multipart/form-data'
        ));
        ?>
        <div class="panel-body">
            <div class="col-sm-12" id="video_upload">
                <div class="form-group btm_border">
                    <label class="col-sm-2 control-label">
                        <?php echo translate('upload_audio'); ?>
                    </label>
                    <div class="col-sm-10 abstract">
                        <input type="file" name="upload_audio" class="audioInp" accept="audio/*"/>
                    </div>
                </div>
                <div class="form-group btm-border">
                    <label class="col-sm-2 control-label">
                        <?php echo translate('audio_preview'); ?>
                    </label>
                    <div class="col-sm-10">
                        <audio id="audio_preview" controls> 
                        </audio>
                    </div>
                </div>
                <div class="form-group btm_border">
                    <label class="col-sm-2 control-label">
                        <?php echo translate('description'); ?>
                    </label>
                    <div class="col-sm-10 abstract btm_border">
                        <textarea class="summernotes" data-height="300" data-name="audio_desc"></textarea>
                    </div>
                </div>
            </div>

        </div>

        <div class="panel-footer">
            <div class="row">
                <div class="col-md-10">
                    <span class="btn btn-purple btn-labeled fa fa-refresh pro_list_btn pull-right" 
                          onclick="ajax_set_full('add', '<?php echo translate('add_audio'); ?>', '<?php echo translate('successfully_added!'); ?>', 'audio_add', '');">
                              <?php echo translate('reset'); ?>
                    </span>
                </div>
                <div class="col-md-1" style="margin-left:1%">
                    <span class="btn btn-success btn-md btn-labeled fa fa-upload pull-right" onclick="form_submit('audio_add', '<?php echo translate('successfully_added!'); ?>');
                            proceed('to_add');" >
                          <?php echo translate('upload'); ?>
                    </span>
                </div>
            </div>
        </div>    
        </form>
    </div>
</div>
<script>
    (function localFileVideoPlayer() {
        'use strict'
        var URL = window.URL || window.webkitURL;
        var displayMessage = function (message, isError) {
            var element = document.querySelector('#message');
            element.innerHTML = message;
            element.className = isError ? 'error' : 'info';
        }
        var playSelectedFile = function (event) {
            var file = this.files[0];
            var type = file.type;
            var videoNode = document.querySelector('#audio_preview');
            //var canPlay = videoNode.canPlayType(type);
            //if (canPlay === '') canPlay = 'no';
            //var message = 'Can play type "' + type + '": ' + canPlay ;
            //var isError = canPlay === 'no' ;
            //displayMessage(message, isError) ;

            //if (isError) {
            //  return
            //}

            var fileURL = URL.createObjectURL(file);
            videoNode.src = fileURL;
        }
        var inputNode = document.querySelector('.audioInp');
        inputNode.addEventListener('change', playSelectedFile, false);
    })();
</script>
<script>
    function other_forms() {}
    $(document).ready(function (e) {
        $('.demo-chosen-select').chosen();
        set_summer();
        $("form").submit(function (e) {
            return false;
        });
    });
    function set_summer() {
        $('.summernotes').each(function () {
            var now = $(this);
            var h = now.data('height');
            var n = now.data('name');
            if (now.closest('.abstract').find('.val').length) {
            } else {
                now.closest('.abstract').append('<input type="hidden" class="val" name="' + n + '">');
                now.summernote({
                    height: h,
                    onChange: function () {
                        now.closest('.abstract').find('.val').val(now.code());
                    }
                });
                now.closest('.abstract').find('.val').val(now.code());
            }
        });
    }
</script>