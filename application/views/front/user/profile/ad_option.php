<script src="https://checkout.stripe.com/checkout.js"></script>
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
                            <a href="#step-1" id="tab-1" type="button" class="btn btn-primary btn-circle" disabled="disabled">1</a>
                            <p><?php echo translate('choose_package'); ?></p>
                        </div>
                        <div class="stepwizard-step">
                            <a href="#step-2" id="tab-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                            <p><?php echo translate('payment_options'); ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                echo form_open(base_url() . 'home/marketing/payment', array(
                        'method' => 'post', 
                        'enctype' => 'multipart/form-data', 
                        'id' => 'payment_form',
                        'class' => 'form-horizontal' 
                    )
                );
            ?>
            <div class="panel-body">
                <div class="row setup-content" id="step-1">
                    <div class="col-md-12">
                        <ul>
                        <?php
                            $prices = json_decode($ad_details->pricing_option,true);
                            if(!empty($prices)){
                                foreach($prices as $price){
                        ?>
                            <li>
                                <div class="radio">
                                    <input type="radio" name="price_option" data-amount="<?php echo $price['amount']; ?>" value="<?php echo $price['index'];?>" id="ad_price_<?php echo $price['index']; ?>"/>
                                    <label for="ad_price_<?php echo $price['index']; ?>">$<?php echo $price['amount']; ?>(<?php echo $price['time'];?> days)</label>
                                </div>
                            </li>
                        <?php
                                }
                            }
                        ?>
                        </ul>
                        <input type="hidden" value="<?php echo $ad_details->advertisement_id;?>" name="advertisement_id">
                    </div>
                    <div class="col-md-12">
                        <span id="next1" class="button-custom-btn-1 pull-right custom-btn-1-round-l disabled custom-btn-1 custom-btn-1-text-thick nextBtn custom-btn-1-text-upper custom-btn-1-size-s" data-text="<?php echo translate('next'); ?>">		
                            <span><i class="fa fa-arrow-circle-right"></i></span>
                        </span>
                    </div>
                </div>
                <div class="row setup-content" id="step-2">
                    <div class="col-md-12">
                        <?php
                            if($this->db->get_where('business_settings',array('type' => 'paypal_set'))->row()->value == 'ok'){
                        ?>
                        <div class="cc-selector col-md-6">
                            <input id="paypal" type="radio" style="display:block;" checked name="payment_type" value="paypal"/>
                            <label class="drinkcard-cc" style="margin-bottom:0px; width:100%; overflow:hidden; height:200px;" for="paypal" onclick="radio_check('paypal')">
                                <img class="image_delay" src="<?php echo img_loading(); ?>" data-src="<?php echo base_url(); ?>uploads/others/paypal.jpg" width="100%" height="100%" style=" text-align-last:center;" alt="<?php echo translate('paypal');?>" />
                            </label>
                        </div>
                        <?php
                            }if($this->db->get_where('business_settings',array('type' => 'stripe_set'))->row()->value == 'ok'){
                        ?>
                        <div class="cc-selector col-md-6">
                            <input id="stripe" type="radio" style="display:block;" name="payment_type" value="stripe"/>
                            <label class="drinkcard-cc" id="customButtong" style="margin-bottom:0px; width:100%; overflow:hidden; height:200px;" for="stripe" onclick="radio_check('stripe')">
                                <img class="image_delay" src="<?php echo img_loading(); ?>" data-src="<?php echo base_url(); ?>uploads/others/stripe.jpg" width="100%" height="100%" style=" text-align-last:center;" alt="<?php echo translate('stripe');?>" />
                            </label>
                        </div>
                        <script>
                            $(document).ready(function(e) {
                                //<script src="https://js.stripe.com/v2/"><script>
                                //https://checkout.stripe.com/checkout.js
                                var handler = StripeCheckout.configure({
                                        key: '<?php echo $this->db->get_where('business_settings' , array('type' => 'stripe_publishable_key'))->row()->value; ?>',
                                        image: '<?php echo base_url(); ?>template/front/assets/img/stripe.png',
                                        token: function(token) {
                                                // Use the token to create the charge with a server-side script.
                                                // You can access the token ID with `token.id`
                                                $('#payment_form').append("<input type='hidden' name='stripeToken' value='" + token.id + "' />");
                                                if($( "#paypal" ).length){
                                                        $( "#paypal" ).prop( "checked", false );
                                                }
                                                $( "#stripe" ).prop( "checked", true );
                                                notify('<?php echo translate('your_card_details_verified!'); ?>','success','bottom','right');
                                                setTimeout(function(){
                                                        $('#payment_form').submit();
                                                }, 500);
                                        }
                                });

                                $('#customButtong').on('click', function(e) {
                                        // Open Checkout with further options
                                        //var total = $('#grand').html(); 
                                        //total = total.replace("<?php //echo currency(); ?>", '');
                                        //total = parseFloat(total.replace(",", ''));
                                        //total = total/parseFloat(<?php //echo exchange(); ?>);
                                        //total = total*100;
                                        var total = $('#step-1').find('input[type="radio"]:checked').data('amount');
                                        //alert(total);
                                        total = total*100;
                                        handler.open({
                                                name: '<?php //echo $system_title; ?>',
                                                description: '<?php echo translate('pay_with_stripe'); ?>',
                                                amount: total
                                        });
                                        e.preventDefault();
                                });

                                // Close Checkout on page navigation
                                $(window).on('popstate', function() {
                                        handler.close();
                                });
                            });
                        </script>
                        <?php
                            }
                        ?>
                    </div>
                    <div class="col-md-12">
                        <span class="button-custom-btn-1 submit_button enterer pull-left custom-btn-1-round-l custom-btn-1 custom-btn-1-text-thick custom-btn-1-text-upper custom-btn-1-size-s" data-text="<?php echo translate('previous'); ?>">       
                            <span onclick="goTab(1);"><i class="fa fa-arrow-circle-left"></i></span>
                        </span>
                        <button class="button-custom-btn-1 submit_button enterer pull-right custom-btn-1-round-l custom-btn-1 custom-btn-1-text-thick custom-btn-1-text-upper custom-btn-1-size-s" type="submit" data-text="<?php echo translate('submit'); ?>">
                            <span><i class="fa fa-check"></i></span>
                        </button>
                    </div>
                </div>
            </div>
            <?php echo form_close();?>
        </div>
    </div>
</div>

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
                navListItems.removeClass('btn-primary').addClass('btn-default');
                $item.addClass('btn-primary');
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

        $('div.setup-panel div a.btn-primary').trigger('click');
    });
    function goTab(number) {
        $('#tab-' + number).click();
    }
    function radio_check(id){
        $( "#paypal" ).prop( "checked", false );
        $( "#stripe" ).prop( "checked", false );
        $( "#"+id ).prop( "checked", true );
    }
    $('.btn-file').on('click',function(e){
        $('#fileInput').click();
    });
        
    
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
        -webkit-filter:opacity(.5);
        -moz-filter:opacity(.5);
        filter:opacity(.5);
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
</script>
<script>
//    $(document).ready(function (e) {
//        var selected_pos = $('#selected_pos').val();
//        if (selected_pos != null) {
//            setTimeout(function () {
//                $('#' + selected_pos).click();
//            }, 1000);
//        }
//    });
//    $('.radio_ad').on('click', function () {
//        $('tbody tr').removeClass('active');
//        $('.radio').removeClass('active');
//        $(this).closest('tr').addClass('active');
//        $(this).closest('.radio').addClass('active');
//        $('#next1').show('slow');
//    });
</script>