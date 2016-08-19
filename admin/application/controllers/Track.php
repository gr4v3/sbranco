<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Track extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	*/
	public function index()
	{
	    $this->load->library('media');
            $medias = $this->media->items();
            var_dump($medias);
            $postmedias = $this->input->post('media');
            var_dump($postmedias);
            if (empty($postmedias)) $postmedias = array();
            $toDelete = array_diff_key(array_flip($medias), array_flip($postmedias));
            foreach(array_flip($toDelete) as $link) {
                $this->media->del($link);
            }
            $gallery_items = [];
            foreach($medias as $filename) {
                $gallery_items[] = $this->load->view('media/item', array('file' => $filename), TRUE);
            }
            $gallery = $this->load->view('media/gallery', array('items' => implode('', $gallery_items)), TRUE);
            $this->load->view('admin', array('page' => $gallery));
	}
}
