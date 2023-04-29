<?php



class consultassssss
{

	static function get_adversarios($filtro)
	{
		echo('estoy en get_adversarios');
		echo($filtro);
		if ($filtro == '') {
			$sql = "SELECT * FROM rivales ORDER by ri_desc";
		}
		else {
			$sql = "SELECT * FROM rivales where ri_desc ILIKE '%$filtro%' ORDER by ri_desc";
		}
		//echo($sql);
		//$raul = consultar_fuente($sql);
		//ei_arbol($raul);
		//return $raul;
		return consultar_fuente($sql);  //ESTO ES LO QUE VA EN EL ORIGINAL!!!!!!!
	}
	
	static function get_adversarios_nombre($persona)
	{	echo ('estoy en get_adversarios_nombre de consultas.php');
		$persona == 'valor de $persona';
		ei_arbol ($persona);
		
		if (isset($persona)) {

			$datos = self::get_adversarios_datos(array('id' => $persona));
			return $datos['ri_desc'];
		} else {
			return '';	
		}
	}
	
	static function get_adversarios_datos($persona)
	{
		ei_arbol($persona);
		$sql = "SELECT ri_desc FROM rivales WHERE ri_id='{$persona['id']}'";
		$rs = consultar_fuente($sql);
		//echo('dentro de get_adversarios_datos recupera: ');
		//ei_arbol($rs);
		if (! empty($rs)) {
			return current($rs);
		}
		return $rs;
	}

	static function get_estadios($filtro)
	{
		//echo('estoy en get_adversarios');
		//echo($filtro);
		if ($filtro == '') {
			$sql = "SELECT * FROM estadios ORDER by es_desc";
		}
		else {
			$sql = "SELECT * FROM estadios where es_desc ILIKE '%$filtro%' ORDER by es_desc";
		}
		//echo($sql);
		//$raul = consultar_fuente($sql);
		//ei_arbol($raul);
		//return $raul;
		return consultar_fuente($sql);  //ESTO ES LO QUE VA EN EL ORIGINAL!!!!!!!
	}

		static function get_estadios_nombre($persona)
	{//	echo ('estoy en get_adversarios_nombre de consultas.php');
	//	$persona == 'valor de $persona';
		//ei_arbol ($persona);
		
		if (isset($persona)) {

			$datos = self::get_estadios_datos($persona);
			return $datos['es_desc'];
		} else {
			return '';	
		}
	}
	
	static function get_estadios_datos($persona)
	{
		//ei_arbol($persona);
		$sql = "SELECT es_desc FROM estadios WHERE es_id='{$persona['id']}'";
		//echo ($sql);
		$rs = consultar_fuente($sql);
		//echo('dentro de get_adversarios_datos recupera: ');
		//ei_arbol($rs);
		if (! empty($rs)) {
			return current($rs);
		}
		//return $rs;
	}
	
	static function get_arbitros($filtro)
	{
		//echo('estoy en get_adversarios');
		//ei_arbol($filtro);
		if ($filtro == '') {
			$sql = "SELECT * FROM arbitros ORDER by ar_apno";
		}
		else {
			$sql = "SELECT * FROM arbitros where ar_apno ILIKE '%$filtro%' ORDER by ar_apno";
		}
		//echo($sql);
		//$raul = consultar_fuente($sql);
		//ei_arbol($raul);
		//return $raul;
		return consultar_fuente($sql);  //ESTO ES LO QUE VA EN EL ORIGINAL!!!!!!!
	}
	
	static function get_arbitros_nombre($persona)
	{
		if (isset($persona)) {

			$datos = self::get_arbitros_datos($persona);
			return $datos['ar_apno'];
		} else {
			return '';	
		}
	}
	
	static function get_arbitros_datos($persona)
	{
		//ei_arbol($persona);
		$sql = "SELECT ar_apno FROM arbitros WHERE ar_id='{$persona['id']}'";
		//echo ($sql);
		$rs = consultar_fuente($sql);
		//echo('dentro de get_adversarios_datos recupera: ');
		//ei_arbol($rs);
		if (! empty($rs)) {
			return current($rs);
		}
		//return $rs;
	}
	
	
	static function get_torneos($filtro)
	{
		//echo('estoy en get_adversarios');
		//ei_arbol($filtro);
		if ($filtro == '') {
			$sql = "SELECT * FROM torneos ORDER by tor_desc";
		}
		else {
			$sql = "SELECT * FROM torneos where tor_desc ILIKE '%$filtro%' ORDER by tor_desc";
		}
		//echo($sql);
		//$raul = consultar_fuente($sql);
		//ei_arbol($raul);
		//return $raul;
		return consultar_fuente($sql);  //ESTO ES LO QUE VA EN EL ORIGINAL!!!!!!!
	}
	
	static function get_torneos_nombre($persona)
	{
		if (isset($persona)) {

			$datos = self::get_torneos_datos($persona);
			return $datos['tor_desc'];
		} else {
			return '';	
		}
	}
	
	static function get_torneos_datos($persona)
	{
		//ei_arbol($persona);
		$sql = "SELECT tor_desc FROM torneos WHERE tor_id='{$persona['id']}'";
		//echo ($sql);
		$rs = consultar_fuente($sql);
		//echo('dentro de get_adversarios_datos recupera: ');
		//ei_arbol($rs);
		if (! empty($rs)) {
			return current($rs);
		}
		//return $rs;
	}

}