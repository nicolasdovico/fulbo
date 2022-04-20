<?php 
class filtro_estadios extends toba_ci
{

	protected $s__datos_filtro;
	
	
	//-----------------------------------------------------------------------------------
	//---- DEPENDENCIAS -----------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	//---- form_pop_estadios ------------------------------------------------------------

	function evt__form_pop_estadios__filtrar($datos)
	{
		$this->s__datos_filtro = $datos;
		//ei_arbol($this->s__datos_filtro);
		toba::memoria()->set_dato_operacion('filtro_estad',$datos['estadio']);
	}

	function evt__form_pop_estadios__limpiar()
	{
		unset($this->s__datos_filtro);
		$datos['estad'] = '';
		toba::memoria()->set_dato_operacion('filtro_estad',$datos['estadio']);
	}

	//El formato del carga debe ser array('id_ef' => $valor, ...)
	function conf__form_pop_estadios(toba_ei_formulario $filtro)
	{
		if(isset($this->s__datos_filtro)){
			$filtro->set_datos($this->s__datos_filtro);
		}
	}
}

?>