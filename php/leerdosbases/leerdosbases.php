<?php
class leerdosbases extends toba_ci
{
	//-----------------------------------------------------------------------------------
	//---- cuadro1 ----------------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function conf__cuadro1(toba_ei_cuadro $cuadro)
	{
		$sql = "SELECT * FROM arbitros";
		$datos = consultar_fuente($sql);
		//$datos = toba::db('fulbo')->consultar($sql);
		$cuadro->set_datos($datos);
		$user_logueado = trim(toba::usuario()->get_nombre());
		ei_arbol($user_logueado);
	}

	//-----------------------------------------------------------------------------------
	//---- cuadro2 ----------------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function conf__cuadro2(toba_ei_cuadro $cuadro2)
	{
		$sql = "SELECT usuario, area FROM usuarios_areas";
		$datos = toba::db('comdoc')->consultar($sql);
		//$datos = consultar_fuente($sql);
		$cuadro2->set_datos($datos);
		$sql = "INSERT INTO usuarios_areas (usuario, area) VALUES ('pete', 'petito')";
		toba::db('comdoc')->consultar($sql);
	}

}
?>