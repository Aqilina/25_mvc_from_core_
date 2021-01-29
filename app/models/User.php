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

    //CHECKS IN DB FOR EMAIL OR PASSWORD
    //tries to verify password
    //return row or false
    public function login($email, $notHashedPass)
    {
        // get the row with given email
        $this->db->query("SELECT * FROM users WHERE `email` = :email");
        $this->db->bind(':email', $email);
        $row = $this->db->singleRow();

        if ($row) {
            $hashedPassword = $row->password;
        } else {
            return false;
        }

        //check passwords
        if (password_verify($notHashedPass, $hashedPassword)) {
            return $row;
        } else {
            return false;
        }
    }
}