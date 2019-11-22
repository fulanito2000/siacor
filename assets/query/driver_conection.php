<?php
class Conectar
{
	
	function __construct()
	{
		if (file_exists('assets/query/data.ini')) {
			$this->db_config= parse_ini_file('assets/query/data.ini');

			$this->host=$this->db_config["host"]."/".$this->db_config["database"];
			
			$this->user=$this->db_config["usr"];
			
			$this->pass=$this->db_config["pws"];

			$this->driver=$this->db_config["driver"];

			$this->charset=$this->db_config["charset"];
			

		}else{
			die("<h1>Error!  File of conection Don´t Exist</h1>");
			exit();
		}

	}//llave de la funcion __construct

	function conexion()
	{
		if ($this->driver=="oracle" || $this->driver==null)
			{
				$this->con = oci_connect($this->user, $this->pass, $this->host, $this->charset);
				if (!$this->con) {    //si los valores de esta conexiòn son diferentes
					$this->m = oci_error();     
					echo $this->m['message'], "n"; //marcarà un mensaje de error    
					exit; 
				}else{
					return($this->con); //si los valores son correctos retorna el parametro de la conexion 
				}
			}else{
				echo "<h1>Error! Bad driver</h1>"; //si està mal marcarà el mensaje de controlador incorrecto
				exit();
			}

	}//llave de la funcion conexion

}// llave de la clase conectar


/*
// crear conexion con oracle
$con = oci_conect("system", "cocodril0", "localhost/PRESIDENCIA"); 
 
if (!$con) {    
  $m = oci_error();    
  echo $m['message'], "n";    
  exit; 
} else {    
  echo "Conexion con exito a Oracle!"; } 
$stid = oci_parse($con, 'SELECT * FROM prueba');
oci_execute($stid);

echo "<table border='1'>\n";
while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
    echo "<tr>\n";
    foreach ($row as $item) {
        echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "") . "</td>\n";
    }
    echo "</tr>\n";
}
echo "</table>\n";*/
?>
