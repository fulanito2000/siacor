<?php 
session_start();
if (isset($_SESSION['Nombre'])) {
	include 'views/users/header.php';

	/*class tickets
	{
		
		function __construct()
		{
			include 'assets/query/driver_conection.php';
			$this->conectar = new Conectar(); // aqui se llama a la clase conectar
			$this->db = $this->conectar->conexion(); 
			include 'views/users/secondary/cifras.php';

		}//llave del constructor
		function show($values)
		{
			$id=$values['id'];
			$s="";
		}//llave de la funcion show

	}//llave de la clase
	tickets::show($_POST);*/
	/*$id=$_POST['id'];
	$a=123;
	echo $a."= ".CifrasEnLetras::convertirCifrasEnLetras($a);*/
?>
	<style>
		img{
			height: 100px;
			width: 100px;
		}
	</style>
	<div class="container p-4 text-dark ">
		<div class="row bg-white">
			<form action="" class="w-100">
				<div class="col-12 cabecera border border-dark border-bottom-0">
				<div class="row">
					<div class="col-md-4" align="center">
						<img src="resources\img\logo-tgo.jpg">
					</div>
					<div class="col-md-4 p-5" align="center">
						<h5 class="text-center font-weight-bold">TESORERÍA MUNICIPAL</h5>
					</div>
					<div class="col-md-4 p-3" align="center">
						<img src="resources\img\logopres.jpg">
					</div>
				</div>
				</div>
				<div class="col-12 especie border border-dark border-top-0 bg-secondary">
					<div class="row">
						<div class="col-md-3 mr-5" align="center">
							<p>Bueno por $</p>
						</div>
						<div class="col-md-3">
							<input type="text" class="border border-dark border-top-0 border-left-0 border-right-0" placeholder="monto">
						</div>
						<div class="col-md-3">
							<label for="folio">FÓLIO:</label>
						</div>
						<div class="col-md-3">
							<input name="folio" type="text" class="form-control border border-dark border-top-0 border-left-0 border-right-0" placeholder="FÓLIO">
						</div>
					</div>
				</div><br>
				<br>
				<br>
			</form>
		</div>
	</div>




<?php	include 'views/users/footer.php';
}else{ 
	session_destroy($_SESSION['Nombre']); header('location: /siacor/'); 
}  
?>