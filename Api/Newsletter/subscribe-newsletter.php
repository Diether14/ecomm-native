<?php
session_start();
require '../../App/Controllers/NewsletterController.php';

$controller = new NewsletterController();

$stmt = $controller->create($_POST);

echo $stmt;
?>