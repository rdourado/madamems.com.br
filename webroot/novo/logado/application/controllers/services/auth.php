<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->library('email');
		$this->load->library('encrypt');
		$this->load->model('Auth_model');
	}

	public function login()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$query = $this->Auth_model->login($email, $password);
		if ($query->num_rows() == 0) 
		{
			echo false;
		} else
		{
			$result = $query->result_array();
			$this->session->set_userdata('session_userid', $result[0]['id']);
			$this->session->set_userdata('session_name', $result[0]['name']);
			$this->Auth_model->updateLoginInformation($result[0]['id']);
			echo true;
		}
	}
	
	public function recoverPassword()
	{
		$email = $this->input->post('email');
		$query = $this->Auth_model->getByEmail($email);
		if ($query->num_rows() == 0) 
		{
			echo false;
		} else
		{
			$result = $query->result_array();
			$new = $this->generatePassword();
			$encrypted = $this->encrypt->sha1($new);

			if($this->Auth_model->saveNewPassword($email, $encrypted))
			{
				$this->email->from(DEFAULT_EMAIL, DEFAULT_PAGE_TITLE);
				$this->email->to($email);
				$this->email->subject("[Madame Ms] Senha de acesso");
				$this->email->message("Olá " . $result[0]["name"] . ", sua senha de acesso ao site MadameMs é: " . $new);
				if($this->email->send())
				{
					echo true;
				}else
				{
					echo false;
				}
			}  else 
			{
				echo false;
			}
		}
	}

	public function logout()
	{
		$this->session->set_userdata('session_userid', '');
		$this->session->set_userdata('session_hash', '');
		$this->session->set_userdata('session_name', '');
		redirect(base_url());
	}
	
	private function generatePassword($length = 6,$level = 2)
	{

		list($usec, $sec) = explode(' ', microtime());
		srand((float) $sec + ((float) $usec * 100000));

		$validchars[1] = "0123456789abcdfghjkmnpqrstvwxyz";
		$validchars[2] = "0123456789abcdfghjkmnpqrstvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$validchars[3] = "0123456789_!@#$%&*()-=+/abcdfghjkmnpqrstvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_!@#$%&*()-=+/";

		$password  = "";
		$counter   = 0;

		while ($counter < $length)
		{
			$actChar = substr($validchars[$level], rand(0, strlen($validchars[$level])-1), 1);

			// All character must be different
			if (!strstr($password, $actChar))
			{
				$password .= $actChar;
				$counter++;
			}
		}
		return $password;
	}

}