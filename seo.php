<?php
/**
 * TravelCentral24
 * User: Fábio Menezes
 * Date: 18/04/2020
 * Description:
 */
error_reporting(0);
$path_only = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
function clearTitle($text) {
    $text = preg_replace('/_i_(.*)_i_/i', '$1', $text);
    $text = preg_replace('/_span_(.*)_span_/i', '$1', $text);
    return $text;
}
if ($path_only === '/') {
    $path_only = '';
    $fileCollection = array_diff(scandir('assets/pages'), array('.', '..'));
    $title = 'A Fotógrafa';
    $content_path = 'assets/pages';
    $fileCollection = array_diff(scandir('assets/pages'), array('.', '..'));
    $pages = [];
    foreach($fileCollection as $path) {
        $content = json_decode(file_get_contents("assets/pages/$path/.options"), true);
        $index = (int) $content['index'];
        $content['title'] =  clearTitle($content['title']);
        $pages[$index] = $content;
    }
    ksort($pages);
    $content = [];
    $content['items'] = [];
    foreach($pages as $value) {
        $content['items'][] = $value['link'] . '/' . current($value['items']);
    }
    $description = 'Sandra Branco | A Fotógrafa';
} else {
    $content_path = 'assets/pages' . $path_only;
    $content = json_decode(file_get_contents($content_path . '/.options'), true);
    $firstImage = current($content['items']);
    $title = $content['title'];
    $title = preg_replace('/_i_(.*)_i_/i', '$1', $title);
    $title = preg_replace('/_span_(.*)_span_/i', '$1', $title);
    $description = $content['description'];
}
?>
<html lang="en">
<head>
    <title>Sandra Branco | <?php echo $title; ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:title" content="Sandra Branco | <?php echo $title; ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="<?= 'https://sandrabranco.org' .$path_only; ?>" />
    <?php
    foreach($content['items'] as $filename) {
        echo '<meta property="og:image" content="https://sandrabranco.org/img-auto-500/' . $content_path . '/' . $filename . '" />';
    }
    ?>
    <meta property="og:site_name" content="sandrabranco.org" />
    <meta property="fb:app_id" content="225678960794287" />
    <meta property="og:description" content="<?php echo strip_tags($description); ?>" />
</head>
<body>
<?php echo $description; ?>
<?php
    foreach($content['items'] as $filename) {
        echo '<img src="img-auto-500/' . $content_path . '/' . $filename . '" />';
    }
?>
</body>
</html>
