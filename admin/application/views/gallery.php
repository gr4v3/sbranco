<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<form >
<div class="container-fluid">
    <div class="container-fluid gallery">
        <div class="col-md-2 item add">
            <a href="javascript:AddMenu();">
                <label class="fa fa-plus">
                    <span>adicione um menu clicando aqui</span>
                </label>
            </a>
        </div>
        <div class="col-md-2 item delete" ondrop="Gallery.clear()"  ondragover="Gallery.allowdrop(event)">
            <label class="fa fa-trash">
                <span>arraste para aqui se deseja apagar a foto</span>
            </label>
        </div>
        <?php 
            echo $items;
        ?>
    </div>
</div>
</form>