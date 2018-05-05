<?php

include_once 'config/phpConfig.php';
class DB {
    private $_connect;
    public function __construct()
    {
        $config = getConnectionSetting();
        $this->_connect = new mysqli($config['server'], $config['login'],$config['password'],$config['db']);
        if (mysqli_connect_errno()) {
            throw  new Exception("Connect failed: ". mysqli_connect_error());
        }
    }
    public function isUserRegistered($username,$password){
        $isUserExistSQL = "SELECT * FROM `users` WHERE name = '".$username  ."' and pass = '".$password."'";
        $result = $this->_connect->query($isUserExistSQL);

        if($result->num_rows>0){
            return true;
        }
        return false;

    }
    public function registerUser ($username,$password){

            $strSQL = "INSERT INTO `users`  (`name`, `pass`) VALUES  ('".$username."','".$password."')";

           $this->_connect->query($strSQL);

    }
    public function sendMessage($text, $user){
        $strSQL = "INSERT INTO `chatlist` (`name`, `text`, `date`) VALUES ('".$user."','".$text."','".date('Y-m-d H:i:s')."');";
        $this->_connect->query($strSQL);


    }
    public function getChatList(){
        $strSQL = "SELECT * FROM `chatlist` ";
        if ($result = $this->_connect->query($strSQL)) {

            $show = array();

            /* извлечение ассоциативного массива */
            while ($row = $result->fetch_assoc()) {

                $show[]=$row;
            }

            /* удаление выборки */
            $result->free();
            return $show;
        } else {
            return [];
        }





    }

}




