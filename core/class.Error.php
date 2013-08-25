<?php
    class Error{
        
        public function __construct(){
            $this->info = array();
            $this->warn = array();
            $this->listoff = array();
            $this->numberInError = array();
            
            $this->in = null;
            $this->out = null;
            $this->listin = null;
        }
        
        public $info;
        public $warn;
        public $listoff;
        public $in;
        public $out;
        public $listin;
        public $numberInError;
    }