<?php

require 'Controller.php';
require '../../App/Repositories/NewsletterRepository.php';

class NewsletterController extends Controller {
    public function __construct() {
        parent::__construct();
        $this->repository = new NewsletterRepository();
    }

    public function create($data) {
        $request = [
            'email'  => $data['email'],
        ];
        return $this->repository->create($request);
    }

    public function findAll() {
        return $this->repository->findAll();
    }
}