<?php 
    class Session{

        public static function init(){
            Session_start();
        }
        public static function set($key, $val){
            $_SESSION[$key] = $val;
        }
        public static function get($key){
            if (isset($_SESSION[$key])) {
                return $_SESSION[$key];
            }else{
                return false;
            }
        }
        public static function checksession(){
            self::init();
            if (self::get("login") == false) {
                self::destroy();
                header("Location:login.php");
            }
        }

        public static function checklogin(){
            self::init();
            if (self::get("login") == true) {
                header("Location:login.php");
            }
        }
        public static function destroy(){
            session_destroy();
            header("Location:login.php");
        }



    }


?>