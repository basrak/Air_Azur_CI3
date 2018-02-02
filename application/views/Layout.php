<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= $title; ?></title>
        <meta name="description" content="Intranet d'Air Azur" />
        <meta name="keywords" content="Air Azur, vol, réservation, voyage, agence, avion, aéroport" />
        <meta name="theme-color" content="#ffffff">
        <link rel="stylesheet" type="text/css" href="<?php base_url(); ?>css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="<?php base_url(); ?>css/bootstrap-theme.css">
        <link rel="stylesheet" type="text/css" href="<?php base_url(); ?>css/airazur.css">
        <link src="<?php base_url(); ?>js/jquery-3.2.1.min.js" type="text/javascript"></link>
    </head>

    <body>

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
            <?= $nav; ?>
        </nav>
        <header>
            <?= $header; ?>
        </header>
        <section id="section1">
            <?= $content1; ?>
        </section>
        <section id="section2">
            <?= $content2; ?>
        </section>

        <footer class="py-5 bg-dark">
            <div class="container">
                <p class="m-0 text-center text-white">Copyright &copy; Air Azur 2018</p>
            </div>
        </footer>

        <!-- Scripts -->
        <script src="<?php base_url(); ?>js/jquery-3.2.1.min.js" type="text/javascript"></script>
        <script src="<?php base_url(); ?>js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?php base_url(); ?>js/bootstrap.bundle.min.js" type="text/javascript"></script>
        <script src="<?php base_url(); ?>js/scrolling-nav.js"></script>
        <?= $script ?>
    </body>

</html>

