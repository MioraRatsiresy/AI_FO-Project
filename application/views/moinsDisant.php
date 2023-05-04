<?php
	// var_dump($MoinsDisant[0]);
?>
<!DOCTYPE html>
<html>
<head>
	<title>PROFORMA - MOINS_DISANT</title>
	<link href="<?php echo base_url('assets/css/bootstrap.css') ;?>" rel="stylesheet"> 
        <link href="<?php echo base_url(); ?>assets/fontawesome-5/css/all.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/chosen.css">
</head>
<body>
	<h3>PROFORMA - MOINS_DISANT</h3>
	<?php
		$indice = 0; 
		foreach ($product as $p) { ?>
		<b><?php echo $p['designation']; ?></b>
		<table class="table table-bordered">
		<tr  class="info">
			<th>Rang Prix</th>
			<th>idProforma</th>
			<th>Numero</th>
			<th>Fournisseur</th>
			<th>Date Emission</th>
			<th>Delai Livraison</th>
			<th>Lieu Livraison</th>
			<th>Produit</th>
			<th>Quantite</th>
			<th>Prix</th>
			<th>Qualite</th>
		</tr>

		<?php for ($i=0; $i <count($MoinsDisant[$indice]) ; $i++) { ?>
			<tr>
				<td><?php echo($i+1);?></td>
				<td><?php echo $MoinsDisant[$indice][$i]["idproforma"];?></td>
				<td><?php echo $MoinsDisant[$indice][$i]["numero"];?></td>
				<td><?php echo $MoinsDisant[$indice][$i]["nomfournisseur"];?></td>
				<td><?php echo $MoinsDisant[$indice][$i]["dateemission"];?></td>
				<td><?php echo $MoinsDisant[$indice][$i]["delailivraison"];?></td>
				<td><?php echo $MoinsDisant[$indice][$i]["lieulivraison"];?></td>
				<td><?php echo $MoinsDisant[$indice][$i]["designation"];?></td>
				<td><?php echo $MoinsDisant[$indice][$i]["quantite"];?></td>
				<td><?php echo $MoinsDisant[$indice][$i]["prix"];?> Ariary</td>
				<td><?php echo $MoinsDisant[$indice][$i]["qualite"];?></td>

			</tr>
			<tr>

					<?php
						$prix = $MoinsDisant[$indice][$i]["prix"];
						$prixSuivant = 0;
						if ($i!=count($MoinsDisant[$indice])-1) {
							$prixSuivant = $MoinsDisant[$indice][$i+1]["prix"];
						}

						$Difference = $prixSuivant - $prix;

						if ($Difference<0) {
							$Difference*=-1;
						}

						if ($i!=count($MoinsDisant[$indice])-1) { ?>
							<td>
								<!-- Teste de la difference de prix -->
								<?php if ($Difference < 500) { ?>
									<input type="checkbox" id="noterQualite-<?php echo $MoinsDisant[$indice][$i]["idproforma"];?>" onclick="noterQualite(<?php echo $MoinsDisant[$indice][$i]["idproforma"];?>)">Noter suivant la qualite</input>

									<form action="<?php echo(base_url('index.php/welcome/updatePrix')) ?>" method="get" id="formNoterQualite-<?php echo $MoinsDisant[$indice][$i]["idproforma"];?>" style="visibility: hidden;" >
										<input type="hidden" name="idProformaDetail" value="<?php echo($MoinsDisant[$indice][$i]["idproformadetail"]); ?>">
										<input type="hidden" name="prix" value="<?php echo($MoinsDisant[$indice][$i]["prix"]); ?>">
										<input type="number" name="noteQualite" placeholder="noter qualite" min="1">
										<input type="submit" name="">
									</form>
								<?php } ?>
							</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td>Difference de prix : <?php echo $Difference ?> Ariary</td>
							
					<?php	}

					?>
				
			</tr>
		<?php } ?>
		
	</table>

	<?php
		$indice++;
	 }?>
	 <a class="btn btn-primary" href="<?php echo base_url("Welcome/indexBon");?>">Generer bon de commande</a>
</body>
</html>