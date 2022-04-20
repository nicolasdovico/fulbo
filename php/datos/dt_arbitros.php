<?php


class dt_arbitros extends toba_datos_tabla
{
	function get_listado($filtro=array())
	{
		$where = array();
		if(isset($filtro['ar_apno'])) {
			$where[] = "ar_apno ILIKE ".quote("%{$filtro['ar_apno']}%");
		}
		$sql = "SELECT
			a.ar_apno,
			a.ar_id
		FROM
			arbitros as a
		ORDER BY ar_apno";
		if(count($where)>0) {
			$sql = sql_concatenar_where($sql, $where);
		}
		return toba::db('fulbo')->consultar($sql);
	}


}

?>