<?php

require 'Repository.php';
require '../../App/Models/Customer.php';

class CustomerRepository extends Repository {
    public function __construct() {
        $this->model = new Customer();
        parent::__contruct();
    }
    
    public function findAll() {
        return $this->model->findAll();
    }

    public function login($creds) {
        $email = $creds['email'];
		$password = $creds['password'];
        $sql = "SELECT id FROM $this->table WHERE `email` = :email AND `password` = :password";
        $stmt = $this->model->conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
    
        $count = $stmt->rowCount();
        
        if ($count > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            extract($row);
            return $id;
        } else {
            return "400";
        }
    }

    public function signup($req) {
        return $this->model->create($req);
    }
}

