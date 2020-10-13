<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');



class Html_model extends CI_Model
{

    /*
	 *	Developed by: Active IT zone
	 *	Date	: January, 2017
	 */

    function __construct()
    {
        parent::__construct();
    }


    function news_box($type = '', $style = '',$data = array())
    {
        $this->load->view('front/components/news_box/news_box_'.$type.'_'.$style,$data);

    }

    function blog_box($type = '', $style = '',$data = array())
    {
        $this->load->view('front/components/blog_box/blog_box_'.$type.'_'.$style,$data);

    }

	function photo_box($style = '',$data = array())
    {
        $this->load->view('front/components/photo_box/photo_box_'.$style,$data);

    }

	function video_box($style = '',$data = array())
    {
        $this->load->view('front/components/video_box/video_box_'.$style,$data);

    }

	function reporter_box($style = '',$data = array())
    {
        $this->load->view('front/components/reporter_box/reporter_box_'.$style,$data);

    }

    function blogger_box($style = '',$data = array())
    {
        $this->load->view('front/components/blogger_box/blogger_box_'.$style,$data);

    }

	function category_box($style = '', $data = array())
    {
        $this->load->view('front/components/category_box/category_box_'.$style,$data);

    }

	function poll()
    {
        $this->load->view('front/components/poll/poll_option');

    }

	function widget($type = '', $style = '',$data = array())
    {
		if($style==''){
        	$this->load->view('front/components/widget/widget_'.$type,$data);
		}else{
			$this->load->view('front/components/widget/widget_'.$type.'_'.$style,$data);
		}

    }

	function bottom_part($type = '')
    {
		if($type !== 'none'){
        	$this->load->view('front/components/bottom_part/'.$type);
		}
    }

	function advertise_sqr($type = '')
    {
		$page_data['type'] = $type;
     	$this->load->view('front/components/advertise/box_sqr',$page_data);
    }
	function advertise_rect($type = '')
    {
		$page_data['type'] = $type;
     	$this->load->view('front/components/advertise/box_rect',$page_data);
    }
	function advertise_home2x1($type = '')
    {
		$page_data['type'] = $type;
     	$this->load->view('front/components/advertise/box_home2x1',$page_data);
    }
	function advertise_home3x1($type = '')
    {
		$page_data['type'] = $type;
     	$this->load->view('front/components/advertise/box_home3x1',$page_data);
    }
	function advertise_header($type = '')
    {
        $page_data['type'] = $type;
     	$this->load->view('front/components/advertise/box_header',$page_data);
    }

}
