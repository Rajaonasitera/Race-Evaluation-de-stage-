
<div class="page-body">
    <div class="container-xl">
        <div class="row row-cards">
            <?php for ($i=0; $i < count($generalEquipe); $i++) { ?>
            <div class="col-sm-4 col-lg-4">
            <div class="d-flex align-items-center">
                <div class="card card-sm">
                
                    <div class="card-body">
                    <h3 style="text-align:center;">
                    <?=$generalEquipe[$i]['etape']['nom']."(".$generalEquipe[$i]['etape']['longueur']." km)"?>
            </h3>
                            <div class="table-responsive">
                                <table class="table table-vcenter card-table">
                                    <thead>
                                        <tr>
                                            <th>Nom</th>
                                            <th>Points</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php for ($j=0; $j < count($generalEquipe[$i]['classement']); $j++) { ?>                         
                                        <tr>
                                            <td><?= $generalEquipe[$i]['classement'][$j]['equipe']['nom']?></td>
                                            <td><?= $generalEquipe[$i]['classement'][$j]['sum']?></td>
                                        </tr>
                                        <?php } ?>
                            
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
<!-- <div class="col-12">
    <div class="card">
        <div class="table-responsive">
            <table class="table table-vcenter table-mobile-md card-table">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Equipe</th>
                        <th>Points</th>
                        <?php for ($i=0; $i < count($etape); $i++) { ?>
                        <th><?=$etape[$i]['nom']?></th>
                            
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i=0; $i < count($general); $i++) { ?>
                    <tr>
                        <td><?=$general[$i]['coureur']['nom']?></td>
                        <td><?=$general[$i]['equipe']['nom']?></td>
                        <td><?=$general[$i]['somme']?></td>
                        <?php for ($j=0; $j < count($etape); $j++) { 
                            $one = $ci->Classement_etape_points_model->getByCoureurEtape($general[$i]['id_coureur'],$etape[$j]['id_etape']);
                            ?>
                        <th><?=$one['points']?></th>
                            
                        <?php } ?>
                        
                       
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div> -->
<div class="page-body">
    <div class="container-xl">
        <div class="row row-cards">
            <?php for ($i=0; $i < count($all); $i++) { ?>
            <div class="col-sm-4 col-lg-5">
            <div class="d-flex align-items-center">
                <div class="card card-sm">
                
                    <div class="card-body">
                    <h3 style="text-align:center;">
                    <?=$all[$i]['etape']['nom']?>
            </h3>
                            <div class="table-responsive">
                                <table class="table table-vcenter card-table">
                                    <thead>
                                        <tr>
                                            <th>Rang</th>
                                            <th>Nom</th>
                                            <th>Equipe</th>
                                            <th>Duree</th>
                                            <th>Points</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php for ($j=0; $j < count($all[$i]['classement']); $j++) { ?>                         
                                        <tr>
                                            <td><?= $all[$i]['classement'][$j]['rang']?></td>
                                            <td><?= $all[$i]['classement'][$j]['nom']?></td>
                                            <td><?= $all[$i]['classement'][$j]['equipe']['nom']?></td>
                                            <td><?= $all[$i]['classement'][$j]['duree']?></td>
                                            <td><?= $all[$i]['classement'][$j]['points']?></td>
                                        </tr>
                                        <?php } ?>
                            
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>