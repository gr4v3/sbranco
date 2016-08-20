<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Section extends CI_Controller {

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
	public function page($pagename = NULL, $height = 700)
	{
            
            $type = $this->input->get('type');
            if ($type !== 'async') {
                $this->output->set_template('main');
                $this->load->library('page');
                $items = $this->page->items();
                $this->output->set_output_data('menu', $this->load->view('menu', array('items' => $items), TRUE), TRUE);
                $page = $this->page->get($pagename);
                $page->height = $height;
                $pics = array();
                foreach($page->items as $image) {
                    $pics[] = 'http://sandrabranco.com/img-auto-768/assets/pages/'.$page->link.'/' . $image; 
                }
                $this->output->set_meta('og:image', $pics);
                $this->output->set_output_data('content', $this->load->view('content/' . $page->type, $page, TRUE), TRUE);
            } else {
                $this->output->set_template('async');
                $this->load->library('page');
                $page = $this->page->get($pagename);
                $page->height = $height;
                if ($page) {
                    $this->load->view('content/' . $page->type, $page);
                }
            }
	}
}
