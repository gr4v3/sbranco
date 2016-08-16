<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends MY_Controller {

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
                $pages = $this->page->items();
                $this->load->view('admin', array('page' => $this->load->view('pages/form/item', array(
                    'index' => count($pages),
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
            $this->load->library('page');
            $pages = $this->page->items();
            $currentPages = array_map(function($item) {return $item->link;}, $pages);
            $postpages = $this->input->post('page');
            if (empty($postpages)) $postpages = array();
            $toDelete = array_diff_key(array_flip($currentPages), array_flip($postpages));
            foreach(array_flip($toDelete) as $link) {
                $this->page->del($link);
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
