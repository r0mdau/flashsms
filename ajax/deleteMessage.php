<?php
    if(!isset($_GET['number']) || empty($_GET['number'])) exit;
    require_once('../autoload.php');
    $delete = new r0mdauDb(_DIR_Database_);
    if($delete->table('messages')->delete(array("_rid" => $_GET['number'])))
        echo echo_alert('alert-success', 'SMS supprimé !');
    else echo_alert('alert-error', '<strong>Erreur</strong>, le sms n\'a pas pu être supprimé !');
