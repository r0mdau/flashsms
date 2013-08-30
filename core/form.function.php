<?php
//TODO refactoring
function form(&$err){
    if(isset($_POST)) global $_POST; else return;        
    global $db;
    if(sending()){
	$_SESSION = array();
        if($list = getlist($_POST['number'])){
            foreach($list->numbers as $no){
                exec('echo "'.$_POST['message'].'" | gammu --sendsms TEXT '.$no.(isset($_POST['flash']) ? ' -flash' : ''), $output, $err->out);
		if($err->out != 0)
		    $err->numberInError[] = getNameOf($no);
                sleep(5);
            }
        }else{
            $data = $db->table('directory')->find();
            foreach($data as $user){
                if(isset($user->name) AND $user->name == $_POST['number'])
                    $_POST['number'] = $user->number;
            }
            $_POST['number'] = str_replace(' ', '', $_POST['number']);
            exec('echo "'.$_POST['message'].'" | gammu --sendsms TEXT '.$_POST['number'].(isset($_POST['flash']) ? ' -flash' : ''), $output, $err->out);
	    if($err->out != 0)
		setSessionValues();
        }        
    }else if(saveContact()){
        $_POST['number'] = str_replace(' ', '', $_POST['number']);
        $err->in = $db->table('directory')->insert($_POST);
    }else if(saveList()){
        $tab = array("list"=>$_POST['list']);
        $i = 1;
        while(isset($_POST['number'.$i])){
            if(!empty($_POST['number'.$i])){
                if($number = getNameOf($_POST['number'.$i]))
                    $tab['numbers'][] = $number;                    
                else
                    $tab['numbers'][] = $_POST['number'.$i];
            }
            $i++;
        }
        $err->listin = $db->table('lists')->insert($tab);
    }else if(errorSending()){
        if(empty($_POST['number']))
            $err->info['number'] = 'Numéro vide ! ';
        if(empty($_POST['message']))
            $err->info['message'] = 'Message vide !';
	setSessionValues();
    }else if(errorContact()){
        if(empty($_POST['number']))
            $err->warn['number'] = 'Numéro vide ! ';
        if(empty($_POST['name']))
            $err->warn['name'] = 'Nom de la personne vide !';
    }else if(errorList()){
        if(empty($_POST['list']))
            $err->listoff['list'] = 'Nom de la list vide ! ';
        if(empty($_POST['number1']))
            $err->listoff['number'] = 'Vous devez renseigner 1 numéro minimum !';
    }
}

function formSetSessionValues(){
    $_SESSION['user'] = getNameOf($_POST['number']);
    $_SESSION['message'] = $_POST['message'];
    if(isset($_POST['flash'])) $_SESSION['flash'] = true;
}