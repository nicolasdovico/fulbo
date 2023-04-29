<?php 
class tabla_goleadores extends toba_ci
{

	protected $s__filtro;
	protected $s__fecha;

	//---- Filtro -----------------------------------------------------------------------

	function conf__filtro(toba_ei_filtro $filtro)
	{
		if(isset($this->s__filtro)){

			$filtro->set_datos($this->s__filtro);
		
		}
	}

	function evt__filtro__filtrar($datos)
	{
	
		$this->s__filtro = $datos;
	}

	function evt__filtro__cancelar()
	{
		unset($this->s__filtro);
		}


	//-----------------------------------------------------------------------------------
      //---- cuadro -----------------------------------------------------------------------
      //-----------------------------------------------------------------------------------
   
    function conf__cuadro(toba_ei_cuadro $cuadro) {

    	
    	//traigo los jugadores que hicieron goles para River
   		$datos = consultas_sql::get_jugadores_congolesparariver($this->s__filtro);

   		$cuadro->set_datos($datos);


    }
	
		
	function evt__cuadro__seleccion($datos)
	{
		//$this->dep('dt_estadios')->cargar($datos);
		$this->s__fecha = $datos;
		
	}	


	function conf__form(toba_ei_formulario $form)
		{
			$resumen = array();
			//ei_arbol(consultas_sql::get_goles_primer_tiempo($datos["pl_id"]));

			$resumen['goles_primer_tiempo'] = consultas_sql::get_goles_primer_tiempo($this->s__fecha["pl_id"]);

			$form->set_datos($resumen);
		}
	
}

?>
