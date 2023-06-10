<?php
    require_once("../Config/db.php");
    class Empleado{
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

        // Insert Data - Insert

        public function insertData(){
            try {
                $stm = $this->dbCnx->prepare("INSERT INTO empleados(Nombre, Email, Usuario, password, Direccion, Telefono) values (?,?,?,?,?,?)");
                $stm->execute([$this->Nombre,$this->Email,$this->Usuario,md5($this->password),$this->Direccion,$this->Telefono]);
            } catch (Exception $e) {
                $e -> getMessage();
            }
        }

        // Select All - Read

        public function selectAll(){
            try {
                 $stm = $this->dbCnx->prepare("SELECT * FROM empleados");
                 $stm->execute();
                 return $stm->fetchAll();
            } catch (Exception $e) {
                $e -> getMessage();
            }
        }

        // Delete Data - Delete

        public function deleteData(){
            try {
                $stm = $this->dbCnx->prepare("DELETE FROM empleados WHERE Empleados_ID=?");
                $stm->execute([$this->Empleados_ID]);
                return $stm->fetchAll();
                echo "<script> alert('Borrado Exitosamente'); document.location='empleados.php'</script>";
            } catch (Exception $e) {
                $e -> getMessage();
            }
        }

        // Select One - Seleccion de un dato especifico por ID

        public function selectOne(){
            try {
                $stm = $this->dbCnx->prepare("SELECT * FROM empleados WHERE Empleados_ID=?");
                $stm->execute([$this->Empleados_ID]);
                return $stm->fetchAll();
            } catch (Exception $e) {
                $e -> getMessage();
            }
        }

        // Update Data - Update

        public function update(){
            try {
                $stm = $this->dbCnx->prepare("UPDATE empleados SET Nombre=?,Direccion=?,Telefono=? WHERE Empleados_ID=?");
                $stm->execute([$this->Nombre,$this->Direccion,$this->Telefono,$this->Empleados_ID]);
                return $stm->fetchAll();
            } catch (Exception $e) {
                $e -> getMessage();
            }
        }
    }
?>