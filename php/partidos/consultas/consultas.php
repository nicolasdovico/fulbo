<?php
class consultas extends toba_ci
{

	protected $s__filtro_adver;
	protected $s__filtro_estad;
	protected $s__filtro_arbit;
	protected $s__filtro_torne;
	
	//-----------------------------------------------------------------------------------
	//---- cuadro_adversario ------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function conf__cuadro_adversario(toba_ei_cuadro $cuadro)
	{
		if (isset($this->s__filtro_adver)) {
			$where = "WHERE" . $this->s__filtro_adver['where'];
		} else {
			$where = '';
		}
		
		
		$sql = "SELECT 
					ri_id,
					ri_desc
				FROM 
				    rivales 
				$where
				ORDER BY 
					ri_desc";
//		print_r ($sql);
		$datos = consultar_fuente($sql);
		$cuadro->set_datos($datos);
	}

	//-----------------------------------------------------------------------------------
	//---- filtro_adversarios -----------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function conf__filtro_adversarios(toba_ei_filtro $filtro)
	{
		if(isset($this->s__filtro_adver)){
			$filtro->set_datos($this->s__filtro_adver);
		}
	}

	function evt__filtro_adversarios__filtrar($datos)
	{
		$this->s__filtro_adver = $datos;
		$this->s__filtro_adver['where'] = $this->dep('filtro_adversarios')->get_sql_where('AND');
	}

	function evt__filtro_adversarios__cancelar()
	{
		unset($this->s__filtro_adver);
	}

	//-----------------------------------------------------------------------------------
	//---- form_adversarios -------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function evt__form_adversarios__grabar($datos)
	{
		$this->dep('rivales')->set($datos);
		$this->dep('rivales')->sincronizar();
		$this->dep('rivales')->resetear();
	}

	function evt__form_adversarios__cancelar()
	{
		$this->dep('rivales')->resetear();
	}

	//-----------------------------------------------------------------------------------
	//---- cuadro_estadios --------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function conf__cuadro_estadios(toba_ei_cuadro $cuadro)
	{
		if (isset($this->s__filtro_estad)) {
			$where = "WHERE" . $this->s__filtro_estad['where'];
		} else {
			$where = '';
		}
		
		
		$sql = "SELECT 
					es_id,
					es_desc
				FROM 
				    estadios 
				$where
				ORDER BY 
					es_desc";
//		print_r ($sql);
		$datos = consultar_fuente($sql);
		$cuadro->set_datos($datos);
	}

	//-----------------------------------------------------------------------------------
	//---- filtro_estadios --------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function conf__filtro_estadios(toba_ei_filtro $filtro)
	{
		if(isset($this->s__filtro_estad)){
			$filtro->set_datos($this->s__filtro_estad);
		}
	}

	function evt__filtro_estadios__filtrar($datos)
	{
		$this->s__filtro_estad = $datos;
		$this->s__filtro_estad['where'] = $this->dep('filtro_estadios')->get_sql_where('AND');
	}

	function evt__filtro_estadios__cancelar()
	{
		unset($this->s__filtro_estad);
	}

	//-----------------------------------------------------------------------------------
	//---- form_estadios ----------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function evt__form_estadios__grabar($datos)
	{
		$this->dep('estadios')->set($datos);
		$this->dep('estadios')->sincronizar();
		$this->dep('estadios')->resetear();
	}

	function evt__form_estadios__cancelar()
	{
		$this->dep('estadios')->resetear();
	}

	//-----------------------------------------------------------------------------------
	//---- cuadro_arbitros --------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function conf__cuadro_arbitros(toba_ei_cuadro $cuadro)
	{
		if (isset($this->s__filtro_arbit)) {
			$where = "WHERE" . $this->s__filtro_arbit['where'];
		} else {
			$where = '';
		}
		
		
		$sql = "SELECT 
					ar_id,
					ar_apno
				FROM 
				    arbitros 
				$where
				ORDER BY 
					ar_apno";
//		print_r ($sql);
		$datos = consultar_fuente($sql);
		$cuadro->set_datos($datos);
	}

	//-----------------------------------------------------------------------------------
	//---- filtro_arbitros --------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function conf__filtro_arbitros(toba_ei_filtro $filtro)
	{
		if(isset($this->s__filtro_arbit)){
			$filtro->set_datos($this->s__filtro_arbit);
		}
	}

	function evt__filtro_arbitros__filtrar($datos)
	{
		$this->s__filtro_arbit = $datos;
		$this->s__filtro_arbit['where'] = $this->dep('filtro_arbitros')->get_sql_where('AND');
	}

	function evt__filtro_arbitros__cancelar()
	{
		unset($this->s__filtro_arbit);
	}

	//-----------------------------------------------------------------------------------
	//---- form_arbitros ----------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function evt__form_arbitros__grabar($datos)
	{
		$this->dep('arbitros')->set($datos);
		$this->dep('arbitros')->sincronizar();
		$this->dep('arbitros')->resetear();
	}

	function evt__form_arbitros__cancelar()
	{
		$this->dep('arbitros')->resetear();
	}

	//-----------------------------------------------------------------------------------
	//---- cuadro_torneos ---------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function conf__cuadro_torneos(toba_ei_cuadro $cuadro)
	{
		if (isset($this->s__filtro_torne)) {
			$where = "WHERE" . $this->s__filtro_torne['where'];
		} else {
			$where = '';
		}
		
		
		$sql = "SELECT 
					tor_id,
					tor_desc,
					tor_nivel
				FROM 
				    torneos 
				$where
				ORDER BY 
					tor_desc";
//		print_r ($sql);
		$datos = consultar_fuente($sql);
		$cuadro->set_datos($datos);
	}

	//-----------------------------------------------------------------------------------
	//---- filtro_torneos ---------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function conf__filtro_torneos(toba_ei_filtro $filtro)
	{
		if(isset($this->s__filtro_torne)){
			$filtro->set_datos($this->s__filtro_torne);
		}
	}

	function evt__filtro_torneos__filtrar($datos)
	{
		$this->s__filtro_torne = $datos;
		$this->s__filtro_torne['where'] = $this->dep('filtro_torneos')->get_sql_where('AND');
	}

	function evt__filtro_torneos__cancelar()
	{
		unset($this->s__filtro_torne);
	}

	//-----------------------------------------------------------------------------------
	//---- form_torneos -----------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function evt__form_torneos__grabar($datos)
	{
		$this->dep('torneos')->set($datos);
		$this->dep('torneos')->sincronizar();
		$this->dep('torneos')->resetear();
	}

	function evt__form_torneos__cancelar()
	{
		$this->dep('torneos')->resetear();
	}
}
?>