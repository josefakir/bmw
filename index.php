<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>BMW Datos oportunidad</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">


</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<img src="img/logobmw.png" alt="" style="width: 200px; margin: 0 auto; display: block">
			</div>
			<div class="col-md-12">
				<form method="post" action="procesar.php" enctype="multipart/form-data">
					<div class="form-group">
						<label style="color: #008000"><i class="fas fa-file-excel" ></i> Archivo Xls</label>
						<input type="file" name="archivo" class="form-control" >
					</div>
					<button type="submit" class="btn btn-primary">Importar datos</button>
				</form>
			</div>
		</div>
	</div>
</body>
</html>