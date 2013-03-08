<?php
include 'abstract/cmsController.php';

class Fotos extends CmsController
{
    function __construct()
    {
        parent::__construct();
        $this->_local_js = "fotos.js";
        $this->_local_css = "fotos.css";

        $this->_data['page_title'] = DEFAULT_PAGE_TITLE;
        $this->_data['page_description'] = DEFAULT_PAGE_DESCRIPTION;
        if( isset ($this->_local_css) ) $this->_data['local_css'] = $this->_local_css;
        if( isset ($this->_local_js) ) $this->_data['local_js'] = $this->_local_js;

        $this->load->helper('url');
        $this->load->model('CmsFotos_model');
    }

    function index()
    {
        $this->load->view('cms/inc/header', $this->_data);
        $this->load->view('cms/inc/top', $this->_data);
        $this->load->view('cms/inc/menu', $this->_data);
        $this->load->view('cms/pages/fotos/fotos.php', $this->_data);
        $this->load->view('cms/inc/footer', $this->_data);
    }

}