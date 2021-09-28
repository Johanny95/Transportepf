<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/ 
if(!in_array($_SERVER['REMOTE_ADDR'], $this->config->item('maintenance_ips')) && $this->config->item('maintenance_mode')) {
	$route['default_controller']    = "Home/maintenance";
	$route['(:any)']                = "Home/maintenance";
} else{
	$route['default_controller']    = 'Home/inicio';
	$route['login']                 ='Home/login';
}
$route['check']                     = 'check_session/checkSession';
$route['404_override']              = '';
$route['translate_uri_dashes']      = FALSE;

$route['logout']                    ='Home/logout';
$route['index']                     ='Controller_transporte/dashbord';
$route['sin_acceso']				='Home/no_login';

//oficinas
$route['listadoOficinas']           ='Controller_transporte/menuOficinas';
$route['mantenedorTipoDoc']         ='Controller_transporte/mantenedorTipoDoc';
$route['addTipoDoc']                ='Controller_transporte/addTipoDocumento';
$route['getAllDocs']                ='Controller_transporte/getAllTipoDocs';
$route['editTipoDoc']               ='Controller_transporte/editTipoDoc';
$route['seleccionarOficina/(:any)'] ='Controller_transporte/seleccionarOficina/$1';
//TRANSPORTISTA
$route['menuTransportista']			='Controller_transporte/menuTransportista';
$route['verTransportistas']         ='Controller_transporte/getTransportistas';
$route['seleccionar']               ='Controller_transporte/cargarFlota';
$route['docFlota']                  ='Controller_transporte/docFlota';
$route['verDocTransp']              ='Controller_transporte/getDocs_transp';
$route['getTiposDoc']               ='Controller_transporte/getTipoDocTransp';
$route['getFechaDoc']               ='Controller_transporte/getValidadorFechaV';
$route['verDocCompartido']			='Controller_transporte/getValidadorCompartido';
$route['getChoferAyudantes']		='Controller_transporte/getChoferAyudantes';
$route['addDocTransp']              ='Controller_transporte/insertDocumento';
$route['eliminar_documento']		='Controller_transporte/eliminar_documento';
$route['verFicha']                  ='Controller_transporte/verFicha';
$route['verHistTransp']             ='Controller_transporte/getHistorialTransp';
$route['getDataDoc']                ='Controller_transporte/getDocData';
$route['updateTransp']				='Controller_transporte/updateTransportista';
//Camion 
$route['getPatentes']               ='Controller_camion/patentes';
$route['seleccionarCamion']         ='Controller_camion/cargarFicha';
$route['cargarFichaDoc']            ='Controller_camion/verFichaCamion';
$route['getDocsCamiones']           ='Controller_camion/getDocsCamiones';
$route['updateCamion']              ='Controller_camion/updateCamion';
$route['getImg']                    ='Controller_camion/getImagenesCamion';
$route['addImgCamion']              ='Controller_camion/addImgCamion';
$route['getTiposDocCamion']         ='Controller_camion/getTiposDocCamion';
$route['verHistCamion']             ='Controller_camion/verHistCamion';
$route['getDocDataCamion']          ='Controller_camion/getDocDataCamion';
$route['addDocCamion']              ='Controller_camion/addDocCamion';

//chofer
$route['getListChofer']             ='Controller_chofer/getListChofer';
$route['docsChofer']                ='Controller_chofer/docsChofer';
$route['getTiposDocChofer']         ='Controller_chofer/getTipoDocChofer';
$route['addDocChofer']              ='Controller_chofer/insertDocChofer';
$route['seleccionarChofer']         ='Controller_chofer/seleccionarChofer';
$route['ficha_chofer']              ='Controller_chofer/verFichaChofer';
$route['cargarFichaChofer']         ='Controller_chofer/fichaChofer';
$route['updateChofer']              ='Controller_chofer/updateChofer';
$route['verHistChofer']				='Controller_chofer/verHistChofer';
$route['verificarDuenno']			='Controller_chofer/verificarDuenno';
$route['addImgChofer'] 				='Controller_chofer/addImgChofer';
$route['datos_chofer']				='Controller_chofer/datos_chofer';

