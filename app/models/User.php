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

//    FIND USER BY GIVEN EMAIL. @RETURN BOOLEAN
    public function findUserByEmail($email)
 {
     //check if the given email is in database
     //prepare statements with query function from dbh
     $this->db->query("SELECT * FROM users WHERE email = :email");

     //add values to stmt
     $this->db->bind(':email', $email);

//     save result in row
     $row = $this->db->singleRow();

     //check if we got some results
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    //REGISTER USER WITH GIVEN SANITIZED DATA
//    @return boolean

    public function register($data)
    {
        //prepare statement
        $this->db->query("INSERT INTO users (`name`, `email`, `password`) VALUES(:name, :email, :password)");

        //bind values
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        //(password is hashed):
        $this->db->bind(':password', $data['password']);

        //make query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}