<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<form id="pages-form" enctype="multipart/form-data" action="/admin/track" method="post">
<div class="container-fluid">
    <div class="col-md-12 gallery">
        <div class="col-md-2 item add">
                <label class="fa fa-plus" for="file-select">
                    <input type="file" id="file-select" name="audios[]" multiple style="display:none;"/>
                </label>
        </div>
        <!--
        <div ondrop="Gallery.clear()" ondragover="Gallery.allowdrop(event)" class="col-md-2 item fa fa-trash">
            <div>arraste para aqui se deseja apagar o ficheiro</div>
        </div>
        -->
        <?php 
            echo $items;
        ?>
    </div>
</div>
</form>