//Ayudante
$route['getListAyudante']           ='Controller_ayudante/getListAyudante';
$route['getTiposDocAyudante']       ='Controller_ayudante/getTipoDocAyudante';
$route['docsAyudante']              ='Controller_ayudante/getDocsAyudante';
$route['addDocAyudante']            ='Controller_ayudante/addDocAyudante';
$route['seleccionarAyudante/(:any)']='Controller_ayudante/verFuchaAyudante/$1';
$route['verHistAyudante']			='Controller_Ayudante/verHistAyudante';
$route['updateAyudante']			='Controller_ayudante/updateAyudante';
$route['addImgAyudante']			='Controller_ayudante/addImgAyudante';
$route['datos_ayudante']			='Controller_ayudante/datos_ayudante';

//informes
$route['informeVencimiento']        ='Controller_informe/indexInformeVencimiento';
$route['get_informe_vigencia'] 		='Controller_informe/get_informe_vigencia';
$route['getDataChart']				='Controller_informe/datos_grafico';
$route['get_informe_cert_provi']	='Controller_informe_previsional/get_informe_cert_provi';
$route['informe_tripulacion']		='Controller_informe_previsional/informe_tripulacion_previsional'; //19-10-2018 previsional
$route['informe_transp']			='Controller_informe_previsional/informe_transp_previsional'; //19-10-2018 previsional

//Celulares
$route['mantenedor_telefono'] 		='Controller_telefonos/mantenedorTelefono';
$route['addTelefono']				='Controller_telefonos/agregarTelefono';
$route['validarImei']               ='Controller_telefonos/validarImei';
$route['getTablaTelefonos']         ='Controller_telefonos/getTablaTelefonos';
$route['updateTelefono']			='Controller_telefonos/updateTelefono';
$route['desactivar']				='Controller_telefonos/updateEstadoTelefono';

//relacion chofer Camion
$route['relacion']                  = 'Controller_camion_chofer/mantenedorChoferCamion';
$route['get_choferes']				= 'Controller_telefonos/get_lista_chofer';
$route['get_camiones']				= 'Controller_telefonos/getCamiones';
$route['validar_imei']				= 'Controller_camion_chofer/validar_imei_relacion';
$route['validar_chofer_r']			= 'Controller_camion_chofer/validar_chofer_relacion';
$route['validar_numero_r']			= 'Controller_camion_chofer/validar_numero_relacion';
$route['validar_camion_r']			= 'Controller_camion_chofer/validar_camion_relacion';
$route['addRelacion']				= 'Controller_camion_chofer/addRelacion_tel_chof';
$route['getTablaRelaciones']		= 'Controller_camion_chofer/getTablaRelaciones';
$route['deshabilitar']				= 'Controller_camion_chofer/des_telefono_chofer';
$route['getHistorialTelefonos']		= 'Controller_camion_chofer/getHistorialTelefonos';
$route['getHistCelulares']			= 'Controller_telefonos/getHistorialFonos';

// Informe Nacional Transporte
$route['informe_nacional']          = 'Controller_informe/get_informe_nacional_view';
$route['get_informe_nacional']      = 'Controller_informe/get_informe_nacional';

/** Informe de oficina 06/04/2018 **/
$route['get_informe_vigencia_beta']        		= 'Controller_informe/indexInformeVencimientoBeta';
$route['tabla_resumen/get_informe_vigencia'] 	= 'Controller_informe/get_informe_doc_vigente';

