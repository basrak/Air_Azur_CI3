<?php

class Vol implements JsonSerializable
{
    private $_idVol;
    private $_dateDepart;
    private $_dateArrivee;
    private $_volGen;
    private $_placesRest;

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
    public function getIdVol()  { return $this->_idVol; }
    public function getDateDepart()  { return $this->_dateDepart; }
    public function getDateArrivee()  { return $this->_dateArrivee; }
    public function getPlacesRest()  { return $this->_placesRest; }
    public function getVolGen()  { return $this->_volGen; }
    
    //Setters
    public function setIdVol($idVol)
    {
        $this->_idVol = $idVol;
    }
    
    public function setDateDepart($dateDepart)
    {
        $this->_dateDepart = $dateDepart;
    }
    
    public function setDateArrivee($dateArrivee)
    {
        $this->_dateArrivee = $dateArrivee;
    }
    
    public function setVolGen($volGen)
    {
        $this->_volGen = $volGen;
    }
    
    public function setPlacesRest($placesRest)
    {
        $this->_placesRest = $placesRest;
    }
    
    public function jsonSerialize() {
        
        $json = array();
        foreach ($this as $key => $value) {
            $json[$key] = $value;
        }
        return json_encode($json);
    }
   
}