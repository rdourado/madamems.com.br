<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('America/Sao_Paulo');
class CMSVideos_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Removes image
     */
    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('media');
	return true;
    }

    /*
     * Gets product images
     */
    public function getVideos()
    {
	$this->db->where('mediaType_id', 2);
	$this->db->order_by("createdOn", "desc");
        return $this->db->get('media');
    }


}
?>