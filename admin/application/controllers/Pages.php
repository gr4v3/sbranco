<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

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
	public function index($index = NULL)
	{
            $this->load->library('page');
            if (empty($index)) {
                $this->load->view('admin', array('page' => $this->load->view('pages/form/item', array(
                    'title' => '', 
                    'link' => '', 
                    'audio' => '', 
                    'background' => '', 
                    'type' => 'slide', 
                    'gallery' => ''
                    ), TRUE)));
            } else {
                $page = $this->page->get($index);
                $gallery_items = array();
                foreach($page->items as $item) {
                    $gallery_items[] = $this->load->view('pages/form/gallery/item', array('page' => $index, 'src' => $item), TRUE);
                }
                $page->gallery = implode('', $gallery_items);
                
                $this->load->view('admin', array('page' => $this->load->view('pages/form/item', $page, TRUE)));
            }
	}
        public function update() {
            $page_form = array_flip($this->input->post('page'));
            $this->load->library('page');
            $pages = $this->page->items();
            foreach($pages as &$item) {
                $item->index = $page_form[$item->link];
                $this->page->set($item->link, $item);
            }
            
        }
}
