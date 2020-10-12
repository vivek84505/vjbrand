<div class="widget shop-categories thin-border">
    <h4 class="widget-title">
    <?php echo translate('browse_videos');?>
    </h4>
    <div class="widget-content video_source">
        <ul>
            <li onClick="source('')">
                <?php echo translate('all_videos');?>
            </li>
            <li onClick="source('youtube')">
                <?php echo translate('youtube');?>
                <span class="video_icons"><i class="fa fa-youtube"></i></span>
            </li>
            <li onClick="source('dailymotion')">
                <?php echo translate('dailymotion');?>
                <span class="video_icons"><i class="fa fa-dailymotion">d</i></span>
            </li>
            <li onClick="source('vimeo')">
                <?php echo translate('vimeo');?>
                <span class="video_icons"><i class="fa fa-vimeo"></i></span>
            </li>
            <li onClick="source('local')">
                <?php echo translate('uploaded_videos');?>
                <span class="video_icons"><i class="fa fa-upload"></i></span>
            </li>
        </ul>
    </div>
</div>
<script>
function source(type){
	location.replace('<?php echo base_url(); ?>home/video_gallery/'+type);
}
</script>