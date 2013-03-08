<?php
include 'abstract/cmsController.php';

class Main extends CmsController
{
    function __construct()
    {
        parent::__construct();
        $this->_template = "cms/main_view";

        $this->_data['page_title'] = DEFAULT_PAGE_TITLE;
        $this->_data['page_description'] = DEFAULT_PAGE_DESCRIPTION;
        if( isset ($this->_local_css) ) $this->_data['local_css'] = $this->_local_css;
        if( isset ($this->_local_js) ) $this->_data['local_js'] = $this->_local_js;
    }

    function index()
    {
        $this->load->view('cms/inc/header', $this->_data);
        $this->load->view('cms/inc/top', $this->_data);
        $this->load->view('cms/inc/menu', $this->_data);
        $this->load->view($this->_template, $this->_data);
        $this->load->view('cms/inc/footer', $this->_data);
    }

}