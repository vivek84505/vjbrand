<?php
    echo form_open(base_url() . 'home/marketing/payment', array(
        'method' => 'post', 
        'enctype' => 'multipart/form-data', 
        'id' => 'payment_form',
        'class' => 'form-horizontal' 
        )
    );
?>
<script src="https://checkout.stripe.com/checkout.js"></script>
<section class="page-section color">
    <div class="container">
        <div class="information-title">
            <?php echo translate('apply_for_advertisement'); ?>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="stepwizard">
                            <div class="stepwizard-row setup-panel">
                                <div class="stepwizard-step">
                                    <a href="#step-1" id="tab-1" type="button" class="btn btn-package btn-circle">1</a>
                                    <p><?php echo translate('choose_package'); ?></p>
                                </div>
                                <div class="stepwizard-step">
                                    <a href="#step-2" id="tab-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                                    <p><?php echo translate('payment_options'); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="panel-body">
                        <div class="row setup-content" id="step-1">
                            <div class="col-md-12 packages">
                                
                            </div>
                            <div class="col-md-12">
                                <span id="next1" onclick="load_payments()" class="button-custom-btn-1 pull-right custom-btn-1-round-l disabled custom-btn-1 custom-btn-1-text-thick nextBtn custom-btn-1-text-upper custom-btn-1-size-s" data-text="<?php echo translate('next'); ?>">		
                                    <span><i class="fa fa-arrow-circle-right"></i></span>
                                </span>
                            </div>
                        </div>
                        <div class="row setup-content" id="step-2">
                            <div class="col-md-12 payments-options">
                                
                            </div>
                            <div class="col-md-12">
                                <span class="button-custom-btn-1 submit_button enterer pull-left custom-btn-1-round-l custom-btn-1 custom-btn-1-text-thick custom-btn-1-text-upper custom-btn-1-size-s" data-text="<?php echo translate('previous'); ?>">       
                                    <span onclick="goTab(1);"><i class="fa fa-arrow-circle-left"></i></span>
                                </span>
                                <span class="button-custom-btn-1 submit_button enterer pull-right custom-btn-1-round-l custom-btn-1 custom-btn-1-text-thick custom-btn-1-text-upper custom-btn-1-size-s" data-text="<?php echo translate('submit'); ?>">
                                    <span onclick="confirm_payment()"><i class="fa fa-check"></i></span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <?php echo form_close();?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php echo form_close();?>
<script>
    $(document).ready(function () {
        //$('#next1').hide();
        var navListItems = $('div.setup-panel div a'),
                allWells = $('.setup-content'),
                allNextBtn = $('.nextBtn');

        allWells.hide();

        navListItems.click(function (e) {
            e.preventDefault();
            var $target = $($(this).attr('href')),
                    $item = $(this);

            if (!$item.hasClass('disabled')) {
                navListItems.removeClass('btn-package').addClass('btn-default');
                $item.addClass('btn-package');
                allWells.hide();
                $target.show();
                $target.find('input:eq(0)').focus();
            }
        });

        allNextBtn.click(function () {
            var curStep = $(this).closest(".setup-content"),
                    curStepBtn = curStep.attr("id"),
                    nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
                    curInputs = curStep.find("input[type='text'],input[type='url']"),
                    isValid = true;

            $(".form-group").removeClass("has-error");
            for (var i = 0; i < curInputs.length; i++) {
                if (!curInputs[i].validity.valid) {
                    isValid = false;
                    $(curInputs[i]).closest(".form-group").addClass("has-error");
                }
            }

            if (isValid)
                nextStepWizard.removeAttr('disabled').trigger('click');
        });

        $('div.setup-panel div a.btn-package').trigger('click');
    });
    function goTab(number) {
        $('#tab-' + number).click();
    }
    
    $('.btn-file').on('click',function(e){
        $('#fileInput').click();
    });
        
    
