<?php
class App{
    public $default_component            = 'home';
    public $session_db                   = true;
    public $show_execution_time          = false;
    public $default_page                 = '';

    public function __construct(){
        include ROOT_PATH.'/config/app.php';

        $this->default_page = $app_config['default_page'];
    }

    public function base_url($url=''){
        $https = ($_SERVER['HTTPS'] == 'on') ? 'https' : 'http';
        $https = $https.'://'.$_SERVER['SERVER_NAME'].$url;
        return $https;
    }
}
?>