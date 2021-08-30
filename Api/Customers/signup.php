<?php
session_start();
require '../../App/Controllers/CustomerController.php';

$controller = new CustomerController();

$stmt = $controller->signup($_POST);

if ($stmt === 200) {
	echo 200;
} else {
	echo 400;
}
?>
