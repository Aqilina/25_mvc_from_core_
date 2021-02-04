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

    public function sanitizePost() {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    }

    public function ifRequestIsPostAndSanitize() {
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

//    PAVALIDUOTI TUSCIA LAUKA - RETURN MESSAGE, else - return empty string
    public function ifEmptyFieldWithReference(&$data, $field, $fieldDisplayName) {
        $fieldError = $field . 'Err';
        if (empty($data[$field])) {
            // empty field
            $data['errors'][$fieldError] = "$fieldDisplayName";
        }
    }
//    ARBA
    public function ifEmptyField($field, $fieldDisplayName, $msg = null) {
        if (empty($field)) {
            // empty field
            if ($msg) {
                return $msg;
            }
            return "Please enter Your $fieldDisplayName";
        }
        return '';
    }

}