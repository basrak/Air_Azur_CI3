
<?php $header = ""; ?>

<?php ob_start();
?>

<div class="search-container">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="row">
                <div class="col-sm-2 col-md-2 col-lg-2"><label for="sVilleDepart"><h5 class="white">Ville de départ</label></h5></div>
                <div class="col-sm-2 col-md-2 col-lg-2"><label for="sVilleArrivee"><h5 class="white">Ville d'Arrivée</label></h5></div>                
            </div>
            <div class="row">
                <div class="col-sm-2 col-md-2 col-lg-2">
                    <select id="sVilleArrivee" name="sVilleArrivee" class="selectpicker">
                        <?php
                        echo '<option value="0">Toutes les villes</option>';
                        foreach ($arpts as $arpt) :
                            echo '<option value="' . $arpt->getIdArpt() . '">' . $arpt->getNomArpt() . '</option>';
                        endforeach;
                        ?>
                    </select>
                </div> 
                <div class="col-sm-2 col-md-2 col-lg-2">
                    <select id="sVilleDepart" name="sVilleDepart" class="selectpicker">
                        <?php
                        echo '<option value="0">Toutes les villes</option>';
                        foreach ($arpts as $arpt) :
                            echo '<option value="' . $arpt->getIdArpt() . '">' . $arpt->getNomArpt() . '</option>';
                        endforeach;
                        ?>
                    </select>
                </div>
                <div class="col-sm-4 col-md-4 col-lg-4">
                    <button type="button" >Sélectionner tous les vols </button>
                </div>
                <div class="col-sm-4 col-md-4 col-lg-4"><label>Il y a <?php echo count($vols); ?> vols disponibles d'après vos critères. </label></div>
            </div>    
        </div>
    </div>
</div>

<?php $content1 = ob_get_clean(); ?>

<?php ob_start(); ?>

<div class="container">
    <table class="vol">
        <?php
        foreach ($vols as $vol):
            ?>
            <tr>              			
                <td class="col-sm-12 col-md-12 col-lg-12">
                    <div class="row">
                        <div class="col-md-4"><h5 class="black">Vol : <?php echo $vol->getVolgen()->getCodeVol(); ?></h5></div>
                        <div class="col-md-6"><h5 class="black">Depart : <?php echo "" . findArpt($vol->getVolgen()->getIdArpt(), "id")->getNomArpt() . " " . $vol->getDateDepart() . ""; ?></h5></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4"><h5 class="black"></h5></div>
                        <div class="col-md-6"><h5 class="black">Arrivee : <?php echo "" . findArpt($vol->getVolgen()->getIdArptArrivee(), "id")->getNomArpt() . " " . $vol->getDateArrivee() . ""; ?></h5></div>
                        <div class="col-md-2"><button type="button" data-toggle="modal" data-target="#modalReserver" class="reserver btn-blue-fill expand"
                                                      data-code="<?php echo $vol->getVolGen()->getCodeVol(); ?>"
                                                      data-date="<?php echo $vol->getDateDepart(); ?>"
                                                      data-prix="<?php echo $vol->getVolGen()->getPrixVol(); ?>"
                                                      >Réserver</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4"><h5 class="black"></h5></div>
                        <div class="col-md-3"><h5 class="prix black">Prix : <?php echo $vol->getVolGen()->getPrixVol(); ?></h5></div>
                        <div class="col-md-3"><h5 class="places black">Places : <?php echo calcPlaces($vol)->getPlacesRest(); ?></h5></div>
                    </div>
                </td>
            </tr>


        <?php endforeach; ?>
    </table>
</div>

<?php $content2 = ob_get_clean(); ?>

<?php ob_start(); ?>

<div class="modal fade" id="modalReserver" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="" method="post">
                <div class="modal-header">
                    <h3 class="white">Reserver pour le vol : </h3>
                    <h3 class="volCode white"></h3>
                    <input type="hidden" id="volCode" name="volCode" value="">
                    <h3 class="volDate white"></h3>
                    <input type="hidden" id="volDate" name="volDate" value="">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-6 col-xs-6 col-lg-6">
                                <label for="selClient">Client</label>
                                <select id="selClient" name="selClient" class="form-control">
                                    <option value="0"> ------Nouveau Client-----</option>
                                    <?php
                                    foreach ($clients as $client) :
                                        echo '<option value="' . $client->getIdClient() . '">' . $client->getNomClient() . ' ' . $client->getPrenomClient() . '</option>';
                                    endforeach;
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-6 col-xs-6 col-lg-6">
                                <label for="nomC">Nom</label>
                                <input type="text" id="nomC" name="nomC" class="form-control" placeholder="nom">
                            </div>
                            <div class="form-group col-md-6 col-sm-6 col-xs-6 col-lg-6">
                                <label for="prenomC" class="control-label">Prenom</label>
                                <input type="text" id="prenomC" name="prenomC" class="form-control" placeholder="prénom">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12 col-sm-12 col-xs-12 col-lg-12">
                                <label for="adresseC" class="control-label">Adresse</label>
                                <input type="text" id="adresseC" name="adresseC" class="form-control" placeholder="adresse">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-6 col-xs-6 col-lg-6">
                                <label for="CPC" class="control-label">Code Postal</label>
                                <input type="text" id="CPC" name="CPC" class="form-control" placeholder="code postal">
                            </div>

                            <div class="form-group col-md-6 col-sm-6 col-xs-6 col-lg-6">
                                <label for="villeC" class="control-label">Ville</label>
                                <input type="text" id="villeC" name="villeC" class="form-control" placeholder="ville">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-6 col-xs-6 col-lg-6">
                                <label for="telC" class="control-label">Téléphone</label>
                                <input type="text" id="telC" name="telC" class="form-control" placeholder="téléphone">
                            </div>

                            <div class="form-group col-md-6 col-sm-6 col-xs-6 col-lg-6">
                                <label for="mailC" class="control-label">Email</label>
                                <input type="text" id="mailC" name="mailC" class="form-control" placeholder=".........@.......">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-6 col-xs-6 col-lg-6">
                                <label class="control-label">Nombre de places</label>
                                <select id="placesC" name="placesC" class="form-control">
                                    <?php
                                    $i = 1;
                                    while ($i <= 100) {
                                        ?>
                                        <option value="<?php echo $i ?>"><?php echo $i ?></option> <?php
                                        $i++;
                                    }
                                    ?>
                                </select>
                            </div>        
                            <div class="form-group col-md-6 col-sm-6 col-xs-6 col-lg-6">
                                <label for="prixU" class="control-label">Prix Unitaire</label>
                                <input type="text" id="prixU" name="prixU" class="form-control" readonly="readonly">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-6 col-xs-6 col-lg-6">
                                <label for="prixT" class="control-label">Prix total</label>
                                <input type="text" id="prixT" name="prixT" class="form-control" readonly="readonly">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="sendReserv" name="sendReserv" class="btn btn-blue-fill expand">Envoyer</button>
                            <button type="button" class="btn btn-blue-fill expand" data-dismiss="modal" aria-label="Close">Annuler</button>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>




<script src="http://localhost/Air_Azur_CI3/js/reserver.js" type="text/javascript"></script>

<?php $script = ob_get_clean(); ?>
        


