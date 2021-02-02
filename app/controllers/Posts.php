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
        //if form was submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//            VALIDATION. ISVALOMAS POST MASYVAS
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'user_id' => $_SESSION['user_id'],
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'titleErr' => '',
                'bodyErr' => ''
            ];

            //VALIDATE TITLE
            if (empty($data['title'])) {
                $data['titleErr'] = 'Please enter a title';
            }

            //VALIDATE BODY
            if (empty($data['body'])) {
                $data['bodyErr'] = 'Please enter a text';
            }

            //CHECK IF THERE ARE NO ERRORS
            if (empty($data['titleErr']) && empty($data['bodyErr'])) {
                //there are no errors
                if ($this->postModel->addPost($data)) {
                    //post added
                    flash('post_message', 'You have added a new post');
                    redirect('/posts');
                } else {
                    die('something went wrong in adding post');
                }
            } else {
//                load view with errors
                $this->view('posts/add', $data);
            }

        } else {
            //user entered this page
            $data = [
                'title' => '',
                'body' => '',
                'titleErr' => '',
                'bodyErr' => ''
            ];

            $this->view('posts/add', $data);
        }


    }
}
