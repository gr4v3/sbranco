<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html xmlns="http://www.w3.org/1999/xhtml"
      xmlns:fb="http://ogp.me/ns/fb#">
    <head>
        <title>A Fotógrafa</title>
        <meta charset="UTF-8">
        <?php 
            if (isset($meta['og:image'])) {
                foreach($meta['og:image'] as $each) {
                    echo '<meta property="og:image" content="'.$each.'" />';
                }
            }
            
        ?>
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="/assets/css/index.css" rel="stylesheet" type="text/css"/>
        <link href="/assets/css/media.css" rel="stylesheet" type="text/css"/>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="/assets/css/font-awesome.min.css">
        <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
        <!-- Optional theme -->
        <link rel="stylesheet" href="/assets/css/bootstrap-theme.min.css">
    </head>
    <body class="body" onload="pageLoad();">
        <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5&appId=225678960794287";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
        <label class="fa trigger" for="mobile"></label>
        <input type="checkbox" id="mobile" style="display:none;" />
        <div class="main">
            <div class="title col-md-12">
                <a href="/">
                    <div class="author col-md-12">
                        <h1>sandra branco</h1>
                        <h2>“ A Fotógrafa ”</h2>
                    </div>
                </a>
            </div>
            <div class="menu col-md-3">
                
                <?php echo $menu; ?>
            </div>
            <div class="content col-md-9">
                <?php echo $content; ?>
            </div>
        </div>
        <script src="/assets/js/jquery-1.12.2.min.js" type="text/javascript"></script>
        <script src="/assets/js/jquery.touchSwipe.min.js" type="text/javascript"></script>
        <script src="/assets/js/jquery.scrollTo.min.js" type="text/javascript"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="/assets/js/bootstrap.min.js"></script>
        <script src="/assets/js/index.js" type="text/javascript"></script>
        <div class="audio">
            <audio id="track" controls autoplay loop="true">
            <source type="audio/mpeg">
            Your browser does not support the audio element.
         </audio>
        </div>
        <div class="fb-like" data-href="https://sandrabranco.com" data-layout="button" data-action="like" data-show-faces="true" data-share="true"></div>
    </body>
</html>
