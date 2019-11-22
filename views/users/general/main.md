<?php include 'views/users/header.php';
//error_reporting(0);
class Actions
{
  
  function __construct()
  {
    include 'assets/query/driver_conection.php';
	$this->conectar = new Conectar();
	$this->db = $this->conectar->conexion();
  }//llave del constructor

  function show_data()
  {
	$this->sql="SELECT TAM.ID_EJERCICIO AS IDS, TAM.ID_ENTIDAD AS ENTIDAD, TAM.JUSTIFICACION AS JUSTIFICACION, TO_CHAR(TAM.FECHA, 'dd/mm/yyyy') AS FECHA, TAM.FUENTE AS FUENTE, TAM.LUGAR_DESTINO AS LUGAR, TAM.TIPO_MOVIMIENTO AS MOVIMIENTO,TAP.RFC_BENEFICIARIO AS BENEFICIARIO,TAP.ESTRUCTURA_PROGRAMTICA AS ESTRUCTURA, TAP.MONTO AS MONTO, TAM.EMPRESA AS ID
	FROM TAB_AYUDAS_MAESTRO TAM, TAB_AYUDAS_PERSONAS TAP
	WHERE TAM.EMPRESA= TAP.EMPRESA  ORDER BY TAM.EMPRESA ASC";
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
            <td scope='col'></td>
            <td scope='col'><form action='/oracle/?edit' method='POST'><input name='id' type='hidden' value='{$row[10]}'><button type='submit' class='btn btn-outline-primary'><i class='fas fa-edit'></i></button></form></td>
            <td scope='col'><form action='/oracle/?delete_ayuda' method='POST'><input name='id' type='hidden' value='{$row[10]}'><button type='submit' class='btn btn-outline-danger'><i class='fas fa-trash'></i></button></form></td>
            <td scope='col'><a class='btn btn-outline-info' href='/oracle/?evidences'><i class='fas fa-file-plus'></i></a></td>
              </tr>";
      }//llave del while
  	

  }//llave de la funcion show_data
  function show($values){
    $s="SELECT TAM.ID_EJERCICIO AS IDS, TAM.ID_ENTIDAD AS ENTIDAD, TAM.JUSTIFICACION AS JUSTIFICACION, TO_CHAR(TAM.FECHA, 'dd/mm/yyyy') AS FECHA, TAM.FUENTE AS FUENTE, TAM.LUGAR_DESTINO AS LUGAR, TAM.TIPO_MOVIMIENTO AS MOVIMIENTO,TAP.RFC_BENEFICIARIO AS BENEFICIARIO,TAP.ESTRUCTURA_PROGRAMTICA AS ESTRUCTURA, TAP.MONTO AS MONTO
  FROM TAB_AYUDAS_MAESTRO TAM, TAB_AYUDAS_PERSONAS TAP
  WHERE TAM.ID_EJERCICIO= TAP.ID_EJERCICIO AND TAM.JUSTIFICACION LIKE '%u%' ORDER BY TAM.EMPRESA DESC";
  }//llave de la funcion show

}//llave de la clase

$load = new Actions();

 ?>
<div class="row" align="center">
<div class="col-12">  
  <form action="/oracle/?main" method="POST">
    <div class="form-group">
      <select name="tipo" id="">
        <option value="beneficiarios">Beneficiarios</option>
        <option value="funte">Fuente</option>
      </select>
      <input class="search" name="search" type="text" placeholder="Buscar....">
      <button type="submit" class="btn btn-info"><i class="fal fa-search"></i></button>

      <a class="btn btn-danger" href="/oracle/?main">Cancelar</a>

    </div>
  </form>
</div> 
</div>  

<table class='table table-hover table-responsive'>
  <thead class='thead-dark'>
      <tr>
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
      <th><a class='btn btn-outline-success' href='/oracle/?add'><i class='fal fa-plus-circle'></i></a></th>
      <th>Editar</th>
      <th>Eliminar</th>
      <th>Agregar Evidencia</th>
    	</tr>
    </thead>
    <tbody>
   		<?php 
      if (isset($_POST["search"])) {

        $load->show($_POST);
      } else {
        echo "<td colspan='14' class='text-center'><h1>".$load->show_data()."</h1></td>";
      }
      
        
      ?>
   	</tbody>
</table>










<?php include 'views/users/footer.php'; ?>