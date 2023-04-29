<?php
	error_reporting (E_ALL ^ E_NOTICE);

	class portecnico extends toba_ci
 	{
		 protected $s__filtro;
		 protected $s__procesar;
 		 protected $s__procesar_goles;


	function conf__filtro(toba_ei_filtro $filtro)
	{
    	if(isset($this->s__filtro)){
			$filtro->set_datos($this->s__filtro);
		}
	}

	function evt__filtro__filtrar($datos)
	{
		$this->s__filtro = $datos;
		//ei_arbol($datos);
	}


	function evt__filtro__cancelar()
	{
   	unset($this->s__filtro);
	}


	function conf__cuadro(toba_ei_cuadro $cuadro)
   {
		if(isset($this->s__filtro)){
			$where = $this->dep('filtro')->get_sql_where();    
			$sql = "SELECT * FROM tecnicos WHERE $where order by desde";
			//print_r($sql);
			$datos = $datos = consultar_fuente($sql);;
			$cuadro->set_datos($datos);		
		} 
		else
		{
			$sql = "SELECT * FROM tecnicos order by desde";
			$datos = $datos = consultar_fuente($sql);
			$cuadro->set_datos($datos);	
		}
		
    }

	function evt__cuadro__seleccion($seleccion)
	{
		//$relacion = $this->dep('datos')->cargar($seleccion);
		//ei_arbol($seleccion);
		
		//-------levanto los partidos que se jugaron entre las fecha que el DT dirigió------------------
		$desde = $seleccion['desde'];
		if (isset($seleccion['hasta'])) {
			$hasta = $seleccion['hasta'];	
		} else {
			$hasta = date("Y-m-d");
		}
		
		$sql = "SELECT * FROM estadisticas WHERE fecha BETWEEN '$desde' AND '$hasta'";
		//print_r($sql);
		$datos = consultar_fuente($sql);
		//ei_arbol($datos);
		$this->s__procesar = $datos;

		// -----levanto los goles para river hechos en el periodo del tecnico seleccionado --------
		$sql = "SELECT
					count(gol_juga) as goles,
					gol_juga,
					(SELECT pl_apno FROM players where gol_juga = pl_id) as nombre_juga
				FROM 
					goles
				WHERE gol_parariver = 1 AND 
					gol_fecha BETWEEN '$desde' AND '$hasta'
				GROUP BY 
					gol_juga
				ORDER BY goles DESC";

		$datos_goles = consultar_fuente($sql);
		//ei_arbol($datos_goles);
		$this->s__procesar_goles = $datos_goles;

	}

	function conf__form(toba_ei_formulario $form)
	{
		$vector = $this->s__procesar; //----- paso los datos de la variable de entorno a un array
		$datos = array();
		$pg = 0;
		$pe = 0;
		$pp = 0;
		$gf = 0;
		$gc = 0;
		//ei_arbol($vector);

		if (is_countable($vector)) {
			//ei_arbol($vector);
			$pj = count($vector);  // busco los partidos ganados
			$datos['pj'] = $pj;

			foreach($vector as $i => $linea) {

				if ($vector[$i]['go_ri'] > $vector[$i]['go_ad']) {   //----- busco partidos ganados
					$pg = $pg + 1;
				}
				

				if ($vector[$i]['go_ri'] == $vector[$i]['go_ad']) {   //----- busco partidos empatados
					$pe = $pe + 1;
				}
				

				if ($vector[$i]['go_ri'] < $vector[$i]['go_ad']) {   //----- busco partidos perdidos
					$pp = $pp + 1;
				}
				

				$gf = $gf + $vector[$i]['go_ri'];
				$gc = $gc + $vector[$i]['go_ad'];				


				
			}

			$datos['eficiencia'] = ((($pg*3) + ($pe)) / ($pj*3)) * 100;
			$datos['pg'] = $pg;
			$datos['pe'] = $pe;
			$datos['pp'] = $pp;
			$datos['gf'] = $gf;
			$datos['gc'] = $gc;
			$datos['dg'] = $gf - $gc;


		}

		$form->set_datos($datos);  // seteo los datos en el formulario
	
	}

	function conf__goleadores(toba_ei_cuadro $cuadro)
	{
		
		if(isset($this->s__procesar_goles)) 
		{

		$cuadro->set_datos($this->s__procesar_goles);
	
		}
	}

}
   
 ?>
