<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
</head>

<body>
	<table class="table">
		<table class="table table-striped table-dark">
			<tr>
				<td>Designation</td>
				<td>Code produit</td>
				<td>Genre</td>
				<td>Qualite</td>
			</tr>
			<?php $i=0; ?>
			<?php foreach($result as $result1) { ?>
			<tr>
				<?php if ($result1===reset($result)) { ?>
				<td>
					<input type="text" value="<?php echo $result1['designation']; ?>" id="designationToEdit">
				</td>
				<td>
					<input type="text" value="<?php echo $result1['codeproduit']; ?>" id="codeToEdit">
				</td>
				<td>
					<?php echo $result1['genre']; ?>
				</td>
				<?php } else { ?>
				<td></td>
                <td></td>
                <td></td>
				<?php } ?>
				<td>
					<?php echo $result1['qualite']; ?>
					<a href="#">
						<i class="fas fa-trash-alt" onclick="deleteProduitQualite('<?php echo $result1['idqualite']; ?>','<?php echo $result1['idproduit']; ?>');"></i>
					</a>
				</td>
				<?php if ($result1===reset($result)) { ?>
				<td>
					<a href="#">
						<i class="fas fa-pen" onclick="updateProduit('<?php echo $result1['idqualite']; ?>');"></i>
					</a>
				</td>
				<?php } ?>
			</tr>
			<?php } ?>
		</table>
</body>

</html>