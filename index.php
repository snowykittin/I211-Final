<?php

//load application settings
require_once ("application/config.php");

//begin php session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//load autoloader
require_once ("vendor/autoload.php");

//load the dispatcher that dissects a request URL
new Dispatcher();