<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once './app/libs/Router.php';
require_once './app/controllers/Album.api.controller.php';
require_once './app/controllers/Banda.api.controller.php';

// crea el router
$router = new Router();

// defina la tabla de ruteo
$router->addRoute('album', 'GET', 'AlbumApiController', 'getAlbums');
$router->addRoute('album/:ID', 'GET', 'AlbumApiController', 'getAlbum');
$router->addRoute('album/:ID', 'DELETE', 'AlbumApiController', 'deleteAlbum');
$router->addRoute('album', 'POST', 'AlbumApiController', 'addAlbum'); 
$router->addRoute('album/:ID', 'PUT', 'AlbumApiController', 'updateAlbum'); 

$router->addRoute('banda', 'GET', 'BandaApiController', 'getBands');
$router->addRoute('banda/:ID', 'GET', 'BandaApiController', 'getBand');
$router->addRoute('banda/:ID', 'DELETE', 'BandaApiController', 'deleteBand');
$router->addRoute('banda', 'POST', 'BandaApiController', 'addBand');
$router->addRoute('banda/:ID', 'PUT', 'BandaApiController', 'updateBand'); 


$router->route($_GET["resource"] ?? null, $_SERVER['REQUEST_METHOD']);