<?php
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
/**
 * TravelCentral24
 * User: Fábio Menezes
 * Date: 18/04/2020
 * Description:
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
    <meta name="Description" content="Sandra Branco | A Fotógrafa | Casamentos | Batizados | Festas">
    <meta name="theme-color" content="#fff">
    <title>Sandra Branco | A Fotógrafa</title>
    <link href="/assets/css/index.css" rel="stylesheet" type="text/css">
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="/assets/css/media.css" rel="stylesheet" type="text/css">
    <link rel="manifest" href="manifest.json">
    <link rel="apple-touch-icon" href="/assets/img/sb_192.png">
</head>
<body class="body">
    <label class="trigger" for="mobile"></label>
    <input type="checkbox" id="mobile" style="display: none; " onchange="menuStatus(this);"/>
    <div class="main">
        <div class="title col-md-12">
            <div class="author col-md-12">
                <h1><a href="/">sandra branco</a></h1>
                <h2>“ A Fotógrafa ”</h2>
            </div>
        </div>
        <div class="menu col-sm-3 col-md-3 col-lg-3">
        </div>
        <div class="content col-sm-9 col-md-9 col-lg-9"></div>
        <div class="footer">
            <a href="mailto:sbranco.85@gmail.com?Subject=Website%20|%20A%20Fotógrafa%20|%20Contacto">Contact</a>
            ©2020 SANDRA BRANCO
        </div>
    </div>
    <a class="audio play" onclick="toggleAudio(this);" href="javascript:"></a>
    <audio id="track" loop="true">
        <source type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>
<script src="/bower_components/jquery/dist/jquery.min.js" type="text/javascript"></script>
<script src="/bower_components/jquery-easing/jquery.easing.min.js"></script>
<script src="/assets/js/jquery.scrollTo.min.js" type="text/javascript"></script>
<script src="/bower_components/mustache/mustache.min.js" type="text/javascript"></script>
<script type="text/javascript" src="assets/js/engine.js"></script>
</body>
</html>