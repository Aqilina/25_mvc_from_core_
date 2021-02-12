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

        $result = [
            'errors' => []
        ];

//        REIKALINGA JS
        if ($post_id === null) {
            //reikalinga js
            $result['errors'] = 'no id given';
            redirect('/posts');
            die();
        }
//        print_r($_POST);
//        echo 'addComment ' . $post_id;

        //VALIDATE POST VALUES
        $vld = new Validation();

        //IF REQUEST IS POST AND SANITIZED
        if ($vld->ifRequestIsPostAndSanitize()) {

            $data = [
                'username' => trim($_POST['username']),
                'commentBody' => trim($_POST['commentBody']),
                'errors' => [
                    'usernameErr' => '',
                    'commentBodyErr' => '',
                ],
            ];

//            AR TUSTI IMPUTAI
            $data['errors']['usernameErr'] = $vld->validateEmpty($data['username'], 'Username cant\'t be empty');
            $data['errors']['commentBodyErr'] = $vld->validateEmpty($data['commentBody'], 'Please enter your comment');

            //IF NO ERRORS
            if ($vld->ifEmptyArr($data['errors'])) {
                $commentData = [
                    'author' => $data['username'],
                    'commentBody' => $data['commentBody'],
                    'postId' => $post_id
                ];
                //CREATE RESULT
                if ( $this->commentModel->addCommentToDb($commentData)) {
                    $result['success'] = 'Post added';

                } else {
                    $result['errors'] = 'Error adding post';
                }

            } else {
            $result['errors'] = $data['errors'];
            }
//--------------------------------------------------------------------------------------------------
//            IF REQUEST IS NOT POST
        } else {
            $result['error'] = 'not allowed';
            redirect('/posts');
        }


//        $commentData = $_POST;//pravalytam $_POST
//        if ($this->commentModel->addCommentToDb($commentData)) return 'success';
//--------------------------------------------------------------------------------------------------

        header('Content-Type: application/json');
        echo json_encode($result);
        die();
    }


    public function validate($inputField) {
       
        $vld = new Validation;
        
        print_r($_POST);
        echo $inputField . '<br>';
        $input = $_POST[$inputField];
        die('hello from validate');
        }
  
}