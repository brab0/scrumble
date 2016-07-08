<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/* Área do Projeto */
$route['projeto/(:any)/dashboard'] = "projeto/dashboard/main_content/$1";
$route['projeto/(:any)/product-backlog'] = "projeto/product_backlog/main_content/$1";
//$route['projeto/(:any)/sprint/sprint-backlog'] = "projeto/sprint/sprint_backlog/$1";
$route['projeto/(:any)/sprint'] = "projeto/sprint/main_content/$1";
$route['projeto/(:any)/sprint/sprint-planning'] = "projeto/sprint/sprint_planning/$1";
$route['projeto/(:any)/reviews'] = "projeto/reviews/main_content/$1";
$route['projeto/(:any)/restropectives'] = "projeto/restropectives/main_content/$1";
$route['projeto/(:any)/scrum-team'] = "projeto/scrum_team/main_content/$1";
$route['projeto/(:any)/clientes'] = "projeto/clientes/main_content/$1";
$route['projeto/(:any)/mensagens'] = "projeto/mensagens/main_content/$1";
$route['projeto/(:any)'] = "projeto/dashboard/main_content/$1";

/* Área do Usuário */
$route['usuario'] = "usuario/dashboard/main_content";
$route['usuario/dashboard'] = "usuario/dashboard/main_content";
$route['usuario/mensagens'] = "usuario/mensagens/main_content";

$route['cadastre-se'] = "registro";