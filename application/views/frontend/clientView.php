
<?php $header = ""; ?>

<?php ob_start(); ?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table id="reservationsTable" class="table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Num</th> 
                            <th>Nom</th>
                            <th>Prenom</th>
                            <th>Adresse</th>
                            <th>Code Postal</th>
                            <th>Ville</th>
                            <th>Tel</th>
                            <th>Mail</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        foreach ($clients as $client):
                            ?>
                            <tr>
                                <td><?php echo $client->getIdClient(); ?></td>
                                <td><?php echo $client->getNomClient(); ?></td>
                                <td><?php echo $client->getPrenomClient(); ?></td>
                                <td><?php echo $client->getAdrClient();?></td>
                                <td><?php echo $client->getCPClient(); ?></td>
                                <td><?php echo $client->getVilleClient(); ?></td>
                                <td><?php echo $client->getTelClient(); ?></td> 
                                <td><?php echo $client->getMailClient(); ?></td>
                                <td><button type="button" class="btnedit btn btn-primary btn-xs" data-id="Edit" data-toggle="modal" data-target="#editModal">Editer</button></td>
                                <td><button type="button" class="btnediter btn btn-danger btn-xs" data-id="Delete" data-toggle="modal" data-target="#editDelete" >Supprimer</button></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table> 

            </div>

        </div>
    </div>
</div>

<?php $content1 = ob_get_clean(); ?>

<?php $content2 = ""; ?>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                <h4 class="modal-title custom_align" id="Heading">Modifiez la réservation</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input class="form-control " type="text">
                </div>
                <div class="form-group">

                    <input class="form-control " type="text">
                </div>
                <div class="form-group">
                    <textarea rows="2" class="form-control" placeholder="CB 106/107 Street # 11 Wah Cantt Islamabad Pakistan"></textarea>


                </div>
            </div>
            <div class="modal-footer ">
                <button type="button" class="btn btn-warning btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span> Update</button>
            </div>
        </div>
        <!-- /.modal-content --> 
    </div>
    <!-- /.modal-dialog --> 
</div>





<?php ob_start(); ?>

<script src="http://localhost/Air_Azur_CI3/js/crud.js" type="text/javascript"></script>

<?php $script = ob_get_clean(); ?>
        


