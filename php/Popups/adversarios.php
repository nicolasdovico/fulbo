<?php 

require_once('Popups/consultas.php');

class adversarios extends toba_ci
{
	//-----------------------------------------------------------------------------------
	//---- DEPENDENCIAS -----------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	//---- cuadro -----------------------------------------------------------------------

	//El formato del retorno debe ser array( array('columna' => valor, ...), ...)
	//function conf__cuadro(toba_ei_cuadro $cuadro)
	//{
	//	$sql = "SELECT * FROM rivales ORDER BY ri_desc";
	//	$consulta = consultar_fuente($sql);
	//	$cuadro->set_datos($consulta);
	//}
	
	function conf__cuadro()
	{
		$filtro = toba::memoria()->get_dato_operacion('filtro_adver');
		echo($filtro);
		return consultas::get_adversarios($filtro);
	}
	
}

?>
