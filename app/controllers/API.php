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
}