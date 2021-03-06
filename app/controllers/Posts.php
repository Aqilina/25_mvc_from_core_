<?php

/*
* Post controller
* Basic CRUD Functionality
*
*/

class Posts extends Controller //from libraries
{
    private $postModel;
    private $userModel;
    private $vld;

    public function __construct()
    {
        //restrict access of this controller only to logged in users
        if (!isLoggedIn()) redirect('/users/login');

        $this->postModel = $this->model('Post');
        $this->userModel = $this->model('User');
        $this->vld = new Validation();
    }

    public function index()
    {

        //get posts
        $posts = $this->postModel->getPosts();
        $data = [
            'posts' => $posts,
            'currentPage' => 'home'
        ];
        $this->view('posts/index', $data);
    }

    public function add()
    {
        //if form was submitted
        if ($this->vld->ifRequestIsPostAndSanitize()) {
//        VALIDATION
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

    public function show($id = null)
    {
//        if didnt find id - redirect to posts controller
        if ($id === null) redirect('/posts');

//        get post row
        $post = $this->postModel->getPostById($id);
        //get user data by user id
        $user = $this->userModel->getUserById($post->user_id);

        //create data for the view and add post data
        $data = [
            'post' => $post,
            'user' => $user,
            'commentsOn' => true
        ];
        $this->view('posts/show', $data);
    }

    public function edit($id = null)
    {
        //if post has no such parameter, we redirect
        if ($id === null) redirect('/posts');

        //if form was submitted
        if ($this->vld->ifRequestIsPostAndSanitize()) {
//            VALIDATION. ISVALOMAS POST MASYVAS

            $data = [
                'post_id' => $id,
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
                if ($this->postModel->updatePost($data)) {
                    //post added
                    flash('post_message', 'You have edited a new post');
                    redirect('/posts');
                } else {
                    die('something went wrong in adding post');
                }
            } else {
//                load view with errors
                $this->view('posts/edit', $data);
            }
//--------------------------------------------------------------------------------------------
        } else {
            //user entered this page
            $post = $this->postModel->getPostById($id);

            if ($post) {
                //check if this post belongs to this user
                if ($post->user_id !== $_SESSION['user_id']) redirect('/posts');
                //post found and will load the view
            } else
                die('sth went wrong in getpostById()');


            $data = [
                'id' => $id,
                'title' => $post->title,
                'body' => $post->body,
                'titleErr' => '',
                'bodyErr' => ''
            ];

            $this->view('posts/edit', $data);
        }
    }

    public function delete($id=null)
    {
        if ($this->vld->ifRequestIsPost() && $id) {
//            die('will be deleted soon');
            if ($this->postModel->deletePost($id)) {
                flash('post_message', 'post was deleted', 'alert alert-warning' );
                redirect('/posts');
            }
        } else {
            redirect('/posts');
        }
    }
}
