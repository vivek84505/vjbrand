<!-- Bootstrap DateTime Picker -->
<link href="<?php echo base_url(); ?>template/back/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css" rel="stylesheet">


<div class="information-title">
    <?php echo translate('edit_blog');?>
</div>
<div class="details-wrap">
    <div class="details-box">
        <div class="row">
            <div class="col-md-12">
                <?php
                    echo form_open(base_url().'home/profile/blog_edit/update', array(
                        'id' => 'pfp_form',
                        'class' => 'form-delivery',
                        'method' => 'post',
                        'enctype' => 'multipart/form-data'
                    ));
                ?>
                    <?php
                    foreach ($get_blog as $value) {
                    ?>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <span class="inputt custom-input-1 input-filled">
                                        <input class="custom-input-field-1" type="text" id="input-1" name="title" value="<?=$value->title?>" required/>
                                        <input class="custom-input-field-1" type="hidden" name="blog_id" value="<?=$value->blog_id?>" required/>
                                        <label class="input-label custom-input-label-1" for="input-1" style="left:0;">
                                            <span class="input-label-content custom-input-label-content" data-content="<?php echo translate('title');?>"><?php echo translate('title');?></span>
                                        </label>
                                    </span>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <span class="inputt custom-input-1 input-filled">
                                        <textarea class="custom-input-field-1" cols="25" id="input-2" name="summary" required><?=$value->summary?></textarea>
                                        <label class="input-label custom-input-label-1" for="input-2" style="left:0;">
                                            <span class="input-label-content custom-input-label-content" data-content="<?php echo translate('summary');?>"><?php echo translate('summary');?></span>
                                        </label>
                                    </span>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <span class="inputt custom-input-1 input-filled">
                                        <textarea class="custom-input-field-1 txt_editor" cols="25" id="input-3" name="description" required><?=$value->description?></textarea>
                                        <label class="input-label custom-input-label-1" for="input-3" style="left:0;">
                                            <span class="input-label-content custom-input-label-content" data-content="<?php echo translate('description');?>"><?php echo translate('description');?></span>
                                        </label>
                                    </span>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <span class="inputt custom-input-1 input-filled">
                                        <?php echo $this->Crud_model->select_html('blog_category', 'blog_category', 'name', 'edit', 'custom-input-field-1',$value->blog_category_id, '', '', 'get_cat') ?>
                                        <label class="input-label custom-input-label-1" for="input-3" style="left:0;">
                                            <span class="input-label-content custom-input-label-content" data-content="<?php echo translate('category');?>"><?php echo translate('category');?></span>
                                        </label>
                                    </span>
                                </div>
                                <div class="col-md-12 col-sm-12" id="sub_cat">
                                    <span class="inputt custom-input-1 input-filled">
                                        <div id="sub_cat_name">
                                            <?=$this->Crud_model->select_html('blog_sub_category', 'blog_sub_category', 'name', 'edit', 'custom-input-field-1', $value->blog_sub_category_id, 'parent_category_id', $value->blog_category_id, '');?>
                                        </div>
                                        <label class="input-label custom-input-label-1" for="input-4" style="left:0;">
                                            <span class="input-label-content custom-input-label-content" data-content="<?php echo translate('sub-category');?>"><?php echo translate('sub-category');?></span>
                                        </label>
                                    </span>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <span class="inputt custom-input-1 input-filled">
                                        <div class="input-group date" id="datetimepicker">
                                            <input class="custom-input-field-1" type="text" id="input-5" name="date" value="<?=date("m/d/Y g:i a", $value->date);?>" required />
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>

                                        <label class="input-label custom-input-label-1" for="input-5">
                                            <span class="input-label-content custom-input-label-content" data-content="<?php echo translate('date');?>"><?php echo translate('date');?></span>
                                        </label>
                                    </span>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <span class="inputt custom-input-1 input-filled">
                                        <input class="custom-input-field-1" type="text" id="input-6" name="tag" value="<?=$value->tag?>" data-role="tagsinput" required />
                                        <label class="input-label custom-input-label-1" for="input-6" style="width: 100%">
                                            <span class="input-label-content custom-input-label-content" data-content="<?php echo translate('tags');?>"><?php echo translate('tags');?></span>
                                        </label>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="demo-is-inputsmall">
                                        <?php echo translate('image'); ?>
                                    </label>
                                    <div class="img_features col-sm-12">
                                        <?php
                                        $images = json_decode($value->img_features,true);
                                        $count = 0;
                                        foreach ($images as $row) {
                                        ?>
                                            <div class="col-sm-4 rem_div" style="margin-bottom:10px;">
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <center>
                                                            <?php
                                                            if (file_exists('uploads/blog_image/' . $row['thumb'])) {
                                                                ?>
                                                                <img class="img-responsive img-border blah"  src="<?php echo base_url(); ?>uploads/blog_image/<?php echo $row['thumb']; ?>" style="width:100%; border: 1px solid #ccc; height: 150px">
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <img class="img-responsive img-border blah"  src="<?php echo base_url(); ?>uploads/blog_image/default.jpg" style="width:100%; border: 1px solid #ccc; height: 150px">
                                                                <?php
                                                            }
                                                            ?>
                                                        </center>
                                                    </div>
                                                    <!-- <div class="row" style="margin-top: 10px; margin-bottom: 10px;"> -->
                                                        <?php
                                                        if ($row['index'] !== 0) {
                                                            ?>
                                                            <div class="col-sm-7" style="margin:10px 0; padding-right: 5px">
                                                                <!-- <span class="pull-left btn btn-sm btn-default btn-file"> -->
                                                                    <?php //echo translate('select_image'); ?>
                                                                <!-- </span> -->
                                                                <label for="ext_img[<?=$row['index']?>]" class="pull-left btn btn-xs btn-blue btn-file btn-block" style="text-transform: none;"><?php echo translate('select_image'); ?></label>
                                                                <input type="file" id="ext_img[<?=$row['index']?>]" name="nimg[<?php echo $row['index']; ?>]" class="form-control imgInp" style="display: none;">
                                                            </div>
                                                            <div class="col-sm-5" style="margin:10px 0; padding-left: 0px">
                                                                <span class="pull-right btn btn-xs btn-danger remove_data" data-burl="<?php echo base_url(); ?>home/profile/blog_edit/delete_img/<?php echo $value->blog_id; ?>/<?php echo $row['img']; ?>" data-inside="edit_blog" style="padding: 3px 2px 2px; width: 100%">
                                                                    <?php echo translate('remove'); ?>
                                                                </span>
                                                            </div>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <div class="col-sm-12" style="margin: 10px 0;">
                                                                <label for="main_img" class="pull-left btn btn-xs btn-blue btn-file btn-block" style="text-transform: none;"><?php echo translate('select_image') . ' (' . translate('main') . ')*'; ?>
                                                                </label>
                                                                <input type="file" id="main_img" name="nimg[<?php echo $row['index']; ?>]" class="form-control imgInp" style="display: none;">
                                                                <input type="hidden" name="cnt[<?php echo $row['index']; ?>]" id="cnt" class="form-control" />
                                                            </div>
                                                            <?php
                                                        }
                                                        ?>
                                                    <!-- </div> -->
                                                </div>
                                            </div>
                                        <?php
                                        $count = $row['index'];
                                        }
                                        ?>
                                    </div>
                                    <div class="form-group col-sm-12" style="padding-left: 45px">
                                        <button type="button" class="btn btn-sm btn-blue" id="add_images">
                                            <i class="fa fa-plus"></i>
                                            <?php echo translate('add_more_image') ?>
                                        </button>
                                    </div>

                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <!-- <button type="button" onclick="pfp_submit()">click</button> -->
                                    <span id="pfp_submit" class="button-custom-btn-1 signup_btn enterer pull-right custom-btn-1-round-l custom-btn-1 custom-btn-1-text-thick custom-btn-1-text-upper custom-btn-1-size-s" data-unsuccessful='<?php echo translate('submit_unsuccessful!'); ?>' data-success='<?php echo translate('submitted_successfully!'); ?>' data-reload="blog_list" data-ing='<?php echo translate('submitting..') ?>' data-text="<?php echo translate('submit');?>">
                                        <span><i class="fa fa-check"></i></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="blog_image_dummy" style="display:none; margin-top:10px">
    <div class="rem">
        <div class="col-sm-4" style="margin-bottom:10px;">
            <div class="form-group">
                <div class="col-sm-12">
                    <center>
                        <img class="img-responsive img-border blah"  src="<?php echo base_url(); ?>uploads/others/default_image.png" style="width:100%; border: 1px solid #ccc; height: 150px">
                    </center>
                </div>
                <div class="col-sm-12" style="margin-top: 10px; margin-bottom: 10px; padding: 0px">
                    <div class="col-sm-7" style="margin:0px; padding-right: 5px">
                        <label for="opt_img[{{i}}]" class="pull-left btn btn-xs btn-blue btn-file btn-block" style="text-transform: none; width: 100%"><?php echo translate('optional_image'); ?></label>
                        <input type="file" name="nimg[{{i}}]" id="opt_img[{{i}}]" class="form-control imgInp" style="display: none;">
                        <input type="hidden" name="cnt[{{i}}]" class="form-control">
                    </div>
                    <div class="col-sm-5" style="margin:0px; padding-left: 0px ">
                        <span class="pull-right btn btn-xs btn-danger removal" style="padding: 3px 2px 2px; width: 100%">
                            <?php echo translate('remove'); ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="img_count" id="img_count" value="<?php echo $count; ?>" />
<input type="hidden" id="nums" value='1' />
<!-- Bootstrap Date Time Picker -->

<script src="<?php echo base_url(); ?>template/back/plugins/moment/moment.js"></script>
<script src="<?php echo base_url(); ?>template/back/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js"></script>

<script src="<?php echo base_url(); ?>template/back/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>

<script>
    $(function () {
        //bootstrap WYSIHTML5 - text editor
        $('.txt_editor').wysihtml5({
            toolbar: {
                "image": false // Button to insert an image.
            }
        });
    })
</script>
<script type="text/javascript">
    $(document).ready(function () {

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

        $('#add_images').click(function () {
            var blog_image_dummy_html = $('#blog_image_dummy').html();
            var l = $('#img_count').val();
            ln = parseInt(Number(l) + 1);
            blog_image_dummy_html = blog_image_dummy_html.replace(/{{i}}/g, ln);
            $('.img_features').append(blog_image_dummy_html);
            $('#img_count').val(ln);
            $('#cnt').val(ln);
        });

        $('body').on('click', '.removal', function () {
            $(this).closest('.rem').remove();
        });
    });
</script>

<script>
$(document).ready(function(e) {
    $('#tabs a').click(function (e) {
      e.preventDefault();
      $(this).tab('show');
    });
    ( function( window ) {

        'use strict';

        function classReg( className ) {
          return new RegExp("(^|\\s+)" + className + "(\\s+|$)");
        }

        var hasClass, addClass, removeClass;

        if ( 'classList' in document.documentElement ) {
          hasClass = function( elem, c ) {
            return elem.classList.contains( c );
          };
          addClass = function( elem, c ) {
            elem.classList.add( c );
          };
          removeClass = function( elem, c ) {
            elem.classList.remove( c );
          };
        }
        else {
          hasClass = function( elem, c ) {
            return classReg( c ).test( elem.className );
          };
          addClass = function( elem, c ) {
            if ( !hasClass( elem, c ) ) {
              elem.className = elem.className + ' ' + c;
            }
          };
          removeClass = function( elem, c ) {
            elem.className = elem.className.replace( classReg( c ), ' ' );
          };
        }

        function toggleClass( elem, c ) {
          var fn = hasClass( elem, c ) ? removeClass : addClass;
          fn( elem, c );
        }


        var classie = {
          hasClass: hasClass,
          addClass: addClass,
          removeClass: removeClass,
          toggleClass: toggleClass,
          has: hasClass,
          add: addClass,
          remove: removeClass,
          toggle: toggleClass
        };

        if ( typeof define === 'function' && define.amd ) {
          define( classie );
        } else {
          window.classie = classie;
        }
        })( window );

});
</script>

<script>
    (function() {
        if (!String.prototype.trim) {
            (function() {
                var rtrim = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g;
                String.prototype.trim = function() {
                    return this.replace(rtrim, '');
                };
            })();
        }

        [].slice.call( document.querySelectorAll( 'input.input-field' ) ).forEach( function( inputEl ) {
            if( inputEl.value.trim() !== '' ) {
                classie.add( inputEl.parentNode, 'input-filled' );
            }
            inputEl.addEventListener( 'focus', onInputFocus );
            inputEl.addEventListener( 'blur', onInputBlur );
        } );

        [].slice.call( document.querySelectorAll( 'textarea.input-field' ) ).forEach( function( inputEl ) {
            if( inputEl.value.trim() !== '' ) {
                classie.add( inputEl.parentNode, 'input-filled' );
            }
            inputEl.addEventListener( 'focus', onInputFocus );
            inputEl.addEventListener( 'blur', onInputBlur );
        } );

        function onInputFocus( ev ) {
            classie.add( ev.target.parentNode, 'input-filled' );
        }

        function onInputBlur( ev ) {
            if( ev.target.value.trim() === '' ) {
                classie.remove( ev.target.parentNode, 'input-filled' );
            }
        }
    })();

    function get_cat(id) {
        // alert(id);
        $.ajax({
            url: "<?=base_url()?>home/profile/blog_edit/sub_by_cat/"+id,
            success: function(result){
                $("#sub_cat_name").html(result);
                $("#sub_cat").show('slow');
            }
        });
    }
</script>
<script type="text/javascript">
    $(function () {
        $('#datetimepicker').datetimepicker({
            widgetPositioning: {
                horizontal: 'left',
                vertical: 'bottom'
            }
        });
    });

    $(".bootstrap-tagsinput").prop("class","bootstrap-tagsinput custom-input-field-1");
</script>
<style>
.modal-backdrop, .modal-backdrop.in{
  display: none;
}
.custom-input-1 {
    margin-bottom: 20px;
}
.bootstrap-tagsinput input {
    border: none;
}
.bootstrap-tagsinput .tag [data-role="remove"]:hover {
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
}
.bootstrap-tagsinput .tag [data-role="remove"] {
    margin-left: 8px;
    cursor: pointer;
}
.bootstrap-tagsinput .tag [data-role="remove"]:after {
    /* content: "x"; */
    content: "\f057";
    font: normal normal normal 14px/1 FontAwesome;
    padding: 0px 2px;
}
.label-primary {
    background-color: #337ab7;
    padding: 5px 3px;
}
#datetimepicker {
    z-index: 99999999 !important;
}
</style>
