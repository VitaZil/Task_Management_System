<?php

use Vitab\TaskManagementSystem\Services\RouterService;

require 'vendor/autoload.php';
require_once './routes.php';

$router = new RouterService();

    $router->doRouting(
        path: $_SERVER['REQUEST_URI'],
        method: $_SERVER['REQUEST_METHOD'],
        params: $_SERVER['REQUEST_METHOD'] === 'POST' ? $_POST : $_GET,
    );




