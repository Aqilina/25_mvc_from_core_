<?php
//session helper for displaying useful feedback to the user

//flash msg helper

//example save msg flash('register_success', 'Your registrations is successful');
//for display flash register('register_success'); - nuskaitymui

function flash($name = '', $message = '', $class = 'alert alert-success') {
    if (!empty($name)) {
        //this is the part where we set the message
        if (!empty($message) && empty($_SESSION[$name])) {

            //if there is some left in session we unset it
            if (!empty($_SESSION[$name . '_class'])) {
                unset($_SESSION[$name . '_class']);
            }

            $_SESSION[$name] = $message;
            $_SESSION[$name . '_class'] = $class;

            //this is where we display msg to the wiew
        } elseif (empty($message) && !empty($_SESSION[$name])) {
            echo "<div class='$class' id='msg-flash'>{$_SESSION[$name]}</div>";
            //unset values that have been shown
            unset($_SESSION[$name]);
            unset($_SESSION[$name . '_class']);
        }
    }
}