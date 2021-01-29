<?php
//general ULR helper functions

function redirect($whereTo)
{
    header("Location: " . URLROOT. $whereTo);
}