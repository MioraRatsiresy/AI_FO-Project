
<!DOCTYPE html>
<html>
<head>
		<link href="<?php echo base_url('assets/css/bootstrap.css') ;?>" rel="stylesheet"> 
        <link href="<?php echo base_url(); ?>assets/fontawesome-5/css/all.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/chosen.css">
</head>
<body>
<div class="container">
        <div class="row">
            <h2 style="text-align: center;">LISTES DES BESOINS</h2>
            <table class="table">
                <tr>
                   <th> Rubrique</th>
                   <th> Designation</th>
                   <th> Quantité</th>
                   <th> Date</th>
                </tr> 
              <?php foreach ($listeDemandeGrouper as $key) { ?>
                  <tr>
                     <td><?php echo $key['genre']; ?></td>
                     <td><?php echo $key['designation']; ?></td>
                     <td><?php echo $key['quantite']; ?></td>
                     <td><?php echo $key['dategroupage']; ?></td>
                  </tr> 
               <?php } ?>
            </table>
         
        </div>
    </div>

	<h3>PROFORMA - SAISIE</h3>

	<form action="<?php echo base_url('index.php/welcome/insertProforma')?>" method="get" onsubmit="return validateProforma(<?php echo count($listProduit);?>)">


		<p>Numero : <?php echo($numeroProforma) ?></p>
		<input type="hidden" name="numero" value="<?php echo($numeroProforma) ?>" class="form-control">

		<p>Date : </p>
		<input type="date" name="date" placeholder="Date Emission" required="" class="form-control">

		<p>Fournisseur : </p>
		<select name="fournisseur" class="form-control">
			<?php for ($i=0; $i < count($listFournisseur) ; $i++) { ?>
				<option value="<?php echo($listFournisseur[$i]["idfournisseur"])?>">
					<?php echo($listFournisseur[$i]["nomfournisseur"])?> - <?php echo($listFournisseur[$i]["localisation"])?>
				</option>
			<?php } ?>
		</select>

		<p>Delai : </p>
		<input type="date" name="delai" required="" class="form-control">

		<p>Lieu livraison : </p>
		<input type="text" name="lieu" required="" placeholder="Lieu livraison" class="form-control">

		<p>Produit : </p>
		<input type="hidden" name="produitLength" value="<?php echo(count($listProduit))?>">

		<?php for ($i=0; $i < count($listProduit) ; $i++) { ?>
			<p>
				<!-- Produit -->
				<input type="checkbox" id="produit<?php echo($listProduit[$i]["idproduit"])?>" name="produit<?php echo($listProduit[$i]["idproduit"])?>" onclick="checkProduit(<?php echo($listProduit[$i]["idproduit"])?>)" value="<?php echo($listProduit[$i]["idproduit"])?>" ><?php echo $listProduit[$i]["designation"]?>

				<!-- Qualite produit -->
				<select style="visibility:  hidden;" id="Qualite<?php echo($listProduit[$i]["idproduit"])?>" name="Qualite<?php echo($listProduit[$i]["idproduit"])?>">
					<?php for ($j=0; $j < count($listQualite) ; $j++) { ?>
						<option value="<?php echo($listQualite[$j]["idqualite"])?>"><?php echo($listQualite[$j]["type"])?></option>
					<?php } ?>
					
				</select>

				<!-- Quantite produit -->
				<input type="number" style="visibility:  hidden;" id="Quantite<?php echo($listProduit[$i]["idproduit"])?>" name="Quantite<?php echo($listProduit[$i]["idproduit"])?>" placeholder="Quantite" min="1">

				<!-- Prix produit -->
				<input type="number" style="visibility:  hidden;" id="Prix<?php echo($listProduit[$i]["idproduit"])?>" name="Prix<?php echo($listProduit[$i]["idproduit"])?>" placeholder="Prix" min="1">
			</p>
		<?php	}
		?>

		<!-- <h4>Note du Proforma : </h4>
		<p>Note Qualite : </p>
		<input type="number" name="qualiteNote" required="" min="1" max="20" placeholder="Note Proforma Qualite">
		<p>Note Quantite : </p>
		<input type="number" name="quantiteNote" required="" min="1" max="20" placeholder="Note Proforma Quantite">
		<p>Note Prix : </p>
		<input type="number" name="prixNote" required="" min="1" max="20" placeholder="Note Proforma Prix">
 -->
		<p><input type="submit" name="" class="btn btn-success"></p>



		<p><a href="#" onclick="moinsDisant()">Voir MoinsDisant</a></p>
		
	</form>


</body>
</html>