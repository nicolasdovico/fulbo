<?php
class vscriterios extends toba_ci
  {

		protected $s__filtro;
		protected $s__resumen;

		function formatear_fecha($fecha)
		{
			list($anio,$mes,$dia)=explode("-",$fecha);
			return $dia."/".$mes."/".$anio;
		}


      //-----------------------------------------------------------------------------------
      //---- cuadro -----------------------------------------------------------------------
      //-----------------------------------------------------------------------------------
   
    function conf__cuadro(toba_ei_cuadro $cuadro) {
        $datos = array();
        if(isset($this->s__filtro)){
			//print_r(' la variable tiene: ');
			//ei_arbol($this->s__filtro);
			$where = "WHERE estadisticas.adversario = rivales.ri_id AND
					estadisticas.torneo = torneos.tor_id AND
					estadisticas.estadio = estadios.es_id AND
					estadisticas.arbitro = arbitros.ar_id AND " . $this->s__filtro['where'];		
		}
		else {
			$where = "WHERE estadisticas.adversario = rivales.ri_id AND
					estadisticas.torneo = torneos.tor_id AND
					estadisticas.estadio = estadios.es_id AND
					estadisticas.arbitro = arbitros.ar_id";
		}
		$sql = "SELECT 
					estadisticas.fecha, 
					rivales.ri_desc, 
					torneos.tor_desc, 
					estadios.es_desc, 
					arbitros.ar_apno, 
					estadisticas.go_ri, 
					estadisticas.go_ad 
				FROM 
					estadisticas, 
					rivales, 
					torneos, 
					estadios, 
					arbitros 
				$where
				ORDER BY 
					estadisticas.fecha";
		//			print_r ($sql);
					$datos = consultar_fuente($sql);
		if(isset($this->s__filtro)){
			$cuadro->set_datos($datos);
		}
		//ei_arbol($datos);

		$ult_triunfo = "1900/01/01";
		$ult_derrota = "1900/01/01";

		$pj = 0;
		$pg = 0;
		$pp = 0;
		$pe = 0;
		$gf = 0;
		$gc = 0;

		foreach($datos as $i => $linea) {
			//echo ($i);
			$pj = $pj + 1;   // calcula los partidos jugados
					
			//busca los partidos ganados y ultimo triunfo

			if ($datos[$i]['go_ri'] > $datos[$i]['go_ad']) {
				$pg = $pg + 1;
				if ($datos[$i]['fecha'] > $ult_triunfo) {
					$ult_triunfo = $datos[$i]['fecha'];
				}
			}

			$porc_pg = ($pg * 100) / $pj;	// calcula % de partidos ganados

			//busca los partidos empatados
			if ($datos[$i]['go_ri'] == $datos[$i]['go_ad']) {
				$pe = $pe + 1;
			}					

			$porc_pe = ($pe * 100) / $pj;	//calcula % de partidos empatados
			
			//busca los partidos perdidos y la ultima derrota					
			if ($datos[$i]['go_ri'] < $datos[$i]['go_ad']) {
				$pp = $pp + 1;
				if ($datos[$i]['fecha'] > $ult_derrota) {
					$ult_derrota = $datos[$i]['fecha'];
				}
			}
			
			$porc_pp = ($pp * 100) / $pj;	//calcula % de partidos perdidos

			//busca los goles a favor
			$gf = $gf + $datos[$i]['go_ri'];

			//busca los goles en contra
			$gc = $gc + $datos[$i]['go_ad'];
		}
        
				
		$this->s__resumen['pj'] = $pj;
		$this->s__resumen['pg'] = $pg;
		$this->s__resumen['pe'] = $pe;
		$this->s__resumen['pp'] = $pp;
		$this->s__resumen['gf'] = $gf;
		$this->s__resumen['gc'] = $gc;
		$this->s__resumen['porc_pg'] = $porc_pg;
		$this->s__resumen['porc_pe'] = $porc_pe;
		$this->s__resumen['porc_pp'] = $porc_pp;
		if ($ult_triunfo == "1900/01/01") {
			$this->s__resumen['ult_triunfo'] = "----";
		}
		else {
			$this->s__resumen['ult_triunfo'] = $ult_triunfo;
		}
		if ($ult_derrota == "1900/01/01") {
			$this->s__resumen['ult_derrota'] = "----";
		}
		else {
			$this->s__resumen['ult_derrota'] = $ult_derrota;
		}
    }

		function conf__resumen($form)
		{
			$resumen['pj'] = $this->s__resumen['pj'];		//muestro los partidos jugados
			$resumen['pg'] = $this->s__resumen['pg'];		//muestro los partidos ganados
			$resumen['pe'] = $this->s__resumen['pe'];		//muestro los partidos empatados
			$resumen['pp'] = $this->s__resumen['pp'];		//muestro los partidos perdidos
			$resumen['gf'] = $this->s__resumen['gf'];		//muestro los goles a favor
			$resumen['gc'] = $this->s__resumen['gc'];		//muestro los goles en contra
			$resumen['dg'] = $this->s__resumen['gf'] - $this->s__resumen['gc'];		//muestro la diferencia de goles
			$resumen['ult_triunfo'] = $this->formatear_fecha($this->s__resumen['ult_triunfo']);		//muestra el ultimo triunfo
			$resumen['ult_derrota'] = $this->formatear_fecha($this->s__resumen['ult_derrota']);		//muestra la ultima derrota
			$resumen['porc_pg'] = $this->s__resumen['porc_pg'];		//muestra % de partidos ganados
			$resumen['porc_pe'] = $this->s__resumen['porc_pe'];		//muestra % de partidos empatados
			$resumen['porc_pp'] = $this->s__resumen['porc_pp'];		//muestra % de partidos perdidos
			$form->set_datos($resumen);
		}
   
      //-----------------------------------------------------------------------------------
      //---- vscriterios_filtro -----------------------------------------------------------
      //-----------------------------------------------------------------------------------
   
      function conf__vscriterios_filtro(toba_ei_filtro $filtro)
      {
          if(isset($this->s__filtro)){
              $filtro->set_datos($this->s__filtro);
          }
      }
   
      function evt__vscriterios_filtro__filtrar($datos)
      {
	    $this->s__filtro = $datos;
		$this->s__filtro['where'] = $this->dep('vscriterios_filtro')->get_sql_where('AND');
		
		//$this->s__filtro['where'] = "estadisticas.adversario = rivales.ri_id and estadisticas.torneo = torneos.tor_id and estadisticas.estadio = estadios.es_id and estadisticas.arbitro = arbitros.ar_id and estadisticas.estadio = estadios.es_id and ";
				//print_r ($this->s__from);
			//}
			
//if (isset($this->s__filtro[fil_torneo])) {
			//	$this->s__from = $this->s__from . ', torneos ';
				//print_r ($this->s__from);
			//}

			//ei_arbol($this->s__filtro);
	    //  $this->s__filtro['where'] = $this->s__filtro['where'] . $this->dep('vscriterios_filtro')->get_sql_where('AND');
			//print_r($this->s__filtro['where']);				
      }
   
      function evt__vscriterios_filtro__cancelar()
      {
          unset($this->s__filtro);
      }

   
 
	//-----------------------------------------------------------------------------------
	//---- cuadro -----------------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function evt__cuadro__seleccion($seleccion)
	{
		print_r($seleccion);
		toba::memoria()->set_dato_operacion('fechadelgol',$seleccion);
	}

	function conf_evt__cuadro__seleccion(toba_evento_usuario $evento, $fila)
	{
	
	
		if ($this->datos[$fila]['no_seleccionable'] == '1'){
           $evt->anular(); 
		   $url = toba::vinculador()->get_url(null, 10000138);
	//	   $urlnueva = toba::vinculo()->agregar_parametro('fecha', '2012-01-04');
		  echo "<a href='$url'>Navegar</a>";
		}
		
	}

}
?>