<?php

namespace App\Http;

define('DIR_HTTP_CURRENT_PAGE', "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
define('DIR_HTTP_ROUTENAME', substr($_SERVER['REQUEST_URI'], strpos($_SERVER['REQUEST_URI'], '/') + 1));

if ($_SERVER['HTTP_HOST'] == "localhost:8000" || $_SERVER['HTTP_HOST'] == "127.0.0.1:8000") {
    define('DIR_HTTP_HOME', "http://" . $_SERVER['HTTP_HOST'] . "/");
    define('DIR_WS_HOME', $_SERVER['DOCUMENT_ROOT'] . "\\");

    define('DIR_HTTP_CSS', DIR_HTTP_HOME . "css/");
    define('DIR_HTTP_JS', DIR_HTTP_HOME . "js/");
    define('DIR_HTTP_VENDOR', DIR_HTTP_HOME . "vendor/");

    define('DIR_HTTP_IMAGES', DIR_HTTP_HOME . "images/");
    define('DIR_WS_IMAGES', DIR_WS_HOME . "images\\");

    define('DIR_HTTP_CSV', DIR_HTTP_IMAGES . "sample/");
    define('DIR_WS_CSV', DIR_WS_IMAGES . "sample\\");

    define('DIR_HTTP_UPLOAD', DIR_HTTP_IMAGES . "csv/");
    define('DIR_WS_UPLOAD', DIR_WS_IMAGES . "csv\\");

    define('DIR_HTTP_ASSETS', DIR_HTTP_HOME . "assets/");
    define('DIR_WS_ASSETS', DIR_WS_HOME . "assets\\");
} else {
    define('DIR_HTTP_HOME', "http://" . $_SERVER['HTTP_HOST'] . "/public/");
    define('DIR_WS_HOME', $_SERVER['DOCUMENT_ROOT'] . "/public/");

    define('DIR_HTTP_CSS', DIR_HTTP_HOME . "css/");
    define('DIR_HTTP_JS', DIR_HTTP_HOME . "js/");
    define('DIR_HTTP_VENDOR', DIR_HTTP_HOME . "vendor/");

    define('DIR_HTTP_IMAGES', DIR_HTTP_HOME . "images/");
    define('DIR_WS_IMAGES', DIR_WS_HOME . "images/");

    define('DIR_HTTP_CSV', DIR_HTTP_IMAGES . "sample/");
    define('DIR_WS_CSV', DIR_WS_IMAGES . "sample/");

    define('DIR_HTTP_UPLOAD', DIR_HTTP_IMAGES . "csv/");
    define('DIR_WS_UPLOAD', DIR_WS_IMAGES . "csv/");

    define('DIR_HTTP_ASSETS', DIR_HTTP_HOME . "assets/");
    define('DIR_WS_ASSETS', DIR_WS_HOME . "assets/");
}
