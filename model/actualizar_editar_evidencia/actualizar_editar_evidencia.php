<?php 
$load = new Actualizar();
if (empty($_FILES['ticket']['name'])) {
	$load->actualiza($_POST);
}else{
	$load->actualiza1($_POST,$_FILES);
}

class Actualizar
{
	
	function __construct()
  {
    include 'assets/query/driver_conection.php';
	$this->conectar = new Conectar();
	$this->db = $this->conectar->conexion();
  }//llave del constructor
  function actualiza($values){
  	$id=$values['id'];
  	$descripcion=$values['descripcion'];
  	$s="UPDATE \"MATERIALES\".\"TAB_AYUDAS_DETALLE\" SET  DESCRIPCION = '$descripcion' WHERE NO_ENTRADA_AYUDAS='$id' ";
  	$q=oci_parse($this->db, $s);
  	if (oci_execute($q)) {
  		header('location: /siacor/?evidences');
  	}else{
  		echo "<script>alert('ERROR! Imposible actualizar datos');window.loaction='/siacor/?evidences';</script>";
  	}
  }//llave de la funcion actualizar
  function actualiza1($values,$files)
  {
  	$id=$values['id'];
  	$descripcion=$values['descripcion'];
  	$s="SELECT TAD.ID_EJERCICIO AS YEAR,TAP.RFC_BEneficiario AS RFC FROM TAB_AYUDAS_DETALLE TAD, TAB_AYUDAS_PERSONAS TAP WHERE TAD.NO_ENTRADA_AYUDAS='$id' AND TAP.NO_ENTRADA_AYUDAS='$id'";
  	$q=oci_parse($this->db, $s);
  	oci_execute($q);
  	$r=oci_fetch_assoc($q);
  	echo $ruta="resources/img/Tickets/".$r['YEAR']."/".$id."/";
  	$total_imagenes = count(glob($ruta.'{*.jpg,*.png}',GLOB_BRACE))+1;
  	$files['ticket']['name']=$r['RFC'].'-'.$total_imagenes.substr($files['ticket']['name'], -4);
  	if (move_uploaded_file($files['ticket']['tmp_name'], $ruta.$files['ticket']['name'])){
  		$a=$ruta.$files['ticket']['name'];
  		$s1="UPDATE TAB_AYUDAS_DETALLE SET  DESCRIPCION = '$descripcion', TICKET = '$a' WHERE NO_ENTRADA_AYUDAS='$id' ";
  		$q1=$q=oci_parse($this->db, $s1);
  		if (oci_execute($q1)) {
  			header('location: /siacor/?evidences');
  		}else{
  			echo "error al actualizar";
  		}
  	}else{
  		echo "error al mover la imagen";
  	}
  }//llave de la funcion actualiza1
}//llave de la clase

 ?>