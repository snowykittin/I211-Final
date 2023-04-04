<?php
require_once('application/config.php');
require_once('application/database.class.php');
require_once('controllers/register_controller.class.php');
require_once('models/register_model.class.php');
require_once('views/register/register_view.class.php');

$db = Database::getInstance();

$model = new RegisterModel($db);

$controller = new RegisterController($model);

$controller->registerUser();

RegisterView::show(array());

?>

