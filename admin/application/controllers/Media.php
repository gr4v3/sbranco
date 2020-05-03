<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Media extends MY_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *        http://example.com/index.php/welcome
     *    - or -
     *        http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function index($index)
    {
        $media = $_FILES['media'];
        if (move_uploaded_file($media['tmp_name'], '../assets/pages/' . $index . '/' . $media['name'])) {
            $options = json_decode(file_get_contents('../assets/pages/' . $index . '/.options'), true);
            $options['items'][] = $media['name'];
            file_put_contents('../assets/pages/' . $index . '/.options', json_encode($options));
        }
    }
}
