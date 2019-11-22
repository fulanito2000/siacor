<?php session_start();
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
  function match($values){
  	if ($values==1) {
      $this->pagina = 1; //Por default, página = 1
    }else{
      $this->pagina = $values; //Por default, página = 1
    }
 	 $this->noRegistros = 10; //Registros por página
	$s="SELECT * FROM(
		SELECT a.*, rownum r__
		FROM
		(SELECT TAD.NO_ENTRADA_AYUDAS,TAD.ID_EJERCICIO,TAD.ID_ENTIDAD, TAP.RFC_BENEFICIARIO, TAD.DESCRIPCION
	  FROM TAB_AYUDAS_DETALLE TAD, TAB_AYUDAS_MAESTRO TAM, TAB_AYUDAS_PERSONAS TAP
	  WHERE TAD.NO_ENTRADA_AYUDAS = TAM.NO_ENTRADA_AYUDAS AND TAD.NO_ENTRADA_AYUDAS=TAP.NO_ENTRADA_AYUDAS ORDER BY TAD.NO_ENTRADA_AYUDAS DESC ) a
		WHERE rownum < (($this->pagina * $this->noRegistros) + 1 )
		)
		WHERE r__ >= ((($this->pagina-1) * $this->noRegistros) + 1)";
	$q=oci_parse($this->db, $s);
	oci_execute($q);
	while ($r=oci_fetch_array($q)) {
			echo "<tr>
				  <td>".$r[0]."</td>
				  <td>".$r[1]."</td>
				  <td>".$r[2]."</td>
				  <td>".$r[3]."</td>
				  <td>".$r[4]."</td>
				  <td><form action='/siacor/?ver_evidencia' method='POST'><input type='hidden' value='".$r[0]."' name='id'><button class='btn btn-outline-success' type='submit'><i class='fal fa-eye text-dark'></i></button></form></td>

				  <td><form action='/siacor/?editar_evidencia' method='POST'><input type='hidden' value='".$r[0]."' name='id'><button class='btn btn-outline-warning' type='submit'><i class='far fa-pencil text-dark'></i></button></form></td>

				  <td><form action='/siacor/?borrar_evidencia' method='POST'><input type='hidden' value='".$r[0]."' name='id'><button class='btn btn-outline-danger' type='submit'><i class='far fa-trash text-dark'></i></button></form></td>
				 </tr>";
	}
  }//llave de la funcion match
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
}//llave de la clase Actions
$load = new Actions();

?><br>
<a href='/siacor/?main'><i class='far fa-arrow-circle-left' style="font-size: 1.5rem;"></i></a>
<div class="table-responsive p-5">
	<table class="table table-hover">
		<thead class="thead-dark">
			<tr>
				<th>Número de Entrada</th>
				<th>Ejercicio</th>
				<th>Entidad</th>
				<th>Beneficiario</th>
				<th>Descripcion</th>
				<th><a href="/siacor/?add_evidences" class="btn btn-success"><i class="far fa-plus"></i></a></th>
				<th>Editar</th>
				<th>Borrar</th>
			</tr>
		</thead>
		<tbody>
			<?php
			if (isset($_POST['pagina'])) {
	          $load->match($_POST['pagina']);
	        } else {
	          $load->match(1);
	      	}?>
		</tbody>
	</table>
</div>
<div class="row"><a href='/siacor/?main'><i class='far fa-arrow-circle-left'></i>
  <div class="col-12" align="center">
    <form action="/siacor/?main" method="POST">
      <?php $load->pagination(); ?>
    </form>
  </div>
</div>



<?php include 'views/users/footer.php'; }else{ session_destroy($_SESSION['Nombre']); header('location: /siacor/'); }  ?>