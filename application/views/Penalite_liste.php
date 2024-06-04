<form action="<?=base_url("Admin/ajoutPenalite")?>">
    <button type="submit" class="btn bg-purple" style="background-color:#0c0c0c;color:#ffffff;">Ajouter
        Penalite</button>
</form>
<!-- <br> -->
<div class="col-12">
    <div class="card">
        <div class="table-responsive">
            <table class="table table-vcenter table-mobile-md card-table">
                <thead>
                    <tr>
                        <th>Etape</th>
                        <th>Equipe</th>
                        <th>Temps de penalite</th>
                        <th class="w-1"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i=0; $i < count($all); $i++) { ?>
                    <tr>
                        <td>
                            <?=$all[$i]['etape']['nom']?>
                        </td>
                        <td>
                            <?=$all[$i]['equipe']['nom']?>
                        </td>
                        <td>
                            <?=$all[$i]['temps']?>
                        </td>
                        <td>
                            <a href="#" class="btn btn-danger w-100 btn-icon" data-bs-toggle="modal" data-bs-target="#modal-danger">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M4 7l16 0" />
                                    <path d="M10 11l0 6" />
                                    <path d="M14 11l0 6" />
                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                </svg>
                            </a>
                            <div class="modal modal-blur fade" id="modal-danger" tabindex="-1" role="dialog"
                                aria-hidden="true">
                                <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                        <div class="modal-status bg-danger"></div>
                                        <div class="modal-body text-center py-4">
                                            <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon mb-2 text-danger icon-lg" width="24" height="24"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M10.24 3.957l-8.422 14.06a1.989 1.989 0 0 0 1.7 2.983h16.845a1.989 1.989 0 0 0 1.7 -2.983l-8.423 -14.06a1.989 1.989 0 0 0 -3.4 0z" />
                                                <path d="M12 9v4" />
                                                <path d="M12 17h.01" />
                                            </svg>
                                            <h3>Confirmation de la suppression</h3>
                                            <div class="text-muted">Etes vous sur de vouloir supprimer cette penalite?
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <div class="w-100">
                                                <div class="row">
                                                    <form action="<?=base_url("Admin/supprimerPenalite")?>" method="post">
                                                        <input type="hidden" name="id_etape" value="<?=$all[$i]['etape']['id_etape']?>">
                                                        <input type="hidden" name="id_equipe" value="<?=$all[$i]['equipe']['id_equipe']?>">
                                                        <input type="hidden" name="temps" value="<?=$all[$i]['temps']?>">
                                                        <div class="col-6 col-sm-4 col-md-2 col-xl-auto" style="margin:0%!important;">

                                                            <Button type="submit" class="btn btn-danger w-100 btn-icon">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon"
                                                                    width="24" height="24" viewBox="0 0 24 24"
                                                                    stroke-width="2" stroke="currentColor" fill="none"
                                                                    stroke-linecap="round" stroke-linejoin="round">
                                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                    <path d="M4 7l16 0" />
                                                                    <path d="M10 11l0 6" />
                                                                    <path d="M14 11l0 6" />
                                                                    <path
                                                                        d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                                    <path
                                                                        d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                                </svg>
                                                                <span style="margin-left:20px;">Supprimer</span>
                                                            </Button>

                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>

                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>