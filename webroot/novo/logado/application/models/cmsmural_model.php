<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('America/Sao_Paulo');
class CMSMural_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    public function update($id, $status)
    {
        $data = array(
           'status' => $status,
           'updatedOn' => date('Y-m-d H:i:s')
        );
        $this->db->where('id', $id);
        $this->db->update('scraps', $data);
    }

    /*
    * Gets news list.
    */
    public function getList($status)
    {
	$this->db->select("scraps.message, scraps.id, usersAdmin.name, usersAdmin.email, DATE_FORMAT(scraps.createdOn, '%e/%c/%Y') as createdOn", FALSE);
	$this->db->from('scraps');
	$this->db->join('usersAdmin', 'usersAdmin.id = scraps.usersAdmin_id');
	$this->db->order_by("scraps.createdOn", "desc");
	$this->db->where('scraps.status', $status);
	return $this->db->get();
    }

}
?>