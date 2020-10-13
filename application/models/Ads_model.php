<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');



class Ads_model extends CI_Model
{


    /*
     *  Developed by: Active IT zone
     *  Date    : January, 2017
     */

    function __construct()
    {
        parent::__construct();
    }
    /*
     * Set the payment gateway.
     * both parameters are the column of general_settings table of database
     */
    function payment_gateway_activation($type='' , $value=''){
        if($type!=='') {
            $data = ($value == 'true' ? 'ok' : 'no');
            $this->db->where('type', $type);
            $this->db->update('business_settings', array(
                'value' => $data
            ));
        }
    }
    function is_payment_gateway_activate($type=''){
        if($type!==''){
            $data = $this->db->get_where('business_settings', array('type' => $type))->row()->value;
            return $data;
        }
    }

    function get_payment_gateway_value($type=''){
        if($type!==''){
            $data = $this->db->get_where('business_settings', array('type' => $type))->row()->value;
            return $data;
        }
    }

    function set_payment_method_value($type = ''){
        if($type !== '') {
            $this->db->where('type', $type);
            $this->db->update('business_settings', array(
                'value' => $this->input->post($type)
            ));
        }
    }
    function update_ad_status($type='',$status=''){
        if($type!== ''){
            if($status == 'true'){
                $data['status'] = 'ok';
            }else{
                $data['status'] = 'no';
            }
            $this->db->where('type', $type);
            $this->db->update('advertisement',$data);
        }
    }

    function show_ad_element($type=''){
        if($type !== ''){
            $data['ad_data'] = $this->db->get_where('advertisement',array('type' => $type))->row();
            $this->load->view('back/admin/ad_elements',$data);
        }
    }

    function show_google_adsense_element($type=''){
        if($type !== ''){
            $data['ad_data'] = $this->db->get_where('advertisement',array('type' => $type))->row();
            $this->load->view('back/admin/google_adsense_element',$data);
        }
    }

    function getPageNameByID($id=''){
        if($id!== ''){
            return $this->db->get_where('ad_page',array('ad_page_id' => $id))->row()->name;
        }
    }

    function update_package($id='',$index=''){
        $package_name = $this->input->post('name');
        $price        = $this->input->post('price');
        if($this->input->post('activation') == 'on'){
            $activate     = 'ok';
        } else {
            $activate  = 'no';
        }
        $package = json_decode($this->db->get_where('advertisement',array('advertisement_id' => $id))->row()->package,true);
        $package_list = array();
        if(!empty($package)){
            //$package = json_decode($package,true);
            foreach($package as $list){
                if($list['index'] == $index){
                    if($_FILES['seal']['error'] == UPLOAD_ERR_NO_FILE){
                        $seal   = $list['seal'];
                    }else{
                        $path         = $_FILES['seal']['name'];
                        $ext          = pathinfo($path,PATHINFO_EXTENSION);
                        $seal         = 'seal_'.$id.'_'.$index.'.'.$ext;
                        move_uploaded_file($_FILES['seal']['tmp_name'], 'uploads/default_banner/'.$seal);
                    }
                    $package_list[] = array(
                       'index'  =>  $index,
                       'name'   =>  $package_name,
                       'price'  =>  $price,
                       'seal'   =>  $seal,
                       'activation' => $activate
                    );
                }else{
                    $package_list[] = array(
                       'index'  =>  $list['index'],
                       'name'   =>  $list['name'],
                       'price'  =>  $list['price'],
                       'seal'   =>  $list['seal'],
                       'activation' => $list['activation']
                    );
                }
            }
        } else {
            for($i=1; $i<5; $i++){
                if($i == $index){
                    if($_FILES['seal']['error'] == UPLOAD_ERR_NO_FILE){
                        $seal   = '';
                    }else{
                        $path         = $_FILES['seal']['name'];
                        $ext          = pathinfo($path,PATHINFO_EXTENSION);
                        $seal         = 'seal_'.$id.'_'.$index.'.'.$ext;
                        move_uploaded_file($_FILES['seal']['tmp_name'], 'uploads/default_banner/'.$seal);
                    }
                   $package_list[] = array(
                       'index'  =>  $i,
                       'name'   =>  $package_name,
                       'price'  =>  $price,
                       'seal'   =>  $seal,
                       'activation' => $activate
                   );
                }else{
                    $package_list[] = array(
                       'index'  =>  $i,
                       'name'   =>  '',
                       'price'  =>  '',
                       'seal'   =>  '',
                       'activation'=> ''
                    );
                }
            }
        }
        var_dump($package_list);
        $data['package']    = json_encode($package_list);
        $this->db->where('advertisement_id',$id);
        $this->db->update('advertisement',$data);
    }

    function package_data($id='',$index=''){
        $package = $this->db->get_where('advertisement',array('advertisement_id' => $id))->row()->package;
        $package = json_decode($package,true);
        if(!empty($package)){
            foreach($package as $row){
                if($row['index']== $index){
                    return $row;
                }
            }
        }
        else{
            return null;
        }
    }
}
