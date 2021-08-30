<?php

class Repository {
    protected $model;
    protected $table;
    public function __contruct() {
        $this->table = $this->model->getTableName();
    }
}

