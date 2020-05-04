<?php
require_once 'vendor/mobiledetect/mobiledetectlib/Mobile_Detect.php';
$detect = new Mobile_Detect;
if ( !$detect->isMobile() ) {
    require_once 'index.old.php';
    exit();
}
$pageIndexParameter = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
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
$menu = [];
$mainContent = [];

$pageInside = false;
if ($pageIndexParameter !== '' && in_array($pageIndexParameter, $fileCollection, true)) {
    $pageInside = true;
    $page = json_decode(file_get_contents("assets/pages/$pageIndexParameter/.options"), true);
    $menuTree = [];
    foreach($fileCollection as $index => $pageIndex) {
        $content = json_decode(file_get_contents("assets/pages/$pageIndex/.options"), true);
        $encoded_title = encodeTitle($content['title']);

        if ($pageIndex === $pageIndexParameter) {
            $menu[(int) $content['index']] = "<li><a class=\"active\" href=\"/$pageIndex\">$encoded_title</a></li>";
        } else {
            $menu[(int) $content['index']] = "<li><a href=\"/$pageIndex\">$encoded_title</a></li>";
        }


        $menuTree[(int) $content['index']] = [
            'title' => encodeTitle($content['title']),
            'link' => $pageIndex
        ];
    }
    $description = $page['description'];
    $mainContent[] = "<div class=\"textelement\">$description</div>";
    $mainContent[] = "<div class=\"row\">";
    foreach($page['items'] as $media) {
        $link = $page['link'];
        $mainContent[] = "<div class=\"col-12\">
            <div class=\"mb-4\">
                <img alt=\"\" class=\"img-fluid\"  src=\"/img-auto-720/assets/pages/$link/$media\" >
            </div>
        </div>";
    }
    $mainContent[] = "</div>";

    ksort($menuTree);

    $previousLink = false;
    $nextLink = false;
    foreach($menuTree as $index => $value) {
        if ($value['link'] === $pageIndexParameter) {
            if (array_key_exists($index - 1, $menuTree)) {
                $previousLink = $menuTree[$index - 1];
            }
            if (array_key_exists($index + 1, $menuTree)) {
                $nextLink = $menuTree[$index  + 1];
            }
        }
    }
    $mainContent[] = '<div class="prevnext">';
    if ($previousLink) $mainContent[] = '<a class="prevlink" href="/' . $previousLink['link'] . '"><span>PREVIOUS<br>' . $previousLink['title'] . '</span></a>';
    $mainContent[] = '<a class="categorylink" href="/">A Fotógrafa</a>';
    if ($nextLink)  $mainContent[] = '<a class="nextlink" href="/' . $nextLink['link'] . '"><span>NEXT<br>' . $nextLink['title'] . '</span></a>';
    $mainContent[] = '</div>';

    $title = 'Sandra Branco | ' . ucwords($page['title']);

} else {
    foreach($fileCollection as $pageIndex) {
        $content = json_decode(file_get_contents("assets/pages/$pageIndex/.options"), true);
        $index = (int) $content['index'];
        $encoded_title = encodeTitle($content['title']);
        $firstItem = current($content['items']);
        $menu[$index] = "<li><a href=\"/$pageIndex\">$encoded_title</a></li>";
        $mainContent[$index] = "<div class=\"griditem\">
        <a class=\"hovereffect\" href=\"/$pageIndex\">
            <img class=\"img-fluid\" title=\"PRINT\" src=\"/img-405-auto/assets/pages/$pageIndex/$firstItem\"  alt=\"\" />
            <div class=\"imgoverlay\">
                <h2>$encoded_title</h2>
            </div>
        </a>
    </div>";
    }
    $title = 'Sandra Branco | A Fotógrafa';

}
ksort($menu);
ksort($mainContent);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title><?php echo $title; ?></title>
    <meta name="Description" content="Sandra Branco | A Fotógrafa | Casamentos | Batizados | Festas">
    <meta name="theme-color" content="#fff">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="/website_files/main.css" media="all">
    <link rel="stylesheet" type="text/css" href="/website_files/overwrite.css?<?php echo time(); ?>" media="all">
    <link rel="manifest" href="manifest.json">
    <link rel="apple-touch-icon" href="/assets/img/sb_192.png">
</head>
<body>
<div id="navigation" class="overlay">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
    <ul>
        <li>
            <ul id="menu">
                <?php
                echo implode('', $menu);
                ?>
            </ul>
        </li>
    </ul>
</div>
<header>
    <div class="container-fluid">
        <a id="logoHeader" href="https://sandrabranco.org">SANDRA BRANCO</a>
        <span id="menuToggle" onclick="openNav()">
            <span></span>
            <span></span>
            <span></span>
        </span>
    </div>
</header>

<div class="container-fluid mainmenu">
    <a href="/" class="active"><span>Photography</span></a>
    <a rel="noopener" target="_blank" href="https://soundcloud.com/sandra-branco"><span>Film</span></a>
    <a rel="noopener" target="_blank" href="https://soundcloud.com/sandra-branco"><span>Music</span></a>
    <a rel="noopener" target="_blank" href="https://www.facebook.com/sbrancophoto/"><span>Design</span></a>
    <a rel="noopener" target="_blank" href="https://www.instagram.com/sbrancotellsthestory"><span>About</span></a>
</div>

<!-- end navigation -->
<div class="container-fluid">
        <?php
        if ($pageInside === false) {
            echo '<div class="grid effect-1" id="grid">'. implode('', $mainContent) . '</div>';
        } else {
            echo implode('', $mainContent);
        }
        ?>
</div>
<!-- footer -->
<footer>
    <div class="footerblack">
        <div class="textelement">
            <p><a href="mailto:sbranco.85@gmail.com?Subject=Website%20|%20A%20Fotógrafa%20|%20Contacto">Contact</a>&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;©2020 SANDRA BRANCO</p>
        </div>
    </div>
</footer>
<script src="/bower_components/jquery/dist/jquery.min.js" type="text/javascript"></script>
<script src="/website_files/macy.js" type="text/javascript"></script>
<script src="/website_files/classie.js" type="text/javascript"></script>
<script src="/website_files/main.js?<?php echo time(); ?>" type="text/javascript"></script>
</body>
</html>