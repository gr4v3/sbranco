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
            $this->load->library('page');
            $items = $this->page->items();
            Debug($items);
            $this->load->view('admin');
	}
        public function page() {
            echo json_encode(array(
                'title' => 'people',
                'audio' => 'thexx.mp3',
                'background-color' => 'rgb(36, 35, 33)',
                'type' => 'normal',
                'items' => array(
                    '12895294_10153250903237924_1629883350_n.jpg',
                    '12895379_10153250898017924_602496037_n.jpg',
                    '12874419_10153251069127924_230922786_o.jpg',
                    '12422312_10153251081582924_1995153778_o.jpg',
                    '12443635_10153251081502924_1170462370_o.jpg',
                    '12596754_10153251081772924_1052114118_o.jpg',
                    '12874558_10153251074872924_1974357794_o.jpg',
                    '12874219_10153251346387924_85925787_o.jpg',
                    '12887455_10153251074732924_1295252013_o.jpg'
                )
            ));
        }
}
