<?php
date_default_timezone_set('Europe/Moscow'); 
$ci = &get_instance();?>
<?php if (count($all)!=0) {?>
    <form method="post" action="<?php echo site_url("/Admin/affecter");?>">
        <input type="hidden" name="id_etape" value="<?=$etape['id_etape']?>">
        <div class="card">
            <div class="card-body">
                <div class="form-label">TEMPS</div>
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>Nom coureur</th>
                                <th>Equipe</th>
                                <th>Heure de depart</th>
                                <th>Heure d'arriver</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for ($i=0; $i < count($all); $i++) { ?>
                            <tr>
                                <td>
                                    <?=$all[$i]['coureur']['nom']?>
                                </td>
                                <td>
                                    <?=$all[$i]['coureur']['equipe']['nom']?>
                                </td>
                                <td>
                                <?=$etape['date_debut']?>
                                    <input type="hidden" class="form-control"
                                        name="temps_depart_<?=$all[$i]['id_coureur']?>" id="" value="<?=$etape['date_debut']?>">
                                </td>
                                <td>
                                    <?php 
                                    $datetime = new DateTime($etape['date_debut']);
                                    // $defaultDatetime = $dateObject->format('Y-m-d\TH:i');
                                    $date = $datetime->format('Y-m-d\TH:i');
                                    ?>
                                    <input type="datetime-local" class="form-control"
                                        name="temps_arriver_<?=$all[$i]['id_coureur']?>" id="" value="<?=$date?>">
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer text-end">
                <button type="submit" class="btn btn-primary">Entrer</button>
            </div>
        </div>
    </form>
<?php } else {?>
    <script src="./dist/js/demo-theme.min.js?1684106062"></script>
    <div class="page page-center">
      <div class="container container-slim py-4">
        <div class="text-center">
          <div class="mb-3">
            <a href="." class="navbar-brand navbar-brand-autodark"><img src="<?php echo base_url("assets/img/logo1.png")?>" height="36" alt=""></a>
          </div>
          <div class="text-muted mb-3">Vous l'avez deja completé merci!</div>
          <div class="progress progress-sm">
            <div class="progress-bar progress-bar-indeterminate"></div>
          </div>
        </div>
      </div>
    </div>
    <!-- <h1>Vous l'avez deja completé merci!</h1> -->
<?php } ?>