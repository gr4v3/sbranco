<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="col-md-2 item page">
    <div title="<?php echo $title; ?>" onclick="window.location = '/admin/pages/index/<?php echo $link; ?>';" ondragover="Gallery.allowdrop(event)" ondrop="Gallery.drop(event);" draggable="true" ondragstart="Gallery.dragstart(event)" ondragenter="Gallery.dragenter(event);" style="background-image:url(<?php echo '/img-auto-115/assets/pages/' . $link . '/' . current($items); ?>);">
        <input type="hidden" name="page[]" value="<?php echo $link; ?>" />
    </div>   
</div>
