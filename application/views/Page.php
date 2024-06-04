<?php
    if (!isset($_SESSION['user'])) {
        redirect('connexion');
    }else{
        $user = $_SESSION['user'];
        $isAdmin = $_SESSION['isAdmin'];
        header('Content-Type: text/html; charset=utf-8');
        if ($isAdmin==true) {
            $type = 'Admin';
        }else{
            $type = $user['nom'];
        }
        
?>
<html lang="en">

<head>
<meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link href=<?php echo base_url("assets/css/tabler.min.css?1684106062")?> rel="stylesheet" />
    <link href=<?php echo base_url("assets/css/tabler-flags.min.css?1684106062")?> rel="stylesheet" />
    <link href=<?php echo base_url("assets/css/tabler-payments.min.css?1684106062")?> rel="stylesheet" />
    <link href=<?php echo base_url("assets/css/tabler-vendors.min.css?1684106062")?> rel="stylesheet" />
    <link href=<?php echo base_url("assets/css/demo.min.css?1684106062")?> rel="stylesheet" />
    <link rel="icon" type="image/png" href="<?php echo base_url("assets/img/logo1.png")?>">
    <title>Ultimate Team Race </title>
    <style>
    @import url('https://rsms.me/inter/inter.css');

    :root {
        --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
    }

    body {
        font-feature-settings: "cv03", "cv04", "cv11";
    }
    </style>
</head>
<script src=<?php echo base_url("assets/js/demo-theme.min.js?1684106062")?>></script>


<body>
    <style>
        .bla{
            background-size: 0%;
        }
    </style>
    
<header class="navbar navbar-expand-md d-print-none" style="height:200px; background-image:url('<?php echo base_url("assets/img/run-word-concept-banner-vector-26296818.jpg")?> '); background-size: contain;">
    <div class="container-xl">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu"
            aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
            <a href="." style = "color:#f44336; font-size:15px;">
            Ultimate Team Race
                <img src=<?php echo base_url("assets/img/Picture1.png")?> width="110" height="32"
                    class="navbar-brand-image">
                
            </a>
        </h1> -->
        <!-- <div class="navbar-nav flex-row order-md-last" >
            <div class="d-none d-md-flex">
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                        aria-label="Open user menu">
                        <span class="avatar avatar-sm"
                            style="background-image: url(<?php echo base_url("assets/img/pdp.png")?>)"></span>
                        <div class="d-none d-xl-block ps-2">
                            <div><?=$type?></div> -->
                            <!-- <div class="mt-1 small text-muted"><?=$user['nom']?></div> -->
                        <!-- </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <a href="#" class="dropdown-item">Profile</a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">Settings</a>
                        <a href="#" class="dropdown-item">Logout</a>
                    </div>
                </div>
            </div>
        </div> -->
</header>


<header class="navbar-expand-md">
    <div class="collapse navbar-collapse" id="navbar-menu">
        <div class="navbar">
            <div class="container-xl">
                <ul class="navbar-nav">
                    
                    <?php if ($isAdmin==true) { ?>
                        <!-- --- -->
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url("Admin")?>">
                                <span class="nav-link-title">
                                    Liste
                                </span>
                            </a>
                        </li>
                        <!-- --- -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown"
                                data-bs-auto-close="outside" role="button" aria-expanded="false">
                                <span class="nav-link-title">
                                    Import
                                </span>
                            </a>
                            <div class="dropdown-menu">
                                <div class="dropdown-menu-columns">
                                    <div class="dropdown-menu-column">
                                        <a class="dropdown-item" href="<?php echo base_url("Admin/importDonnees")?>">
                                            Donnees
                                        </a>
                                        <a class="dropdown-item" href="<?php echo base_url("Admin/importPoints")?>">
                                            Points
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li> 
                        <!-- --- -->
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url("Admin/listePenalite")?>">
                                <span class="nav-link-title">
                                    Penalite
                                </span>
                            </a>
                        </li>
                    
                        <!-- --- -->
                         <!-- --- -->
                         <!-- <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url("Admin/pdf")?>">
                                <span class="nav-link-title">
                                    Pdf
                                </span>
                            </a>
                        </li> -->
                    
                        <!-- --- -->
                    <?php } ?>
                    <?php if ($isAdmin==false) { ?>
                        <!-- --- -->
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url("equipe/")?>">
                                <span class="nav-link-title">
                                    Liste 
                                </span>
                            </a>
                        </li>
                        <!-- --- -->
                    <?php } ?>

                    <!-- --- -->
            

                    <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown"
                                data-bs-auto-close="outside" role="button" aria-expanded="false">
                                <span class="nav-link-title">
                                    Classement
                                </span>
                            </a>
                            <div class="dropdown-menu">
                                <div class="dropdown-menu-columns">
                                    <div class="dropdown-menu-column">
                                        <a class="dropdown-item" href="<?php echo base_url("All/classementEtape")?>">
                                            Par etape
                                        </a>
                                        <a class="dropdown-item" href="<?php echo base_url("All/classementEquipe")?>">
                                            Par equipe
                                        </a>
                                        <a class="dropdown-item" href="<?php echo base_url("All/classementGeneral")?>">
                                            General
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li> 

                    <li class="nav-item">
                        <!-- <a class="nav-link" href="<?php echo base_url("connexion/deconnexion")?>" data-bs-auto-close="outside"
                            role="button" aria-expanded="false">
                            <span class="nav-link-title">
                                Deconnexion
                            </span>
                        </a> -->
                    </li>

                </ul>
                <!-- <div style="margin-top:10px;">
                <form action="#" method="get" autocomplete="off" novalidate >
                  <div class="input-icon">
                    <span class="input-icon-addon">
                       Download SVG icon from http://tabler-icons.io/i/search -->
                      <!-- <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" /><path d="M21 21l-6 -6" /></svg>
                    </span>
                    <input type="text" value="" class="form-control" placeholder="Search…" aria-label="Search in website">
                  </div>
                </form>
              </div> --> 
              <div class="navbar-nav flex-row order-md-last" >
            <div class="d-none d-md-flex">
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                        aria-label="Open user menu">
                        <span class="avatar avatar-sm"
                            style="background-image: url(<?php echo base_url("assets/img/pdp.png")?>)"></span>
                        <div class="d-none d-xl-block ps-2">
                            <div><?=$type?></div> 
                            <!-- <div class="mt-1 small text-muted"><?=$user['nom']?></div> -->
                         </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <a class="nav-link" href="<?php echo base_url("connexion/deconnexion")?>" data-bs-auto-close="outside"
                            role="button" aria-expanded="false">
                            <span class="nav-link-title">
                                Deconnexion
                            </span>
                        </a>
                        <!-- <a href="#" class="dropdown-item">Profile</a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">Settings</a>
                        <a href="#" class="dropdown-item">Logout</a> -->
                    </div>
                </div>
            </div>
        </div> 
            </div>
        </div>
    </div>
</header>



    <div class="page">
        <!-- Navbar -->
        <div class="page-wrapper">
            <!-- Page header -->
            <div class="page-header d-print-none">
                <div class="container-xl">
                    <div class="row g-2 align-items-center">
                        <div class="col">
                            <h2 class="page-title"><?=$titre?></h2>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    <!-- Content here -->
                    <?php include($view . ".php"); ?>

                </div>
            </div>
        </div>
    </div>


    <footer class="footer footer-transparent d-print-none">
        <div class="container-xl">
            <div class="row text-center align-items-center flex-row-reverse">
                <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                    <ul class="list-inline list-inline-dots mb-0">
                        <li class="list-inline-item">
                            Copyright &copy; ETU1814
                            <a href="." class="link-secondary">Tatiana</a>. All rights reserved.
                        </li>
                        <li>
                            <?php if ($isAdmin==true) {?>
                                <a href="<?=base_url("connexion/truncate")?>" class="btn">
              Reinitialiser la base
            </a>
            <a href="<?=base_url("connexion/gerer")?>" class="btn">
              Generer les categories
            </a>
                           <?php } ?>
                        
                    </li>
                    <li>
                        
                    </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <script src=<?php echo base_url("assets/js/tabler.min.js?1684106062")?> defer></script>
    <script src=<?php echo base_url("assets/js/demo.min.js?1684106062")?> defer></script>
</body>

</html>
<?php } ?>