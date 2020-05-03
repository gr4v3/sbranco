<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<form target="pages-form-target" action="https://sandrabranco.org/admin/pages/index/<?php echo $link; ?>?type=ajax" enctype="multipart/form-data" method="post" accept-charset="utf-8">
    <div class="form-group">
        <label class="control-label col-sm-4"for="title">Nome do menu:</label>
        <div class="col-sm-6"><input type="text" class="form-control" id="title" name="page[title]" value="<?php echo $title; ?>"></div> 
        <input type="hidden" name="page[link]" value="<?php echo $link; ?>" />
        <input type="hidden" name="page[index]" value="<?php echo $index; ?>" />
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4"for="audio">Escolha uma música de fundo:</label>
        <div class="col-sm-2">
            <select class="form-control" id="audio" name="page[audio]">
                <option value=" ">nenhum</option>
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
        <label class="control-label col-sm-4"for="description">Descrição:</label>
        <div class="col-sm-8">
            <textarea class="form-control" id="description" name="page[description]" ><?php echo $description; ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4"for="background">Cor do background:</label>
        <div class="col-sm-8"><input type="color" class="form-control" id="background" name="page[background]" value="<?php echo $background; ?>"></div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4"for="background">Cor da letra:</label>
        <div class="col-sm-8"><input type="color" class="form-control" id="background" name="page[fontcolor]" value="<?php echo isset($fontcolor)?$fontcolor:'#ffffff'; ?>"></div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4"for="background">Cor da border:</label>
        <div class="col-sm-8"><input type="color" class="form-control" id="background" name="page[bordercolor]" value="<?php echo isset($bordercolor)?$bordercolor:'#ffffff'; ?>"></div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4"for="background">Cor do background do header:</label>
        <div class="col-sm-8"><input type="color" class="form-control" id="background" name="page[headercolor]" value="<?php echo isset($headercolor)?$headercolor:'#ffffff'; ?>"></div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4"for="background">Cor da fonte do header:</label>
        <div class="col-sm-8"><input type="color" class="form-control" id="background" name="page[headerbackground]" value="<?php echo isset($headerbackground)?$headerbackground:'#ffffff'; ?>"></div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-12"for="type">Fotografias:</label>
        <div class="col-sm-12 gallery">
            <div class="col-md-2 item add">
                <label class="fa fa-plus" for="file-select">
                    <input data-menu="<?php echo $link; ?>" type="file" id="file-select" name="photos[]" accept="image/png, image/jpeg, image/jpg" multiple style="display:none;"/>
                    <span>pode incluir mais que uma foto</span>
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
<iframe name="pages-form-target" style="display:none;"></iframe>


