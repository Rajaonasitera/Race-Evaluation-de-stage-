<div class="card">
    <div class="card-body">
        <h2>Categorie :
            <?=$defaut['libelle']?>
        </h2>
        <form action="<?=base_url("all/classementEquipe/")?>" method="get">
            <div class="col-sm-6 col-lg-3">
                <select name="categorie" id="" class="form-select">
                    <?php
                for ($i=0; $i < count($categorie); $i++) { ?>
                    <?php if ($defaut['id_categorie']==$categorie[$i]['id_categorie']) {?>

                    <option value="<?=$categorie[$i]['id_categorie']?>" selected>
                        <?=$categorie[$i]['libelle']?>
                    </option>
                    <?php }else{?>
                    <option value="<?=$categorie[$i]['id_categorie']?>">
                        <?=$categorie[$i]['libelle']?>
                    </option>
                    <?php }} ?>
                </select>
                <p></p>
                <button type="submit" class="btn bg-purple"
                    style="background-color:#0c0c0c;color:#ffffff;">voir</button>
            </div>
        </form>

        <h3 class="card-title">Classement général par équipe </h3>
        <div id="chart-completion-tasks1"></div>
        <div class="col-12">
            <style>
                .bla {
                    display: flex;
                    justify-content: space-around;
                    width: 100%;
                }
            </style>
            <div class="bla">
                <div class="col-sm-6">
                    <div class="card">
                        <table class="table table-vcenter table-mobile-md card-table">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Points</th>
                                    <th class="w-2"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php for ($i=0; $i < count($general); $i++) { ?>
                                <tr>
                                    <td>
                                        <?=$general[$i]['equipe']['nom']?>
                                    </td>
                                    <td>
                                        <?=$general[$i]['points']?>
                                    </td>
                                    <?php if ($general[$i]['rang']==1&&$_SESSION['isAdmin']==true) {?>
                                        <form action="<?=base_url("admin/pdf")?>" method="post">
                                        <td>
                                        <input type="hidden" name="id_equipe" value="<?=$general[$i]['equipe']['id_equipe']?>">
                                        <input type="hidden" name="points" value="<?=$general[$i]['points']?>">
                    <button type="submit" class="btn btn-danger w-100 btn-icon" data-bs-toggle="modal" data-bs-target="#modal-danger">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" /><path d="M7 11l5 5l5 -5" /><path d="M12 4l0 12" /></svg>
                                </button>
                                </td>
                                </form>
                                    <?php } ?>
                                </tr>
                                <?php } ?>

                            </tbody>
                        </table>
                    </div>
                    <br>
                    <!-- <form action="<?=base_url("all/classementEquipe/")?>" method="post">
                        <button type="submit" class="btn bg-purple"
                            style="background-color:#0c0c0c;color:#ffffff;">Certificat du vainqueur en pdf</button>
                    </form> -->
                </div>
                <div class="col-sm-5">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Equipe</h5>

                            <!-- Pie Chart -->
                            <div id="pieChart" style="min-height: 400px;" class="echart"></div>

                            <!-- End Pie Chart -->

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<div class="page-body">
    <div class="container-xl">
        <div class="row row-cards">
            <?php for ($i=0; $i < count($all); $i++) { ?>
            <div class="col-sm-4 col-lg-4">
                <div class="d-flex align-items-center">
                    <div class="card card-sm">

                        <div class="card-body">
                            <h3 style="text-align:center;">
                                <?=$all[$i]['equipe']['nom']?>
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
                                        <?php for ($j=0; $j < count($all[$i]['classement']); $j++) { ?>
                                        <tr>
                                            <td>
                                                <?= $all[$i]['classement'][$j]['nom']?>
                                            </td>
                                            <td>
                                                <?= $all[$i]['classement'][$j]['somme']?>
                                            </td>
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


<script>
    var data = <?php echo json_encode($general); ?>;

    donnee = [];
    data.forEach(function (element) {
        bla = {
            name: element.equipe.nom + " : " + element.points,
            value: element.points,
        }
        donnee.push(bla)
    });

    document.addEventListener("DOMContentLoaded", () => {
        echarts.init(document.querySelector("#pieChart")).setOption({
            title: {
                text: 'Points par equipe',
                subtext: 'Categorie : ' + <?= json_encode($defaut['libelle']) ?>,
                left: 'center'
            },
            tooltip: {
                trigger: 'item'
            },
            legend: {
                orient: 'vertical',
                left: 'left'
            },
            series: [{
                name: 'Equipe',
                type: 'pie',
                radius: '50%',
                data: donnee,
                emphasis: {
                    itemStyle: {
                        shadowBlur: 10,
                        shadowOffsetX: 0,
                        shadowColor: 'rgba(0, 0, 0, 0.5)'
                    }
                }
            }]
        });
    });
</script>
<script src="<?=base_url("assets/vendor/echarts/echarts.min.js")?>"></script>