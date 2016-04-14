<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
echo form_open_multipart();
?>
<div class="form-group">
    <label class="control-label col-sm-2"for="title">Nome do menu:</label>
    <div class="col-sm-10"><input type="text" class="form-control" id="title" name="title" value="<?php echo $title; ?>"></div> 
    
</div>
<div class="form-group">
    <label class="control-label col-sm-2"for="audio">Escolha uma música de fundo:</label>
    <div class="col-sm-10">
        <select class="form-control" id="audio" name="audio">
            <?php 
                $audios = scandir('../assets/audio');
                foreach($audios as $item) {
                   if (in_array($item, array('.', '..'))) continue;
                }
            ?>
        </select>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-sm-2"for="background">Cor do background:</label>
    <div class="col-sm-10"><input type="color" class="form-control" id="background" name="background" value="<?php echo $background; ?>"></div>
    
</div>
<div class="form-group">
    <label class="control-label col-sm-2"for="type">Email address:</label>
    <div class="col-sm-10"><input type="text" class="form-control" id="type" name="type"></div>
    
</div>
 <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Submit</button>
    </div>
  </div>
<?php
echo form_close();

