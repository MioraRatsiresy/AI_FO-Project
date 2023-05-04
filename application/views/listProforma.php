
<!DOCTYPE html>
<html>
<head>
	<title>PROFORMA - LIST</title>
</head>
<body>
	<h3>PROFORMA - LIST NON NOTE</h3>

	<table border="1">
		<tr>
			<th>id</th>
			<th>numero</th>
			<th>dateEmission</th>
			<th>fournisseur</th>
			<th>noter</th>
		</tr>

		<?php
			for ($i=0; $i < count($listProforma); $i++) { ?>
				<tr>
					<td><?php echo $listProforma[$i]["idproforma"];?></td>
					<td><?php echo $listProforma[$i]["numero"];?></td>
					<td><?php echo $listProforma[$i]["dateemission"];?></td>
					<td><?php echo $listProforma[$i]["nomfournisseur"];?></td>
					<td><a href="<?php echo(base_url('index.php/welcome/noterProforma?idProforma='.$listProforma[$i]["idproforma"]))?>">Noter ce Proforma</a></td>
				</tr>
		<?php	}
		?>

		
	</table>

	<a href="<?php echo(base_url('index.php/welcome/saisieProforma')) ?>">Retour</a>


</body>
</html>