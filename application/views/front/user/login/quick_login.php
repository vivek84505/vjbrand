<?php
	$fb_login_set = $this->Crud_model->get_settings_value('third_party_settings','fb_login_set','value');
	$g_login_set = $this->Crud_model->get_settings_value('third_party_settings','g_login_set','value');
?>
<div class="modal_wrap">
    <div class="row get_into" id="login">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<?php
                echo form_open(base_url() . 'home/login/do_login/', array(
                    'class' => 'form-login',
                    'method' => 'post',
                    'id' => ''
                ));
            ?>
                <div class="row box_shape2">
                    <div class="title">
                        <?php echo translate('sign_in');?>
                        <div class="option">
                            <?php echo translate('not_a_member_yet_?');?>
                            <a href="<?php echo base_url(); ?>home/login_set/registration"> 
                                <?php echo translate('sign_up_now!');?>
                            </a>
                        </div>
                    </div>
                    <hr>
                    <?php if($fb_login_set == 'ok' || $g_login_set == 'ok'){ ?>
                        <?php if($fb_login_set == 'ok'){ ?>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 <?php if($g_login_set !== 'ok'){ ?>mr_log<?php } ?>">
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
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 <?php if($fb_login_set !== 'ok'){ ?>mr_log<?php } ?>">
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
                        <?php } ?>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <h2 class="login_divider"><span>or</span></h2>
                        </div>
                    <?php } ?>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <input class="form-control" type="email" name="email" placeholder="<?php echo translate('email');?>" value="">
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <input class="form-control" type="password" name="password" placeholder="<?php echo translate('password');?>"value="">
                        </div>
                    </div>
                    
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right pull-right">
                        <span class="forgot-password" style="cursor:pointer;" onClick="set_html('login','forget')">
                            <?php echo translate('forget_your_password_?');?>
                        </span>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <span  class="button-custom-btn-1 btn-block custom-btn-1 custom-btn-1-text-thick custom-btn-1-round-s custom-btn-1-text-upper custom-btn-1-size-s pull-right login_btn enterer" data-text="<?php echo translate('login');?>">		
                            <span><?php echo translate('login');?></span>
                        </span>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <div class="row" id="forget" style="display:none">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?php
				echo form_open(base_url() . 'home/login/forget/', array(
					'class' => 'form-login',
					'method' => 'post',
					'id' => 'forget_form'
				));
			?>
				<div class="row box_shape2">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="form-group">
							<input class="form-control" type="email" name="email" placeholder="<?php echo translate('email_address');?>">
						</div>
					</div>
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right">
						<span class="btn btn-info btn-sm pull-left text-uppercase" style="border-radius: 4px;" onClick="set_html('forget','login')">
							<?php echo translate('back_to_login');?>
						</span>
						<span class="btn btn-primary btn-sm forget_btn enterer text-uppercase" style="border-radius: 4px;">
							<?php echo translate('submit');?>
						</span>
					</div>
				</div>
			</form>
        </div>
    </div>
</div>
<script>
function set_html(hide,show){
	$('#'+show).show('fast');
	$('#'+hide).hide('fast');
}
window.addEventListener("keydown", checkKeyPressed, false);
function checkKeyPressed(e) {
	if (e.keyCode == "13") {
		$('.snbtn').click();
	}
}
</script>
<style>
.g-icon-bg {
background: #ce3e26;
}
.g-bg {
background: #de4c34;
height: 37px;
margin-left: 41px;
width: 166px;
}
.modal_wrap{
    padding: 20px 0px;
}
.get_into hr {
    border: 1px solid #e8e8e8  !important;
    height: 0px !important;
    background-image: none !important;
}
.box_shape2 {
    padding: 15px;
    border: solid 1px #e9e9e9;
    background-color: #ffffff;
    margin: -25px 20px;
}
</style>