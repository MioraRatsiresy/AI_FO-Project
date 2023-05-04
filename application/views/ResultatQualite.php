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
				<td>Qualité</td>
			</tr>
			<?php foreach($result as $result) { ?>
			<tr>
				<td class="editableColumns">
					<input type="text" value="<?php echo $result['type']; ?>" id="qualiteToEdit">
				</td>
				<td>
					<a href="#">
						<i class="fas fa-pen" onclick="update('<?php echo $result['idqualite']; ?>');"> </i>
					</a>
				</td>
				<td>
					<a href="#">
						<i class="fas fa-trash-alt" onclick="deleteQualite('<?php echo $result['idqualite']; ?>');"></i>
					</a>
				</td>
			</tr>
			<?php } ?>
		</table>
</body>

</html>