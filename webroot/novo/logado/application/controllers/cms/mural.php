<?php
include 'abstract/cmsController.php';

class Mural extends CmsController
{
    function __construct()
    {
        parent::__construct();
        $this->_local_js = "mural.js";
        $this->_local_css = "mural.css";

        $this->_data['page_title'] = DEFAULT_PAGE_TITLE;
        $this->_data['page_description'] = DEFAULT_PAGE_DESCRIPTION;
        if( isset ($this->_local_css) ) $this->_data['local_css'] = $this->_local_css;
        if( isset ($this->_local_js) ) $this->_data['local_js'] = $this->_local_js;

        $this->load->helper('url');
        $this->load->model('CmsMural_model');
    }

    function aprovadas()
    {
	$this->_data['title'] = "Mensagens aprovadas";
	$this->_data['status'] = "1";
        $this->_data['phrases'] = $this->CmsMural_model->getList(1);
        $this->load->view('cms/inc/header', $this->_data);
        $this->load->view('cms/inc/top', $this->_data);
        $this->load->view('cms/inc/menu', $this->_data);
        $this->load->view('cms/pages/mural/mural_list.php', $this->_data);
        $this->load->view('cms/inc/footer', $this->_data);
    }
    
    function reprovadas()
    {
	$this->_data['title'] = "Mensagens reprovadas";    
	$this->_data['status'] = "2";
        $this->_data['phrases'] = $this->CmsMural_model->getList(2);
        $this->load->view('cms/inc/header', $this->_data);
        $this->load->view('cms/inc/top', $this->_data);
        $this->load->view('cms/inc/menu', $this->_data);
        $this->load->view('cms/pages/mural/mural_list.php', $this->_data);
        $this->load->view('cms/inc/footer', $this->_data);
    }
    
    function novas()
    {
	$this->_data['title'] = "Novas mensagens";      
	$this->_data['status'] = "0";
        $this->_data['phrases'] = $this->CmsMural_model->getList(0);
        $this->load->view('cms/inc/header', $this->_data);
        $this->load->view('cms/inc/top', $this->_data);
        $this->load->view('cms/inc/menu', $this->_data);
        $this->load->view('cms/pages/mural/mural_list.php', $this->_data);
        $this->load->view('cms/inc/footer', $this->_data);
    }

}