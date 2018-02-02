<?php

class BddConnexion {
/**
 * Class Singleton pour connexion à la base de données
 */
    private $_handle;
    private static $_instance;

    private function __construct()
    { 
        try {
            $this->_handle = new PDO("mysql:host=localhost;dbname=Air_Azur_CI3;charset=utf8" , "root" , "");
            $this->_handle->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Connection failed or database cannot be selected : ' . $e->getMessage());
        }
            
    }

    public function __destruct() {
        $this->_handle = null;
    }
    
    public static function getInstance() {
        if (self::$_instance == null) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function handle()
    {
        return $this->_handle;
    } 

    public function __clone() 
    {
        die(__CLASS__ . ' la classe ne peut pas être instanciée. Utilisez la méthode appelée getInstance.');
    }
}

?>

