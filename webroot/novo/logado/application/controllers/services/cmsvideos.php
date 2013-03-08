<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CMSVideos extends CI_Controller
{
    function __construct()
    {
	parent::__construct();
        $this->load->model('CMSVideos_model');
    }

    public function buildVideoList()
    {
        $videos = $this->CMSVideos_model->getVideos();
        foreach ($videos->result() as $row):
            echo '<li id="videoItem_' . $row->id . '" rel="' . base_url() . 'library/uploads/' . $row->content .  '.mp4"><a>' . $row->title . '</a>';
            echo '<div class="control">';
            echo '    <label class="buttonsVideoDelete" id="' . $row->id . '" rel="' . $row->id .'">excluir</label>';
            echo '</div>';
            echo '</li>';
        endforeach;
    }

    public function delete()
    {
        $id = $this->input->post('id');
        echo json_encode($this->CMSVideos_model->delete($id));
    }
    
}