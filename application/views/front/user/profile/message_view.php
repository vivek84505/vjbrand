<?php 
    foreach($message_data as $row)
    { 
?>
    <div class="information-title">
        <mark>
            <?php echo translate('subject');?> : 
            <?php echo $row['subject']; ?>
            <span class="pull-right" id="ticket_set" onClick="set_message_box()" style="cursor:pointer;">
                <i class="fa fa-refresh" style="color:#232323;"></i>
            </span>
        </mark>
    </div>
    <div id="all_messages_box">
        <div class="comments comments-scroll" id="messages_box">  
        
        </div>  
    </div>
    <hr class="page-divider">
    <div class="comments-form tickets mar-lr-10">
        <h4 class="block-title">
            <?php echo translate('reply_message');?>
        </h4>
        <?php
            echo form_open(base_url() . 'home/ticket_reply/'.$row['ticket_id'], array(
                'class' => 'form-horizontal',
                'method' => 'post',
                'id' => 'ticket_reply',
                'enctype' => 'multipart/form-data'
            ));
        ?>
            <div class="form-group">
                <textarea placeholder="<?php echo translate('your_message');?>" class="form-control" title="comments-form-comments" name="reply" rows="6"></textarea>
            </div>
            <div class="form-group">  
                <span class="button-custom-btn-1 submit_button enterer pull-right custom-btn-1-round-l custom-btn-1 custom-btn-1-text-thick custom-btn-1-border-thin custom-btn-1-text-upper custom-btn-1-size-s" onclick="form_submit('ticket_reply');" data-ing="<?php echo translate('replying...'); ?>" data-success="<?php echo translate('reply_sent_successfully'); ?>!" data-unsuccessful="<?php echo translate('unsuccessful'); ?>!" data-redirectclick="#reload_page" data-text="<?php echo translate('reply');?>">		
                    <span><i class="fa fa-comment"></i></span>
                </span>
            </div>
        </form>
        <div id="ticket_setf" class="message_view" data-id="<?php echo $row['ticket_id']?>"></div> 
        <span id="reload_page" onClick="reload_page();" style="display:none;"></span>
    </div>     
    <style>
        .comment-text {
            cursor:pointer;	
        }
    </style>
    <script>
        $(document).ready(function(e){
            $('.shortened_message').on('click',function(){
                $(this).closest('.media-body').find('.shortened_message').hide();
                $(this).closest('.media-body').find('.big_message').show();
            });
            $('.big_message').on('click',function(){
                $(this).closest('.media-body').find('.shortened_message').show();
                $(this).closest('.media-body').find('.big_message').hide();
            });
            setInterval(function(){ set_message_box(); }, 30000);
			set_message_box();
        });
        
        function set_message_box(){
            $('#all_messages_box').load('<?php echo base_url(); ?>home/profile/message_box/<?php echo $row['ticket_id']?>',function(){ load_iamges(); });
        }
		function reload_page(){
			$("#window").load("<?php echo base_url()?>home/profile/message_view/<?php echo $row['ticket_id']?>",function(){ load_iamges(); });
        }
    </script>   
<?php 
    }
?>