<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<form data-menu="<?php echo $link ?>" data-index="<?php echo $index; ?>">
    <div class="form-group">
        <label class="control-label col-sm-4"for="title">Nome do menu:</label>
        <div class="col-sm-6"><input type="text" class="form-control" id="title" name="title" value="<?php echo $title; ?>" onchange="Form.Changed(this);" /></div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4"for="audio">Escolha uma música de fundo:</label>
        <div class="col-sm-2">
            <select class="form-control" id="audio" name="audio" onchange="Form.Changed(this);">
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
        <label class="control-label col-sm-4" for="description">Descrição:</label>
        <div class="col-sm-8">
            <textarea rows="10" class="form-control" id="description" name="description" onchange="Form.Changed(this);"><?php echo $description; ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-12" for="type">Fotografias:</label>
        <div class="col-sm-12 gallery">
            <div class="col-md-2 item add">
                <label class="fa fa-plus" for="file-select">
                    <input type="file" id="file-select" name="photos[]" accept="image/*" multiple style="display:none;"/>
                    <span>clique aqui para adicionar foto</span>
                </label>
            </div>
            <?php 
                echo $gallery;
            ?>
            
        </div>
    </div>
     <div class="form-group"> 
        <div class="col-sm-offset-4 col-sm-8">
          <a href="/admin" class="btn btn-danger">Voltar aos Menus</a>
        </div>
      </div>
</form>


