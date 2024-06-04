<?php
    if (isset($_SESSION['user'])) {
        redirect('welcome');
    }else{
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url("/assets/fonts/material-icon/css/material-design-iconic-font.min.css")?>">
    <link rel="stylesheet" href="<?= base_url("/assets/css/style.css")?>">
    <link rel="shortcut icon" href="<?php echo base_url("assets/img/logo1.png")?>" type="image/x-icon">
    <title>Connexion</title>
</head>

<body style="margin-top:15vh;">
    <section class=" sign-in">
        <div class="container">
            <div class="signin-content">
                <div class="signin-image">
                    <figure><img src="<?= base_url("/assets/img/Picture2.png")?>" alt=" sing up image"></figure>
                    <!-- <h1></h1> -->
                    <!-- <a href="<?= base_url("/connexion/sign")?>" class="signup-image-link">Inscription</a> -->
                    
                </div>

                <div class="signin-form">
                    <h2 class="form-title" style="color: #55ac9d;">Connectez vous</h2>
                    <form method="POST" class="register-form" id="login-form" action="<?= base_url("/connexion/Enter")?>">
                        <div class=" form-group">
                            <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <input type="text" name="email" placeholder="email" required/>
                        </div>
                        <div class="form-group">
                            <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                            <input type="password" name="mdp" id="your_pass" placeholder="Mots de passe" required />
                        </div>
                        <?php if (isset($error)) {
                                    if ($error!=null) {?>
                                <center><p style="color:red;"><?=$error?></p></center>
                    <?php } } ?>

                        <div class="form-group form-button">
                            <input type="submit" name="signin" id="signin" class="form-submit" value="Connexion"
                                style="background-color:#e5a152;" />
                               
                        </div>
                    </form>
            </div>
            </div>
        </div>
    </section>
</body>

</html>
<script src="<?= site_url("/assets/vendor/jquery/jquery.min.js")?>"></script>
<script src="<?= site_url("/assets/js/main.js")?>"></script>
<?php } ?>