<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CMSArquivos extends CI_Controller
{
    function __construct()
    {
	parent::__construct();
        $this->load->model('CMSArquivos_model');
    }

    /*
     * IMAGES
     */
    public function insert()
    {
        $filename  = $this->input->post('filename');
        $id = $this->session->userdata("session_userid");
        echo json_encode($this->CMSArquivos_model->insert($filename, $id));
    }

    public function buildList()
    {
        $files = $this->CMSArquivos_model->get();
        foreach ($files->result() as $row):
            echo '<li id="fileItem_' . $row->id . '">';
            echo '<a href="' . base_url() . 'library/uploads/' . $row->content .  '.pdf" target="_blank">' . $row->title . '</a>';
            echo '<div class="control">';
            echo '    <label class="buttonsDelete" id="' . $row->id . '" rel="' . $row->id .'">excluir</label>';
            echo '</div>';
            echo '</li>';
        endforeach;
    }

    public function delete()
    {
        $id = $this->input->post('id');
        echo json_encode($this->CMSArquivos_model->delete($id));
    }
    
}