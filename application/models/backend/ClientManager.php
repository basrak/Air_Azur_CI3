<?php

require_once '/BddManager.php';

class ClientManager extends BddManager {

    public function create($vol) {
        echo'test';
    }

    public function update($vars) {
        echo'test';
    }

    public function delete($vars) {
        echo'test';
    }

    public function getByID($idClient) {
        $statement = $this->_connexion->prepare('SELECT * FROM Client WHERE idClient = :idClient');
        $statement->execute(array(':idClient' => $idClient));

        $data = $statement->fetch(PDO::FETCH_ASSOC);

        $client = new Client();
        $client->hydrate($data);

        $statement->closeCursor();

        return $client;
    }

    public function getList() {
        $req = 'SELECT * FROM Client';

        $statement = $this->_connexion->prepare($req);
        $statement->execute();

        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $client = new Client();
            $client->hydrate($row);
            $clients[] = $client;
        }
        $statement->closeCursor();

        return $clients;
    }

}
