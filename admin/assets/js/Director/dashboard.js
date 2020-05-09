/*
 * Author: Abdullah A Almsaeed
 * Date: 4 Jan 2014
 * Description:
 *      This is a demo file used only for the main dashboard (index.html)
 **/


let Gallery = {
    prev:false,
    current: false,
    dragstart:function(event) {
        console.log('gallery dragstart');
        Gallery.prev = event.target;
    },
    dragenter:function(event) {
        if (Gallery.prev === event.target) return true;
        console.log('gallery dragenter');
        Gallery.current = event.target;
    },
    clear:function() {
        console.log('gallery clear');
        if (Gallery.prev) {
            let input = Gallery.prev.querySelector('input');
            if (input.form.dataset.hasOwnProperty('menu')) {
                fetch('/admin/media/delete/' + input.form.dataset.menu + '/' + input.value)
                    .then(function(response) {
                        return response.text();
                    })
                    .then(function(response) {
                        console.log(response);
                        Gallery.prev.parentNode.parentNode.removeChild(Gallery.prev.parentNode);
                    });
            } else {
                fetch('/admin/pages/delete/' + input.value)
                    .then(function(response) {
                        return response.text();
                    })
                    .then(function(response) {
                        console.log(response);
                        Gallery.prev.parentNode.parentNode.removeChild(Gallery.prev.parentNode);
                    });
            }
        }
    },
    clearAudio:function() {
        console.log('gallery clear');
        if (Gallery.prev) {
            let input = Gallery.prev.querySelector('input');
            fetch('/admin/audio/delete/' + input.value)
                .then(function(response) {
                    return response.text();
                })
                .then(function(response) {
                    console.log(response);
                    Gallery.prev.parentNode.parentNode.removeChild(Gallery.prev.parentNode);
                    window.location.reload();
                });
        }
    },
    allowdrop:function(event) {
        event.preventDefault();
    },
    swap:function(a, b) {
        let aParent = a.parentNode;
        let bParent = b.parentNode;


        /*
        let aHolder = document.createElement("div");
        let bHolder = document.createElement("div");


        aParent.replaceChild(aHolder,a);
        bParent.replaceChild(bHolder,b);

        aParent.replaceChild(b,aHolder);
        bParent.replaceChild(a,bHolder);
        */
        aParent.parentElement.insertBefore(bParent, aParent);
        console.log('gallery item swaped!');
    },
    drop:function() {
        console.log('gallery item dropped!');
        if (Gallery.current && Gallery.prev) {
            Gallery.swap(Gallery.current, Gallery.prev);
            let form = document.querySelector('form');
            if (form.dataset.hasOwnProperty('menu')) {
                let photoCollection = document.querySelectorAll('.photo input');
                let items = [];
                photoCollection.forEach(function(item) {
                    items.push(item.value);
                });
                let data = new FormData()
                data.append('items', items);
                fetch('/admin/media/switch/' + form.dataset.menu , {
                    method: 'POST',
                    body: data
                }).then(function(response) {
                    return response.text();
                }).then(function(response) {
                    console.log(response);
                });
            }
            else {
                let menuCollection = document.querySelectorAll('.item.page input');
                let items = [];
                menuCollection.forEach(function(item) {
                    items.push(item.value);
                });
                let data = new FormData()
                data.append('items', items);
                fetch('/admin/pages/switch', {
                    method: 'POST',
                    body: data
                }).then(function(response) {
                    return response.text();
                }).then(function(response) {
                    console.log(response);
                });
            }
        }
    }
};
$(document).ready(function() {
    console.log('admin');
    tinymce.init({
        selector: '#description',  // change this value according to your HTML
        setup : function(ed) {
            ed.on('KeyUp', function (e) {
                tinyMCE.activeEditor.targetElm.innerText = tinyMCE.activeEditor.getContent();
                Form.Changed(tinyMCE.activeEditor.targetElm);
            });
        }
    });
    let fileInput = document.querySelector('#file-select');
    if (fileInput) {
        fileInput.oninput = FileUpload;
    }
    let audioInput = document.querySelector('#audio-select');
    if (audioInput) {
        audioInput.oninput = AudioUpload;
    }
});

let Form = {
    Changed: function(element) {
        if (element.form.dataset.menu !== '') {
            let data = new FormData()
            data.append('value', element.value);
            fetch('/admin/pages/update/' + element.form.dataset.menu + '/' + element.name, {
                method: 'POST',
                body: data
            }).then(function(response) {
                return response.text();
            }).then(function(response) {
                console.log(response);
            });
        } else {
            console.log(1);
        }

    }
}
let FileUpload = function(e) {
    e.preventDefault();
    let input = e.target;
    if (input.files) {
        let fileCollection = input.files;
        fetch('/admin/views/item.tmpl')
            .then(function(response) {
                return response.text();
            })
            .then(function(template) {
                for (let index = 0; index < fileCollection.length; index++) {
                    let file = fileCollection[index];
                    let reader = new FileReader();
                    let completeEvent = function(e) {
                        let gallery = document.querySelector('.gallery');
                        let div = document.createElement('div');
                        div.className = 'col-md-2 item photo loading';
                        div.innerHTML = Mustache.render(template, {
                            menu: input.form.dataset.menu,
                            image: e.target.result,
                            name: this.name
                        })
                        gallery.appendChild(div);
                        let data = new FormData()
                        data.append('media', this.binary);
                        fetch('/admin/media/upload/' + input.form.dataset.menu, {
                            method: 'POST',
                            body: data
                        }).then(function(response) {
                            return response.text();
                        }).then(function(response) {
                            div.classList.remove('loading');
                        });
                    };
                    let extension = file.name.split('.')[1];
                    reader.onload = completeEvent.bind({
                        name: md5(file.name) + '.' + extension.toLowerCase(),
                        binary: file
                    });
                    reader.readAsDataURL(file);
                }
            });
    }
}
let AudioUpload = function(e) {
    e.preventDefault();
    let input = e.target;
    if (input.files && input.files[0]) {
        let reader = new FileReader();
        reader.onload = function (e) {
            let data = new FormData()
            data.append('media', input.files[0]);
            fetch('/admin/audio/upload', {
                method: 'POST',
                body: data
            }).then(function(response) {
                return response.text();
            }).then(function(response) {
                window.location.reload();
            });
        }
        reader.readAsDataURL(input.files[0]);
    }
}
let AddMenu = function() {
    let index = String(document.querySelectorAll('.item.page').length);
    let name = prompt('Dá um nome ao menu!', 'menu' + index);
    if (name) {
        let data = new FormData()
        data.append('index', index);
        data.append('name', name);
        fetch('/admin/pages/create', {
            method: 'POST',
            body: data
        }).then(function(response) {
            return response.text();
        }).then(function(response) {
            window.location.reload();
        });
    }
}

