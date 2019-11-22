<?php //HERA650221
$load = new Acceso();
$load->match($_POST);
class Acceso
{
	
	function __construct()
	{
		include 'assets/query/driver_conection.php';
		$this->conectar = new Conectar();
		$this->db = $this->conectar->conexion();
	}//llave del constructor
	function match($values){
		$tipo=$values['tipo'];
		$usr=$values['user'];
		if ($tipo=1) {
			$s="select valida_usuario('$usr', '1', '') as usuario from tab_cl_empleados ";
			$q= oci_parse($this->db, $s);
			oci_execute($q);
			$r=oci_fetch_assoc($q);
			if($r['USUARIO']=='NO EXISTE USUARIO'){
				echo "<script>alert('ERROR! Usuario incorrecto');window.location='/siacor/?access';</script>";
			}else{
				session_start();
				$_SESSION['Nombre']=$r['USUARIO'];
				$_SESSION['Empresa']=$values['empresa'];
				$_SESSION['Ejercicio']=$values['year'];
				header('location: /siacor/?main');
			}
		}elseif ($tipo=2) {
			$pws=$values['pass'];
			$s="select valida_usuario('$usr', '2', '$pws') as usuario from tab_cl_empleados ";
			$q= oci_parse($this->db, $s);
			oci_execute($q);
			$r=oci_fetch_assoc($q);
			if($r['USUARIO']=='NO EXISTE USUARIO'){
				echo "<script>alert('ERROR! Usuario o Contraseña Incorrectos');window.location:'/siacor/?access';</script>";
			}else{
				session_start();
				$_SESSION['Nombre']=$r['USUARIO'];
				$_SESSION['Empresa']=$values['empresa'];
				$_SESSION['Ejercicio']=$values['year'];
				header('location: /siacor/?main');
			}
		}else{
			echo "<script>alert('ERROR! Usuario o Contraseña Incorrectos');window.location='/siacor/?access';</script>";
		}
		
	}//llave de la funcion match
}//llave de la clase

 ?>