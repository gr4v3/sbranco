<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Audio extends MY_Controller
{

    public function upload(): void
    {
        $media = $_FILES['media'];
        $name = $media['name'];
        move_uploaded_file($media['tmp_name'], '../assets/audio/' . namelize($name));
        echo $media['name'];
        die();
    }

    public function delete($name): void
    {
        unlink('../assets/audio/' . $name);
        header("HTTP/1.0 204 No Content");
        exit();
    }
}
