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
		'adversarios' => 'Popups/adversarios.php',
		'arbitros' => 'Popups/arbitros.php',
		'consultassssss' => 'Popups/consultas.php',
		'estadios' => 'Popups/estadios.php',
		'filtro_adversario' => 'Popups/filtro_adversario.php',
		'filtro_arbitros' => 'Popups/filtro_arbitros.php',
		'filtro_estadios' => 'Popups/filtro_estadios.php',
		'filtro_torneos' => 'Popups/filtro_torneos.php',
		'form_ef_popup' => 'Popups/form_ef_popup.php',
		'nuevopopup' => 'Popups/nuevopopup.php',
		'torneos' => 'Popups/torneos.php',
		'ci_arbitros' => 'arbitros/ci_arbitros.php',
		'ficha' => 'ci_ficha/ficha.php',
		'detalle_partidos' => 'consultas/detalle partidos/detalle_partidos.php',
		'porjugador' => 'consultas/porjugador.php',
		'portecnico' => 'consultas/portecnico.php',
		'portorneo' => 'consultas/portorneo.php',
		'vscriterios' => 'consultas/varios criterios/vscriterios.php',
		'dt_arbitros' => 'datos/dt_arbitros.php',
		'dt_estadios' => 'datos/dt_estadios.php',
		'dt_fases_instancias' => 'datos/dt_fases_instancias.php',
		'dt_players' => 'datos/dt_players.php',
		'dt_rivales' => 'datos/dt_rivales.php',
		'dt_tecnicos' => 'datos/dt_tecnicos.php',
		'dt_torneos' => 'datos/dt_torneos.php',
		'ci_estadios' => 'estadios/ci_estadios.php',
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
		'ci_fases' => 'fases/ci_fases.php',
		'fulbo_autoload' => 'fulbo_autoload.php',
		'tabla_goleadores' => 'goles/tabla_goleadores/tabla_goleadores.php',
		'leerdosbases' => 'leerdosbases/leerdosbases.php',
		'consultas_sql' => 'lib/consultas_sql.php',
		'ci_login' => 'login/ci_login.php',
		'cuadro_autologin' => 'login/cuadro_autologin.php',
		'pant_login' => 'login/pant_login.php',
		'cargar' => 'partidos/cargar/cargar.php',
		'consultar_players' => 'partidos/consultar_players/consultar_players.php',
		'consultas' => 'partidos/consultas/consultas.php',
		'ci_modificar_partidos' => 'partidos/modificar/ci_modificar_partidos.php',
		'ci_jugadores' => 'players/ci_jugadores.php',
		'ci_rivales' => 'rivales/ci_rivales.php',
		'ci_tecnicos' => 'tecnicos/ci_tecnicos.php',
		'ci_torneos' => 'torneos/ci_torneos.php',
		'ci_pop_adver_nue' => 'varios/ci_pop_adver_nue.php',
		'ci_pop_arbit_nue' => 'varios/ci_pop_arbit_nue.php',
		'ci_pop_estad_nue' => 'varios/ci_pop_estad_nue.php',
		'ci_pop_torneo_nue' => 'varios/ci_pop_torneo_nue.php',
	);
}
?>