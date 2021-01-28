<?php
/*
 *users class
 * register user
 * login user
 * control users behavior and access
 */

class Users extends Controller
{
    public function __construct()
    {

    }

    public function register()
    {
//        echo 'register in progress';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //form process in progress

        } else {
//            load form. atejus i psl - tusti duomenys
//            create data for form
            $data = [
                'name' => '',
                'email' => '',
                'password' => '',
                'confirmPassword' => '',
                'nameErr' => '',
                'emailErr' => '',
                'passwordErr' => '',
                'confirmPasswordErr' => ''
            ];

            //load view
            $this->view('users/register', $data);
        }
    }

//    --------------------------------------------------------------------------------------------------------------------
    public function login()
    {
//        echo 'register in progress';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //form process in progress

        } else {
//            load form. atejus i psl - tusti duomenys
//            create data for form
            $data = [
                'email' => '',
                'password' => '',
                'emailErr' => '',
                'passwordErr' => '',
            ];

            //load view
            $this->view('users/login', $data);
        }
    }
}
