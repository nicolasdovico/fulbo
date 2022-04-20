<?php 
class portorneo extends toba_ci
{

	protected $s__datos_filtro;
	protected $s__fecha;
	
	
	function buscar_racha_favor($consulta, $resu)

	{
		$inicio_racha = 0;
		$final_racha = 0;
		$ganados = 0;
		$racha = false;
		$total_ganados = -10;
		foreach($consulta as $clave => $fila){
			if ($consulta[$clave][go_ri] > $consulta[$clave][go_ad]) {				
				if ($racha == false) {
					$racha = true;
					$inicio_racha = $consulta[$clave][fecha];
					$ganados = $ganados + 1;
				}
				else {
					$ganados = $ganados + 1;
				}
					
			}
			else {  //se cortó la racha
				$racha = false;
				$final_racha = $consulta[$clave][fecha];
				if ($ganados >= $total_ganados) {
					$fechainic_mejor_racha = $inicio_racha;
					$fechafina_mejor_racha = $final_racha;
					$total_ganados = $ganados;
				}
				$ganados = 0;
			}		

		}
			$resu[ganados] = $total_ganados;
			$resu[inicio] = $fechainic_mejor_racha;
			$resu[fin] = $fechafina_mejor_racha;
			//return $total_ganados;
			//return $fechainic_mejor_racha;
			//return $fechafina_mejor_racha;
			return $resu;

	}


//-----------------------------------------------------------------------------------
	//---- DEPENDENCIAS -----------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	//---- cuadxtorneo ------------------------------------------------------------------

	//El formato del retorno debe ser array( array('columna' => valor, ...), ...)
	function conf__cuadxtorneo(toba_ei_cuadro $cuadro)
	{
	
		$this->pantalla()->tab('seg_pantalla')->ocultar();
		
		
		$xxx = toba::memoria()->get_dato_operacion('filtro',$var);
		//echo ('$xxx');
		//echo ($xxx);
		if(isset($xxx)){
			//echo ('esta seteado el filtro');
			$where = $xxx;
			//$sql = "select estadisticas.adversario FROM estadisticas, torneos WHERE estadisticas.torneo = torneos.tor_id and torneos.tor_id = '$where'";
			
			$sql = "select estadisticas.fecha, rivales.ri_desc, arbitros.ar_apno, estadios.es_desc, estadisticas.go_ri, estadisticas.go_ad FROM estadios, arbitros, rivales, estadisticas, torneos WHERE torneos.tor_id = '$where' and estadisticas.torneo = torneos.tor_id and estadisticas.adversario = rivales.ri_id and estadisticas.arbitro = arbitros.ar_id and estadisticas.estadio = estadios.es_id";
			
			
			//$cuadro->set_datos($this->dep('datos')->get_listado($this->s__datos_filtro));
		} 
		else {
			//echo ('NOOOO esta seteado el filtro');
			$sql = "select estadisticas.fecha, rivales.ri_desc, arbitros.ar_apno, estadios.es_desc, estadisticas.go_ri, estadisticas.go_ad FROM estadios, arbitros, rivales, estadisticas, torneos WHERE estadisticas.torneo = torneos.tor_id and estadisticas.adversario = rivales.ri_id and estadisticas.arbitro = arbitros.ar_id and estadisticas.estadio = estadios.es_id ORDER BY fecha DESC LIMIT 10";
			//$this->s__datos_filtro = '2';
			//$cuadro->set_datos($this->dep('datos')->get_listado());
		}
				
//		echo($sql);
		
		$consulta = toba::db()->consultar($sql);
		$cuadro->set_datos($consulta);
	}
	
	function evt__cuadxtorneo__seleccion($seleccion)
	{
		$this->dep('datos')->cargar($seleccion);
		$this->set_pantalla('seg_pantalla');
		$this->s__fecha = $seleccion[fecha];
	}
	
	function evt__detalles__volver()
	{
		$this->set_pantalla('pant_inicial');
	}
	

	//---- formxtorneo ------------------------------------------------------------------

	function evt__formxtorneo__filtrar($datos)
	{
		 $var = $datos[torneo];
		 //echo('$var=');
		 //echo($var);
		 toba::memoria()->set_dato_operacion('filtro',$var);
		 //$prueba = $this->dep(formxtorneo)->ef(torneo)->get_estado();
		 //echo ($prueba);
		 //$formxtorneo->set_datos(array('torneo'=> $prueba));
	}
	
	
	function conf__formxtorneo($componente)
	{
		$buscar = toba::memoria()->get_dato_operacion('filtro',$var);
		if(isset($buscar)){
			//echo ('esta seteado el filtro');
			$sql = "SELECT * FROM torneos  WHERE tor_id  = '$buscar'";
			$consulta = toba::db()->consultar($sql);
			$datos = array('buscado' => $consulta[0][tor_desc]);
			$componente->set_datos($datos);
		}		
	}
	
