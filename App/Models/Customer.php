<?php

require 'Model.php';

class Customer extends Model {
    public $table = 'customers';
    protected $hidden = ['password', 'email_verified_at', 'remember_token', 'deleted_at'];
}