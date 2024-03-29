<?php
class consultas_sql
{
	
	function llenar_combo()
	{
		$sql = "SELECT tor_desc FROM torneos";
		$datos = consultar_fuente($datos);
		return $datos;
	}
	
	static function get_adversario($id=null)
	{
		if (! isset($id)) {
			return array();
		}
		$id = quote($id);
		$sql = "SELECT 
					ri_id, 
					ri_desc
				FROM 
					rivales
				WHERE
					ri_id = $id";
		$result = consultar_fuente($sql);
		if (! empty($result)) {
			return $result[0]['ri_desc'];
		}
	}	
	
	static function get_adversarios($filtro=null)
	{
		if (! isset($filtro) || trim($filtro) == '') {
			return array();
		}
		$filtro = quote("%{$filtro}%");
		$sql = "SELECT 
					ri_id, 
					ri_desc 
				FROM 
					rivales
				WHERE
					ri_desc ILIKE $filtro
				ORDER BY ri_desc
		";
		return consultar_fuente($sql);		
	}
	
	static function get_estadio($id=null)
	{
		if (! isset($id)) {
			return array();
		}
		$id = quote($id);
		$sql = "SELECT 
					es_id, 
					es_desc
				FROM 
					estadios
				WHERE
					es_id = $id";
		$result = consultar_fuente($sql);
		if (! empty($result)) {
			return $result[0]['es_desc'];
		}
	}	
	
	static function get_estadios($filtro=null)
	{
		if (! isset($filtro) || trim($filtro) == '') {
			return array();
		}
		$filtro = quote("%{$filtro}%");
		$sql = "SELECT 
					es_id, 
					es_desc 
				FROM 
					estadios
				WHERE
					es_desc ILIKE $filtro
				ORDER BY es_desc
		";
		return consultar_fuente($sql);		
	}
	
	static function get_arbitro($id=null)
	{
		if (! isset($id)) {
			return array();
		}
		$id = quote($id);
		$sql = "SELECT 
					ar_id, 
					ar_apno
				FROM 
					arbitros
				WHERE
					ar_id = $id";
		$result = consultar_fuente($sql);
		if (! empty($result)) {
			return $result[0]['ar_apno'];
		}
	}	
	
	static function get_arbitros($filtro=null)
	{
		if (! isset($filtro) || trim($filtro) == '') {
			return array();
		}
		$filtro = quote("%{$filtro}%");
		$sql = "SELECT 
					ar_id, 
					ar_apno 
				FROM 
					arbitros
				WHERE
					ar_apno ILIKE $filtro
				ORDER BY ar_apno
		";
		return consultar_fuente($sql);		
	}

	static function get_torneo($id=null)
	{
		if (! isset($id)) {
			return array();
		}
		$id = quote($id);
		$sql = "SELECT 
					tor_id, 
					tor_desc
				FROM 
					torneos
				WHERE
					tor_id = $id";
		$result = consultar_fuente($sql);
		if (! empty($result)) {
			return $result[0]['tor_desc'];
		}
	}	
	
	static function get_torneos($filtro=null)
	{
		if (! isset($filtro) || trim($filtro) == '') {
			return array();
		}
		$filtro = quote("%{$filtro}%");
		$sql = "SELECT 
					tor_id, 
					tor_desc 
				FROM 
					torneos
				WHERE
					tor_desc ILIKE $filtro
				ORDER BY tor_desc
		";
		return consultar_fuente($sql);		
	}
	
	static function get_player($id=null)
	{
		if (! isset($id)) {
			return array();
		}
		$id = quote($id);
		$sql = "SELECT 
					pl_id, 
					pl_apno
				FROM 
					players
				WHERE
					pl_id = $id";
		$result = consultar_fuente($sql);
		if (! empty($result)) {
			return $result[0]['pl_apno'];
		}
	}	
	
	static function get_players($filtro=null)
	{
		if (! isset($filtro) || trim($filtro) == '') {
			return array();
		}
		$filtro = quote("%{$filtro}%");
		$sql = "SELECT 
					pl_id, 
					pl_apno 
				FROM 
					players
				WHERE
					pl_apno ILIKE $filtro
				ORDER BY pl_apno
		";
		return consultar_fuente($sql);		
	}
	
