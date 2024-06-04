<h2>Nombre de coureur qui peut participer : <span><?=$etape['nombre_coureur']?></span></h2>
<form method="post" action="<?php echo site_url("/Equipe/affecter");?>">
<input type="hidden" name="id_etape" value="<?=$etape['id_etape']?>">
    <fieldset class="form-fieldset">
    <?php for ($i=0; $i < count($all); $i++) {?>

        <div class="mb-3">
            <label class="form-label required"><?=$all[$i]['nom']?></label>
            <input type="checkbox" name="id_coureur[]" value="<?=$all[$i]['id_coureur']?>">
        </div>
        <?php } ?>
    </fieldset>
    <div class="card-footer text-end">
        <button type="submit" class="btn btn-primary">Entree</button>
    </div>

</form>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');
    let checkedCount = 0;
  
    checkboxes.forEach(checkbox => {
      checkbox.addEventListener('change', function() {
        console.log(checkedCount);
        if (this.checked) {
          checkedCount++;
          if (checkedCount > <?=$etape['nombre_coureur']-count($chrono)?>) {
            this.checked = false;
            checkedCount--;
          }
        } else {
          checkedCount--;
        }
      });
    });
  });
</script>


