<?php
class App{
    public $default_component            = 'home';
    public $session_db                   = true;

    public function base_url($url=''){
        $https = ($_SERVER['HTTPS'] == 'on') ? 'https' : 'http';
        $https = $https.'://'.$_SERVER['SERVER_NAME'].$url;
        return $https;
    }
}
?>