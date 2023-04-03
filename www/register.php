<?php
require_once('config.php');
require_once('classes/Database.php');
require_once('classes/RegisterController.php');
require_once('classes/RegisterModel.php');
require_once('views/register/RegisterView.php');

$db = new Database(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

$model = new RegisterModel($db);

$controller = new RegisterController($model);

$controller->registerUser();

IndexView::displayFooter();

?>

