
<?php $title = 'Home - Air Azur'; ?>

<?php ob_start(); ?>

<div class="container">
    <a class="navbar-brand js-scroll-trigger" href="#"><img src="./img/logo.png" data-active-url="./img/logo-active.png" alt=""></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="#connexionForm"><h4>Se Connecter</h4></a>
            </li>
        </ul>
    </div>
</div>


<?php $nav = ob_get_clean(); ?>

<?php ob_start(); ?>

<header class="text-white">
    <div class="container text-center">
        <h1>Bienvenue sur l'intranet d'Air Azur</h1>
        <p class="lead">Un réseau d'agences à votre service</p>
    </div>
</header>

<?php $header = ob_get_clean(); ?>


<?php ob_start(); ?>

<div id="connexionForm" class="login-container">
    <h1>Connexion</h1><br>
    <form action="" method='post'>
        <input required type="text" name="login" placeholder="Username">
        <input required type="password" name="mdp" placeholder="Password">
        <input type="submit" id="Connexion" name="Connexion" class="login login-submit" value="Se connecter">
        <label class="errorMsg" id="validation"><?php echo $msgConnexion; ?></label>  
    </form>
    <div class="login-help">
        <a href="#">Register</a> - <a href="#">Forgot Password</a>
    </div>
</div>



<?php $content1 = ob_get_clean(); ?>

<?php $content2 = ''; ?>

<?php $script = ''; ?>

<?php $this->load->view('Layout',array(
                        'title' => $title,
                        'nav' => $nav,
                        'header' => $header,
                        'content1' => $content1,
                        'content2' => $content2,
                        'script' => $script
                        ));
