<?php


class dt_players extends toba_datos_tabla
{
	function get_listado($filtro=array())
	{
		$where = array();
		if(isset($filtro['pl_apno'])) {
			$where[] = "pl_apno ILIKE ".quote("%{$filtro['pl_apno']}%");
		}
		$sql = "SELECT
			p.pl_apno,
			p.pl_id
		FROM
			players as p
		ORDER BY pl_apno";
		if(count($where)>0) {
			$sql = sql_concatenar_where($sql, $where);
		}
		return toba::db('fulbo')->consultar($sql);
	}


}

?>