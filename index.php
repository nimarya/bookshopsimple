<?php

require_once './autoload.php';
require_once './vendor/autoload.php';

use App\Entities\Url;

$url = Url::make();

$id = $url->getId();
$action = $url->getAction();

$controller = ucfirst($url->getController());
$controllerName = 'App\Controllers\\' . $controller . 'Controller';

$controller = new $controllerName($id);
$controller->action($action);
