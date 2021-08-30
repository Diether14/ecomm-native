<?php

require 'Controller.php';
require '../../App/Repositories/CustomerRepository.php';

class CustomerController extends Controller {
    public function __construct() {
        parent::__construct();
        $this->repository = new CustomerRepository();
    }

    public function login($data) {
        return $this->repository->login($data);
    }

    public function signup($data) {
        $request = [
            'password'  => $data['password'],
            'email'  => $data['email'],
            'name'  => $data['name'],
        ];
        return $this->repository->signup($request);
    }

    public function findAll() {
        return $this->repository->findAll();
    }
}