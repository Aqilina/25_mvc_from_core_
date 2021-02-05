<?php


class Comment
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getMeComments($post_id)
    {
        $this->db->query('SELECT * FROM comments WHERE post_id = :id');

        //PRIBAINDINTI ID
        $this->db->bind(':id', $post_id );

        $comments = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $comments;
        }
        return false;
    }

}

