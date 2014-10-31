<?php
include(__DIR__ . '/autoload.php');

exec("gammu --getallsms", $result, $status);
if ($status != 0) {
    exit;
}

exec("gammu --deleteallsms 1");

$db = new r0mdauDb(__DIR__ . '/datas');

$i = 0;
$messages = array();
foreach ($result as $line) {
    if ($line == "SMS message") {
        $y = 0;
        if (strpos($result[$i + 3], "Class") !== false) {
            $y = 1;
        }

        $messages[] = array(
            "name" => getNameOfNumber(getNumberOf($result[$i + 4 + $y])),
            "number" => getNumberOf($result[$i + 4 + $y]),
            "message" => $result[$i + 7 + $y],
            "date" => getDateOf($result[$i + 2])
        );
    }
    $i++;
}

foreach ($messages as $message) {
    if (isset($message['number']) AND !empty($message['number'])) {
        $db->table('messages')->insert($message);
    }
}

function reverseArray($tab)
{
    $messages = array();
    for ($i = count($tab) - 1; $i >= 0; $i--) {
        $messages[] = $tab[$i];
    }
    return $messages;
}

function getNameOfNumber($number)
{
    global $db;
    $result = $db->table('directory')->find1(array("number" => $number));
    return isset($result->name) ? $result->name : $number;
}

function getNumberOf($str)
{
    preg_match('/.+"(.+)".*/', $str, $matches);
    return isset($matches[1]) ? $matches[1] : $str;
}

function getDateOf($str)
{
    preg_match('/.+:\ (.+)\ \ \+.+/', $str, $matches);
    return isset($matches[1]) ? $matches[1] : $str;
}