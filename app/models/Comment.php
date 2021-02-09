<?php


class Comment
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

//    KIEKV KARTA, SIUNCIANT KOMENTARA, VYKDOMA SITA F-JA
    public function getMeComments($post_id)
    {
        $this->db->query('SELECT * FROM comments WHERE post_id = :id ORDER BY created_at DESC ');

        //PRIBAINDINTI ID
        $this->db->bind(':id', $post_id );

        $comments = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $comments;
        }
        return false;
    }

//    GET DATA USING DATA
    //@return boolean
    public function addCommentToDb($data)
    {
        $this->db->query("INSERT INTO  comments (post_id, author, comment_body) VALUES (:post_id, :author, :comment_body)");
//        bind values
            $this->db->bind(':post_id', $data['postId']);
            $this->db->bind(':author', $data['author']);
            $this->db->bind(':comment_body', $data['commentBody']);

            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
    }

}

