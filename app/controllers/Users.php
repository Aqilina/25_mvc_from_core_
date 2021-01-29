<?php
/*
 * Users class
 * Register user
 * Login user
 * Control Uses behavior and access
*/
class Users extends Controller
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function register()
    {
        // echo 'Register in progress';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // form process in progress

            // sanitize Post Array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // create data
            $data = [
                'name'      => trim($_POST['name']),
                'email'     => trim($_POST['email']),
                'password'  => trim($_POST['password']),
                'confirmPassword' => trim($_POST['confirmPassword']),
                'nameErr'      => '',
                'emailErr'     => '',
                'passwordErr'  => '',
                'confirmPasswordErr' => '',
            ];

            // Validate Name
            if (empty($data['name'])) {
                // empty field
                $data['nameErr'] = "Please enter Your Name";
            }

            // Validate Email
            if (empty($data['email'])) {
                // empty field
                $data['emailErr'] = "Please enter Your Email";
            } else {
                if (filter_var($data['email'], FILTER_VALIDATE_EMAIL) === false) {
                    $data['emailErr'] = "Please check your email";
                } else {
//                    check if email already exists
                    if ($this->userModel->findUserByEmail($data['email'])) {
                        $data['emailErr'] = 'Email is already taken';
                    }
                }
            }

            // Validate Password
            if (empty($data['password'])) {
                // empty field
                $data['passwordErr'] = "Please enter a password";
            } elseif (strlen($data['password']) < 6) {
                $data['passwordErr'] = "Password must be 6 or more characters";
            }

            // Validate confirmPassword
            if (empty($data['confirmPassword'])) {
                // empty field
                $data['confirmPasswordErr'] = "Please repeat password";
            } else {
                if ($data['confirmPassword'] !== $data['password']) {
                    $data['confirmPasswordErr'] = "Password must match";
                }
            }



            // IF THERE ARE NO ERRORS
            if (empty($data['nameErr']) && empty($data['emailErr']) && empty($data['passwordErr']) && empty($data['confirmPasswordErr'])) {
                // there are no errors;
//                die('SUCCESS');

                //VALIDATION IS OK


//                HASH PASSWORD //safe vay to store password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                //CREATE USER

                if ($this->userModel->register($data)) {
                    //success - user added
                    //set flash message
                    flash('register_success', 'You have registered successfully');
//                    header("Location: " . URLROOT. "/users/login");
                    redirect('/users/login'); //sita f-ja helperiuose
                } else {
                    die('Something went wrong in adding user in db');
                }
            } else {
                //set flash msg
                flash('register_fail', 'please check the form', 'alert alert-danger');
                // load view with errors
                $this->view('users/register', $data);
            }
        } else {
            // load form
            // echo 'load form';

            // create data
            $data = [
                'name'      => '',
                'email'     => '',
                'password'  => '',
                'confirmPassword' => '',
                'nameErr'      => '',
                'emailErr'     => '',
                'passwordErr'  => '',
                'confirmPasswordErr' => '',
            ];

            // load view
            $this->view('users/register', $data);
        }
    }

    public function login()
    {
        // echo 'Login in progress';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // form process in progress

            //sanitize post array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            // create data
            $data = [
                'email'     => trim($_POST['email']),
                'password'  => trim($_POST['password']),
                'emailErr'     => '',
                'passwordErr'  => '',
            ];

//            validate email
            if (empty($data['email'])) {
                $data['emailErr'] = 'Please enter your email';
            } else {
                //check if we have this email is our user table DB
                if ($this->userModel->findUserByEmail($data['email'])) {
                    //user found
                } else {
                    $data['emailErr'] = "User doesn't exist";
                }
            }

            //validate password
            if (empty($data['password'])) {
                $data['passwordErr'] = 'Please enter your password';
            }

//     ---------------------------------------------------------------------------------------------
            //check if we have errors
            if (empty($data['emailErr']) && empty($data['passwordErr'])) {
                //no errors
                //email wa found and password entered
                $loggedInUser = $this->userModel->login($data['email'], $data['password']);

                if ($loggedInUser) {
                    //CREATE SESSION
                    //password match
                    die('Email and pass match start session immediately');
                } else {
                    $data['passwordErr'] = 'Wrong password or email';
                    //load view with error
                    $this->view('users/login', $data);
                }
//                die('SUCCESS');
            } else {
                //load view with errors
                $this->view('users/login', $data);
            }
        } else {

            //if we go to users/login by url or link, or btn
            // load form
            // echo 'load form';

            // create data
            $data = [
                'email'     => '',
                'password'  => '',
                'emailErr'     => '',
                'passwordErr'  => '',
            ];

            // load view
            $this->view('users/login', $data);
        }
    }
}
