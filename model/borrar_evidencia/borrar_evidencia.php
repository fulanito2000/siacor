<?php 
$load = new Borrar();
$load->borra($_POST);
class Borrar
{
	
	function __construct()
  {
    include 'assets/query/driver_conection.php';
	$this->conectar = new Conectar();
	$this->db = $this->conectar->conexion();
  }//llave del constructor
  function borra($values){
  	$id=$values['id'];
  	$s="DELETE FROM TAB_AYUDAS_DETALLE WHERE NO_ENTRADA_AYUDAS = '$id' ";
  	$q=oci_parse($this->db, $s);
  	if (oci_execute($q)) {
  		header('location: /siacor/?evidences');
  	}else{
  		echo "<script>alert('ERROR! Problemas al eliminar registro');window.location='/siacor/?evidences';</script>";
  	}
  }
}

 ?>