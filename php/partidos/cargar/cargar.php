<?php
class cargar extends toba_ci
{
	protected $s__fecha;
	protected $s__total_goles;
	protected $s__filas_cargadas;
	
	
	//-----------------------------------------------------------------------------------
	//---- Configuraciones --------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function conf__pant_inicial(toba_ei_pantalla $pantalla)
	{
		$hay_cambios = $this->dep('estadisticas')->hay_cambios();
        toba::menu()->set_modo_confirmacion('Esta a punto de abandonar la edición sin grabar, ¿Desea continuar?', $hay_cambios);

        
	}

	//-----------------------------------------------------------------------------------
	//---- Eventos ----------------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function evt__procesar()
	{	
		if ($this->s__filas_cargadas == $this->s__total_goles) {
			$this->dep('estadisticas')->sincronizar();
			$this->dep('goles')->sincronizar();
			$this->dep('estadisticas')->resetear();
			$this->dep('goles')->resetear();
			unset($this->s__fecha);
			$this->set_pantalla('pant_inicial');
			//$this->conf__pant_inicial(toba_ei_pantalla $pantalla);
		}
		else {
			toba::notificacion()->warning('Verificar la cantidad de goles cargados');
		}
	}	

	function evt__cancelar()
	{
		$this->dep('estadisticas')->resetear();
		unset($this->s__fecha);
	}

	//-----------------------------------------------------------------------------------
	//---- form_goles -------------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function conf__form_goles(toba_ei_formulario_ml $form_ml)
	{
		$form_ml->set_datos($this->dep('goles')->get_filas());
	}

	function evt__form_goles__modificacion($datos)
	{
		$i = 156;
		$time = strtotime($this->s__fecha);
        $myDate = date( 'Y-m-d', $time );
		foreach($datos as $reg){
	
			$datos[$i]['gol_fecha'] = $myDate;
			$i = $i + 1;
		}
		$this->dep('goles')->procesar_filas($datos);
		$this->s__filas_cargadas = $this->dep('form_goles')->get_cantidad_lineas();
	}

	//-----------------------------------------------------------------------------------
	//---- form_cargar ------------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function conf__form_cargar(toba_ei_formulario $form)
	{
		$form->set_datos($this->dep('estadisticas')->get());
	}

	function evt__form_cargar__modificacion($datos)
	{
		$this->dependencia('estadisticas')->set($datos);
		$this->s__fecha = $datos['fecha'];	//tomo la fecha para despues guardar en la tabla de goles
		$this->s__total_goles = $datos['go_ri'] + $datos['go_ad'];  //sumo la cantidad de goles para setear la cantidad de filas en el multilineas
	}

}
?>