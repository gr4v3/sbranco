<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
        function __construct() {
            parent::__construct();
            $this->load->library('page');
            $page_form = $this->input->post('page');
            if (!empty($page_form)) {
                if (empty($page_form['link'])) $page_form['link'] = namelize($page_form['title']);
                if (!isset($page_form['items'])) $page_form['items'] = array();
                $this->page->set($page_form['link'], $page_form);
                if (!empty($_FILES['photos']['name'][0])) {
                    $photos = array();
                    foreach($_FILES['photos']['name'] as $index => $each) {
                        $name = namelize($_FILES['photos']['name'][$index]);
                        $tmp_name = $_FILES['photos']['tmp_name'][$index];
                        move_uploaded_file($tmp_name, CLIENTPATH . 'assets/pages/' . $page_form['link'] . '/' . $name);
                        $photos[] = $name;
                    }
                    $page = $this->page->get($page_form['link']);
                    $page->items = $photos;
                    $this->page->set($page_form['link'], $page);
                }
            }
        }
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
}
