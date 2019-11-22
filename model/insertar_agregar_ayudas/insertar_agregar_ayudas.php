<?php 
//var_dump($_POST);
$load = new Save_Registers();
$load->save($_POST);
//var_dump($_POST); 



class Save_Registers
{
	
	function __construct()
	{
		include 'assets/query/driver_conection.php';
		$this->conectar= new Conectar(); // aqui se llama a la clase conectar
		$this->db= $this->conectar->conexion(); 
  	}//llave del constructor

  	function save($values)
  	{
  		$ejercicio = $values["ejercicio"];
  		$entidad = $values["entidad"];
  		$justificacion = $values["justificacion"];
      $fecha = $values["fecha"];
      $fuente = $values["fuente"];
  		$lugar = $values["lugar"];
  		$tipo_movimiento = $values["tipo_movimiento"];
  		$beneficiario = $values["beneficiario"];
  		$clave_programatica = $values["clave_programatica"];
  		$monto = $values["monto"];
      $id="Tulancingo";
      echo $s1="INSERT INTO \"MATERIALES\".\"TAB_AYUDAS_MAESTRO\" (EMPRESA,ID_EJERCICIO, ID_ENTIDAD, ID_ESTADO, ID_MUNICIPIO, ID_LOCALIDAD, FECHA, FUENTE, LUGAR_DESTINO, JUSTIFICACION,TIPO_MOVIMIENTO) VALUES ('$id','$ejercicio', '$entidad', '$entidad', '$entidad', '$entidad', TO_TIMESTAMP('
      $fecha', 'DD/MM/RR'), '$fuente', '$lugar','$justificacion' ,'$tipo_movimiento')";
  		$q1=oci_parse($this->db,$s1);
  		if (oci_execute($q1)) {
        $s2="SELECT MAX(NO_ENTRADA_AYUDAS) AS NUM FROM TAB_AYUDAS_MAESTRO";
        $q2=oci_parse($this->db,$s2);
        oci_execute($q2);
        $no=oci_fetch_row($q2);
        $no=$no[0];
  			$s3="INSERT INTO \"MATERIALES\".\"TAB_AYUDAS_PERSONAS\" (EMPRESA, ID_EJERCICIO, ID_ENTIDAD, NO_ENTRADA_AYUDAS, NO_ENTRDA_DETALLE, EJERCICIO_RFC, RFC_BENEFICIARIO, ESTRUCTURA_PROGRAMTICA, MONTO) VALUES ('$id', '$ejercicio', '$entidad', '$no', '$no', '$ejercicio', '$beneficiario', '$clave_programatica', '$monto')";
  			$q3=oci_parse($this->db,$s3);
  			if (oci_execute($q3)) {
  				header('location: /siacor/?main');
  			}else{
  				echo "<script>alert('ERROR! PROBLEMAS AL GUARDAR REGISTRO');</script>";
          header('location: /siacor/?main');
  			}
      }else{
      	echo "<script>alert('ERROR! PROBLEMAS AL GUARDAR REGISTRO');</script>";
      	header('location: /siacor/?main');
      }//llave del else
  	}//llave de la funcion save

}//llave de la clase


 ?>