<?php $ci = &get_instance();?>
<div class="col-12">
    <div class="card">
        <div class="table-responsive">
            <table class="table table-vcenter table-mobile-md card-table">
                <thead>
                    <tr>
                        <th>Rang</th>
                        <th>Nom</th>
                        <th>Longueur (km)</th>
                        <th>Nombre de coureur</th>
                        <th>Debut</th>
                        <th class="w-1"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i=0; $i < count($all); $i++) { ?>
                    <tr>
                        <td>
                            <?=$all[$i]['rang']?>
                        </td>
                        <td>
                            <?=$all[$i]['nom']?>
                        </td>
                        <td>
                            <?=$all[$i]['longueur']?>
                        </td>
                        <td>
                            <?=$all[$i]['nombre_coureur']?>
                        </td>
                        <td>
                            <?=$all[$i]['date_debut']?>
                        </td>

                        <td>
                            <div class="btn-list flex-nowrap">
                                <?php if (count($chrono[$i]['chrono'])<$chrono[$i]['etape']['nombre_coureur']) {?>
                                <span class="badge bg-green">Pas Complet</span>
                                <?php } else {?>
                                <span class="badge bg-purple">Complet</span>
                                <!-- <span style="color:#f54936;">Fait</span> -->
                                <?php } ?>
                            </div>
                        </td>

                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="page-body">
    <div class="container-xl">
        <div class="row row-cards">
            <?php for ($i=0; $i < count($chrono); $i++) { ?>
            <div class="col-sm-12 col-lg-4">
                <div class="d-flex align-items-center">
                    <div class="card">

                        <div class="card-body">
                            <h3 style="text-align:center;">
                                <?=$chrono[$i]['etape']['nom']?>
                                <?="(".$chrono[$i]['etape']['longueur']."km)"?>
                            </h3>
                            <div class="table-responsive">
                                <table class="table table-vcenter card-table">
                                    <thead>
                                        <tr>
                                            <th>Nom</th>
                                            <th>Temps Chrono</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php for ($j=0; $j < count($chrono[$i]['chrono']); $j++) { ?>
                                        <tr>
                                            <!-- <td>
                                                <?= $chrono[$i]['chrono'][$j]['coureur']['id_coureur']?>
                                            </td> -->
                                            <td>
                                                <?= $chrono[$i]['chrono'][$j]['coureur']['nom']?>
                                            </td>
                                            <td>
                                                <?= $chrono[$i]['chrono'][$j]['chrono']?>
                                            </td>
                                        </tr>
                                        <?php } ?>


                                    </tbody>
                                </table>
                                <input type="hidden" name="id_etape" value="<?=$chrono[$i]['etape']['id_etape']?>">
                                <div class="card-footer"
                                    style="display:flex; align-item:center; justify-content:center;">
                                    <?php if (count($chrono[$i]['chrono'])<$chrono[$i]['etape']['nombre_coureur']) {?>
                                    <form action="<?php echo site_url("equipe/ajoutCoureur/".$all[$i]['id_etape'])?>" method="post">
                                        <button type="submit" class="btn btn-primary">Affecter un coureur</button>
                                    </form>
                                    <?php } else {?>
                                    <span class="badge bg-purple ">Complet</span>
                                    <?php } ?>

                                </div>


                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>