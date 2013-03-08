<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('America/Sao_Paulo');
class CMSArquivos_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    /*
     * Removes file
     */
    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('media');
        return true;
    }

    /*
     * Gets file
     */
    public function get()
    {
	$this->db->where('mediaType_id', 3);
	$this->db->order_by("createdOn", "desc");
        return $this->db->get('media');
    }

}
?>