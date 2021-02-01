<?php

/*
* Post controller
* Basic CRUD Functionality
*
*/

class Posts extends Controller
{
    private $postModel;

    public function __construct() {
        //restrict access of this controller only to logged in users
        if (!isLoggedIn()) redirect('/users/login');

        $this->postModel = $this->model('Post');
    }

    public function index()
    {
        //get posts
        $posts = $this->postModel->getPosts();
       $data = [
           'posts' => $posts
       ];
       $this->view('posts/index', $data);
    }

    public function add()
    {
        $data = [
            'title' => '',
            'body' => '',
            'titleErr' => '',
            'bodyErr' => ''
        ];

        $this->view('posts/add', $data);
    }
}
