<?php 
session_start();
if (isset($_SESSION['Nombre'])) {
include 'views/users/header.php';

class Buscar
{
	
	function __construct()
  {
    include 'assets/query/driver_conection.php';
	$this->conectar = new Conectar();
	$this->db = $this->conectar->conexion();
  }//llave del constructor
 function search($values){
 	$tipo=$values['tipo'];
 	if ($tipo=='NO_ENTRADA_AYUDAS') {
 		$tipo='TAM.'.$tipo;
 	} elseif($tipo=='ID_EJERCICIO') {
 		$tipo='TAM.'.$tipo;
 	}else{
 		$tipo='TAP.'.$tipo;
 	}
 	$b=$values['search'];
 	$s="SELECT TAM.NO_ENTRADA_AYUDAS AS IDS ,TAM.ID_EJERCICIO AS AÑO, TAM.ID_ENTIDAD AS ENTIDAD, TAM.JUSTIFICACION AS JUSTIFICACION, TO_CHAR(TAM.FECHA, 'DD/MM/YYYY') AS FECHA, TAM.FUENTE AS FUENTE, TAM.LUGAR_DESTINO AS LUGAR, TAM.TIPO_MOVIMIENTO AS MOVIMIENTO,TAP.RFC_BENEFICIARIO AS BENEFICIARIO,TAP.ESTRUCTURA_PROGRAMTICA AS ESTRUCTURA, TAP.MONTO AS MONTO, PDF(TAM.NO_ENTRADA_AYUDAS,1) AS PDF
    	FROM TAB_AYUDAS_MAESTRO TAM, TAB_AYUDAS_PERSONAS TAP
    	WHERE TAM.NO_ENTRADA_AYUDAS = TAP.NO_ENTRADA_AYUDAS AND $tipo LIKE'%$b%'   ORDER BY TAM.NO_ENTRADA_AYUDAS DESC";
    	$this->query=oci_parse($this->db, $s);
    oci_execute($this->query);
        while ($row = oci_fetch_array($this->query, OCI_NUM) ) {
          echo "<tr>
              <td>{$row[0]}</td>
              <td>{$row[1]}</td>
              <td>{$row[2]}</td>
              <td>{$row[3]}</td>
              <td>{$row[4]}</td>
              <td>{$row[5]}</td>
              <td>{$row[6]}</td>
              <td>{$row[7]}</td>
              <td>{$row[8]}</td>
              <td>{$row[9]}</td>
              <td>{$row[10]}</td>";
              if($row[11]=='SI'){
                echo "<td scope='col'><form action='/siacor/?pdf' method='POST'><input name='id' type='hidden' value='{$row[0]}'><button type='submit' class='btn btn-outline-danger'><i class='fal fa-file-pdf'></i></button></form></td>";
              }else{
                echo "<td scope='col'></td>";
              }
          echo "<td scope='col'><form action='/siacor/?edit' method='POST'><input name='id' type='hidden' value='{$row[0]}'><button type='submit' class='btn btn-outline-primary'><i class='fas fa-edit'></i></button></form></td>
            <td scope='col'><form action='/siacor/?delete_ayuda' method='POST'><input name='id' type='hidden' value='{$row[0]}'><button type='submit' class='btn btn-outline-danger'><i class='fas fa-trash'></i></button></form></td>
            <td scope='col'><a class='btn btn-outline-info' href='/siacor/?evidences'><i class='fas fa-file-plus'></i></a></td>
              </tr>";
      }//llave del while
 }
}//llave de la clase
$load = new Buscar();
 ?>
 <a href='/siacor/?main' class="m-5" style="font-size: 1.5rem !important;"><i class='far fa-arrow-circle-left'></i></a><br>
 <div class='table-responsive'>
<table class='table table-hover'>
  <thead class='thead-dark'>
      <tr>
      <th>Nùmero de entrada</th>  
      <th>Ejercicio</th>
      <th>Entidad</th>
      <th>Justificaciòn</th>
      <th>Fecha</th>
      <th>Fuente</th>
      <th>Lugar</th>
      <th>Tipo de movimiento</th>
      <th>Beneficiarios</th>
      <th>Clave programàtica</th>
      <th>Monto</th>
      <th><a class='btn btn-outline-success' href='/siacor/?add'><i class='fal fa-plus-circle'></i></a></th>
      <th>Editar</th>
      <th>Eliminar</th>
      <th>Agregar Evidencia</th>
    	</tr>
    </thead>
    <tbody>
   		<?php 
$load->search($_POST);

 ?>
   	</tbody>
</table>
</div>

 <?php include 'views/users/footer.php'; }else{ session_destroy($_SESSION['Nombre']); header('location: /siacor/'); }  ?>