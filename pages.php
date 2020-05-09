<?php
/**
 * TravelCentral24
 * User: Fábio Menezes
 * Date: 25/04/2020
 * Description:
 */
error_reporting(0);
$fileCollection = array_diff(scandir('assets/pages'), array('.', '..'));
$pages = [];
function clearTitle($text) {
    $text = preg_replace('/_i_(.*)_i_/i', '$1', $text);
    $text = preg_replace('/_t_(.*)_t_/i', '$1', $text);
    $text = preg_replace('/_span_(.*)_span_/i', '$1', $text);
    return $text;
}
function encodeTitle($text) {
    $text = preg_replace('/_i_(.*)_i_/i', '<i>$1</i>', $text);
    $text = preg_replace('/_t_(.*)_t_/i', '<span style="font-family: code-light;">$1</span>', $text);
    $text = preg_replace('/_span_(.*)_span_/i', '<span>$1</span>', $text);
    return $text;
}
foreach($fileCollection as $path) {
    $content = json_decode(file_get_contents("assets/pages/$path/.options"), true);
    $index = (int) $content['index'];
    $content['encoded_title'] =  encodeTitle($content['title']);
    $content['clear_title'] =  strip_tags($content['encoded_title']);
    $pages[$index] = $content;
}
ksort($pages);
header('Content-Type: application/json');
echo json_encode($pages);