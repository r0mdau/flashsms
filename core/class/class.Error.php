<?php

class Error
{

    public function __construct()
    {
        $this->info = array();
        $this->warn = array();
        $this->listoff = array();
        $this->numberInError = array();

        $this->in = null;
        $this->out = null;
        $this->listin = null;
    }

    public function errorMessages()
    {
        if (errorSending()) {
            if (empty($_POST['number'])) {
                $this->info['number'] = 'Numéro vide ! ';
            }
            if (empty($_POST['message'])) {
                $this->info['message'] = 'Message vide !';
            }
            formSetSessionValues();
        } else if (errorContact()) {
            if (empty($_POST['number'])) {
                $this->warn['number'] = 'Numéro vide ! ';
            }
            if (empty($_POST['name'])) {
                $this->warn['name'] = 'Nom de la personne vide !';
            }
        } else if (errorList()) {
            if (empty($_POST['list'])) {
                $this->listoff['list'] = 'Nom de la list vide ! ';
            }
            if (empty($_POST['number1'])) {
                $this->listoff['number'] = 'Vous devez renseigner 1 numéro minimum !';
            }
        }
    }

    public $info;
    public $warn;
    public $listoff;
    public $in;
    public $out;
    public $listin;
    public $numberInError;
}