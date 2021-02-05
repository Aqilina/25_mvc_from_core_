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




    public function comments()
    {
        $data = [
            'id' =>'comments'
        ];
        echo json_encode($data);
    }
}