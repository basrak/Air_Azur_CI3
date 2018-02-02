<?php


require('../controller/frontendController.php');

$selclient = htmlspecialchars($_REQUEST['selClient']);
echo findClientJSON($selclient);
?>