	static function get_condicion($id=null)
	{
		if (! isset($id)) {
			return array();
		}
		$id = quote($id);
		$sql = "SELECT 
					id_condicion, 
					descripcion
				FROM 
					condicion
				WHERE
					id_condicion = $id";
		$result = consultar_fuente($sql);
		if (! empty($result)) {
			return $result[0]['descripcion'];
		}
	}	
	
	static function get_condiciones($filtro=null)
	{
		if (! isset($filtro) || trim($filtro) == '') {
			return array();
		}
		$filtro = quote("%{$filtro}%");
		$sql = "SELECT 
					id_condicion, 
					descripcion
				FROM 
					condicion
				WHERE
					descripcion ILIKE $filtro
				ORDER BY descripcion
		";
		return consultar_fuente($sql);		
	}

	static function get_fase($id=null)
	{
		if (! isset($id)) {
			return array();
		}
		$id = quote($id);
		$sql = "SELECT 
					id_fase, 
					fase_desc
				FROM 
					fases
				WHERE
					id_fase = $id";
		$result = consultar_fuente($sql);
		if (! empty($result)) {
			return $result[0]['fase_desc'];
		}
	}	
	
	static function get_fases($filtro=null)
	{
		if (! isset($filtro) || trim($filtro) == '') {
			return array();
		}
		$filtro = quote("%{$filtro}%");
		$sql = "SELECT 
					id_fase, 
					fase_desc
				FROM 
					fases
				WHERE
					fase_desc ILIKE $filtro
				ORDER BY fase_desc
		";
		return consultar_fuente($sql);		
	}

	static function get_tecnico($id=null)
	{
		if (! isset($id)) {
			return array();
		}
		$id = quote($id);
		$sql = "SELECT 
					id_tecnicos, 
					tec_ape_nom
				FROM 
					tecnicos
				WHERE
					id_tecnicos = $id";
		$result = consultar_fuente($sql);
		if (! empty($result)) {
			return $result[0]['tec_ape_nom'];
		}
	}	
	
	static function get_tecnicos($filtro=null)
	{
		if (! isset($filtro) || trim($filtro) == '') {
			return array();
		}
		$filtro = quote("%{$filtro}%");
		$sql = "SELECT 
					id_tecnicos, 
					tec_ape_nom
				FROM 
					tecnicos
				WHERE
					tec_ape_nom ILIKE $filtro
				ORDER BY tec_ape_nom
		";
		return consultar_fuente($sql);		
	}
	
	static function get_tipo_gol()
	{
		//if (! isset($id)) {
		//	return array();
		//}
		$sql = "SELECT tipo_gol, tipo_gol_descripcion FROM tipo_gol";
		return consultar_fuente($sql);
	
	}

	static function get_jugadores_congolesparariver($filtro=null)
	{
		
		if (isset($filtro)) {
			
			$filtro = quote("%{$filtro["pl_apno"]["valor"]}%");
			$where = " WHERE gol_parariver = 1 AND pl_apno ILIKE $filtro GROUP BY players.pl_apno, goles.gol_juga, players.pl_id ORDER BY total DESC";

		} else {

			$where = " WHERE gol_parariver = 1 GROUP BY players.pl_apno, goles.gol_juga, players.pl_id ORDER BY total DESC";
		}

		$sql = "SELECT 
				gol_juga, 
				players.pl_id,
				players.pl_apno,
				COUNT (*) as total 
				FROM goles 
				INNER JOIN 
				players
				ON goles.gol_juga = players.pl_id  " . $where;
		
		return consultar_fuente($sql);
	}

	static function get_goles_primer_tiempo($gol_juga)
	{

		if(isset($gol_juga)) {
			$sql = "SELECT
						gol_juga,
						count(*) as total
					FROM
						goles
					where
						periodo = 1 and gol_parariver = 1 and gol_juga = $gol_juga
					GROUP BY goles.gol_juga ";
		} else {

			$sql = "SELECT
						count(*) as total
					FROM
						goles
					where
						periodo = 1 and gol_parariver = 1";
		}

		$resultado = consultar_fuente($sql);
		
		
		return $resultado[0]["total"];

	}
	
}
?>
