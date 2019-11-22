<?php 
$load = new Upload();
$load->upload_files($_POST,$_FILES);

class Upload
{
	function __construct()
  {
    include 'assets/query/driver_conection.php';
  $this->conectar = new Conectar(); // aqui se llama a la clase conectar
  $this->db = $this->conectar->conexion(); 
  }//llave del constructor
  function upload_files($values,$files){
  	$id=$values['id'];
  	$observacion=$values['observacion'];
  	$s="SELECT TAM.ID_EJERCICIO,TAM.ID_ENTIDAD,TAP.RFC_BENEFICIARIO FROM TAB_AYUDAS_MAESTRO TAM, TAB_AYUDAS_PERSONAS TAP WHERE TAM.NO_ENTRADA_AYUDAS='$id' AND TAP.NO_ENTRADA_AYUDAS='$id'";
  	$q=oci_parse($this->db, $s);
  	oci_execute($q);
  	$row=oci_fetch_row($q);
  	$year=$row[0];
  	$i_ent=$row[1];
    $rfc=$row[2];
  	$ruta='resources/img/Tickets/'.$year."/".$id."/";
  	$ruta=$this->crear_carpeta($ruta);
  	$tipo_fichero=$files['ticket']['type'];
    $total_imagenes = count(glob($ruta.'{*.jpg,*.png}',GLOB_BRACE))+1;
    $nombre_fichero=$rfc.'-'.$total_imagenes;
    $files['ticket']['name']=$rfc.'-'.$total_imagenes.substr($files['ticket']['name'], -4);
    $ruta1= $ruta.$files['ticket']['name'];
    if ($tipo_fichero=="image/jpg" || $tipo_fichero=="image/png" || $tipo_fichero=="image/jpeg") {
      if (move_uploaded_file($files['ticket']['tmp_name'], $ruta.$files['ticket']['name'])) {

        $s1="INSERT INTO \"MATERIALES\".\"TAB_AYUDAS_DETALLE\" (EMPRESA, ID_EJERCICIO, ID_ENTIDAD, NO_ENTRADA_AYUDAS, NO_ENTRDA_DETALLE, DESCRIPCION, TICKET) VALUES ('TULANCINGO', '$year', '$i_ent', '$id', '$id', '$observacion', '$ruta1')";
        $q1=oci_parse($this->db, $s1);
        if (oci_execute($q1)) {
          header('location: /siacor/?evidences');
        }else{
          unlink($tick);
          echo "<script>alert('mal al insertar');</script>";
          header('location: /siacor/?evidences');
        }
      }else{
        echo "<script>alert('error al subir');</script>";
        header('location: /siacor/?evidences');
      }
    }else{
      echo "<script>alert('no es un tipo de archivo/imagen permitido');</script>";
      header('location: /siacor/?evidences');
    }//llave del else
  	
  }//llave de la funcion upload_files
  function crear_carpeta($ruta){
	if (!file_exists($ruta)) {
  		mkdir($ruta, 0777, true);
  		$this->crear_carpeta($ruta);
  	}else{
  		return $ruta;
  	}
  }//llave de la funcion crear carpeta
}//llave de la clase

 ?>