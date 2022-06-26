<?php
	class porjugador extends toba_ci
 	{
		 protected $s__filtro;
		 protected $s__jugador;

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
			$sql = "SELECT * FROM players WHERE $where";
			//print_r($sql);
			$datos = $datos = consultar_fuente($sql);;
			$cuadro->set_datos($datos);		
		}
    }

	function evt__cuadro__seleccion($seleccion)
	{
		$relacion = $this->dep('datos')->cargar($seleccion);
//		ei_arbol($seleccion);
		$this->set_pantalla('segunda');
		$this->s__jugador = $seleccion['pl_id'];
	}



	function conf__detalles(toba_ei_cuadro $cuadro)
   {
		$sql = "SELECT estadisticas.adversario, COUNT(estadisticas.fecha) as goles_hechos FROM estadisticas, goles WHERE estadisticas.fecha = goles.gol_fecha AND gol_juga = $this->s__jugador AND gol_parariver = '1' GROUP BY (estadisticas.adversario) ORDER BY estadisticas.adversario";

		
		$datos = consultar_fuente($sql);
		//ei_arbol($datos);
		$i = 0;
		foreach ($datos as $valor) {
			$desc_rival = $this->get_desc_rival($valor['adversario'], $nombre);
			$valor['adversario'] = $nombre;
			$datos[$i]['adversario'] = $nombre;
			$i = $i +1;
		}
		$cuadro->set_datos($datos);
    }

	function conf__detalles2(toba_ei_cuadro $cuadro)
   {
		$sql = "SELECT estadisticas.adversario, COUNT(estadisticas.fecha) as goles_hechos FROM estadisticas, goles WHERE estadisticas.fecha = goles.gol_fecha AND gol_juga = $this->s__jugador AND gol_parariver = '2' GROUP BY (estadisticas.adversario) ORDER BY estadisticas.adversario";

		
		$datos = consultar_fuente($sql);
		//ei_arbol($datos);
		$i = 0;
		foreach ($datos as $valor) {
			$desc_rival = $this->get_desc_rival($valor['adversario'], $nombre);
			$valor['adversario'] = $nombre;
			$datos[$i]['adversario'] = $nombre;
			$i = $i +1;
		}
		$cuadro->set_datos($datos);
    }

	function evt__detalles__cancelar()
	{
		$this->set_pantalla('pant_inicial');
	}

	function get_desc_rival($resul, &$nombre)
	{
		$sql = "SELECT ri_desc FROM rivales WHERE ri_id = $resul";
		$resul = consultar_fuente($sql);
		$nombre = $resul[0]['ri_desc'];
		return $resul;
	}
		
}
   
 ?>
