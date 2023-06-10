<?php

require_once("../Config/db.php");
require_once("LoginEmpleado.php");

class RegistroEmpleado{
    private $Empleados_ID;
    private $Nombre;
    private $Email;
    private $Usuario;
    private $password;
    private $Direccion;
    private $Telefono;
    protected $dbCnx;

    public function __construct($Empleados_ID = 0, $Nombre="", $Email="", $Usuario="", $password="",$Direccion="",$Telefono=""){
        $this->Empleados_ID = $Empleados_ID;
        $this->Nombre = $Nombre;
        $this->Email = $Email;
        $this->Usuario = $Usuario;
        $this->password = $password;
        $this->Direccion = $Direccion;
        $this->Telefono = $Telefono;
        $this->dbCnx = new PDO(DB_TYPE . ":host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PWD, [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
    }

    // Empleados ID

    public function setEmpleados_ID($Empleados_ID){
        $this->Empleados_ID = $Empleados_ID;
    }
    public function getEmpleados_ID(){
        return $this->Empleados_ID;
    }

    // Nombre

    public function setNombre($Nombre){
        $this->Nombre = $Nombre;
    }
    public function getNombre(){
        return $this->Nombre;
    }

    // Email

    public function setEmail($Email){
        $this->Email = $Email;
    }
    public function getEmail(){
        return $this->Email;
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

    // Direccion

    public function setDireccion($Direccion){
        $this->Direccion = $Direccion;
    }
    public function getDireccion(){
        return $this->Direccion;
    }

    // Telefono

    public function setTelefono($Telefono){
        $this->Telefono = $Telefono;
    }
    public function getTelefono(){
        return $this->Telefono;
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
            $stm = $this->dbCnx->prepare("INSERT INTO empleados(Nombre, Email, Usuario, password, Direccion, Telefono) values (?,?,?,?,?,?)");
            $stm->execute([$this->Nombre,$this->Email,$this->Usuario,md5($this->password),$this->Direccion,$this->Telefono]);

            $login = new LoginEmpleado();
            $login->setEmail($_POST['email']);
            $login->setPassword($_POST['password']);


            $success = $login->login();

        } catch (Exception $e) {
            $e -> getMessage();
        }
    }
}

?>