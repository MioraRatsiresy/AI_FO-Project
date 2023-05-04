
<!DOCTYPE html>
<html>
<head>
	<title>PROFORMA - NOTATION</title>
</head>
<body>

	<h3>PROFORMA - NOTE</h3>

	<p>id : <?php echo $_GET['idProforma'];?></p>

	<form action="<?php echo(base_url('index.php/welcome/insertNoteProforma'))?>" method="get">

		<input type="hidden" name="idProforma" value="<?php echo $_GET['idProforma'];?>">
		
		<h4>Note du Proforma : </h4>
		<p>Note Qualite : </p>
		<input type="number" name="qualiteNote" required="" min="1" max="20" placeholder="Note Proforma Qualite">
		<p>Note Quantite : </p>
		<input type="number" name="quantiteNote" required="" min="1" max="20" placeholder="Note Proforma Quantite">
		<p>Note Prix : </p>
		<input type="number" name="prixNote" required="" min="1" max="20" placeholder="Note Proforma Prix">

		<p>
			<input type="submit" name="">
		</p>

	</form>

	<a href="<?php echo(base_url('index.php/welcome/listProforma')) ?>">Retour</a>
		

</body>
</html>