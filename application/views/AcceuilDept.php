<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Achat_vente</title>
    <link href="<?php echo base_url('assets/css/bootstrap.css') ;?>" rel="stylesheet"> 
        <link href="<?php echo base_url(); ?>assets/fontawesome-5/css/all.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/chosen.css">
</head>
<body>
    <div class="row">
        <div class="col-md-2" style="margin-left:10px;margin-top:10px;">
            <ul class="nav nav-pills nav-stacked">
                <li role="presentation" class="active"><a href="#">Demande d'achat</a></li>
                <li role="presentation"><a href="<?php echo base_url('Welcome/listeDemandeDept') ?>">Mes demandes</a></li>
                <li role="presentation"><a href="<?php echo base_url('Welcome/index');?>">Deconnexion</a></li>
            </ul>   
        </div>
        <div class="col-md-9">
            <?php include $page;?>
        </div>
        <!-- Button trigger modal -->
</body>

</html>