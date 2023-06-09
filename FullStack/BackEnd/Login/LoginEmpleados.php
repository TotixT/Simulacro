<?php

require_once("../Config/db.php");

class LoginEmpleados{
    private $Usuario;
    private $password;
    private $Email;
    protected $dbCnx;

    public function __construct($Usuario= "", $password="", $Email=""){
        $this->Usuario = $Usuario;
        $this->password = $password;
        $this->Email = $Email;
        $this->dbCnx = new PDO(DB_TYPE . ":host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PWD, [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
    }

    // Users ID

    public function setUsuario($Usuario){
        $this->Usuario = $Usuario;
    }
    public function getUsuario(){
        return $this->Usuario;
    }

    // Password

    public function setPassword($password){
        $this->password = $password;
    }
    public function getPassword(){
        return $this->password;
    }

    // Email

    public function setEmail($Email){
        $this->Email = $Email;
    }
    public function getEmail(){
        return $this->Email;
    }

    public function fetchAll(){
        try {
            $stm = $this->dbCnx->prepare("SELECT * FROM empleados");
            $stm->execute();
            return $stm -> fetchAll();
        } catch (Exception $e) {
            return $e -> getMessage();
        }        
    }

    public function login(){
        try {
            $stm = $this->dbCnx->prepare("SELECT * FROM empleados WHERE Email = ? AND password = ?");
            $stm->execute([$this->Email,md5($this->password)]);
            $user = $stm->fetchAll();
            if(count($user)>0){
                session_start();
                $_SESSION['Usuario'] = $user[0]['Usuario'];
                $_SESSION['password'] = $user[0]['password'];
                $_SESSION['Email'] = $user[0]['Email'];
                return true;
            } else {
                false;
            }
        } catch (Exception $e) {
            $e -> getMessage();
        }
    }
}

?>