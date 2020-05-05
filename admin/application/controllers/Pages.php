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
	public function index($index = NULL): void
    {
            $this->load->library('page');
            if (empty($index)) {
                $pages = $this->page->items();
                $this->load->view('admin', array('page' => $this->load->view('pages/form/item', array(
                    'index' => count($pages),
                    'title' => '', 
                    'link' => '', 
                    'audio' => '',
                    'description' => '',
                    'background' => '#000000', 
                    'fontcolor' => '#ffffff',
                    'bordercolor' => '#ffffff',
                    'headercolor' => '#ffffff',
                    'headerbackground' => '#ffffff',
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

	public function create(): void
    {
        $index = $this->input->post('index');
        $name = $this->input->post('name');
        $link = namelize($name);
        $options = [
            'index' => $index,
            'title' => $name,
            'link' => $link,
            'audio' => '',
            'description' => '',
            'type' => 'slide',
            'items' => []
        ];
        if (!mkdir($concurrentDirectory = '../assets/pages/' . $link) && !is_dir($concurrentDirectory)) {
            throw new \RuntimeException(sprintf('Directory "%s" was not created', $concurrentDirectory));
        }
        file_put_contents('../assets/pages/' . $link . '/.options', json_encode($options));
        echo $link;
        die();
    }

	public function update($index, $field): void
    {
        $value = $this->input->post('value');
        $options = json_decode(file_get_contents('../assets/pages/' . $index . '/.options'), true);
        $options[$field] = $value;
        file_put_contents('../assets/pages/' . $index . '/.options', json_encode($options));
    }

    public function delete($link):void
    {
        $this->load->library('page');
        $this->page->del($link);
    }

    public function switch(): void
    {
        $items = explode(',',$this->input->post('items'));
        $fileCollection = array_diff(scandir('../assets/pages'), array('.', '..'));
        foreach($fileCollection as $path) {
            $options = json_decode(file_get_contents("../assets/pages/$path/.options"), true);
            $options['index'] = array_search($options['link'], $items, true);
            file_put_contents('../assets/pages/' . $path . '/.options', json_encode($options));
        }
    }
}
