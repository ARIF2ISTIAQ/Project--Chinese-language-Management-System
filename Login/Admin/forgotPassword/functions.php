<?php
function generateNewString()
{
    $token = "sgureuoiernirhg842379572fjwer";
    $token = str_shuffle($token);
    $token = substr($token, 0, 10);
    return $token;
}