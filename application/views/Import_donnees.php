<form method="post" action="<?=base_url("/admin/importD");?>" enctype="multipart/form-data">
    <fieldset class="form-fieldset">
    <div class="mb-3">
        <label class="form-label">Etapes</label>
        <input type="file" name="etape" id="" class="form-control" required accept=".csv">
    </div>
    <div class="mb-3">
        <label class="form-label">Resultat</label>
        <input type="file" name="resultat" id="" class="form-control" required accept=".csv">
    </div>
    </fieldset>
    <div class="card-footer text-end">
        <button type="submit" class="btn btn-primary">Import Csv</button>
    </div>
</form>