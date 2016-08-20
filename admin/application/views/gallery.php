<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<form id="pages-form" target="pages-form-target" action="/admin/pages/update" method="post">
<div class="container-fluid">
    <div class="container-fluid gallery">
        <div class="col-md-2 item add">
            <a href="/admin/pages/index">
                <div class="fa fa-plus"></div>
            </a>
        </div>
        <div ondrop="Gallery.clear()" ondragover="Gallery.allowdrop(event)" class="col-md-2 item fa fa-trash">
            <div>arraste para aqui se deseja apagar a foto</div>
        </div>
        <?php 
            echo $items;
        ?>
    </div>
</div>
</form>
<iframe name="pages-form-target" style="display:none;"></iframe>