	function evt__formxtorneo__limpiar()
	{
		toba::memoria()->limpiar_datos_operacion();
	}
	
	 function conf__detalles($componente)
    {
		$fecha = $this->s__fecha;
		$sql = "SELECT * FROM goles WHERE gol_fecha = '$fecha' ";
		//echo($sql);
		$consulta = consultar_fuente($sql);
		
		foreach($consulta as $clave => $fila)
		{
			//$datos[$clave][gol_id] = $consulta[$clave][gol_id];
			//$datos[$clave][gol_fecha] = $consulta[$clave][gol_fecha];
			$datos[$clave][gol_juga] = $consulta[$clave][gol_juga];
			
			//----- llamo a funcion que trae el nombre del jugador que hizo algun gol en ese partido-------
			$datos[$clave][gol_juga] = $this->averiguar_nombre($datos[$clave][gol_juga], $nombre);
			
			if ($consulta[$clave][gol_parariver] == "1") {
				$datos[$clave][gol_parariver] = "SI";
			}
			else {
				$datos[$clave][gol_parariver] = "NO";
			}
			
			if ($consulta[$clave][gol_penal] == "1") {
				$datos[$clave][gol_penal] = "SI";
			}
			else {
				$datos[$clave][gol_penal] = "NO";
			}
				
			//$datos[$clave][gol_parariver] = $consulta[$clave][gol_parariver];
			//$datos[$clave][gol_penal] = $consulta[$clave][gol_penal];
		}
		//echo('hasta aca va bien 1');
		
		
		//ei_arbol($consulta);
		//ei_arbol($datos);
		if ($consulta[0][gol_id] == '') {
		//echo ('esta vacio');
		}
		else {
			$componente->set_datos($datos);
		}
    }
	
	function averiguar_nombre($juga, &$nombre)
	{
		$sql = "SELECT pl_apno FROM players where pl_id = $juga";
		$consulta = consultar_fuente($sql);
		$nombre = $consulta[0][pl_apno];
		return $nombre;
	}
	
	function mergear_goles_penales(&$consulta, $consulta2)
	{
		foreach($consulta2 as $clave => $fila) {
			$cod_jugador = $consulta2[$clave][gol_juga];
			//echo($cod_jugador);
			foreach($consulta as $i => $linea) {
				//echo ($i);
				if ($consulta[$i][gol_juga] == $cod_jugador) {
					$consulta[$i][de_penal] = $consulta2[$clave][penal];
					//echo ('lo mergea');
				}
				else {
					//$consulta[$i][de_penal] = 0;
				}
			}
		}
		return $consulta;
	}
	
	function conf__mas_info($componente)
	{
		$this->pantalla()->tab('seg_pantalla')->ocultar(); //oculta la pestaña de detalles
		$filtro = toba::memoria()->get_dato_operacion('filtro',$var);
		
		if (isset($filtro)) {
			//echo ('esta seteado el filtro');
			$sql = "SELECT tor_desc FROM torneos WHERE tor_id = $filtro";
			$consulta = consultar_fuente($sql);
			
			$datos[torneo] = $consulta[0][tor_desc];
			$sql = "SELECT Count(*) FROM estadisticas WHERE torneo = $filtro"; //cuenta partidos jugados
			$consulta = consultar_fuente($sql);
			//ei_arbol($consulta);
			$datos[jugados] = $consulta[0][count];
			
			$sql = "SELECT Count(*) FROM estadisticas WHERE torneo = $filtro and go_ri > go_ad"; //cuenta partidos ganados
			$consulta = consultar_fuente($sql);
			//ei_arbol($consulta);
			$datos[ganados] = $consulta[0][count];
			
			$sql = "SELECT Count(*) FROM estadisticas WHERE torneo = $filtro and go_ri = go_ad"; //cuenta partidos empatados
			$consulta = consultar_fuente($sql);
			//ei_arbol($consulta);
			$datos[empatados] = $consulta[0][count];
			
			$sql = "SELECT Count(*) FROM estadisticas WHERE torneo = $filtro and go_ri < go_ad"; //cuenta partidos perdidos
			$consulta = consultar_fuente($sql);
			//ei_arbol($consulta);
			$datos[perdidos] = $consulta[0][count];
			
			$sql = "SELECT SUM (go_ri) as suma FROM estadisticas WHERE torneo = $filtro"; //cuenta goles a favor
			$consulta = consultar_fuente($sql);
			//ei_arbol($consulta);
			$datos[goles_a_favor] = $consulta[0][suma];
			
			$sql = "SELECT SUM (go_ad) as suma FROM estadisticas WHERE torneo = $filtro"; //cuenta goles en contra
			$consulta = consultar_fuente($sql);
			//ei_arbol($consulta);
			$datos[goles_en_contra] = $consulta[0][suma];
		}
		else {
			//echo ('no esta seteado el filtro');
			$datos[torneo] = "No se especificó ninguno";
			$sql = "SELECT Count(*) FROM estadisticas"; //cuenta partidos jugados
			$consulta = consultar_fuente($sql);
			//ei_arbol($consulta);
			$datos[jugados] = $consulta[0][count];
			
			$sql = "SELECT Count(*) FROM estadisticas WHERE go_ri > go_ad"; //cuenta partidos ganados
			$consulta = consultar_fuente($sql);
			//ei_arbol($consulta);
			$datos[ganados] = $consulta[0][count];
			
			$sql = "SELECT Count(*) FROM estadisticas WHERE go_ri = go_ad"; //cuenta partidos empatados
			$consulta = consultar_fuente($sql);
			//ei_arbol($consulta);
			$datos[empatados] = $consulta[0][count];
			
			$sql = "SELECT Count(*) FROM estadisticas WHERE go_ri < go_ad"; //cuenta partidos perdidos
			$consulta = consultar_fuente($sql);
			//ei_arbol($consulta);
			$datos[perdidos] = $consulta[0][count];
			
			$sql = "SELECT SUM (go_ri) as suma FROM estadisticas"; //cuenta goles a favor
			$consulta = consultar_fuente($sql);
			//ei_arbol($consulta);
			$datos[goles_a_favor] = $consulta[0][suma];
			
			$sql = "SELECT SUM (go_ad) as suma FROM estadisticas"; //cuenta goles en contra
			$consulta = consultar_fuente($sql);
			//ei_arbol($consulta);
			$datos[goles_en_contra] = $consulta[0][suma];

			$sql = "SELECT * FROM estadisticas ORDER BY fecha"; //calcula una racha a favor
			$consulta = consultar_fuente($sql);
			$resu= $this->buscar_racha_favor($consulta, $resu);

			list($anio, $mes, $dia) = split ('-', $resu[inicio]);
			$fecha_conver = "$dia/$mes/$anio";
			$datos[inic_racha_favor] = $fecha_conver;


			list($anio, $mes, $dia) = split ('-', $resu[fin]);
			$fecha_conver = "$dia/$mes/$anio";
			$datos[final_racha_favor] = $fecha_conver;

			$datos[duracion] = $resu[ganados];
			
		}
	
		$componente->set_datos($datos);
		
	}
	
