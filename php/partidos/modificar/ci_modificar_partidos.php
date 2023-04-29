<?php
class ci_modificar_partidos extends toba_ci
{

	protected $s__filtro;
	protected $s__datos_multilinea;
	
	//-----------------------------------------------------------------------------------
	//---- Configuraciones --------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function conf()
	{
	}

	//-----------------------------------------------------------------------------------
	//---- cuadro -----------------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function conf__cuadro(toba_ei_cuadro $cuadro)
	{
	
		if (isset($this->s__filtro)) {
			
			$where = "WHERE " . $this->s__filtro['where'];
			
			$sql = "SELECT 
					fecha, 
					torneo,
					(SELECT tor_desc FROM torneos WHERE tor_id = torneo) as torneo,
					adversario,
					(SELECT ri_desc FROM rivales WHERE ri_id = adversario) as adversario,
					arbitro,
					(SELECT ar_apno FROM arbitros WHERE ar_id = arbitro) as arbitro,
					go_ri,
					go_ad,
					estadio,
					(SELECT es_desc FROM estadios WHERE es_id = estadio) as estadio,
					condicion, 
					(SELECT descripcion FROM condicion WHERE id_condicion = condicion) as condicion,
					fase,
					(SELECT fase_desc FROM fases WHERE id_fase = fase) as fase,
					fecha_nro
					
				FROM 
					estadisticas
				
				$where 
				ORDER BY fecha";
		
			$datos = consultar_fuente($sql);
			$cuadro->set_datos($datos);
		
		} else {
			
			//$where = "WHERE 1 = 1";
		
		}
		
	}
	
	function evt__cuadro__seleccion($seleccion)
	{
		$fecha = date("F j, Y, g:i a");
		$this->dep('estadisticas')->cargar($seleccion);
		toba::memoria()->set_dato_operacion($fecha, $seleccion['fecha']);
		$this->set_pantalla('pant_segunda');
		
	}

	//-----------------------------------------------------------------------------------
	//---- filtro -----------------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function conf__filtro(toba_ei_filtro $filtro)
	{
	
		if(isset($this->s__filtro)){
		
			$filtro->set_datos($this->s__filtro);
        
		}
		
	}

	function evt__filtro__filtrar($datos)
	{
	
		$this->s__filtro = $datos;
		$this->s__filtro['where'] = $this->dep('filtro')->get_sql_where('AND');
		
	}

	function evt__filtro__cancelar()
	{
	
		unset($this->s__filtro);
		unset($this->s__grupo_seleccionado);
		
	}

	//-----------------------------------------------------------------------------------
	//---- form -------------------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function conf__form(toba_ei_formulario $form)
	{
	
		if ($this->dep('estadisticas')->esta_cargada()) {
		
			$datos = $this->dep('estadisticas')->get();
			//ei_arbol($datos);
			$form->set_datos($this->dep('estadisticas')->get());

		}
	}
	
	function evt__form__implicito($datos)
	{
		if (isset($datos)) {
		
			//ei_arbol($datos, '$datos del form');
			$this->dep('estadisticas')->set($datos);
		
		}
	}

	//-----------------------------------------------------------------------------------
	//---- form_ml ----------------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function conf__form_ml(toba_ei_formulario_ml $form_ml)
	{
	
		$fecha = date("F j, Y, g:i a");
		$fecha = toba::memoria()->get_dato_operacion($fecha);
		//ei_arbol($fecha);
		if (isset($fecha)) {
			$sql = "SELECT 
						gol_fecha,
						gol_juga,
						gol_id,
						(SELECT pl_apno FROM players WHERE pl_id = gol_juga) as desc_jugador,
						gol_parariver,
						gol_penal,
						periodo, 
						minutos
						
					FROM 
						goles 
						
					WHERE
					
						gol_fecha = '$fecha'

					ORDER BY periodo, minutos";
			$datos = consultar_fuente($sql);
			//ei_arbol($datos);
			$form_ml->set_datos($datos);
			
		}
	}
	
	function evt__form_ml__implicito($datos_ml)
	{
	
		if (isset($datos_ml)) {
		
			$this->s__datos_multilinea = $datos_ml;
		
		}
	}


	//-----------------------------------------------------------------------------------
	//---- Eventos ----------------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function evt__guardar()
	{
	
		$this->dep('estadisticas')->sincronizar();
		//ei_arbol($this->dep('estadisticas')->get_filas());
		$this->dep('estadisticas')->resetear();
		foreach($this->s__datos_multilinea as $fila) {
			
			$periodo = $fila['periodo'];
			$minutos = $fila['minutos'];
			$gol_penal = $fila['gol_penal'];
			$id = $fila['gol_id'];
			$sql = "UPDATE goles SET periodo = $periodo, minutos = $minutos, gol_penal = $gol_penal	WHERE gol_id = $id";
			consultar_fuente($sql);
		
		}
		unset($fecha);
		unset($this->s__datos_multilinea);
		$this->set_pantalla('pant_inicial');
		
	}

	function evt__cancelar()
	{
	
		$this->dep('estadisticas')->resetear();
		$this->dep('goles')->resetear();
		unset($fecha);
		unset($this->s__datos_multilinea);
		$this->set_pantalla('pant_inicial');
		
	}

	//-----------------------------------------------------------------------------------
	//---- cuadro_segunda ---------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function conf__cuadro_segunda(toba_ei_cuadro $cuadro)
	{
	
		if ($this->dep('estadisticas')->esta_cargada()) {
		
			$fecha = date("F j, Y, g:i a");
			$fecha = toba::memoria()->get_dato_operacion($fecha);
			$where = "WHERE fecha = '$fecha'";
		
			$sql = "SELECT 
					fecha, 
					torneo,
					(SELECT tor_desc FROM torneos WHERE tor_id = torneo) as torneo,
					adversario,
					(SELECT ri_desc FROM rivales WHERE ri_id = adversario) as adversario,
					arbitro,
					(SELECT ar_apno FROM arbitros WHERE ar_id = arbitro) as arbitro,
					go_ri,
					go_ad,
					estadio,
					(SELECT es_desc FROM estadios WHERE es_id = estadio) as estadio,
					condicion, 
					(SELECT descripcion FROM condicion WHERE id_condicion = condicion) as condicion, 
					fase,
					fecha_nro
					
				FROM 
					estadisticas
				
				$where 
				ORDER BY fecha";
			$datos = consultar_fuente($sql);
			$cuadro->set_datos($datos);
		}
	}

}
?>