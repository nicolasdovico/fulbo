<?php 

require_once('Popups/consultas.php');

class ficha extends toba_ci
{
	
	protected $s__fecha;
	protected $s__totgoles;
	protected $s__gri;
	protected $s__gad;
	
	protected $s__datos_form;
	
	protected $s__memoriaprueba;
	
	//-----------------------------------------------------------------------------------
	//---- DEPENDENCIAS -----------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	//---- gol_adver --------------------------------------------------------------------

	function evt__gol_adver__modificacion($datos1234)
	{
	}

	//El formato debe ser una matriz array('id_fila' => array('id_ef' => valor, ...), ...)
	function conf__gol_adver(toba_ei_formulario_ml $form_ml)
	{
	}

	//---- gol_river --------------------------------------------------------------------

	function evt__gol_river__modificacion($datos)
	{
		//$i = 156;
		//$hasta = $i + $this->s__totgoles;
		//while ($i < $hasta) {
		//	$datos[$i][gol_fecha] = $this->s__fecha;
			//$datos[$i][gol_parariver] = 1;
		//	$i = $i + 1;
		//}
		
		
		
		
		//$i = 0;
		//$gri = 0;	//goles de river
		//$gad = 0;	//goles del adversario
		foreach($datos as $clave => $fila)
		{
			//$i = $i + 1;
			$datos[$clave][gol_fecha] = $this->s__fecha;
			//if ($datos[$clave][gol_parariver] == 1) {
			//	$gri = $gri + 1;
			//}
			//else {
			//	$gad = $gad + 1;
			//}
		}
		
		$this->dep('goles')->procesar_filas($datos);
		toba::memoria()->set_dato_operacion('m_datos',$datos);
		//ei_arbol($datos);
	
	}

	//El formato debe ser una matriz array('id_fila' => array('id_ef' => valor, ...), ...)
	function conf__gol_river(toba_ei_formulario_ml $form_ml)
	{
		$form_ml->set_datos($this->dep('goles')->get_filas());
		
	}

	//---- form_ficha -------------------------------------------------------------------

	function evt__form_ficha__modificacion($datos)
	{
		$this->dep('datos')->set($datos);
		$this->s__fecha = $datos[fecha];
		$this->s__totgoles = $datos[go_ri] + $datos[go_ad];
		$this->s__gri = $datos[go_ri];
		$this->s__gad = $datos[go_ad];
		
		toba::memoria()->set_dato_operacion('parariver',$datos['go_ri']);
		toba::memoria()->set_dato_operacion('paraadver',$datos['go_ad']);
		
	}

	//El formato del carga debe ser array('id_ef' => $valor, ...)
	function conf__form_ficha(toba_ei_formulario $form)
	{
		$form->set_datos($this->dep('datos')->get());
	}
	
	function evt__form_ficha__masadver($pruebas)
	{
	
	}
	
	function get_adversarios_nombre($id)
	{
		//echo('la clave del registro seleccionado es: ');
		//echo($id);
		//echo ('entro a ficha.php 1111');
		//echo ('cabeza de verga 1111');
		//return consultas::get_adversarios(array('ri_id' => $ri_id));
		
	
		return consultas::get_adversarios_nombre(array('id' => $id)); /// -------ESTE ES EL QUE VA EN EL ORIGINAL----------------
		
		
	}
	
	function get_estadios_nombre($id)
	{
		//echo('la clave del registro seleccionado es: ');
		//echo($id);
		//echo ('entro a ficha.php 22222');
		//echo ('cabeza de verga22222');
		//return consultas::get_adversarios(array('ri_id' => $ri_id));
	
		return consultas::get_estadios_nombre(array('id' => $id)); /// -------ESTE ES EL QUE VA EN EL ORIGINAL----------------	
	}
	
	function get_torneos_nombre($id)
	{
		//echo('la clave del registro seleccionado es: ');
		//echo($id);
		//echo ('entro a ficha.php 22222');
		//echo ('cabeza de verga22222');
		//return consultas::get_adversarios(array('ri_id' => $ri_id));
	
		return consultas::get_torneos_nombre(array('id' => $id)); /// -------ESTE ES EL QUE VA EN EL ORIGINAL----------------	
	}
}

?>
