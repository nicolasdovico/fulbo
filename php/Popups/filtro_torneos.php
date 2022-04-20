<?php 
class filtro_torneos extends toba_ci
{

	protected $s__datos_filtro;
	
	
	//-----------------------------------------------------------------------------------
	//---- DEPENDENCIAS -----------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	//---- form_pop_torneos -------------------------------------------------------------

	function evt__form_pop_torneos__filtrar($datos)
	{
		$this->s__datos_filtro = $datos;
		//ei_arbol($this->s__datos_filtro);
		toba::memoria()->set_dato_operacion('filtro_torneo',$datos['torneo']);
	}

	function evt__form_pop_torneos__limpiar()
	{
		unset($this->s__datos_filtro);
		$datos['torneo'] = '';
		toba::memoria()->set_dato_operacion('filtro_torneo',$datos['torneo']);
	}

	//El formato del carga debe ser array('id_ef' => $valor, ...)
	function conf__form_pop_torneos(toba_ei_formulario $filtro)
	{
		if(isset($this->s__datos_filtro)){
			$filtro->set_datos($this->s__datos_filtro);
		}
	}
}

?>