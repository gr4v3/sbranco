<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<form action="http://dev.sbranco.pt/admin/" enctype="multipart/form-data" method="post" accept-charset="utf-8">
    <div class="form-group">
        <label class="control-label col-sm-4"for="title">Nome do menu:</label>
        <div class="col-sm-6"><input type="text" class="form-control" id="title" name="page[title]" value="<?php echo $title; ?>"></div> 
        <input type="hidden" name="page[link]" value="<?php echo $link; ?>" />
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4"for="audio">Escolha uma música de fundo:</label>
        <div class="col-sm-2">
            <select class="form-control" id="audio" name="page[audio]">
                <?php 
                    $audios = scandir('../assets/audio');
                    foreach($audios as $item) {
                       if (in_array($item, array('.', '..'))) continue;
                       if ($item === $audio) echo "<option value=\"$item\" selected>$item</option>";
                       else echo "<option value=\"$item\">$item</option>";
                    }
                ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4"for="background">Cor do background:</label>
        <div class="col-sm-8"><input type="color" class="form-control" id="background" name="page[background]" value="<?php echo $background; ?>"></div>

    </div>
    <div class="form-group">
        <label class="control-label col-sm-4"for="type">Tipo de galeria:</label>
        <div class="col-sm-2">
            <select class="form-control" id="type" name="page[type]">
                <option value="slide">slideshow horizontal</option>
                <option value="vertical">slideshow vertical</option>
            </select>
        </div>

    </div>
    <div class="form-group">
        <label class="control-label col-sm-12"for="type">Fotografias:</label>
        <div class="col-sm-12 gallery">
            <div class="col-md-2 item add">
                <label class="fa fa-plus" for="file-select">
                    <input type="file" id="file-select" name="photos[]" multiple style="display:none;"/>
                </label>
            </div>
            <div ondrop="Gallery.clear()"  ondragover="Gallery.allowdrop(event)" class="col-md-2 item fa fa-trash">
                <div>arraste para aqui se deseja apagar a foto</div>
            </div>
            <?php 
                echo $gallery;
            ?>
            
        </div>
    </div>
     <div class="form-group"> 
        <div class="col-sm-offset-4 col-sm-8">
          <input type="submit" class="btn btn-info" value="Submeter">
          <a href="/admin" class="btn btn-danger">Voltar Atrás</a>
        </div>
      </div>
</form>


