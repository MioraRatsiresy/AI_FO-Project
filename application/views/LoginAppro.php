<?php
    $this->load->helper('url_helper');
    $url = base_url('index.php');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/fonts/fontawesome-all.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/Articles-Cards-images.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/Login-Form-Basic-icons.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
    <title>Login Appro</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="row d-flex justify-content-center">
                <div class="col-md-6 col-xl-4" style="margin-top: 5%;">
                    <div class="card mb-5" >
                        <div class="card-body d-flex flex-column align-items-center">
                            <h1>LOG IN</h1>
                            <span style="color: red;"><?php if(!empty($_GET["error"])){echo "Identifiant introuvable";}?></span>
                            <form action="<?php echo $url?>/Welcome/Login" method="POST">
                                <label style="margin-top: 2%;">Matricule :</label>
                                <input class="form-control" type="text" name="log" placeholder="Votre matricule">
                                <label style="margin-top: 2%;">Mot de passe :</label>
                                <input type="password" name="mdp" placeholder="Votre mot de passe" class="form-control">
                                <div style="text-align: center; width: 100%; margin-top: 5%;">
                                    <input class="btn btn-primary" type="submit" value="Se connecter">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <script src="<?php echo base_url('assets/js/jquery.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
</body>

</html>