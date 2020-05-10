<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Media extends MY_Controller
{

    public function upload($index): void
    {
        $media = $_FILES['media'];
        $nameExploded = explode('.', $media['name']);
        $extension = strtolower(end($nameExploded));
        if ($extension === 'jpeg') {
            $extension = 'jpg';
        }
        $name = md5($media['name']) . '.' . $extension;
        move_uploaded_file($media['tmp_name'], '../assets/pages/' . $index . '/' . $name);
        $options = json_decode(file_get_contents('../assets/pages/' . $index . '/.options'), true);
        $options['items'][] = $name;
        file_put_contents('../assets/pages/' . $index . '/.options', json_encode($options));
        header("HTTP/1.0 204 No Content");
        exit();
    }

    public function delete($index, $name): void
    {
        $options = json_decode(file_get_contents('../assets/pages/' . $index . '/.options'), true);
        $medias = [];
        foreach($options['items'] as $value) {
            if ($value !== $name) {
                $medias[] = $value;
            }
        }
        $options['items'] = $medias;
        file_put_contents('../assets/pages/' . $index . '/.options', json_encode($options));
        header("HTTP/1.0 204 No Content");
        exit();
    }

    public function switch($index): void
    {
        $options = json_decode(file_get_contents('../assets/pages/' . $index . '/.options'), true);
        $options['items'] = explode(',',$this->input->post('items'));
        file_put_contents('../assets/pages/' . $index . '/.options', json_encode($options));
        header("HTTP/1.0 204 No Content");
        exit();
    }
}
