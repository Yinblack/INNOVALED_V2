<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//WEBPAGE
$route['test'] = 'WebPage_c/test';

$route['Home'] = 'WebPage_c/Home';
$route['index'] = 'WebPage_c/index';
$route['Carrito'] = 'WebPage_c/Carrito';
$route['Productos'] = 'WebPage_c/Productos';
$route['DetalleProducto'] = 'WebPage_c/DetalleProducto';
$route['Quote'] = 'WebPage_c/Quote';

$route['HomeTwo'] = 'WebPage_c/HomeTwo';
$route['ProductosTwo'] = 'WebPage_c/ProductosTwo';
$route['DetalleProductoTwo'] = 'WebPage_c/DetalleProductoTwo';




$route['Admin'] = 'Admin_index_c/index';
//Productos
$route['ListProductos'] = 'Admin_c/ListProductos';
$route['NuevoProducto'] = 'Admin_c/NuevoProducto';
$route['UpdateProducto'] = 'Admin_c/UpdateProducto';
$route['UpdateEscalaPrecio'] = 'Admin_c/UpdateEscalaPrecio';

$route['NuevaEscalaPrecio'] = 'Admin_c/NuevaEscalaPrecio';
$route['ListEscalaPrecios'] = 'Admin_c/ListEscalaPrecios';

$route['LineaSublinea'] = 'Admin_c/LineaSublinea';

$route['ListCotizaciones'] = 'Admin_c/ListCotizaciones';
$route['DetalleCotizacion'] = 'Admin_c/DetalleCotizacion';

$route['Configuracion'] = 'Admin_c/Configuracion';
$route['ProfileConfig'] = 'Admin_c/ProfileConfig';


$route['CotizacionPdf'] = 'Cart_c/CotizacionPdf';




$route['NuevoUsuario'] = 'Cpanel/NuevoUsuario';
$route['ListUsuarios'] = 'Cpanel/ListUsuarios';
$route['UpdateUsuario'] = 'Cpanel/UpdateUsuario';
$route['UpdateUsuarioFromPerfil'] = 'Cpanel/UpdateUsuarioFromPerfil';

$route['NuevoEvento'] = 'Cpanel/NuevoEvento';
$route['ListEventos'] = 'Cpanel/ListEventos';
$route['UpdateEvento'] = 'Cpanel/UpdateEvento';

$route['NuevoMentor'] = 'Cpanel/NuevoMentor';
$route['ListMentores'] = 'Cpanel/ListMentores';
$route['UpdateMentor'] = 'Cpanel/UpdateMentor';
$route['OrdenMentores'] = 'Cpanel/OrdenMentores';


$route['ListEventosInscrito'] = 'Cpanel/ListEventosInscrito';
$route['DetailEventoSuscrito'] = 'Cpanel/DetailEventoSuscrito';
$route['ComprobanteInscripcion'] = 'Cpanel/ComprobanteInscripcion';



$route['problema'] = 'Cpanel/problema';
$route['codeFight'] = 'Cpanel/codeFight';




$route['Inscripcion'] = 'Cpanel/Inscripcion';
$route['Registro'] = 'Cpanel_index_c/Registro';
$route['Pago'] = 'Cpanel/Pago';

$route['LogOut'] = 'Persona_c/LogOut';/*RUTA NO ACCESIBLE*/
//Default

$route['default_controller'] = 'WebPage_c';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
