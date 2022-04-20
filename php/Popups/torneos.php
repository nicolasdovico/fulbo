<?php 

require_once('popups/consultas.php');


class torneos extends toba_ci
{
	//-----------------------------------------------------------------------------------
	//---- DEPENDENCIAS -----------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	//---- cuadro -----------------------------------------------------------------------

	function evt__cuadro__seleccion($seleccion)
	{
	}

	//El formato del retorno debe ser array( array('columna' => valor, ...), ...)
	function conf__cuadro()
	{
		$filtro = toba::memoria()->get_dato_operacion('filtro_torneo');
		//echo($filtro);
		return consultas::get_torneos($filtro);
	}
}

?>