------------------------------------------------------------
--[10000062]--  ci_jugadores - dt_jugadores 
------------------------------------------------------------

------------------------------------------------------------
-- apex_objeto
------------------------------------------------------------

--- INICIO Grupo de desarrollo 10
INSERT INTO apex_objeto (proyecto, objeto, anterior, identificador, reflexivo, clase_proyecto, clase, punto_montaje, subclase, subclase_archivo, objeto_categoria_proyecto, objeto_categoria, nombre, titulo, colapsable, descripcion, fuente_datos_proyecto, fuente_datos, solicitud_registrar, solicitud_obj_obs_tipo, solicitud_obj_observacion, parametro_a, parametro_b, parametro_c, parametro_d, parametro_e, parametro_f, usuario, creacion, posicion_botonera) VALUES (
	'fulbo', --proyecto
	'10000062', --objeto
	NULL, --anterior
	NULL, --identificador
	NULL, --reflexivo
	'toba', --clase_proyecto
	'toba_datos_tabla', --clase
	'10000001', --punto_montaje
	'dt_players', --subclase
	'datos/dt_players.php', --subclase_archivo
	NULL, --objeto_categoria_proyecto
	NULL, --objeto_categoria
	'ci_jugadores - dt_jugadores', --nombre
	NULL, --titulo
	NULL, --colapsable
	NULL, --descripcion
	'fulbo', --fuente_datos_proyecto
	'fulbo', --fuente_datos
	NULL, --solicitud_registrar
	NULL, --solicitud_obj_obs_tipo
	NULL, --solicitud_obj_observacion
	NULL, --parametro_a
	NULL, --parametro_b
	NULL, --parametro_c
	NULL, --parametro_d
	NULL, --parametro_e
	NULL, --parametro_f
	NULL, --usuario
	'2022-04-23 21:21:57', --creacion
	NULL  --posicion_botonera
);
--- FIN Grupo de desarrollo 10

------------------------------------------------------------
-- apex_objeto_db_registros
------------------------------------------------------------
INSERT INTO apex_objeto_db_registros (objeto_proyecto, objeto, max_registros, min_registros, punto_montaje, ap, ap_clase, ap_archivo, tabla, tabla_ext, alias, modificar_claves, fuente_datos_proyecto, fuente_datos, permite_actualizacion_automatica, esquema, esquema_ext) VALUES (
	'fulbo', --objeto_proyecto
	'10000062', --objeto
	NULL, --max_registros
	NULL, --min_registros
	'10000001', --punto_montaje
	'1', --ap
	NULL, --ap_clase
	NULL, --ap_archivo
	'players', --tabla
	NULL, --tabla_ext
	NULL, --alias
	'0', --modificar_claves
	'fulbo', --fuente_datos_proyecto
	'fulbo', --fuente_datos
	'1', --permite_actualizacion_automatica
	'public', --esquema
	'public'  --esquema_ext
);

------------------------------------------------------------
-- apex_objeto_db_registros_col
------------------------------------------------------------

--- INICIO Grupo de desarrollo 10
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa, tabla) VALUES (
	'fulbo', --objeto_proyecto
	'10000062', --objeto
	'10000022', --col_id
	'pl_apno', --columna
	'X', --tipo
	'0', --pk
	'', --secuencia
	NULL, --largo
	NULL, --no_nulo
	'0', --no_nulo_db
	NULL, --externa
	'players'  --tabla
);
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa, tabla) VALUES (
	'fulbo', --objeto_proyecto
	'10000062', --objeto
	'10000023', --col_id
	'pl_id', --columna
	'E', --tipo
	'1', --pk
	'players_pl_id_seq', --secuencia
	NULL, --largo
	NULL, --no_nulo
	'1', --no_nulo_db
	NULL, --externa
	'players'  --tabla
);
--- FIN Grupo de desarrollo 10
