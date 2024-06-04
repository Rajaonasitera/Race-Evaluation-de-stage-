<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <link href=<?php echo site_url("assets/css/tabler.min.css?1684106062")?> rel="stylesheet"/>
    <link href=<?php echo site_url("assets/css/tabler-flags.min.css?1684106062")?> rel="stylesheet"/>
    <link href=<?php echo site_url("assets/css/tabler-payments.min.css?1684106062")?> rel="stylesheet"/>
    <link href=<?php echo site_url("assets/css/tabler-vendors.min.css?1684106062")?> rel="stylesheet"/>
    <link href=<?php echo site_url("assets/css/demo.min.css?1684106062")?> rel="stylesheet"/>
    <title><?=$titre?></title>
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
  <body  class=" border-top-wide border-primary d-flex flex-column">
    <script src="./dist/js/demo-theme.min.js?1684106062"></script>
    <div class="page page-center">
      <div class="container-tight py-4">
        <div class="empty">
          <div class="empty-header">Error</div>
          <p class="empty-title">Oops…</p>
          <p class="empty-title"><?=$erreur?></p>
          <div class="empty-action">
            <a href="<?=base_url("article/annuler")?>" class="btn btn-primary">
              Retour
            </a>
            <a href="<?=base_url("article/valider")?>" class="btn btn-primary">
              Inserer tout les autres
            </a>
          </div>
        </div>
      </div>
    </div>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="./dist/js/tabler.min.js?1684106062" defer></script>
    <script src="./dist/js/demo.min.js?1684106062" defer></script>
  </body>
</html>