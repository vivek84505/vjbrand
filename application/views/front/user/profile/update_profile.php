<?php
    foreach($user_info as $row)
    {
?>
    <div class="information-title">
        <?php echo translate('profile_information');?>
    </div>
    <div class="details-wrap">
        <div class="row">
            <div class="col-md-12">
                <div class="tabs-wrapper content-tabs">
                    <nav class="menu tab-menu-1">
                        <ul id="tabs" class="menu-list">
                            <li class="menu-item active">
                                <a class="menu-link uppercase" href="#tab1" data-toggle="tab"><?php echo translate('personal_info');?></a>
                            </li>
                            <li class="menu-item">
                                <a class="menu-link uppercase" href="#tab2" data-toggle="tab"><?php echo translate('change_password');?></a>
                            </li>
                        </ul>
                    </nav>
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="tab1">
                             <div class="details-wrap">
                                <div class="details-box">
                                    <?php
                                        echo form_open(base_url() . 'home/registration/update_info/', array(
                                            'class' => 'form-login',
                                            'method' => 'post',
                                            'enctype' => 'multipart/form-data'
                                        ));
                                    ?>
                                        <div class="row">
                                            <div class="col-md-6">
                                            	<span class="inputt custom-input-1 <?php if($row['firstname'] !== ''){ echo 'input-filled'; }?>">
                                                    <input class="input-field custom-input-field-1" type="text" id="input-1" name="firstname" value="<?php echo $row['firstname']; ?>" />
                                                    <label class="input-label custom-input-label-1" for="input-1">
                                                        <span class="input-label-content custom-input-label-content " data-content="<?php echo translate('first_name');?>"><?php echo translate('first_name');?></span>
                                                    </label>
                                                </span>
                                            </div>
                                            <div class="col-md-6">
                                            	<span class="inputt custom-input-1 <?php if($row['lastname'] !== ''){ echo 'input-filled'; }?>">
                                                    <input class="input-field custom-input-field-1" type="text" id="input-2" name="lastname" value="<?php echo $row['lastname']; ?>" />
                                                    <label class="input-label custom-input-label-1" for="input-2">
                                                        <span class="input-label-content custom-input-label-content " data-content="<?php echo translate('last_name');?>"><?php echo translate('last_name');?></span>
                                                    </label>
                                                </span>
                                            </div>
                                            <div class="col-md-12">
                                            	<span class="inputt custom-input-1 <?php if($row['email'] !== ''){ echo 'input-filled'; }?>">
                                                    <input class="input-field custom-input-field-1" type="email" id="input-3" name="email" value="<?php echo $row['email']; ?>" disabled />
                                                    <label class="input-label custom-input-label-1" for="input-3">
                                                        <span class="input-label-content custom-input-label-content " data-content="<?php echo translate('email');?>"><?php echo translate('email');?></span>
                                                    </label>
                                                </span>
                                            </div>
                                            <div class="col-md-12">
                                            	<span class="inputt custom-input-1 <?php if($row['address1'] !== ''){ echo 'input-filled'; }?>">
                                                    <input class="input-field custom-input-field-1" type="text" id="input-4" name="address1" value="<?php echo $row['address1']; ?>" />
                                                    <label class="input-label custom-input-label-1" for="input-4">
                                                        <span class="input-label-content custom-input-label-content " data-content="<?php echo translate('address1');?>"><?php echo translate('address1');?></span>
                                                    </label>
                                                </span>
                                            </div>
                                            <div class="col-md-12">
                                            	<span class="inputt custom-input-1 <?php if($row['address2'] !== ''){ echo 'input-filled'; }?>">
                                                    <input class="input-field custom-input-field-1" type="text" id="input-5" name="address2" value="<?php echo $row['address2']; ?>" />
                                                    <label class="input-label custom-input-label-1" for="input-5">
                                                        <span class="input-label-content custom-input-label-content " data-content="<?php echo translate('address2');?>"><?php echo translate('address2');?></span>
                                                    </label>
                                                </span>
                                            </div>
                                            <div class="col-md-6">
                                            	<span class="inputt custom-input-1 <?php if($row['phone'] !== ''){ echo 'input-filled'; }?>">
                                                    <input class="input-field custom-input-field-1" type="tel" id="input-6" name="phone" value="<?php echo $row['phone']; ?>" />
                                                    <label class="input-label custom-input-label-1" for="input-6">
                                                        <span class="input-label-content custom-input-label-content " data-content="<?php echo translate('phone');?>"><?php echo translate('phone');?></span>
                                                    </label>
                                                </span>
                                            </div>
                                            <div class="col-md-6">
                                            	<span class="inputt custom-input-1 <?php if($row['city'] !== ''){ echo 'input-filled'; }?>">
                                                    <input class="input-field custom-input-field-1" type="text" id="input-7" name="city" value="<?php echo $row['city']; ?>" />
                                                    <label class="input-label custom-input-label-1" for="input-7">
                                                        <span class="input-label-content custom-input-label-content " data-content="<?php echo translate('city');?>"><?php echo translate('city');?></span>
                                                    </label>
                                                </span>
                                            </div>
                                            <div class="col-md-6">
                                            	<span class="inputt custom-input-1 <?php if($row['state'] !== ''){ echo 'input-filled'; }?>">
                                                    <input class="input-field custom-input-field-1" type="text" id="input-8" name="state" value="<?php echo $row['state']; ?>" />
                                                    <label class="input-label custom-input-label-1" for="input-1">
                                                        <span class="input-label-content custom-input-label-content " data-content="<?php echo translate('state');?>"><?php echo translate('state');?></span>
                                                    </label>
                                                </span>
                                            </div>
                                            <div class="col-md-6">
                                            	<span class="inputt custom-input-1 <?php if($row['country'] !== ''){ echo 'input-filled'; }?>">
                                                    <input class="input-field custom-input-field-1" type="text" id="input-1" name="country" value="<?php echo $row['country']; ?>" />
                                                    <label class="input-label custom-input-label-1" for="input-8">
                                                        <span class="input-label-content custom-input-label-content " data-content="<?php echo translate('country');?>"><?php echo translate('country');?></span>
                                                    </label>
                                                </span>
                                            </div>
                                            <div class="col-md-6">
                                            	<span class="inputt custom-input-1 <?php if($row['zip'] !== ''){ echo 'input-filled'; }?>">
                                                    <input class="input-field custom-input-field-1" type="text" id="input-9" name="zip" value="<?php echo $row['zip']; ?>" />
                                                    <label class="input-label custom-input-label-1" for="input-9">
                                                        <span class="input-label-content custom-input-label-content " data-content="<?php echo translate('zip');?>"><?php echo translate('zip');?></span>
                                                    </label>
                                                </span>
                                            </div>
                                            <div class="col-md-6">
                                            	<span class="inputt custom-input-1 <?php if($row['skype'] !== ''){ echo 'input-filled'; }?>">
                                                    <input class="input-field custom-input-field-1" type="text" id="input-10" name="skype" value="<?php echo $row['skype']; ?>" />
                                                    <label class="input-label custom-input-label-1" for="input-10">
                                                        <span class="input-label-content custom-input-label-content " data-content="<?php echo translate('skype');?>"><?php echo translate('skype');?></span>
                                                    </label>
                                                </span>
                                            </div>
                                            <div class="col-md-6">
                                            	<span class="inputt custom-input-1 <?php if($row['google'] !== ''){ echo 'input-filled'; }?>">
                                                    <input class="input-field custom-input-field-1" type="text" id="input-11" name="google" value="<?php echo $row['google']; ?>" />
                                                    <label class="input-label custom-input-label-1" for="input-11">
                                                        <span class="input-label-content custom-input-label-content " data-content="<?php echo translate('google');?>"><?php echo translate('google');?></span>
                                                    </label>
                                                </span>
                                            </div>
                                            <div class="col-md-6">
                                            	<span class="inputt custom-input-1 <?php if($row['facebook'] !== ''){ echo 'input-filled'; }?>">
                                                    <input class="input-field custom-input-field-1" type="text" id="input-12" name="facebook" value="<?php echo $row['facebook']; ?>" />
                                                    <label class="input-label custom-input-label-1" for="input-12">
                                                        <span class="input-label-content custom-input-label-content " data-content="<?php echo translate('facebook');?>"><?php echo translate('facebook');?></span>
                                                    </label>
                                                </span>
                                            </div>
                                            <div class="col-md-12">
                                                <span class="button-custom-btn-1 signup_btn enterer pull-right custom-btn-1-round-l custom-btn-1 custom-btn-1-text-thick custom-btn-1-text-upper custom-btn-1-size-s" data-unsuccessful='<?php echo translate('info_update_unsuccessful!'); ?>' data-success='<?php echo translate('info_updated_successfully!'); ?>' data-ing='<?php echo translate('updating..') ?>' data-redirectclick="#reload_page" data-text="<?php echo translate('update');?>">
                                                    <span><i class="fa fa-check"></i></span>
                                                </span>
                                            </div>
                                        </div>
                                    <?php echo form_close(); ?>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab2">
                            <div class="details-wrap">
                                <div class="details-box">
                                    <?php
                                        echo form_open(base_url() . 'home/registration/update_password/', array(
                                            'class' => 'form-delivery',
                                            'method' => 'post',
                                            'enctype' => 'multipart/form-data'
                                        ));
                                    ?>
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12">
                                            	<span class="inputt custom-input-1">
                                                    <input class="input-field custom-input-field-1" type="password" id="input-13" name="password" />
                                                    <label class="input-label custom-input-label-1" for="input-13">
                                                        <span class="input-label-content custom-input-label-content" data-content="<?php echo translate('old_password');?>"><?php echo translate('old_password');?></span>
                                                    </label>
                                                </span>
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                            	<span class="inputt custom-input-1">
                                                    <input class="input-field custom-input-field-1" type="password" id="input-14" name="password1" />
                                                    <label class="input-label custom-input-label-1" for="input-14">
                                                        <span class="input-label-content custom-input-label-content" data-content="<?php echo translate('new_password');?>"><?php echo translate('new_password');?></span>
                                                    </label>
                                                </span>
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                            	<span class="inputt custom-input-1">
                                                    <input class="input-field custom-input-field-1" type="password" id="input-15" name="password2" />
                                                    <label class="input-label custom-input-label-1" for="input-15">
                                                        <span class="input-label-content custom-input-label-content" data-content="<?php echo translate('confirm_new_password');?>"><?php echo translate('confirm_new_password');?></span>
                                                    </label>
                                                </span>
                                            </div>
                                            <div class="col-md-12 col-sm-12">
                                                <span class="button-custom-btn-1 signup_btn enterer pull-right custom-btn-1-round-l custom-btn-1 custom-btn-1-text-thick custom-btn-1-text-upper custom-btn-1-size-s" data-unsuccessful='<?php echo translate('password_change_unsuccessful!'); ?>' data-success='<?php echo translate('password_changed_successfully!'); ?>' data-ing='<?php echo translate('updating..') ?>' data-text="<?php echo translate('update');?>">
                                                    <span><i class="fa fa-check"></i></span>
                                                </span>
                                            </div>
                                        </div>
                                    <?php echo form_close(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
    }
?>

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
.custom-input-1 {
    margin-bottom: 20px;
}
</style>
