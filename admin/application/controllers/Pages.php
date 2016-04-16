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
	public function index($index)
	{
            $this->load->library('page');
            
            $page_form = $this->input->post('page');
            if (!empty($page_form)) {
                //$page_form['link'] = namelize(strip_tags($page_form['title']));
                
                $this->page->set($this->input->post('link'), $page_form);
            }
            
            $page = $this->page->get($index);
            $gallery_items = array();
            foreach($page->items as $item) {
                $gallery_items[] = $this->load->view('pages/form/gallery/item', array('page' => $index, 'src' => $item), TRUE);
            }
            $page->gallery = implode('', $gallery_items);
            $this->load->view('admin', array('page' => $this->load->view('pages/form/item', $page, TRUE)));
	}
}
