<?php
function echo_alert($alert, $message){
    echo    '<div class="alert '.$alert.'">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                '.$message.'
            </div>';
}

function info_sending(&$err){
    if(isset($err->out)){
        if($err->out == 0){
            echo_alert('alert-success', 'SMS envoyé !');
        }else{	    
            echo_alert('alert-error', '<strong>Erreur</strong>, sms non envoyé !');
			if(!empty($err->numberInError))
				foreach($err->numberInError as $user)
					echo_alert('alert-info', $user.' n\'a pas reçu le sms');
		}
    }if(isset($err->info['number'])){
        echo_alert('alert-warning', $err->info['number']);
    }if(isset($err->info['message'])){
        echo_alert('alert-warning', $err->info['message']);    
    }
}
    
function info_directory(&$err){
    if(isset($err->in)){
        if($err->in)
            echo_alert('alert-success', 'La personne est bien enregistrée');
        else
            echo_alert('alert-error', '<strong>Erreur</strong> lors de l\'enregistrement !');
    }
	if(isset($err->warn['name']))
        echo_alert('alert-warning', $err->warn['name']);
    if(isset($err->warn['number']))
        echo_alert('alert-warning', $err->warn['number']);
}

function info_list(&$err){
    if(isset($err->listin)){
        if($err->listin)
            echo_alert('alert-success', 'La list est bien créée');
        else
            echo_alert('alert-error', '<strong>Erreur</strong> list non créée !');
    }
	if(isset($err->listoff['list']))
        echo_alert('alert-warning', $err->listoff['list']);
    if(isset($err->listoff['number']))
        echo_alert('alert-warning', $err->listoff['number']);
    
}