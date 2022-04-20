<?php
class dt_estadios extends toba_datos_tabla
{
	function get_listado($filtro=array())
	{
		$where = array();
		if(isset($filtro['es_desc'])) {
			$where[] = "es_desc ILIKE ".quote("%{$filtro['es_desc']}%");
		}
		$sql = "SELECT
			e.es_desc,
			e.es_id
		FROM
			estadios as e
		ORDER BY es_desc";
		if(count($where)>0) {
			$sql = sql_concatenar_where($sql, $where);
		}
		return toba::db('fulbo')->consultar($sql);
	}
}

?>