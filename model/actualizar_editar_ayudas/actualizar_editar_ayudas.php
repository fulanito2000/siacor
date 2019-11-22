<?php
//var_dump($_POST);
$load = new Actualizar_Registros();  
$load->update($_POST);

class Actualizar_Registros
{
  
  function __construct()
  {
    include 'assets/query/driver_conection.php';
    $this->conectar= new Conectar(); // aqui se llama a la clase conectar
    $this->db= $this->conectar->conexion(); 
  }//llave del constructor

  function update($values){
    //var_dump($values);
    $ejercicio=$values['ejercicio'];
    $id=$values['id'];
    $entidad=$values['entidad'];
    $justificacion=$values['justificacion'];
    $fecha=$values['fecha'];
    $fuente=$values['fuente'];
    $lugar=$values['lugar'];
    $movimiento=$values['tipo_movimiento'];
    $beneficiario=$values['beneficiario'];
    $estructura=$values['estructura'];
    $monto=$values['monto']; 
    $s="UPDATE TAB_AYUDAS_MAESTRO SET ID_EJERCICIO=$ejercicio, ID_ENTIDAD=$entidad,JUSTIFICACION='$justificacion',FECHA= TO_TIMESTAMP('$fecha', 'DD/MM/RR'),FUENTE='$fuente',LUGAR_DESTINO='$lugar' WHERE NO_ENTRADA_AYUDAS=$id";
    $q=oci_parse($this->db, $s);
    if (oci_execute($q)) {
      $s1="UPDATE TAB_AYUDAS_PERSONAS SET ID_EJERCICIO=$ejercicio,ID_ENTIDAD=$entidad,NO_ENTRADA_AYUDAS=$id,EJERCICIO_RFC='$ejercicio',RFC_BENEFICIARIO='$beneficiario',ESTRUCTURA_PROGRAMTICA='$estructura',MONTO=$monto WHERE NO_ENTRADA_AYUDAS=$id";
      $q1=oci_parse($this->db, $s1);
        if (oci_execute($q1)) {
          echo "<script>alert('DATOS ACTUALIZADOS EXITOSAMENTE');</script>";
          header('location: /siacor/?main');
        } else {
          oci_rollback($this->db);
          echo "<script>alert('ERROR! NO SE HAN PODIDO ACTUALIZAR DATOS');</script>";
          header('location: /siacor/?main');
        }
    } else {
      echo "<script>alert('ERROR! NO SE HAN PODIDO ACTUALIZAR DATOS');</script>";
      header('location: /siacor/?main');
    }
    
  }//llave de la funcion update

}//llave de la clase

 ?>