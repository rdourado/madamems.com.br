<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CMSFotos extends CI_Controller
{
    function __construct()
    {
	parent::__construct();
        $this->load->model('CMSFotos_model');
    }

    public function buildImageList()
    {
        $images = $this->CMSFotos_model->getImages();
        foreach ($images->result() as $row):
            echo '<li id="imageItem_' . $row->id . '">';
            echo '<div class="img">';
            echo '    <img src="' . base_url() . 'timthumb.php?src=' . base_url() . 'library/uploads/' . $row->content . '.jpg&w=133&h=90" />';
            echo '</div>';
	    echo '<div class="imageTitle">' . $row->title . '</div>';
            echo '<div class="control">';
            echo '    <label class="buttonImagesDelete" id="' . $row->id . '" rel="' . $row->id .'">excluir</label>';
            echo '</div>';
            echo '</li>';
        endforeach;
    }

    public function deleteImage()
    {
        $id = $this->input->post('id');
        echo json_encode($this->CMSFotos_model->deleteImage($id));
    }

    public function sortImages()
    {
        foreach ($this->input->post('imageItem') as $position => $item)
        {
           $this->CMSFotos_model->setImagesPosition($item, $position);
        }
    }
}