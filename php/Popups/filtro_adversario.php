<?php 
class filtro_adversario extends toba_ci
{

	protected $s__datos_filtro;
	
	
	//-----------------------------------------------------------------------------------
	//---- DEPENDENCIAS -----------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	//---- form_pop_adver ---------------------------------------------------------------

	function evt__form_pop_adver__filtro($datos)
	{
		$this->s__datos_filtro = $datos;
		//ei_arbol($this->s__datos_filtro);
		toba::memoria()->set_dato_operacion('filtro_adver',$datos['apno']);
	}

	function evt__form_pop_adver__limpiar()
	{
		unset($this->s__datos_filtro);
		$datos['apno'] = '';
		toba::memoria()->set_dato_operacion('filtro_adver',$datos['apno']);
	}

	//El formato del carga debe ser array('id_ef' => $valor, ...)
	function conf__form_pop_adver(toba_ei_formulario $filtro)
	{
		if(isset($this->s__datos_filtro)){
			$filtro->set_datos($this->s__datos_filtro);
		}
	}
}

?>