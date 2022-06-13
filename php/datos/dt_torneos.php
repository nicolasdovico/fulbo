<?php


class dt_torneos extends toba_datos_tabla
{
	function get_listado($filtro=array())
	{
		$where = array();
		if(isset($filtro['tor_desc'])) {
			$where[] = "tor_desc ILIKE ".quote("%{$filtro['tor_desc']['valor']}%");
		}
		$sql = "SELECT
			t.tor_desc,
			t.tor_id
		FROM
			torneos as t
		ORDER BY tor_desc";
		if(count($where)>0) {
			$sql = sql_concatenar_where($sql, $where);
		}
		return toba::db('fulbo')->consultar($sql);
	}

	
}

?>