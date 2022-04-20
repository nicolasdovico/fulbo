<?php
class consultar_players extends toba_ci
{

	protected $s__filtro;
	
	//-----------------------------------------------------------------------------------
	//---- cuadro_players ---------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function conf__cuadro_players(toba_ei_cuadro $cuadro)
	{
		if (isset($this->s__filtro)) {
			$where = "WHERE" . $this->s__filtro['where'];
		} else {
			$where = '';
		}
		
		
		$sql = "SELECT 
					pl_id,
					pl_apno
				FROM 
				    players 
				$where
				ORDER BY 
					pl_apno";
//		print_r ($sql);
		$datos = consultar_fuente($sql);
		$cuadro->set_datos($datos);
	}

	//-----------------------------------------------------------------------------------
	//---- filtro_players ---------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function conf__filtro_players(toba_ei_filtro $filtro)
	{
		if(isset($this->s__filtro)){
			$filtro->set_datos($this->s__filtro);
		}
	}

	function evt__filtro_players__filtrar($datos)
	{
		$this->s__filtro = $datos;
		$this->s__filtro['where'] = $this->dep('filtro_players')->get_sql_where('AND');
	}

	function evt__filtro_players__cancelar()
	{
		unset($this->s__filtro);
	}

	//-----------------------------------------------------------------------------------
	//---- form_players -----------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function evt__form_players__grabar($datos)
	{
		$this->dep('players')->set($datos);
		$this->dep('players')->sincronizar();
		$this->dep('players')->resetear();
	}

	function evt__form_players__cancelar()
	{
		$this->dep('players')->resetear();
	}
}

?>