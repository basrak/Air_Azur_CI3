<?php

require('./model/frontend/Users.php');
require('./model/backend/BddConnexion.php');
require('./model/backend/UsersManager.php');

$msgConnexion = "";

function Connecter($login, $mdp) {

    $connexion = BddConnexion::getInstance();
    $bdd = new UsersManager($connexion->handle());

    $User = $bdd->get($login, $mdp);

    if ($User == false || is_null($User)) {
        $msgConnexion = "Le login ou le mot de passe sont incorrects";
        require('view/indexView.php');
    } else {
        $_SESSION['idUsers'] = $User->getIdUsers();
        $_SESSION['login'] = $User->getLogin();
        $_SESSION['nomAgence'] = $User->getNomAgence();
        $_SESSION['uStatus'] = $User->getUStatus();
        $_SESSION['adresseAgence'] = $User->getAdrAgence();
        $_SESSION['CPAgence'] = $User->getCPAgence();
        $_SESSION['villeAgence'] = $User->getVilleAgence();
        $_SESSION['telAgence'] = $User->getTelAgence();
        $_SESSION['mailAgence'] = $User->getMailAgence();
        $_SESSION['action'] = 'accueil';
        return true;
    }
}
