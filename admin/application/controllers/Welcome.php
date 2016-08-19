<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {

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
            $this->load->library('page');
            $items = $this->page->items();
            $gallery_items = array();
            foreach($items as $item) {
                $gallery_items[] = $this->load->view('pages/item', $item, TRUE);
            }
            $gallery = $this->load->view('gallery', array('items' => implode('', $gallery_items)), TRUE);
            $this->load->view('admin', array('page' => $gallery));
	}
	public function index()
	{
            $this->load->library('media');
            $items = $this->media->items();
            $gallery_items = array();
            foreach($items as $item) {
                $gallery_items[] = $this->load->view('media/item', $item, TRUE);
            }
            $gallery = $this->load->view('gallery', array('items' => implode('', $gallery_items)), TRUE);
            $this->load->view('admin', array('page' => $gallery));
	}
}