</script>
<script>       
    $(document).ready(function(){
        var ad_id = '<?php echo $ad_id;?>';
        var package_id = '<?php echo $package_id;?>';
        var top = Number(200);  
        $('.packages').html('<div style="text-align:center;width:100%;height:'+(top*2)+'px; position:relative;top:'+top+'px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');                
        var state = check_login_stat('state');
        state.success(function (data) {
            if(data == 'hypass'){
                load_packages(ad_id,package_id);
            } else {
                signin();
            }
        });
    });
    
    function load_packages(ad_id,package_id){
        var top = Number(200);
        $('.packages').html('<div style="text-align:center;width:100%;height:'+(top*2)+'px; position:relative;top:'+top+'px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');
        $('.packages').load('<?php echo base_url(); ?>home/marketing/package/'+ad_id+'/'+package_id);
    }

    function load_payments(){
        $('#pay_btn').removeClass('disabled');		
        var top = Number(200);
        $('.payments-options').html('<div style="text-align:center;width:100%;height:'+(top*2)+'px; position:relative;top:'+top+'px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');				
        $('.payments-options').load('<?php echo base_url(); ?>home/marketing/payment_options',
            function(){
                var top_off = $('.header').height();
                $('html, body').animate({
                    scrollTop: $(".payments-options").offset().top-(2*top_off)
                }, 1000);
            }
        );
    }
    function confirm_payment(){
        var state = check_login_stat('state');
        state.success(function (data) {
            if(data == 'hypass'){
                 var form = $('#payment_form');
                 form.submit();
            } else {
                signin();
                $('#login_form').attr('action',base_url+'home/login/do_login/nlog');
                $('#logup_form').attr('action',base_url+'home/registration/add_info/nlog');
            }
        });
    }
    
</script>
<style>
    .stepwizard-step p {
        margin-top: 10px;
    }
    .stepwizard-row {
        display: table-row;
    }
    .stepwizard {
        display: table;
        width: 100%;
        position: relative;
    }
    .stepwizard-step button[disabled] {
        opacity: 1 !important;
        filter: alpha(opacity=100) !important;
    }
    .stepwizard-row:before {
        top: 14px;
        bottom: 0;
        position: absolute;
        content: " ";
        width: 100%;
        height: 1px;
        background-color: #ccc;
        z-order: 0;
    }
    .stepwizard-step {
        display: table-cell;
        text-align: center;
        position: relative;
    }
    .btn-circle {
        width: 30px;
        height: 30px;
        text-align: center;
        padding: 6px 0;
        font-size: 12px;
        line-height: 1.428571429;
        border-radius: 15px;
    }
    .btn-circle:hover {
        border-radius: 15px !important;
    }
</style>
<style>
    .information-title span{
        text-transform: capitalize;
        color: #232323;
        background: #efefef;
    }
    tbody tr{
        transition: all 0.6s ease;
    }
    tbody tr.active{
        background: #f9f9f9;
        transition: all 0.6s ease;
    }
    .radio{
        transition: all 0.6s ease;
    }
    .radio.active label{
        color:#555555;
        transition: all 0.6s ease;
    }
    .cc-selector input{
        margin:0;padding:0;
        -webkit-appearance:none;
        -moz-appearance:none;
        appearance:none;
    }

    .cc-selector input:active +.drinkcard-cc
    {
        opacity: 1;
        border:4px solid #169D4B;
    }
    .cc-selector input:checked +.drinkcard-cc{
        -webkit-filter: none;
        -moz-filter: none;
        filter: none;
        border:4px solid black;
    }
    .drinkcard-cc{
        cursor:pointer;
        background-size:contain;
        background-repeat:no-repeat;
        display:inline-block;
        -webkit-transition: all 100ms ease-in;
        -moz-transition: all 100ms ease-in;
        transition: all 100ms ease-in;
        -webkit-filter:opacity(1);
        -moz-filter:opacity(1);
        filter:opacity(1);
        transition: all .6s ease-in-out;
        border:4px solid transparent;
        border-radius:5px !important;
    }
    .drinkcard-cc:hover{
        -webkit-filter:opacity(1);
        -moz-filter: opacity(1);
        filter:opacity(1);
        transition: all .6s ease-in-out;
        border:4px solid #8400C5;

    }

</style>