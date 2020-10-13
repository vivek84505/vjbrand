<?php
    if (!defined('BASEPATH'))
        exit('No direct script access allowed');

    class Email_model extends CI_Model {
        /*
         * 	Developed by    : Active IT zone
         * 	Date	        : 14 July, 2015
         * 	Active Supershop eCommerce CMS
         * 	http://codecanyon.net/user/activeitezone
         *  Last Modified   : 18 January, 2017
         */

        function __construct() {
            parent::__construct();
        }

        function password_reset_email($account_type = '', $id = '', $pass = '') {
            $this->load->database();
            $from_name = $this->db->get_where('general_settings', array('type' => 'system_name'))->row()->value;
            $protocol = $this->db->get_where('general_settings', array('type' => 'mail_status'))->row()->value;
            if ($protocol == 'smtp') {
                $from = $this->db->get_where('general_settings', array('type' => 'smtp_user'))->row()->value;
            } else if ($protocol == 'mail') {
                $from = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
            }

            $query = $this->db->get_where($account_type, array($account_type . '_id' => $id));

            if ($query->num_rows() > 0) {

                $sub = $this->db->get_where('email_template', array('email_template_id' => 1))->row()->subject;
                $to = $query->row()->email;
                if ($account_type == 'user') {
                    $to_name = $query->row()->firstname . ' ' . $query->row()->lastname;
                } else {
                    $to_name = $query->row()->name;
                }
                $email_body = $this->db->get_where('email_template', array('email_template_id' => 1))->row()->body;
                $email_body = str_replace('[[to]]', $to_name, $email_body);
                $email_body = str_replace('[[account_type]]', $account_type, $email_body);
                $email_body = str_replace('[[password]]', $pass, $email_body);
                $email_body = str_replace('[[from]]', $from_name, $email_body);

                $background = $this->db->get_where('ui_settings',array('type' => 'email_theme_style'))->row()->value;
                if($background !== 'style_1'){
                        $final_email = $this->db->get_where('ui_settings',array('type' => 'email_theme_'.$background))->row()->value;
                        $final_email = str_replace('[[body]]',$email_body,$final_email);
                        $send_mail  = $this->do_email($from,$from_name,$to, $sub, $final_email);
                }else{
                        $send_mail  = $this->do_email($from,$from_name,$to, $sub, $email_body);
                }
                //$send_mail = $this->do_email($from, $from_name, $to, $sub, $email_body);
                return $send_mail;
            } else {
                return false;
            }
        }

        function status_email($account_type = '', $id = '') {
            $this->load->database();
            $from_name = $this->db->get_where('general_settings', array('type' => 'system_name'))->row()->value;
            $protocol = $this->db->get_where('general_settings', array('type' => 'mail_status'))->row()->value;
            if ($protocol == 'smtp') {
                $from = $this->db->get_where('general_settings', array('type' => 'smtp_user'))->row()->value;
            } else if ($protocol == 'mail') {
                $from = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
            }

            $query = $this->db->get_where($account_type, array($account_type . '_id' => $id));

            if ($query->num_rows() > 0) {
                $sub = $this->db->get_where('email_template', array('email_template_id' => 2))->row()->subject;
                $to = $query->row()->email;
                if ($account_type == 'user') {
                    $to_name = $query->row()->firstname . ' ' . $query->row()->lastname;
                } else {
                    $to_name = $query->row()->name;
                }
                if ($query->row()->status == 'approved') {
                    $status = "Approved";
                } else {
                    $status = "Postponed";
                }
                $email_body = $this->db->get_where('email_template', array('email_template_id' => 2))->row()->body;
                $email_body = str_replace('[[to]]', $to_name, $email_body);
                $email_body = str_replace('[[account_type]]', $account_type, $email_body);
                $email_body = str_replace('[[email]]', $to, $email_body);
                $email_body = str_replace('[[status]]', $status, $email_body);
                $email_body = str_replace('[[from]]', $from_name, $email_body);

                $background = $this->db->get_where('ui_settings',array('type' => 'email_theme_style'))->row()->value;
                if($background !== 'style_1'){
                        $final_email = $this->db->get_where('ui_settings',array('type' => 'email_theme_'.$background))->row()->value;
                        $final_email = str_replace('[[body]]',$email_body,$final_email);
                        $send_mail  = $this->do_email($from,$from_name,$to, $sub, $final_email);
                }else{
                        $send_mail  = $this->do_email($from,$from_name,$to, $sub, $email_body);
                }
                //$send_mail = $this->do_email($from, $from_name, $to, $sub, $email_body);
                return $send_mail;
            } else {
                return false;
            }
        }

        function account_opening($account_type = '', $email = '', $pass = '') {
            $this->load->database();
            $from_name = $this->db->get_where('general_settings', array('type' => 'system_name'))->row()->value;
            $protocol = $this->db->get_where('general_settings', array('type' => 'mail_status'))->row()->value;
            if ($protocol == 'smtp') {
                $from = $this->db->get_where('general_settings', array('type' => 'smtp_user'))->row()->value;
            } else if ($protocol == 'mail') {
                $from = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
            }

            $to = $email;
            $query = $this->db->get_where($account_type, array('email' => $email));

            if ($query->num_rows() > 0) {
                $sub = $this->db->get_where('email_template', array('email_template_id' => 4))->row()->subject;
                if ($account_type == 'admin') {
                    $password = $pass;
                    $email_body = "Thanks for your registration in : " . $from_name . "<br />";
                    $email_body .= "Your account type is : " . $account_type . "<br />";
                    $email_body .= "Your password is : " . $pass . "<br />";
                    $email_body .= "login here: <a href='" . base_url() . "admin/'>" . base_url() . "admin</a>";
                }
                if ($account_type == 'user') {
                    $to_name = $query->row()->firstname . ' ' . $query->row()->lastname;
                    $url = "<a href='" . base_url() . "home/login_set/login'>" . base_url() . "home/login_set/login</a>";

                    $email_body = "Hello " . $to_name . ",<br />";
                    $email_body .= "Thanks for your registration in : " . $from_name . "<br />";
                    $email_body .= "Your account type is : " . $account_type . "<br />";
                    $email_body .= "Your email is : " . $to . "<br />";
                    $email_body .= "Your password is : " . $pass . "<br />";
                    $email_body .= "login here: " . $url;
                }
                $background = $this->db->get_where('ui_settings',array('type' => 'email_theme_style'))->row()->value;
                if($background !== 'style_1'){
                        $final_email = $this->db->get_where('ui_settings',array('type' => 'email_theme_'.$background))->row()->value;
                        $final_email = str_replace('[[body]]',$email_body,$final_email);
                        $send_mail  = $this->do_email($from,$from_name,$to, $sub, $final_email);
                }else{
                        $send_mail  = $this->do_email($from,$from_name,$to, $sub, $email_body);
                }
                //$send_mail = $this->do_email($from, $from_name, $to, $sub, $email_body);
                return $send_mail;
            } else {
                return false;
            }
        }

        function newsletter($title = '', $text = '', $email = '', $from = '') {
            $from_name = $this->db->get_where('general_settings', array('type' => 'system_name'))->row()->value;
            $this->do_email($from, $from_name, $email, $title, $text);
        }

        function purchase_packages_for_advertisement($advertisement_payment_id = '')
        {
            $this->load->database();
            $from_name = $this->db->get_where('general_settings', array('type' => 'system_name'))->row()->value;
            $protocol = $this->db->get_where('general_settings', array('type' => 'mail_status'))->row()->value;
            if ($protocol == 'smtp') {
                $from = $this->db->get_where('general_settings', array('type' => 'smtp_user'))->row()->value;
            } else if ($protocol == 'mail') {
                $from = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
            }

                $to = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;

                $sub = $this->db->get_where('email_template', array('email_template_id' => 5))->row()->subject;
                $advertisement_payment_data = $this->db->get_where('advertisement_payment',array('advertisement_payment_id'=>$advertisement_payment_id))->row();
                $user_id = $advertisement_payment_data->user_id;
                $user_data = $this->db->get_where('user',array('user_id'=>$user_id))->row();
                $user_name = $user_data->firstname . ' ' . $user_data->lastname;
                $email = $user_data->email;

                $ad_details = $this->db->get_where('advertisement', array('advertisement_id' => $advertisement_payment_data->advertisement_id))->row();
                $page_name = $this->Crud_model->get_type_name_by_id('ad_page', $ad_details->page_id);
                $position = $ad_details->position;
                $amount = $advertisement_payment_data->amount;
                $payment_method = $advertisement_payment_data->payment_type;
                $ad_package = json_decode($ad_details->package);
                foreach($ad_package as $package){
                    if($package->index == $advertisement_payment_data->package_id)
                    {
                       $package_name = $package->name;
                    }
                }

                $email_body = $this->db->get_where('email_template', array('email_template_id' => 5))->row()->body;
                $email_body = str_replace('[[to]]', $from_name, $email_body);
                $email_body = str_replace('[[user_name]]', $user_name, $email_body);
                $email_body = str_replace('[[email]]', $email, $email_body);
                $email_body = str_replace('[[page_name]]', $page_name, $email_body);
                $email_body = str_replace('[[position]]', $position, $email_body);
                $email_body = str_replace('[[amount]]', $amount, $email_body);
                $email_body = str_replace('[[payment_method]]', $payment_method, $email_body);
                $email_body = str_replace('[[package_name]]', $package_name, $email_body);

                $send_mail  = $this->do_email($from,$from_name,$to, $sub, $email_body);
                return $send_mail;

        }

        /*         * *custom email sender*** */

        function do_email($from = '', $from_name = '', $to = '', $sub = '', $msg = '') {
            $this->load->library('email');
            $this->email->set_newline("\r\n");
            $this->email->from($from, $from_name);
            $this->email->to($to);
            $this->email->subject($sub);
            $this->email->message($msg);

            if(!demo()){
                if ($this->email->send()) {
                    return true;
                } else {
                    return false;
                }
            }
            else{
                return true;
            }

            //echo $this->email->print_debugger();
        }

    }
