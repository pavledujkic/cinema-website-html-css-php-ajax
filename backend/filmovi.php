<?php

include "broker.php";


$broker=Broker::getBroker();
if(isset($_GET["metoda"])){
    $response=array();
    if($_GET["metoda"]=="sortiraj"){
        $broker->vratiFilmoveSortirano($_GET["sort"],$_GET["zanr"]);
    }else{
        if($_GET["metoda"]=="vratiIzZanra"){
            $broker->vratiFilmoveIzKategorije($_GET["zanr"],$_GET["sort"]);
        }else{
            $broker->vratiFilmove();
        }
    }
    
    
    if(!$broker->getRezultat()){
    $response["status"]="greska";
    }else{
        $response["filmovi"]=array();
        $response["status"]="200";
        while($zanr=$broker->getRezultat()->fetch_object()){
            $response["filmovi"][]=$zanr;
        }
    }
    echo json_encode($response);
}
if(isset($_POST["metoda"])){
    if($_POST["metoda"]=="obrisi"){
        $broker->obrisiFilm($_POST["id"]);
        if(!$broker->getRezultat()){
            echo "greska";
        }else{
            echo "200";
        }
    }
    if($_POST["metoda"]=="izmeni"){
        $naziv=$_POST["naziv"];
        $ocena=$_POST["ocena"];
        $zanr=$_POST["zanr"];
        $duzina=$_POST["duzina"];
        $id=$_POST["id"];
        if(!validanFilm($naziv,$duzina,$ocena,$zanr)){
            echo "Film nije validan";
            exit;
        }
        $broker->izmeniFilm($id,$naziv,$duzina,$zanr,$ocena);
        if(!$broker->getRezultat()){
            echo "greska";
        }else{
            echo "200";
        }
    }
}
function validanFilm($naziv,$duzina,$ocena,$zanr){
    $naziv=trim($naziv);
    $duzina=trim($duzina);
    $ocena=trim($ocena);
    $zanr=trim($zanr);
    return intval($ocena) && intval($zanr) && intval($duzina) && intval($duzina)>0 && strlen($naziv)<40 && strlen($naziv)>5 ;
}

?>