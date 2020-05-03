/*
 * Author: Abdullah A Almsaeed
 * Date: 4 Jan 2014
 * Description:
 *      This is a demo file used only for the main dashboard (index.html)
 **/


let Gallery = {
    prev:false,
    dragstart:function(event) {
        console.log('gallery dragstart');
        Gallery.prev = event.target;
    },
    dragenter:function(event) {
        if (Gallery.prev === event.target) return true;
        console.log('gallery dragenter');
        if (!Gallery.prev) return false;
        Gallery.swap(event.target, Gallery.prev);
    },
    clear:function() {
        console.log('gallery clear');
        if (Gallery.prev) Gallery.prev.parentNode.parentNode.removeChild(Gallery.prev.parentNode);
        let form = document.getElementsByTagName('form');
        if (form.length) {
            form[0].submit();
        }
    },
    allowdrop:function(event) {
        event.preventDefault();
    },
    swap:function(a, b) {
        let aParent = a.parentNode;
        let bParent = b.parentNode;

        let aHolder = document.createElement("div");
        let bHolder = document.createElement("div");

        aParent.replaceChild(aHolder,a);
        bParent.replaceChild(bHolder,b);

        aParent.replaceChild(b,aHolder);
        bParent.replaceChild(a,bHolder);
    },
    drop:function() {
        console.log('gallery item dropped!');
        let form = document.getElementsByTagName('form');
        if (form.length) {
            form[0].submit();
        }
    }
};
$(document).ready(function() {
    console.log('admin');

    tinymce.init({
        selector: 'textarea',  // change this value according to your HTML
        plugin: 'a_tinymce_plugin',
        a_plugin_option: true,
        a_configuration_option: 600,
        height : 168
    });

    let fileUpload = document.querySelector('input#file-select');
    if (fileUpload) {
        console.log(fileUpload);
        fileUpload.oninput = FileUpload;
    }
});

let FileUpload = function(e) {
    e.preventDefault();
    let input = e.target;
    if (input.files && input.files[0]) {
        let reader = new FileReader();
        reader.onload = function (e) {
            // update also the user media
            let data = new FormData()
            data.append('media', input.files[0]);
            fetch('/admin/media/index/' + input.dataset.menu, {
                method: 'POST',
                body: data
            }).then(function(response) {
                return response.text();
            }).then(function(response) {
                console.log(response);
                fetch('/admin/views/item.tmpl')
                    .then(function(response) {
                        return response.text();
                    })
                    .then(function(template) {
                        let item = Mustache.render(template, {
                            menu: input.dataset.menu,
                            image: e.target.result,
                            name: input.files[0].name
                        })
                        let gallery = document.querySelector('.gallery');
                        let div = document.createElement('div');
                        div.className = 'col-md-2 item';
                        div.innerHTML = item
                        gallery.appendChild(div);
                    });
            });


            /*
            Main.Request.Api.Private('/users/' + userId + '/media').File(data)
                .then(function(response) {
                    showErrorMsg(input.form, 'success', 'Cool! Your avatar changed!.');
                    let holder = input.closest('form').querySelector('.kt-avatar__holder');
                    holder.style.cssText = 'background-image: url(' + e.target.result + ')';
                }).catch(function(response) {
                showErrorMsg(input.form, 'danger', 'Something went terribly wrong!.');
            });

             */
        }
        reader.readAsDataURL(input.files[0]);
    }
}

