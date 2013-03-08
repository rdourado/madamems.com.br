<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('America/Sao_Paulo');
class CMSFotos_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    /*
     * Removes image
     */
    public function deleteImage($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('media');
        return $imageId;
    }

    /*
     * Gets product images
     */
    public function getImages()
    {
	$this->db->where('mediaType_id', 1);
	$this->db->order_by("createdOn", "desc");
        return $this->db->get('media');
    }

}
?>