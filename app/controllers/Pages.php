<?php
// Pages class responsible for controlin Pages
class Pages extends Controller
{
    public function __construct()
    {
        // echo 'hello form pages controller';
    }

    public function index()
    {
        // create some data to load into vie
        $data = [
            'title' => 'Welcome to ' . SITENAME,
            'description' => 'This is an app to share your Thoughts with the World'
        ];

        // load the view
        $this->view('pages/index', $data);
    }

    public function about()
    {
        // load the view
        // create some data to load into vie
        $data = [
            'title' => 'About - ' . SITENAME,
            'description' => 'App to share news with friends and World'
        ];

        // load the view
        $this->view('pages/about', $data);
    }
}
