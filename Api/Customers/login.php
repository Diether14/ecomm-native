<?php
session_start();
require '../../App/Controllers/CustomerController.php';

$controller = new CustomerController();

$stmt = $controller->login($_POST);

if ($stmt === "400") {
	echo 400;
} else {
	echo $_SESSION['login'] = $stmt;
}
?>
