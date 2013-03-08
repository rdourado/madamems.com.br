<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Media extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('Media_model');
	}

	public function getByType($type, $order_by, $order)
	{
		echo json_encode($this->Media_model->getList($type, $order_by, $order));
	}
	
	public function getScraps()
	{
		echo json_encode($this->Media_model->getScraps());
	}
	
	public function addMedia()
	{
		$type = $this->input->post("type", TRUE);
		$title = $this->input->post("title", TRUE);
		$content = $this->input->post("filename", TRUE);
		$id = $this->session->userdata("session_userid");
		echo json_encode($this->Media_model->add($type, $title, $content, $id));
	}
	
	public function addScrap()
	{
		$message = $this->input->post("message", TRUE);
		$id = $this->session->userdata("session_userid");
		echo json_encode($this->Media_model->addScrap($message, $id));
	}
	
	public function getLastMedia($type, $quantity)
	{
		echo json_encode($this->Media_model->getLastMedia($type, $quantity));
	}
	
	public function getLastScraps($quantity)
	{
		echo json_encode($this->Media_model->getLastScraps($quantity));
	}

}