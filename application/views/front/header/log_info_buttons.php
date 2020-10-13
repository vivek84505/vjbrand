<?php
    $facebook = $this->db->get_where('social_links', array('type' => 'facebook'))->row()->value;
    $googleplus = $this->db->get_where('social_links', array('type' => 'google-plus'))->row()->value;
    $twitter = $this->db->get_where('social_links', array('type' => 'twitter'))->row()->value;
    $skype = $this->db->get_where('social_links', array('type' => 'skype'))->row()->value;
    $youtube = $this->db->get_where('social_links', array('type' => 'youtube'))->row()->value;
    $pinterest = $this->db->get_where('social_links', array('type' => 'pinterest'))->row()->value;
?>
<ul class="list-inline">
    <li class="hidden-xs">
        <ul class="social-nav model-4">
            <li><a href="<?php echo $facebook; ?>" class="facebook"><i class="fa fa-facebook"></i></a></li>
            <li><a href="<?php echo $skype; ?>" class="skype"><i class="fa fa-skype"></i></a></li>
            <li><a href="<?php echo $youtube; ?>" class="youtube"><i class="fa fa-youtube"></i></a></li>
            <li><a href="<?php echo $pinterest; ?>" class="pinterest"><i class="fa fa-pinterest"></i></a></li>
            <li><a href="<?php echo $googleplus; ?>" class="google-plus"><i class="fa fa-google-plus"></i></a></li>
            <li><a href="<?php echo $twitter; ?>" class="twitter"><i class="fa fa-twitter"></i></a></li>
            <li><a href="<?php echo base_url(); ?>home/rss_links" class="rss"><i class="fa fa-rss"></i></a></li>
        </ul>
    </li>
    <?php
        if ($this->session->userdata('user_login') !== 'yes') {
    ?>
        <li class="hidden-lg hidden-md hidden-sm">
            <a href="<?php echo base_url(); ?>home/login_set/login">
                <i class="fa fa-user-circle" style="width:auto; margin-right:5px;"></i>
                <?php echo translate('sign_in'); ?>
            </a>
        </li>
    <?php
        } else {
    ?>
        <li class="hidden-lg hidden-md hidden-sm">
            <a href="<?php echo base_url(); ?>home/profile/gp">
                <i class="fa fa-user"></i>
                <?php echo translate('profile'); ?>
            </a>
        </li>
        <li class="hidden-lg hidden-md hidden-sm">
            <a href="<?php echo base_url(); ?>home/logout">
                <i class="fa fa-sign-out" style="width:auto; margin-right:5px;"></i>
                <?php echo translate('logout'); ?>
            </a>
        </li>
    <?php
        }
    ?>
</ul>
