<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2015, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (http://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2015, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	http://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/*
function base_url($uri = '', $protocol = NULL, $cache = FALSE)
{
    $url = get_instance()->config->base_url($uri, $protocol);
    if  (!strpos($url, '?') && $cache) return $url . '?' . time();
    else return $url;
}
*/

if (!function_exists('Debug')) {
	
    function Debug($content = NULL, $die = FALSE, $log = FALSE, $js = FALSE) {
        if (empty($content)) return $content;     
        $debug = false;
        if (isset($_GET['debug'])) {
            $expire=time()+60*60*24*30;
            setcookie('debug',$_GET['debug'], $expire);
            $debug = (bool) $_GET['debug'];
        } else $debug = isset($_COOKIE['debug'])?(bool) $_COOKIE['debug']:FALSE;

        if ($debug) {
            if ($log) {
                $filename = $log . '_' . date('Y-m-d', time()) . '.log';
                $handle = fopen(JPATH_ROOT . '/logs/' . $filename, 'a');
                fwrite($handle, $content. "\n\r");
                fclose($handle);
            } else if ($js) {
                echo '<script type="text/javascript">console.log('.json_encode($content).')</script>';
            } else {
              echo '<pre>' . print_r($content, TRUE) . '</pre>';
            }

            if ($die) die();
        } else setcookie("debug", "", time()-3600);
        return $content;
    }
}
if (!function_exists('namelize')) {
    function namelize($string){
        $string = str_replace(array('[\', \']'), '', $string);
        $string = preg_replace('/\[.*\]/U', '', $string);
        $string = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', '-', $string);
        $string = htmlentities($string, ENT_COMPAT, 'utf-8');
        $string = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $string );
        $string = preg_replace(array('/[^a-z0-9]/i', '/[-]+/') , '-', $string);
        return strtolower(trim($string, '-'));
    }
}