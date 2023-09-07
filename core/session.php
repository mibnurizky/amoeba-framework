<?php

class Session{

    private $prefix = '_amoeba_';
    private $table = '_amoeba_session';
    private $usedb = false;
    private $sessid = '';

    public function __construct($usedb=false){
        $app = new App();
        $this->usedb = $app->session_db;
        if(!empty($_COOKIE[$this->prefix.'cookie'])){
            $this->sessid = $_COOKIE[$this->prefix.'cookie'];
        }
        else{
            $sessid = $this->prefix.time().'_'.random_characters(10);
            $this->sessid = $sessid;
            setcookie($this->prefix.'cookie',$this->sessid);
        }
    }

    public function set($id,$data){
        $id = $this->prefix.$id;
        if($this->usedb){
            $db = new Database();
            $this->session_db_check_table();
            $session = $db->select("SELECT * FROM ".$this->table." WHERE ID = '".$this->sessid."'");
            $sessiondata = array();
            if(count($session) > 0){
                $sessiondata = unserialize($session[0]['SESSION_DATA']);
                $sessiondata = array_merge($sessiondata,[$id => $data]);
                $db->update($this->table,['SESSION_DATA' => serialize($sessiondata)],"WHERE ID = '".$this->sessid."'");
            }
            else{
                $db->insert($this->table,array(
                    'ID' => $this->sessid,
                    'SESSION_DATA' => serialize([$id => $data]),
                    'CREATED_TIME' => time()
                ));
            }
        }
        else{
            $_SESSION[$id] = $data;
        }
        return true;
    }

    public function get($id){
        $id = $this->prefix.$id;
        if($this->usedb){
            $db = new Database();
            $this->session_db_check_table();
            $session = $db->select("SELECT * FROM ".$this->table." WHERE ID = '".$this->sessid."'");
            if(count($session) > 0){
                $sessiondata = unserialize($session[0]['SESSION_DATA']);
                return isset($sessiondata[$id]) ? $sessiondata[$id] : "";
            }
        }
        else{
            return isset($_SESSION[$id]) ? $_SESSION[$id] : "";
        }
    }

    public function del($id){
        $id = $this->prefix.$id;
        if($this->usedb){
            $db = new Database();
            $this->session_db_check_table();
            $session = $db->select("SELECT * FROM ".$this->table." WHERE ID = '".$this->sessid."'");
            if(count($session) > 0){
                $sessiondata = unserialize($session[0]['SESSION_DATA']);
                unset($sessiondata[$id]);
                $db->update($this->table,['SESSION_DATA' => serialize($sessiondata)],"WHERE ID = '".$this->sessid."'");
            }
        }
        else{
            unset($_SESSION[$id]);
        }
    }

    public function session_db_check_table(){
        $db = new Database();
        $cache = new Cache();

        $table_exists = $cache->get('__amoeba_session_table__');
        if($table_exists){
            return true;
        }
        $data = $db->select("
            SELECT table_name FROM information_schema.tables
            WHERE table_schema = '".$db->dbname."' AND table_name = '".$this->table."'
        ");
        if(count($data) == 0){
            $db->query("
                CREATE TABLE `".$this->table."` (
                    ID varchar(100) primary key NOT NULL,
                    IP_ADDRESS varchar(100) NULL,
                    SESSION_DATA BLOB NULL,
                    CREATED_TIME double NULL,
                    EXPIRED_DATE double NULL,
                    IS_EXPIRED varchar(1) NULL
                )
                ENGINE=InnoDB
                DEFAULT CHARSET=utf8
                COLLATE=utf8_unicode_ci
            ");
            $db->query("CREATE INDEX `_amoeba_session_IP_ADDRESS_IDX` USING BTREE ON framework.`_amoeba_session` (IP_ADDRESS)");
            $db->query("CREATE INDEX `_amoeba_session_IS_EXPIRED_IDX` USING BTREE ON framework.`_amoeba_session` (IS_EXPIRED)");
            $cache->save('__amoeba_session_table__',true,604800);
        }
        else{
            $cache->save('__amoeba_session_table__',true,604800);
        }
    }
}

?>