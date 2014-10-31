<?php
function form(&$err)
{
    if (isset($_POST)) {
        global $_POST;
    } else {
        return;
    }

    global $db;
    if (sending()) {
        $_SESSION = array();
        if (isset($_POST['flash'])) {
            $flash = ' -flash';
        } else {
            $flash = '';
        }

        if ($list = getlist($_POST['number'])) {
            foreach ($list->numbers as $no) {
                $err->out = Gammu::infiniteSend($_POST['message'], $no, $flash);
                if ($err->out != 0) {
                    $err->numberInError[] = getNameOf($no);
                }
            }
        } else {
            $users = $db->table('directory')->find();
            foreach ($users as $user) {
                if (isset($user->name) AND $user->name == $_POST['number']) {
                    $_POST['number'] = $user->number;
                }
            }

            $_POST['number'] = str_replace(' ', '', $_POST['number']);
            $err->out = Gammu::send($_POST['message'], $_POST['number'], $flash);
            if ($err->out != 0) {
                formSetSessionValues();
            }
        }
    } else if (saveContact()) {
        $_POST['number'] = str_replace(' ', '', $_POST['number']);
        $err->in = $db->table('directory')->insert($_POST);
    } else if (saveList()) {
        $list = array("list" => $_POST['list']);
        $i = 1;
        while (isset($_POST['number' . $i])) {
            if (!empty($_POST['number' . $i])) {
                if ($number = getNumberOfName($_POST['number' . $i])) {
                    $list['numbers'][] = $number;
                } else {
                    $list['numbers'][] = $_POST['number' . $i];
                }
            }
            $i++;
        }
        $err->listin = $db->table('lists')->insert($list);
    } else {
        $err->errorMessages();
    }
}

function formSetSessionValues()
{
    $_SESSION['user'] = getNameOf($_POST['number']);
    $_SESSION['message'] = $_POST['message'];
    if (isset($_POST['flash'])) $_SESSION['flash'] = true;
}
