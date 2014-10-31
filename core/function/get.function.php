<?php
function getMessages($attr = NULL)
{
    global $db;
    $html = '';
    $datas = $db->table('messages')->find($attr);
    $x = count($datas);
    for ($x = $x - 1; $x >= 0; $x--) {
        $message = $datas[$x];
        if (isset($message->name)) {
            $html .= '<blockquote>';
            $html .= '<p>' . $message->name . ' : ' . $message->message;
            $html .= '<i class="pull-right icon-remove" style="cursor:pointer" onclick="deleteMessage(\'' . $message->_rid . '\')"></i>';
            $html .= '</p>';
            $html .= '<small>' . $message->date . '</small>';
            $html .= '</blockquote><hr>';
        }
    }
    return $html;
}


function getNameOf($number)
{
    global $db;
    $data = $db->table('directory')->find();
    foreach ($data as $obj) {
        if (isset($obj->number) AND $obj->number == $number) {
            return $obj->name;
        }
    }
    return $number;
}

function getNumberOfName($name)
{
    global $db;
    $data = $db->table('directory')->find();
    foreach ($data as $obj) {
        if (isset($obj->name) AND $obj->name == $name) {
            return $obj->number;
        }
    }
    return null;
}


function getlist($var)
{
    global $db;
    $data = $db->table('lists')->find();
    foreach ($data as $list) {
        if (isset($list->list) AND $var == $list->list) {
            return $list;
        }
    }
    return null;
}