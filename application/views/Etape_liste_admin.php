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
                        <td><?=$all[$i]['rang']?></td>
                        <td><?=$all[$i]['nom']?></td>
                        <td><?=$all[$i]['longueur']?></td>
                        <td><?=$all[$i]['nombre_coureur']?></td>
                        <td><?=$all[$i]['date_debut']?></td>
                        
                        <td>
                            <div class="btn-list flex-nowrap">
                               
                                    <a href="<?php echo site_url("admin/affectTemps/".$all[$i]['id_etape'])?>"
                                    class="btn"> 
                                    Affecter le temps </a>
                               
                            </div>
                        </td>
                       
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>