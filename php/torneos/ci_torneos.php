<?php
class ci_torneos extends toba_ci
{
	protected $s__datos_filtro;

	//---- Filtro -----------------------------------------------------------------------

	function conf__filtro(toba_ei_filtro $filtro)
	{
		if(isset($this->s__datos_filtro)){
			$filtro->set_datos($this->s__datos_filtro);
		}
	}

	function evt__filtro__filtrar($datos)
	{
		$this->s__datos_filtro = $datos;
	}

	function evt__filtro__cancelar()
	{
		unset($this->s__datos_filtro);
	}

	//---- Cuadro -----------------------------------------------------------------------

	function conf__cuadro(toba_ei_cuadro $cuadro)
	{
		if(isset($this->s__datos_filtro)){
			$cuadro->set_datos($this->dep('dt_torneos')->get_listado($this->s__datos_filtro));
		} else {
			$cuadro->set_datos($this->dep('dt_torneos')->get_listado());
		}
	}

	function evt__cuadro__seleccion($datos)
	{
		$this->dep('dt_torneos')->cargar($datos);
	}

	//---- Formulario -------------------------------------------------------------------

	function conf__form(toba_ei_formulario $form)
	{
		if($this->dep('dt_torneos')->esta_cargada())
		{
			$form->set_datos($this->dep('dt_torneos')->get());
		}
	}

	function evt__form__alta($datos)
	{
		$this->dep('dt_torneos')->set($datos);
		$this->dep('dt_torneos')->sincronizar();
		$this->resetear();
	}

	function evt__form__modificacion($datos)
	{
		$this->dep('dt_torneos')->set($datos);
		$this->dep('dt_torneos')->sincronizar();
		$this->resetear();
	}

	function evt__form__baja()
	{
		$this->dep('dt_torneos')->eliminar_filas();
		$this->dep('dt_torneos')->sincronizar();
		$this->resetear();
	}

	function evt__form__cancelar()
	{
		$this->resetear();
	}

	function resetear()
	{
		$this->dep('dt_torneos')->resetear();
	}
}

?>