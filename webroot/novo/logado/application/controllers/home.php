<?php
include 'abstractController.php';

class Home extends AbstractController
{

	function __construct()
	{
		parent::__construct();
		$this->_local_css = "home.css";
		$this->_local_js = "home.js";
		$this->_template = "home_view";

		if( isset ($this->_local_css) ) $this->_data['local_css'] = $this->_local_css;
		if( isset ($this->_local_js) ) $this->_data['local_js'] = $this->_local_js;
	}
	
	public function pdf()
	{
		$this->_local_js = "pdf.js";
		$this->_template = "pdf_view";
		if( isset ($this->_local_css) ) $this->_data['local_css'] = $this->_local_css;
		if( isset ($this->_local_js) ) $this->_data['local_js'] = $this->_local_js;
		$this->index();
	}
	
	public function videos()
	{
		$this->_local_js = "videos.js";
		$this->_template = "videos_view";
		if( isset ($this->_local_css) ) $this->_data['local_css'] = $this->_local_css;
		if( isset ($this->_local_js) ) $this->_data['local_js'] = $this->_local_js;
		$this->index();
	}
	
	public function fotos()
	{
		$this->_local_js = "fotos.js";
		$this->_template = "fotos_view";
		if( isset ($this->_local_css) ) $this->_data['local_css'] = $this->_local_css;
		if( isset ($this->_local_js) ) $this->_data['local_js'] = $this->_local_js;
		$this->index();
	}
	
	public function recados()
	{
		$this->_local_js = "recados.js";
		$this->_template = "recados_view";
		if( isset ($this->_local_css) ) $this->_data['local_css'] = $this->_local_css;
		if( isset ($this->_local_js) ) $this->_data['local_js'] = $this->_local_js;
		$this->index();
	}
	
}