<?php 
session_start();
if (isset($_SESSION['Nombre'])) {
include 'views/users/header.php'; 
setlocale(LC_ALL,"es_ES");
class Actions
{
  
  function __construct()
  {
    include 'assets/query/driver_conection.php';
  $this->conectar = new Conectar(); // aqui se llama a la clase conectar
  $this->db = $this->conectar->conexion(); 
  }//llave del constructor

  function entidad()
  {
  $this->sql="SELECT ID_ENTIDAD,NOMBRE_ENTIDAD FROM TAB_AYUDAS_ENTIDAD";
  $this->query=oci_parse($this->db, $this->sql);
  oci_execute($this->query);
  while ($row = oci_fetch_array($this->query) )
    {
     //var_dump($row);
      echo "<option value='{$row[0]}'>{$row[1]}</option>";  
    }//llave del while
  }//llave de la funcion entidad

  function fuente(){
    $this->s="SELECT ID_FFINANACIAMIENTO,DESCRIPCION FROM TAB_CL_FFINANCIAMIENTO";
    $this->q=oci_parse($this->db, $this->s);
    oci_execute($this->q);
    while ($row = oci_fetch_array($this->q) )
      {
        echo "<option value='{$row[0]}'>".substr($row[1],4)."</option>";  
      }//llave del while
  }//llave de la funcion fuente
  function beneficiarios_lista(){
    $s1="SELECT RFC,DESCRIPCION FROM TAB_CL_BENEFICIARIOS";
    $this->query1=oci_parse($this->db, $s1);
    oci_execute($this->query1);
    while ($rows = oci_fetch_array($this->query1) )
    {
      echo "<option value='{$rows[0]}'>{$rows[1]}</option>";  
    }//llave del while
        
  }//llave de la funcion beneficiario
}//llave de la clase

$load = new Actions();
?>

<div class="col-md-8 offset-md-2">
                    <span class="anchor" id="formUserEdit"></span>
                    <hr class="my-5">

                    <!-- Formulario info -->
                    <div class="card card-outline-secondary">
                        <div class="card-header text-center">
                            <h3 class="mb-0"><a href="/siacor/?main"><i class="far fa-arrow-circle-left"></i></a> Agregar Ayudas</h3>
                        </div>
                        <div class="card-body">
                            <form class="form" role="form" autocomplete="off" method="POST" action="/siacor/?insertar_agregar_ayudas">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label" for="ejercicio">Ejercicio</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" type="text" name="ejercicio" value="<?php echo date("Y"); ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label" for="entidad">Entidad</label>
                                    <div class="col-lg-9">
                                       <select name="entidad" class="custom-select">
                                        <option name="">Elige una Opciòn</option>
                                       <?php $load->entidad(); ?>                                         
                                       </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label" for="justificacion">Justificación</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" type="text" name="justificacion">
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">Fecha</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" type="text" name="fecha" value="<?php echo date('j/m/Y'); ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label" for="fuente">Fuente</label>
                                    <div class="col-lg-9">
                                      
                                        <select name="fuente" id="" class="custom-select">
                                          <option>Elige una opción</option>
                                          <?php $load->fuente(); ?>
                                        </select>
                                    </div>
                                </div>
                           		   <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label" for="lugar">Lugar</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" type="text" name="lugar">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label" for="tipo_movimiento">Tipo de movimiento</label>
                                    <div class="col-lg-9">
                                        <select name="tipo_movimiento" class="custom-select">
                                          <option value="">Elige una opción</option>
                                          <option value="ayuda">Ayuda</option>
                                          <option value="proveedor">Proveedor</option>
                                          <option value="contratista">Contratista</option>
                                          <option value="acreedor">Acreedor</option>
                                          <option value="otros">Otros</option>  
                                        </select>
                                        
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label" for="beneficiario">Beneficiarios</label>
                                    <div class="col-lg-9">
                                        <select name='beneficiario' class="custom-select">  
                                        <option value="">Elige una Opción</option>            
                                        <?php $load->beneficiarios_lista(); ?>
                                    </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label" for="clave_programatica">Clave programàtica</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" type="text" name="clave_programatica">
                                    </div>
                                </div>
                                  <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label" for="monto">Monto</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" type="number" name="monto" step="any">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label"></label>
                                    <div class="col-lg-9">
                                        <button class="btn btn-danger" type='reset'>Cancelar</button>
                                        <button class="btn btn-success">Guardar cambios</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /form user info -->

                </div>
                <br>


<?php include 'views/users/footer.php'; }else{ session_destroy($_SESSION['Nombre']); header('location: /siacor/'); }  ?>