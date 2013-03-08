<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('America/Sao_Paulo');
class CMSUsuarios_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    /*
     * Insert user
     */
    public function insert($name, $email, $password)
    {
	$data = array
	(
		'name' => $name,
		'email' => $email,
		'password' => $password,
		'createdOn' => date('Y-m-d H:i:s'),
		'lastLogin' => date('Y-m-d H:i:s')
	);
	$query = $this->db->insert("usersAdmin", $data);
	return $this->db->insert_id();;
    }
    
    /*
     * Edit user
     */
    public function edit($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('usersAdmin')->result_array();
    }
    
    /*
     * Update user
     */
    public function update($name, $email, $password, $id)
    {
	$data = array
	(
		'name' => $name,
		'email' => $email,
		'password' => $password
	);
	$this->db->where('id', $id);
	$query = $this->db->update("usersAdmin", $data);
	return true;
    }

    /*
     * Removes user
     */
    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('usersAdmin');
        return true;
    }

    /*
     * Gets users
     */
    public function get()
    {
	$this->db->order_by("name", "asc");
        return $this->db->get('usersAdmin');
    }

}
?>