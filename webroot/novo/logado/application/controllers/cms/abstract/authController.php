<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AuthController extends CI_Controller
{
    var $_data;
    var $_local_css;
    var $_local_js;
    var $_template;

    function __construct()
    {
	parent::__construct();
    }

    function index()
    {
        $this->load->view($this->_template, $this->_data);
    }
}