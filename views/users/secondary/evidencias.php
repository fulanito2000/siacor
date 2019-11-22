<?php 
session_start();
if (isset($_SESSION['Nombre'])) {
include 'views/users/header.php';
/**
 * 
 */
class evidencias
{
    
     function __construct()
  {
    include 'assets/query/driver_conection.php';
    $this->conectar = new Conectar();
    $this->db = $this->conectar->conexion();
  }//llave del constructor
  function beneficiarios(){
    $s="SELECT TAM.NO_ENTRADA_AYUDAS,TAP.RFC_BENEFICIARIO
    FROM TAB_AYUDAS_MAESTRO TAM,TAB_AYUDAS_PERSONAS TAP
    WHERE TAM.NO_ENTRADA_AYUDAS=TAP.NO_ENTRADA_AYUDAS ORDER BY TAM.NO_ENTRADA_AYUDAS DESC";
    $q=oci_parse($this->db, $s);
    oci_execute($q);
    echo "<select name='id' class='custom-select'>";
    while ($r=oci_fetch_array($q)) {
        echo "<option value='{$r[0]}'>{$r[0]}</option>";
    }
    echo "</select>";
  }//llave de la funcion beneficiarios
}//llave de la clase
$load = new evidencias();
 ?>
   <div class="col-md-8 offset-md-2">
                    <span class="anchor" id="formUserEdit"></span>
                    <hr class="my-5">
					<style>
						#file-preview{
							height: 200px;
							width: 200px;
						}
					</style>
                    <!-- Formulario info -->
                    <div class="card card-outline-secondary">
                        <div class="card-header">
                            <h3 class="mb-0"><a href='/siacor/?evidences'><i class='far fa-arrow-circle-left'></i> </a>Agregar Evidencias</h3>
                        </div>
                        <div class="card-body">
                            <form class="form" role="form" autocomplete="off" method="POST" action="/siacor/?insertar_agregar_evidencias" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label" for="entrada">Entrada</label>
                                    <div class="col-lg-9">
                                        <?php $load->beneficiarios(); ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label" for="observacion">Observaciòn</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" type="text" name="observacion" placeholder="observacion">
                                    </div>
                                </div>
                           		   <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label" for="ticket">Imàgen</label>
                                    <div class="col-lg-9">
                                        <input id="file-upload" type="file" accept="image/*" name="ticket" />
                                        <div id="file-preview-zone" >
    									</div>
                                    </div>
                                </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label"></label>
                                    <div class="col-lg-9">
                                        <input type="reset" class="btn btn-secondary" value="Cancelar">
                                        <button class="btn btn-primary">Guardar cambios</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /form user info -->

                </div>

<script>
    function readFile(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
 
            reader.onload = function (e) {
                var filePreview = document.createElement('img');
                filePreview.id = 'file-preview';
                //e.target.result contents the base64 data from the image uploaded
                filePreview.src = e.target.result;
                console.log(e.target.result);
 
                var previewZone = document.getElementById('file-preview-zone');
                previewZone.appendChild(filePreview);
            }
 
            reader.readAsDataURL(input.files[0]);
        }
    }
 
    var fileUpload = document.getElementById('file-upload');
    fileUpload.onchange = function (e) {
        readFile(e.srcElement);
    }
 
</script>
<?php 
include 'views/users/footer.php';}else{ session_destroy($_SESSION['Nombre']); header('location: /siacor/'); }

 ?>