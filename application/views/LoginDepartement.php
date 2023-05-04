<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
</head>
<body>
    <div class="row" style="margin-left:38%;margin-top:10%;width :500px;box-shadow: 10px 5px 5px grey;">
    <h2>Chef de département</h2>
    <form action="<?php echo base_url('DemandeAchatController/loginChefDepartement'); ?>" method="get">
        <div style="width:400px;height:300px;margin-left:50px;margin-top:20px;">
            <div class="form-group">
                <label class="col-lg-3 control-label">Matricule:</label>
                <input type="text" class="form-control" name="email" id="" value="lova@gmail.com">
            </div>
            <div class="form-group">
                <label class="col-lg-3 control-label">Password:</label>
                <input type="password" class="form-control" name="mdp" id="" value="lova">
            </div>
            <div class="form-group">
                <button type="submit" class="form-control btn btn-primary">Log in</button>
            </div>
        </div>
        <p style="color:red;text-align:center"><?php if(isset($message)){ echo $message; } ?></p>
    </form>
    </div>
    <p style="text-align:center;margin-top:20px"><a href="<?php echo base_url('Welcome/indexAppro') ?>">Se connecter en tant que chef d'approvisionnement</a></p>
</body>
</html>