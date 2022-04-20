<?php
class detalle_partidos extends toba_ci
{
	//-----------------------------------------------------------------------------------
	//---- cuadro_goles -----------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function conf__cuadro_goles(toba_ei_cuadro $cuadro)
	{
		$parametros = toba::memoria()->get_parametros();
        //ei_arbol($parametros, 'PARAMETROS recibidos');
		$adversario = $parametros['ri_desc'];
		$time = strtotime($parametros['fecha']);
        $myDate = date( 'Y-m-d', $time );
		$where = "WHERE gol_fecha = '$myDate' AND
					gol_juga = pl_id";
		$sql = "SELECT 
					gol_fecha,
					gol_juga,
					pl_apno,
					gol_parariver,
				gol_penal
				FROM 
					goles, players 
				$where";
		$datos = consultar_fuente($sql);
		//ei_arbol($datos, '$datos');
		$i = 0;
		foreach($datos as $reg) {
			if ($reg['gol_parariver'] == 1) {
				$datos[$i]['gol_parariver'] = 'RIVER PLATE';
			}
			else {
				$datos[$i]['gol_parariver'] = $adversario;
			}
			if ($reg['gol_penal'] == 1) {
				$datos[$i]['gol_penal'] = 'PENAL';
			}
			if ($reg['gol_penal'] == 2) {
				$datos[$i]['gol_penal'] = 'SIN DEFINIR';
			}
			if ($reg['gol_penal'] == 3) {
				$datos[$i]['gol_penal'] = 'CABEZA';
			}
			if ($reg['gol_penal'] == 4) {
				$datos[$i]['gol_penal'] = 'JUGADA';
			}
			if ($reg['gol_penal'] == 5) {
				$datos[$i]['gol_penal'] = 'TIRO LIBRE';
			}
			if ($reg['gol_penal'] == 6) {
				$datos[$i]['gol_penal'] = 'E/C';
			}
			$i = $i + 1;
		}
		$cuadro->set_datos($datos);
	}

}

?>