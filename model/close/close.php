<?php 
session_start();
if (isset($_SESSION['Nombre'])) {
	session_destroy($_SESSION['Nombre']);
	session_destroy($_SESSION['Empresa']);
	session_destroy($_SESSION['Ejercicio']);
	header('location: /siacor/?access');
}else{
	session_destroy($_SESSION['Nombre']);
	session_destroy($_SESSION['Empresa']);
	session_destroy($_SESSION['Ejercicio']);
	header('location: /siacor/?access');
}

 ?>