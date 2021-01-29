<?php
//User class
//for getting and setting database values

class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

//    public function findUserByEmail() {
//
//    }
}