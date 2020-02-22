<?php

class Format{
    public function formatDate($date){
        return date("jS F, Y", strtotime("$date"));
    }

    public function textshorten($text, $limit=400){
        $text = $text. " ";
        $text = substr($text, 0, $limit );
        $text = $text.".....";
        return $text;
    }

    public function validation($data){
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    public function title(){
        $path = $_SERVER['SCRIPT_FILENAME'];
        $title = basename($path , '.php');
        if ($title == 'index') {
            $title ='home';
        }elseif ($title == 'contact') {
            $title ='contact';
        }
        return $title = ucwords($title);
    }

}

