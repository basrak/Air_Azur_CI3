<?php

require_once '/BddManager.php';

class VolGenManager extends BddManager {

    
    public function create($volGen) {
        try {
            $prepare = $this->_connexion->prepare('INSERT INTO VolGen(idArpt, idArpt_Arrivee, codeVol, prixVol, placesVol, JourVol) VALUES(:idArpt, :idArpt_Arrivee, :codeVol, :prixVol, :placesVol, :jourVol)');
            $prepare->bindValue(':idArpt', $volGen->getIdArpt(), PDO::PARAM_INT);
            $prepare->bindValue(':idArpt_Arrivee', $volGen->getIdArptArrivee(), PDO::PARAM_INT);
            $prepare->bindValue(':codeVol', $volGen->getCodeVol(), PDO::PARAM_STR);
            $prepare->bindValue(':prixVol', $volGen->getPrixVol(), PDO::PARAM_INT);
            $prepare->bindValue(':placesVol', $volGen->getPlacesVol(), PDO::PARAM_INT);
            $prepare->bindValue(':jourVol', $volGen->getJourVol(), PDO::PARAM_STR);
            $prepare->execute();

        } catch (PDOException $e) {
            die('Error->createVolGen() : ' . $e->getMessage());
        }
    }

    public function update($vars) {
        echo'test';
    }

    public function delete($vars) {
        echo'test';
    }

    public function get($param1, $type) {
        try {
            
            switch ($type) {
                case "id":
                    $req = 'SELECT * FROM VolGen WHERE idVol = :param1';
                    break;
                case "idArpt":
                    $req = 'SELECT * FROM VolGen WHERE idArpt = :param1';
                    break;
                case "codeVol":
                    $req = 'SELECT * FROM VolGen WHERE codeVol = :param1';
                    break;
            }
            
            
            $statement = $this->_connexion->prepare($req);
            $statement->execute(array(':param1' => $param1));

            $row = $statement->fetch(PDO::FETCH_ASSOC);

            $volGen = new VolGen();
            $volGen->setIdVol($row['IDVOL']);
            $volGen->setIdArpt($row['IDARPT']);
            $volGen->setIdArptArrivee($row['IDARPT_ARRIVEE']);
            $volGen->setCodeVol($row['CODEVOL']);
            $volGen->setPrixVol($row['PRIXVOL']);
            $volGen->setPlacesVol($row['PLACESVOL']);
            $volGen->setJourVol($row['JOURVOL']);

            $statement->closeCursor();

            return $volGen;
        } catch (PDOException $e) {
            die('Error->getVolGenByID() : ' . $e->getMessage());
        }
    }

    public function getList($idArpt, $idArptArrivee) {
        try {
            $req = 'SELECT * FROM VolGen WHERE '
                    . ':idArpt is NULL OR vg.idARPT = :idArpt AND '
                    . ':idArptArrivee is NULL or vg.idArpt_Arrivee = :idArptArrivee';

            $statement = $this->_connexion->prepare($req);
            $statement->execute(array(':idArpt' => $idArpt, ':idArptArrivee' => $idArptArrivee, ':dateDepart' => $dateDepart, ':dateArrivee' => $dateArrivee));

            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $volGen = new VolGen();
                $volGen->setIdVol($row['IDVOL']);
                $volGen->setIdArpt($row['IDARPT']);
                $volGen->setIdArptArrivee($row['IDARPT_ARRIVEE']);
                $volGen->setCodeVol($row['CODEVOL']);
                $volGen->setPrixVol($row['PRIXVOL']);
                $volGen->setPlacesVol($row['PLACESVOL']);
                $volGen->setJourVol($row['JOURVOL']);
                $volGens[] = $volGen;
            }
            $statement->closeCursor();

            return $volGens;
        } catch (PDOException $e) {
            die('Error->getList() : ' . $e->getMessage());
        }
    }

}
