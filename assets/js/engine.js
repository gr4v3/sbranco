function isMobile() {
    return new Promise(function(resolve, reject) {
        let check = false;
        (function(a){
            if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4)))
                check = true;
        })(navigator.userAgent||navigator.vendor||window.opera);
        if (check) {
            resolve();
        } else {
            reject();
        }
    });
}
let autobrowse = {
    id:false,
    start: function() {
        autobrowse.id = setInterval(function() {
            isMobile().then(function() {

            }).catch(function() {
                autobrowse.left().catch(function() {
                    let element = document.querySelector('.menu a.active');
                    if (element && element.parentElement.nextElementSibling) {
                        element.parentElement.nextElementSibling.querySelector('a').click();
                    } else {
                        let element = document.querySelector('.menu ul li:first-child a');
                        element.click();
                    }
                });
            })
        },10000);
    },
    getCurrent: function() {
        return new Promise(function(resolve, reject) {
            let currentSlide = document.querySelector('.slide .gallery .item.view');
            if (!currentSlide) {
                currentSlide = document.querySelector('.slide .gallery .item:first-child');
            }
            if (currentSlide) {
                resolve(currentSlide);
            } else {
                reject();
            }
        });
    },
    left: function() {
        return new Promise(function(resolve, reject) {
            autobrowse.getCurrent().then(function(currentSlide) {
                if (currentSlide.nextElementSibling) {
                    currentSlide.classList.remove('view');
                    currentSlide.nextElementSibling.classList.add('view');
                    $(document.querySelector('.slide')).scrollTo(currentSlide.nextElementSibling, {
                        duration: 2000,
                        easing: 'easeInOutQuart'
                    });
                    resolve();
                }
                reject();
            })
        });
    }
};
jQuery(document).ready(function() {
    let startX = 0;
    let scrollLeft = 0;
    fetch('/pages.php').then(function(response){
        return response.json();
    }).then(function(pages) {
        isMobile()
            .then(function() {
                fetch('/views/mobile/menu.tmpl')
                    .then(function(response) {
                        return response.text();
                    })
                    .then(function(template) {
                        let content = document.querySelector('.content');
                        content.innerHTML = Mustache.render(template, {pages:pages});
                    });
                fetch('/views/desktop/menu.tmpl')
                    .then(function(response) {
                        return response.text();
                    })
                    .then(function(template) {
                        let content = document.querySelector('.menu');
                        content.innerHTML = Mustache.render(template, {pages:pages});
                        menuEngage(pages);
                        let index = window.location.pathname.substring(1, window.location.pathname.length);
                        let element = document.querySelector('.menu a[data-index="' + index + '"]');
                        if (element) {
                            element.click();
                        }
                    });
            })
            .catch(function() {
                document.addEventListener('mousedown', function(e) {
                    let slider = e.target.closest('.slide');
                    if (slider) {
                        startX = e.pageX - slider.offsetLeft;
                        scrollLeft = slider.scrollLeft;
                        slider.classList.add('sliding');
                        $(slider).stop();
                    }
                });
                document.addEventListener('mousemove', function(e) {
                    let slider = e.target.closest('.slide');
                    if (slider && slider.classList.contains('sliding')) {
                        e.preventDefault();
                        const x = e.pageX - slider.offsetLeft;
                        const walk = x - startX;
                        slider.scrollLeft = scrollLeft - walk;
                    }
                });
                document.addEventListener('mouseup', function(e) {
                    let slider = document.querySelector('.slide');
                    if (slider) {
                        slider.classList.remove('sliding');
                        if (scrollLeft < slider.scrollLeft) {
                            console.log('went left');
                            $(slider).animate({
                                scrollLeft: slider.scrollLeft - (scrollLeft - slider.scrollLeft),
                            }, {
                                duration: 700,
                                easing: 'easeOutQuart'
                            });
                        } else {
                            console.log('went right');
                            $(slider).animate({
                                scrollLeft: slider.scrollLeft + (slider.scrollLeft - scrollLeft)
                            }, {
                                duration: 700,
                                easing: 'easeOutQuart'
                            });
                        }
                    }
                });
                fetch('/views/desktop/menu.tmpl')
                    .then(function(response) {
                        return response.text();
                    })
                    .then(function(template) {
                        let content = document.querySelector('.menu');
                        content.innerHTML = Mustache.render(template, {pages:pages});
                        menuEngage(pages);
                        let index = window.location.pathname.substring(1, window.location.pathname.length);
                        let element = document.querySelector('.menu a[data-index="' + index + '"]');
                        if (!element) {
                            element = document.querySelector('.menu ul li:first-child a');
                        }
                        if (element) {
                            element.click();

                            (function() {
                                let t, timeout = 10000;
                                function resetTimer() {
                                    window.clearInterval(autobrowse.id);
                                    if (t) {
                                        window.clearTimeout(t);
                                    }
                                    t = window.setTimeout(logout, timeout);
                                }
                                function logout() {
                                    autobrowse.start();
                                }
                                resetTimer();
                                //And bind the events to call `resetTimer()`
                                ["click", "mousemove", "keypress"].forEach(function(name) {
                                    document.addEventListener(name, resetTimer);
                                });
                            }());
                        }
                    });
            })
    });
});
let menuStatus = function(element) {
    if (element.checked) {
        document.body.classList.add('menu-open');
    } else {
        document.body.classList.remove('menu-open');
    }
}
let renderContent = function(item, template) {
    let content = document.querySelector('.content');
    content.innerHTML = Mustache.render(template, item);
    lazyLoad(content);
    checkHeight();
    if (item.hasOwnProperty('audio') && String(item.audio).trim() !== '') {
        console.log(item.audio);
        let audio = document.querySelector('audio');
        let source = audio.querySelector('source');
        if (source.src.indexOf(item.audio)<0) {
            source.src = '/assets/audio/' + item.audio;
            audio.load();
            audio.play();
        }
    }
    document.title = 'Sandra Branco | ' + item.clear_title;
    document.querySelector('#mobile').checked = false;
    window.history.pushState({page:item.link}, item.link, item.link);
    document.querySelectorAll('.menu a').forEach(function(each) {
        each.classList.remove('active');
    });
    let currentMenu = document.querySelector('a[data-index="' + item.link + '"]');
    currentMenu.classList.add('active');
}
let menuEngage = function(pages) {
    let menuLinks = document.querySelectorAll('.menu .nav a, a.manual');
    menuLinks.forEach(function(element) {
        element.addEventListener('click', function(e) {
            e.preventDefault();

            let menuItemElement = e.target;
            if (e.target.tagName !== 'A') {
                menuItemElement = e.target.closest('a');
            }
            pages.forEach(function(item) {
                if (item.link === menuItemElement.dataset.index) {
                    document.body.classList.remove('menu-open');
                    document.body.classList.add('page');
                    isMobile().then(function() {
                        fetch('/views/mobile/slide.tmpl').then(function(response) {
                            return response.text();
                        }).then(function(template) {
                            renderContent(item, template);
                        });
                    }).catch(function() {
                        fetch('/views/slide.tmpl').then(function(response) {
                            return response.text();
                        }).then(function(template) {
                            renderContent(item, template);
                        });
                    });
                }
            });
        });
    });
}
let checkHeight = function() {
    let title = document.querySelector('.title');
    let footer = document.querySelector('.footer');
    let content = document.querySelector('.content');
    let menu = document.querySelector('.menu');
    let slide = document.querySelector('.slide');
    let imgCollection = document.querySelectorAll('.gallery img');
    let height = footer.offsetTop - (title.offsetTop + title.offsetHeight);
    let inside =  document.querySelector('.inside');
    content.style.height = height + 'px';
    menu.style.height = height + 'px';
    let imgHeight = height - 80;
    let paddingHeight = ( height - imgHeight ) / 2;
    imgCollection.forEach(function(img) {
        img.style.height = imgHeight  + 'px';
    });
    slide.style.paddingTop = paddingHeight  + 'px';
    slide.style.paddingBottom = paddingHeight  + 'px';
    inside.style.paddingTop = paddingHeight  + 'px';
    inside.style.paddingBottom = paddingHeight  + 'px';
}
window.onresize = function() {
    checkHeight();
}
let toggleAudio = function(element) {
    let track = document.querySelector('#track');
    if (element.classList.contains('play')) {
        element.classList.remove('play');
        track.pause();
    } else {
        element.classList.add('play');
        track.play();
    }
}
let isInViewport = function (elem) {
    let bounding = elem.getBoundingClientRect();
    return (
        bounding.top >= 0 &&
        bounding.left >= 0 &&
        bounding.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
        bounding.right <= (window.innerWidth || document.documentElement.clientWidth)
    );
};
let lazyLoad = function(containerElemenet) {
    let loading = containerElemenet.querySelectorAll('.loading');
    loading.forEach(function(img) {
        img.src = img.dataset.src;
        img.classList.remove('loading');
    });
}