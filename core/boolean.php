<?php
function sending()
{
    return isset($_POST['number']) AND isset($_POST['message']) AND !empty($_POST['number']) AND !empty($_POST['message']);
}

function saveContact()
{
    return isset($_POST['number']) AND isset($_POST['name']) AND !empty($_POST['number']) AND !empty($_POST['name']);
}

function saveList()
{
    return isset($_POST['list']) AND isset($_POST['number1']) AND !empty($_POST['list']) AND !empty($_POST['number1']);
}

function errorSending()
{
    return isset($_POST['number']) AND isset($_POST['message']) AND (empty($_POST['number']) OR empty($_POST['message']));
}

function errorContact()
{
    return isset($_POST['number']) AND isset($_POST['name']) AND (empty($_POST['number']) OR empty($_POST['name']));
}

function errorList()
{
    return isset($_POST['list']) AND isset($_POST['number1']) AND (empty($_POST['list']) OR empty($_POST['number1']));
}