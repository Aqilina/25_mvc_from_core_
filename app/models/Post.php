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
        $sql = "SELECT posts.title, posts.body, users.name, users.email, 
                posts.id as postId, 
                users.id as userId, 
                posts.created_at as postCreated, 
                users.created_at as userCreated 
                FROM posts 
                INNER JOIN users 
                ON posts.user_id = users.id 
                ORDER BY posts.created_at DESC";

        $this->db->query($sql);

        $result = $this->db->resultSet();

        return $result;
    }
}