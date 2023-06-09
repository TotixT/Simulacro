<?php
    require_once("../Config/db.php");
    class Cotizacion{
        private $idCotizacion;
        private $idEmpleados;
        private $Constructora;
        private $Fecha;
        protected $dbCnx;

        public function __construct($idCotizacion=0,$idEmpleados=0,$Constructora="",$Fecha=""){
            $this->idCotizacion = $idCotizacion;
            $this->idEmpleados = $idEmpleados;
            $this->Constructora = $Constructora;
            $this->Fecha = $Fecha;
            $this->dbCnx = new PDO(DB_TYPE . ":host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PWD, [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
        }

        // Categoria ID
        
        public function setidCotizacion($idCotizacion){
            $this->idCotizacion = $idCotizacion;
        }
        public function getidCotizacion(){
            $this->idCotizacion;
        }

        // Categoria Nombre

        public function setidEmpleados($idEmpleados){
            $this->idEmpleados = $idEmpleados;
        }
        public function getidEmpleados(){
            $this->idEmpleados;
        }

        // Constructora

        public function setConstructora($Constructora){
            $this->Constructora = $Constructora;
        }
        public function getConstructora(){
            $this->Constructora;
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
                $stm = $this->dbCnx->prepare("INSERT INTO cotizacion (idCotizacion,idEmpleados,Constructora,Fecha) VALUES (?,?,?,?)");
                $stm->execute([$this->idCotizacion,$this->idEmpleados,$this->Constructora,$this->Fecha]);
            } catch (Exception $e) {
                $e -> getMessage();
            }
        }

        // Select All - Read

        public function selectAll(){
            try {
                 $stm = $this->dbCnx->prepare("SELECT * FROM cotizacion");
                 $stm->execute();
                 return $stm->fetchAll();
            } catch (Exception $e) {
                $e -> getMessage();
            }
        }

        // Delete Data - Delete

        public function deleteData(){
            try {
                $stm = $this->dbCnx->prepare("DELETE FROM cotizacion WHERE idCotizacion=?");
                $stm->execute([$this->idCotizacion]);
                return $stm->fetchAll();
                echo "<script> alert('Borrado Exitosamente'); document.location='cotizaciones.php'</script>";
            } catch (Exception $e) {
                $e -> getMessage();
            }
        }

        // Select One - Seleccion de un dato especifico por ID

        public function selectOne(){
            try {
                $stm = $this->dbCnx->prepare("SELECT * FROM cotizacion WHERE idCotizacion=?");
                $stm->execute([$this->idCotizacion]);
                return $stm->fetchAll();
            } catch (Exception $e) {
                $e -> getMessage();
            }
        }

        // Update Data - Update

        public function update(){
            try {
                $stm = $this->dbCnx->prepare("UPDATE cotizacion SET idEmpleados=?,Constructora=?,Fecha=? WHERE idCotizacion=?");
                $stm->execute([$this->idEmpleados,$this->Constructora,$this->Fecha,$this->idCotizacion]);
                return $stm->fetchAll();
            } catch (Exception $e) {
                $e -> getMessage();
            }
        }
    }
?>