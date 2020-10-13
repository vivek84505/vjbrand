<?php

    if (!defined('BASEPATH'))
        exit('No direct script access allowed');

    class Crud_model extends CI_Model {

        function __construct() {
            parent::__construct();
        }

        function clear_cache() {
            $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
            $this->output->set_header('Pragma: no-cache');
        }

        function get_field($table, $table_id = '', $field = 'name') {
            return $this->db->get_where($table, array($table . '_id' => $table_id))->row()->$field;
        }

        /////////GET NAME BY TABLE NAME AND ID/////////////
        function get_type_name_by_id($type, $type_id = '', $field = 'name') {
            if ($type_id != '') {
                $l = $this->db->get_where($type, array($type . '_id' => $type_id));
                $n = $l->num_rows();
                if ($n > 0) {
                    return $l->row()->$field;
                }
            }
        }

        function get_settings_value($type, $type_name = '', $field = 'value') {
            if ($type_name != '') {
                return $this->db->get_where($type, array('type' => $type_name))->row()->$field;
            }
        }

        function get_main_image($data) {
            foreach ($data as $row) {
                if ($row['index'] == 0) {
                    return $row['img'];
                }
            }
        }

        function get_main_thumb($data) {
            foreach ($data as $row) {
                if ($row['index'] == 0) {
                    return $row['thumb'];
                }
            }
        }

        function check_page_ad_availability($type, $id) {
            $available = $this->db->get_where('advertisement', array('page_id' => $id, 'status' => 'ok', 'availability' => $type))->num_rows();
            if ($available == 0) {
                return false;
            } else {
                return true;
            }
        }

        /*
          Get Table Value by Type
         */

        function get_val_by_type($table, $type) {
            return $this->db->get_where($table, array('type' => $type))->row()->value;
        }

        //GET PRODUCT LINK
        function news_link($news_id, $quick = '') {
            if ($quick == 'quick') {
                return base_url() . 'home/news_description/' . $news_id;
            } else {
                $name = url_title($this->get_type_name_by_id('news', $news_id, 'title'));
                return base_url() . 'home/news_description/' . $news_id . '/' . $name;
            }
        }

        function blog_link($blog_id, $quick = '') {
            if ($quick == 'quick') {
                return base_url() . 'home/blog_detail/' . $blog_id;
            } else {
                $name = url_title($this->get_type_name_by_id('blog', $blog_id, 'title'));
                return base_url() . 'home/blog_detail/' . $blog_id . '/' . $name;
            }
        }

        function blog_photo_link($blog_photo_id, $quick = '') {
            if ($quick == 'quick') {
                return base_url() . 'home/blog_photo_description/' . $blog_photo_id;
            } else {
                $name = url_title($this->get_type_name_by_id('blog_photo', $blog_photo_id, 'title'));
                return base_url() . 'home/blog_photo_description/' . $blog_photo_id . '/' . $name;
            }
        }


        function blog_video_link($blog_video_id, $quick = '') {
            if ($quick == 'quick') {
                return base_url() . 'home/blog_video_description/' . $blog_video_id;
            } else {
                //$name = url_title($this->get_type_name_by_id('photo', $blog_video_id, 'title'));
                $name = url_title($this->get_type_name_by_id('blog_video', $blog_video_id, 'title'));
                return base_url() . 'home/blog_video_description/' . $blog_video_id . '/' . $name;
            }
        }

        function news_link_archive($news_id, $quick = '') {
            if ($quick == 'quick') {
                return base_url() . 'home/news_description_archive/' . $news_id;
            } else {
                $name = url_title($this->get_type_name_by_id('news_archive', $news_id, 'title'));
                return base_url() . 'home/news_description_archive/' . $news_id . '/' . $name;
            }
        }

        function photo_link($photo_id, $quick = '') {
            if ($quick == 'quick') {
                return base_url() . 'home/photo_description/' . $photo_id;
            } else {
                $name = url_title($this->get_type_name_by_id('photo', $photo_id, 'title'));
                return base_url() . 'home/photo_description/' . $photo_id . '/' . $name;
            }
        }

        function video_link($video_id, $quick = '') {
            if ($quick == 'quick') {
                return base_url() . 'home/video_description/' . $video_id;
            } else {
                //$name = url_title($this->get_type_name_by_id('photo', $video_id, 'title'));
                $name = url_title($this->get_type_name_by_id('video', $video_id, 'title'));
                return base_url() . 'home/video_description/' . $video_id . '/' . $name;
            }
        }

        function reporter_link($reporter_id, $quick = '') {
            if ($quick == 'quick') {
                return base_url() . 'home/reporter_description/' . $reporter_id;
            } else {
                $name = url_title($this->get_type_name_by_id('news_reporter', $reporter_id, 'name'));
                return base_url() . 'home/reporter_description/' . $reporter_id . '/' . $name;
            }
        }

        function bloggers_link($blogger_id, $quick = '') {
            if ($quick == 'quick') {
                return base_url() . 'home/blogger_description/' . $blogger_id;
            } else {
                $name = url_title($this->get_type_name_by_id('user', $blogger_id, 'firstname').' '.$this->get_type_name_by_id('user', $blogger_id, 'lastname'));
                return base_url() . 'home/blogger_description/' . $blogger_id . '/' . $name;
            }
        }

        function blogger_link($user_id, $quick = '') {
            if ($quick == 'quick') {
                return base_url() . 'home/blog_profile/' . $user_id;
            } else {
                $name = url_title($this->get_type_name_by_id('user', $user_id, 'firstname').' '.$this->get_type_name_by_id('user', $user_id, 'lastname'));
                return base_url() . 'home/blog_profile/' . $user_id . '/' . $name;
            }
        }

        function get_seconds($string) {
            $string = explode('-', $string);
            $value = $string[0];
            $type = $string[1];
            if ($type == 'day') {
                $secnd1 = $value * 86400;
                return $secnd1;
            } elseif ($type == 'month') {
                $secnd2 = $value * 30 * 86400;
                return $secnd2;
            } elseif ($type == 'year') {
                $secnd3 = $value * 12 * 30 * 86400;
                return $secnd3;
            } else {
                return 0;
            }
        }

        /////////Filter One/////////////
        function filter_one($table, $type, $value) {
            $this->db->select('*');
            $this->db->from($table);
            $this->db->where($type, $value);
            return $this->db->get()->result_array();
        }

        // FILE_UPLOAD
        function img_thumb($type, $id, $ext = '.jpg', $width = '400', $height = '400') {
            $this->load->library('image_lib');
            ini_set("memory_limit", "-1");

            $config1['image_library'] = 'gd2';
            $config1['create_thumb'] = TRUE;
            $config1['maintain_ratio'] = TRUE;
            $config1['width'] = $width;
            $config1['height'] = $height;
            $config1['source_image'] = 'uploads/' . $type . '_image/' . $type . '_' . $id .'.'. $ext;

            $this->image_lib->initialize($config1);
            $this->image_lib->resize();
            $this->image_lib->clear();
        }

        // FILE_UPLOAD
        function file_up($name, $type, $id, $multi = '', $no_thumb = '', $ext = '.jpg', $ext_other = '') {
            if ($multi == '') {
                $path   = $_FILES[$name]['name'];
                if($ext_other == ''){
                    $ext    = pathinfo($path, PATHINFO_EXTENSION);
                } else {
                    $ext    = $ext_other;
                }
                move_uploaded_file($_FILES[$name]['tmp_name'], 'uploads/' . $type . '_image/' . $type . '_' . $id .'.'. $ext);
                if ($no_thumb == '') {
                    $this->img_thumb($type, $id, $ext);
                }
            } elseif ($multi == 'multi') {
                $ib = 1;
                foreach ($_FILES[$name]['name'] as $i => $row) {
                    $path   = $_FILES[$name]['name'][$i];
                    $ext    = pathinfo($path, PATHINFO_EXTENSION);
                    $ib     = $this->file_exist_ret($type, $id, $ib, $ext);
                    move_uploaded_file($_FILES[$name]['tmp_name'][$i], 'uploads/' . $type . '_image/' . $type . '_' . $id . '_' . $ib .'.'. $ext);
                    if ($no_thumb == '') {
                        $this->img_thumb($type, $id . '_' . $ib, $ext);
                    }
                }
            }
        }

        // FILE_UPLOAD : EXT :: FILE EXISTS
        function file_exist_ret($type, $id, $ib, $ext = '.jpg') {
            if (file_exists('uploads/' . $type . '_image/' . $type . '_' . $id . '_' . $ib . $ext)) {
                $ib = $ib + 1;
                $ib = $this->file_exist_ret($type, $id, $ib);
                return $ib;
            } else {
                return $ib;
            }
        }

        // FILE_VIEW
        function file_view($type, $id, $width = '100', $height = '100', $thumb = 'no', $src = 'no', $multi = '', $multi_num = '', $ext = '.jpg') {
            if ($multi == '') {
                if (file_exists('uploads/' . $type . '_image/' . $type . '_' . $id . $ext)) {
                    if ($thumb == 'no') {
                        $srcl = base_url() . 'uploads/' . $type . '_image/' . $type . '_' . $id . $ext;
                    } elseif ($thumb == 'thumb') {
                        $srcl = base_url() . 'uploads/' . $type . '_image/' . $type . '_' . $id . '_thumb' . $ext;
                    }

                    if ($src == 'no') {
                        return '<img src="' . $srcl . '" height="' . $height . '" width="' . $width . '" />';
                    } elseif ($src == 'src') {
                        return $srcl;
                    }
                } else {
                    return base_url() . 'uploads/' . $type . '_image/default.jpg';
                }
            } else if ($multi == 'multi') {
                $num = count(json_decode($this->Crud_model->get_type_name_by_id($type, $id, 'img_features'), true));
                //$n = 0;
                $i = 0;
                $p = 0;
                $q = 0;
                $return = array();
                while ($p < $num) {
                    $i++;
                    if (file_exists('uploads/' . $type . '_image/' . $type . '_' . $id . '_' . $i . $ext)) {
                        if ($thumb == 'no') {
                            $srcl = base_url() . 'uploads/' . $type . '_image/' . $type . '_' . $id . '_' . $i . $ext;
                        } elseif ($thumb == 'thumb') {
                            $srcl = base_url() . 'uploads/' . $type . '_image/' . $type . '_' . $id . '_' . $i . '_thumb' . $ext;
                        }

                        if ($src == 'no') {
                            $return[] = '<img src="' . $srcl . '" height="' . $height . '" width="' . $width . '" />';
                        } elseif ($src == 'src') {
                            $return[] = $srcl;
                        }
                        $p++;
                    } else {
                        $q++;
                        if ($q == 10) {
                            break;
                        }
                    }
                }
                if (!empty($return)) {
                    if ($multi_num == 'one') {
                        return $return[0];
                    } else if ($multi_num == 'all') {
                        return $return;
                    } else {
                        $n = $multi_num - 1;
                        unset($return[$n]);
                        return $return;
                    }
                } else {
                    if ($multi_num == 'one') {
                        return base_url() . 'uploads/' . $type . '_image/default.jpg';
                    } else if ($multi_num == 'all') {
                        return array(base_url() . 'uploads/' . $type . '_image/default.jpg');
                    } else {
                        return array(base_url() . 'uploads/' . $type . '_image/default.jpg');
                    }
                }
            }
        }

        // FILE_VIEW
        function file_dlt($type, $id, $ext = '.jpg', $multi = '', $m_sin = '') {
            if ($multi == '') {
                if (file_exists('uploads/' . $type . '_image/' . $type . '_' . $id . $ext)) {
                    unlink("uploads/" . $type . "_image/" . $type . "_" . $id . $ext);
                }
                if (file_exists("uploads/" . $type . "_image/" . $type . "_" . $id . "_thumb" . $ext)) {
                    unlink("uploads/" . $type . "_image/" . $type . "_" . $id . "_thumb" . $ext);
                }
            } else if ($multi == 'multi') {
                $num = count(json_decode($this->Crud_model->get_type_name_by_id($type, $id, 'img_features'), true));
                if ($m_sin == '') {
                    $i = 0;
                    $p = 0;
                    while ($p < $num) {
                        $i++;
                        if (file_exists('uploads/' . $type . '_image/' . $type . '_' . $id . '_' . $i . $ext)) {
                            unlink("uploads/" . $type . "_image/" . $type . "_" . $id . '_' . $i . $ext);
                            $p++;
                            $data['num_of_imgs'] = $num - 1;
                            $this->db->where($type . '_id', $id);
                            $this->db->update($type, $data);
                        }

                        if (file_exists("uploads/" . $type . "_image/" . $type . "_" . $id . '_' . $i . "_thumb" . $ext)) {
                            unlink("uploads/" . $type . "_image/" . $type . "_" . $id . '_' . $i . "_thumb" . $ext);
                        }
                        if ($i < 50) {
                            break;
                        }
                    }
                } else {
                    if (file_exists('uploads/' . $type . '_image/' . $type . '_' . $id . '_' . $m_sin . $ext)) {
                        unlink("uploads/" . $type . "_image/" . $type . "_" . $id . '_' . $m_sin . $ext);
                    }
                    if (file_exists("uploads/" . $type . "_image/" . $type . "_" . $id . '_' . $m_sin . "_thumb" . $ext)) {
                        unlink("uploads/" . $type . "_image/" . $type . "_" . $id . '_' . $m_sin . "_thumb" . $ext);
                    }
                    $data['num_of_imgs'] = $num - 1;
                    $this->db->where($type . '_id', $id);
                    $this->db->update($type, $data);
                }
            }
        }

        //DELETE MULTIPLE ITEMS
        function multi_delete($type, $ids_array) {
            foreach ($ids_array as $row) {
                $this->file_dlt($type, $row);
                $this->db->where($type . '_id', $row);
                $this->db->delete($type);
            }
        }

        //DELETE SINGLE ITEM
        function single_delete($type, $id) {
            $this->file_dlt($type, $id);
            $this->db->where($type . '_id', $id);
            $this->db->delete($type);
        }

        /////////SELECT HTML/////////////
        function select_html($from, $name, $field, $type, $class, $e_match = '', $condition = '', $c_match = '', $onchange = '') {
            $return = '';
            $other = '';
            $multi = 'no';
            $phrase = 'Choose a ' . $name;
            if ($class == 'demo-cs-multiselect' || $class == 'demo-cs-multiselect widget_select') {
                $other = 'multiple';
                $name = $name . '[]';
                if ($type == 'edit') {
                    $e_match = json_decode($e_match);
                    if ($e_match == NULL) {
                        $e_match = array();
                    }
                    $multi = 'yes';
                }
            }
            $return = '<select name="' . $name . '" onChange="' . $onchange . '(this.value,this)" class="' . $class . '" ' . $other . '  data-placeholder="' . $phrase . '" tabindex="2" >';
            if (!is_array($from)) {
                if ($condition == '') {
                    $all = $this->db->get($from)->result_array();
                } else if ($condition !== '') {
                    $all = $this->db->get_where($from, array($condition => $c_match))->result_array();
                }

                $return .= '<option value="" disabled selected>' . translate('choose_one') . '</option>';

                foreach ($all as $row):
                    if ($type == 'add') {
                        $return .= '<option value="' . $row[$from . '_id'] . '">' . $row[$field] . '</option>';
                    } else if ($type == 'edit') {
                        $return .= '<option value="' . $row[$from . '_id'] . '" ';
                        if ($multi == 'no') {
                            if ($row[$from . '_id'] == $e_match) {
                                $return .= 'selected=."selected"';
                            }
                        } else if ($multi == 'yes') {
                            if (in_array($row[$from . '_id'], $e_match)) {
                                $return .= 'selected=."selected"';
                            }
                        }
                        $return .= '>' . $row[$field] . '</option>';
                    }
                endforeach;
            } else {
                $all = $from;
                $return .= '<option value="">Choose one</option>';
                foreach ($all as $o => $row):
                    if ($type == 'add') {
                        $return .= '<option value="' . $o . '">';
                        if ($condition == '') {
                            $return .= $row;
                        } else {
                            $return .= $this->Crud_model->get_type_name_by_id($condition, $row, $c_match);
                        }
                        $return .= '</option>';
                    } else if ($type == 'edit') {
                        $return .= '<option value="' . $o . '" ';
                        if ($row == $e_match) {
                            $return .= 'selected=."selected"';
                        }
                        $return .= '>';

                        if ($condition == '') {
                            $return .= $row;
                        } else {
                            $return .= $this->Crud_model->get_type_name_by_id($condition, $row, $c_match);
                        }

                        $return .= '</option>';
                    }
                endforeach;
            }
            $return .= '</select>';
            return $return;
        }

        //CHECK IF PRODUCT EXISTS IN TABLE
        function exists_in_table($table, $field, $val) {
            $ret = '';
            $res = $this->db->get($table)->result_array();
            foreach ($res as $row) {
                if ($row[$field] == $val) {
                    $ret = $row[$table . '_id'];
                }
            }
            if ($ret == '') {
                return false;
            } else {
                return $ret;
            }
        }

        //FORM FIELDS
        function form_fields($array) {
            $return = '';
            foreach ($array as $row) {
                $return .= '<div class="form-group">';
                $return .= '    <label class="col-sm-4 control-label" for="demo-hor-inputpass">' . $row . '</label>';
                $return .= '    <div class="col-sm-6">';
                $return .= '       <input type="text" name="ad_field_values[]" id="demo-hor-inputpass" class="form-control">';
                $return .= '       <input type="hidden" name="ad_field_names[]" value="' . $row . '" >';
                $return .= '    </div>';
                $return .= '</div>';
            }
            return $return;
        }

        // PAGINATION
        function pagination($type, $per, $link, $f_o, $f_c, $other, $current, $seg = '3', $ord = 'desc') {
            $t = explode('#', $other);
            $t_o = $t[0];
            $t_c = $t[1];
            $c = explode('#', $current);
            $c_o = $c[0];
            $c_c = $c[1];

            $this->load->library('pagination');
            $this->db->order_by($type . '_id', $ord);
            $config['total_rows'] = $this->db->count_all_results($type);
            $config['base_url'] = base_url() . $link;
            $config['per_page'] = $per;
            $config['uri_segment'] = $seg;

            $config['first_link'] = '&laquo;';
            $config['first_tag_open'] = $t_o;
            $config['first_tag_close'] = $t_c;

            $config['last_link'] = '&raquo;';
            $config['last_tag_open'] = $t_o;
            $config['last_tag_close'] = $t_c;

            $config['prev_link'] = '&lsaquo;';
            $config['prev_tag_open'] = $t_o;
            $config['prev_tag_close'] = $t_c;

            $config['next_link'] = '&rsaquo;';
            $config['next_tag_open'] = $t_o;
            $config['next_tag_close'] = $t_c;

            $config['full_tag_open'] = $f_o;
            $config['full_tag_close'] = $f_c;

            $config['cur_tag_open'] = $c_o;
            $config['cur_tag_close'] = $c_c;

            $config['num_tag_open'] = $t_o;
            $config['num_tag_close'] = $t_c;
            $this->pagination->initialize($config);

            $this->db->order_by($type . '_id', $ord);
            return $this->db->get($type, $config['per_page'], $this->uri->segment($seg))->result_array();
        }

        //GETTING IDS OF A TABLE FILTERING SPECIFIC TYPE OF VALUE RANGE
        function ids_between_values($table, $value_type, $up_val, $down_val) {
            $this->db->order_by($table . '_id', 'desc');
            return $this->db->get_where($table, array($value_type . ' <=' => $up_val, $value_type . ' >=' => $down_val))->result_array();
        }

        //GETTING BOOTSTRAP COLUMN VALUE
        function boot($num) {
            return (12 / $num);
        }

        //GETTING LOGO BY TYPE
        function logo($type) {
            $logo = $this->db->get_where('ui_settings', array('type' => $type))->row()->value;
            return base_url() . 'uploads/logo_image/logo_' . $logo . '.png';
        }

        //GETTING ADMIN PERMISSION
        function admin_permission($codename) {

            if ($this->session->userdata('admin_login') != 'yes') {
                return false;
            }

            $admin_id = $this->session->userdata('admin_id');
            $admin = $this->db->get_where('admin', array('admin_id' => $admin_id))->row();
            $permission = $this->db->get_where('permission', array('codename' => $codename))->row()->permission_id;
            if ($admin->role == 1) {
                return true;
            } else {
                $role = $admin->role;
                $role_permissions = json_decode($this->Crud_model->get_type_name_by_id('role', $role, 'permission'));
                if (in_array($permission, $role_permissions)) {
                    return true;
                } else {
                    return false;
                }
            }

            return true;
        }

        //ADDING NEWS TO READLATER-LIST
        function add_readlater($id) {
            $user = $this->session->userdata('user_id');
            if ($this->get_type_name_by_id('user', $user, 'readlater') !== '[]') {
                $readlater = json_decode($this->get_type_name_by_id('user', $user, 'readlater'));
            } else {
                $readlater = array();
            }
            if ($this->is_added_already($id) == 'no') {
                array_push($readlater, $id);
                $this->db->where('user_id', $user);
                $this->db->update('user', array(
                    'readlater' => json_encode($readlater)
                ));
                return 'added';
            } else {
                return 'already';
            }
        }

        //REMOVING NEWS FROM READLATER-LIST
        function remove_readlater($id) {
            $user = $this->session->userdata('user_id');
            if ($this->get_type_name_by_id('user', $user, 'readlater') !== '[]') {
                $readlater = json_decode($this->get_type_name_by_id('user', $user, 'readlater'));
                $readlater_new = array();
                foreach ($readlater as $row) {
                    if ($row !== $id) {
                        $readlater_new[] = $row;
                    }
                }
            } else {
                $readlater = array();
            }
            $this->db->where('user_id', $user);
            $this->db->update('user', array(
                'readlater' => json_encode($readlater_new)
            ));
        }

        //NUMBER OF READLATER NEWS
        function readlater_num() {
            $user = $this->session->userdata('user_id');
            if ($this->get_type_name_by_id('user', $user, 'readlater') !== '[]') {
                $rl = json_decode($this->get_type_name_by_id('user', $user, 'readlater'));
                $this->db->where('status', 'published');
                $this->db->where_in('news_id',$rl);
                $rln = $this->db->get('news')->num_rows();
                return $rln;
            } else {
                return 0;
            }
        }

        //IF NEWS IS ADDED TO CURRENT USER'S READLATER-LIST
        function is_added_already($id) {
            if ($this->session->userdata('user_login') == 'yes') {
                $user = $this->session->userdata('user_id');
                if ($this->get_type_name_by_id('user', $user, 'readlater') !== '[]') {
                    $readlater = json_decode($this->get_type_name_by_id('user', $user, 'readlater'));
                } else {
                    $readlater = array(
                        '0'
                    );
                }
                if (in_array($id, $readlater)) {
                    return 'yes';
                } else {
                    return 'no';
                }
            } else {
                return 'no';
            }
        }

        //GETTING IP DATA OF PEOPLE BROWING THE SYSTEM
        function ip_data() {
            $this->session->set_userdata('last_activity', time());
            $user_data = $this->session->userdata('surfer_info');
            //$ip = $_SERVER['REMOTE_ADDR'];
            $ip = '118.179.165.41';
            if (!$user_data) {
                //if($_SERVER['HTTP_HOST'] !== 'localhost'){
                $ip_data = file_get_contents("http://ip-api.com/json/" . $ip);
                $this->session->set_userdata('surfer_info', $ip_data);
                //}
            }
        }

        function second_to_tym($details) {
            $return = '';
            if ($details == 'unlimited') {
                $return = $details;
            } else if ($details % 86400 == 0) {
                if ($details % 2592000 == 0) {
                    if ($details % 31104000 == 0) {
                        $return = $details / 31104000;
                        $return .= translate(' years');
                    } else {
                        $return = $details / 2592000;
                        $return .= translate(' months');
                    }
                } else if ($details % 31104000 == 0) {
                    $return = $details / 31104000;
                    $return .= translate(' years');
                } else {
                    $return = $details / 86400;
                    $return .= translate(' days');
                }
            } else {
                $return = 'error';
            }
            return $return;
        }

        function seo_stat($type = '') {
            try {
                $url = base_url();
                $seostats = new \SEOstats\SEOstats;
                if ($seostats->setUrl($url)) {

                    if ($type == 'facebook') {
                        return SEOstats\Services\Social::getFacebookShares();
                    } elseif ($type == 'gplus') {
                        return SEOstats\Services\Social::getGooglePlusShares();
                    } elseif ($type == 'twitter') {
                        return SEOstats\Services\Social::getTwitterShares();
                    } elseif ($type == 'linkedin') {
                        return SEOstats\Services\Social::getLinkedInShares();
                    } elseif ($type == 'pinterest') {
                        return SEOstats\Services\Social::getPinterestShares();
                    } elseif ($type == 'alexa_global') {
                        return SEOstats\Services\Alexa::getGlobalRank();
                    } elseif ($type == 'alexa_country') {
                        return SEOstats\Services\Alexa::getCountryRank();
                    } elseif ($type == 'alexa_bounce') {
                        return SEOstats\Services\Alexa::getTrafficGraph(5);
                    } elseif ($type == 'alexa_time') {
                        return SEOstats\Services\Alexa::getTrafficGraph(4);
                    } elseif ($type == 'alexa_traffic') {
                        return SEOstats\Services\Alexa::getTrafficGraph(1);
                    } elseif ($type == 'alexa_pageviews') {
                        return SEOstats\Services\Alexa::getTrafficGraph(2);
                    } elseif ($type == 'google_siteindex') {
                        return SEOstats\Services\Google::getSiteindexTotal();
                    } elseif ($type == 'google_back') {
                        return SEOstats\Services\Google::getBacklinksTotal();
                    } elseif ($type == 'search_graph_1') {
                        return SEOstats\Services\SemRush::getDomainGraph(1);
                    } elseif ($type == 'search_graph_2') {
                        return SEOstats\Services\SemRush::getDomainGraph(2);
                    }
                }
            } catch (\Exception $e) {
                echo 'Caught SEOstatsException: ' . $e->getMessage();
            }
        }

        function get_sidebar($page) {
            $page_data['page'] = $page;
            return ($this->load->view('front/sidebar', $page_data, true));
        }

        function get_sidebar_blog() {
            $page_data[] = '';
            return ($this->load->view('front/sidebar_blog', $page_data, true));
        }

        function clean_garbage($time) {
            $a = scandir('uploads/product_image/temp/');
            $b = scandir('uploads/product_image/temp/thumbnail/');
            foreach ($a as $row) {
                $elem = 'uploads/product_image/temp/' . $row;
                if (is_file($elem)) {
                    if ((time() - filemtime($elem)) > $time) {
                        unlink($elem);
                    }
                }
            }
            foreach ($b as $row) {
                $elem = 'uploads/product_image/temp/thumbnail/' . $row;
                if (is_file($elem)) {
                    if ((time() - filemtime($elem)) > $time) {
                        unlink($elem);
                    }
                }
            }
        }

        function ticket_unread_messages($ticket_id, $user_type) {
            $count = 0;
            if ($ticket_id !== 'all') {
                $msgs = $this->db->get_where('ticket_message', array('ticket_id' => $ticket_id))->result_array();
            } else if ($ticket_id == 'all') {
                $msgs = $this->db->get('ticket_message')->result_array();
            }
            foreach ($msgs as $row) {
                $status = json_decode($row['view_status'], true);
                foreach ($status as $type => $row1) {
                    if ($type == $user_type . '_show') {
                        if ($row1 == 'no') {
                            $count++;
                        }
                    }
                }
            }
            return $count;
        }

        function ticket_message_viewed($ticket_id, $user_type) {

            $msgs = $this->db->get_where('ticket_message', array('ticket_id' => $ticket_id))->result_array();
            foreach ($msgs as $row) {
                $status = json_decode($row['view_status'], true);
                $new_status = array();
                foreach ($status as $type => $row1) {
                    if ($type == $user_type . '_show') {
                        $new_status[$type] = 'ok';
                    } else {
                        $new_status[$type] = $row1;
                    }
                }
                $view_status = json_encode($new_status);
                $this->db->where('ticket_message_id', $row['ticket_message_id']);
                $this->db->update('ticket_message', array(
                    'view_status' => $view_status
                ));
            }
        }

        function package_expiration_check(){
            $cron_time   = $this->db->get_where('general_settings', array('type' => 'cron_time'))->row()->value;
            $cron_gap   = $this->db->get_where('general_settings', array('type' => 'cron_gap'))->row()->value;

            if(($cron_time+$cron_gap) < time()){
                $non_expired_package = $this->db->get_where('advertisement_payment',array('payment_status' => 'paid','expire' => 'no'))->result_array();
                foreach($non_expired_package as $row){
                    if($row['expire_timestamp'] < time()){
                        $data['expire']             = 'yes';
                        $data['expire_timestamp']   = 0;
                        $this->db->where('advertisement_payment_id',$row['advertisement_payment_id']);
                        $this->db->update('advertisement_payment',$data);

                        $data1['availability']      = 'available';
                        $data1['user_id']           = '';
                        $data1['user_status']       = '';
                        $data1['approval']          = '';

                        $this->db->where('advertisement_id',$row['advertisement_id']);
                        $this->db->update('advertisement',$data1);
                    }
                }

                $this->db->where('type', "cron_time");
                $this->db->update('general_settings', array('value' => time()));
            }
        }

		function blog_counter($type,$blogger,$thing){
			$blogs = $this->db->get_where($type,array($type.'_uploader_id'=>$blogger));
			if($thing == 'views'){
				$return = 0;
				foreach($blogs->result_array() as $row){
					$return += $row['view_count'];
				}
			} else if($thing == 'count'){
				$return = $blogs->num_rows();
			}
			return $return;
		}

        function file_up_from_urls($urls, $type, $id,$no_thumb = '')
        {
            $ib = 1;
            $img_features = array();
            foreach ($urls as $url) {
                $ext = '.'.pathinfo($url, PATHINFO_EXTENSION);
                $ib = $this->file_exist_ret2($type, $id, $ib,$ext);
                $img = $type.'_' . $id . '_' . $ib . $ext;
                $img_thumb = $type.'_' . $id . '_' . $ib . '_thumb' . $ext;
                $img_features[] = array('index' => $ib-1, 'img' => $img, 'thumb' => $img_thumb);
                file_put_contents('uploads/' . $type . '_image/' . $type . '_' . $id . '_' . $ib . $ext, file_get_contents($url));
                if ($no_thumb == '') {
                    $this->Crud_model->img_thumb($type, $id . '_' . $ib, pathinfo($url, PATHINFO_EXTENSION));
                }
            }
            $data1['img_features'] = json_encode($img_features);
            $this->db->where('news_id', $id);
            $this->db->update('news', $data1);
        }

        function file_exist_ret2($type, $id, $ib, $ext = '.jpg')
        {
            if (file_exists(FCPATH . 'uploads/' . $type . '_image/' . $type . '_' . $id . '_' . $ib . $ext)) {
                $ib = $ib + 1;
                $ib = $this->file_exist_ret2($type, $id, $ib, $ext);
                return $ib;
            } else {
                return $ib;
            }
        }

    }
