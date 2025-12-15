<?php
    session_start();

    require_once __DIR__ . '/../src/core/Router.php';


    $router = new Router();
    $router->run();