<?php session_start();
if (isset($_SESSION['Nombre'])) {
include 'views/users/header.php';

class Editar_ayudas
{
	
	function __construct()
  {
    include 'assets/query/driver_conection.php';
	$this->conectar = new Conectar();
	$this->db = $this->conectar->conexion();
  }//llave del constructor

  function evidencia($values){
  	$id=$values['id'];
  	$s="SELECT TAD.NO_ENTRADA_AYUDAS,TAD.ID_EJERCICIO, TAP.RFC_BENEFICIARIO, TAD.DESCRIPCION,TAD.TICKET
	  FROM TAB_AYUDAS_DETALLE TAD, TAB_AYUDAS_MAESTRO TAM, TAB_AYUDAS_PERSONAS TAP
	  WHERE TAD.NO_ENTRADA_AYUDAS = '$id' AND TAM.NO_ENTRADA_AYUDAS = '$id' AND TAP.NO_ENTRADA_AYUDAS= '$id'";
	$q= oci_parse($this->db, $s);
	oci_execute($q);
	$r=oci_fetch_assoc($q);
	echo"
		<div class='form-group col-3-md'>
		 	<input type='hidden' value='".$r['NO_ENTRADA_AYUDAS']."' name='id'>
			<label for='ano'>Año</label>
			<input name='ano' type='text' class='form-control' value='".$r['ID_EJERCICIO']."' disabled>
		</div>
		<div class='form-group col-3-md'>
			<label for='rfc'>Beneficiario</label>
			<input name='rfc' type='text' class='form-control' value='".$id."' disabled>
		</div>
		<div class='form-group col-3-md'>
			<label for='descripcion'>Descripcion</label>
			<input name='descripcion' type='text' value='".$r['DESCRIPCION']."' class='form-control'>
		</div>
		<div class='form-group col-3-md'>
			<img id='original' src='".$r['TICKET']."'  class='img-fluid img-thumbnail'>
			<div class='col-lg-9'>
			    <input id='file-upload' type='file' accept='image/*' name='ticket' />
			    <div id='file-preview-zone'>
				</div>
			</div>
		</div>
		<div class='form-group col-3-md p-4'>
			<button class='btn btn-outline-success btn-block'>Guardar</button>
		</div>
		";
  }//llave de la funcion evidencia

}//llave de la clase
$load = new Editar_ayudas();

?>
<style>
	img{
		height: 200px;
		width: 200px;
	}
</style>
<a href='/siacor/?evidences' class="m-5" style="font-size: 1.5rem !important;"><i class='far fa-arrow-circle-left'></i></a><br>
	<form action="/siacor/?actualizar_editar_evidencia" method="POST" enctype="multipart/form-data">
		<div class="form-row">
			<?php $load->evidencia($_POST); ?>
		</div>
	</form>
	<script>
	    function readFile(input) {
	        if (input.files && input.files[0]) {
	            var reader = new FileReader();
	 			document.getElementById('original').style.display = 'none';
	            reader.onload = function (e) {
	                var filePreview = document.createElement('img');
	                filePreview.id = 'file-preview';
	                //e.target.result contents the base64 data from the image uploaded
	                filePreview.src = e.target.result;
	                console.log(e.target.result);
	 
	                var previewZone = document.getElementById('file-preview-zone');
	                previewZone.appendChild(filePreview);
	            }
	 
	            reader.readAsDataURL(input.files[0]);
	        }
	    }
	 
	    var fileUpload = document.getElementById('file-upload');
	    fileUpload.onchange = function (e) {
	        readFile(e.srcElement);
	    }
	</script>
<?php include 'views/users/footer.php';}else{header('location: /siacor/?access');} ?>