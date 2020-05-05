<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<form>
<div class="container-fluid">
    <div class="container-fluid gallery">
        <div class="col-md-2 item add">
            <label class="fa fa-plus" for="audio-select">
                <input type="file" id="audio-select" name="audio" accept="audio/mp3,audio/*" multiple style="display:none;"/>
                <span>clique aqui para adicionar 1 audio</span>
            </label>
        </div>
        <div class="col-md-2 item delete" ondrop="Gallery.clearAudio()"  ondragover="Gallery.allowdrop(event)">
            <label class="fa fa-trash">
                <span>arraste para aqui se deseja apagar o audio</span>
            </label>
        </div>
        <?php 
            echo $items;
        ?>
    </div>
</div>
</form>
