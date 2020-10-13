<?php
	$captcha_status = $this->Crud_model->get_settings_value('third_party_settings','captcha_status','value');
	$fb_login_set = $this->Crud_model->get_settings_value('third_party_settings','fb_login_set','value');
	$g_login_set = $this->Crud_model->get_settings_value('third_party_settings','g_login_set','value');
?>
<section class="page-section color get_into">
    <div class="container">
        <div class="row margin-top-0">
            <div class="col-sm-8 col-sm-offset-2">
				<?php
                    echo form_open(base_url() . 'home/registration/add_info/', array(
                        'class' => 'form-login',
                        'method' => 'post',
                        'id' => 'sign_form'
                    ));
                ?>
                	<div class="row box_shape_reg">
                        <div class="title">
                            <?php echo translate('user_registration');?>
                            <div class="option">
                            	<?php echo translate('already_a_member_?_click_to_');?>
                                <a href="<?php echo base_url(); ?>home/login_set/login"> 
                                    <?php echo translate('login');?>!
                                </a>
                            </div>
                        </div>
                        <hr>
                        <div class="col-md-6">
                            <span class="inputt custom-input-1">
                                <input class="input-field custom-input-field-1" type="text" id="input-1" name="firstname" />
                                <label class="input-label custom-input-label-1" for="input-1">
                                    <span class="input-label-content custom-input-label-content " data-content="<?php echo translate('first_name');?>"><?php echo translate('first_name');?></span>
                                </label>
                            </span>
                        </div>
                        <div class="col-md-6">
                            <span class="inputt custom-input-1">
                                <input class="input-field custom-input-field-1" type="text" id="input-2" name="lastname" />
                                <label class="input-label custom-input-label-1" for="input-2">
                                    <span class="input-label-content custom-input-label-content " data-content="<?php echo translate('last_name');?>"><?php echo translate('last_name');?></span>
                                </label>
                            </span>
                        </div>
                        <div class="col-md-6">
                            <span class="inputt custom-input-1">
                                <input class="input-field custom-input-field-1" type="email" id="input-3" name="email" />
                                <label class="input-label custom-input-label-1" for="input-3">
                                    <span class="input-label-content custom-input-label-content " data-content="<?php echo translate('email');?>"><?php echo translate('email');?></span>
                                </label>
                            </span>
                        </div>
                        <div class="col-md-6">
                            <span class="inputt custom-input-1">
                                <input class="input-field custom-input-field-1" type="tel" id="input-4" name="phone" />
                                <label class="input-label custom-input-label-1" for="input-4">
                                    <span class="input-label-content custom-input-label-content " data-content="<?php echo translate('phone');?>"><?php echo translate('phone');?></span>
                                </label>
                            </span>
                        </div>
                        <div class="col-md-6">
                            <span class="inputt custom-input-1">
                                <input class="input-field custom-input-field-1" type="password" id="input-5" name="password1"/>
                                <label class="input-label custom-input-label-1" for="input-5">
                                    <span class="input-label-content custom-input-label-content " data-content="<?php echo translate('password');?>"><?php echo translate('password');?></span>
                                </label>
                            </span>
                        </div>
                        <div class="col-md-6">
                            <span class="inputt custom-input-1 ">
                                <input class="input-field custom-input-field-1" type="password" id="input-6" name="password2"/>
                                <label class="input-label custom-input-label-1" for="input-6">
                                    <span class="input-label-content custom-input-label-content " data-content="<?php echo translate('confirm_password');?>"><?php echo translate('confirm_password');?></span>
                                </label>
                            </span>
                            <div id='pass_note'></div>
                        </div>
                        <div class="col-md-12">
                            <span class="inputt custom-input-1">
                                <input class="input-field custom-input-field-1" type="text" id="input-7" name="address1" />
                                <label class="input-label custom-input-label-1" for="input-7">
                                    <span class="input-label-content custom-input-label-content " data-content="<?php echo translate('address1');?>"><?php echo translate('address1');?></span>
                                </label>
                            </span>
                        </div>
                        <div class="col-md-12">
                            <span class="inputt custom-input-1">
                                <input class="input-field custom-input-field-1" type="text" id="input-8" name="address2" />
                                <label class="input-label custom-input-label-1" for="input-8">
                                    <span class="input-label-content custom-input-label-content " data-content="<?php echo translate('address2');?>"><?php echo translate('address2');?></span>
                                </label>
                            </span>
                        </div>
                        <div class="col-md-6">
                            <span class="inputt custom-input-1">
                                <input class="input-field custom-input-field-1" type="text" id="input-9" name="city"/>
                                <label class="input-label custom-input-label-1" for="input-9">
                                    <span class="input-label-content custom-input-label-content " data-content="<?php echo translate('city');?>"><?php echo translate('city');?></span>
                                </label>
                            </span>
                        </div>
                        <div class="col-md-6">
                            <span class="inputt custom-input-1">
                                <input class="input-field custom-input-field-1" type="text" id="input-10" name="state"/>
                                <label class="input-label custom-input-label-1" for="input-10">
                                    <span class="input-label-content custom-input-label-content " data-content="<?php echo translate('state');?>"><?php echo translate('state');?></span>
                                </label>
                            </span>
                        </div>
                        <div class="col-md-6">
                            <span class="inputt custom-input-1">
                                <input class="input-field custom-input-field-1" type="text" id="input-11" name="country"/>
                                <label class="input-label custom-input-label-1" for="input-11">
                                    <span class="input-label-content custom-input-label-content " data-content="<?php echo translate('country');?>"><?php echo translate('country');?></span>
                                </label>
                            </span>
                        </div>
                        <div class="col-md-6">
                            <span class="inputt custom-input-1 ">
                                <input class="input-field custom-input-field-1" type="text" id="input-12" name="zip"/>
                                <label class="input-label custom-input-label-1" for="input-12">
                                    <span class="input-label-content custom-input-label-content " data-content="<?php echo translate('zip');?>"><?php echo translate('zip');?></span>
                                </label>
                            </span>
                        </div>
                        <div class="col-md-12">
                            <input name="is_blogger" id="is_blogger" type="checkbox" value="yes"> 
                            <label for="is_blogger"><?php echo translate('i_also_want_to_be_a_blogger');?></label>
                        </div>
                        <div class="col-md-12 terms">
                            <input name="terms_check" id="terms_check" type="checkbox" value="ok" class="required" >
                            <label for="terms_check">
                                <?php echo translate('i_agree_with');?>
                                <a href="<?php echo base_url();?>home/legal/terms_conditions" target="_blank">
                                    <u><?php echo translate('terms_&_conditions');?></u>
                                </a>
                            </label>
                        </div>
                        <?php
							if($captcha_status == 'ok'){
						?>
                        <div class="col-md-12">
                            <div class="outer required">
                                <div class="form-group">
                                    <?php echo $recaptcha_html; ?>
                                </div>
                            </div>
                        </div>
                        <?php
							}
						?>
                        <div class="col-md-12">
                            <span  class="button-custom-btn-1 btn-block custom-btn-1 custom-btn-1-text-thick custom-btn-1-round-s custom-btn-1-text-upper custom-btn-1-size-s pull-right logup_btn enterer" data-text="<?php echo translate('register');?>">		
                                <span><?php echo translate('register');?></span>
                            </span>
                        </div>
                        <!---Facebook and google login-->
                        <?php if($fb_login_set == 'ok' || $g_login_set == 'ok'){ ?>
                        <div class="col-md-12 col-lg-12">
                            <h2 class="login_divider"><span>or</span></h2>
                        </div>
                    	<?php if($fb_login_set == 'ok'){ ?>
                        <div class="col-md-12 col-lg-6 <?php if($g_login_set !== 'ok'){ ?>mr_log<?php } ?>">
                            <?php if (@$user): ?>
                                <a class="btn btn-block btn-social btn-facebook boder-radius text-uppercase" href="<?= $furl ?>">
                                	<span class="fa fa-facebook"></span>
                                 	<?php echo translate('sign_in_with_facebook');?>
                                </a>
                            <?php else: ?>
                                <a class="btn btn-block btn-social btn-facebook boder-radius text-uppercase" href="<?= $furl ?>">
                                	<span class="fa fa-facebook"></span>
                                 	<?php echo translate('sign_in_with_facebook');?>
                                </a>
                            <?php endif; ?>
                        </div>
                    	<?php } if($g_login_set == 'ok'){ ?>  
                        <div class="col-md-12 col-lg-6 <?php if($fb_login_set !== 'ok'){ ?>mr_log<?php } ?>">
						<?php if (@$g_user): ?>
                            <a class="btn btn-block btn-social btn-google boder-radius text-uppercase" href="<?= $g_url ?>">
                                <span class="fa fa-google"></span>
                                <?php echo translate('sign_in_with_google');?>
                            </a>
                       <?php else: ?>
                            <a class="btn btn-block btn-social btn-google boder-radius text-uppercase" href="<?= $g_url ?>">
                                <span class="fa fa-google"></span>
                                <?php echo translate('sign_in_with_google');?>
                            </a>
                        <?php endif; ?>
                        </div>
                        <?php
                                }
                            }
                        ?>
                    </div>
            	</form>
            </div>
        </div>
    </div>
</section>
<script>
$(document).ready(function(e) {
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

		function onInputFocus( ev ) {
			classie.add( ev.target.parentNode, 'input-filled' );
		}

		function onInputBlur( ev ) {
			if( ev.target.value.trim() === '' ) {
				classie.remove( ev.target.parentNode, 'input-filled' );
			}
		}
	})();
</script>
                         
<style>
.custom-input-label-1 {
    top: -23px !important;
}
.custom-input-label-content::after {
    top: -177% !important;
}
.custom-input-1 {
    margin-bottom: 10px;
}
</style>