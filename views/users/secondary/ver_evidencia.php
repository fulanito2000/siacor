<?php 
session_start();
if (isset($_POST["id"]) and $_SESSION['Nombre']) {
	include 'views/users/header.php';
	$load = new Datos();
}else{
	header('location: /siacor/?evidences');
}
class Datos
{
	
	function __construct()
  {
    include 'assets/query/driver_conection.php';
	$this->conectar = new Conectar();
	$this->db = $this->conectar->conexion();
  }//llave del constructor
  function evidencia($values){
  	$id=$values;
  	$s="SELECT TAD.NO_ENTRADA_AYUDAS AS NUM,TAD.ID_EJERCICIO AS EJE,TAD.ID_ENTIDAD AS ENTI, TAP.RFC_BENEFICIARIO AS BENE, TAD.DESCRIPCION AS DES,TAD.TICKET AS IMG
		FROM TAB_AYUDAS_DETALLE TAD, TAB_AYUDAS_MAESTRO TAM, TAB_AYUDAS_PERSONAS TAP
		WHERE TAD.NO_ENTRADA_AYUDAS = '$id' AND TAM.NO_ENTRADA_AYUDAS ='$id' AND TAP.NO_ENTRADA_AYUDAS ='$id'";
	$q=oci_parse($this->db, $s);
	oci_execute($q);
	$r=oci_fetch_assoc($q);
	echo "
			<div class='form-groupcol-md-4'>
			<label>Numero</label>
			<input type='disabled' value='".$r['NUM']."' class='form-control'>
			</div>
			<div class='form-group col-md-4'>
			<label>EJERCICIO</label>
			<input type='disabled' value='".$r['EJE']."' class='form-control'>
			</div>
			<div class='form-group col-md-4'>
			<label>ENTIDAD</label>
			<input type='disabled' value='".$r['ENTI']."' class='form-control'>
			</div>
			<div class='form-group col-md-4'>
			<label >BENEFICIARIO</label>
			<input type='disabled' value='".$r['BENE']."' class='form-control'>
			</div>
			<div class='form-group col-md-4'>
			<label >DESCRIPCION</label>
			<input type='disabled' value='".$r['DES']."' class='form-control'>
			</div>
			<div class='form-group col-md-4'>
			<img src='".$r['IMG']."' style='height:200px;width:200px;' class='form-control'>
			</div>
		 ";	
  }  
}//clase
?>
<a href='/siacor/?evidences' class="m-5" style="font-size: 1.5rem !important;"><i class='far fa-arrow-circle-left'></i></a><br>
<div class="form-row m-3">
	<?php 
		$load->evidencia($_POST["id"]);
	 ?>
</div>


<?php include 'views/users/footer.php'; ?>