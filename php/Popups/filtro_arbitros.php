<?php 
class filtro_arbitros extends toba_ci
{

	protected $s__datos_filtro;
	
	
	//-----------------------------------------------------------------------------------
	//---- DEPENDENCIAS -----------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	//---- form_pop_arbi ----------------------------------------------------------------

	function evt__form_pop_arbi__filtro($datos)
	{
		$this->s__datos_filtro = $datos;
		//ei_arbol($this->s__datos_filtro);
		toba::memoria()->set_dato_operacion('filtro_arbi',$datos['arbitro']);
	}

	function evt__form_pop_arbi__limpiar()
	{
		unset($this->s__datos_filtro);
		$datos['arbitro'] = '';
		toba::memoria()->set_dato_operacion('filtro_arbi',$datos['arbitro']);
	}

	//El formato del carga debe ser array('id_ef' => $valor, ...)
	function conf__form_pop_arbi(toba_ei_formulario $filtro)
	{
		if(isset($this->s__datos_filtro)){
			$filtro->set_datos($this->s__datos_filtro);
		}
	}
}

?>