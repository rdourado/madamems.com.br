<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('America/Sao_Paulo');
class CMSAuth_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    /*
    * Adds new link to the database.
    */
    public function login($username, $password)
    {
        $query = $this->db->get_where("cmsUsers", array("username" => $username, "password" => MD5($password)));
        return $query;
    }

    /*
     * Update lastlogin time
     */
    public function updateLoginInformation($id)
    {
        $this->db->update('cmsUsers', array("lastLogin" => date('Y-m-d H:i:s')), "id = $id");
    }

}