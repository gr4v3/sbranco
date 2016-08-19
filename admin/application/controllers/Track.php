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
            
            $this->load->view('admin', array('page' => 'asdadsa'));
	}
        public function update() {
            $this->load->library('media');
            $pages = $this->media->items();
            $currentPages = array_map(function($item) {return $item->link;}, $pages);
            $postpages = $this->input->post('media');
            if (empty($postpages)) $postpages = array();
            $toDelete = array_diff_key(array_flip($currentPages), array_flip($postpages));
            foreach(array_flip($toDelete) as $link) {
                $this->media->del($link);
            }
            foreach($pages as $item) {
                foreach($postpages as $pageindex => $pagelink) {
                    if ($pagelink === $item->link) {
                        $item->index = $pageindex;
                        $this->page->set($item->link, $item);
                    }
                }
            }
        }
}
