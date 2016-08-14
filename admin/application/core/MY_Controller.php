<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class MY_Controller extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('page');
        $page_form = $this->input->post('page');
        if (!empty($page_form) && !empty($page_form['title'])) {
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
                $page->items = array_merge($photos, $page->items);
                $this->page->set($page_form['link'], $page);
            }
            redirect('http://dev.sbranco.pt/admin/pages/index/' . $page_form['link']);
        }
    }
    
}




