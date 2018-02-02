<?php

require_once '/BddManager.php';

class ReservManager extends BddManager {

    public function create($reserv) {
        try {
            $req = 'SELECT MAX(idReserv) as idMax FROM Reservation';
            $statement = $this->_connexion->prepare($req);
            $statement->execute();
            $row = $statement->fetch(PDO::FETCH_ASSOC);
            $idReserv = intval($row['idMax']) + 1;
            $statement->closeCursor();
        } catch (PDOException $e) {
            die('Error->createVolGen() : ' . $e->getMessage());
        }

        try {
            $prepare = $this->_connexion->prepare('INSERT INTO Reservation(idUsers, idReserv, idClient, idVol, dateDepart, dateReserv, nbrReserv) VALUES'
                    . '(:idUsers, :idReserv, :idClient, :idVol, :dateDepart, NOW(), :nbrReserv)');
            $prepare->bindValue(':idUsers', $reserv->getIdUsers(), PDO::PARAM_INT);
            $prepare->bindValue(':idReserv', $idReserv, PDO::PARAM_INT);
            $prepare->bindValue(':idClient', $reserv->getIdClient(), PDO::PARAM_INT);
            $prepare->bindValue(':idVol', $reserv->getIdVol(), PDO::PARAM_INT);
            $prepare->bindValue(':dateDepart', $reserv->getDateDepart(), PDO::PARAM_STR);
            $prepare->bindValue(':nbrReserv', $reserv->getNbrReserv(), PDO::PARAM_INT);
            $prepare->execute();
        } catch (PDOException $e) {
            die('Error->createVolGen() : ' . $e->getMessage());
        }
    }

    public function downloadPDF($bdd) {
        echo'test';
    }

    public function update($vars) {
        echo'test';
    }

    public function delete($vars) {
        echo'test';
    }

    public function getByID($idReserv) {
        $statement = $this->_connexion->prepare('SELECT * FROM Reservation WHERE idReserv = :idReserv');
        $statement->execute(array(':idReserv' => $idReserv));

        $data = $statement->fetch(PDO::FETCH_ASSOC);

        $reserv = new Reservation();
        $reserv->hydrate($data);

        $statement->closeCursor();

        return $reserv;
    }

    public function getList($idUsers) {
        $req = 'SELECT * FROM Reservation WHERE idUsers = :idUsers OR :idUsers is null';

        $statement = $this->_connexion->prepare($req);
        $statement->execute(array(':idUsers' => $idUsers));

        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $reservation = new Reservation();
            $reservation->hydrate($row);
            $reservations[] = $reservation;
        }
        $statement->closeCursor();

        return $reservations;
    }

}
