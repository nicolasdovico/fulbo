<?php 


class form_ef_popup extends toba_ei_formulario
{

	//-----------------------------------------------------------------------------------
	//---- JAVASCRIPT -------------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function extender_objeto_js()
	{
		echo "
		//---- Procesamiento de EFs --------------------------------
		
		{$this->objeto_js}.modificar_vinculo__adversario = function(id_vinculo)
		{
			//Aqui puedo tomar el id_vinculo y agregarle parametros
			//vinculador.agregar_parametros(id_vinculo, {'parametro_nuevo': 'valor'});
		}
		";
	}
}

?>