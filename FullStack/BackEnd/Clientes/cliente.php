<?php
    require_once("../Config/db.php");
    class Cliente{
        private $Clientes_ID;
        private $Nombre_Cliente;
        private $Direccion_Cliente;
        private $Telefono_Cliente;
        protected $dbCnx;

        public function __construct($Clientes_ID=0,$Nombre_Cliente="",$Direccion_Cliente="",$Telefono_Cliente=""){
            $this->Clientes_ID = $Clientes_ID;
            $this->Nombre_Cliente = $Nombre_Cliente;
            $this->Direccion_Cliente = $Direccion_Cliente;
            $this->Telefono_Cliente = $Telefono_Cliente;
            $this->dbCnx = new PDO(DB_TYPE . ":host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PWD, [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
        }

        // Clientes ID
        
        public function setClientes_ID($Clientes_ID){
            $this->Clientes_ID = $Clientes_ID;
        }
        public function getClientes_ID(){
            $this->Clientes_ID;
        }

        // Nombre Cliente

        public function setNombre_Cliente($Nombre_Cliente){
            $this->Nombre_Cliente = $Nombre_Cliente;
        }
        public function getNombre_Cliente(){
            $this->Nombre_Cliente;
        }

        // Direccion Cliente

        public function setDireccion_Cliente($Direccion_Cliente){
            $this->Direccion_Cliente = $Direccion_Cliente;
        }
        public function getDireccion_Cliente(){
            $this->Direccion_Cliente;
        }

        // Telefono Cliente

        public function setTelefono_Cliente($Telefono_Cliente){
            $this->Telefono_Cliente = $Telefono_Cliente;
        }
        public function getTelefono_Cliente(){
            $this->Telefono_Cliente;
        }

        // Insert Data - Insert

        public function insertData(){
            try {
                $stm = $this->dbCnx->prepare("INSERT INTO clientes (Clientes_ID,Nombre_Cliente,Direccion_Cliente,Telefono_Cliente) VALUES (?,?,?,?)");
                $stm->execute([$this->Clientes_ID,$this->Nombre_Cliente,$this->Direccion_Cliente,$this->Telefono_Cliente]);
            } catch (Exception $e) {
                $e -> getMessage();
            }
        }

        // Select All - Read

        public function selectAll(){
                try {
                 $stm = $this->dbCnx->prepare("SELECT * FROM clientes");
                 $stm->execute();
                 return $stm->fetchAll();
            } catch (Exception $e) {
                $e -> getMessage();
            }
        }

        // Delete Data - Delete

        public function deleteData(){
            try {
                $stm = $this->dbCnx->prepare("DELETE FROM clientes WHERE Clientes_ID=?");
                $stm->execute([$this->Clientes_ID]);
                return $stm->fetchAll();
                echo "<script> alert('Borrado Exitosamente'); document.location='clientes.php'</script>";
            } catch (Exception $e) {
                $e -> getMessage();
            }
        }

        // Select One - Seleccion de un dato especifico por ID

        public function selectOne(){
            try {
                $stm = $this->dbCnx->prepare("SELECT * FROM clientes WHERE Clientes_ID=?");
                $stm->execute([$this->Clientes_ID]);
                return $stm->fetchAll();
            } catch (Exception $e) {
                $e -> getMessage();
            }
        }

        // Update Data - Update

        public function update(){
            try {
                $stm = $this->dbCnx->prepare("UPDATE clientes SET Nombre_Cliente=?,Direccion_Cliente=?,Telefono_Cliente=? WHERE Clientes_ID=?");
                $stm->execute([$this->Nombre_Cliente,$this->Direccion_Cliente,$this->Telefono_Cliente,$this->Clientes_ID]);
                return $stm->fetchAll();
            } catch (Exception $e) {
                $e -> getMessage();
            }
        }
    }
?>