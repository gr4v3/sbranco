<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="col-md-2 item">
    <a href="/admin/pages/index/<?php echo $link; ?>">
        <?php 
            if (empty($items)) {
                ?><div><?php echo $title; ?></div><?php
            } else {
                ?><div style="background-image:url(<?php echo '/assets/pages/' . $link . '/' . current($items); ?>);"></div><?php
            }
        ?>
    </a>    
</div>