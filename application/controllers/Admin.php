<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('spreadsheet');
        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    public function index() {
        if ($this->session->userdata('admin_login') == 'yes') {
            $page_data['page_name'] = "dashboard";
            $this->load->view('back/index', $page_data);
        } else {
            $this->load->view('back/login');
        }
    }

    /* ------- NEWS CATEGORY Add, Edit, View, Delete ------- */

    function category($para1 = '', $para2 = '') {
        if (!$this->Crud_model->admin_permission('news_category')) {
            redirect(base_url() . 'admin');
        }
        if ($para1 == 'do_add') {
            $data['name'] = $this->input->post('name');
            $this->db->insert('news_category', $data);
            recache();
        } else if ($para1 == 'edit') {
            $page_data['category_data'] = $this->db->get_where('news_category', array(
                        'news_category_id' => $para2
                    ))->result_array();
            $this->load->view('back/admin/category_edit', $page_data);
        } elseif ($para1 == "update") {
            $data['name'] = $this->input->post('name');
            $this->db->where('news_category_id', $para2);
            $this->db->update('news_category', $data);
            recache();
        } elseif ($para1 == 'delete') {
            if(!demo()){
                $this->db->where('news_category_id', $para2);
                $this->db->delete('news_category');
            }
            recache();
        } elseif ($para1 == 'list') {
            $this->db->order_by('news_category_id', 'desc');
            $page_data['all_categories'] = $this->db->get('news_category')->result_array();
            $this->load->view('back/admin/category_list', $page_data);
        } elseif ($para1 == 'add') {
            $this->load->view('back/admin/category_add');
        } else {
            $page_data['page_name'] = "category";
            $page_data['all_categories'] = $this->db->get('news_category')->result_array();
            $this->load->view('back/index', $page_data);
        }
    }

    /* ------- NEWS CATEGORY ENDS ------- */


    /* ------- NEWS SUB-CATEGORY Add, Edit, Update, Delete ---------- */

    function sub_category($para1 = '', $para2 = '') {
        if (!$this->Crud_model->admin_permission('news_sub_category')) {
            redirect(base_url() . 'admin');
        }
        if ($para1 == 'do_add') {
            $data['name'] = $this->input->post('name');
            $data['parent_category_id'] = $this->input->post('parent_category_id');
            $this->db->insert('news_sub_category', $data);
            recache();
        } else if ($para1 == 'edit') {
            $page_data['sub_category_data'] = $this->db->get_where('news_sub_category', array(
                        'news_sub_category_id' => $para2
                    ))->result_array();
            $this->load->view('back/admin/sub_category_edit', $page_data);
        } elseif ($para1 == "update") {
            $data['parent_category_id'] = $this->input->post('parent_category_id');
            $data['name'] = $this->input->post('name');
            $this->db->where('news_sub_category_id', $para2);
            $this->db->update('news_sub_category', $data);
            recache();
        } elseif ($para1 == 'delete') {
            if(!demo()){
                $this->db->where('news_sub_category_id', $para2);
                $this->db->delete('news_sub_category');
            }
            recache();
        } elseif ($para1 == 'list') {
            $this->db->order_by('news_sub_category_id', 'desc');
            $page_data['all_sub_categories'] = $this->db->get('news_sub_category')->result_array();
            $page_data['all_categories'] = $this->db->get('news_category')->result_array();
            $this->load->view('back/admin/sub_category_list', $page_data);
        } elseif ($para1 == 'add') {
            $this->load->view('back/admin/sub_category_add');
        } else {
            $page_data['page_name'] = "sub_category";
            $page_data['all_categories'] = $this->db->get('news_category')->result_array();
            $page_data['all_sub_categories'] = $this->db->get('news_sub_category')->result_array();
            $this->load->view('back/index', $page_data);
        }
    }

    /* --------- NEWS SUB-CATEGORY Ends ----------- */
    /* --------- NEWS SPECIALITY Add, Edit, Update, Delete -------------- */

    function news_speciality($para1 = '', $para2 = '') {
        if (!$this->Crud_model->admin_permission('news_speciality')) {
            redirect(base_url() . 'admin');
        }if ($para1 == 'do_add') {
            $data['name'] = $this->input->post('name');
            //$this->db->insert('news_speciality', $data);
            recache();
        } else if ($para1 == 'edit') {
            $page_data['news_speciality_data'] = $this->db->get_where('news_speciality', array(
                        'news_speciality_id' => $para2))->result_array();
            $this->load->view('back/admin/news_speciality_edit', $page_data);
        } elseif ($para1 == "update") {
            $data['name'] = $this->input->post('name');
            $this->db->where('news_speciality_id', $para2);
            $this->db->update('news_speciality', $data);
            recache();
        } elseif ($para1 == 'delete') {
            $this->db->where('news_speciality_id', $para2);
            //$this->db->delete('news_speciality');
            recache();
        } elseif ($para1 == 'list') {
            $this->db->order_by('news_speciality_id', 'asc');
            $page_data['all_news_specialities'] = $this->db->get('news_speciality')->result_array();
            $this->load->view('back/admin/news_speciality_list', $page_data);
        } elseif ($para1 == 'add') {
            $this->load->view('back/admin/news_speciality_add');
        } else {
            $page_data['page_name'] = "news_speciality";
            $this->load->view('back/index', $page_data);
        }
    }

    /* -------------- NEWS SPECIALITY Ends ------------------- */

    function copy_news($para1 = '') {
        $news_data = $this->db->get_where('news', array('news_id' => $para1))->result_array();
        foreach ($news_data as $row) {
            $data['title'] = $row['title'];
            $data['summary'] = $row['summary'];
            $data['description'] = $row['description'];
            $data['news_category_id'] = $row['news_category_id'];
            $data['news_sub_category_id'] = $row['news_sub_category_id'];
            $data['news_speciality_id'] = $row['news_speciality_id'];
            $data['date'] = $row['date'];
            $data['timestamp'] = time();
            $data['tag'] = $row['tag'];
            $data['status'] = $row['status'];
            $data['news_reporter_id'] = $row['news_reporter_id'];
            $data['news_uploader_id'] = $row['news_uploader_id'];
            $data['edited_by'] = $row['edited_by'];
            $data['img_features'] = '[]';
            $this->db->insert('news', $data);
            $id = $this->db->insert_id();
            $data['news_id'] = $id;
            $img_features = array();
            $images_old = json_decode($row['img_features'], true);

            foreach ($images_old as $i => $roww) {
                $ib = $i + 1;
                $ext = explode('.', $roww['img']);
                $img = 'news_' . $id . '_' . $ib . '.' . $ext[1];
                $src_file1 = 'uploads/news_image/' . $roww['img'];
                $dst_file1 = 'uploads/news_image/' . $img;
                copy($src_file1, $dst_file1);

                $img_thumb = 'news_' . $id . '_' . $ib . '_thumb.' . $ext[1];
                $src_file2 = 'uploads/news_image/' . $roww['thumb'];
                $dst_file2 = 'uploads/news_image/' . $img_thumb;
                copy($src_file2, $dst_file2);

                $img_features[] = array('index' => $i, 'img' => $img, 'thumb' => $img_thumb);
            }
            $data1['img_features'] = json_encode($img_features);
            $this->db->where('news_id', $id);
            $this->db->update('news', $data1);
            recache();
        }
    }

    /* ---------- NEWS POST Add, Edit, Update, Delete  -------- */

    function news($para1 = '', $para2 = '', $para3 = '') {
        if (!$this->Crud_model->admin_permission('all_news')) {
            redirect(base_url() . 'admin');
        }
        if ($para1 == 'do_add') {
            $data['title'] = $this->input->post('title');
            $data['summary'] = $this->input->post('summary');
            $data['description'] = $this->input->post('description');
            $data['news_category_id'] = $this->input->post('news_category');
            $data['news_sub_category_id'] = $this->input->post('news_sub_category');
            $data['news_speciality_id'] = $this->input->post('news_speciality');
            $data['date'] = strtotime($this->input->post('date'));
            $data['timestamp'] = time();
            $data['tag'] = $this->input->post('tag');
            $data['status'] = $this->input->post('status');
            $data['breaking_news'] = $this->input->post('breaking_news');
            if($this->input->post('status') == 'published'){
                $data['publish_timestamp']  = time();
            }
            else{
                $data['publish_timestamp']  = 0;
            }
            $data['news_reporter_id'] = $this->input->post('news_reporter');
            $data['news_uploader_id'] = $this->session->userdata('admin_id');
            $data['edited_by'] = '[]';
            $data['img_features'] = '[]';

            $this->db->insert('news', $data);
            $id = $this->db->insert_id();
            $img_features = array();
            if(!demo()){
                foreach ($_FILES['nimg']['name'] as $i => $row) {
                    if ($_FILES['nimg']['name'][$i] !== '') {
                        $ib = $i + 1;
                        $path = $_FILES['nimg']['name'][$i];
                        //$ext = pathinfo($path, PATHINFO_EXTENSION);
                        $ext = 'jpg';
                        $img = 'news_' . $id . '_' . $ib . '.' . $ext;
                        $img_thumb = 'news_' . $id . '_' . $ib . '_thumb.' . $ext;
                        $img_features[] = array('index' => $i, 'img' => $img, 'thumb' => $img_thumb);
                        move_uploaded_file($_FILES['nimg']['tmp_name'][$i], 'uploads/' . 'news' . '_image/' . 'news' . '_' . $id . '_' . $ib .'.'. $ext);
                        $this->Crud_model->img_thumb("news", $id . '_' . $ib, 'jpg');
                    }
                }

                //$this->Crud_model->file_up("nimg", "news", $id, 'multi');
                $data1['img_features'] = json_encode($img_features);
                $this->db->where('news_id', $id);
                $this->db->update('news', $data1);
            }
            recache();
        } else if ($para1 == 'to_archive') {
            if(!demo()){
                $news_data = $this->db->get_where('news', array('news_id' => $para2))->result_array();
                foreach ($news_data as $row) {
                    $data['news_archive_id'] = $row['news_id'];
                    $data['title'] = $row['title'];
                    $data['summary'] = $row['summary'];
                    $data['description'] = $row['description'];
                    $data['news_category_id'] = $row['news_category_id'];
                    $data['news_sub_category_id'] = $row['news_sub_category_id'];
                    $data['date'] = $row['date'];
                    $data['timestamp'] = $row['timestamp'];
                    $data['view_count'] = $row['view_count'];
                    $data['tag'] = $row['tag'];
                    $data['status'] = 'unpublished';
                    $data['publish_timestamp'] = $row['publish_timestamp'];
                    $data['news_speciality_id'] = $row['news_speciality_id'];
                    $data['news_reporter_id'] = $row['news_reporter_id'];
                    $data['news_uploader_id'] = $row['news_uploader_id'];
                    $data['edited_by'] = $row['edited_by'];
                    $data['img_features'] = $row['img_features'];
                    $data['serial'] = $row['serial'];
                    $archived_by[] = array('admin' => $this->session->userdata('admin_id'), 'timestamp' => time());
                    $data['archived_by'] = json_encode($archived_by);
                    $this->db->insert('news_archive', $data);
                }
                $this->db->where('news_id', $para2);
                $this->db->delete('news');
            }
            recache();
        } else if ($para1 == 'edit') {
            $page_data['news_data'] = $this->db->get_where('news', array('news_id' => $para2))->result_array();
            $this->load->view('back/admin/news_edit', $page_data);
        } else if ($para1 == 'view') {
            $page_data['news_data'] = $this->db->get_where('news', array(
                        'news_id' => $para2
                    ))->result_array();
            $this->load->view('back/admin/news_view', $page_data);
        }
        elseif ($para1 == "update") {
            $data['title'] = $this->input->post('title');
            $data['summary'] = $this->input->post('summary');
            $data['description'] = $this->input->post('description');
            $data['news_category_id'] = $this->input->post('news_category');
            $sub = $this->input->post('news_sub_category');
            if ($sub == '') {
                $data['news_sub_category_id'] = 0;
            } else {
                $data['news_sub_category_id'] = $this->input->post('news_sub_category');
            }
            $data['news_speciality_id'] = $this->input->post('news_speciality');
            $data['date'] = strtotime($this->input->post('date'));
            $data['tag'] = $this->input->post('tag');
            $data['status'] = $this->input->post('status');
            if($this->input->post('breaking_news') == ''){
                $data['breaking_news']  = 'no';
            }else{
                $data['breaking_news'] = $this->input->post('breaking_news');
            }
            $publish_time = $this->db->get_where('news',array('news_id' => $para2))->row()->publish_timestamp;
            if ($this->input->post('status') == 'published') {
                if($publish_time == 0){
                    $data['publish_timestamp'] = time();
                }
            }
            $data['news_uploader_id'] = $this->session->userdata('admin_id');
            $data['news_reporter_id'] = $this->input->post('news_reporter');
            $edited_by[] = array('admin' => $this->session->userdata('admin_id'), 'timestamp' => time());
            $data['edited_by'] = json_encode($edited_by);

            if(!demo()){

                $img_features = json_decode($this->db->get_where('news', array('news_id' => $para2))->row()->img_features, true);
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
                        //$ext = pathinfo($path, PATHINFO_EXTENSION);
                        $ext = 'jpg';
                        $img = 'news_' . $para2 . '_' . $ib . '.' . $ext;
                        $img_thumb = 'news_' . $para2 . '_' . $ib . '_thumb.' . $ext;
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
                        move_uploaded_file($_FILES['nimg']['tmp_name'][$i], 'uploads/news_image/' . $img);

                        $config1['image_library'] = 'gd2';
                        $config1['create_thumb'] = TRUE;
                        $config1['maintain_ratio'] = TRUE;
                        $config1['width'] = '400';
                        $config1['height'] = '400';
                        $config1['source_image'] = 'uploads/news_image/' . $img;

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
            }

            $this->db->where('news_id', $para2);
            $this->db->update('news', $data);
            recache();

        }
        elseif ($para1 == 'delete_img') {
            if(!demo()){
                $new_img_features = array();
                $old_img_features = json_decode($this->db->get_where('news', array('news_id' => $para2))->row()->img_features, true);
                foreach ($old_img_features as $row2) {
                    if ($row2['img'] == $para3) {
                        if (file_exists('uploads/news_image/' . $row2['img'])) {
                            unlink('uploads/news_image/' . $row2['img']);
                        }
                        if (file_exists('uploads/news_image/' . $row2['thumb'])) {
                            unlink('uploads/news_image/' . $row2['thumb']);
                        }
                    } else {
                        $new_img_features[] = $row2;
                    }
                }
                $data['img_features'] = json_encode($new_img_features);
                $this->db->where('news_id', $para2);
                $this->db->update('news', $data);
            }
            recache();
        } elseif ($para1 == 'delete') {
            if(!demo()){
                $img_features = json_decode($this->db->get_where('news', array('news_id' => $para2))->row()->img_features, true);

                foreach ($img_features as $row) {
                    if (file_exists('uploads/news_image/' . $row['img'])) {
                        unlink('uploads/news_image/' . $row['img']);
                    }
                    if (file_exists('uploads/news_image/' . $row['thumb'])) {
                        unlink('uploads/news_image/' . $row['thumb']);
                    }
                }

                $this->db->where('news_id', $para2);
                $this->db->delete('news');
            }
            recache();
        } elseif ($para1 == 'list') {
            $this->db->order_by('news_id', 'desc');
            $page_data['all_news'] = $this->db->get('news')->result_array();
            $this->load->view('back/admin/news_list', $page_data);
        } elseif ($para1 == 'list_data') {
            $limit = $this->input->get('limit');
            $search = $this->input->get('search');
            $order = $this->input->get('order');
            $offset = $this->input->get('offset');
            $sort = $this->input->get('sort');
            if ($search) {
                $this->db->like('title', $search, 'both');
            }
            $total = $this->db->get('news')->num_rows();
            $this->db->limit($limit);
            if ($sort == '') {
                $sort = 'news_id';
                $order = 'DESC';
            }
            $this->db->order_by($sort, $order);
            if ($search) {
                $this->db->like('title', $search, 'both');
            }
            $posts = $this->db->get('news', $limit, $offset)->result_array();
            $data = array();
            foreach ($posts as $row) {

                $res = array(
                    'image' => '',
                    'title' => '',
                    'category' => '',
                    'date' => '',
                    'status' => '',
                    'options' => ''
                );
                $img_features = json_decode($row['img_features'], true);
                $thumb = '';
                if(isset($img_features[0]['thumb'])){
                    $thumb = $img_features[0]['thumb'];
                }else{
                    $thumb = "default.jpg";
                }
                $update_timestamp = json_decode($row['edited_by']);
                if(!empty($update_timestamp)){
                    $update_time = date("F j, Y", $update_timestamp[0]->timestamp);
                }else{
                    $update_time = translate('not_updated_yet');
                }
                if($row['publish_timestamp'] != 0){
                    $publish_time = date("F j, Y", $row['publish_timestamp']);
                }else{
                    $publish_time = translate('not_published_yet');
                }

                $res['image'] = '<center><img class="img-md thumbnail" style="height:auto !important; border:1px solid #ddd;padding:2px; border-radius:2px !important;" src="' . base_url() . 'uploads/news_image/' . $thumb . '"  /></center>';
                $res['title'] = "<a class='label label-sm label-info add-tooltip' data-toggle='tooltip' href='".base_url()."home/news_description/".$row['news_id']."' target='_blank' data-original-title='".$row['title']."'>".translate('headline')."</a>";
                $category = $this->db->get_where('news_category', array('news_category_id' => $row['news_category_id']))->row()->name;
                $sub_category = $this->Crud_model->get_type_name_by_id('news_sub_category', $row['news_sub_category_id'], 'name');
                $res['category'] = '<ul><li class="text-left">' . $category . '</li>'.'<li class="text-left">'. $sub_category .'</li>'.'</ul>';
                $res['date'] = '<ul><li class="text-left">'.translate('uploaded').' : '.date("F j, Y", $row['timestamp']).'</li>' .
                                    '<li class="text-left">'.translate('published').' : '.$publish_time.'</li>' .
                                    '<li class="text-left">'.translate('updated').' : '.$update_time.'</li>';
                $res['visitor']  = $row['view_count'];
                $res['speciality']  = $this->Crud_model->get_type_name_by_id('news_speciality', $row['news_speciality_id'], 'name');
                if ($row['status'] == 'published') {
                    $res['status'] = '<center>' . "<input class='aiz_switchery' type=\"checkbox\"
                                    data-set='status'
                                        data-id='" . $row['news_id'] . "'
                                            data-tm='" . translate('news_published') . "'
                                                data-fm='" . translate('news_unpublished') . "'
                                                    checked />" . '</center>';
                } else {
                    $res['status'] = '<center>' . "<input class='aiz_switchery' type='checkbox'
                                    data-set='status'
                                        data-id='" . $row['news_id'] . "'
                                            data-tm='" . translate('news_published') . "'
                                                data-fm='" . translate('news_unpublished') . "' />" . '</center>';
                }
                if ($row['breaking_news'] == 'ok') {
                    $res['breaking_news'] = '<center>' . "<input class='aiz_switchery' type=\"checkbox\"
                                    data-set='breaking_news'
                                        data-id='" . $row['news_id'] . "'
                                            data-tm='" . translate('added_to_breaking_news') . "'
                                                data-fm='" . translate('removed_from_breaking_news') . "'
                                                    checked />" . '</center>';
                } else {
                    $res['breaking_news'] = '<center>' . "<input class='aiz_switchery' type='checkbox'
                                    data-set='breaking_news'
                                        data-id='" . $row['news_id'] . "'
                                            data-tm='" . translate('added_to_breaking_news') . "'
                                                data-fm='" . translate('removed_from_breaking_news') . "' />" . '</center>';
                }
                //add html for action
                $res['options'] = "
                    <center>
                        <a class=\"btn btn-mint btn-xs btn-icon icon-lg fa fa-files-o cop_news add-tooltip\" data-news_id='" . $row['news_id'] . "' data-toggle=\"tooltip\"
                            onclick=\"copy_news('" . $row['news_id'] . "')\" data-toggle=\"tooltip\" data-original-title= '".translate('copy')."'>
                                <i class=\"icon-copy\"></i>
                        </a>

                        <a class=\"btn btn-purple btn-xs btn-icon icon-lg fa fa-info add-tooltip\" data-toggle=\"tooltip\"
                            onclick=\"ajax_set_full('view','" . translate('news_view') . "','" . translate('successfully_viewed!') . "','news_view','" . $row['news_id'] . "');proceed('to_list');\" data-original-title= '".translate('news_information')."'>
                        </a>
                        <a class=\"btn btn-primary btn-xs btn-icon icon-lg fa fa-eye add-tooltip\" data-toggle=\"tooltip\" data-original-title= '".translate('view_news')."'
                            href='". base_url()."home/news_description/".$row['news_id']."' target=\"_blank\">
                        </a>
                        <a class=\"btn btn-info btn-xs btn-icon icon-lg fa fa-wrench add-tooltip\" data-toggle=\"tooltip\"
                            onclick=\"ajax_set_full('edit','" . translate('edit_news') . "','" . translate('successfully_edited!') . "','news_edit','" . $row['news_id'] . "');proceed('to_list');\" data-original-title= '".translate('edit_news')."'>
                        </a>

                        <a onclick=\"archive_confirm('" . $row['news_id'] . "','" . translate('really_want_to_move_this_news_to_archive?') . "')\"
                            class=\"btn btn-dark btn-xs btn-icon icon-lg fa fa-archive add-tooltip\" data-toggle=\"tooltip\" data-original-title= '".translate('move_to_archive_news')."' data-container=\"body\">
                        </a>

                        <a onclick=\"delete_confirm('" . $row['news_id'] . "','" . translate('really_want_to_delete_this?') . "')\"
                            class=\"btn btn-danger btn-xs btn-icon icon-lg fa fa-trash add-tooltip\" data-toggle=\"tooltip\" data-original-title= '".translate('delete_news')."' data-container=\"body\">
                        </a>
                    </center>";
                $data[] = $res;
            }
            $result = array(
                'total' => $total,
                'rows' => $data
            );

            echo json_encode($result);
        } elseif ($para1 == 'view') {
            $page_data['news_data'] = $this->db->get_where('news', array(
                        'news_id' => $para2
                    ))->result_array();
            $this->load->view('back/admin/news_view', $page_data);
        } elseif ($para1 == 'add') {
            $this->load->view('back/admin/news_add');
        } else if ($para1 == 'status') {
            $id = $para2;
            $publish_time = $this->db->get_where('news',array('news_id' => $id))->row()->publish_timestamp;
            if ($para3 == 'true') {
                if($publish_time == 0){
                    $data['publish_timestamp'] = time();
                }
                $data['status'] = 'published';
            } else {
                $data['status'] = 'unpublished';
            }
            $this->db->where('news_id', $id);
            $this->db->update('news', $data);
            recache();
        }else if ($para1 == 'breaking_news') {
            $id = $para2;
            if ($para3 == 'true') {
                $data['breaking_news'] = 'ok';
            } else {
                $data['breaking_news'] = 'no';
            }
            $this->db->where('news_id', $id);
            $this->db->update('news', $data);
            recache();
        } elseif ($para1 == 'sub_by_cat') {
            echo $this->Crud_model->select_html('news_sub_category', 'news_sub_category', 'name', 'add', 'demo-chosen-select', '', 'parent_category_id', $para2, '');
        } else {
            $page_data['page_name'] = "news";
            $page_data['all_newss'] = $this->db->get('news')->result_array();
            $this->load->view('back/index', $page_data);
        }
    }

    /* ------------- NEWS POST Ends -------------------- */

    // news bulk upload
    function news_bulk_add($para1 = '', $para2 = '', $para3 = '') {
        if (!$this->Crud_model->admin_permission('bulk_news_add')) {
            redirect(base_url() . 'admin');
        }
        if ($para1 == 'do_add') {

            $inputFileName = $_FILES['bulk_news_file']['tmp_name'];
            $inputFileType = $this->spreadsheet->identify($inputFileName);
            $reader = $this->spreadsheet->createReader($inputFileType);
            $spreadsheet = $reader->load($inputFileName);
            $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

            $newses = array();
            if(!empty($sheetData)){
                if(!isset($sheetData[1])){
                    $this->session->set_flashdata('error',translate('Column names are missing'));
                    redirect('admin/news_bulk_add');
                }

                foreach ($sheetData[1] as $colk => $colv){
                    $col_map[$colk] = $colv;
                }

                if(!isset($sheetData[2])){
                    $this->session->set_flashdata('error',translate('Data missing'));
                    redirect('admin/news_bulk_add');
                }

                for($i = 2;$i <= count($sheetData);$i++){
                    $news = array();
                    foreach ($sheetData[$i] as $colk =>$colv) {
                        $news[$col_map[$colk]] = $colv;
                    }
                    $newses[] = $news;
                }
            }

            if(!empty($newses)){
                foreach ($newses as $news){
                    $this->news_bulk_upload_save_single($news);
                }
            }
            $this->session->set_flashdata('success',translate('Bulk News uploaded'));
            redirect('admin/news_bulk_add');
        }
        else{
            $page_data['page_name'] = "news_bulk_add";
            $this->load->view('back/index', $page_data);
        }
    }

    // Single news upload form bulk
    public function news_bulk_upload_save_single($news)
    {
        $data['title'] = $news['title'];
        $data['summary'] = $news['summary'];
        $data['news_category_id'] = $news['news_category'];
        $data['news_sub_category_id'] = $news['news_sub_category'];
        $data['date'] = strtotime($news['date']) ;
        $data['timestamp'] = time();
        $data['tag'] = $news['tags'];
        $data['status'] = $news['status'];
        if($this->input->post('status') == 'published'){
            $data['publish_timestamp']  = time();
        }
        else{
            $data['publish_timestamp']  = 0;
        }
        $data['news_speciality_id'] = $news['news_speciality'];
        $data['news_reporter_id'] = $news['news_reporter'];
        $data['news_uploader_id'] = $this->session->userdata('admin_id');
        $data['edited_by'] = '[]';
        $data['img_features'] = '[]';

        $this->db->insert('news', $data);
        $id = $this->db->insert_id();

        if(!demo()){
            $image_urls = array();
            if(!empty($news['images'])){
                $image_urls = explode(',', $news['images']);
                $this->Crud_model->file_up_from_urls($image_urls,"news", $id);
            }
        }
    }

    function news_archive($para1 = '', $para2 = '', $para3 = '') {
        if ($para1 == 'list') {
            $this->db->order_by('news_archive_id', 'desc');
            $page_data['all_news'] = $this->db->get('news_archive')->result_array();
            $this->load->view('back/admin/news_list_archive', $page_data);
        } elseif ($para1 == 'list_data_archive') {
            $limit = $this->input->get('limit');
            $search = $this->input->get('search');
            $order = $this->input->get('order');
            $offset = $this->input->get('offset');
            $sort = $this->input->get('sort');
            if ($search) {
                $this->db->like('title', $search, 'both');
            }
            $total = $this->db->get('news_archive')->num_rows();
            $this->db->limit($limit);
            if ($sort == '') {
                $sort = 'news_archive_id';
                $order = 'DESC';
            }
            $this->db->order_by($sort, $order);
            if ($search) {
                $this->db->like('title', $search, 'both');
            }
            $posts = $this->db->get('news_archive', $limit, $offset)->result_array();
            $data = array();
            foreach ($posts as $row) {
                $res = array(
                    'image' => '',
                    'title' => '',
                    'date' => '',
                    'archived_by' => '',
                    'status' => '',
                    'options' => ''
                );
                $img_features = json_decode($row['img_features'], true);
                $thumb = $img_features[0]['thumb'];
                $res['image'] = '<center><img class="img-md thumbnail" style="height:auto !important; border:1px solid #ddd;padding:2px; border-radius:2px !important;" src="' . base_url() . 'uploads/news_image/' . $thumb . '"  /></center>';
                $res['title'] = limit_chars($row['title'], 150);
                $res['date'] = date("F j, Y", $row['date']);
                $archived_by = json_decode($row['archived_by'], true);
                foreach ($archived_by as $row2) {
                    $name = $this->db->get_where('admin', array('admin_id' => $row2['admin']))->row()->name;
                    $time = $row2['timestamp'];
                }
                $res['archived_by'] = '<center>' . $name . ' (' . date('d M,Y', $time) . ') ' . '</center>';
                if ($row['status'] == 'published') {
                    $res['status'] = '<center>' . "<input class='aiz_switchery' type=\"checkbox\"
                                    data-set='status'
                                        data-id='" . $row['news_archive_id'] . "'
                                            data-tm='" . translate('news_published') . "'
                                                data-fm='" . translate('news_unpublished') . "'
                                                    checked />" . '</center>';
                } else {
                    $res['status'] = '<center>' . "<input class='aiz_switchery' type='checkbox'
                                    data-set='status'
                                        data-id='" . $row['news_archive_id'] . "'
                                            data-tm='" . translate('news_published') . "'
                                                data-fm='" . translate('news_unpublished') . "' />" . '</center>';
                }
                //add html for action
                $res['options'] = "

                            <center>
                            <a class=\"btn btn-primary btn-xs btn-labeled fa fa-info\" data-toggle=\"tooltip\"
                                onclick=\"ajax_set_full('view','" . translate('news_view') . "','" . translate('successfully_viewed!') . "','news_view_archive','" . $row['news_archive_id'] . "');\" data-original-title=\"View\" data-container=\"body\">
                                    " . translate('news_info') . "
                            </a>
                            <a onclick=\"archive_confirm('" . $row['news_archive_id'] . "','" . translate('really_want_to_move_this_news_to_news_list?') . "')\"
                                class=\"btn btn-success btn-xs btn-labeled fa fa-check\" data-toggle=\"tooltip\" data-original-title=\"archive\" data-container=\"body\">
                                    " . translate('move_to_newslist') . "
                            </a>
                            <a onclick=\"delete_confirm('" . $row['news_archive_id'] . "','" . translate('really_want_to_delete_this?') . "')\"
                                class=\"btn btn-danger btn-xs btn-labeled fa fa-trash\" data-toggle=\"tooltip\" data-original-title=\"Delete\" data-container=\"body\">
                                    " . translate('delete') . "
                            </a></center>";
                $data[] = $res;
            }
            $result = array(
                'total' => $total,
                'rows' => $data
            );

            echo json_encode($result);
        } else if ($para1 == 'from_archive') {
            if(!demo()){
                $archive_data = $this->db->get_where('news_archive', array('news_archive_id' => $para2))->result_array();
                foreach ($archive_data as $row) {
                    $data['news_id'] = $row['news_archive_id'];
                    $data['title'] = $row['title'];
                    $data['summary'] = $row['summary'];
                    $data['description'] = $row['description'];
                    $data['news_category_id'] = $row['news_category_id'];
                    $data['news_sub_category_id'] = $row['news_sub_category_id'];
                    $data['date'] = $row['date'];
                    $data['timestamp'] = $row['timestamp'];
                    $data['tag'] = $row['tag'];
                    $data['news_speciality_id'] = $row['news_speciality_id'];
                    $data['view_count'] = $row['view_count'];
                    $data['news_reporter_id'] = $row['news_reporter_id'];
                    $data['news_uploader_id'] = $row['news_uploader_id'];
                    $data['edited_by'] = $row['edited_by'];
                    $data['img_features'] = $row['img_features'];
                    $data['publish_timestamp'] = $row['publish_timestamp'];
                    $data['status'] = 'unpublished';
                    $this->db->insert('news', $data);
                }
                $this->db->where('news_archive_id', $para2);
                $this->db->delete('news_archive');
            }
            recache();
        } elseif ($para1 == 'view') {
            $page_data['news_data'] = $this->db->get_where('news_archive', array(
                        'news_archive_id' => $para2
                    ))->result_array();
            $this->load->view('back/admin/news_view_archive', $page_data);
        } else if ($para1 == 'status') {
            $id = $para2;
            $publish_time = $this->db->get_where('news',array('news_id' => $id))->row()->publish_timestamp;
            if ($para3 == 'true') {
                if($publish_time == 0){
                    $data['publish_timestamp'] = time();
                }
                $data['status'] = 'published';
            } else {
                $data['status'] = 'unpublished';
            }
            $this->db->where('news_archive_id', $id);
            $this->db->update('news_archive', $data);
            recache();
        } elseif ($para1 == 'delete') {
            if(!demo()){
                $img_features = json_decode($this->db->get_where('news_archive', array('news_archive_id' => $para2))->row()->img_features, true);

                foreach ($img_features as $row) {
                    if (file_exists('uploads/news_image/' . $row['img'])) {
                        unlink('uploads/news_image/' . $row['img']);
                    }
                    if (file_exists('uploads/news_image/' . $row['thumb'])) {
                        unlink('uploads/news_image/' . $row['thumb']);
                    }
                }
                $this->db->where('news_archive_id', $para2);
                $this->db->delete('news_archive');
            }
            recache();
        } else {
            $page_data['page_name'] = "news_archive";
            $page_data['all_news'] = $this->db->get('news_archive')->result_array();
            $this->load->view('back/index', $page_data);
        }
    }
    /*
     * News Serail For Home page
     * Starts
     */
    function news_serial($para1 = '', $para2 = ''){
        if (!$this->Crud_model->admin_permission('news_serial')) {
            redirect(base_url() . 'admin');
        } else if ($para1 == 'do_update') {
            $updated_serial = array_reverse(json_decode($this->input->post('serial'),true));
            if($para2 == 'breaking'){
                $this->db->where('breaking_news', 'ok');
                $this->db->update('news',array('serial_breaking'=>'0'));
                foreach ($updated_serial as $i=>$row) {
                    $this->db->where('news_id', $row['id']);
                    $this->db->update('news',array('serial_breaking'=>$i));
                }
            } else {
                $this->db->where('news_speciality_id', $para2);
                $this->db->update('news',array('serial_'.$para2=>'0'));
                foreach ($updated_serial as $i=>$row) {
                    $this->db->where('news_id', $row['id']);
                    $this->db->update('news',array('serial_'.$para2=>$i));
                }
            }
            recache();
        }
        else {
            $page_data['page_name'] = "news_serial";
            $this->load->view('back/index', $page_data);
        }
    }
    /*
     * News Serail Ends
     */
    /* ------- Blog CATEGORY Add, Edit, View, Delete ------- */

    function blog_category($para1 = '', $para2 = '') {
        if (!$this->Crud_model->admin_permission('blog_category')) {
            redirect(base_url() . 'admin');
        }
        if ($para1 == 'do_add') {
            $data['name'] = $this->input->post('name');
            $this->db->insert('blog_category', $data);
            recache();
        } else if ($para1 == 'edit') {
            $page_data['category_data'] = $this->db->get_where('blog_category', array(
                        'blog_category_id' => $para2
                    ))->result_array();
            $this->load->view('back/admin/blog_category_edit', $page_data);
        } elseif ($para1 == "update") {
            $data['name'] = $this->input->post('name');
            $this->db->where('blog_category_id', $para2);
            $this->db->update('blog_category', $data);
            recache();
        } elseif ($para1 == 'delete') {
            if(!demo()){
                $this->db->where('blog_category_id', $para2);
                $this->db->delete('blog_category');
            }
            recache();
        } elseif ($para1 == 'list') {
            $this->db->order_by('blog_category_id', 'desc');
            $page_data['all_categories'] = $this->db->get('blog_category')->result_array();
            $this->load->view('back/admin/blog_category_list', $page_data);
        } elseif ($para1 == 'add') {
            $this->load->view('back/admin/blog_category_add');
        } else {
            $page_data['page_name'] = "blog_category";
            $page_data['all_categories'] = $this->db->get('blog_category')->result_array();
            $this->load->view('back/index', $page_data);
        }
    }

    /* ------- Blog CATEGORY ENDS ------- */


    /* ------- Blog SUB-CATEGORY Add, Edit, Update, Delete ---------- */

    function blog_sub_category($para1 = '', $para2 = '') {
        if (!$this->Crud_model->admin_permission('blog_sub_category')) {
            redirect(base_url() . 'admin');
        }
        if ($para1 == 'do_add') {
            $data['name'] = $this->input->post('name');
            $data['parent_category_id'] = $this->input->post('parent_category_id');
            $this->db->insert('blog_sub_category', $data);
            recache();
        } else if ($para1 == 'edit') {
            $page_data['sub_category_data'] = $this->db->get_where('blog_sub_category', array(
                        'blog_sub_category_id' => $para2
                    ))->result_array();
            $this->load->view('back/admin/blog_sub_category_edit', $page_data);
        } elseif ($para1 == "update") {
            $data['parent_category_id'] = $this->input->post('parent_category_id');
            $data['name'] = $this->input->post('name');
            $this->db->where('blog_sub_category_id', $para2);
            $this->db->update('blog_sub_category', $data);
            recache();
        } elseif ($para1 == 'delete') {
            if(!demo()){
                $this->db->where('blog_sub_category_id', $para2);
                $this->db->delete('blog_sub_category');
            }
            recache();
        } elseif ($para1 == 'list') {
            $this->db->order_by('blog_sub_category_id', 'desc');
            $page_data['all_sub_categories'] = $this->db->get('blog_sub_category')->result_array();
            $page_data['all_categories'] = $this->db->get('blog_category')->result_array();
            $this->load->view('back/admin/blog_sub_category_list', $page_data);
        } elseif ($para1 == 'add') {
            $this->load->view('back/admin/blog_sub_category_add');
        } else {
            $page_data['page_name'] = "blog_sub_category";
            $page_data['all_categories'] = $this->db->get('blog_category')->result_array();
            $page_data['all_sub_categories'] = $this->db->get('blog_sub_category')->result_array();
            $this->load->view('back/index', $page_data);
        }
    }

    /* --------- Blog SUB-CATEGORY Ends ----------- */

    /*--------------Blog Photo Starts---------------*/
    function blog_photo($para1 = '', $para2 = '', $para3 = '') {
        if (!$this->Crud_model->admin_permission('blog')) {
            redirect(base_url() . 'admin');
        } else if ($para1 == 'list') {
            $this->db->order_by('blog_photo_id','desc');
            $page_data['photo_list'] = $this->db->get('blog_photo')->result_array();
            $this->load->view('back/admin/blog_photo_list', $page_data);
        } else if ($para1 == 'edit') {
            $page_data['photo_data'] = $this->db->get_where('blog_photo', array('blog_photo_id' => $para2))->result_array();
            $this->load->view('back/admin/blog_photo_edit', $page_data);
        } else if ($para1 == 'update') {
            $id = $para2;
            $data['title'] = $this->input->post('title');
            $data['description'] = $this->input->post('description');
            if(!demo()){
                $img_features = json_decode($this->db->get_where('blog_photo', array('blog_photo_id' => $para2))->row()->img_features, true);
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
                        $img = 'blog_photo_' . $para2 . '_' . $ib . '.' . $ext;
                        $img_thumb = 'blog_photo_' . $para2 . '_' . $ib . '_thumb.' . $ext;
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
            }
            $this->db->where('blog_photo_id', $para2);
            $this->db->update('blog_photo', $data);
            recache();
        } elseif ($para1 == 'delete_img') {
            if(!demo()){
                $new_img_features = array();
                $old_img_features = json_decode($this->db->get_where('blog_photo', array('blog_photo_id' => $para2))->row()->img_features, true);
                foreach ($old_img_features as $row2) {
                    if ($row2['img'] == $para3) {
                        if (file_exists('uploads/news_image/' . $row2['img'])) {
                            unlink('uploads/news_image/' . $row2['img']);
                        }
                        if (file_exists('uploads/news_image/' . $row2['thumb'])) {
                            unlink('uploads/news_image/' . $row2['thumb']);
                        }
                    } else {
                        $new_img_features[] = $row2;
                    }
                }
                $data['img_features'] = json_encode($new_img_features);
                $this->db->where('blog_photo_id', $para2);
                $this->db->update('blog_photo', $data);
            }
            recache();
        } else if ($para1 == 'status') {
            if ($para3 == 'true') {
                $data['status'] = 'published';
            } else {
                $data['status'] = 'unpublished';
            }
            $this->db->where('blog_photo_id', $para2);
            $this->db->update('blog_photo', $data);
            recache();
        } elseif ($para1 == 'delete') {
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
        } else {
            $page_data['page_name'] = 'blog_photo';
            $this->load->view('back/index', $page_data);
        }
    }
    /*--------------Blog Photo Ends---------------*/

    /*-------------Blog Video Starts--------------*/
    function blog_video($para1 = '', $para2 = '', $para3 = '') {
        if (!$this->Crud_model->admin_permission('media')) {
            redirect(base_url() . 'admin');
        }
        if ($para1 == 'list') {
            $this->db->order_by('blog_video_id', 'desc');
            $page_data['all_videos'] = $this->db->get('blog_video')->result_array();
            $this->load->view('back/admin/blog_video_list', $page_data);
        } else if ($para1 == 'edit') {
            $page_data['video_data'] = $this->db->get_where('blog_video', array('blog_video_id' => $para2))->result_array();
            $this->load->view('back/admin/blog_video_edit', $page_data);
        } else if ($para1 == 'update') {
            $type = $this->db->get_where('blog_video', array('blog_video_id' => $para2))->row()->type;
            $data['title'] = $this->input->post('title');
            $data['description'] = $this->input->post('vdo_desc');
            if(!demo()){
                if ($this->input->post('change_check') == 1) {
                    if ($type == 'upload') {
                        $src = $this->db->get_where('blog_video', array('blog_video_id' => $para2))->row()->video_src;
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
                            move_uploaded_file($_FILES['upload_video']['tmp_name'], 'uploads/blog_video/blog_video_' . $para2 . '.' . $ext);
                            $data['video_src'] = 'uploads/blog_video/blog_video_' . $para2 . '.' . $ext;
                        }
                    }
                    else if ($this->input->post('upload_method') == 'share') {
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
            }
            $this->db->where('blog_video_id', $para2);
            $this->db->update('blog_video', $data);
            recache();
        } else if ($para1 == 'preview') {
            if ($para2 == 'youtube') {
                echo '<iframe width="400" height="300" src="https://www.youtube.com/embed/' . $para3 . '" frameborder="0"></iframe>';
            } else if ($para2 == 'dailymotion') {
                echo '<iframe width="400" height="300" src="//www.dailymotion.com/embed/video/' . $para3 . '" frameborder="0"></iframe>';
            } else if ($para2 == 'vimeo') {
                echo '<iframe src="https://player.vimeo.com/video/' . $para3 . '" width="400" height="300" frameborder="0"></iframe>';
            }
        } else if ($para1 == 'status') {
            if ($para3 == 'true') {
                $data['status'] = 'published';
            } else {
                $data['status'] = 'unpublished';
            }
            $this->db->where('blog_video_id', $para2);
            $this->db->update('blog_video', $data);
            recache();
        } else if ($para1 == 'delete') {
            if(!demo()){
                $src = $this->db->get_where('blog_video', array('blog_video_id' => $para2))->row()->video_src;
                if (file_exists($src)) {
                    unlink($src);
                }
                $this->db->where('blog_video_id', $para2);
                $this->db->delete('blog_video');
            }
            recache();
        } else {
            $page_data['page_name'] = 'blog_video';
            $this->load->view('back/index', $page_data);
        }
    }
    /*-------------Blog Video Ends--------------*/

    /* ----------  Blog Add, Edit, Update, Delete  -------- */
    function blog($para1 = '', $para2 = '', $para3 = '') {
        if (!$this->Crud_model->admin_permission('all_blog')) {
            redirect(base_url() . 'admin');
        }
        if ($para1 == 'edit') {
            $page_data['blog_data'] = $this->db->get_where('blog', array('blog_id' => $para2))->result_array();
            $this->load->view('back/admin/blog_edit', $page_data);
        } else if ($para1 == 'view') {
            $page_data['blog_data'] = $this->db->get_where('blog', array(
                        'blog_id' => $para2
                    ))->result_array();
            $this->load->view('back/admin/blog_view', $page_data);
        } elseif ($para1 == "update") {
            $data['title'] = $this->input->post('title');
            $data['summary'] = $this->input->post('summary');
            $data['description'] = $this->input->post('description');
            $data['blog_category_id'] = $this->input->post('blog_category');
            $sub = $this->input->post('blog_sub_category');
            if ($sub == '') {
                $data['blog_sub_category_id'] = 0;
            } else {
                $data['blog_sub_category_id'] = $this->input->post('blog_sub_category');
            }
            $data['date'] = strtotime($this->input->post('date'));
            $data['tag'] = $this->input->post('tag');
            $data['status'] = $this->input->post('status');
            $publish_time = $this->db->get_where('blog',array('blog_id' => $para2))->row()->publish_timestamp;
            if ($this->input->post('status') == 'published') {
                if($publish_time == 0){
                    $data['publish_timestamp'] = time();
                }
            }
            $data['blog_uploader_id'] = $this->session->userdata('admin_id');
            $edited_by[] = array('admin' => $this->session->userdata('admin_id'), 'timestamp' => time());
            $data['edited_by'] = json_encode($edited_by);
            if(!demo()){
                $img_features = json_decode($this->db->get_where('blog', array('blog_id' => $para2))->row()->img_features, true);
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
                        $img = 'blog_' . $para2 . '_' . $ib . '.' . $ext;
                        $img_thumb = 'blog_' . $para2 . '_' . $ib . '_thumb.' . $ext;
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
            }
            $this->db->where('blog_id', $para2);
            $this->db->update('blog', $data);
            recache();
        } elseif ($para1 == 'delete_img') {
            if(!demo()){
                $new_img_features = array();
                $old_img_features = json_decode($this->db->get_where('blog', array('blog_id' => $para2))->row()->img_features, true);
                foreach ($old_img_features as $row2) {
                    if ($row2['img'] == $para3) {
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
                $this->db->where('blog_id', $para2);
                $this->db->update('blog', $data);
            }
            recache();
        }
        elseif ($para1 == 'delete') {
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
        elseif ($para1 == 'list') {
            $this->db->order_by('blog_id', 'desc');
            $page_data['all_blogs'] = $this->db->get('blog')->result_array();
            $this->load->view('back/admin/blog_list', $page_data);
        }
        elseif ($para1 == 'list_data') {
            $limit = $this->input->get('limit');
            $search = $this->input->get('search');
            $order = $this->input->get('order');
            $offset = $this->input->get('offset');
            $sort = $this->input->get('sort');
            if ($search) {
                $this->db->like('title', $search, 'both');
            }
            $total = $this->db->get('blog')->num_rows();
            $this->db->limit($limit);
            if ($sort == '') {
                $sort = 'blog_id';
                $order = 'DESC';
            }
            $this->db->order_by($sort, $order);
            if ($search) {
                $this->db->like('title', $search, 'both');
            }
            $posts = $this->db->get('blog', $limit, $offset)->result_array();
            $data = array();
            foreach ($posts as $row) {

                $res = array(
                    'image' => '',
                    'title' => '',
                    'category' => '',
                    'uploader' => '',
                    'date' => '',
                    'status' => '',
                    'options' => ''
                );
                $img_features = json_decode($row['img_features'], true);
                $thumb = '';
                if(isset($img_features[0]['thumb'])){
                    $thumb = $img_features[0]['thumb'];
                }
                $update_timestamp = json_decode($row['edited_by']);
                if(!empty($update_timestamp)){
                    $update_time = date("F j, Y", $update_timestamp[0]->timestamp);
                }else{
                    $update_time = translate('not_updated_yet');
                }
                if($row['publish_timestamp'] != 0){
                    $publish_time = date("F j, Y", $row['publish_timestamp']);
                }else{
                    $publish_time = translate('not_published_yet');
                }

                $res['image'] = '<center><img class="img-md thumbnail" style="height:auto !important; border:1px solid #ddd;padding:2px; border-radius:2px !important;" src="' . base_url() . 'uploads/blog_image/' . $thumb . '"  /></center>';
                $res['title'] = "<a class='label label-sm label-info add-tooltip' data-toggle='tooltip' href='".base_url()."home/blog_detail/".$row['blog_id']."' target='_blank' data-original-title='".$row['title']."'>".translate('headline')."</a>";
                $category = $this->db->get_where('blog_category', array('blog_category_id' => $row['blog_category_id']))->row()->name;
                $sub_category = $this->Crud_model->get_type_name_by_id('blog_sub_category', $row['blog_sub_category_id'], 'name');
                $res['category'] = '<ul><li class="text-left">' . $category . '</li>'.'<li class="text-left">'. $sub_category .'</li>'.'</ul>';
                if($row['blog_uploader_type'] == 'admin'){
                    $res['uploader'] = translate('admin');
                } else {
                    $res['uploader'] = translate('user');
                }
                $res['date'] = '<ul><li class="text-left">'.translate('uploaded').' : '.date("F j, Y", $row['timestamp']).'</li>' .
                                    '<li class="text-left">'.translate('published').' : '.$publish_time.'</li>' .
                                    '<li class="text-left">'.translate('updated').' : '.$update_time.'</li>';
                $res['visitor']  = $row['view_count'];
                if ($row['status'] == 'published') {
                    $res['status'] = '<center>' . "<input class='aiz_switchery' type=\"checkbox\"
                                    data-set='status'
                                        data-id='" . $row['blog_id'] . "'
                                            data-tm='" . translate('blog_published') . "'
                                                data-fm='" . translate('blog_unpublished') . "'
                                                    checked />" . '</center>';
                } else {
                    $res['status'] = '<center>' . "<input class='aiz_switchery' type='checkbox'
                                    data-set='status'
                                        data-id='" . $row['blog_id'] . "'
                                            data-tm='" . translate('blog_published') . "'
                                                data-fm='" . translate('blog_unpublished') . "' />" . '</center>';
                }
                //add html for action
                $res['options'] = "
                    <center>

                        <a class=\"btn btn-purple btn-xs btn-icon icon-lg fa fa-info add-tooltip\" data-toggle=\"tooltip\"
                            onclick=\"ajax_set_full('view','" . translate('blog_view') . "','" . translate('successfully_viewed!') . "','blog_view','" . $row['blog_id'] . "');proceed('to_list');\" data-original-title= '".translate('blog_information')."'>
                        </a>
                        <a class=\"btn btn-primary btn-xs btn-icon icon-lg fa fa-eye add-tooltip\" data-toggle=\"tooltip\" data-original-title= '".translate('view_blog')."'
                            href='". base_url()."home/blog_detail/".$row['blog_id']."' target=\"_blank\">
                        </a>
                        <a class=\"btn btn-info btn-xs btn-icon icon-lg fa fa-wrench add-tooltip\" data-toggle=\"tooltip\"
                            onclick=\"ajax_set_full('edit','" . translate('edit_blog') . "','" . translate('successfully_edited!') . "','blog_edit','" . $row['blog_id'] . "');proceed('to_list');\" data-original-title= '".translate('edit_blog')."'>
                        </a>

                        <a onclick=\"delete_confirm('" . $row['blog_id'] . "','" . translate('really_want_to_delete_this?') . "')\"
                            class=\"btn btn-danger btn-xs btn-icon icon-lg fa fa-trash add-tooltip\" data-toggle=\"tooltip\" data-original-title= '".translate('delete_blog')."' data-container=\"body\">
                        </a>
                    </center>";
                $data[] = $res;
            }
            $result = array(
                'total' => $total,
                'rows' => $data
            );

            echo json_encode($result);
        } elseif ($para1 == 'view') {
            $page_data['blog_data'] = $this->db->get_where('blog', array(
                        'blog_id' => $para2
                    ))->result_array();
            $this->load->view('back/admin/blog_view', $page_data);
        }
        else if ($para1 == 'status') {
            $id = $para2;
            $publish_time = $this->db->get_where('blog',array('blog_id' => $id))->row()->publish_timestamp;
            if ($para3 == 'true') {
                if($publish_time == 0){
                    $data['publish_timestamp'] = time();
                }
                $data['status'] = 'published';
            } else {
                $data['status'] = 'unpublished';
            }
            $this->db->where('blog_id', $id);
            $this->db->update('blog', $data);
            recache();
        } elseif ($para1 == 'sub_by_cat') {
            echo $this->Crud_model->select_html('blog_sub_category', 'blog_sub_category', 'name', 'add', 'demo-chosen-select', '', 'parent_category_id', $para2, '');
        } else {
            $page_data['page_name'] = "blog";
            $page_data['all_blogs'] = $this->db->get('blog')->result_array();
            $this->load->view('back/index', $page_data);
        }
    }

    function blog_post($para1 = '', $para2 = '', $para3='')
    {
        if($para1 == 'blog_post'){
            if($para2 == 'sub_by_cat'){
                echo $this->Crud_model->select_html('blog_sub_category', 'blog_sub_category', 'name', 'add', 'demo-chosen-select required', '', 'parent_category_id', $para3, '');
            }
            if($para2 == 'do_add'){
                $this->form_validation->set_rules('title', translate('title'), 'required');
                $this->form_validation->set_rules('summary', translate('summary'), 'required');
                $this->form_validation->set_rules('blog_category', translate('blog_category'), 'required');
                $this->form_validation->set_rules('blog_sub_category', translate('blog_sub_category'), 'required');

                if ($this->form_validation->run() == FALSE) {
                    echo "<br>".validation_errors();
                } else {
                    $user_id = $this->session->userdata('admin_id');

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
                    $data['blog_uploader_id'] = $user_id;
                    $data['blog_uploader_type'] = 'admin';
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
                    recache();
                }
            }
        }
        else if($para1 == 'blog_image_post') {
            $this->form_validation->set_rules('title', translate('title'), 'required');
            foreach ($_FILES['nimg']['name'] as $i => $row) {
                if (empty($_FILES['nimg']['name'][$i])) {
                    $this->form_validation->set_rules('nimg', translate('image'), 'required');
                    break;
                }
            }
            if ($this->form_validation->run() == FALSE) {
                echo "<br>".validation_errors();
            }
            else {
                $user_id = $this->session->userdata('admin_id');
                $data['title'] = $this->input->post('title');
                $data['description'] = $this->input->post('description');
                $data['status'] = 'published';
                $data['hide_status'] = 'false';
                $data['timestamp'] = time();
                $data['blog_photo_uploader_type'] = 'admin';
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
                echo "done";
            }
        }
        else if($para1 ==  'blog_video_post')
        {
            if(!demo()){
                $this->form_validation->set_rules('title', translate('video_title'), 'required');
                $this->form_validation->set_rules('summary', translate('video_description'), 'required');

                if ($this->form_validation->run() == FALSE) {
                    echo "<br>".validation_errors();
                }
                else {
                    $user_id = $this->session->userdata('admin_id');

                    $data['title'] = $this->input->post('title');
                    $data['description'] = $this->input->post('summary');
                    $data['status'] = 'published';
                    $data['hide_status'] = 'false';
                    $data['timestamp'] = time();
                    $data['blog_video_uploader_type'] = 'admin';
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
                    }
                    elseif ($this->input->post('upload_method') == 'share') {
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

                    recache();
                    echo "done";
                }
            }
            recache();
        }
        else if($para1 == '')
        {
            $page_data['page_name'] = "blog_post";
            $this->load->view('back/index', $page_data);
        }

    }

    /* -------------  Blog Ends -------------------- */

    /* ----------- POLL Add, Edit, Delete, Update --------- */

    function poll($para1 = '', $para2 = '', $para3 = '') {
        if (!$this->Crud_model->admin_permission('poll')) {
            redirect(base_url() . 'admin');
        }
        if ($para1 == 'do_add') {
            $data['question'] = $this->input->post('ques');
            $data['status'] = 'published';
            $data['uploader'] = $this->session->userdata('admin_id');
            $data['options'] = '[]';
            $data['edited_by'] = '[]';
            $this->db->insert('poll', $data);

            $id = $this->db->insert_id();

            $ftitles = $this->input->post('ftitle');
            $options = array();

            if (!empty($ftitles)) {
                foreach ($ftitles as $i => $row) {
                    $options[] = array('index' => $i, 'title' => $row, 'count' => 0);
                }
            }

            $data1['options'] = json_encode($options);
            $this->db->where('poll_id', $id);
            $this->db->update('poll', $data1);
            recache();
            echo 'success';
        } else if ($para1 == 'edit') {
            $page_data['poll_data'] = $this->db->get_where('poll', array(
                        'poll_id' => $para2
                    ))->result_array();
            $this->load->view('back/admin/poll_edit', $page_data);
        } else if ($para1 == 'view') {
            $page_data['poll_data'] = $this->db->get_where('poll', array(
                        'poll_id' => $para2
                    ))->result_array();
            $this->load->view('back/admin/poll_view', $page_data);
        } elseif ($para1 == "update") {
            $data['question'] = $this->input->post('ques');
            $data['status'] = 'published';
            $data['uploader'] = $this->session->userdata('admin_id');
            $edited_by[] = array('admin' => $this->session->userdata('admin_id'), 'timestamp' => time());
            $data['edited_by'] = json_encode($edited_by);
            $options = array();
            $ftitles = $this->input->post('ftitle');

            if (!empty($ftitles)) {
                foreach ($ftitles as $i => $row) {
                    $options[] = array(
                        'index' => $i, 'title' => $row, 'count' => 0
                    );
                }
            }

            $data['options'] = json_encode($options);
            $this->db->where('poll_id', $para2);
            $this->db->update('poll', $data);
            recache();
        } elseif ($para1 == 'delete') {
            if(!demo()){
                $this->db->where('poll_id', $para2);
                $this->db->delete('poll');
            }
            recache();
        } elseif ($para1 == 'list') {
            $this->db->order_by('poll_id', 'desc');
            $page_data['all_polls'] = $this->db->get('poll')->result_array();
            $this->load->view('back/admin/poll_list', $page_data);
        } elseif ($para1 == 'view') {
            $page_data['poll_data'] = $this->db->get_where('poll', array(
                        'post_id' => $para2
                    ))->result_array();
            $this->load->view('back/admin/poll_view', $page_data);
        } elseif ($para1 == 'add') {
            $this->load->view('back/admin/poll_add');
        } else if ($para1 == 'status') {
            $id = $para2;
            if ($para3 == 'true') {
                $data['status'] = 'published';
            } else {
                $data['status'] = 'unpublished';
            }
            $this->db->where('poll_id', $id);
            $this->db->update('poll', $data);
            recache();
        } else {
            $page_data['page_name'] = "poll";
            $page_data['all_polls'] = $this->db->get('poll')->result_array();
            $this->load->view('back/index', $page_data);
        }
    }

    /* ------------- POLL Ends ------------------ */

    /* --------------- MEDIA Add, Edit, Update, Delete ---------------- */

    function video($para1 = '', $para2 = '', $para3 = '') {
        if (!$this->Crud_model->admin_permission('media')) {
            redirect(base_url() . 'admin');
        }
        if ($para1 == 'list') {
            $this->db->order_by('video_id', 'desc');
            $page_data['all_videos'] = $this->db->get('video')->result_array();
            $this->load->view('back/admin/video_list', $page_data);
        } else if ($para1 == 'add') {
            $this->load->view('back/admin/video_add');
        } else if ($para1 == 'do_add') {
            if(!demo()){
                $data['title'] = $this->input->post('title');
                $data['description'] = $this->input->post('vdo_desc');
                $data['status'] = 'unpublished';
                if ($this->input->post('upload_method') == 'upload') {
                    $data['type'] = 'upload';
                    $data['from'] = 'local';
                    $data['video_link'] = '';
                    $data['video_src'] = '';
                    $this->db->insert('video', $data);
                    $id = $this->db->insert_id();
                    $video = $_FILES['upload_video']['name'];
                    $ext = pathinfo($video, PATHINFO_EXTENSION);
                    move_uploaded_file($_FILES['upload_video']['tmp_name'], 'uploads/video/video_' . $id . '.' . $ext);
                    $data['video_src'] = 'uploads/video/video_' . $id . '.' . $ext;
                    $this->db->where('video_id', $id);
                    $this->db->update('video', $data);
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
                    $this->db->insert('video', $data);
                    $id = $this->db->insert_id();
                }
            }
            recache();
        }
        else if ($para1 == 'edit') {
            $page_data['video_data'] = $this->db->get_where('video', array('video_id' => $para2))->result_array();
            $this->load->view('back/admin/video_edit', $page_data);
        } else if ($para1 == 'update') {
            if(!demo()){
                $type = $this->db->get_where('video', array('video_id' => $para2))->row()->type;
                $data['title'] = $this->input->post('title');
                $data['description'] = $this->input->post('vdo_desc');
                if ($this->input->post('change_check') == 1) {
                    if ($type == 'upload') {
                        $src = $this->db->get_where('video', array('video_id' => $para2))->row()->video_src;
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
                            move_uploaded_file($_FILES['upload_video']['tmp_name'], 'uploads/video/video_' . $para2 . '.' . $ext);
                            $data['video_src'] = 'uploads/video/video_' . $para2 . '.' . $ext;
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
                $this->db->where('video_id', $para2);
                $this->db->update('video', $data);
            }
            recache();
        } else if ($para1 == 'preview') {
            if ($para2 == 'youtube') {
                echo '<iframe width="400" height="300" src="https://www.youtube.com/embed/' . $para3 . '" frameborder="0"></iframe>';
            } else if ($para2 == 'dailymotion') {
                echo '<iframe width="400" height="300" src="//www.dailymotion.com/embed/video/' . $para3 . '" frameborder="0"></iframe>';
            } else if ($para2 == 'vimeo') {
                echo '<iframe src="https://player.vimeo.com/video/' . $para3 . '" width="400" height="300" frameborder="0"></iframe>';
            }
        } else if ($para1 == 'status') {
            if ($para3 == 'true') {
                $data['status'] = 'published';
            } else {
                $data['status'] = 'unpublished';
            }
            $this->db->where('video_id', $para2);
            $this->db->update('video', $data);
            recache();
        } else if ($para1 == 'delete') {
            if(!demo()){
                $src = $this->db->get_where('video', array('video_id' => $para2))->row()->video_src;
                if (file_exists($src)) {
                    unlink($src);
                }
                $this->db->where('video_id', $para2);
                $this->db->delete('video');
            }
            recache();
        } else {
            $page_data['page_name'] = 'video';
            $this->load->view('back/index', $page_data);
        }
    }

    function audio($para1 = '', $para2 = '') {
        if (!$this->Crud_model->admin_permission('media')) {
            redirect(base_url() . 'admin');
        }
        if ($para1 == 'list') {
            $this->db->order_by('audio_id', 'desc');
            $page_data['audio_list'] = $this->db->get('audio')->result_array();
            $this->load->view('back/admin/audio_list', $page_data);
        } else if ($para1 == 'add') {
            $this->load->view('back/admin/audio_add');
        } else if ($para1 == 'do_add') {
            $page_data['description'] = $this->input->post('audio_desc');
            $this->db->insert('audio', $page_data);
            $id = $this->db->insert_id();

            $audiofile = $_FILES['upload_audio']['name'];
            $ext = pathinfo($audiofile, PATHINFO_EXTENSION);
            move_uploaded_file($_FILES['upload_audio']['tmp_name'], 'uploads/media/audio/audio_' . $id . '.' . $ext);
            $page_data['name'] = 'audio_' . $id . '.' . $ext;
            $page_data['audio_src'] = 'uploads/media/audio/audio_' . $id . '.' . $ext;
            $this->db->where('audio_id', $id);
            $this->db->update('audio', $page_data);
            recache();
        } else if ($para1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('audio', array('audio_id' => $para2))->result_array();
            $this->load->view('back/admin/audio_edit', $page_data);
        } else if ($para1 == 'update') {
            $page_data['description'] = $this->input->post('audio_desc');
            $id = $para2;
            if (!($_FILES['upload_audio']['name'] == '')) {
                $audio = $_FILES['upload_audio']['name'];
                $ext = pathinfo($audio, PATHINFO_EXTENSION);
                move_uploaded_file($_FILES['upload_audio']['tmp_name'], 'uploads/media/audio/audio_' . $id . '.' . $ext);
            }
            $this->db->where('audio_id', $id);
            $this->db->update('audio', $page_data);
            recache();
        } else if ($para1 == 'delete') {
            if(!demo()){
                $audio = $this->db->get_where('audio', array('audio_id' => $para2))->result_array();
                if (file_exists($audio['audio_src'])) {
                    unlink($audio['audio_src']);
                }
                $this->db->where('audio_id', $para2);
                $this->db->delete('audio');
            }
            recache();
        } else {
            $page_data['page_name'] = 'audio';
            $this->load->view('back/index', $page_data);
        }
    }

    function photo($para1 = '', $para2 = '', $para3 = '') {
        if (!$this->Crud_model->admin_permission('media')) {
            redirect(base_url() . 'admin');
        } else if ($para1 == 'list') {
            $this->db->order_by('photo_id','desc');
            $page_data['photo_list'] = $this->db->get('photo')->result_array();
            $this->load->view('back/admin/photo_list', $page_data);
        } else if ($para1 == 'add') {
            $this->load->view('back/admin/photo_add');
        } else if ($para1 == 'do_add') {
            if(!demo()){
                $data['title'] = $this->input->post('title');
                $data['description'] = $this->input->post('description');
                $data['status'] = 'unpublished';
                $data['img_features'] = '[]';

                $this->db->insert('photo', $data);
                $id = $this->db->insert_id();
                $img_features = array();
                $this->load->library('image_lib');
                ini_set("memory_limit", "-1");
                foreach ($_FILES['nimg']['name'] as $i => $row) {
                    if ($_FILES['nimg']['name'][$i] !== '') {
                        $ib = $i + 1;
                        $path = $_FILES['nimg']['name'][$i];
                        $ext = pathinfo($path, PATHINFO_EXTENSION);
                        $img = 'photo_' . $id . '_' . $ib . '.' . $ext;
                        $img_thumb = 'photo_' . $id . '_' . $ib . '_thumb.' . $ext;
                        $img_features[] = array('index' => $i, 'img' => $img, 'thumb' => $img_thumb);
                        move_uploaded_file($_FILES['nimg']['tmp_name'][$i], 'uploads/photo_image/' . $img);

                        $config1['image_library'] = 'gd2';
                        $config1['create_thumb'] = TRUE;
                        $config1['maintain_ratio'] = TRUE;
                        $config1['width'] = '400';
                        $config1['height'] = '400';
                        $config1['source_image'] = 'uploads/photo_image/' . $img;

                        $this->image_lib->initialize($config1);
                        $this->image_lib->resize();
                        $this->image_lib->clear();
                    }
                }
                $data1['img_features'] = json_encode($img_features);
                $this->db->where('photo_id', $id);
                $this->db->update('photo', $data1);
            }
            recache();
        } else if ($para1 == 'edit') {
            $page_data['photo_data'] = $this->db->get_where('photo', array('photo_id' => $para2))->result_array();
            $this->load->view('back/admin/photo_edit', $page_data);
        } else if ($para1 == 'update') {
            if(!demo()){
                $id = $para2;
                $data['title'] = $this->input->post('title');
                $data['description'] = $this->input->post('description');

                $img_features = json_decode($this->db->get_where('photo', array('photo_id' => $para2))->row()->img_features, true);
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
                        $img = 'photo_' . $para2 . '_' . $ib . '.' . $ext;
                        $img_thumb = 'photo_' . $para2 . '_' . $ib . '_thumb.' . $ext;
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
                        move_uploaded_file($_FILES['nimg']['tmp_name'][$i], 'uploads/photo_image/' . $img);

                        $config1['image_library'] = 'gd2';
                        $config1['create_thumb'] = TRUE;
                        $config1['maintain_ratio'] = TRUE;
                        $config1['width'] = '400';
                        $config1['height'] = '400';
                        $config1['source_image'] = 'uploads/photo_image/' . $img;

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
                $this->db->where('photo_id', $para2);
                $this->db->update('photo', $data);
            }
            recache();
        } elseif ($para1 == 'delete_img') {
            if(!demo()){
                $new_img_features = array();
                $old_img_features = json_decode($this->db->get_where('photo', array('photo_id' => $para2))->row()->img_features, true);
                foreach ($old_img_features as $row2) {
                    if ($row2['img'] == $para3) {
                        if (file_exists('uploads/photo_image/' . $row2['img'])) {
                            unlink('uploads/photo_image/' . $row2['img']);
                        }
                        if (file_exists('uploads/photo_image/' . $row2['thumb'])) {
                            unlink('uploads/photo_image/' . $row2['thumb']);
                        }
                    } else {
                        $new_img_features[] = $row2;
                    }
                }
                $data['img_features'] = json_encode($new_img_features);
                $this->db->where('photo_id', $para2);
                $this->db->update('photo', $data);
            }
            recache();
        } else if ($para1 == 'status') {
            if ($para3 == 'true') {
                $data['status'] = 'published';
            } else {
                $data['status'] = 'unpublished';
            }
            $this->db->where('photo_id', $para2);
            $this->db->update('photo', $data);
            recache();
        } elseif ($para1 == 'delete') {
            if(!demo()){
                $img_features = json_decode($this->db->get_where('photo', array('photo_id' => $para2))->row()->img_features, true);
                foreach ($img_features as $row) {
                    if (file_exists('uploads/photo_image/' . $row['img'])) {
                        unlink('uploads/photo_image/' . $row['img']);
                    }
                    if (file_exists('uploads/photo_image/' . $row['thumb'])) {
                        unlink('uploads/photo_image/' . $row['thumb']);
                    }
                }

                $this->db->where('photo_id', $para2);
                $this->db->delete('photo');
            }
            recache();
        } else {
            $page_data['page_name'] = 'photo';
            $this->load->view('back/index', $page_data);
        }
    }

    /* ------------- MEDIA Ends --------------- */

    /* -------------------- NEWS REPORTER Add, Edit, Update, Delete ------------------------------------- */

    function news_reporter($para1 = '', $para2 = '') {
        if (!$this->Crud_model->admin_permission('news_reporter')) {
            redirect(base_url() . 'admin');
        }
        if ($para1 == 'do_add') {

            $data['email'] = $this->input->post('email');
            $data['name'] = $this->input->post('name');
            $data['permanent_address'] = $this->input->post('permanent_address');
            $data['phone'] = $this->input->post('phone');
            $data['fathers_name'] = $this->input->post('fathers_name');
            $data['mothers_name'] = $this->input->post('mothers_name');
            $data['national_id'] = $this->input->post('national_id');
            $data['present_address'] = $this->input->post('present_address');
            $data['permanent_address'] = $this->input->post('permanent_address');
            $data['phone'] = $this->input->post('phone');
            $data['appointment_date'] = $this->input->post('appointment_date');
            $data['designation'] = $this->input->post('designation');
            $data['computer_ip'] = $this->input->post('computer_ip');
            $data['about'] = $this->input->post('about');
            $sa = array('facebook','google','twitter','youtube');
            $social_account = array();
            foreach($sa as $key => $row){
                    $social_account[] = array(
                    'index'     => $key,
                    'type'      => $sa[$key],
                    'value'     => $this->input->post($sa[$key])
                );
            }
            $data['social_account'] = json_encode($social_account);
            $data['admin_status'] = 0;
            $data['image'] = '[]';

            $this->db->insert('news_reporter', $data);
            $id = $this->db->insert_id();
            if(!demo()){
                $path = $_FILES['img']['name'];
                $ext = '.' . pathinfo($path, PATHINFO_EXTENSION);
                $this->Crud_model->file_up("img", "news_reporter", $id, '', '', $ext);
                $images[] = array('img' => 'news_reporter_' . $id . '.' . $ext, 'thumb' => 'news_reporter_' . $id . '_thumb' . $ext);
                $data1['image'] = json_encode($images);
                $this->db->where('news_reporter_id', $id);
                $this->db->update('news_reporter', $data1);
            }
            recache();
        }
        else if ($para1 == 'edit') {
            $page_data['news_reporter_data'] = $this->db->get_where('news_reporter', array(
                        'news_reporter_id' => $para2
                    ))->result_array();
            $this->load->view('back/admin/news_reporter_edit', $page_data);
        }
        elseif ($para1 == "update") {
            $data['email'] = $this->input->post('email');
            $data['name'] = $this->input->post('name');
            $data['fathers_name'] = $this->input->post('fathers_name');
            $data['mothers_name'] = $this->input->post('mothers_name');
            $data['national_id'] = $this->input->post('national_id');
            $data['present_address'] = $this->input->post('present_address');
            $data['permanent_address'] = $this->input->post('permanent_address');
            $data['phone'] = $this->input->post('phone');
            $data['appointment_date'] = $this->input->post('appointment_date');
            $data['designation'] = $this->input->post('designation');
            $data['computer_ip'] = $this->input->post('computer_ip');
            $data['about'] = $this->input->post('about');
            $sa = array('facebook','google','twitter','youtube');
            $social_account = array();
            foreach($sa as $key => $row){
                    $social_account[] = array(
                    'index'     => $key,
                    'type'      => $sa[$key],
                    'value'     => $this->input->post($sa[$key])
                );
            }
            $data['social_account'] = json_encode($social_account);
            if(!demo()){
                if ($_FILES['img']['name'] !== '') {
                    $id = $para2;
                    $path = $_FILES['img']['name'];
                    $ext = '.' . pathinfo($path, PATHINFO_EXTENSION);
                    $this->Crud_model->file_up("img", "news_reporter", $id, '', '', $ext);
                    $images[] = array('img' => 'news_reporter_' . $id . '.' . $ext, 'thumb' => 'news_reporter_' . $id . '_thumb' . $ext);
                    $data['image'] = json_encode($images);
                }
            }
            $this->db->where('news_reporter_id', $para2);
            $this->db->update('news_reporter', $data);
            echo 'success';
            recache();
        } elseif ($para1 == 'delete') {
            if(!demo()){
                $images = json_decode($this->db->get_where('news_reporter', array('news_reporter_id' => $para2))->row()->image, true);
                $img = $images[0]['img'];
                $thumb = $images[0]['thumb'];
                unlink('uploads/news_reporter_image/' . $thumb);
                unlink('uploads/news_reporter_image/' . $img);
                $this->db->where('news_reporter_id', $para2);
                $this->db->delete('news_reporter');
            }
            recache();
        } elseif ($para1 == 'list') {
            $this->db->order_by('news_reporter_id', 'desc');
            $page_data['all_news_reporters'] = $this->db->get('news_reporter')->result_array();
            $this->load->view('back/admin/news_reporter_list', $page_data);
        } elseif ($para1 == 'view') {
            $page_data['news_reporter_data'] = $this->db->get_where('news_reporter', array(
                        'news_reporter_id' => $para2
                    ))->result_array();
            $this->load->view('back/admin/news_reporter_view', $page_data);
        } elseif ($para1 == 'add') {
            $this->load->view('back/admin/news_reporter_add');
        } elseif ($para1 == 'make_admin') {
            $page_data['news_reporter_data'] = $this->db->get_where('news_reporter', array(
                        'news_reporter_id' => $para2
                    ))->result_array();
            $this->load->view('back/admin/make_admin', $page_data);
        } elseif ($para1 == 'do_make') {
            $data['name'] = $this->input->post('name');
            $data['email'] = $this->input->post('email');
            $data['phone'] = $this->input->post('phone');
            $data['address'] = $this->input->post('address');
            $password = substr(hash('sha512', rand()), 0, 12);
            $data['password'] = sha1($password);
            $data['role'] = $this->input->post('role');
            $data['timestamp'] = time();
            $this->db->insert('admin', $data);
            $this->Email_model->account_opening('admin', $data['email'], $password);

            $data1['admin_status'] = 1;
            $this->db->where('news_reporter_id', $para2);
            $this->db->update('news_reporter', $data1);
            recache();
        } else {
            $page_data['page_name'] = "news_reporter";
            $page_data['all_news_reporters'] = $this->db->get('news_reporter')->result_array();
            $this->load->view('back/index', $page_data);
        }
    }

    /* Login into Admin panel */

    function login($para1 = '') {
        if ($para1 == 'forget_form') {
            $page_data['control'] = 'admin';
            $this->load->view('back/forget_password', $page_data);
        } else if ($para1 == 'forget') {

            $this->load->library('form_validation');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            if ($this->form_validation->run() == FALSE) {
                echo validation_errors();
            } else {
                $query = $this->db->get_where('admin', array(
                    'email' => $this->input->post('email')
                ));
                if ($query->num_rows() > 0) {
                    $admin_id = $query->row()->admin_id;
                    $password = substr(hash('sha512', rand()), 0, 12);
                    $data['password'] = sha1($password);
                    $this->db->where('admin_id', $admin_id);
                    $this->db->update('admin', $data);
                    if ($this->Email_model->password_reset_email('admin', $admin_id, $password)) {
                        echo 'email_sent';
                    } else {
                        echo 'email_not_sent';
                    }
                } else {
                    echo 'email_nay';
                }
            }
        } else {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if ($this->form_validation->run() == FALSE) {
                echo validation_errors();
            } else {
                $login_data = $this->db->get_where('admin', array(
                    'email' => $this->input->post('email'),
                    'password' => sha1($this->input->post('password'))
                ));
                if ($login_data->num_rows() > 0) {
                    foreach ($login_data->result_array() as $row) {
                        $this->session->set_userdata('login', 'yes');
                        $this->session->set_userdata('admin_login', 'yes');
                        $this->session->set_userdata('admin_id', $row['admin_id']);
                        $this->session->set_userdata('admin_name', $row['name']);
                        $this->session->set_userdata('title', 'admin');
                        echo 'lets_login';
                    }
                } else {
                    echo 'login_failed';
                }
            }
        }
    }

    function logout() {
        $this->session->sess_destroy();
        redirect(base_url() . 'admin', 'refresh');
    }

    /* Checking Login Stat */

    function is_logged() {
        if ($this->session->userdata('admin_login') == 'yes') {
            echo 'yah!good';
        } else {
            echo 'nope!bad';
        }
    }

    /* Manage Frontend User Interface */


    /* Manage Frontend User Messages */

    function contact_message($para1 = "", $para2 = "") {
        if (!$this->Crud_model->admin_permission('contact_message')) {
            redirect(base_url() . 'admin');
        }
        if ($para1 == 'delete') {
            if(!demo()){
                $this->db->where('contact_message_id', $para2);
                $this->db->delete('contact_message');
            }
        } elseif ($para1 == 'list') {
            $this->db->order_by('contact_message_id', 'desc');
            $page_data['contact_messages'] = $this->db->get('contact_message')->result_array();
            $this->load->view('back/admin/contact_message_list', $page_data);
        } elseif ($para1 == 'reply') {
            $data['reply'] = $this->input->post('reply');
            $this->db->where('contact_message_id', $para2);
            $this->db->update('contact_message', $data);
            $this->db->order_by('contact_message_id', 'desc');
            $query = $this->db->get_where('contact_message', array(
                        'contact_message_id' => $para2
                    ))->row();
            $this->Email_model->do_email($data['reply'], 'RE: ' . $query->subject, $query->email);
        } elseif ($para1 == 'view') {
            $page_data['message_data'] = $this->db->get_where('contact_message', array(
                        'contact_message_id' => $para2
                    ))->result_array();
            $this->load->view('back/admin/contact_message_view', $page_data);
        } elseif ($para1 == 'reply_form') {
            $page_data['message_data'] = $this->db->get_where('contact_message', array(
                        'contact_message_id' => $para2
                    ))->result_array();
            $this->load->view('back/admin/contact_message_reply', $page_data);
        } else {
            $page_data['page_name'] = "contact_message";
            $page_data['contact_messages'] = $this->db->get('contact_message')->result_array();
            $this->load->view('back/index', $page_data);
        }
    }

    /* Manage Frontend User Interface */


    /* Manage Languages */

    function language_settings($para1 = "", $para2 = "", $para3 = "") {
        if (!$this->Crud_model->admin_permission('language')) {
            redirect(base_url() . 'admin');
        }
        if ($para1 == 'add_lang') {
            $this->load->view('back/admin/language_add');
        } elseif ($para1 == 'edit_lang') {
            $page_data['lang_data'] = $this->db->get_where('language_list', array('language_list_id' => $para2))->result_array();
            $this->load->view('back/admin/language_edit', $page_data);
        } elseif ($para1 == 'lang_list') {
            //if($para2 !== ''){
            $this->db->order_by('word_id', 'desc');
            $page_data['words'] = $this->db->get('language')->result_array();
            $page_data['lang'] = $para2;
            $this->load->view('back/admin/language_list', $page_data);
            //}
        } elseif ($para1 == 'list_data') {
            $limit = $this->input->get('limit');
            $search = $this->input->get('search');
            $order = $this->input->get('order');
            $offset = $this->input->get('offset');
            $sort = $this->input->get('sort');
            if ($search) {
                $this->db->like('word', $search, 'both');
            }
            $total = $this->db->get('language')->num_rows();
            $this->db->limit($limit);
            if ($sort == '') {
                $sort = 'word_id';
                $order = 'DESC';
            }
            $this->db->order_by($sort, $order);
            if ($search) {
                $this->db->like('word', $search, 'both');
            }
            $lang = $para2;
            if ($lang == 'undefined' || $lang == '') {
                if ($lang = $this->session->userdata('language')) {

                } else {
                    $lang = $this->db->get_where('general_settings', array(
                                'type' => 'language'
                            ))->row()->value;
                }
            }
            $words = $this->db->get('language', $limit, $offset)->result_array();
            $data = array();
            foreach ($words as $row) {

                $res = array(
                    'no' => '',
                    'word' => '',
                    'translation' => '',
                    'options' => ''
                );

                $res['no'] = $row['word_id'];
                $res['word'] = '<div class="col-md-12 abv">' . ucwords(str_replace('_', ' ', $row['word'])) . '</div>';
                $res['translation'] = form_open(base_url() . 'admin/language_settings/upd_trn/' . $row['word_id'], array(
                    'class' => 'form-horizontal trs',
                    'method' => 'post',
                    'id' => $lang . '_' . $row['word_id']
                ));
                $res['translation'] .= '   <div class="col-md-8">';
                $res['translation'] .= '      <input type="text" name="translation" value="' . $row[$lang] . '" class ="form-control ann" />';
                $res['translation'] .= '      <input type="hidden" name="lang" value="' . $lang . '" />';
                $res['translation'] .= '   </div>';
                $res['translation'] .= '   <div class="col-md-4">';
                $res['translation'] .= '       <span class="btn btn-success btn-xs btn-labeled fa fa-wrench submittera" data-wid="' . $lang . '_' . $row['word_id'] . '"  data-ing="' . translate('saving') . '" data-msg="' . translate('updated!') . '" >' . translate('save') . '</span>';
                $res['translation'] .= '   </div>';
                $res['translation'] .= '</form>';

                //add html for action
                $res['options'] = "<a onclick=\"delete_confirm('" . $row['word_id'] . "','" . translate('really_want_to_delete_this_word?') . "')\"
                                class=\"btn btn-danger btn-xs btn-labeled fa fa-trash\" data-toggle=\"tooltip\" data-original-title=\"Delete\" data-container=\"body\">
                                    " . translate('delete') . "
                            </a>";
                $data[] = $res;
            }
            $result = array(
                'total' => $total,
                'rows' => $data
            );

            echo json_encode($result);
        } elseif ($para1 == 'upd_trn') {
            $word_id = $para2;
            $translation = $this->input->post('translation');
            $language = $this->input->post('lang');
            $word = $this->db->get_where('language', array(
                        'word_id' => $word_id
                    ))->row()->word;
            add_translation($word, $language, $translation);
            recache();
        } elseif ($para1 == 'do_add_lang') {
            $data['name'] = $this->input->post('language');
            $this->db->insert('language_list', $data);

            $id = $this->db->insert_id();
            if(!demo()){
                $this->Crud_model->file_up("icon", "language_list", $id, '', '', '', 'jpg');
            }
            $language = 'lang_' . $id;

            $this->db->where('language_list_id', $id);
            $this->db->update('language_list', array(
                'db_field' => $language,
                'status' => 'ok'
            ));

            add_language($language);
            recache();
        } elseif ($para1 == 'do_edit_lang') {
            $this->db->where('language_list_id', $para2);
            $this->db->update('language_list', array(
                'name' => $this->input->post('language')
            ));
            if(!demo()){
                $this->Crud_model->file_up("icon", "language_list", $para2, '', '', '', 'jpg');
            }
            recache();
        } else if ($para1 == "lang_set") {
            $val = '';
            if ($para3 == 'true') {
                $val = 'ok';
            } else if ($para3 == 'false') {
                $val = 'no';
            }
            echo $val;
            $this->db->where('language_list_id', $para2);
            $this->db->update('language_list', array(
                'status' => $val
            ));
            recache();
        } elseif ($para1 == 'check_existed') {
            echo lang_check_exists($para2);
        } elseif ($para1 == 'lang_select') {
            $page_data['lang'] = $para2;
            $this->load->view('back/admin/language_select', $page_data);
        } elseif ($para1 == 'dlt_lang') {
            if(!demo()){
                $this->db->where('db_field', $para2);
                $this->db->delete('language_list');
                $this->load->dbforge();
                $this->dbforge->drop_column('language', $para2);
            }
            recache();
        } elseif ($para1 == 'dlt_word') {
            if(!demo()){
                $this->db->where('word_id', $para2);
                $this->db->delete('language');
            }
            recache();
        } else {
            $page_data['page_name'] = "language";
            $this->load->view('back/index', $page_data);
        }
    }

    /* Manage Business Settings */


    /* Manage Admin Settings */

    function manage_admin($para1 = "") {
        if ($this->session->userdata('admin_login') != 'yes') {
            redirect(base_url() . 'admin');
        }
        if ($para1 == 'update_password') {
            if(!demo()){
                $user_data['password'] = $this->input->post('password');
                $account_data = $this->db->get_where('admin', array(
                            'admin_id' => $this->session->userdata('admin_id')
                        ))->result_array();
                foreach ($account_data as $row) {
                    if (sha1($user_data['password']) == $row['password']) {
                        if ($this->input->post('password1') == $this->input->post('password2')) {
                            $data['password'] = sha1($this->input->post('password1'));
                            $this->db->where('admin_id', $this->session->userdata('admin_id'));
                            $this->db->update('admin', $data);
                            echo 'updated';
                        }
                    } else {
                        echo 'pass_prb';
                    }
                }
            }
        }
        else if ($para1 == 'update_profile') {
            if(!demo()){
                $this->db->where('admin_id', $this->session->userdata('admin_id'));
                $this->db->update('admin', array(
                    'name' => $this->input->post('name'),
                    'email' => $this->input->post('email'),
                    'address' => $this->input->post('address'),
                    'phone' => $this->input->post('phone')
                ));
            }
        }
        else {
            $page_data['page_name'] = "manage_admin";
            $this->load->view('back/index', $page_data);
        }
    }

    /* Page Management */

    function page($para1 = '', $para2 = '', $para3 = '') {
        if (!$this->Crud_model->admin_permission('page')) {
            redirect(base_url() . 'admin');
        }
        if ($para1 == 'do_add') {
            $parts = array();
            $data['page_name'] = $this->input->post('page_name');
            $data['parmalink'] = $this->input->post('parmalink');
            $size = $this->input->post('part_size');
            $type = $this->input->post('part_content_type');
            $content = $this->input->post('part_content');
            $widget = $this->input->post('part_widget');
            var_dump($widget);
            foreach ($size as $in => $row) {
                $parts[] = array(
                    'size' => $size[$in],
                    'type' => $type[$in],
                    'content' => $content[$in],
                    'widget' => $widget[$in]
                );
            }
            $data['parts'] = json_encode($parts);
            $data['status'] = 'ok';
            $this->db->insert('page', $data);
            recache();
        } else if ($para1 == 'edit') {
            $page_data['page_data'] = $this->db->get_where('page', array(
                        'page_id' => $para2
                    ))->result_array();
            $this->load->view('back/admin/page_edit', $page_data);
        } elseif ($para1 == "update") {
            $parts = array();
            $data['page_name'] = $this->input->post('page_name');
            $data['parmalink'] = $this->input->post('parmalink');
            $size = $this->input->post('part_size');
            $type = $this->input->post('part_content_type');
            $content = $this->input->post('part_content');
            $widget = $this->input->post('part_widget');
            var_dump($widget);
            foreach ($size as $in => $row) {
                $parts[] = array(
                    'size' => $size[$in],
                    'type' => $type[$in],
                    'content' => $content[$in],
                    'widget' => $widget[$in]
                );
            }
            $data['parts'] = json_encode($parts);
            $this->db->where('page_id', $para2);
            $this->db->update('page', $data);
            recache();
        } elseif ($para1 == 'delete') {
            if(!demo()){
                $this->db->where('page_id', $para2);
                $this->db->delete('page');
            }
            recache();
        } elseif ($para1 == 'list') {

            $page_data['all_page'] = $this->db->get('page')->result_array();
            $this->load->view('back/admin/page_list', $page_data);
        } else if ($para1 == 'page_publish_set') {
            $page = $para2;
            if ($para3 == 'true') {
                $data['status'] = 'ok';
            } else {
                $data['status'] = '0';
            }
            $this->db->where('page_id', $page);
            $this->db->update('page', $data);
            recache();
        } elseif ($para1 == 'view') {
            $page_data['page_data'] = $this->db->get_where('page', array(
                        'page_id' => $para2
                    ))->result_array();
            $this->load->view('back/admin/page_view', $page_data);
        } elseif ($para1 == 'serial') {
            $page_data['all_widget'] = $this->db->get_where('widget', array(
                        'status' => 'ok'
                    ))->result_array();
            $page_data['widget'] = json_decode($this->db->get_where('page', array(
                        'page_id' => $para2
                    ))->row()->parts, true);
            $page_data['page_id'] = $para2;
            $this->load->view('back/admin/page_widget_serial', $page_data);
        } else if ($para1 == 'do_serial') {
            $input = json_decode($this->input->post('serial'), true);
            $status = $this->input->post('status');
            $result = array();

            foreach ($input as $row) {
                $result[] = array('id' => $row['id'], 'status' => $status[$row['id']]);
            }

            $result = json_encode($result);
            $this->db->where('page_id', $para2);
            $this->db->update('page', array(
                'parts' => $result
            ));
            recache();
        } elseif ($para1 == 'add') {
            $this->load->view('back/admin/page_add');
        } else {
            $page_data['page_name'] = "page";
            $page_data['all_pages'] = $this->db->get('page')->result_array();
            $this->load->view('back/index', $page_data);
        }
    }

    function admins($para1 = '', $para2 = '') {
        if (!$this->Crud_model->admin_permission('admin')) {
            redirect(base_url() . 'admin');
        }
        if ($para1 == 'do_add') {
            $data['name'] = $this->input->post('name');
            $data['email'] = $this->input->post('email');
            $data['phone'] = $this->input->post('phone');
            $data['address'] = $this->input->post('address');
            $password = substr(hash('sha512', rand()), 0, 12);
            $data['password'] = sha1($password);
            $data['role'] = $this->input->post('role');
            $data['timestamp'] = time();
            $this->db->insert('admin', $data);
            $this->Email_model->account_opening('admin', $data['email'], $password);
        } else if ($para1 == 'edit') {
            $page_data['admin_data'] = $this->db->get_where('admin', array(
                        'admin_id' => $para2
                    ))->result_array();
            $this->load->view('back/admin/admin_edit', $page_data);
        } elseif ($para1 == "update") {
            $data['name'] = $this->input->post('name');
            $data['email'] = $this->input->post('email');
            $data['phone'] = $this->input->post('phone');
            $data['address'] = $this->input->post('address');
            $data['role'] = $this->input->post('role');
            $this->db->where('admin_id', $para2);
            $this->db->update('admin', $data);
        } elseif ($para1 == 'delete') {
            if(!demo()){
                $admin_email = $this->db->get_where('admin', array('admin_id' => $para2))->row()->email;
                $this->db->where('admin_id', $para2);
                $this->db->delete('admin');

                $data1['admin_status'] = 0;
                $this->db->where('email', $admin_email);
                $this->db->update('news_reporter', $data1);
            }
        } elseif ($para1 == 'list') {
            $this->db->order_by('admin_id', 'desc');
            $page_data['all_admins'] = $this->db->get('admin')->result_array();
            $this->load->view('back/admin/admin_list', $page_data);
        } elseif ($para1 == 'view') {
            $page_data['admin_data'] = $this->db->get_where('admin', array(
                        'admin_id' => $para2
                    ))->result_array();
            $this->load->view('back/admin/admin_view', $page_data);
        } elseif ($para1 == 'add') {
            $this->load->view('back/admin/admin_add');
        } else {
            $page_data['page_name'] = "admin";
            $page_data['all_admins'] = $this->db->get('admin')->result_array();
            $this->load->view('back/index', $page_data);
        }
    }

    function role($para1 = '', $para2 = '') {
        if (!$this->Crud_model->admin_permission('role')) {
            redirect(base_url() . 'admin');
        }
        if ($para1 == 'do_add') {
            $data['name'] = $this->input->post('name');
            $data['permission'] = json_encode($this->input->post('permission'));
            $data['description'] = $this->input->post('description');
            $this->db->insert('role', $data);
        } elseif ($para1 == "update") {
            $data['name'] = $this->input->post('name');
            $data['permission'] = json_encode($this->input->post('permission'));
            $data['description'] = $this->input->post('description');
            $this->db->where('role_id', $para2);
            $this->db->update('role', $data);
        } elseif ($para1 == 'delete') {
            if(!demo()){
                $this->db->where('role_id', $para2);
                $this->db->delete('role');
            }
        } elseif ($para1 == 'list') {
            $this->db->order_by('role_id', 'desc');
            $page_data['all_roles'] = $this->db->get('role')->result_array();
            $this->load->view('back/admin/role_list', $page_data);
        } elseif ($para1 == 'view') {
            $page_data['role_data'] = $this->db->get_where('role', array(
                        'role_id' => $para2
                    ))->result_array();
            $this->load->view('back/admin/role_view', $page_data);
        } elseif ($para1 == 'add') {
            $page_data['all_permissions'] = $this->db->get('permission')->result_array();
            $this->load->view('back/admin/role_add', $page_data);
        } else if ($para1 == 'edit') {
            $page_data['all_permissions'] = $this->db->get('permission')->result_array();
            $page_data['role_data'] = $this->db->get_where('role', array(
                        'role_id' => $para2
                    ))->result_array();
            $this->load->view('back/admin/role_edit', $page_data);
        } else {
            $page_data['page_name'] = "role";
            $page_data['all_roles'] = $this->db->get('role')->result_array();
            $this->load->view('back/index', $page_data);
        }
    }

    /* Sending Newsletters */

    function newsletter($para1 = "") {
        if (!$this->Crud_model->admin_permission('newsletter')) {
            redirect(base_url() . 'admin');
        }
        if ($para1 == "send") {
            $users = explode(',', $this->input->post('users'));
            $subscribers = explode(',', $this->input->post('subscribers'));
            $text = $this->input->post('text');
            $title = $this->input->post('title');
            $from = $this->input->post('from');
            foreach ($users as $key => $user) {
                if ($user !== '') {
                    $this->Email_model->newsletter($title, $text, $user, $from);
                }
            }
            foreach ($subscribers as $key => $subscriber) {
                if ($subscriber !== '') {
                    $this->Email_model->newsletter($title, $text, $subscriber, $from);
                }
            }
        } else {
            $page_data['users'] = $this->db->get('user')->result_array();
            $page_data['subscribers'] = $this->db->get('subscribe')->result_array();
            $page_data['page_name'] = "newsletter";
            $this->load->view('back/index', $page_data);
        }
    }

    function widget($para1 = '', $para2 = '', $para3 = '') {
        if ($para1 == 'do_add') {
            $type = 'widget';
            $data['title'] = translate($this->input->post('title'));
            $data['code'] = $this->input->post('code');
            $this->db->insert('widget', $data);
            recache();
        } elseif ($para1 == "update") {
            $data['title'] = translate($this->input->post('title'));
            $data['code'] = $this->input->post('code');
            $this->db->where('widget_id', $para2);
            $this->db->update('widget', $data);
            $this->Crud_model->file_up("img", "widget", $para2, '', '', '.png');
            recache();
        } elseif ($para1 == "status") {
            if ($para3 == 'true') {
                $data['status'] = 'ok';
            } else {
                $data['status'] = 'no';
            }
            $this->db->where('widget_id', $para2);
            $this->db->update('widget', $data);
            recache();
        } elseif ($para1 == 'delete') {
            if(!demo()){
                $this->db->where('widget_id', $para2);
                $this->db->delete('widget');
            }
            recache();
        } else if ($para1 == 'edit') {
            $page_data['widget_data'] = $this->db->get_where('widget', array(
                        'widget_id' => $para2
                    ))->result_array();
            $this->load->view('back/admin/widget_edit', $page_data);
        } elseif ($para1 == 'list') {

            $page_data['all_widgets'] = $this->db->get('widget')->result_array();
            $this->load->view('back/admin/widget_list', $page_data);
        } elseif ($para1 == 'serial') {
            $page_data['all_widget'] = $this->db->get_where('widget', array(
                        'status' => 'ok'
                    ))->result_array();
            $this->load->view('back/admin/widget_all_page_serial', $page_data);
        } else if ($para1 == 'do_serial') {
            $input = json_decode($this->input->post('serial'), true);
            $status = $this->input->post('status');
            $result = array();

            foreach ($input as $row) {
                $result[] = array('id' => $row['id'], 'status' => $status[$row['id']]);
            }

            $result = json_encode($result);
            $this->db->where('page_id', $para2);
            $this->db->update('page', array(
                'parts' => $result
            ));
            recache();
        } elseif ($para1 == 'add') {
            $this->load->view('back/admin/widget_add');
        } else {
            $page_data['page_name'] = "widget";
            $page_data['all_widgets'] = $this->db->get('widget')->result_array();
            $this->load->view('back/index', $page_data);
        }
    }

    function page_settings($para1 = "") {
        if (!$this->Crud_model->admin_permission('site_settings')) {
            redirect(base_url() . 'admin');
        }
        $page_data['page_name'] = "page_settings";
        $page_data['tab_name'] = $para1;
        $this->load->view('back/index', $page_data);
    }

    /* Manage Logos */

    function logo_settings($para1 = "", $para2 = "", $para3 = "") {
        if (!$this->Crud_model->admin_permission('display_settings')) {
            redirect(base_url() . 'admin');
        }
        if ($para1 == "select_logo") {
            $page_data['page_name'] = "select_logo";
        } elseif ($para1 == "delete_logo") {
            if(!demo()){
                if (file_exists("uploads/logo_image/logo_" . $para2 . ".png")) {
                    unlink("uploads/logo_image/logo_" . $para2 . ".png");
                }
                $this->db->where('logo_id', $para2);
                $this->db->delete('logo');
            }
            recache();
        } elseif ($para1 == "set_logo") {
            $type = $this->input->post('type');
            $logo_id = $this->input->post('logo_id');
            $this->db->where('type', $type);
            $this->db->update('ui_settings', array(
                'value' => $logo_id
            ));
            recache();
        } elseif ($para1 == "show_all") {
            $page_data['logo'] = $this->db->get('logo')->result_array();
            if ($para2 == "") {
                $this->load->view('back/admin/all_logo', $page_data);
            }
            if ($para2 == "selectable") {
                $page_data['logo_type'] = $para3;
                $this->load->view('back/admin/select_logo', $page_data);
            }
        } elseif ($para1 == "upload_logo") {
            if(!demo()){
                $data['name'] = '';
                $this->db->insert("logo", $data);
                $id = $this->db->insert_id();
                echo $_FILES["logo"]['name'];
                move_uploaded_file($_FILES["logo"]['tmp_name'], 'uploads/logo_image/logo_' . $id . '.png');
            }
        } else {
            $this->load->view('back/index', $page_data);
        }
    }

    /* Checking if email exists */

    function exists() {
        $email = $this->input->post('email');
        $admin = $this->db->get('admin')->result_array();
        $exists = 'no';
        foreach ($admin as $row) {
            if ($row['email'] == $email) {
                $exists = 'yes';
            }
        }
        echo $exists;
    }

    /* Manage Favicons */

    function favicon_settings($para1 = "") {
        if (!$this->Crud_model->admin_permission('site_settings')) {
            redirect(base_url() . 'admin');
        }
        if(!demo()){
            $name = $_FILES["fav"]["name"];
            $ext = end(explode(".", $name));
            move_uploaded_file($_FILES["fav"]['tmp_name'], 'uploads/others/favicon.' . $ext);
            $this->db->where('type', "fav_ext");
            $this->db->update('ui_settings', array(
                'value' => $ext
            ));
        }
        recache();
    }

    function ui_pages($para1 = '', $para2 = '',$para3 ='') {
        if (!$this->Crud_model->admin_permission('display_settings')) {
            redirect(base_url() . 'admin');
        }

        if ($para1 == "set_scrolling_news") {
            $val = '';
            if ($para2 == 'true') {
                $val = 'ok';
            } else if ($para2 == 'false') {
                $val = 'no';
            }
            echo $val;
            $data = json_decode($this->Crud_model->get_settings_value('ui_settings', 'scrolling_news', 'value'), true);
            $scrolling_news = array('status' => $val,
                'title' => $data['title'],
                'count' => $data['count']
            );
            $this->db->where('type', "scrolling_news");
            $this->db->update('ui_settings', array(
                'value' => json_encode($scrolling_news)
            ));
            recache();
        }
        if ($para1 == "scrolling_news_data") {
            $data = json_decode($this->Crud_model->get_settings_value('ui_settings', 'scrolling_news', 'value'), true);
            $count = $this->input->post('count');
            $scrolling_news = array('status' => $data['status'],
                'title' => $this->input->post('title'),
                'count' => $count
            );
            $this->db->where('type', "scrolling_news");
            $this->db->update('ui_settings', array(
                'value' => json_encode($scrolling_news)
            ));
            recache();
        }

        if ($para1 == "set_top_news") {
            $val = '';
            if ($para2 == 'true') {
                $val = 'ok';
            } else if ($para2 == 'false') {
                $val = 'no';
            }
            echo $val;
            $data = json_decode($this->Crud_model->get_settings_value('ui_settings', 'top_news', 'value'), true);
            $top_news = array('status' => $val,
                'style' => $data['style']
            );
            $this->db->where('type', "top_news");
            $this->db->update('ui_settings', array(
                'value' => json_encode($top_news)
            ));
            recache();
        }
        if ($para1 == "top_news_data") {
            $data = json_decode($this->Crud_model->get_settings_value('ui_settings', 'top_news', 'value'), true);
            $top_news = array('status' => $data['status'],
                'style' => $this->input->post('style')
            );
            $this->db->where('type', "top_news");
            $this->db->update('ui_settings', array(
                'value' => json_encode($top_news)
            ));
            recache();
        }

        if ($para1 == "set_sliding_news") {
            $val = '';
            if ($para2 == 'true') {
                $val = 'ok';
            } else if ($para2 == 'false') {
                $val = 'no';
            }
            echo $val;
            $data = json_decode($this->Crud_model->get_settings_value('ui_settings', 'sliding_news', 'value'), true);
            $sliding_news = array('status' => $val,
                'title' => $data['title'],
                'count' => $data['count']
            );
            $this->db->where('type', "sliding_news");
            $this->db->update('ui_settings', array(
                'value' => json_encode($sliding_news)
            ));
            recache();
        }
        if ($para1 == "sliding_news_data") {
            $data = json_decode($this->Crud_model->get_settings_value('ui_settings', 'sliding_news', 'value'), true);
            $count = $this->input->post('count');
            $sliding_news = array('status' => $data['status'],
                'title' => $this->input->post('title'),
                'count' => $count
            );
            $this->db->where('type', "sliding_news");
            $this->db->update('ui_settings', array(
                'value' => json_encode($sliding_news)
            ));
            recache();
        }

        if ($para1 == "set_detail_news") {
            $val = '';
            if ($para2 == 'true') {
                $val = 'ok';
            } else if ($para2 == 'false') {
                $val = 'no';
            }
            echo $val;
            $data = json_decode($this->Crud_model->get_settings_value('ui_settings', 'detail_news', 'value'), true);
            $detail_news = array('status' => $val,
                'widgets' => $data['widgets'],
                'sidebar' => $data['sidebar'],
                'count' => $data['count']
            );
            $this->db->where('type', "detail_news");
            $this->db->update('ui_settings', array(
                'value' => json_encode($detail_news)
            ));
            recache();
        }
        if ($para1 == "detail_news_data") {
            $data = json_decode($this->Crud_model->get_settings_value('ui_settings', 'detail_news', 'value'), true);
            $count = $this->input->post('count');
            $detail_news = array('status' => $data['status'],
                'widgets' => $this->input->post('widgets'),
                'sidebar' => $this->input->post('sidebar'),
                'count' => $count
            );
            $this->db->where('type', "detail_news");
            $this->db->update('ui_settings', array(
                'value' => json_encode($detail_news)
            ));
            recache();
        }

        if ($para1 == "set_photo_gal") {
            $val = '';
            if ($para2 == 'true') {
                $val = 'ok';
            } else if ($para2 == 'false') {
                $val = 'no';
            }
            echo $val;
            $data = json_decode($this->Crud_model->get_settings_value('ui_settings', 'photo_gal', 'value'), true);
            $photo_gal = array('status' => $val,
                'title' => $data['title'],
                'count' => $data['count']
            );
            $this->db->where('type', "photo_gal");
            $this->db->update('ui_settings', array(
                'value' => json_encode($photo_gal)
            ));
            recache();
        }
        if ($para1 == "photo_gal_data") {
            $data = json_decode($this->Crud_model->get_settings_value('ui_settings', 'photo_gal', 'value'), true);
            $count = $this->input->post('count');
            $photo_gal = array('status' => $data['status'],
                'title' => $this->input->post('title'),
                'count' => $count
            );
            $this->db->where('type', "photo_gal");
            $this->db->update('ui_settings', array(
                'value' => json_encode($photo_gal)
            ));
            recache();
        }

        if ($para1 == "set_special_category") {
            $val = '';
            if ($para2 == 'true') {
                $val = 'ok';
            } else if ($para2 == 'false') {
                $val = 'no';
            }
            echo $val;
            $data = json_decode($this->Crud_model->get_settings_value('ui_settings', 'special_category', 'value'), true);
            $special_category = array('status' => $val,
                'cat1' => $data['cat1'],
                'cat2' => $data['cat2'],
                'widgets' => $data['widgets'],
                'sidebar' => $data['sidebar'],
                'count' => $data['count']
            );
            $this->db->where('type', "special_category");
            $this->db->update('ui_settings', array(
                'value' => json_encode($special_category)
            ));
            recache();
        }
        if ($para1 == "special_category_data") {
            $data = json_decode($this->Crud_model->get_settings_value('ui_settings', 'special_category', 'value'), true);
            $count = $this->input->post('count');
            $special_category = array('status' => $data['status'],
                'cat1' => $this->input->post('cat1'),
                'cat2' => $this->input->post('cat2'),
                'widgets' => $this->input->post('widgets'),
                'sidebar' => $this->input->post('sidebar'),
                'count' => $count
            );
            $this->db->where('type', "special_category");
            $this->db->update('ui_settings', array(
                'value' => json_encode($special_category)
            ));
            recache();
        }

        if ($para1 == "set_video_gal") {
            $val = '';
            if ($para2 == 'true') {
                $val = 'ok';
            } else if ($para2 == 'false') {
                $val = 'no';
            }
            echo $val;
            $data = json_decode($this->Crud_model->get_settings_value('ui_settings', 'video_gal', 'value'), true);
            $video_gal = array('status' => $val,
                'title' => $data['title'],
                'style' => $data['style']
            );
            $this->db->where('type', "video_gal");
            $this->db->update('ui_settings', array(
                'value' => json_encode($video_gal)
            ));
            recache();
        }
        if ($para1 == "video_gal_data") {
            $data = json_decode($this->Crud_model->get_settings_value('ui_settings', 'video_gal', 'value'), true);
            $video_gal = array('status' => $data['status'],
                'title' => $this->input->post('title'),
                'style' => $this->input->post('style')
            );
            $this->db->where('type', "video_gal");
            $this->db->update('ui_settings', array(
                'value' => json_encode($video_gal)
            ));
            recache();
        }

        if ($para1 == "set_home_cat") {
            $val = '';
            if ($para2 == 'true') {
                $val = 'ok';
            } else if ($para2 == 'false') {
                $val = 'no';
            }
            echo $val;
            $data = json_decode($this->Crud_model->get_settings_value('ui_settings', 'home_cat', 'value'), true);
            $home_cat = array('status' => $val,
                'outlook' => $data['outlook'],
                'categories' => $data['categories'],
                'style' => $data['style']
            );
            $this->db->where('type', "home_cat");
            $this->db->update('ui_settings', array(
                'value' => json_encode($home_cat)
            ));
            recache();
        }
        if ($para1 == "home_cat_data") {
            $data = json_decode($this->Crud_model->get_settings_value('ui_settings', 'home_cat', 'value'), true);
            $home_cat = array('status' => $data['status'],
                'outlook' => $this->input->post('outlook'),
                'categories' => $this->input->post('categories'),
                'style' => $this->input->post('style')
            );
            $this->db->where('type', "home_cat");
            $this->db->update('ui_settings', array(
                'value' => json_encode($home_cat)
            ));
            recache();
        }

        if ($para1 == "news_description") {
            $data = json_decode($this->Crud_model->get_settings_value('ui_settings', 'news_description', 'value'), true);
            $news_description = array('sidebar' => $this->input->post('sidebar'),
                'widgets' => $this->input->post('widgets'),
                'page_bottom' => $this->input->post('page_bottom'),
            );
            $this->db->where('type', "news_description");
            $this->db->update('ui_settings', array(
                'value' => json_encode($news_description)
            ));
            recache();
        }

        if ($para1 == "category_news") {
            $data = json_decode($this->Crud_model->get_settings_value('ui_settings', 'category_news', 'value'), true);
            $category_news = array('sidebar' => $this->input->post('sidebar'),
                'widgets' => $this->input->post('widgets'),
                'page_bottom' => $this->input->post('page_bottom'),
            );
            $this->db->where('type', "category_news");
            $this->db->update('ui_settings', array(
                'value' => json_encode($category_news)
            ));
            recache();
        }

        if ($para1 == "category_blog") {
            $data = json_decode($this->Crud_model->get_settings_value('ui_settings', 'category_blog', 'value'), true);
            $category_blog = array('sidebar' => $this->input->post('sidebar'),
                'widgets' => $this->input->post('widgets'),
                'page_bottom' => $this->input->post('page_bottom'),
            );
            $this->db->where('type', "category_blog");
            $this->db->update('ui_settings', array(
                'value' => json_encode($category_blog)
            ));
            recache();
        }

        if ($para1 == "listing_news") {
            $data = json_decode($this->Crud_model->get_settings_value('ui_settings', 'listing_news', 'value'), true);
            $listing_news = array('sidebar' => $this->input->post('sidebar'),
                'widgets' => $this->input->post('widgets'),
                'page_bottom' => $this->input->post('page_bottom'),
            );
            $this->db->where('type', "listing_news");
            $this->db->update('ui_settings', array(
                'value' => json_encode($listing_news)
            ));
            recache();
        }

        if ($para1 == "photos_page") {
            $data = json_decode($this->Crud_model->get_settings_value('ui_settings', 'photos_page', 'value'), true);
            $photos_page = array('sidebar' => $this->input->post('sidebar'),
                'widgets' => $this->input->post('widgets'),
                'page_bottom' => $this->input->post('page_bottom'),
            );
            $this->db->where('type', "photos_page");
            $this->db->update('ui_settings', array(
                'value' => json_encode($photos_page)
            ));
            recache();
        }

        if ($para1 == "photo_detail_page") {
            $data = json_decode($this->Crud_model->get_settings_value('ui_settings', 'photo_detail_page', 'value'), true);
            $photo_detail_page = array('sidebar' => $this->input->post('sidebar'),
                'widgets' => $this->input->post('widgets'),
                'page_bottom' => $this->input->post('page_bottom'),
            );
            $this->db->where('type', "photo_detail_page");
            $this->db->update('ui_settings', array(
                'value' => json_encode($photo_detail_page)
            ));
            recache();
        }

        if ($para1 == "videos_page") {
            $data = json_decode($this->Crud_model->get_settings_value('ui_settings', 'videos_page', 'value'), true);
            $videos_page = array('sidebar' => $this->input->post('sidebar'),
                'widgets' => $this->input->post('widgets'),
                'page_bottom' => $this->input->post('page_bottom'),
            );
            $this->db->where('type', "videos_page");
            $this->db->update('ui_settings', array(
                'value' => json_encode($videos_page)
            ));
            recache();
        }

        if ($para1 == "video_detail_page") {
            $data = json_decode($this->Crud_model->get_settings_value('ui_settings', 'video_detail_page', 'value'), true);
            $video_detail_page = array('sidebar' => $this->input->post('sidebar'),
                'widgets' => $this->input->post('widgets'),
                'page_bottom' => $this->input->post('page_bottom'),
            );
            $this->db->where('type', "video_detail_page");
            $this->db->update('ui_settings', array(
                'value' => json_encode($video_detail_page)
            ));
            recache();
        }

        if ($para1 == "reporters_page") {
            $data = json_decode($this->Crud_model->get_settings_value('ui_settings', 'reporters_page', 'value'), true);
            $reporters_page = array('sidebar' => $this->input->post('sidebar'),
                'widgets' => $this->input->post('widgets'),
                'page_bottom' => $this->input->post('page_bottom'),
            );
            $this->db->where('type', "reporters_page");
            $this->db->update('ui_settings', array(
                'value' => json_encode($reporters_page)
            ));
            recache();
        }

        if ($para1 == "reporter_detail_page") {
            $data = json_decode($this->Crud_model->get_settings_value('ui_settings', 'reporter_detail_page', 'value'), true);
            $reporter_detail_page = array('sidebar' => $this->input->post('sidebar'),
                'widgets' => $this->input->post('widgets'),
                'page_bottom' => $this->input->post('page_bottom'),
            );
            $this->db->where('type', "reporter_detail_page");
            $this->db->update('ui_settings', array(
                'value' => json_encode($reporter_detail_page)
            ));
            recache();
        }

        if ($para1 == "archive_listing_page") {
            $data = json_decode($this->Crud_model->get_settings_value('ui_settings', 'archive_listing_page', 'value'), true);
            $archive_listing_page = array('sidebar' => $this->input->post('sidebar'),
                'widgets' => $this->input->post('widgets'),
                'page_bottom' => $this->input->post('page_bottom'),
            );
            $this->db->where('type', "archive_listing_page");
            $this->db->update('ui_settings', array(
                'value' => json_encode($archive_listing_page)
            ));
            recache();
        }
        if($para1 == 'preview'){
            $page_data['type'] = $para2;
            $page_data['id']   = $para3;
            $this->load->view('back/admin/preview_ui_elements',$page_data);
        }
    }

    /* Manage Site Settings */

    function site_settings($para1 = "") {
        if (!$this->Crud_model->admin_permission('site_settings')) {
            redirect(base_url() . 'admin');
        }
        $page_data['page_name'] = "site_settings";
        $page_data['tab_name'] = $para1;
        $this->load->view('back/index', $page_data);
    }

    /* Manage RSS Settings */

    function rss($para1 = "") {
        if (!$this->Crud_model->admin_permission('rss')) {
            redirect(base_url() . 'admin');
        }
        $page_data['page_name'] = "rss";
        $page_data['tab_name'] = "rss";
        $this->load->view('back/index', $page_data);
    }

    /* Manage Preloader View */

    function preloader_view($para1 = "") {
        if (!$this->Crud_model->admin_permission('display_settings')) {
            redirect(base_url() . 'admin');
        }
        $page_data['from_admin'] = true;
        $page_data['preloader'] = $para1;
        $this->load->view('front/preloader', $page_data);
    }

    /* Manage General Settings */

    function general_settings($para1 = "", $para2 = "") {
        if (!$this->Crud_model->admin_permission('site_settings')) {
            redirect(base_url() . 'admin');
        }
        if ($para1 == "terms") {
            $this->db->where('type', "terms_conditions");
            $this->db->update('general_settings', array(
                'value' => $this->input->post('terms')
            ));
            recache();
        }
        if ($para1 == "privacy_policy") {
            $this->db->where('type', "privacy_policy");
            $this->db->update('general_settings', array(
                'value' => $this->input->post('privacy_policy')
            ));
            recache();
        }
        if ($para1 == "rss") {
            $json_array = array();
            $categories = $this->input->post('news_category');
            $permalink = $this->input->post('permalink');
            $limit = $this->input->post('limit');
            $i=0;
            foreach ($categories as $value) {
                $json_array[] = array(
                                    'index'         =>  $i,
                                    'category_id'   =>  $categories[$i],
                                    'permalink'     =>  $permalink[$i],
                                    'limit'         =>  $limit[$i],
                                );
            $i++;
            }
            $rss = json_encode($json_array);
            $this->db->where('type', "rss");
            $this->db->update('general_settings', array('value' => $rss));
            print_r($data['categories']);
            recache();
        }
        if ($para1 == "preloader") {
            $this->db->where('type', "preloader_bg");
            $this->db->update('general_settings', array(
                'value' => $this->input->post('preloader_bg')
            ));
            $this->db->where('type', "preloader_obj");
            $this->db->update('general_settings', array(
                'value' => $this->input->post('preloader_obj')
            ));
            $this->db->where('type', "preloader");
            $this->db->update('general_settings', array(
                'value' => $this->input->post('preloader')
            ));
            recache();
        }
        if ($para1 == "set_admin_notification_sound") {
            $val = '';
            if ($para2 == 'true') {
                $val = 'ok';
            } else if ($para2 == 'false') {
                $val = 'no';
            } $this->db->where('type', "admin_notification_sound");
            $this->db->update('general_settings', array(
                'value' => $val
            ));
            recache();
        }
        if ($para1 == "set_home_notification_sound") {
            $val = '';
            if ($para2 == 'true') {
                $val = 'ok';
            } else if ($para2 == 'false') {
                $val = 'no';
            }
            $this->db->where('type', "home_notification_sound");
            $this->db->update('general_settings', array(
                'value' => $val
            ));
            recache();
        }
        if ($para1 == "fb_login_set") {
            $val = '';
            if ($para2 == 'true') {
                $val = 'ok';
            } else if ($para2 == 'false') {
                $val = 'no';
            }
            echo $val;
            $this->db->where('type', "fb_login_set");
            $this->db->update('third_party_settings', array(
                'value' => $val
            ));
            recache();
        }
        if ($para1 == "g_login_set") {
            $val = '';
            if ($para2 == 'true') {
                $val = 'ok';
            } else if ($para2 == 'false') {
                $val = 'no';
            }
            echo $val;
            $this->db->where('type', "g_login_set");
            $this->db->update('third_party_settings', array(
                'value' => $val
            ));
            recache();
        }
        if ($para1 == "set") {
            if(!demo()){
                $this->db->where('type', "system_name");
                $this->db->update('general_settings', array(
                    'value' => $this->input->post('system_name')
                ));
                $this->db->where('type', "system_email");
                $this->db->update('general_settings', array(
                    'value' => $this->input->post('system_email')
                ));

                $this->db->where('type', "system_title");
                $this->db->update('general_settings', array(
                    'value' => $this->input->post('system_title')
                ));
                $this->db->where('type', "cache_time");
                $this->db->update('general_settings', array(
                    'value' => $this->input->post('cache_time')
                ));
                $this->db->where('type', "language");
                $this->db->update('general_settings', array(
                    'value' => $this->input->post('language')
                ));
                $volume = $this->input->post('admin_notification_volume');
                $this->db->where('type', "admin_notification_volume");
                $this->db->update('general_settings', array(
                    'value' => $volume
                ));
                $volume = $this->input->post('homepage_notification_volume');
                $this->db->where('type', "homepage_notification_volume");
                $this->db->update('general_settings', array(
                    'value' => $volume
                ));
            }
            recache();
        }
        if ($para1 == 'faq_set') {
            $faqs = array();
            $f_q = $this->input->post('f_q');
            $f_a = $this->input->post('f_a');
            foreach ($f_q as $i => $r) {
                $faqs[] = array(
                    'question' => $f_q[$i],
                    'answer' => $f_a[$i]
                );
            }
            $this->db->where('type', "faqs");
            $this->db->update('general_settings', array(
                'value' => json_encode($faqs)
            ));
            recache();
        }
        if ($para1 == "contact") {
            $this->db->where('type', "contact_address");
            $this->db->update('general_settings', array(
                'value' => $this->input->post('contact_address')
            ));
            $this->db->where('type', "contact_email");
            $this->db->update('general_settings', array(
                'value' => $this->input->post('contact_email')
            ));
            $this->db->where('type', "contact_phone");
            $this->db->update('general_settings', array(
                'value' => $this->input->post('contact_phone')
            ));
            $this->db->where('type', "contact_website");
            $this->db->update('general_settings', array(
                'value' => $this->input->post('contact_website')
            ));
            $this->db->where('type', "contact_about");
            $this->db->update('general_settings', array(
                'value' => $this->input->post('contact_about')
            ));
            recache();
        }
        if ($para1 == "header_style") {
            $header_style = array('menu_links' => $this->input->post('menu_links'),
                'search_bar' => $this->input->post('search_bar'),
                'effects' => $this->input->post('effects'),
                'sticky_header' => $this->input->post('sticky_header')
            );

            $this->db->where('type', "header_style");
            $this->db->update('ui_settings', array(
                'value' => json_encode($header_style)
            ));
            recache();
        }
        if ($para1 == "footer") {
            $this->db->where('type', "footer_text");
            $this->db->update('general_settings', array(
                'value' => $this->input->post('footer_text')
            ));
            $this->db->where('type', "footer_category");
            $this->db->update('general_settings', array(
                'value' => json_encode($this->input->post('category'))
            ));
            recache();
        }
        if ($para1 == "font") {
            $this->db->where('type', "font");
            $this->db->update('ui_settings', array(
                'value' => $this->input->post('font')
            ));
            recache();
        }
        if ($para1 == "color") {
            $this->db->where('type', "header_color");
            $this->db->update('ui_settings', array(
                'value' => $this->input->post('header_color')
            ));
            $this->db->where('type', "footer_color");
            $this->db->update('ui_settings', array(
                'value' => $this->input->post('header_color')
            ));
            recache();
        }
        if ($para1 == "mail_status") {
            $val = '';
            if ($para2 == 'true') {
                $val = 'smtp';
            } else if ($para2 == 'false') {
                $val = 'mail';
            }
            echo $val;
            $this->db->where('type', "mail_status");
            $this->db->update('general_settings', array(
                'value' => $val
            ));
            recache();
        }
        if ($para1 == "captcha_status") {
            $val = '';
            if ($para2 == 'true') {
                $val = 'ok';
            } else if ($para2 == 'false') {
                $val = 'no';
            }
            echo $val;
            $this->db->where('type', "captcha_status");
            $this->db->update('third_party_settings', array(
                'value' => $val
            ));
            recache();
        }
        if ($para1 == "google_analytics_set") {
            $val = '';
            if ($para2 == 'true') {
                $val = 'yes';
            } else if ($para2 == 'false') {
                $val = 'no';
            }
            echo $val;
            $this->db->where('type', "google_analytics_set");
            $this->db->update('general_settings', array(
                'value' => $val
            ));
            recache();
        }
    }

    /* Manage Email Template */

    function email_template($para1 = "", $para2 = "") {
        if (!$this->Crud_model->admin_permission('email_template')) {
            redirect(base_url() . 'admin');
        }

        if ($para1 == "update") {
            $data['subject'] = $this->input->post('subject');
            $data['body'] = $this->input->post('body');

            $this->db->where('email_template_id', $para2);
            $this->db->update('email_template', $data);
            recache();
        }
        else if($para1 == "theme"){
            $this->db->where('type', "email_theme_style");
            $this->db->update('ui_settings', array('value' => $this->input->post('email_theme')));
            recache();
        }
        $page_data['page_name'] = "email_template";
        $page_data['table_info'] = $this->db->get('email_template')->result_array();
        $this->load->view('back/index', $page_data);
    }

    // Manage google analytics
    function google_analytics($para1 = "", $para2 = "") {
        if (!$this->Crud_model->admin_permission('google_analytics')) {
            redirect(base_url() . 'admin');
        }

        if ($para1 == "update") {
            $data['value'] = $this->input->post('google_analytics_key');

            $this->db->where('type','google_analytics_key');
            $result = $this->db->update('third_party_settings', $data);
            recache();
        }

        $page_data['page_name'] = "google_analytics";
        $this->load->view('back/index', $page_data);
    }

    function smtp_settings($para1 = "", $para2 = "") {
        if (!$this->Crud_model->admin_permission('site_settings')) {
            redirect(base_url() . 'admin');
        }
        if ($para1 == "set") {
            $this->db->where('type', 'smtp_host');
            $this->db->update('general_settings', array('value' => $this->input->post('smtp_host')));

            $this->db->where('type', 'smtp_port');
            $this->db->update('general_settings', array('value' => $this->input->post('smtp_port')));

            $this->db->where('type', 'smtp_user');
            $this->db->update('general_settings', array('value' => $this->input->post('smtp_user')));

            $this->db->where('type', 'smtp_pass');
            $this->db->update('general_settings', array('value' => $this->input->post('smtp_pass')));

            redirect(base_url() . 'admin/site_settings/smtp_settings/', 'refresh');
        }
    }

    function faqs() {
        if (!$this->Crud_model->admin_permission('faq')) {
            redirect(base_url() . 'admin');
        }
        $page_data['page_name'] = "faq_settings";
        $this->load->view('back/index', $page_data);
    }

    /* Manage Social Links */

    function social_links($para1 = "") {
        if (!$this->Crud_model->admin_permission('site_settings')) {
            redirect(base_url() . 'admin');
        }
        if ($para1 == "set") {
            $this->db->where('type', "facebook");
            $this->db->update('social_links', array(
                'value' => $this->input->post('facebook')
            ));
            $this->db->where('type', "google-plus");
            $this->db->update('social_links', array(
                'value' => $this->input->post('google-plus')
            ));
            $this->db->where('type', "twitter");
            $this->db->update('social_links', array(
                'value' => $this->input->post('twitter')
            ));
            $this->db->where('type', "skype");
            $this->db->update('social_links', array(
                'value' => $this->input->post('skype')
            ));
            $this->db->where('type', "pinterest");
            $this->db->update('social_links', array(
                'value' => $this->input->post('pinterest')
            ));
            $this->db->where('type', "youtube");
            $this->db->update('social_links', array(
                'value' => $this->input->post('youtube')
            ));
            recache();
            redirect(base_url() . 'admin/site_settings/social_links/', 'refresh');
        }
    }

    /* Manage Blogs Social Links */

    function blogs_social_links($para1 = "") {
        if (!$this->Crud_model->admin_permission('site_settings')) {
            redirect(base_url() . 'admin');
        }
        if ($para1 == "set") {
            $this->db->where('type', "facebook");
            $this->db->update('blogs_social_links', array(
                'value' => $this->input->post('facebook')
            ));
            $this->db->where('type', "google-plus");
            $this->db->update('blogs_social_links', array(
                'value' => $this->input->post('google-plus')
            ));
            $this->db->where('type', "twitter");
            $this->db->update('blogs_social_links', array(
                'value' => $this->input->post('twitter')
            ));
            recache();
            redirect(base_url() . 'admin/site_settings/blogs_social_links/', 'refresh');
        }
    }

    /* Manage SEO relateds */

    function seo_settings($para1 = "") {
        if (!$this->Crud_model->admin_permission('seo')) {
            redirect(base_url() . 'admin');
        }
        if ($para1 == "set") {
            $this->db->where('type', "meta_description");
            $this->db->update('general_settings', array(
                'value' => $this->input->post('description')
            ));
            $this->db->where('type', "meta_keywords");
            $this->db->update('general_settings', array(
                'value' => $this->input->post('keywords')
            ));
            $this->db->where('type', "meta_author");
            $this->db->update('general_settings', array(
                'value' => $this->input->post('author')
            ));

            $this->db->where('type', "revisit_after");
            $this->db->update('general_settings', array(
                'value' => $this->input->post('revisit_after')
            ));
            recache();
        } else {
            require_once (APPPATH . 'libraries/SEOstats/bootstrap.php');
            $page_data['page_name'] = "seo";
            $this->load->view('back/index', $page_data);
        }
    }

    function report($para1 = "") {
        if (!$this->Crud_model->admin_permission('report')) {
            redirect(base_url() . 'admin');
        }
        $page_data['page_name'] = "report";
        $page_data['tab_name'] = $para1;
        $this->load->view('back/index', $page_data);
    }

    function report_most_viewed($para1 = "") {
        if (!$this->Crud_model->admin_permission('report')) {
            redirect(base_url() . 'admin');
        }
        $page_data['page_name'] = "report_most_viewed";
        $page_data['tab_name'] = $para1;
        $this->load->view('back/index', $page_data);
    }

    function report_date_wise_news($para1 = "") {
        if (!$this->Crud_model->admin_permission('report')) {
            redirect(base_url() . 'admin');
        }
        $page_data['page_name'] = "report_date_wise_news";
        $page_data['tab_name'] = $para1;
        $this->load->view('back/index', $page_data);
    }

    function report_last_30_days($para1 = "") {
        if (!$this->Crud_model->admin_permission('report')) {
            redirect(base_url() . 'admin');
        }
        $page_data['page_name'] = "report_last_30_days";
        $page_data['tab_name'] = $para1;
        $this->load->view('back/index', $page_data);
    }

    /* Product Wish Comparison Reports */

    function report_wish($para1 = '', $para2 = '') {
        if (!$this->Crud_model->admin_permission('report')) {
            redirect(base_url() . 'admin');
        }
        $page_data['page_name'] = "report_wish";
        $this->load->view('back/index', $page_data);
    }

    /*function ticket($para1 = "", $para2 = "", $para3 = "") {
        if (!$this->Crud_model->admin_permission('ticket')) {
            redirect(base_url() . 'admin');
        }
        if ($para1 == 'delete') {
            $this->db->where('ticket_id', $para2);
            $this->db->delete('ticket');
        } elseif ($para1 == 'list') {
            $this->db->order_by('ticket_id', 'desc');
            $page_data['tickets'] = $this->db->get('ticket')->result_array();
            $this->load->view('back/admin/ticket_list', $page_data);
        } elseif ($para1 == 'reply') {
            $data['message'] = $this->input->post('reply');
            $data['time'] = time();
            $data['from_where'] = json_encode(array('type' => 'admin', 'id' => ''));
            $data['to_where'] = $this->db->get_where('ticket_message', array('ticket_id' => $para2))->row()->from_where;
            $data['ticket_id'] = $para2;
            $data['view_status'] = json_encode(array('user_show' => 'no', 'admin_show' => 'ok'));
            $data['subject'] = $this->db->get_where('ticket_message', array('ticket_id' => $para2))->row()->subject;
            $this->db->insert('ticket_message', $data);
        } elseif ($para1 == 'view') {
            $page_data['message_data'] = $this->db->get_where('ticket', array('ticket_id' => $para2))->result_array();
            $this->Crud_model->ticket_message_viewed($para2, 'admin');
            $this->load->view('back/admin/ticket_view', $page_data);
        } else if ($para1 == 'view_user') {
            $page_data['user_data'] = $this->db->get_where('user', array('user_id' => $para2))->result_array();
            $this->load->view('back/admin/user_view', $page_data);
        } elseif ($para1 == 'reply_form') {
            $page_data['message_data'] = $this->db->get_where('ticket', array(
                        'ticket_id' => $para2
                    ))->result_array();
            $this->load->view('back/admin/ticket_reply', $page_data);
        } else {
            $page_data['page_name'] = "ticket";
            $page_data['tickets'] = $this->db->get('ticket')->result_array();
            $this->load->view('back/index', $page_data);
        }
    }
*/
    /**
     * @param string $para1
     * @param string $para2
     */
    /* User Management */
    function user($para1 = '', $para2 = '') {
        if (!$this->Crud_model->admin_permission('user')) {
            redirect(base_url() . 'admin');
        }
        if ($para1 == 'do_add') {
            $data['username'] = $this->input->post('user_name');
            $data['description'] = $this->input->post('description');
            $this->db->insert('user', $data);
        } else if ($para1 == 'edit') {
            $page_data['user_data'] = $this->db->get_where('user', array(
                        'user_id' => $para2
                    ))->result_array();
            $this->load->view('back/admin/user_edit', $page_data);
        } elseif ($para1 == "update") {
            $data['username'] = $this->input->post('username');
            $data['description'] = $this->input->post('description');
            $this->db->where('user_id', $para2);
            $this->db->update('user', $data);
        } elseif ($para1 == 'delete') {
            if(!demo()){
                if (file_exists('uploads/user_image/user_' . $para2 . '.jpg')) {
                    unlink('uploads/user_image/user_' . $para2 . '.jpg');
                }
                if (file_exists('uploads/user_image/user_' .$para2 .'_thumb.jpg')) {
                    unlink('uploads/user_image/user_' .$para2 .'_thumb.jpg');
                }
                $this->db->where('user_id', $para2);
                $this->db->delete('user');
            }
        } elseif ($para1 == 'list') {
            $this->db->order_by('user_id', 'desc');
            $page_data['all_users'] = $this->db->get('user')->result_array();
            $this->load->view('back/admin/user_list', $page_data);
        } elseif ($para1 == 'view') {
            $page_data['user_data'] = $this->db->get_where('user', array(
                        'user_id' => $para2
                    ))->result_array();
            $this->load->view('back/admin/user_view', $page_data);
        } elseif ($para1 == 'add') {
            $this->load->view('back/admin/user_add');
        } else {
            $page_data['page_name'] = "user";
            $page_data['all_users'] = $this->db->get('user')->result_array();
            $this->load->view('back/index', $page_data);
        }
    }

    /*
      # @function name --> display_settings
      # @para1       --> String
      #
      #
     */

    function display_theme_selection($para1 = "") {
        if (!$this->Crud_model->admin_permission('display_settings')) {
            redirect(base_url() . 'admin');
        }
        $page_data['page_name'] = "display_theme_selection";
        $page_data['tab_name'] = $para1;
        $this->load->view('back/index', $page_data);
    }

    function theme_part() {
        $this->load->view('back/admin/display_theme_part');
    }

    function display_theme_settings($para1 = "") {
        if (!$this->Crud_model->admin_permission('display_settings')) {
            redirect(base_url() . 'admin');
        }
        $page_data['page_name'] = "display_theme_settings";
        $page_data['tab_name'] = $para1;
        $this->load->view('back/index', $page_data);
    }

    function header_part() {
        $this->load->view('back/admin/display_header');
    }

    function footer_part() {
        $this->load->view('back/admin/display_footer');
    }

    function page_elements() {
        $this->load->view('back/admin/display_page_elements');
    }

    function display_others($para1 = "",$para2="",$para3="") {
        if (!$this->Crud_model->admin_permission('display_settings')) {
            redirect(base_url() . 'admin');
        }
        if($para1 == 'preview'){
            $page_data['type']  = $para2;
            $page_data['id']   = $para3;
            $this->load->view('back/admin/preview_theme_color',$page_data);
        }
        else{
            $page_data['page_name'] = "display_others";
            $page_data['tab_name'] = $para1;
            $this->load->view('back/index', $page_data);
        }
    }

    function color_part() {
        $this->load->view('back/admin/display_color_part');
    }

    function logo_part() {
        $this->load->view('back/admin/display_logo_part');
    }

    function favicon_part() {
        $this->load->view('back/admin/display_favicon');
    }

    function font_part() {
        $this->load->view('back/admin/display_font');
    }

    function preloader_part() {
        $this->load->view('back/admin/display_preloader');
    }

    function home_part() {
        $this->load->view('back/admin/display_home_part');
    }

    function contact_part() {
        $this->load->view('back/admin/display_contact');
    }

    /*
      function For THIRD PARTY SETTINGS
     */

    function third_party_settings($para1 = "") {
        if (!$this->Crud_model->admin_permission('third_party_settings')) {
            redirect(base_url() . 'admin');
        }
        $page_data['page_name'] = "third_party_settings";
        $this->load->view('back/index', $page_data);
    }

    /* Manage Frontend Captcha Settings Credentials */

    function captcha_settings($para1 = "") {
        if (!$this->Crud_model->admin_permission('site_settings')) {
            redirect(base_url() . 'admin');
        }
        $this->db->where('type', "captcha_public");
        $this->db->update('third_party_settings', array(
            'value' => $this->input->post('cpub')
        ));
        $this->db->where('type', "captcha_private");
        $this->db->update('third_party_settings', array(
            'value' => $this->input->post('cprv')
        ));
        recache();
    }

    /* Manage Frontend Facebook Login Credentials */

    function social_login_settings($para1 = "") {
        if (!$this->Crud_model->admin_permission('site_settings')) {
            redirect(base_url() . 'admin');
        }
        $this->db->where('type', "fb_appid");
        $this->db->update('third_party_settings', array(
            'value' => $this->input->post('appid')
        ));
        $this->db->where('type', "fb_secret");
        $this->db->update('third_party_settings', array(
            'value' => $this->input->post('secret')
        ));
        $this->db->where('type', "g_application_name");
        $this->db->update('third_party_settings', array(
            'value' => $this->input->post('application_name')
        ));
        $this->db->where('type', "g_client_id");
        $this->db->update('third_party_settings', array(
            'value' => $this->input->post('client_id')
        ));
        $this->db->where('type', "g_client_secret");
        $this->db->update('third_party_settings', array(
            'value' => $this->input->post('client_secret')
        ));
        $this->db->where('type', "g_redirect_uri");
        $this->db->update('third_party_settings', array(
            'value' => $this->input->post('redirect_uri')
        ));
        $this->db->where('type', "g_api_key");
        $this->db->update('third_party_settings', array(
            'value' => $this->input->post('g_api_key')
        ));
        $this->db->where('type', "g_map_api_key");
        $this->db->update('third_party_settings', array(
            'value' => $this->input->post('api_key')
        ));
        recache();
    }

    /* Manage Frontend Facebook Login Credentials */

    function news_comment($para1 = "") {
        if (!$this->Crud_model->admin_permission('site_settings')) {
            redirect(base_url() . 'admin');
        }
        $this->db->where('type', "discus_id");
        $this->db->update('third_party_settings', array(
            'value' => $this->input->post('discus_id')
        ));
        $this->db->where('type', "comment_type");
        $this->db->update('third_party_settings', array(
            'value' => $this->input->post('type')
        ));
        $this->db->where('type', "fb_comment_api");
        $this->db->update('third_party_settings', array(
            'value' => $this->input->post('fb_comment_api')
        ));
        recache();
    }

    function google_api_key($para1 = ""){
        if (!$this->Crud_model->admin_permission('site_settings')) {
            redirect(base_url() . 'admin');
        }
        $this->db->where('type', "g_map_api_key");
        $this->db->update('third_party_settings', array(
            'value' => $this->input->post('api_key')
        ));
        recache();
    }

    function default_images($para1 = "", $para2 = "") {
        if (!$this->Crud_model->admin_permission('default_images')) {
            redirect(base_url() . 'admin');
        }
        if ($para1 == "set_images") {
            if(!demo()){
                move_uploaded_file($_FILES[$para2]['tmp_name'], 'uploads/' . $para2 . '/default.jpg');
            }
            recache();
        }
        $page_data['default_list'] = array('news_image' => 'news_images',
            'photo_image' => 'gallery_photos',
            'user_image' => 'user_profile_picture',
            'news_reporter_image' => 'news_reporter_image',
            'logo_image' => 'logos',
            'others' => 'others'
        );
        $page_data['page_name'] = "default_images";
        $this->load->view('back/index', $page_data);
    }


    function payments($para1 = '', $para2 = '',$para3='') {
        if (!$this->Crud_model->admin_permission('ads_settings')) {
            redirect(base_url() . 'admin');
        }
        if($para1 == 'view'){
            $page_data['payment_id']    = $para2;
            $this->load->view('back/admin/ad_payment_view',$page_data);
        }
        else if($para1 == 'approval'){
            $advertisement_id = $this->db->get_where('advertisement_payment', array('advertisement_payment_id' => $para2))->row()->advertisement_id;
            if($para3 == 'true'){
                $data['approval']   = 'ok';
            } else {
                $data['approval'] = 'no';
            }
            $this->db->where('advertisement_id', $advertisement_id);
            $this->db->update('advertisement',$data);
        } else {
            $page_data['page_name'] = 'ad_payment_list';
            $this->load->view('back/index',$page_data);
        }
    }

    function subscription($para1 = '', $para2 = '',$para3='') {
        if (!$this->Crud_model->admin_permission('subscription')) {
            redirect(base_url() . 'admin');
        }
        if ($para1 == 'list') {
            $page_data['all_subscriptions'] = $this->db->get("subscription")->result();
            $page_data['page_name'] = 'subscription';

            $this->load->view('back/admin/subscription_list',$page_data);
        }
        elseif ($para1 == "edit") {
            $page_data['get_subscription'] = $this->db->get_where("subscription", array("subscription_id" => $para2))->result();
            $page_data['page_name'] = 'subscription_edit';
            $this->load->view('back/admin/subscription_edit',$page_data);
        }
        elseif ($para1=="update") {
            $subscription_id = $this->input->post('subscription_id');
            $data['name'] = $this->input->post('name');
            $data['amount'] = $this->input->post('amount');
            $data['post_amount'] = $this->input->post('post_amount');
            $data['video_amount'] = $this->input->post('video_amount');
            $data['photo_amount'] = $this->input->post('photo_amount');
            if(!demo()){
                if ($_FILES['image']['name'] !== '') {
                    $id = $subscription_id;
                    $path = $_FILES['image']['name'];
                    $ext = '.' . pathinfo($path, PATHINFO_EXTENSION);
                    if ($ext==".jpg" || $ext==".JPG" || $ext==".jpeg" || $ext==".JPEG" || $ext==".png" || $ext==".PNG") {
                        $this->Crud_model->file_up("image", "subscription", $id, '', '', $ext);
                        $images[] = array('image' => 'subscription_' . $id . $ext, 'thumb' => 'subscription_' . $id . '_thumb' . $ext);
                        $data['image'] = json_encode($images);
                    }
                    else {
                        $this->session->set_flashdata('alert', 'failed_image');
                        redirect(base_url().'admin/subscription', 'refresh');
                    }
                }
            }
            $this->db->where('subscription_id', $subscription_id);
            $result = $this->db->update('subscription', $data);
            if ($result) {
                $this->session->set_flashdata('alert', 'edit');
                redirect(base_url().'admin/subscription', 'refresh');
            }
            else {
                echo "Data Failed to Edit!";
            }
            exit;
        }
        else {
            $page_data['all_subscriptions'] = $this->db->get("subscription")->result();
            $page_data['page_name'] = 'subscription';
            $this->load->view('back/index', $page_data);
        }
    }

    function subscription_payment($para1 = '', $para2 = '',$para3='') {
        if (!$this->Crud_model->admin_permission('ads_settings')) {
            redirect(base_url() . 'admin');
        }
        if($para1 == 'view'){
            $page_data['payment_id']    = $para2;
            $this->load->view('back/admin/subscription_payment_view',$page_data);
        }
        else {
            $page_data['page_name'] = 'subscription_payment';
            $this->load->view('back/index',$page_data);
        }
    }

    function ads_settings($para1 = '', $para2 = '', $para3 = '') {
        if (!$this->Crud_model->admin_permission('ads_settings')) {
            redirect(base_url() . 'admin');
        }
        if($para1 == 'set_default'){
            $type   = $this->db->get_where('advertisement',array('advertisement_id' => $para2))->row()->type;
            $url    = $this->input->post('redirect_url');
            $previous_default = json_decode($this->db->get_where('advertisement',array('advertisement_id' => $para2))->row()->default_post,true);
            $default = array();
            if(!demo()){
                if($_FILES['default_image']['name'] !== ''){
                    $path   = $_FILES['default_image']['name'];
                    $ext    = pathinfo($path,PATHINFO_EXTENSION);
                    $img    = $type.'.'.$ext;
                    $default[] = array(
                        'url'   => $url,
                        'img'   => $img
                    );
                    move_uploaded_file($_FILES['default_image']['tmp_name'], 'uploads/default_banner/'.$img);
                }
                else {
                    $default[] = array(
                        'url'   => $url,
                        'img'   => $previous_default[0]['img']
                    );
                }
            }
            else{
                $default[] = array(
                    'url'   => $url,
                    'img'   => $previous_default[0]['img']
                );
            }
            $data['default_post']   = json_encode($default);
            $this->db->where('advertisement_id',$para2);
            $this->db->update('advertisement',$data);
            recache();
        }
        else if($para1 == 'package'){
            $this->Ads_model->update_package($para2,$para3);
        }
        else if ($para1 == 'status') {
            $this->Ads_model->update_ad_status($para2, $para3);
        } else {
            $page_data['page_name'] = 'ads_settings';
            $this->load->view('back/index', $page_data);
        }

    }

    // function google_adsense_settings($para1 = '', $para2 = '', $para3 = '') {
    //     if (!$this->Crud_model->admin_permission('ads_settings')) {
    //         redirect(base_url() . 'admin');
    //     }
    //     if($para1 == 'set_google_adsense'){
    //         $type   = $this->db->get_where('advertisement',array('advertisement_id' => $para2))->row()->type;
    //         $data['google_adsense_code']    = $this->input->post('google_adsense_code');
    //         $google_adsense_set = $this->input->post('google_adsense');
    //         if (isset($google_adsense_set)) {
    //             $data['google_adsense']         = 'ok';
    //             $data['availability']           = 'booked';
    //
    //         } else {
    //             $data['google_adsense']         = '';
    //             $data['availability']           = 'available';
    //
    //         }
    //
    //         $this->db->where('advertisement_id',$para2);
    //         $this->db->update('advertisement',$data);
    //         recache();
    //     }
    //     else {
    //         $page_data['page_name'] = 'google_adsense_settings';
    //         $this->load->view('back/index', $page_data);
    //     }
    //
    // }

    function ads_log($para1 = '', $para2 = '', $para3 = '') {
        if (!$this->Crud_model->admin_permission('ads_log')) {
            redirect(base_url() . 'admin');
        }
        else {
            $page_data['page_name'] = 'ads_log';
            $this->load->view('back/index',$page_data);
        }
    }

    // Currency SETTINGS

    function curency_settings(){
        if (!$this->Crud_model->admin_permission('currency')) {
            redirect(base_url() . 'admin');
        }

        $page_data['page_name'] = "curency_settings";
        $this->load->view('back/index', $page_data);
    }

    function set_def_curr($para1 = '', $para2 = '',$para3 = '',$para4 = '')
    {
        if (!$this->Crud_model->admin_permission('currency')) {
            redirect(base_url() . 'admin');
        }
        if($para1 == 'home'){
            $this->db->where('type', "home_def_currency");
            $this->db->update('business_settings', array(
                'value' => $this->input->post('home_def_currency')
            ));
        }
        if($para1 == 'system'){
            $this->db->where('type', "currency");
            $this->db->update('business_settings', array(
                'value' => $this->input->post('currency')
            ));

            $this->db->where('currency_settings_id', $this->input->post('currency'));
            $this->db->update('currency_settings', array(
                'exchange_rate_def' => '1'
            ));
        }
        recache();
    }

    /* Currency Format Settings */
    function set_currency_format(){
        if (!$this->Crud_model->admin_permission('currency')) {
            redirect(base_url() . 'admin');
        }

        $this->db->where('type', 'currency_format');
        $this->db->update('business_settings', array(
            'value' => $this->input->post('currency_format')
        ));

        $this->db->where('type', 'symbol_format');
        $this->db->update('business_settings', array(
            'value' => $this->input->post('symbol_format')
        ));

        $this->db->where('type', 'no_of_decimals');
        $this->db->update('business_settings', array(
            'value' => $this->input->post('no_of_decimals')
        ));

        recache();
    }

    function set_currency_rate($para1 = "",$para2 = ""){
        if (!$this->Crud_model->admin_permission('currency')) {
            redirect(base_url() . 'admin');
        }
        if($para1 =='set_rate'){
            if($this->input->post('exchange')){
                echo $data['exchange_rate']         = $this->input->post('exchange');
            }
            if($this->input->post('exchange_def')){
                echo $data['exchange_rate_def']     = $this->input->post('exchange_def');
            }
            if($this->input->post('name')){
                echo $data['name']      = $this->input->post('name');
            }
            if($this->input->post('symbol')){
                echo $data['symbol']        = $this->input->post('symbol');
            }
            $this->db->where('currency_settings_id', $para2);
            $this->db->update('currency_settings', $data);
            recache();
        }
    }

    function ads_payment_settings($para1 = '', $para2 = '', $para3 = '') {
        if (!$this->Crud_model->admin_permission('ads_payment_settings')) {
            redirect(base_url() . 'admin');
        }
        if ($para1 == 'activation') {
            if ($para2 == 'paypal_set') {
                $this->Ads_model->payment_gateway_activation($para2, $para3);
            }
            else if ($para2 == 'stripe_set') {
                $this->Ads_model->payment_gateway_activation($para2, $para3);
            }
        } elseif ($para1 == 'set_payment_method') {
            $this->Ads_model->set_payment_method_value('paypal_email');
            $this->Ads_model->set_payment_method_value('paypal_account_type');
            $this->Ads_model->set_payment_method_value('stripe_secret_key');
            $this->Ads_model->set_payment_method_value('stripe_publishable_key');
        } else {
            $page_data['paypal_set'] = $this->Ads_model->is_payment_gateway_activate('paypal_set');
            $page_data['stripe_set'] = $this->Ads_model->is_payment_gateway_activate('stripe_set');
            $page_data['paypal_email'] = $this->Ads_model->get_payment_gateway_value('paypal_email');
            $page_data['paypal_account_type'] = $this->Ads_model->get_payment_gateway_value('paypal_account_type');
            $page_data['stripe_secret_key'] = $this->Ads_model->get_payment_gateway_value('stripe_secret_key');
            $page_data['stripe_publishable_key'] = $this->Ads_model->get_payment_gateway_value('stripe_publishable_key');

            $page_data['page_name'] = "ads_payment_settings";
            $this->load->view('back/index', $page_data);
        }
    }

     function test()
     {

     }

}
