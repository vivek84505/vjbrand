<?php 
	$contact_address =  $this->db->get_where('general_settings',array('type' => 'contact_address'))->row()->value;
	$contact_phone =  $this->db->get_where('general_settings',array('type' => 'contact_phone'))->row()->value;
	$contact_email =  $this->db->get_where('general_settings',array('type' => 'contact_email'))->row()->value;
	$contact_website =  $this->db->get_where('general_settings',array('type' => 'contact_website'))->row()->value;
	$contact_about =  $this->db->get_where('general_settings',array('type' => 'contact_about'))->row()->value;
	
	$facebook =  $this->db->get_where('social_links',array('type' => 'facebook'))->row()->value;
	$googleplus =  $this->db->get_where('social_links',array('type' => 'google-plus'))->row()->value;
	$twitter =  $this->db->get_where('social_links',array('type' => 'twitter'))->row()->value;
	$skype =  $this->db->get_where('social_links',array('type' => 'skype'))->row()->value;
	$youtube =  $this->db->get_where('social_links',array('type' => 'youtube'))->row()->value;
	$pinterest =  $this->db->get_where('social_links',array('type' => 'pinterest'))->row()->value;
	
	$footer_text =  $this->db->get_where('general_settings',array('type' => 'footer_text'))->row()->value;
	$footer_category = json_decode($this->db->get_where('general_settings',array('type' => 'footer_category'))->row()->value);
