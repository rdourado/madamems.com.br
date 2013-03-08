<?php
include 'abstract/authController.php';

class Auth extends AuthController
{
    function __construct()
    {
        parent::__construct();
        $this->_local_css = "cms/auth.css";
        $this->_local_js = "cms/auth.js";
        $this->_template = "cms/auth_view";

        $this->_data['page_title'] = DEFAULT_PAGE_TITLE;
        $this->_data['page_description'] = DEFAULT_PAGE_DESCRIPTION;
        if( isset ($this->_local_css) ) $this->_data['local_css'] = $this->_local_css;
        if( isset ($this->_local_js) ) $this->_data['local_js'] = $this->_local_js;
    }

    function index()
    {
        $this->load->view('cms/inc/auth_header', $this->_data);
        $this->load->view($this->_template, $this->_data);
        $this->load->view('cms/inc/auth_footer', $this->_data);
    }

}