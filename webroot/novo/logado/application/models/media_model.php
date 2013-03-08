<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('America/Sao_Paulo');
class Media_model extends CI_Model 
{

	function __construct()
	{
		parent::__construct();
	}

	public function add($type, $title, $content, $user_id)
	{
		$data = array
		(
			'mediaType_id' => $type,
			'title' => $title,
			'usersAdmin_id' => $user_id,
			'content' => $content,
			'createdOn' => date('Y-m-d H:i:s')
		);
		$query = $this->db->insert("media", $data);
		return $this->db->insert_id();;
	}
	
	public function addScrap($message, $user_id)
	{
		$data = array
		(
			'usersAdmin_id' => $user_id,
			'message' => $message,
			'status' => 0,
			'createdOn' => date('Y-m-d H:i:s')
		);
		$query = $this->db->insert("scraps", $data);
		return $this->db->insert_id();;
	}

	public function getList($type, $order_by, $order)
	{
		$this->db->select("media.content, media.id, media.title, usersAdmin.name, usersAdmin.email, DATE_FORMAT(media.createdOn, '%e/%c/%Y') as date", FALSE);
		$this->db->from('media');
		$this->db->join('usersAdmin', 'usersAdmin.id = media.usersAdmin_id');
		$this->db->order_by($order_by, $order);
		$this->db->where('media.mediaType_id', $type);
		$result = $this->db->get();
		return $result->result_array();
	}
	
	public function getScraps()
	{
		$this->db->select("scraps.message, scraps.id, usersAdmin.name, usersAdmin.email, DATE_FORMAT(scraps.createdOn, '%e/%c/%Y') as date", FALSE);
		$this->db->from('scraps');
		$this->db->join('usersAdmin', 'usersAdmin.id = scraps.usersAdmin_id');
		$this->db->where('scraps.status', 1);
		$this->db->order_by("scraps.createdOn", "desc");
		$result = $this->db->get();
		return $result->result_array();
	}
	
	public function getLastScraps($limit)
	{
		$this->db->select("scraps.message, scraps.id, usersAdmin.name, usersAdmin.email, DATE_FORMAT(scraps.createdOn, '%e/%c/%Y') as date", FALSE);
		$this->db->from('scraps');
		$this->db->join('usersAdmin', 'usersAdmin.id = scraps.usersAdmin_id');
		$this->db->where('scraps.status', 1);
		$this->db->order_by("scraps.createdOn", "desc");
		$this->db->limit($limit);
		$result = $this->db->get();
		return $result->result_array();
	}
	
	public function getLastMedia($type, $limit)
	{
		$this->db->select("media.content, media.id, media.title, usersAdmin.name, usersAdmin.email, DATE_FORMAT(media.createdOn, '%e/%c/%Y') as date", FALSE);
		$this->db->from('media');
		$this->db->join('usersAdmin', 'usersAdmin.id = media.usersAdmin_id');
		$this->db->order_by("media.createdOn", "desc");
		$this->db->where('media.mediaType_id', $type);
		$this->db->limit($limit);
		$result = $this->db->get();
		return $result->result_array();
	}

}