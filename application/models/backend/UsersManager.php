<?php

require_once '/BddManager.php';

class UsersManager extends BddManager {

    public function create($user) {
        try {
            $prepare = $this->_connexion->prepare('INSERT INTO Users(idUsers, login, mdp, uStatus, codeAgence, nomAgence, adrAgence, CPAgence, villeAgence, telAgence, mailAgence) '
                    . 'VALUES(:idUsers, :login, :mdp, :uStatus, :codeAgence, :nomAgence, :adrAgence, :CPAgence, :villeAgence, :telAgence, :mailAgence)');
            $prepare->bindValue(':idUsers', $user->getIdUsers(), PDO::PARAM_INT);
            $prepare->bindValue(':login', $user->getLogin(), PDO::PARAM_STR);
            $prepare->bindValue(':mdp', $user->getMdp(), PDO::PARAM_STR);
            $prepare->bindValue(':uStatus', $user->getUStatus(), PDO::PARAM_STR);
            $prepare->bindValue(':codeAgence', $user->getMdp(), PDO::PARAM_STR);
            $prepare->bindValue(':nomAgence', $user->getUStatus(), PDO::PARAM_STR);
            $prepare->bindValue(':adrAgence', $user->getUStatus(), PDO::PARAM_STR);
            $prepare->bindValue(':CPAgence', $user->getUStatus(), PDO::PARAM_INT);
            $prepare->bindValue(':villeAgence', $user->getUStatus(), PDO::PARAM_STR);
            $prepare->bindValue(':telAgence', $user->getUStatus(), PDO::PARAM_STR);
            $prepare->bindValue(':mailAgence', $user->getUStatus(), PDO::PARAM_STR);
            $prepare->execute();
        } catch (PDOException $e) {
            die('Error->create() : ' . $e->getMessage());
        }
    }

    public function update($vars) {
        echo'test';
    }

    public function delete($vars) {
        echo'test';
    }

    public function get($login, $mdp) {
        try {
            $statement = $this->_connexion->prepare('SELECT * FROM Users WHERE login = :login AND mdp = :mdp');
            $statement->execute(array(':login' => $login, ':mdp' => $mdp));
            $data = $statement->fetch(PDO::FETCH_ASSOC);
            $count = $statement->rowCount();

            if ($count == 1) {
                $User = new Users();
                $User->hydrate($data);
                return $User;
            }
            $statement->closeCursor();
        } catch (PDOException $e) {
            die('Error->get() : ' . $e->getMessage());
            return false;
        }
    }

}
