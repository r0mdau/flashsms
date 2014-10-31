<?php
function directory()
{
    global $db;
    $res = $db->table('directory')->find();
    $var = '[';
    foreach ($res as $obj) {
        if (!empty($obj)) {
            $var .= '"' . $obj->name . '",';
        }
    }
    $var = substr($var, 0, -1);
    $var .= ']';
    return $var;
}

function lists()
{
    global $db;
    $res = $db->table('lists')->find();
    $var = '[';
    foreach ($res as $obj) {
        if (!empty($obj)) {
            $var .= '"' . $obj->list . '",';
        }
    }
    $var = substr($var, 0, -1);
    $var .= ']';
    return $var;
}

function receiver()
{
    global $db;
    $data = $db->table('directory')->find();
    $var = '[';
    foreach ($data as $name) {
        if (isset($name->name)) {
            $var .= '"' . $name->name . '",';
        }
    }
    $data = $db->table('lists')->find();
    foreach ($data as $list) {
        if (isset($list->list)) {
            $var .= '"' . $list->list . '",';
        }
    }
    $var = substr($var, 0, -1);
    $var .= ']';
    return $var;
}