<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="col-md-2 item">
    <div draggable="true" ondragstart="Gallery.dragstart(event)" ondragenter="Gallery.dragenter(event);">
        <?php echo $link; ?>
        <input type="hidden" name="page[items][]" value="<?php echo $src; ?>" />
    </div>   
</div>
