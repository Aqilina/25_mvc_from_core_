<?php

//this is a class to validate diff inputs and data
class Validation
{
    //check if server request is post
    //@ return boolean
    public function ifRequestIsPost()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') return true;
        return false;
    }
}