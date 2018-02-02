<?php

require_once '/BddManager.php';

class VolManager extends BddManager {

    public function create($vol) {
        try {
            $prepare = $this->_connexion->prepare('INSERT INTO Vol (idVol, dateDepart, dateArrivee) VALUES(:idVol, :dateDepart, :dateArrivee)');
            $prepare->bindValue(':idVol', $vol->getVolGen()->getIdVol(), PDO::PARAM_INT);
            $prepare->bindValue(':dateDepart', $vol->getDateDepart(), PDO::PARAM_STR);
            $prepare->bindValue(':dateArrivee', $vol->getDateArrivee(), PDO::PARAM_STR);
            $prepare->execute();
        } catch (PDOException $e) {
            die('Error->createVol() : ' . $e->getMessage());
        }
    }

    public function update($vars) {
        echo'test';
    }

    public function delete($vars) {
        echo'test';
    }

    public function get($idVol, $dateDepart) {
        try {
            $statement = $this->_connexion->prepare('SELECT * FROM Vol WHERE idVol = :idVol AND dateDepart = :dateDepart');
            $statement->execute(array(':idVol' => $idVol, 'dateDepart' => $dateDepart));

            $row = $statement->fetch(PDO::FETCH_ASSOC);

            $vol = new Vol();
            $vol->setIdVol($row['IDVOL']);
            $vol->setDateDepart($row['DATEDEPART']);
            $vol->setDateArrivee($row['DATEARRIVEE']);

            $statement->closeCursor();

            return $vol;
        } catch (PDOException $e) {
            die('Error->getVolByID() : ' . $e->getMessage());
        }
    }

    public function getList($idArpt, $idArptArrivee, $dateDepart, $dateArrivee) {
        try {
            $req = 'SELECT * FROM Vol v INNER JOIN VolGen vg on v.idvol = vg.idvol WHERE '
                    . ':idArpt is NULL OR vg.idARPT = :idArpt AND '
                    . ':idArptArrivee is NULL or vg.idArpt_Arrivee = :idArptArrivee AND '
                    . ':dateDepart is NULL or v.dateDepart = :dateDepart AND '
                    . ':dateArrivee is NULL or v.dateArrivee = :dateArrivee';

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
                $vol = new Vol();
                $vol->setIdVol($row['IDVOL']);
                $vol->setDateDepart($row['DATEDEPART']);
                $vol->setDateArrivee($row['DATEARRIVEE']);
                $vol->setVolGen($volGen);
                $vols[] = $vol;
            }
            $statement->closeCursor();

            return $vols;
        } catch (PDOException $e) {
            die('Error->getList() : ' . $e->getMessage());
        }
    }

}
