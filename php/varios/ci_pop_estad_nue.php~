<?php
class ci_pop_arbit_nue extends toba_ci
{
	protected $s__filtro;


	//-----------------------------------------------------------------------------------
	//---- cuadro -----------------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function conf__cuadro(toba_ei_cuadro $cuadro)
	{
		if (isset($this->s__filtro)) {
			$where=$this->dep('filtro')->get_sql_where();
		}
		else {
			$where=null;
		}
		$datos=toba::consulta_php('consultas_sql')->get_arbitros_nue($where);
		$cuadro->set_datos($datos);
	}

	//-----------------------------------------------------------------------------------
	//---- filtro -----------------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function conf__filtro(toba_ei_filtro $filtro)
	{
		if (isset($this->s__filtro)) {
			$filtro->set_datos($this->s__filtro);
      }
	}

	function evt__filtro__filtrar($datos)
	{
		$this->s__filtro=$datos;
	}

	function evt__filtro__cancelar()
	{
		unset($this->s__filtro);
	}

}

?>
