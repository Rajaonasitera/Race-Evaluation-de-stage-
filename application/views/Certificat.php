<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href=<?php echo base_url("assets/css/tabler.min.css?1684106062")?> rel="stylesheet" />
    <link href=<?php echo base_url("assets/css/tabler-flags.min.css?1684106062")?> rel="stylesheet" />
    <link href=<?php echo base_url("assets/css/tabler-payments.min.css?1684106062")?> rel="stylesheet" />
    <link href=<?php echo base_url("assets/css/tabler-vendors.min.css?1684106062")?> rel="stylesheet" />
    <link href=<?php echo base_url("assets/css/demo.min.css?1684106062")?> rel="stylesheet" />
    <link rel="icon" type="image/png" href="<?php echo base_url("assets/img/logo1.png")?>">
    <title>Telechargement</title>
    <style>
        .pdf-container {
            background-image: url('<?= base_url("assets/img/certificat1.png") ?>');
            background-size: cover;
            width: 700px;
            height: 500px;
            position: relative;
        }
        .champion {
            font-size: 30px;
            position: absolute;
            top: 110px;
            left: 247px;
        }
        .theme {
            font-size: 25px;
            position: absolute;
            top: 160px;
            left: 210px;
            font-family:'Angkest';
        }
        .text {
            position: absolute;
            top: 210px;
            left: 240px;
        }
        .equipe {
            position: absolute;
            top: 250px;
            left: 250px;
        }
        .textsuite {
            position: absolute;
            top: 300px;
            left: 130px;
        }
        .felicitation {
            font-size: 12px;
            position: absolute;
            top: 330px;
            left: 110px;
        }
        .date {
            position: absolute;
            top: 362px;
            left: 200px;
        }
        @font-face {
            font-family: 'Angkest';
            src: url('<?=base_url("assets/fonts/Angkest.ttf")?>') format('truetype');
        }
    </style>
</head>
<body>
<script src="./dist/js/demo-theme.min.js?1684106062"></script>
    <div class="page page-center"id="loading" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: white; z-index: 9999; text-align: center; padding-top: 20%;">
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
    <div id="pdf" class="pdf-container">
        <h3 class="champion">Champion 2024</h3>
        <h1 class="theme">ULTIMATE TEAM RACE</h1>
        <p class="text">Ce certificat est décerné à l'équipe</p>
        <h1 class="equipe"><?=$equipe['nom']?></h1>
        <p class="textsuite">pour avoir remporté la 1ère Place de l'Ultimate Team Race avec <?=$points?>pts.</p>
        <h4 class="felicitation">Félicitations à l'équipe pour leur remarquable performance et leur esprit d'équipe exceptionnel.</h4>
        <h5 class="date">10-01-2024</h5>
    </div>
    <script src="<?= base_url("assets/js/html2pdf/dist/html2pdf.bundle.min.js") ?>"></script>
    <script>
        const element = document.getElementById('pdf');
        const opt = {
            margin: 10,
            filename: 'File.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 1 },
            jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' },
            pagebreak: { mode: ['avoid-all'] }
        };

        async function generateAndRedirect() {
            try {
                document.getElementById('loading').style.display = 'block';
                document.getElementById('pdf').style
                await html2pdf().from(element).set(opt).save();
                window.location.href = "<?= base_url("all/classementEquipe") ?>"; // Redirection client
            } catch (error) {
                console.error("Erreur lors de la generation du PDF :", error);
            }
        }

        generateAndRedirect();
    </script>
</body>
</html>
