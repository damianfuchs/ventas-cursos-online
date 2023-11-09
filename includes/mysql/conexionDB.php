<?php
ini_set('display_errors', 1); // muestra errores

class connect{

    protected $dbHost;
    protected $dbUsername ;
    protected $dbName ;
    protected $dbPassword ;

    public function __construct($db_Host, $db_Username,$db_Password,$db_name){
        $this->dbHost = $db_Host;
        $this->dbUsername = $db_Username;
        $this->dbPassword = $db_Password;
        $this->dbName = $db_name;
    }
    public function conectar(){
    $db = new mysqli($this->dbHost, $this->dbUsername, $this->dbPassword, $this->dbName);
    if($db->connect_error)
    {
        require_once 'index.php';
        $alerta = new alerta("Error al conectar con la base de datos");
        $alerta->informar_error();
    }
    return $db;
    }
}
?>