<?php

//this is a class to validate diff inputs and data
class Validation
{
    private $password;
    private $errors;
    //check if server request is post
    //@ return boolean
    public function ifRequestIsPost()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') return true;
        return false;
    }

    public function sanitizePost()
    {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    }

    public function ifRequestIsPostAndSanitize()
    {
        if ($this->ifRequestIsPost()) {
            $this->sanitizePost();
            return true;
            //GALIMA PRIRASYTI EXTRA CHECK
        }
        return false;
    }

    public function ifEmptyArr($arr)
    {
        foreach ($arr as $errorValue) {
            if (!empty($errorValue)) return false;
        }
        return true;
    }

    public function validateEmpty($field, $msg)
    {
        return empty($field) ? $msg : '';
    }

//-------------------------------------------------------------------------------------------------------------
//    PAVALIDUOTI TUSCIA LAUKA - RETURN MESSAGE, else - return empty string
    public function ifEmptyFieldWithReference(&$data, $field, $fieldDisplayName)
    {
        $fieldError = $field . 'Err';
        if (empty($data[$field])) {
            // empty field
            $data['errors'][$fieldError] = "$fieldDisplayName";
        }
    }

//    ARBA
    public function validateName($field)
    {

        if (empty($field)) return "Please enter your name";
        if (!preg_match("/^[a-z ,.'-]+$/i", $field)) return "Name must contain only characters";

        return '';
    }

//-------------------------------------------------------------------------------------------------
    public function validateEmail($field, &$userModel)
    {
        //validate empty
        if (empty($field)) return "Please enter your Email";

        //check email format
        if (filter_var($field, FILTER_VALIDATE_EMAIL) === false) return "Please check your email";

        //if email already exists
        if ($userModel->findUserByEmail($field)) return 'Email already taken';

        //if found nothing
        return '';
    }

    public function validateLoginEmail($field, &$userModel)
    {
        //validate empty
        if (empty($field)) return "Please enter your Email";

        //check email format
        if (filter_var($field, FILTER_VALIDATE_EMAIL) === false) return "Please check your email";

        //if email already exists
        if (!$userModel->findUserByEmail($field)) return 'Email not found';

    }
//    -----------------------------------------------------------------------------------------------------------------

    public function validatePassword($passField, $min, $max)
    {
        //validate empty
        if (empty($passField)) return "Please enter a password";

        //save password for later
        $this->password = $passField;

        //if pass length is less then min
        if (strlen($passField) < $min) return "Password must be more than $min characters length";
        //if pass is longer than 10
        if (strlen($passField) > $max) return "Password must be less than $max characters length";

        //check password strength
//        if (!preg_match("#[0-9]+#", $passField)) return "Password must include at least one number!";
//        if (!preg_match("#[a-z]+#", $passField)) return "Password must include at least one letter!";
//        if (!preg_match("#[A-Z]+#", $passField)) return "Password must include at least one CAPS!";
//        if (!preg_match("#\W+#", $passField)) return "Password must include at least one symbol!";

//        jei nieko is auksciau nereturnino
        return '';
    }

    public function confirmPassword($repeatField)
    {
     if (empty($repeatField)) return "Please return password";

     if ($this->password) return 'Couldn\'t find password';

     if ($repeatField !== $this->password) return "Passwords must match";

     return '';
    }
}