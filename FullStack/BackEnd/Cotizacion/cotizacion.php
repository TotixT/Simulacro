<?php
    require_once("../Config/db.php");
    class Cotizacion{
        private $Cotizacion_ID;
        private $Empleados_ID;
        private $Clientes_ID;
        private $Fecha;
        protected $dbCnx;

        public function __construct($Cotizacion_ID=0,$Empleados_ID=0,$Clientes_ID=0,$Fecha=""){
            $this->Cotizacion_ID = $Cotizacion_ID;
            $this->Empleados_ID = $Empleados_ID;
            $this->Clientes_ID = $Clientes_ID;
            $this->Fecha = $Fecha;
            $this->dbCnx = new PDO(DB_TYPE . ":host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PWD, [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
        }

        // Cotizacion ID
        
        public function setCotizacion_ID($Cotizacion_ID){
            $this->Cotizacion_ID = $Cotizacion_ID;
        }
        public function getCotizacion_ID(){
            $this->Cotizacion_ID;
        }

        // Empleados ID

        public function setEmpleados_ID($Empleados_ID){
            $this->Empleados_ID = $Empleados_ID;
        }
        public function getEmpleados_ID(){
            $this->Empleados_ID;
        }

        // Clientes ID

        public function setClientes_ID($Clientes_ID){
            $this->Clientes_ID = $Clientes_ID;
        }
        public function getClientes_ID(){
            $this->Clientes_ID;
        }

        // Fecha

        public function setFecha($Fecha){
            $this->Fecha = $Fecha;
        }
        public function getFecha(){
            $this->Fecha;
        }

        // Insert Data - Insert

        public function insertData(){
            try {
                $stm = $this->dbCnx->prepare("INSERT INTO cotizacion (Cotizacion_ID,Empleados_ID,Clientes_ID,Fecha) VALUES (?,?,?,?)");
                $stm->execute([$this->Cotizacion_ID,$this->Empleados_ID,$this->Clientes_ID,$this->Fecha]);
            } catch (Exception $e) {
                $e -> getMessage();
            }
        }

        // Select All - Read

        public function selectAll(){
                try {
                 $stm = $this->dbCnx->prepare("SELECT Cotizacion_ID, empleados.Nombre, clientes.Nombre_Cliente, Fecha
                 FROM cotizacion
                 INNER JOIN empleados ON cotizacion.Empleados_ID = empleados.Empleados_ID
                 INNER JOIN clientes ON cotizacion.Clientes_ID = clientes.Clientes_ID;");
                 $stm->execute();
                 return $stm->fetchAll();
            } catch (Exception $e) {
                $e -> getMessage();
            }
        }

        public function selectEmpleados(){
            try {
                $stm = $this->dbCnx->prepare("SELECT Empleados_ID,Nombre FROM empleados;");
                $stm->execute();
                return $stm->fetchAll();
            } catch (Exception $e) {
                $e -> getMessage();
            }
        }

        public function selectClientes(){
            try {
                $stm = $this->dbCnx->prepare("SELECT Clientes_ID, Nombre_Cliente FROM clientes;");
                $stm->execute();
                return $stm->fetchAll();
            } catch (Exception $e) {
                $e -> getMessage();
            }
        }

        // Delete Data - Delete

        public function deleteData(){
            try {
                $stm = $this->dbCnx->prepare("DELETE FROM cotizacion WHERE Cotizacion_ID=?");
                $stm->execute([$this->Cotizacion_ID]);
                return $stm->fetchAll();
                echo "<script> alert('Borrado Exitosamente'); document.location='cotizaciones.php'</script>";
            } catch (Exception $e) {
                $e -> getMessage();
            }
        }

        // Select One - Seleccion de un dato especifico por ID

        public function selectOne(){
            try {
                $stm = $this->dbCnx->prepare("SELECT Cotizacion_ID, empleados.Nombre, clientes.Nombre_Cliente, Fecha
                FROM cotizacion
                INNER JOIN empleados ON cotizacion.Empleados_ID = empleados.Empleados_ID
                INNER JOIN clientes ON cotizacion.Clientes_ID = clientes.Clientes_ID
                WHERE Cotizacion_ID = ?;");
                $stm->execute([$this->Cotizacion_ID]);
                return $stm->fetchAll();
            } catch (Exception $e) {
                $e -> getMessage();
            }
        }

        // Update Data - Update

        public function update(){
            try {
                $stm = $this->dbCnx->prepare("UPDATE cotizacion 
                INNER JOIN empleados ON cotizacion.Empleados_ID = empleados.Empleados_ID
                INNER JOIN clientes ON cotizacion.Clientes_ID = clientes.Clientes_ID
                SET cotizacion.Empleados_ID=?, cotizacion.Clientes_ID=?, cotizacion.Fecha=?
                WHERE Cotizacion_ID=?;");
                $stm->execute([$this->Empleados_ID,$this->Clientes_ID,$this->Fecha,$this->Cotizacion_ID]);
                return $stm->fetchAll();
            } catch (Exception $e) {
                $e -> getMessage();
            }
        }

    }
?>