<?php 
$con = oci_connect("system", "cocodril0", "localhost/PRESIDENCIA");
$q=oci_parse($con, "SELECT  TAB_AYUDAS_MAESTRO.EMPRESA, 
				TAB_AYUDAS_MAESTRO.ID_EJERCICIO, 
				TAB_AYUDAS_MAESTRO.ID_ENTIDAD, 
				LPAD(TAB_AYUDAS_MAESTRO.NO_ENTRADA_AYUDAS,6,'0') FOLIO,
				SUM(NVL(MONTO,0)) CANTIDAD,
				'RECIBI DE LA TESORERIA MUNICIPAL DE ESTA CIUDAD, LA CANTIDAD DE : 'DESCRIPCION_CANTIDAD,
				'  ('||TRIM(REPLACE(RECPERA_NUMERO_LETRAS(SUM(NVL(MONTO,0))) ,'*'))||')' CANTIDAD_LETRAS,
				UPPER(JUSTIFICACION) CONCEPTO,
				FECHA,
				'A '||TO_CHAR(FECHA,'DD')||' DE '||TRIM(TO_CHAR(FECHA,'MONTH'))||' DEL '||TO_CHAR(FECHA,'RRRR') FECHA_LETRA,
				TAB_AYUDAS_PERSONAS.RFC_BENEFICIARIO,
				TAB_CL_BENEFICIARIOS.DESCRIPCION,
				TAB_CL_BENEFICIARIOS_DET.DIRECCION,
				TAB_CL_BENEFICIARIOS_DET.CURP
				FROM     TAB_AYUDAS_MAESTRO,TAB_AYUDAS_PERSONAS,TAB_CL_BENEFICIARIOS ,TAB_CL_BENEFICIARIOS_DET
				WHERE    1=1
				AND      TAB_AYUDAS_MAESTRO.NO_ENTRADA_AYUDAS= 8
				AND      TAB_AYUDAS_MAESTRO.EMPRESA=TAB_AYUDAS_PERSONAS.EMPRESA
				AND      TAB_AYUDAS_MAESTRO.ID_EJERCICIO=TAB_AYUDAS_PERSONAS.ID_EJERCICIO
				AND      TAB_AYUDAS_MAESTRO.ID_ENTIDAD=TAB_AYUDAS_PERSONAS.ID_ENTIDAD
				AND      TAB_AYUDAS_MAESTRO.NO_ENTRADA_AYUDAS=TAB_AYUDAS_PERSONAS.NO_ENTRADA_AYUDAS
				AND      TAB_AYUDAS_PERSONAS.ID_EJERCICIO=TAB_CL_BENEFICIARIOS.ID_EJERCICIO(+)
				AND      TAB_AYUDAS_PERSONAS.RFC_BENEFICIARIO=TAB_CL_BENEFICIARIOS.RFC(+)
				AND      TAB_AYUDAS_PERSONAS.EMPRESA=TAB_CL_BENEFICIARIOS.EMPRESA(+)
				AND      TAB_AYUDAS_PERSONAS.ID_EJERCICIO=TAB_CL_BENEFICIARIOS_DET.ID_EJERCICIO(+)
				AND      TAB_AYUDAS_PERSONAS.RFC_BENEFICIARIO=TAB_CL_BENEFICIARIOS_DET.RFC(+)
				AND      TAB_AYUDAS_PERSONAS.EMPRESA=TAB_CL_BENEFICIARIOS_DET.EMPRESA(+)
				AND       & CONDICION 1=1
				GROUP BY JUSTIFICACION,FECHA,TAB_AYUDAS_MAESTRO.EMPRESA, 
				TAB_AYUDAS_MAESTRO.ID_EJERCICIO, 
				TAB_AYUDAS_MAESTRO.ID_ENTIDAD, 
				TAB_AYUDAS_MAESTRO.NO_ENTRADA_AYUDAS,
				TAB_CL_BENEFICIARIOS.DESCRIPCION, 
				TAB_AYUDAS_PERSONAS.RFC_BENEFICIARIO,
				TAB_CL_BENEFICIARIOS_DET.DIRECCION,
				TAB_CL_BENEFICIARIOS_DET.CURP
				ORDER BY TAB_AYUDAS_MAESTRO.ID_EJERCICIO, 
				TAB_AYUDAS_MAESTRO.ID_ENTIDAD, 
				TAB_AYUDAS_MAESTRO.NO_ENTRADA_AYUDAS");
oci_execute($q);
$nrows = oci_fetch_all($q, $res);

echo "$nrows filas obtenidas<br>\n";
var_dump($res);
 ?>