<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CmsController extends CI_Controller
{
    var $_data;
    var $_local_css;
    var $_local_js;
    var $_template;
    var $_Tsection;

    function __construct()
    {
	parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
	$this->_data["_Tsection"] = $this->uri->segment(1);

        if ($this->session->userdata('session_userid') == "") {
            redirect(base_url() . 'cms/auth/', 'refresh');
        }
    }
}