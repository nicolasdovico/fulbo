<?php


class dt_tecnicos extends toba_datos_tabla
{
	function get_listado($filtro=array())
	{
		$where = array();
		if(isset($filtro['tec_ape_nom'])) {
			$where[] = "tec_ape_nom ILIKE ".quote("%{$filtro['tec_ape_nom']['valor']}%");
		}
		$sql = "SELECT
			tec_ape_nom,
			id_tecnicos, 
			desde,
			hasta,
			cargo
		FROM
			tecnicos
		ORDER BY desde";
		if(count($where)>0) {
			$sql = sql_concatenar_where($sql, $where);
		}
		return toba::db('fulbo')->consultar($sql);
	}

	
}

?>