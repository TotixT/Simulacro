<?php
    require_once("../Config/db.php");
    class Detalle{
        private $Detalle_ID;
        private $Cotizacion_ID;
        private $Producto_Alquilado;
        private $Fecha_Alquiler;
        private $Hora_Alquiler;
        private $PrecioxDia;
        private $TotalCotizacion;
        protected $dbCnx;

        public function __construct($Detalle_ID=0,$Cotizacion_ID="",$Producto_Alquilado="",$Fecha_Alquiler="",$Hora_Alquiler="",$PrecioxDia="",$TotalCotizacion=""){
            $this->Detalle_ID = $Detalle_ID;
            $this->Cotizacion_ID = $Cotizacion_ID;
            $this->Producto_Alquilado = $Producto_Alquilado;
            $this->Fecha_Alquiler = $Fecha_Alquiler;
            $this->Hora_Alquiler = $Hora_Alquiler;
            $this->PrecioxDia = $PrecioxDia;
            $this->TotalCotizacion = $TotalCotizacion;
            $this->dbCnx = new PDO(DB_TYPE . ":host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PWD, [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
        }

        // Detalle ID
        
        public function setDetalle_ID($Detalle_ID){
            $this->Detalle_ID = $Detalle_ID;
        }
        public function getDetalle_ID(){
            $this->Detalle_ID;
        }

        // Cotizacion ID
        
        public function setCotizacion_ID($Cotizacion_ID){
            $this->Cotizacion_ID = $Cotizacion_ID;
        }
        public function getCotizacion_ID(){
            $this->Cotizacion_ID;
        }

        // Producto Alquilado
        
        public function setProducto_Alquilado($Producto_Alquilado){
            $this->Producto_Alquilado = $Producto_Alquilado;
        }
        public function getProducto_Alquilado(){
            $this->Producto_Alquilado;
        }

        // Fecha Alquiler
        
        public function setFecha_Alquiler($Fecha_Alquiler){
            $this->Fecha_Alquiler = $Fecha_Alquiler;
        }
        public function getFecha_Alquiler(){
            $this->Fecha_Alquiler;
        }

        // Hora Alquiler
        
        public function setHora_Alquiler($Hora_Alquiler){
            $this->Hora_Alquiler = $Hora_Alquiler;
        }
        public function getHora_Alquiler(){
            $this->Hora_Alquiler;
        }

        // Precio x Dia
        
        public function setPrecioxDia($PrecioxDia){
            $this->PrecioxDia = $PrecioxDia;
        }
        public function getPrecioxDia(){
            $this->PrecioxDia;
        }

        // Total Cotizacion
        
        public function setTotalCotizacion($TotalCotizacion){
            $this->TotalCotizacion = $TotalCotizacion;
        }
        public function getTotalCotizacion(){
            $this->TotalCotizacion;
        }

        

        // Insert Data - Insert

        public function insertData(){
            try {
                $stm = $this->dbCnx->prepare("INSERT INTO detallecotizacion (Detalle_ID, Cotizacion_ID,Producto_Alquilado,Fecha_Alquiler,Hora_Alquiler,PrecioxDia,TotalCotizacion) VALUES (?,?,?,?,?,?,?)");
                $stm->execute([$this->Detalle_ID,$this->Cotizacion_ID,$this->Producto_Alquilado,$this->Fecha_Alquiler,$this->Hora_Alquiler,$this->PrecioxDia,$this->TotalCotizacion]);
            } catch (Exception $e) {
                $e -> getMessage();
            }
        }

        // Select All - Read

        public function selectAll(){
            try {
             $stm = $this->dbCnx->prepare("SELECT Detalle_ID,cotizacion.Cotizacion_ID, Producto_Alquilado, Fecha_Alquiler, Hora_Alquiler,PrecioxDia,TotalCotizacion
             FROM detallecotizacion
             INNER JOIN cotizacion ON detallecotizacion.Cotizacion_ID = cotizacion.Cotizacion_ID;");
             $stm->execute();
             return $stm->fetchAll();
                } catch (Exception $e) {
                    $e -> getMessage();
                }
        }

        public function selectCotizacion(){
            try {
                $stm = $this->dbCnx->prepare("SELECT Cotizacion_ID FROM cotizacion;");
                $stm->execute();
                return $stm->fetchAll();
            } catch (Exception $e) {
                $e -> getMessage();
            }
        }

        // Delete Data - Delete

        public function deleteData(){
            try {
                $stm = $this->dbCnx->prepare("DELETE FROM detallecotizacion WHERE Detalle_ID=?");
                $stm->execute([$this->Detalle_ID]);
                return $stm->fetchAll();
                echo "<script> alert('Borrado Exitosamente'); document.location='cotizaciones.php'</script>";
            } catch (Exception $e) {
                $e -> getMessage();
            }
        }

        // Select One - Seleccion de un dato especifico por ID

        public function selectOne(){
            try {
                $stm = $this->dbCnx->prepare("SELECT Detalle_ID,cotizacion.Cotizacion_ID, Producto_Alquilado, Fecha_Alquiler, Hora_Alquiler,PrecioxDia,TotalCotizacion
                FROM detallecotizacion
                INNER JOIN cotizacion ON detallecotizacion.Cotizacion_ID = cotizacion.Cotizacion_ID
                WHERE Detalle_ID = ?;");
                $stm->execute([$this->Detalle_ID]);
                return $stm->fetchAll();
            } catch (Exception $e) {
                $e -> getMessage();
            }
        }

        // Update Data - Update

        public function update(){
            try {
                $stm = $this->dbCnx->prepare("UPDATE detallecotizacion 
                INNER JOIN cotizacion ON detallecotizacion.Cotizacion_ID = cotizacion.Cotizacion_ID
                SET detallecotizacion.Cotizacion_ID=?, Producto_Alquilado=?, Fecha_Alquiler=?, Hora_Alquiler=?, PrecioxDia=?, TotalCotizacion=? WHERE detallecotizacion.Detalle_ID=?;");
                $stm->execute([$this->Cotizacion_ID,$this->Producto_Alquilado,$this->Fecha_Alquiler,$this->Hora_Alquiler,$this->PrecioxDia,$this->TotalCotizacion,$this->Detalle_ID]);
                return $stm->fetchAll();
            } catch (Exception $e) {
                $e -> getMessage();
            }
        }
        

        
    }
?>