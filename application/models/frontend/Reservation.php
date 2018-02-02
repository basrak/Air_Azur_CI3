<?php

class Reservation implements JsonSerializable
{
    private $_idUsers;
    private $_idReserv;
    private $_idClient;
    private $_idVol;
    private $_dateDepart;
    private $_dateReserv;
    private $_nbrReserv;
    
    //hydratation des données à partir de la base de données
    public function hydrate(array $data)
    {
    foreach ($data as $key => $value)
        {
        // On récupère le nom du setter correspondant à l'attribut.
        $method = 'set'.ucfirst($key);       
        // Si le setter correspondant existe.
        if (method_exists($this, $method))
                {
                // On appelle le setter.
                $this->$method($value);
                }
        }
    }       
            
    //Getters
    public function getIdUsers()  { return $this->_idUsers; }
    public function getIdReserv()  { return $this->_idReserv; }
    public function getIdClient()  { return $this->_idClient; }
    public function getIdVol()  { return $this->_idVol; }
    public function getDateDepart()  { return $this->_dateDepart; }
    public function getDateReserv()  { return $this->_dateReserv; }
    public function getNbrReserv()  { return $this->_nbrReserv; }

    //Setters
     public function setIdUsers($idUsers)
    {
        $this->_idUsers = $idUsers;
    }
    
    public function setIdReserv($idReserv)
    {
        $this->_idReserv = $idReserv;
    }
    
    public function setIdClient($idClient)
    {
        $this->_idClient = $idClient;
    }
    
    public function setIdVol($idVol)
    {
        $this->_idVol = $idVol;
    }    
    
    public function setDateDepart($dateDepart)
    {
        $this->_dateDepart = $dateDepart;
    }
    
    public function setDateReserv($dateReserv)
    {
        $this->_dateReserv = $dateReserv;
    }
    
    public function setNbrReserv($nbrReserv)
    {
        $this->_nbrReserv = $nbrReserv;
    }
    
    public function jsonSerialize() {
        
        $json = array();
        foreach ($this as $key => $value) {
            $json[$key] = $value;
        }
        return json_encode($json);
    }
    
    
    
    
    
}
    

