/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function() {
    console.log('doc ready!');
    var idlecount = 0;
    $(document.body).on('mousemove', function(e) {
        // reset the auto browser gallery
        if (autobrowse.id) clearInterval(autobrowse.id);
        idlecount = 0;
    });
    $(document).bind('mousewheel', function(e){
        if (autobrowse.id) clearInterval(autobrowse.id);
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
    $('*[data-type="async"]').on('click', function(e) {
        history.pushState(null, null, this.href);
        e.preventDefault();
        var h = Math.max(document.documentElement.clientHeight, window.innerHeight || 0);
        $('.content').load(this.href + '/' + (Math.round(h*0.7)) + '?type=async', function() {
            var $mobile = $('#mobile');
            if ($mobile.length) {
                $mobile[0].checked = false;
            }
            $(document.body).trigger('page-load');
        });
        var $this = $(this);
            $this.parent().parent().find('a').removeClass('active');
            $this.addClass('active');
        
    });
    // check for the idler
    setInterval(function() {
        idlecount = idlecount + 1;
        if (idlecount === 3) {
            console.log('user idling!');
            autobrowse.start();
        }
    }, 5000);
    
    
    if (window.location.pathname === '/') {
        $('.nav li:first-child a').trigger('click');
    }
    
});

var autobrowse = {
    id:false,
    start:function() {
        autobrowse.id = setInterval(function() {
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

function gaTracker(id){
  $.getScript('//www.google-analytics.com/analytics.js'); // jQuery shortcut
  window.ga=window.ga||function(){(ga.q=ga.q||[]).push(arguments);};ga.l=+new Date;
  ga('create', id, 'auto');
  ga('send', 'pageview');   
}
function gaTrack(path, title) {
  ga('set', { page: path, title: title });
  ga('send', 'pageview');
}
