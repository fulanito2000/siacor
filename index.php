<?php 
$url = $_SERVER['REQUEST_URI'];
if ($url=='/siacor/' || $url=='/siacor/?access') {
	include 'views/access.php';
} else {
	$opcion = str_replace('/siacor/?', '#', $url);
	switch ($opcion) {
		case '#login':
			include 'model/login/match.php';
			break;
		case '#main':
			include 'views\users\general\main.php';
			break;
		case '#add': /* Pantalla que te reenvia al formulario para agregar ayudas */
			include 'views/users/secondary/agregar_ayudas.php';
			break;
		case '#edit': /* Pantalla que te reenvia al formulario para editar las ayudas */
			include 'views/users/secondary/editar_ayudas.php';
			break;
		case '#evidences': /* Pantalla que te manda a la `pàgina principal de evidencias */
			include 'views/users/general/main_evidencia.php';
			break;
		case '#add_evidences': /* Pantalla que te manda a la `pàgina principal de evidencias */
			include 'views/users/secondary/evidencias.php';
			break;
		case '#editar_evidencia':
			include 'views/users/secondary/editar_evidencia.php';
			break;
		case '#buscar':
			include 'views/users/secondary/buscar.php';
			break;
		case '#pdf':
			include 'views/users/secondary/pdf.php';
			break;

		case '#close':
			include 'model\close\close.php';
			break;
			/**
			 * crud usuarios
			 */
		case '#insertar_agregar_ayudas'://guardar registros
			include 'model/insertar_agregar_ayudas/insertar_agregar_ayudas.php';
			break;
		case '#actualizar_editar_ayudas':
			include 'model/actualizar_editar_ayudas/actualizar_editar_ayudas.php';
			break;
		case '#delete_ayuda':
			include 'model/delete_ayuda/delete_ayuda.php';
			break;
		case '#insertar_agregar_evidencias':
			include 'model/insertar_agregar_evidencias/insertar_agregar_evidencias.php';
			break;
		case '#ver_evidencia':
			include 'views/users/secondary/ver_evidencia.php';
			break;
		case '#actualizar_editar_evidencia':
			include 'model/actualizar_editar_evidencia/actualizar_editar_evidencia.php';
			break;
		case '#borrar_evidencia':
			include 'model/borrar_evidencia/borrar_evidencia.php';
			break;
		default:
			echo "ERRROR 404!";
			break;
	}
}
//SELECT  valida_usuario('HEMM880606','1','') AS USUARIO FROM TAB_CL_EMPLEADOS WHERE USUARIO='HEMM880606'



 ?>