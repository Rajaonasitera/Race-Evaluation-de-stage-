<form method="post" action="<?php echo site_url("admin/ajouter");?>">
    <fieldset class="form-fieldset">
        <div class="mb-3">
        <label class="form-label">Etape</label>
        <select name="id_etape" id=""  class="form-select" >
                <?php
                for ($i=0; $i < count($etape); $i++) { ?>
                <option value="<?=$etape[$i]['id_etape']?>"><?=$etape[$i]['nom']?></option>
                <?php } ?>
            </select>
        </div>
        <div class="mb-3">
        <label class="form-label">Equipe</label>
        <select name="id_equipe" id=""  class="form-select" >
                <?php for ($i=0; $i < count($equipe); $i++) { ?>
                <option value="<?=$equipe[$i]['id_equipe']?>"><?=$equipe[$i]['nom']?></option>
                <?php } ?>
            </select>
        </div>
        <div class="mb-3">
        <label class="form-label">Temps</label>
        <input type="time" step="1" class="form-control" name="temps" value="00:00:00">
        </div>
    </fieldset>
    <div class="card-footer text-end">
        <button type="submit" class="btn btn-primary">Entree</button>
    </div>

</form>