<?php 

require_once('popups/consultas.php');


class arbitros extends toba_ci
{

	function evt__cuadro__seleccion($seleccion)
	{
	}
	
	//El formato del retorno debe ser array( array('columna' => valor, ...), ...)
	function conf__cuadro()
	{
		$filtro = toba::memoria()->get_dato_operacion('filtro_arbi');
		//echo($filtro);
		return consultas::get_arbitros($filtro);
	}
}

?>