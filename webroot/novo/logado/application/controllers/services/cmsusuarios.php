<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CMSUsuarios extends CI_Controller
{
    function __construct()
    {
	parent::__construct();
        $this->load->model('CMSUsuarios_model');
    }

    public function insert()
    {
        $name  = $this->input->post('name');
        $email  = $this->input->post('email');
	$password  = $this->input->post('password');
        echo json_encode($this->CMSUsuarios_model->insert($name, $email, MD5($password)));
    }

    public function buildList()
    {
        $files = $this->CMSUsuarios_model->get();
        foreach ($files->result() as $row):
            echo '<li id="userItem_' . $row->id . '">';
            echo '<a href="#">' . $row->name . '</a>';
            echo '<div class="control">';
            echo '    <label class="buttonsDelete" id="' . $row->id . '" rel="' . $row->id .'">excluir</label>';
	    echo '    <label class="buttonsEdit" id="' . $row->id . '" rel="' . $row->id .'">editar</label>';
            echo '</div>';
            echo '</li>';
        endforeach;
    }

    public function delete()
    {
        $id = $this->input->post('id');
        echo json_encode($this->CMSUsuarios_model->delete($id));
    }
    
    public function update()
    {
        $name  = $this->input->post('name');
        $email  = $this->input->post('email');
	$password  = $this->input->post('password');
	$id  = $this->input->post('id');
        echo json_encode($this->CMSUsuarios_model->update($name, $email, MD5($password),$id));
    }
    
}