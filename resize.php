<?php
/* ----------------------------------------------------------------
DYNAMIC IMAGE RESIZING SCRIPT - V2
The following script will take an existing JPG image, and resize it
using set options defined in your .htaccess file (while also providing
a nice clean URL to use when referencing the images)
Images will be cached, to reduce overhead, and will be updated only if
the image is newer than it's cached version.

The original script is from Timothy Crowe's 'veryraw' website, with
caching additions added by Trent Davies:
http://veryraw.com/history/2005/03/image-resizing-with-php/

Further modifications to include antialiasing, sharpening, gif & png 
support, plus folder structues for image paths, added by Mike Harding
http://sneak.co.nz

For instructions on use, head to http://sneak.co.nz
---------------------------------------------------------------- */

// max_width and image variables are sent by htaccess
$max_height = 1000;
$image = filter_input(INPUT_GET, 'imgfile');
$width = filter_input(INPUT_GET, 'width');
$height = filter_input(INPUT_GET, 'height');
$root = '.';

if (strrchr($image, '/')) {
	$filename = substr(strrchr($image, '/'), 1); // remove folder references
} else {
	$filename = $image;
}

if (!is_file($image)) {
    $root = '/home/simples/domains/office.simples.pt/public_html';
    $image = $image;
}

include_once 'SimpleImage.php';
$cache_file = null;
if (is_file("cache/$width-$height-$filename")) $cache_file = "cache/$width-$height-$filename";
else if (is_file($root . "/cache/$width-$height-$filename")) $cache_file = $root . "/cache/$width-$height-$filename";

if (is_file($cache_file)) { 
    $img = new SimpleImage($cache_file);
    $info = $img->get_original_info();
    header("Content-type: " . $info['mime']);
    die(file_get_contents($cache_file));
} 
try {
    $img = new SimpleImage($root. '/' .$image);
    $img->quality = 100;
    if ($width === 'auto') $img->fit_to_height($height);
    else if ($height === 'auto') $img->fit_to_width($width);
    else $img->best_fit($width, $height);
    $img->save("cache/$width-$height-$filename");
    $img->output();
} catch(Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
