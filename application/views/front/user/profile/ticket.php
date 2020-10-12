<div id="window">
    <div class="information-title">
        <?php echo translate('support_ticket');?>
    </div>
    <div class="details-wrap">
        <div class="row">
            <div class="col-md-12">
                <div class="tabs-wrapper content-tabs">
                    <nav class="menu tab-menu-1">
                        <ul id="tabs" class="menu-list">
                            <li class="menu-item active">
                                <a class="menu-link uppercase" href="#tab1" data-toggle="tab"><?php echo translate('all_messages');?></a>
                            </li>
                            <li class="menu-item">
                                <a class="menu-link uppercase" href="#tab2" data-toggle="tab"><?php echo translate('create_ticket');?></a>
                            </li>
                        </ul>
                    </nav>
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="tab1">
                            <div class="wishlist tickets">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th><?php echo translate('ticket_subject');?></th>
                                            <th><?php echo translate('options');?></th>
                                        </tr>
                                    </thead>
                                    <tbody id="result6">
                                    </tbody>
                                </table>
                            </div>   
                            <input type="hidden" id="page_num6" value="0" />

                            <div class="pagination_box">

                            </div>

                            <script>                                                                    
                                function ticket_listed(page){
                                    if(page == 'no'){
                                        page = $('#page_num6').val();   
                                    } else {
                                        $('#page_num6').val(page);
                                    }
                                    var alerta = $('#result6');
                                    alerta.load('<?php echo base_url();?>home/ticket_listed/'+page,
                                        function(){
                                            //set_switchery();
                                        }
                                    );   
                                }
                                $(document).ready(function() {
                                    ticket_listed('0');
                                });

                            </script> 
                        </div>
                        <div class="tab-pane fade" id="tab2">
							<?php
                                echo form_open(base_url() . 'home/ticket_message_add/', array(
                                    'class' => 'form-login',
                                    'method' => 'post',
                                    'id' => 'add_ticket',
                                    'enctype' => 'multipart/form-data'
                                ));
                            ?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <span class="inputt custom-input-1">
                                            <input class="input-field custom-input-field-1" type="text" id="input-1" name="sub" />
                                            <label class="input-label custom-input-label-1" for="input-1">
                                                <span class="input-label-content custom-input-label-content " data-content="<?php echo translate('subject');?>"><?php echo translate('subject');?></span>
                                            </label>
                                        </span>
                                    </div>
                                    <div class="col-md-12">
                                    	<span class="inputt custom-input-1">
                                            <textarea maxlength="5000" rows="10" class="input-field custom-input-field-1" name="reply" id="comment"></textarea>
                                            <label class="input-label custom-input-label-1" for="input-1">
                                                <span class="input-label-content custom-input-label-content " data-content="<?php echo translate('message');?> *"><?php echo translate('message');?> *</span>
                                            </label>
                                        </span>
                                    </div>
                                    <div class="col-md-12">
                                        <span class="button-custom-btn-1 submit_button enterer pull-right custom-btn-1-round-l custom-btn-1 custom-btn-1-text-thick custom-btn-1-text-upper custom-btn-1-size-s" onclick="form_submit('add_ticket');" data-ing="<?php echo translate('creating...'); ?>" data-success="<?php echo translate('ticket_created_successfully'); ?>!" data-unsuccessful="<?php echo translate('ticket_creation_unsuccessful'); ?>!" data-redirectclick="#st" data-text="<?php echo translate('create'); ?>">		
                                            <span><i class="fa fa-arrow-circle-right"></i></span>
                                        </span>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
	$('body').on('click','.message_view',function(){
		var id = $(this).data('id');
		$("#window").load("<?php echo base_url()?>home/profile/message_view/"+id);
	});
</script>
<script>
$(document).ready(function(e) {
    $('#tabs a').click(function (e) {
	  e.preventDefault()
	  $(this).tab('show')
	})
});
</script>
<style>
.custom-input-label-1 {
    top: -24px !important;
}
.custom-input-label-content::after {
    top: -176% !important;
}
</style>