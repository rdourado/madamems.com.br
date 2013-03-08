<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('America/Sao_Paulo');
class Auth_model extends CI_Model 
{

	function __construct()
	{
		parent::__construct();
	}

	public function login($email, $password)
	{
		$query = $this->db->get_where("usersAdmin", array("email" => $email, "password" => MD5($password)));
		return $query;
	}

	public function updateLoginInformation($id)
	{
		date_default_timezone_set('America/Sao_Paulo');
		$this->db->update('usersAdmin', array("lastLogin" => date('Y-m-d H:i:s')), "id = $id");
	}
	
	public function getByEmail($email)
	{
		$query = $this->db->get_where("usersAdmin", array("email" => $email));
		return $query;
	}
	
	public function saveNewPassword($email, $password)
	{
		$this->db->where('email', $email);
		$query = $this->db->update("usersAdmin", array("password" => $password));
		return true;
	}

}