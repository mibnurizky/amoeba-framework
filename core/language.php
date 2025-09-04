<?php

class Language{
    public $lang = [];

    public function __construct($langpath='',$langcode=''){
        global $APP;

        if($langpath != ''){
            if(empty($langcode)){
                $langcode = $APP->config['default_language'];
            }

            $langpath = str_replace('.','/',$langpath);
            $this->lang = ROOT_PATH.'/lang/'.$langcode.'/'.$langpath.'.php';if(file_exists(ROOT_PATH.'/lang/'.$langcode.'/'.$langpath.'.php')){
                include ROOT_PATH.'/lang/'.$langcode.'/'.$langpath.'.php';
            }
            $this->lang = $lang;
        }
    }

    public function set($langpath,$langcode=''){
        global $APP;
        if($langpath != ''){
            if(empty($langcode)){
                $langcode = $APP->config['default_language'];
            }

            $langpath = str_replace('.','/',$langpath);
            if(file_exists(ROOT_PATH.'/lang/'.$langcode.'/'.$langpath.'.php')){
                include ROOT_PATH.'/lang/'.$langcode.'/'.$langpath.'.php';
            }
            $this->lang = $lang;
        }
    }

    public function get($key=''){
        if($key == ''){
            return $this->lang;
        }
        else{
            $lang = isset($this->lang[$key]) ? $this->lang[$key] : '';
            return $lang;
        }
    }
}

?>