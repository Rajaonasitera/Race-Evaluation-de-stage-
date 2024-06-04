<form method="post" action="<?=base_url("/admin/importP");?>" enctype="multipart/form-data">
    <fieldset class="form-fieldset">
    <div class="mb-3">
        <label class="form-label">Points</label>
        <input type="file" name="points" id="" class="form-control" required accept=".csv">
    </div>
    </fieldset>
    <div class="card-footer text-end">
        <button type="submit" class="btn btn-primary">Import Csv</button>
    </div>
</form>