?>
<footer class="footer2">
	<div class="footer2-top">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-2 col-sm-12 col-xs-12">
                    <h4 class="widget-title tt-hover">
                    	<a href="<?php echo base_url(); ?>home/marketing">
							<?php echo translate('apply_for_advertisement');?>
                        </a>
                    </h4>
				</div>
				<div class="col-lg-2 col-md-2 hidden-xs hidden-sm">
					<h4 class="widget-title tt-hover">
                    	<a href="<?php echo base_url(); ?>home/photo_gallery">
							<?php echo translate('photo_gallery');?>
                        </a>
                    </h4>
				</div>
				<div class="col-lg-2 col-md-2 hidden-xs hidden-sm">
					<h4 class="widget-title tt-hover">
						<a href="<?php echo base_url(); ?>home/video_gallery">
							<?php echo translate('video_gallery');?>
                        </a>
                    </h4>
				</div>
                <div class="col-lg-2 col-md-2 hidden-xs hidden-sm">
					<h4 class="widget-title tt-hover">
						<a href="<?php echo base_url(); ?>home/archive_news/0/0">
							<?php echo translate('archive_search');?>
                        </a>
                    </h4>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
					<div class="widget">
						<?php
							echo form_open(base_url() . 'home/subscribe', array(
								'class' => '',
								'method' => 'post'
							));
						?>    
							<div class="form-group">
                            	<div class="col-md-12" style="margin-top:15px;">
                                    <div class="subscribe-div">
                                        <input type="text" class="form-control col-md-8" name="email" id="subscr" placeholder="<?php echo translate('email_address'); ?>">
                                        <span class="btn btn-subcribe subscriber enterer"><?php echo translate('subscribe'); ?></span>
                                   	</div>
                                </div>
							</div>                
					   </form>
					</div>
                </div>
            </div>
        </div>
    </div>
	<div class="footer2-widgets">
		<div class="container">
			<div class="row">
				<div class="col-md-3 col-sm-3 col-xs-6">
					<a href="<?php echo base_url(); ?>">
                        <img class="img-responsive footer-logo" src="<?php echo $this->Crud_model->logo('home_bottom_logo'); ?>" alt="">
                    </a>
				</div>
				<div class="col-md-2 col-sm-3 hidden-xs">
					<div class="widget widget-categories">
						<h4 class="widget-title"><?php echo translate('categories');?></h4>
						<ul>
                        	<?php 
							foreach($footer_category as $r){?>
                            <li>
                                <a href="<?php echo base_url();?>home/news/<?php echo $r;?>">
                                    <?php echo $this->Crud_model->get_type_name_by_id('news_category',$r,'name'); ?>
                                </a>
                            </li>
                            <?php }?>
						</ul>
					</div>
				</div>
				<div class="col-md-2 col-sm-3 hidden-xs">
					<div class="widget widget-categories">
						<h4 class="widget-title"><?php echo translate('useful_links');?></h4>
						<ul>
							<li>
								<a href="<?php echo base_url(); ?>home/"><?php echo translate('home');?>
								</a>
							</li>
							<li>
								<a href="<?php echo base_url(); ?>home/news/0/0"><?php echo translate('all_news');?>
								</a>
							</li>
							<li>
								<a href="<?php echo base_url(); ?>home/contact/"><?php echo translate('contact');?>
								</a>
							</li>
							<li>
								<a href="<?php echo base_url(); ?>home/faq"><?php echo translate('FAQ');?>
								</a>
							</li>
							<li>
								<a href="<?php echo base_url(); ?>home/rss_links"><?php echo translate('rss');?>
								</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-md-2 hidden-xs hidden-sm">
					<div class="widget widget-categories">
						<h4 class="widget-title"><?php echo translate('about_us');?></h4>
						<p><?php echo $footer_text ;?></p>
					</div>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-6">
					<div class="widget">
						<div class="widget contact">
                            <h4 class="widget-title"><?php echo translate('contact_us');?></h4>
                            <div class="media-list">
                                <div class="media">
                                    <i class="pull-left fa fa-home"></i>
                                    <div class="media-body">
                                        <strong><?php echo translate('address');?>:</strong>
                                        <?php echo $contact_address;?>
                                    </div>
                                </div>
                                <div class="media">
                                    <i class="pull-left fa fa-phone"></i>
                                    <div class="media-body">
                                        <strong><?php echo translate('phone');?>:</strong>
                                        <?php echo $contact_phone;?>
                                    </div>
                                </div>
                                <div class="media">
                                    <i class="pull-left fa fa-globe"></i>
                                    <div class="media-body">
                                        <strong><?php echo translate('website');?>:</strong>
                                        <a href="https://<?php echo $contact_website;?>"><?php echo $contact_website;?></a>
                                    </div>
                                </div>
                                <div class="media">
                                    <i class="pull-left fa fa-envelope-o"></i>
                                    <div class="media-body">
                                        <strong><?php echo translate('email');?>:</strong>
                                        <a href="mailto:<?php echo $contact_email;?>">
                                            <?php echo $contact_email;?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="footer1-meta">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-sm-6 col-xs-6">
					<div class="copyright">
						<?php echo date("Y");?> &copy; 
						<?php echo translate('all_rights_reserved'); ?> @ 
						<a href="<?php echo base_url(); ?>">
							<?php echo $this->Crud_model->get_settings_value('general_settings','system_title');?>
						</a> 
							| 
						<a href="<?php echo base_url(); ?>home/legal/terms_conditions" class="link">
							<?php echo translate('terms_&_condition'); ?>
						</a> 
							| 
						<a href="<?php echo base_url(); ?>home/legal/privacy_policy" class="link">
							<?php echo translate('privacy_policy'); ?>
						</a>
					</div>
				</div>
                <div class="col-md-4 col-sm-6 col-xs-6">
                	<div class="contact">
                        <ul class="social-nav model-2">
                            <li><a href="<?php echo $facebook;?>" class="facebook"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="<?php echo $skype;?>" class="skype"><i class="fa fa-skype"></i></a></li>
                            <li><a href="<?php echo $youtube;?>" class="youtube"><i class="fa fa-youtube"></i></a></li>
                            <li><a href="<?php echo $pinterest;?>" class="pinterest"><i class="fa fa-pinterest"></i></a></li>
                            <li><a href="<?php echo $googleplus;?>" class="google-plus"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="<?php echo $twitter;?>" class="twitter"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="<?php echo base_url(); ?>home/rss_links" class="rss"><i class="fa fa-rss"></i></a></li>
                        </ul>
                    </div>
				</div>
			</div>
		</div>
	</div>
</footer>
<style>
.link:hover{
	text-decoration:underline;
}
@media (max-width: 992px) {
	.subscribe-div{
		display: flex;
		margin-bottom: 15px !important;
	}
}
</style>