	function conf__goleadores($componente)
	{
		$this->pantalla()->tab('seg_pantalla')->ocultar(); // oculta la pestaña de detalles
	
		$filtro = toba::memoria()->get_dato_operacion('filtro',$var);
		
		if (isset($filtro)) {
			$sql = "SELECT goles.gol_juga, COUNT(*) as cantidad FROM goles, estadisticas WHERE goles.gol_parariver = 1 and goles.gol_fecha = estadisticas.fecha and estadisticas.torneo = $filtro GROUP BY goles.gol_juga ORDER BY cantidad DESC"; //calcula goleadores a favor de River en el torneo especificado
			$consulta = consultar_fuente($sql);
			//ei_arbol($consulta);
			
			foreach($consulta as $clave => $fila) {
				$datos[$clave][gol_juga] = $consulta[$clave][gol_juga];
			
				//----- llamo a funcion que trae el nombre del jugador 
				$datos[$clave][a_favor] = $this->averiguar_nombre($datos[$clave][gol_juga], $nombre);
				$datos[$clave][cant_favor] = $consulta[$clave][cantidad];
				//$datos[$clave][a_favor_penal] = $consulta[$clave][de_penal];
			}
		}
		else {
			$sql = "SELECT gol_juga, COUNT (*) as total FROM goles WHERE gol_parariver = 1 GROUP BY gol_juga ORDER BY total DESC"; //calcula goleadores a favor de River
			$consulta = consultar_fuente($sql);
			//$consulta[0][xxx] = 123;
			//ei_arbol($consulta);
			//$datos[goles_a_favor] = $consulta[0][suma];
			
			$sql2 = "SELECT gol_juga, COUNT (*) as penal FROM goles WHERE gol_parariver = 1 and gol_penal = 1 GROUP BY gol_juga "; //calcula los goles a favor y de penal
			$consulta2 = consultar_fuente($sql2);
			//ei_arbol($consulta2);

			$this->mergear_goles_penales($consulta, $consulta2); // mergea con la cantidad de goles hechos de penal.
			//ei_arbol($consulta);
			
			foreach($consulta as $clave => $fila) {
				$datos[$clave][gol_juga] = $consulta[$clave][gol_juga];
			
				//----- llamo a funcion que trae el nombre del jugador 
				$datos[$clave][a_favor] = $this->averiguar_nombre($datos[$clave][gol_juga], $nombre);
				$datos[$clave][cant_favor] = $consulta[$clave][total];
				$datos[$clave][a_favor_penal] = $consulta[$clave][de_penal];
			}
		}
			
			$componente->set_datos($datos);
	}

	



		
	
}

?>
