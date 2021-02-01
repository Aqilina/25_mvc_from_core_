<?php

//Class for getting and sending Post data and from DB

class Post
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    //get all post from post table
//    @return Object Array
    public function getPosts()
    {
        $this->db->query("SELECT * FROM posts");

        $result = $this->db->resultSet();

        return $result;
    }
}