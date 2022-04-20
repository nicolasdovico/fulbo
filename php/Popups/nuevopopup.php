<?php

require_once('popups/consultas.php');


class nuevopopup extends toba_ci
{
	//-----------------------------------------------------------------------------------
	//---- cuadro -----------------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function conf__cuadro()
	{
		$filtro = toba::memoria()->get_dato_operacion('filtro_adver');
		   return consultas::get_adversarios($filtro);
        
    }


}

?>