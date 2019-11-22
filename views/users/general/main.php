<?php
session_start();
if (isset($_SESSION['Nombre'])) {
include 'views/users/header.php';

class Actions
{
  
  function __construct()
  {
    include 'assets/query/driver_conection.php';
	$this->conectar = new Conectar();
	$this->db = $this->conectar->conexion();
  }//llave del constructor

  function show_data($values){
    if ($values==1) {
      $this->pagina = 1; //Por default, página = 1
    }else{
      $this->pagina = $values; //Por default, página = 1
    }
  	
	
  $this->noRegistros = 10; //Registros por página
	$this->sql="SELECT * FROM(
		SELECT a.*, rownum r__
		FROM
		(
    SELECT TAM.NO_ENTRADA_AYUDAS AS IDS ,TAM.ID_EJERCICIO AS AÑO, TAM.ID_ENTIDAD AS ENTIDAD, TAM.JUSTIFICACION AS JUSTIFICACION, TO_CHAR(TAM.FECHA, 'DD/MM/YYYY') AS FECHA, TAM.FUENTE AS FUENTE, TAM.LUGAR_DESTINO AS LUGAR, TAM.TIPO_MOVIMIENTO AS MOVIMIENTO,TAP.RFC_BENEFICIARIO AS BENEFICIARIO,TAP.ESTRUCTURA_PROGRAMTICA AS ESTRUCTURA, TAP.MONTO AS MONTO
    FROM TAB_AYUDAS_MAESTRO TAM, TAB_AYUDAS_PERSONAS TAP
    WHERE TAM.NO_ENTRADA_AYUDAS = TAP.NO_ENTRADA_AYUDAS ORDER BY TAM.NO_ENTRADA_AYUDAS DESC
		) a
		WHERE rownum < (($this->pagina * $this->noRegistros) + 1 )
		)
		WHERE r__ >= ((($this->pagina-1) * $this->noRegistros) + 1)";

  	$this->query=oci_parse($this->db, $this->sql);
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
          echo "<td scope='col'><a type='button' href='verPDF.php?v={$row[0]}' value='Ver Reporte' target='_blank' class='btn btn-danger'  onClick='document.formulario.action='verPDF.php?v={$row[0]}'; document.formuario.submit();'><i class='fal fa-file-pdf'></i></a></td>";
          echo "<td scope='col'><form action='/siacor/?edit' method='POST'><input name='id' type='hidden' value='{$row[0]}'><button type='submit' class='btn btn-outline-primary'><i class='fas fa-edit'></i></button></form></td>
            <td scope='col'><form action='/siacor/?delete_ayuda' method='POST'><input name='id' type='hidden' value='{$row[0]}'><button type='submit' class='btn btn-outline-danger' onclick='borrar();'><i class='fas fa-trash'></i></button></form></td>
            <td scope='col'><a class='btn btn-outline-info' href='/siacor/?evidences' >+</a></td>
            <td><button class='btn btn-outline-info' onclick='evidencia();'><i class='fas fa-thumbs-up'></i></button></td>
              </tr>";
      }//llave del while
      
      
      
  }//llave de la funcion show_data

  function pagination(){
    $s="SELECT COUNT(*) AS RecordCount FROM TAB_AYUDAS_MAESTRO";
    $q=oci_parse($this->db, $s);
    oci_execute($q);
    while ( $r = oci_fetch_array($q, OCI_NUM) ){
      $totalRegistros=$r[0];
    }

    $noPaginas = $totalRegistros/$this->noRegistros;
    for($i=1; $i<$noPaginas+1; $i++) {
      if($i == 1){

          echo "<input type='submit' class='btn btn-outline-info disabled' value='{$i}' name='pagina'>"; //A la página actual no le pongo link

      }else{
        echo "<input type='submit' class='btn btn-outline-info' value='{$i}' name='pagina'>&nbsp;";
      }
    }
  }//llave de la funcion paginacion
}//llave de la clase

$load = new Actions();

 ?><script>
   function borrar(){
      confirmar=confirm("¿Está seguro de que desea borrar este registro?");
      if (!confirmar) {
       event.preventDefault();
      } else {
        return false;
      }
     }
     function evidencia(){
      confirmar=confirm("¿Está seguro de que desea aprobar está ayuda?");
      if (!confirmar) {
       event.preventDefault();
      } else {
        return false;
      }
     }
 </script>
<div class='table-responsive m-4'>
<table class='table table-hover w-50 border border-secondary'>
  <thead>
      <tr class="table-secondary">
      <th>Número de entrada</th>  
      <th>Ejercicio</th>
      <th>Entidad</th>
      <th>Justificación</th>
      <th>Fecha</th>
      <th>Fuente</th>
      <th>Lugar</th>
      <th>Tipo de movimiento</th>
      <th>Beneficiarios</th>
      <th>Clave programática</th>
      <th>Monto</th>
      <th><a class='btn btn-info' href='/siacor/?add'><i class='fal fa-plus-circle'></i></a></th>
      <th>Editar</th>
      <th>Eliminar</th>
      <th>Agregar Evidencia</th>
      <th>Aprobar Ayuda</th>
    	</tr>
    </thead>
    <tbody style="border:1px solid gray;">
   		<?php 
      
        if (isset($_POST['pagina'])) {
          $load->show_data($_POST['pagina']);
        } else {
          $load->show_data(1);
        }
      
      ?>
   	</tbody>
</table>
</div>
<div class="row">
  <div class="col-12" align="center">
    <form action="/siacor/?main" method="POST">
      <?php $load->pagination(); ?>
    </form>
  </div>
</div>
  









<?php include 'views/users/footer.php'; }else{ session_destroy($_SESSION['Nombre']); header('location: /siacor/'); } ?>