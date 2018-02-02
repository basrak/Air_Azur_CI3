<?php

require('frontendController.php');
require('../fpdf/pdf.php');


$pdf = loadPDF(htmlspecialchars($_REQUEST['id']));


function loadPDF($idReserv) {
        
    $reserv = findReservation($idReserv);
    $volGen = findVolGen($reserv->getIdVol(), "id");
    $vol = findVol($reserv->getIdVol(), $reserv->getDateDepart());
    $client = findClient($reserv->getIdClient());
    $arptD = findArpt($volGen->getIdArpt(), "id");
    $arptA = findArpt($volGen->getIdArptArrivee(), "id");
    
    $pdf = new PDF();
    $pdf->AddPage();
    $pdf->Ln(1);
 
    $pdf->Rect(10,40,190,50);
    $pdf->SetFont('Arial','B',11);
    $pdf->Cell(5,40);
    $pdf->Cell(25,40,'Client :');
    $pdf->Ln(1);
    $pdf->SetFont('Arial','B',9);
    $pdf->Cell(5,60);
    $pdf->Cell(25,60,'Nom :');
    $pdf->Cell(25,60,iconv('UTF-8', 'windows-1252', $client->getNomClient()));
    $pdf->Cell(25,60,'Adresse :');
    $pdf->Cell(40,60,iconv('UTF-8', 'windows-1252', $client->getAdrClient()));
    $pdf->Cell(25,60,iconv('UTF-8', 'windows-1252', $client->getCPClient()));
    $pdf->Cell(25,60,iconv('UTF-8', 'windows-1252', $client->getVilleClient()));
    $pdf->Ln(1);
    $pdf->Cell(5,80);
    $pdf->Cell(25,80, iconv('UTF-8', 'windows-1252', 'Prénom :'));
    $pdf->Cell(25,80, iconv('UTF-8', 'windows-1252', $client->getPrenomClient()));
    $pdf->Cell(25,80, iconv('UTF-8', 'windows-1252', 'Tél :'));
    $pdf->Cell(40,80, iconv('UTF-8', 'windows-1252', $client->getTelClient()));
    $pdf->Cell(25,80,'Mail :');
    $pdf->Cell(40,80, iconv('UTF-8', 'windows-1252', $client->getMailClient()));
    $pdf->Ln(8);
   
    $pdf->Rect(10,100,190,60);
    $pdf->SetFont('Arial','B',11);
    $pdf->Cell(5,140);
    $pdf->Cell(25,140,'Vol :');
    $pdf->Ln(1);
    $pdf->SetFont('Arial','B',9);
    $pdf->Cell(5,160);
    $pdf->Cell(25,160,'CodeVol :');
    $pdf->Cell(25,160,iconv('UTF-8', 'windows-1252', $volGen->getCodeVol()));
    $pdf->Cell(25,160,iconv('UTF-8', 'windows-1252', 'Départ :'));
    $pdf->Cell(40,160,iconv('UTF-8', 'windows-1252', $arptD->getNomArpt()));
    $pdf->Cell(40,160,iconv('UTF-8', 'windows-1252', $vol->getDateDepart()));
    $pdf->Ln(1);
    $pdf->Cell(5,180);
    $pdf->Cell(50,180);
    $pdf->Cell(25,180,iconv('UTF-8', 'windows-1252', 'Arrivée :'));
    $pdf->Cell(40,180,iconv('UTF-8', 'windows-1252', $arptA->getNomArpt()));
    $pdf->Cell(40,180,iconv('UTF-8', 'windows-1252', $vol->getDateArrivee()));
    $pdf->Ln(2);
    
    $pdf->Cell(5,200);
    $pdf->Cell(40,200,iconv('UTF-8', 'windows-1252', 'Nombre de places :'));
    $pdf->Cell(35,200,iconv('UTF-8', 'windows-1252', $reserv->getNbrReserv()));
    $pdf->Cell(40,200,iconv('UTF-8', 'windows-1252', 'Prix total :'));
    $pdf->Cell(25,200,iconv('UTF-8', 'windows-1252', $reserv->getNbrReserv()*$volGen->getPrixVol().' €'));
    
    $pdf->Output();
    
}