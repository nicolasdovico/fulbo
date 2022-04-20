<?php
class dt_rivales extends toba_datos_tabla
{
	function get_listado($filtro=array())
	{
		$where = array();
		if(isset($filtro['ri_desc'])) {
			$where[] = "ri_desc ILIKE ".quote("%{$filtro['ri_desc']}%");
		}
		$sql = "SELECT
	r.ri_desc,
	r.ri_id
FROM
	rivales as r
ORDER BY ri_desc";
		if(count($where)>0) {
			$sql = sql_concatenar_where($sql, $where);
		}
		return toba::db('fulbo')->consultar($sql);
	}
}

?>