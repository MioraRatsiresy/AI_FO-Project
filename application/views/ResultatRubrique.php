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
				<td>Rubrique</td>
			</tr>
			<?php foreach($result as $result) { ?>
			<tr>
				<td>
					<input type="text" value="<?php echo $result['genre']; ?>" id="rubriqueToEdit">
				</td>
				<td>
					<a href="#">
						<i class="fas fa-pen" onclick="updateRubrique('<?php echo $result['idrubrique']; ?>');"></i>
					</a>
				</td>
				<!--<td>
					<a href="#">
						<i class="fas fa-trash-alt" onclick="deleteRubrique('<?php echo $result['idrubrique']; ?>');"></i>
					</a>
				</td>-->
			</tr>
			<?php } ?>
		</table>
</body>

</html>