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
                <li role="presentation" ><a href="<?php echo base_url('DemandeAchatController/acc');?>">Demande d'achat</a></li>
                <li role="presentation" class="active"><a href="#">Mes Demande</a></li>
                <li role="presentation"><a href="<?php echo base_url('Welcome/index');?>">Deconnexion</a></li>
            </ul>   
        </div>
        <div class="col-md-9">
        <?php
    $this->load->helper('url_helper');
    $url = base_url('index.php');
?>
    <div class="container">
        <div class="row">
            <h2 style="text-align: center;">LISTES DES DEMANDES</h2>
            <table class="table">
            <tr>
               <th style="width: 20%;"><a href="<?php echo base_url('Welcome/listeDemandeDept?filtre=1'); ?>"><span class="btn btn-primary" style="background-color: #fcdd78; width: 100%; border-color: #fcdd78; color: black;">Enregistrer</span></a></th>
               <th style="width: 20%;"><a href="<?php echo base_url('Welcome/listeDemandeDept?filtre=2'); ?>"><span class="btn btn-primary" style="background-color: #77d792; width: 100%; border-color: #77d792; color: black;">Valider</span></a></th>
               <th style="width: 20%;"><a href="<?php echo base_url('Welcome/listeDemandeDept?filtre=3'); ?>"><span class="btn btn-primary" style="background-color: #ef757a; width: 100%; border-color: #ef757a; color: black;">Refuser</span></a></th>
               <th style="width: 20%;"><a href="<?php echo base_url('Welcome/listeDemandeDept?filtre=4'); ?>"><span class="btn btn-primary" style="background-color: #8ed1ef; width: 100%; border-color: #8ed1ef; color: black;">Inachever</span></a></th>
               <th style="width: 20%;"><a href="<?php echo base_url('Welcome/listeDemandeDept?filtre=5'); ?>"><span class="btn btn-primary" style="background-color: #cecdcd; width: 100%; border-color: #cecdcd; color: black;">Archiver</span></a></th>
            </tr> 
          </tabla>
            <table class="table">
                <tr>
                   <th>Rubrique</th>
                   <th>Designation</th>
                   <th>Quantité</th>
                   <th>Reçu</th>
                   <th>Departement</th>
                   <th>Date</th>
                </tr> 
               <?php foreach ($listeDemande as $key) { 
                if($key['etat']==1) { ?>
                <tr style="background-color: #fcdd78; height: 70px; font-size: 16px;">
                <?php } if($key['etat']==2) {?>
                <tr style="background-color: #77d792; height: 70px; font-size: 16px;">
                <?php } if($key['etat']==3) {?>
                <tr style="background-color: #ef757a; height: 70px; font-size: 16px;">
                <?php } if($key['etat']==4) {?>
                <tr style="background-color: #8ed1ef; height: 70px; font-size: 16px;">
                <?php } if($key['etat']==5) {?>
                <tr style="background-color: #cecdcd; height: 70px; font-size: 16px;">
                <?php } ?>
                   <td><?php echo $key['genre']; ?></td>
                   <td><?php echo $key['designation']; ?></td>
                   <td><?php echo $key['quantite']; ?></td>
                   <td><?php echo $key['recu']; ?></td>
                   <td><?php echo $key['libelledept']; ?></td>
                   <td><?php echo $key['datedemande']; ?></td>
                   
                </tr> 
               <?php } ?>
               
            </table>
        </div>
    </div>
    <script src="<?php echo base_url('assets/js/jquery.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
    <script type="text/javascript">
        function choice(argument) {
            var __choice = document.getElementById("choix");
            if(__choice.value.includes("'"+argument+"',")){
                __choice.value = __choice.value.replace("'"+argument+"',","");
            }else{
                __choice.value += "'" + argument + "',";
            }
        }
    </script>

        </div>
        <!-- Button trigger modal -->
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