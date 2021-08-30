<?php
session_start();
require '../../App/Controllers/CustomerController.php';

$controller = new CustomerController();

$stmt = $controller->findAll();
$result =  $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($stmt === 400) {
	echo 400;
} else {
    echo json_encode($result);
}
?>
