<?php 
//error_reporting(0);
$load = new pdfs();


	class pdfs
	{
		
		  function __construct()
		  {
		    include 'assets/query/driver_conection.php';
			$this->conectar = new Conectar();
			$this->db = $this->conectar->conexion();
			include 'views/users/secondary/cifras.php';
		  }//llave del constructor
		  function imprime($values){
		  	$id=$values['v'];
			$s="SELECT  
			TAM.EMPRESA AS EMPRESA,
			TAM.ID_EJERCICIO AS EJERCICIO,
			TAM.ID_ENTIDAD AS ENTIDAD,      
			LPAD(TAM.NO_ENTRADA_AYUDAS,6,'0') AS FOLIO,
			NVL(TAP.MONTO,0) AS CANTIDAD,
			'RECIBI DE LA TESORERIA MUNICIPAL DE ESTA CIUDAD, LA CANTIDAD DE : ' AS DESCRIPCION_CANTIDAD,
			'  ('||TRIM(REPLACE(RECPERA_NUMERO_LETRAS(NVL(TAP.MONTO,0)) ,'*'))||')' CANTIDAD_LETRAS,
			UPPER(JUSTIFICACION) CONCEPTO,
			TAM.FECHA,
			'A '||TO_CHAR(TAM.FECHA,'DD')||' DE '||TRIM(TO_CHAR(TAM.FECHA,'MONTH'))||' DEL '||TO_CHAR(TAM.FECHA,'RRRR') AS FECHA_LETRA,
			TAP.RFC_BENEFICIARIO,
			(select descripcion from tab_cl_beneficiarios where rfc=(select rfc_beneficiario from tab_ayudas_personas where no_entrada_ayudas='$id')) as NOMBRE,
			TCBD.DIRECCION,
			TCBD.CURP
			
			FROM TAB_AYUDAS_MAESTRO TAM ,
			TAB_AYUDAS_PERSONAS TAP,
			TAB_CL_BENEFICIARIOS TCB,
			TAB_CL_BENEFICIARIOS_DET TCBD
			
			WHERE TAM.NO_ENTRADA_AYUDAS='$id'
			AND TAM.ID_EJERCICIO=TAP.ID_EJERCICIO
			AND TAM.ID_ENTIDAD=TAP.ID_ENTIDAD
			AND TAM.NO_ENTRADA_AYUDAS=TAP.NO_ENTRADA_AYUDAS
			AND TAP.ID_EJERCICIO=TCB.ID_EJERCICIO(+)
			AND TAP.RFC_BENEFICIARIO=TCB.RFC(+)
			AND TAP.EMPRESA=TCB.EMPRESA(+)
			AND TAP.ID_EJERCICIO=TCBD.ID_EJERCICIO(+)
			AND TAP.RFC_BENEFICIARIO=TCBD.RFC(+)
			AND TAP.EMPRESA=TCBD.EMPRESA(+)
        		";
        	$q=oci_parse($this->db, $s);
			oci_execute($q);
        	$r=oci_fetch_assoc($q);
        	echo "<h2 style='position:absolute;top:180px;left:800px;white-space:nowrap' class='ft02'><b>FOLIO: <strong style='font-weight: bold;font-size:1.2rem;'>".$r['FOLIO']."</strong></b></h2>
        	<p style='position:absolute;top:209px;left:128px;white-space:nowrap' class='ft02'><b>Bueno&#160;por&#160;$&#160;_________<u>".$r['CANTIDAD']."</u>_________________________________________________&#160;</b></p>
			<p style='position:absolute;top:248px;left:128px;white-space:nowrap' class='ft02'><b>&#160;</b></p>
			<p style='position:absolute;top:248px;left:181px;white-space:nowrap' class='ft02'><b>&#160;</b></p>
			<p style='position:absolute;top:240px;left:224px;white-space:nowrap' class='ft03'><b>".$r['DESCRIPCION_CANTIDAD']."</b></p>
			<p style='position:absolute;top:287px;left:128px;white-space:nowrap' class='ft02'><b>________________ <u>".strtoupper(CifrasEnLetras::convertirCifrasEnLetras($r['CANTIDAD'])).$r['CANTIDAD_LETRAS']."</u>____________________________________________________&#160;</b></p>
			<p style='position:absolute;top:328px;left:128px;white-space:nowrap' class='ft02'><b>POR&#160;CONCEPTO&#160;DE:&#160;&#160;</b></p>
			<p style='position:absolute;top:368px;left:128px;white-space:nowrap' class='ft02'><b>&#160;</b>".$r['CONCEPTO']."</p>
			<p style='position:absolute;top:409px;left:128px;white-space:nowrap' class='ft02'><b>&#160;</b></p>
			<p style='position:absolute;top:449px;left:128px;white-space:nowrap' class='ft02'><b>TULANCINGO&#160;DE&#160;BRAVO&#160;HGO.&#160;&#160;".$r['FECHA_LETRA']."</b></p>
			<p style='position:absolute;top:490px;left:128px;white-space:nowrap' class='ft02'><b>NOMBRE:&#160;</b>".$r['NOMBRE']."</p>
			<!--p style='position:absolute;top:530px;left:128px;white-space:nowrap' class='ft02'><b>DIRECCIÓN:&#160;</b></p-->
			<p style='position:absolute;top:530px;left:128px;white-space:nowrap' class='ft02'><b>RFC:&#160;</b>".$r['RFC_BENEFICIARIO']."</p>
			<!--p style='position:absolute;top:611px;left:128px;white-space:nowrap' class='ft02'><b>CURP:&#160;</b></p-->
			<p style='position:absolute;top:652px;left:128px;white-space:nowrap' class='ft02'><b>&#160;</b></p>
			<p style='position:absolute;top:692px;left:128px;white-space:nowrap' class='ft02'><b>&#160;</b></p>
			<p style='position:absolute;top:733px;left:128px;white-space:nowrap' class='ft02'><b>&#160;</b></p>";
		  }//llave de la funcion
	}//llave de la clase
	
	
 ?>
