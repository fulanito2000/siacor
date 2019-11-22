<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    
    <link rel="stylesheet" href="resources/css/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="resources/css/bootstrap/node_modules/bootswatch/dist/flatly/bootstrap.min.css">
    <link rel="stylesheet" href="resources/css/bootstrap/node_modules/bootswatch/dist/flatly/bootstrap.css">
    <title>SIACOR</title>
  </head>
  <body class="bg-white">
    <style>
      @import url('https://fonts.googleapis.com/css?family=Quicksand');
      body{
        overflow-x: hidden;
      }
      table td{
        font-family: 'Quicksand', san-serif;
      }
    </style>
    <nav class="navbar navbar-expand-lg navbar-primary bg-primary">
  <a class="navbar-brand" href="/siacor/?main">Bienvenido(a): <span><?php echo $_SESSION['Nombre']; ?></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarColor01">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Ayudas<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
       <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
       <i class="fas fa-question"></i>
</button>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Guìa para el usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab"  href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Agregar Ayuda <i class='fal fa-plus-circle'></i></a>
    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Imprimir reporte <i class='fal fa-file-pdf'></i></a>
    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Agregar evidencia <i class='fas fa-file-plus'></i></a>
  </div>
</nav>
<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">Para agregar una ayuda basta con darle click al ìcono que aparece en la tabla principal.</div>
  <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">Para imprimir un reporte primero se tiene que llenar el formulario de agregar ayuda, una vez que la ayuda sea agregada, se debe darle click al icono correspondiente.</div>
  <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">El proceso para agregar una evidencia es parecido al agregar una ayuda, solo que la unica diferencia es que se debe dar click al botòn de agregar evidencia y este automàticamente desplegara una tabla parecida a la vista principal de evidencias y al darle click al icono de agregar evidencia se podràn agregar mediante su respectivo formulario.</div>
</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar Ayuda</button>
      </div>
    </div>
  </div>
</div>

      </li>
      
      <li class="nav-item">
        <a class="nav-link" href="/siacor/?close" style="font-size: 1.5rem;"><i class="far fa-sign-out-alt"></i></a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0" action="/siacor/?buscar" method="POST">
      <select name="tipo" class="custom-select">
        <option value="NO_ENTRADA_AYUDAS">Número de entrada</option>
        <option value="ID_EJERCICIO">Ejercicio</option>
        <option value="RFC_BENEFICIARIO">Beneficiarios</option>
      </select>&nbsp;
      <input name="search" type="text" class="form-control mr-sm-2" type="text" placeholder="Buscar...">
      <button class="btn btn-danger my-2 my-sm-0" type="submit"><i class="fal fa-search"></i></button>
    </form>
  </div>
</nav>
