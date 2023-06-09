<?php

require_once("../Config/db.php");
require_once("LoginEmpleados.php");

class Empleado{
    private $idEmpleados;
    private $Usuario;
    private $password;
    private $Email;
    protected $dbCnx;

    public function __construct($idEmpleados= 0, $Usuario="", $password="", $Email=""){
        $this->idEmpleados = $idEmpleados;
        $this->Usuario = $Usuario;
        $this->password = $password;
        $this->Email = $Email;
        $this->dbCnx = new PDO(DB_TYPE . ":host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PWD, [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
    }

    // Empleados ID

    public function setidEmpleados($idEmpleados){
        $this->idEmpleados = $idEmpleados;
    }
    public function getidEmpleados(){
        return $this->idEmpleados;
    }

    // Usuario

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

    public function checkUser($Email){
        try {
            $stm = $this->dbCnx->prepare("SELECT * FROM empleados WHERE Email = '$Email'");
            $stm->execute();
            if($stm->fetchColumn()){
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            $e -> getMessage();
        }
    }

    public function insertData(){
        try {
            $stm = $this->dbCnx->prepare("INSERT INTO empleados (Usuario,password,Email) values (?,?,?)");
            $stm->execute([$this->Usuario,md5($this->password),$this->Email]);

            $login = new LoginEmpleados();
            $login->setEmail($_POST['email']);
            $login->setPassword($_POST['password']);


            $success = $login->login();

        } catch (Exception $e) {
            $e -> getMessage();
        }
    }
}

?>