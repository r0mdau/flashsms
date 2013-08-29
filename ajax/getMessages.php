<?php
require_once('../autoload.php');
$db = new r0mdauDb('../datas');
echo getMessagesHere();

function getMessagesHere(){
    global $db;    
    $datas = $db->table('messages')->find();
    $html = ''; $x = count($datas);
    for($x = $x - 1; $x >= 0; $x--){
	$message = $datas[$x];
        if(isset($message->name)){
	    $html.= '<blockquote>';
	    $html .= '<p>'.$message->name.' : '.$message->message.'<i class="pull-right icon-remove" style="cursor:pointer" onclick="deletesms(\''.$message->_rid.'\')"></i></p>';
	    $html .= '<small>'.$message->date.'</small>';
            $html .= '</blockquote><hr>';
        }
    }
    return $html;
}
