<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>SIACOR</title>
	<link rel="stylesheet" href="resources/css/bootstrap/bootstrap.min.css">
	<link rel="stylesheet" href="resources/css/login/login.css">
	<link rel="stylesheet" href="resources/css/fontawesome/css/all.css">
</head>
<body>
	
	<script>
		let clic=1;
		function pas()
		{
			if (clic==1) {
				document.getElementById('pws').style.display='block';
				clic = clic+1;
			}else{
				document.getElementById('pws').style.display='none';
				clic=1;
			}
			
		}
	</script>
	<div class="container p-5">
		<div class="row">
			<div class="col-6 elementos">
				<form action="/siacor/?login" method="POST">
					<div class="form-row p-5">
						<div class="form-group col-md-12">
							<label for="tipo">Selecciona el tipo de Cuenta con la que deseas entrar.</label>
							<select name="tipo" class="custom-select" id="tipo" onchange="pas();">
								<option value="1">Usuario</option>
								<option value="2">Administrador</option>
							</select>
						</div>
						<div class="form-group col-md-12">
							<label for="year">Ejercicio</label>
							<select name="year" class="custom-select">
								<?php $y=date('Y');
									for ($i=$y; $i >=2015 ; $i--) { 
										echo "<option value=".$i.">".$i."</option>";									}
								 ?>
							</select>
						</div>
						<div class="form-group col-md-12">
							<label for="empresa">Empresa</label>
							<select name="empresa" class="custom-select" id="tipo">
								<option value="Tulancingo">Tulancingo</option>
								<option value="San_Bartolo">San_Bartolo</option>
								<option value="Agua_Blanca">Agua_Blanca</option>
							</select>
						</div>
						<div class="form-group col-md-12">
							<label for="user">Usuario</label>
							<input type="text" placeholder="Clave de usuario" name="user" class="form-control">
						</div>
						<div id="pws" class="form-group col-md-12" style="display: none;">
							<label for="pass">Contraseña</label>
							<input type="password" name="pass" class="form-control">
						</div>
						<div class="form-group col-md-6">
							<button class="btn btn-outline-success btn-block" type="submit">
								Aceptar
							</button>
						</div>
						<div class="form-group col-md-6">
							<button class="btn btn-outline-danger btn-block" type="reset">Cancelar</button>
						</div>
					</div>
				</form>
			</div>

			<div id="imagenes" class="col-6 w-50"></div>
		</div>
	</div>



	<script src="resources/css/bootstrap/jquery-3.3.1.slim.min.js"></script>
    <script src="resources/css/bootstrap/popper.js/1.14.7/umd/popper.min.js" ></script>
    <script src="resources/css/bootstrap/bootstrap.min.js"></script>
</body>
</html>