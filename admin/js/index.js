/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function() {
    console.log('doc ready!');
    var $slide = $('.slide');
    var $gallery = $slide.find('.gallery');
    if ($slide.length && $gallery.length) {
        $slide.swipe({
            swipeLeft: autobrowse.left,
            swipeRight: autobrowse.right
        });
    }
    $(document.body).on('mousemove', function() {
        // reset the auto browser gallery
        if (autobrowse.id) clearInterval(autobrowse.id);
        autobrowse.start();
    });
    autobrowse.start();
    $(document).bind('mousewheel', function(e){
        e.stopPropagation();
        if(e.originalEvent.wheelDelta /120 > 0) {
            clearTimeout($.data(this, 'timer'));
            $.data(this, 'timer', setTimeout(function() {
               console.log("Haven't scrolled in 250ms!");
               autobrowse.right();
            }, 50));
        }
        else {
            clearTimeout($.data(this, 'timer'));
            $.data(this, 'timer', setTimeout(function() {
               console.log("Haven't scrolled in 250ms!");
               autobrowse.left();
            }, 50));
        }
    });
});

var autobrowse = {
    id:false,
    start:function() {
        this.id = setInterval(function() {
            var left = autobrowse.left();
            if (!left) {
                var $slide = $('.slide');
                var slide_width = $slide.width();
                $('.slide .gallery .view').removeClass('view');
                var $new = $('.slide .gallery tr td:first-child');
                    $new.addClass('view');
                var img_width = $new.find('img').width();
                $slide.scrollTo($new, {
                    duration:2000,
                    offset:{left: -(slide_width - img_width) / 2}
                });
            }
        },10000);
    },
    left:function() {
        console.log('swipe left');
        if (this.id) clearInterval(this.id);
        var $slide = $('.slide');
        var slide_width = $slide.width();
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
            return true;
        } else return false;
    },
    right:function() {
        console.log('swipe right');
        if (this.id) clearInterval(this.id);
        var $slide = $('.slide');
        var slide_width = $slide.width();
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
            return true;
        } else return false;
    }
};
