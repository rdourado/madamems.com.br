<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AbstractController extends CI_Controller
{
	var $_data;
	var $_local_css;
	var $_local_js;
	var $_template;

	function __construct()
	{
		parent::__construct();
		$this->_data['page_title'] = DEFAULT_PAGE_TITLE;
		$this->_data['page_description'] = DEFAULT_PAGE_DESCRIPTION;
		if(!$this->session->userdata("session_name"))
		{
			redirect("../../index.htm");
		}
	}

	/*
	* Default index page. Calls header, selected content and footer.
	*
	*/
	function index()
	{
		$this->load->view('inc/header', $this->_data);
		$this->load->view('inc/column', $this->_data);
		$this->load->view($this->_template, $this->_data);
		$this->load->view('inc/footer', $this->_data);
	}

}