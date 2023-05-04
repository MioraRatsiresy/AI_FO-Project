<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo site_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <title>Bon de Réception</title>
    <?php
    $this->load->helper('url_helper');
    ?>
</head>

<body>
    <div class="container">
        <?php
        if (count($bc) == 0) { ?>
            <p>Aucun commande pour pouvoir généner un bon de réception</p>
        <?php } else { ?>
            <select name="commande" id="commande" onclick="afficherBR();">
                <?php foreach ($bc as $bc) { ?>
                    <option value="<?php echo $bc['idbc']; ?>">Commande <?php echo $bc['numero']; ?> -- <?php echo $bc['nomfournisseur']; ?></option>
                <?php } ?>
            </select>
        <?php
        }
        ?>
        <div id="search-result">

        </div>
        <a class="btn btn-primary" href="<?php echo site_url('Welcome/indexBon'); ?>">Retour</a>
    </div>
    <script>
        function afficherBR() {
            const xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText);
                    document.getElementById("search-result").innerHTML = this.responseText;
                }
            }
            xmlhttp.open("GET", "<?php echo base_url('Welcome/BRinformation?idbc=');?>"+ document.getElementById("commande").value);
            xmlhttp.send();
        }

        function checkQuantite(id) {
            var total = document.getElementById('total').innerHTML;
            var quantite = document.getElementById('quantite:' + id).value;
            document.getElementById('quantiterestant:' + id).value = parseFloat(total) - quantite;
        }
    </script>
    <script src="<?php echo site_url('assets/js/jquery.js') ?>"></script>
    <script src="<?php echo site_url('assets/js/bootstrap.min.js') ?>"></script>
</body>

</html>