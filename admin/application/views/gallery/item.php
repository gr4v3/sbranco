<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="col-md-2 item">
    <a href="/admin/gallery/<?php echo $link; ?>">
        <div style="background-image:url(<?php echo 'http://dev.sbranco.pt/assets/pages/' . $link . '/' . current($items); ?>);"></div>
    </a>    
</div>