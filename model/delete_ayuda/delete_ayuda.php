<?php 
$load = new Elimina;
$load->borrar($_POST);

/**
 * 
 */
class Elimina
{
	
	function __construct()
	 {
	    include 'assets/query/driver_conection.php';
		$this->conectar = new Conectar();
		$this->db = $this->conectar->conexion();
	 }//llave del constructor
	 function borrar($values)
	 {
	 	$id=$values["id"];
	 	$s="DELETE FROM TAB_AYUDAS_MAESTRO WHERE NO_ENTRADA_AYUDAS=$id ";
	 	$q=oci_parse($this->db, $s);
    	if(oci_execute($q)){
    		$s1="DELETE FROM TAB_AYUDAS_PERSONAS WHERE NO_ENTRADA_AYUDAS=$id";
    		$q1=oci_parse($this->db, $s1);
    		if(oci_execute($q1)){
    			header('location: /siacor/?main');
    		}
    	}
	 }

}//llave de la clase


 ?>