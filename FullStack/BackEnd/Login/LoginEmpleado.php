<?php

require_once("../Config/db.php");

class LoginEmpleado{
    private $Empleados_ID;
    private $Email;
    private $password;
    private $Usuario;
    protected $dbCnx;

    public function __construct($Empleados_ID= 0, $Email="", $password="", $Usuario=""){
        $this->Empleados_ID = $Empleados_ID;
        $this->Email = $Email;
        $this->password = $password;
        $this->Usuario = $Usuario;
        $this->dbCnx = new PDO(DB_TYPE . ":host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PWD, [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
    }

    // Users ID

    public function setEmpleados_ID($Empleados_ID){
        $this->Empleados_ID = $Empleados_ID;
    }
    public function getEmpleados_ID(){
        return $this->Empleados_ID;
    }

    // Email

    public function setEmail($Email){
        $this->Email = $Email;
    }
    public function getEmail(){
        return $this->Email;
    }

    // Password

    public function setPassword($password){
        $this->password = $password;
    }
    public function getPassword(){
        return $this->password;
    }

    // Usuario

    public function setUsuario($Usuario){
        $this->Usuario = $Usuario;
    }
    public function getUsuario(){
        return $this->Usuario;
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
                $_SESSION['Empleados_ID'] = $user[0]['Empleados_ID'];
                $_SESSION['Email'] = $user[0]['Email'];
                $_SESSION['password'] = $user[0]['password'];
                $_SESSION['Usuario'] = $user[0]['Usuario'];
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