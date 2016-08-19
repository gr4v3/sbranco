<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="col-md-2 item">
    <div draggable="true" ondragstart="Gallery.dragstart(event)" ondragenter="Gallery.dragenter(event);">
        <input type="hidden" name="media[]" value="<?php echo $file; ?>" /> 
        <?php echo $file; ?>
    </div>
</div>
