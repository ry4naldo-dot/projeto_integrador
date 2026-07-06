<?php

function view($view, $data = [])
{

    foreach ($data as $key => $value) {
        $$key = $value;
    }



    require "view/template/app.php";
}

function dd(...$dump)
{

    echo "<pre>";
    var_dump($dump);
    echo "</pre>";
    die();
}

function abort($code)
{

    http_response_code($code);
    view($code);
    die();
}

function flash()
{
    return new flash;
}

function config($chave = null)
{

    $config = require 'config.php';

    if (strlen($chave) > 0) {
        return $config[$chave];
    }

    return $config;
}

function auth()
{

    if (!isset($_SESSION['auth'])) {

        return null;
    }

    return $_SESSION['auth'];
}

function adm()
{

    if (!isset($_SESSION['adm'])) {

        return null;
    }

    return $_SESSION['adm'];

}