//RAMPLA
$route['getRamplas']               				= 'Controller_rampla/getListRamplas';
$route['getDocsRampla']            				= 'Controller_rampla/getDocsRampla';
$route['getTiposDocRampla']        				= 'Controller_rampla/getTipoDocRampla';
$route['addDocRampla']							= 'Controller_rampla/addDocRampla';

/*--NUEVOS 30-09-2019--*/

$route['get_oficinas']               			= 'Controller_transporte/get_oficinas';
$route['get_ofi_doc']				 			= 'Controller_transporte/get_ofi_doc';


/*rutas nuevas 18-10-2019*/
/*Mantenedor de usuarios rol para aprobacion o manteneción*/
$route['asociacion_usuario_rol']			= 'C_Mantenedores/Controller_permisos/view_mantenedor_usurol';
$route['get_usuario_rol']					= 'C_Mantenedores/Controller_permisos/get_usuarios_rol';
$route['get_roles']							= 'C_Mantenedores/Controller_permisos/get_roles';
$route['tabla_usurol/get_usuarios']			= 'C_Mantenedores/Controller_permisos/get_usurol_flota';
$route['add_usu_rol']						= 'C_Mantenedores/Controller_permisos/add_usu_rol';
$route['get_ofi_usu']						= 'C_mantenedores/Controller_permisos/get_oficinas_usuario';
$route['get_tipo_documentos']				= 'C_mantenedores/Controller_permisos/get_documentos_tipo';
$route['upd_rol_usuario']					= 'C_mantenedores/Controller_permisos/upd_usu_rol';


/*ROUTE APROBACION DE DOCUMENTOS*/
$route['listado_documentacion']				= 'C_aprobacion/Controller_aprobacion/view_aprobacion';
$route['get_usuoficina']					= 'C_aprobacion/Controller_aprobacion/get_usuoficina';
$route['get_usudocumentos']					= 'C_aprobacion/Controller_aprobacion/get_usudocumentos';

/*documentos para aprobacion*/
$route['get_documentos_transp_usuario']		= 'C_aprobacion/Controller_aprobacion/get_usuario_documentos_transp';
$route['get_documentos_camion_usuario']		= 'C_aprobacion/Controller_aprobacion/get_usuario_documentos_camion';
$route['get_documentos_chofer_usuario']		= 'C_aprobacion/Controller_aprobacion/get_usuario_documentos_chofer';
$route['get_documentos_ayudante_usuario']	= 'C_aprobacion/Controller_aprobacion/get_usuario_documentos_ayudante';
$route['get_documentos_rampla_usuario']		= 'C_aprobacion/Controller_aprobacion/sp_get_doc_usu_rampa';


/**/
$route['get_motivos_rechazo']				= 'C_aprobacion/Controller_aprobacion/get_motivos_recha_documento';

$route['aprobar_documento']					= 'C_aprobacion/Controller_aprobacion/aprobar_documento';
$route['rechazar_documento']				= 'C_aprobacion/Controller_aprobacion/rechazar_documento';

/*vista de aprobacion por usuario*/
/*ver documentos aprobador por el*/
$route['mis_aprobaciones']					= 'C_aprobacion/Controller_aprobacion/view_mis_aprobaciones';
$route['get_mis_aprobacion']					= 'C_aprobacion/Controller_aprobacion/get_mis_aprobaciones_doc';


/*Vistas para rol de visualizacion*/
$route['cumplimiento_view']					= 'C_visualizacion/Controller_visualizacion/view_cumplimiento';
$route['view_det_documentacion/(:any)'] 	= 'C_visualizacion/Controller_visualizacion/view_detalle_documentacion/$1';
$route['get_detalle_doc_view']				= 'C_visualizacion/Controller_visualizacion/get_detalle_doc';
$route['get_cumplimiento_oficinas']			= 'C_visualizacion/Controller_visualizacion/get_cumplimiento_oficinas';
$route['get_cumplimiento_rampas']			= 'C_visualizacion/Controller_visualizacion/get_cumplimiento_rampas_view';