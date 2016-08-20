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
	public function index()
	{
            $this->output->set_template('main');
            $this->load->library('page');
            $items = $this->page->items();
            $this->output->set_output_data('menu', $this->load->view('menu', array('items' => $items), TRUE), TRUE);
            $this->output->set_output_data('content', '', TRUE);
            $pics = array();
            foreach($items as $page) {
                foreach($page->items as $image) {
                    $pics[] = 'http://sandrabranco.com/img-auto-768/assets/pages/'.$page->link.'/' . $image; 
                }
            }
            $this->output->set_meta('og:image', $pics);
	}
}
