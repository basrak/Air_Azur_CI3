<!-- Routeur -->
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

session_start();

class Index extends CI_Controller {

    function __construct() {
        parent:: __construct();
        $this->load->helper('form');
        $this->load->helper('url');
    //$this->output->enable_profiler(TRUE);                
    //$this->load->model('produitsmodel');
        $this->load->model('frontend/Users');      
    }

    public function index() {

        $data['msgConnexion'] = "";

        if (isset($_POST['Connexion'])) {
            $login = htmlspecialchars($_POST['login']);
            $mdp = htmlspecialchars($_POST['mdp']);
            
            if ($this->Connecter($login, $mdp) == true) {
                if (isset($_SESSION['login'])) {
                    if ($_SESSION['uStatus'] == 'admin')
                        header('Location: ./Admin/admin.php');
                    else if ($_SESSION['uStatus'] == 'agence')
                        header('Location: ./Agence/.php');
                }
            }
        } else
            $this->load->view('Index_View', $data);
    }

    function Connecter($login, $mdp) {

        //$this->load->model('backend/BddManager');
        $this->load->library('backend/UsersManager');
        
        $connexion = BddConnexion::getInstance();
        $bdd = new UsersManager($connexion->handle());

        $data['user'] = $bdd->get($login, $mdp);

        if ($User == false || is_null($User)) {
            $msgConnexion = "Le login ou le mot de passe sont incorrects";
            $this->load->view('Index_View', $data);
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

}
