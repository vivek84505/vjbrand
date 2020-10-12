<!-- BREADCRUMBS -->
<section class="page-section breadcrumbs">
    <div class="container">
        <div class="page-header">
            <h2 class="section-title section-title-lg">
                <span>
						<?php echo translate('rss_export_links'); ?>
                </span>
            </h2>
        </div>
    </div>
</section>
<!-- /BREADCRUMBS -->

<!-- PAGE -->
<section class="page-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            	<?php 
                    $rss= json_decode($this->db->get_where('general_settings', array( 'type' => 'rss' ))->row()->value, true); 
                    if(count($rss)>0){
                ?>
                <div class="details-wrap">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Category</th>
                                        <th>Parma Link</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php  foreach ($rss as $value) { ?>
                                    <tr>
                                       <td> <?php echo $this->db->get_where('news_category',array('news_category_id'=>$value['category_id']))->row()->name;?></td> 
                                       <td><a target="_blank" href="<?php echo $value['permalink'];?>"><?php echo $value['permalink'];?></a></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php }else{
                    echo '<center>No Rss Found! </center>';
                } ?>
                
            </div>
        </div>
    </div>
</section>
<!-- /PAGE -->