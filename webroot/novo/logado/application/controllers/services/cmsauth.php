<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CMSAuth extends CI_Controller
{
    function __construct()
    {
	parent::__construct();
        $this->load->library('session');
        $this->load->model('CmsAuth_model');
    }

    public function login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $query = $this->CmsAuth_model->login($username, $password);
        if ($query->num_rows() == 0) {
            echo false;
        } else {
            $result = $query->result_array();
            $this->session->set_userdata('session_userid', $result[0]['id']);
            $this->session->set_userdata('session_name', $result[0]['name']);
            $this->session->set_userdata('session_username', $result[0]['username']);
            $this->CmsAuth_model->updateLoginInformation($result[0]['id']);
            echo "cms/main/";
        }        
    }

    public function logout()
    {
        $this->session->set_userdata('session_userid', '');
        $this->session->set_userdata('session_name', '');
        $this->session->set_userdata('session_username', '');
        echo "logged out";
    }

}