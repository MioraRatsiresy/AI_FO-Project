<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
</head>

<body>
	<br>
	<table class="table table-striped table-dark">
		<tr>
			<td>Rubrique</td>
			<td>Designation</td>
			<td>Qualite</td>
			<td>Quantite</td>
		</tr>
		<?php foreach($liste as $liste) { ?>
		<tr>
			<td><?php echo $liste['genre']; ?></td>
            <td><?php echo $liste['designation']; ?></td>
            <td><?php echo $liste['type']; ?></td>
            <td><?php echo $liste['quantite']; ?></td>
			<!--<td><button type="button" class="btn btn-info" onclick="showModalModifier('<?php echo $liste['quantite']; ?>','<?php echo $liste['iddemande']; ?>');">Modifier</button></td>-->
			<td><button id="bouttonSupprimer" type="button" class="btn btn-warning" onclick="deleteLigneDemande('<?php echo $liste['iddemande']; ?>');">Supprimer</button></td>
		</tr>
		<?php } ?>
	</table>
	<?php if(count($liste)!=0) { ?>
	<button id="bouttonEnregistrer" type="button" class="btn btn-success btn-lg" onclick="save();" style="float:right;">Enregistrer</button>
	<?php } ?>
</body>

</html>