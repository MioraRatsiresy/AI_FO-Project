<?php
//$fmt = new NumberFormatter('fr', NumberFormatter::SPELLOUT);
//echo $fmt->format(10000000). ' d\' ariary' ; 
?>
</html>
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
                <li role="presentation" id="1" class="" ><a href="#" onclick="changeActive(1,'listeDemande1')">Demandes</a></li>
                <li role="presentation" id="2" class="active"><a href="#" onclick="changeActive(2,'saisieProforma')">Proforma</a></li>
                <li role="presentation" id="3" class=""><a href="<?php echo base_url('Welcome/indexAppro');?>">Deconnexion</a></li>
            </ul>   
        </div>
        <div id="page" class="col-md-9">
        <div class="container">
        <table class="table table-bordered">
            <h3>Les demandes</h3>
            <?php foreach ($demande as $demande) { ?>
                <tr>
                    <td><?php echo $demande['dategroupage']?></td>
                    <?php 
                    if($demande['nombrebcnonenregistre']>0){?>
                    <td><a href="<?php echo site_url('Welcome/genererBC?date='.$demande['dategroupage']);?>">Generer bon de commande</a></td>
                    <?php } 
                    if($demande['nbbc']>0){?>
                    <td><a href="<?php echo site_url('Welcome/voirBC?date='.$demande['dategroupage']);?>">Voir les bons de commande</a></td>
                    <?php }
                    ?>
                </tr>
            <?php } ?>
        </table>
        <h2>Bon de réception</h2>
        <br/>
        <a href="<?php echo site_url('Welcome/saisiebr');?>"> Saisir un bon de réception</a>
        <br/>
        <a href="<?php echo site_url('Welcome/voirbondereceptionparcommande');?>"> Voir tous les bon de réception</a>
    </div>
    <script src="<?php echo site_url('assets/js/jquery.js') ?>"></script>
    <script src="<?php echo site_url('assets/js/bootstrap.min.js') ?>"></script>
        </div>
       <script>
            function changeActive(indice,target){
                let un = document.getElementById("1");
                let deux = document.getElementById("2");
                un.className = "";
                deux.className = "";
                let chose = document.getElementById(indice);
                chose.className = "active";
                var xhr;
			try {
				xhr = new ActiveXObject('Msxml2.XMLHTTP');
			} catch (e) {
				try {
					xhr = new ActiveXObject('Microsoft.XMLHTTP');
				} catch (e2) {
					try {
						xhr = new XMLHttpRequest();
					} catch (e3) {
						xhr = false;
					}
				}
			}
			xhr.onreadystatechange = function() {
				if (xhr.readyState == 4) {
					if (xhr.status == 200) {
						var retour = xhr.responseText;
                        var page = document.getElementById("page");
                        page.innerHTML = retour;
					} else {
						alert(document.dyn = "Error code " + xhr.status);
					}
				}
			};
			xhr.open("GET", "<?php echo base_url('Welcome');?>/"+target, false);
			xhr.send(null);
              
            }
            function checkProduit(index) {
			var produit = document.getElementById("produit"+index);

			if (produit.checked) {
				document.getElementById("Qualite"+index).style.visibility = "visible";
				document.getElementById("Quantite"+index).style.visibility = "visible";
				document.getElementById("Prix"+index).style.visibility = "visible";
			}

			else{
				document.getElementById("Qualite"+index).style.visibility = "hidden";
				document.getElementById("Quantite"+index).style.visibility = "hidden";
				document.getElementById("Prix"+index).style.visibility = "hidden";
			}
		}

		function validateProforma(listProduit) {
			var checkProduit = false;

			for (var i = 1; i <= listProduit; i++) {
				
				if (document.getElementById("produit"+i).checked) {
					checkProduit = true;
				}

			}

			if (!checkProduit) {
				alert("Error : Please select AT LEAST ONE PRODUCT for the Proforma.");
				return false;
			}
		}
        function moinsDisant(){
            var xhr;
			try {
				xhr = new ActiveXObject('Msxml2.XMLHTTP');
			} catch (e) {
				try {
					xhr = new ActiveXObject('Microsoft.XMLHTTP');
				} catch (e2) {
					try {
						xhr = new XMLHttpRequest();
					} catch (e3) {
						xhr = false;
					}
				}
			}
			xhr.onreadystatechange = function() {
				if (xhr.readyState == 4) {
					if (xhr.status == 200) {
						var retour = xhr.responseText;
                        var page = document.getElementById("page");
                        page.innerHTML = retour;
					} else {
						alert(document.dyn = "Error code " + xhr.status);
					}
				}
			};
			xhr.open("GET", "<?php echo base_url('Welcome/moinsDisant');?>", false);
			xhr.send(null);
              
        }
        </script>
        <script type="text/javascript">
		function noterQualite(index) {
			var formNoterQualite = document.getElementById("formNoterQualite-"+index);
			var noterQualite = document.getElementById("noterQualite-"+index);

			if (noterQualite.checked) {
				formNoterQualite.style.visibility = "visible";
			}
			else{
				formNoterQualite.style.visibility = "hidden";
			}
		}
	</script>
</body>

</html>