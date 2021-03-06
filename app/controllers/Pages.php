<?php
// Pages class responsible for controling Pages
class Pages extends Controller //from libraries
{
    public function __construct()
    {
        // echo 'hello form pages controller';
    }

    public function index()
    {
        //if user is logged in we redirect
        if (isLoggedIn()) redirect('/posts');


        // create some data to load into vie
        $data = [
            'title' => 'Welcome to ' . SITENAME,
            'description' => 'This is an app to share your Thoughts with the World',
            'currentPage' => 'home'
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
            'description' => 'App to share news with friends and World',
            'currentPage' => 'about'
        ];

        // load the view
        $this->view('pages/about', $data);
    }
}
