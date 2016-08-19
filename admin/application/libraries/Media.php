<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Media {
    private $CI = FALSE;
    function __construct() {
        $this->CI =& get_instance();
    }
    public function items() {
        $audio_path = CLIENTPATH . 'assets/audio';
        if (!is_dir($audio_path)) mkdir($audio_path, 0777, TRUE);
        $audios = scandir($audio_path);
        foreach($audios as &$audio) {
            if (in_array($audio, array('.', '..'))) $audio = NULL;
        }
        $audios_filtered = array_filter($audios);
        ksort($audios_filtered);
        return $audios_filtered;
    }
    public function del($filename) {
        $audio_path = CLIENTPATH . 'assets/audio';
        if (is_file($audio_path . '/' . $audio_path)) unlink($audio_path . '/' . $audio_path);
    }
}
