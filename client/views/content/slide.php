<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="slide">
    <table class="gallery" cellpadding="0" cellspacing="0" border="0">
        <tr>
        <?php 
            foreach($items as $photo) {
                echo '<td class="item view"><img src="/img-auto-1024/assets/pages/'.$link.'/'.$photo.'" alt=""/></td>';
            }
        ?>    
        </tr>   
    </table>
</div>
<style type="text/css">
    body.body {
        background-color: <?php echo $background; ?>;
    }
    a, h1, h2 {
        color:<?php echo $fontcolor; ?> !important;
    }
    .gallery .item {
        background-color: <?php echo $bordercolor; ?> !important;
    }
    .gallery .item img {
        border-color: <?php echo $bordercolor; ?> !important;
        border-right-width: 0px !important;
    }    
</style>
<script type="text/javascript">
document.body.onload = function() {
    console.log('slide ready!');
    var track = document.getElementById('track');
    <?php if (isset($audio) && !empty(trim($audio))) { ?>
        track.style.display = 'inline';
    var initial_volume = track.volume * 100;
    var volumeinterval = setInterval(function() {
            if (initial_volume === 0) {
                clearInterval(volumeinterval);
                track.src =  '/assets/audio/<?php echo $audio; ?>';
                volumeinterval = setInterval(function() {
                    if (initial_volume === 100) {
                        clearInterval(volumeinterval);
                    }
                    else initial_volume = initial_volume + 10;
                    track.volume = initial_volume / 100;
                },150);
            }
            else initial_volume = initial_volume - 10;
            if (initial_volume < 0) initial_volume = 0;
            track.volume = initial_volume / 100;
        },50);
    <?php } else { ?>
        track.style.display = 'none';
    <?php } ?>    
    var $slide = $('.slide');
    var $gallery = $slide.find('.gallery');
    if ($slide.length && $gallery.length) {
        $slide.swipe({
            swipeLeft: autobrowse.left,
            swipeRight: autobrowse.right
        });
    }
    $('.nav li a[title="<?php echo $link; ?>"]').addClass('active');
};
</script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-82821472-1', 'auto');
  ga('send', 'pageview');

</script>
