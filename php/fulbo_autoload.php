<?php
/**
 * Esta clase fue y será generada automáticamente. NO EDITAR A MANO.
 * @ignore
 */
class fulbo_autoload 
{
	static function existe_clase($nombre)
	{
		return isset(self::$clases[$nombre]);
	}

	static function cargar($nombre)
	{
		if (self::existe_clase($nombre)) { 
			 require_once(dirname(__FILE__) .'/'. self::$clases[$nombre]); 
		}
	}

	static protected $clases = array(
		'fulbo_ci' => 'extension_toba/componentes/fulbo_ci.php',
		'fulbo_cn' => 'extension_toba/componentes/fulbo_cn.php',
		'fulbo_datos_relacion' => 'extension_toba/componentes/fulbo_datos_relacion.php',
		'fulbo_datos_tabla' => 'extension_toba/componentes/fulbo_datos_tabla.php',
		'fulbo_ei_arbol' => 'extension_toba/componentes/fulbo_ei_arbol.php',
		'fulbo_ei_archivos' => 'extension_toba/componentes/fulbo_ei_archivos.php',
		'fulbo_ei_calendario' => 'extension_toba/componentes/fulbo_ei_calendario.php',
		'fulbo_ei_codigo' => 'extension_toba/componentes/fulbo_ei_codigo.php',
		'fulbo_ei_cuadro' => 'extension_toba/componentes/fulbo_ei_cuadro.php',
		'fulbo_ei_esquema' => 'extension_toba/componentes/fulbo_ei_esquema.php',
		'fulbo_ei_filtro' => 'extension_toba/componentes/fulbo_ei_filtro.php',
		'fulbo_ei_firma' => 'extension_toba/componentes/fulbo_ei_firma.php',
		'fulbo_ei_formulario' => 'extension_toba/componentes/fulbo_ei_formulario.php',
		'fulbo_ei_formulario_ml' => 'extension_toba/componentes/fulbo_ei_formulario_ml.php',
		'fulbo_ei_grafico' => 'extension_toba/componentes/fulbo_ei_grafico.php',
		'fulbo_ei_mapa' => 'extension_toba/componentes/fulbo_ei_mapa.php',
		'fulbo_servicio_web' => 'extension_toba/componentes/fulbo_servicio_web.php',
		'fulbo_comando' => 'extension_toba/fulbo_comando.php',
		'fulbo_modelo' => 'extension_toba/fulbo_modelo.php',
	);
}
?>