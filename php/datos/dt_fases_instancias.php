<?php


class dt_fases_instancias extends toba_datos_tabla
{
	function get_listado($filtro=array())
	{
		$where = array();
		if(isset($filtro['fase_desc'])) {
			$where[] = "fase_desc ILIKE ".quote("%{$filtro['fase_desc']['valor']}%");
		}
		$sql = "SELECT
			fase_desc,
			id_fase
		FROM
			fases
		ORDER BY fase_desc";
		if(count($where)>0) {
			$sql = sql_concatenar_where($sql, $where);
		}
		return toba::db('fulbo')->consultar($sql);
	}

	
}

?>