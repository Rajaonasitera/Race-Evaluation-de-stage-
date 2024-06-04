<?php $ci = &get_instance();?>
<div class="col-12">
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
</div>