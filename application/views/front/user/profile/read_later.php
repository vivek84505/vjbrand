<div class="information-title">
    <?php echo translate('read_later_list');?>
</div>
<div class="wishlist">
    <table class="table" style="background: #fff;">
        <thead>
            <tr>
                <th>#</th>
                <th><?php echo translate('image');?></th>
                <th><?php echo translate('title');?></th>
                <th><?php echo translate('date');?></th>
                <th><?php echo translate('remove');?></th>
            </tr>
        </thead>
        <tbody id="result4">
        </tbody>
    </table>
</div>
<input type="hidden" id="page_num4" value="0" />
<div class="pagination_box">

</div>

<script>                                                                    
    function readlater_listed(page){
        if(page == 'no'){
            page = $('#page_num4').val();   
        } else {
            $('#page_num4').val(page);
        }
        var alerta = $('#result4');
        alerta.load('<?php echo base_url();?>home/readlater_listed/'+page,
            function(){
                //set_switchery();
            }
        );   
    }
    $(document).ready(function() {
        readlater_listed('0');
    });
</script>