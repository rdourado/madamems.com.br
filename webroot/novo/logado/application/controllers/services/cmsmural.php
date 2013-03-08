<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CMSMural extends CI_Controller
{
    function __construct()
    {
	parent::__construct();
        $this->load->model('CmsMural_model');
    }
    
    public function changeStatus()
    {
	$id             = $this->input->post('id');  
        $status         = $this->input->post('status');
        echo $this->CmsMural_model->update($id, $status);   
    }

}