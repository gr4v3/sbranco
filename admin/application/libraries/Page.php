<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Page {
    private $CI = FALSE;
    function __construct() {
        $this->CI =& get_instance();
    }
    public function items() {
        $pages_path = CLIENTPATH . 'assets/pages';
        if (!is_dir($pages_path)) mkdir($pages_path, 0777, TRUE);
        $pages = scandir($pages_path);
        foreach($pages as &$page) {
            if (in_array($page, array('.', '..'))) $page = NULL;
            else $page = $this->get($page);
        }
        $pages_filtered = array_filter($pages);
        $pages_result = array();
        foreach($pages_filtered as $item) {
            $pages_result[(int) $item->index] = $item;
        };
        ksort($pages_result);
        return $pages_result;
    }
    public function set($name = NULL, $options = array()) {
        $page_path = CLIENTPATH . 'assets/pages/' . $name;
        if (!is_dir($page_path)) mkdir($page_path, 0777, TRUE);
        file_put_contents($page_path. '/.options', json_encode($options));
    }
    public function get($name = NULL) {
        $page_path = CLIENTPATH . 'assets/pages/' . $name;
        if (!is_dir($page_path)) return NULL;
        return json_decode(file_get_contents($page_path. '/.options'));
    }
}