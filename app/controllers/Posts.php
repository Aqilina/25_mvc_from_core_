<?php

/*
* Post controller
* Basic CRUD Functionality
*
*/

class Posts extends Controller
{
    public function index()
    {
       $data = [];
       $this->view('posts/index', $data);
    }
}
