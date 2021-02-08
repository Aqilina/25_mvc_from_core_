<?php

//class for returning json formatted data
class API extends Controller
{
    private $commentModel;

    public function __construct()
    {
        $this->commentModel = $this->model('Comment');
    }

    public function index()
    {
        echo "API index";
    }


    public function comments($post_id = null)
    {
        if ($post_id === null) {
            header('Content-Type: application/json');
            echo json_encode(['error' => 'no id given']);
            die();
        }
        $comments = $this->commentModel->getMeComments($post_id);
        $data = [
            'comments' => $comments,
            'post_id' => $post_id
        ];
        // KAD NARSYKLE ZINOTU, KAD CIA JSON
        header('Content-Type: application/json');
        echo json_encode($data);
    }
//    ----------------------------------------------------------------------------------------
    //GAUNAMA IS FETCH
    public function addComment($post_id = null)
    {
        $result = [];
        print_r($_POST);
        echo 'addComment ' . $post_id;

        //VALIDATE POST VALUES
        $commentData = $_POST;//pravalytam $_POST


        //IF VALID - ADD POST
//        if ($this->commentModel->addCommentToDb($commentData)) return 'success';

        $result['success'] = "Post added";
        echo json_encode($result);
        die();
    }
}