<?php

require_once '/BddManager.php';

class ArptManager extends BddManager {

    public function create($arpt) {
        $prepare = $this->_db->prepare('INSERT INTO Aeroport(nomArpt, villeArpt) VALUES(:nomArpt, :villeArpt)');
        $prepare->bindValue(':nomArpt', $arpt->getNomArpt(), PDO::PARAM_STR);
        $prepare->bindValue(':villeArpt', $arpt->getVilleArpt(), PDO::PARAM_STR);
        $prepare->execute();
    }

    public function update($arpt) {
        echo'test';
    }

    public function delete($arpt) {
        echo'test';
    }

    public function getList() {
        $statement = $this->_connexion->prepare('SELECT * FROM Aeroport');
        $statement->execute();

        while ($data = $statement->fetch(PDO::FETCH_ASSOC)) {
            $arpt = new Aeroport();
            $arpt->hydrate($data);
            $arpts[] = $arpt;
        }
        $statement->closeCursor();

        return $arpts;
    }

    public function get($param1, $type) {
    
        switch ($type) {
            case "id":
                $req = 'SELECT * FROM Aeroport WHERE idArpt = :param1';
                break;
            case "nom":
                $req = 'SELECT * FROM Aeroport WHERE nomArpt = :param1';
                break;
        }
        $statement = $this->_connexion->prepare($req);
        $statement->execute(array(':param1' => $param1));

        $data = $statement->fetch(PDO::FETCH_ASSOC);

        $arpt = new Aeroport();
        $arpt->hydrate($data);

        $statement->closeCursor();

        return $arpt;
    }

    

}
