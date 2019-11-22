<?php 
session_start();
if (isset($_POST['id']) and $_SESSION['Nombre']) {
    include 'views/users/header.php';
$load = new Show();
$load->show($_POST['id']);


}else{
    header('location: /siacor/?main');
}
/**
 * 
 */
class Show
{
    
    function __construct()
  {
    include 'assets/query/driver_conection.php';
    $this->conectar = new Conectar();
    $this->db = $this->conectar->conexion();
  }//llave del constructor
 
  function show($id){
   $s="SELECT TAM.ID_EJERCICIO AS IDS, (SELECT TAE.NOMBRE_ENTIDAD FROM TAB_AYUDAS_ENTIDAD TAE WHERE TAE.ID_ENTIDAD=TAM.ID_ENTIDAD) AS ENTIDAD, TAM.ID_ENTIDAD AS ID_ENT, TAM.JUSTIFICACION AS JUSTIFICACION, TO_CHAR(TAM.FECHA, 'dd/mm/yyyy') AS FECHA,  (SELECT TAF.DESCRIPCION FROM TAB_AYUDAS_FUENTE TAF WHERE TAF.ID_FFINANACIAMIENTO=TAM.FUENTE) AS FUENTE,TAM.FUENTE AS ID_F, TAM.LUGAR_DESTINO AS LUGAR, TAM.TIPO_MOVIMIENTO AS MOVIMIENTO,TAP.RFC_BENEFICIARIO AS BENEFICIARIO,TAP.ESTRUCTURA_PROGRAMTICA AS ESTRUCTURA, TAP.MONTO AS MONTO, TAM.EMPRESA AS ID
   FROM TAB_AYUDAS_MAESTRO TAM, TAB_AYUDAS_PERSONAS TAP
   WHERE TAM.NO_ENTRADA_AYUDAS='$id' AND TAP.NO_ENTRADA_AYUDAS='$id'";
    $q=oci_parse($this->db, $s);
    oci_execute($q);
    $r=oci_fetch_assoc($q);    
    $this->ben=$r["BENEFICIARIO"];
    $this->ids=$r["ID_ENT"];
    $fuente=$r['FUENTE'];
    $fuente= substr($fuente,4);
    echo "<style>select{width: 150px;}</style><div class='col-md-8 offset-md-2'>
                        <span class='anchor' id='formUserEdit'></span>
                        <hr class='my-5'>
                        <div class='card card-outline-secondary'>
                        <div class='card-header'>
                            <h3 class='mb-0'><a href='/siacor/?main'><i class='far fa-arrow-circle-left'></i></a>  Editar Ayudas </h3>
                        </div>
                        <div class='card-body'>
                            <form class='form' role='form' autocomplete='off' action='/siacor/?actualizar_editar_ayudas' method='POST'>
                                <div class='form-group row'>
                                    <label class='col-lg-3 col-form-label form-control-label'>Ejercicio</label>
                                    <div class='col-lg-9'>
                                        <input name='ejercicio' class='form-control' type='text' value=".$r["IDS"].">
                                        <input type='hidden' name='id' value='$id'>
                                    </div>
                                </div>
                                <div class='form-group row'>
                                    <label class='col-lg-3 col-form-label form-control-label'>Entidad</label>
                                    <div class='col-lg-9'>
                                        <select name='entidad'>
                                            <option value=".$r["ID_ENT"].">".$r["ENTIDAD"]."</option>
                                            {$this->select_entidad()}
                                        </select>
                                    </div>
                                </div>
                                <div class='form-group row'>
                                    <label class='col-lg-3 col-form-label form-control-label'>Justificación</label>
                                    <div class='col-lg-9'>
                                        <input name='justificacion' class='form-control' type='text' value=".$r["JUSTIFICACION"].">
                                    </div>
                                </div>
                                <div class='form-group row'>
                                    <label class='col-lg-3 col-form-label form-control-label'>Fecha</label>
                                    <div class='col-lg-9'>
                                        <input name='fecha' class='form-control' type='text' value=".$r["FECHA"].">
                                    </div>
                                </div>
                                <div class='form-group row'>
                                    <label class='col-lg-3 col-form-label form-control-label'>Fuente</label>
                                    <div class='col-lg-9'>
                                    <select name='fuente'>
                                        <option value='{$r['ID_F']}'>{$fuente}</option>
                                        {$this->fuente()}
                                    </select>
                                    </div>
                                </div>
                                   <div class='form-group row'>
                                    <label class='col-lg-3 col-form-label form-control-label'>Lugar</label>
                                    <div class='col-lg-9'>
                                        <input name='lugar' class='form-control' type='text' value=".$r["LUGAR"].">
                                    </div>
                                </div>
                                <div class='form-group row'>
                                    <label for='tipo_movimiento' class='col-lg-3 col-form-label form-control-label'>Tipo de movimiento</label>
                                    <div class='col-lg-9'>
                                        <select name='tipo_movimiento' class='custom-select'>
                                          <option value='".$r["MOVIMIENTO"]."'>".ucwords($r["MOVIMIENTO"])."</option>
                                          <option value='ayuda'>Ayuda</option>
                                          <option value='proveedor'>Proveedor</option>
                                          <option value='contratista'>Contratista</option>
                                          <option value='acreedor'>Acreedor</option>
                                          <option value='otros'>Otros</option>  
                                        </select>
                                    </div>
                                </div>
                                <div class='form-group row'>
                                    <label class='col-lg-3 col-form-label form-control-label'>Beneficiario</label>
                                    <div class='col-lg-9'>
                                    <select name='beneficiario'>
                                        <option value='".$r["BENEFICIARIO"]."'>{$this->beneficiario()}</option>
                                        {$this->beneficiarios_lista()}
                                    </select>
                                    </div>
                                </div>
                                <div class='form-group row'>
                                    <label class='col-lg-3 col-form-label form-control-label'>Clave programàtica</label>
                                    <div class='col-lg-9'>
                                        <input name='estructura' class='form-control' type='text' value=".$r["ESTRUCTURA"].">
                                    </div>
                                </div>
                                  <div class='form-group row'>
                                    <label class='col-lg-3 col-form-label form-control-label'>Monto</label>
                                    <div class='col-lg-9'>
                                        <input name='monto' class='form-control' type='text' value=".$r["MONTO"].">
                                    </div>
                                </div>
                                <div class='form-group row'>
                                    <label class='col-lg-3 col-form-label form-control-label'></label>
                                    <div class='col-lg-9'>
                                        <input  type='submit' class='btn btn-primary' value='Editar cambios'>
                                    </div>
                                </div>
                            </form>
                        </div>
                        </div>
                    </div>";
  }//function show
  function select_entidad(){
    $this->sql="SELECT ID_ENTIDAD,NOMBRE_ENTIDAD FROM TAB_AYUDAS_ENTIDAD WHERE ID_ENTIDAD!=$this->ids";
    $this->query=oci_parse($this->db, $this->sql);
    oci_execute($this->query);
    $a = '';
    while ($row = oci_fetch_array($this->query) )
    {
      $a.="<option value='{$row[0]}'>{$row[1]}</option>";  
    }//llave del while
    return $a;
  }//llave de la funcion select_entidad
  function beneficiario(){
    $s="SELECT DESCRIPCION FROM TAB_CL_BENEFICIARIOS WHERE RFC='$this->ben'";
    $q=oci_parse($this->db, $s);
    oci_execute($q);
    $row = oci_fetch_assoc($q);
    return $row['DESCRIPCION'];  
       
  }//llave de la funcion beneficiario
  function beneficiarios_lista(){
    $s="SELECT RFC,DESCRIPCION FROM TAB_CL_BENEFICIARIOS WHERE RFC!='$this->ben'";
    $this->query=oci_parse($this->db, $s);
    oci_execute($this->query);
    $a = '';
    while ($row = oci_fetch_array($this->query) )
    {
      $a.="<option value='{$row[0]}'>{$row[1]}</option>";  
    }//llave del while
    return $a;     
  }//llave de la funcion beneficiario
   function fuente(){
    $this->s="SELECT ID_FFINANACIAMIENTO,DESCRIPCION FROM TAB_CL_FFINANCIAMIENTO";
    $this->q=oci_parse($this->db, $this->s);
    oci_execute($this->q);
    $a='';
    while ($row = oci_fetch_array($this->q) )
      {
        $a.= "<option value='{$row[0]}'>".substr($row[1],4)."</option>";  
      }//llave del while
      return $a;
  }//llave de la funcion fuente
}//llave de la clase
 ?>


                     
<?php include 'views/users/footer.php'; ?>