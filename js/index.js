/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function() {
    console.log('doc ready!');
    var $slide = $('.slide');
    var $gallery = $slide.find('.gallery');
    if ($gallery.length) {
        
        var slide_width = $slide.width();
        $slide.swipe({
            swipeLeft: function() {
                console.log('swipe left');
                var $current = $('.slide .gallery .view');
                var $next = $current.next();
                if ($next.length) {
                    $current.removeClass('view');
                    $next.addClass('view');
                    var img_width = $next.find('img').width();
                    $slide.scrollTo($next, {
                        duration:500,
                        offset:{left: -(slide_width - img_width) / 2}
                    });
                }
                    
            },
            swipeRight: function() {
                console.log('swipe right');
                var $current = $('.slide .gallery .view');
                var $prev = $current.prev();
                if ($prev.length) {
                    $current.removeClass('view');
                    $prev.addClass('view');
                    var img_width = $prev.find('img').width();
                    $slide.scrollTo($prev, {
                        duration:500,
                        offset:{left: -(slide_width - img_width) / 2}
                    });
                }
                    
            }
        });
        
    }
});


