<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="col-md-2 item">
    <div draggable="true" ondragend="Gallery.drop()" onmouseup="Gallery.drop()" ondragstart="Gallery.dragstart(event)" ondragenter="Gallery.dragenter(event);" style="background-image:url(<?php echo '/img-auto-115/assets/pages/' . $page . '/' . $src; ?>);">
        <input data-menu="<?php echo $page ?>" type="hidden" name="page[items][]" value="<?php echo $src; ?>" />
    </div>   
</div>
