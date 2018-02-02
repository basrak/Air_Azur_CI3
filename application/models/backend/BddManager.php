<?php

abstract class BddManager extends CI_Controller{

    protected $_connexion;
    var $_vars;

    public function __construct($connexion) {

        $this->_connexion = $connexion;
    }

    public abstract function create($vars);

    public abstract function update($vars);

    public abstract function delete($vars);

    
    

}
