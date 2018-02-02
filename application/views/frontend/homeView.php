
<?php ob_start(); ?>

<header class="text-white">
    <div class="container text-center">
        <h1>Bienvenue <?= htmlspecialchars($_SESSION['nomAgence']);?></h1>
        <p class="lead"><?= htmlspecialchars($_SESSION['adresseAgence']);?></p>
        <p class="lead"><?= htmlspecialchars($_SESSION['CPAgence'])." ".htmlspecialchars($_SESSION['villeAgence']);?></p>
        <p class="lead">tel : <?= htmlspecialchars($_SESSION['telAgence']);?></p>
        <p class="lead">email : <?= htmlspecialchars($_SESSION['mailAgence']);?></p>
    </div>
</header>

<?php $header = ob_get_clean(); ?>


<?php ob_start(); ?>

    <div class="container text-center text-white">
        <p class="lead">La Liste des vols disponibles a été mise à jour dans la base de données</p>
    </div>

<?php $content1 = ob_get_clean(); ?>

<?php $content2 = ""; ?>

<?php $script = ""; ?>