<!DOCTYPE html>
<html xmlns='http://www.w3.org/1999/xhtml' lang='' xml:lang=''>
<head>
<title>SIACOR</title>

<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'/>
<link rel='stylesheet' href='resources/css/bootstrap/bootstrap.min.css'>
<style type='text/css'>
<!--
	p {margin: 0; padding: 0;}	.ft00{font-size:14px;font-family:Times;color:#000000;}
	.ft01{font-size:21px;font-family:Times;color:#ff0000;}
	.ft02{font-size:14px;font-family:Times;color:#000000;}
	.ft03{font-size:12px;font-family:Times;color:#000000;}
-->
*{
	color: black;
}
</style>
</head>
<body bgcolor='#A0A0A0' vlink='blue' link='blue'>
	
	<script>
		function ocultar(){
			 document.getElementById('ocultar').style.display = 'none';
			 var n = 0;
			 var l = document.getElementById('ocultar');
			 window.setInterval(function(){
  			 l.innerHTML = n;
             n++;
             if (n==9) {
             	document.getElementById('ocultar').style.display = 'block';
             }
             },10);
		}
	</script>
<div id='page1-div' style='position:relative;width:918px;height:1188px;'>
<img width='918' height='1188' src='resources/img/TESORER_A_MUNICIPAL001.png' alt='background image'/>
<p style='position:absolute;top:56px;left:128px;white-space:nowrap' class='ft00'>&#160;<input id='ocultar' type='button' name='imprimir' value='Imprimir' onclick='ocultar();window.print();' class='btn btn-outline-info'></p>
<p style='position:absolute;top:129px;left:316px;white-space:nowrap' class='ft01'><b>TESORERÍA&#160;MUNICIPAL.&#160;</b></p>
<p style='position:absolute;top:169px;left:128px;white-space:nowrap' class='ft00'>&#160;</p>
<?php $load->imprime($_GET); ?>
<p style='position:absolute;top:600px;left:266px;white-space:nowrap' class='ft02'><b>__________________________________________&#160;</b></p>
<p style='position:absolute;top:650px;left:363px;white-space:nowrap' class='ft02'><b>TESORERIA&#160;MUNICIPAL&#160;</b></p>
<p style='position:absolute;top:854px;left:128px;white-space:nowrap' class='ft00'>&#160;</p>
</div>
</body>
</html>
