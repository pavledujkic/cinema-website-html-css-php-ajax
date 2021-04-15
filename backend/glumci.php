<?php

include "broker.php";
$broker=Broker::getBroker();

if(isset($_GET["metoda"])){
    if($_GET["metoda"]=="vratiSve"){
        $broker->vratiGlumce();
        $res=array();
        
        if(!$broker->getRezultat()){
            $res["status"]="greska";
        }else{
            $res["status"]="200";
            $res["glumci"]=array();
            while($glumac=$broker->getRezultat()->fetch_object()){
                $res["glumci"][]=$glumac;
            }
        }
        echo json_encode($res);
    }
    if($_GET["metoda"]=="vrati iz filma"){
        $broker->vratiIzFilma($_GET["film"]);
        $res=array();
        
        if(!$broker->getRezultat()){
            $res["status"]="greska";
        }else{
            $res["status"]="200";
            $res["glumci"]=array();
            while($glumac=$broker->getRezultat()->fetch_object()){
                $res["glumci"][]=$glumac;
            }
        }
        echo json_encode($res);
    }

}
if(isset($_POST["metoda"])){
    if($_POST["metoda"]=="obrisi"){
        $broker->obrisiGlumca($_POST["id"]);
        if(!$broker->getRezultat()){
            echo "greska";
        }else{
            echo "200";
        }
    }
    if($_POST["metoda"]=="izmeni"){
        if(!validanGlumac($_POST["ime"],$_POST["prezime"],$_POST["starost"])){
            echo "Glumac nije validan";
            exit;
        }
        $broker->izmeniGlumca($_POST["id"],$_POST["ime"],$_POST["prezime"],$_POST["starost"]);
        if(!$broker->getRezultat()){
            echo "greska";
        }else{
            echo "200";
        }
    }
    if($_POST["metoda"]=="dodaj"){
        if(!validanGlumac($_POST["ime"],$_POST["prezime"],$_POST["starost"])){
            echo "Glumac nije validan";
            exit;
        }
        $broker->dodajGlumca($_POST["ime"],$_POST["prezime"],$_POST["starost"]);
        if(!$broker->getRezultat()){
            echo "greska";
        }else{
            echo "200";
        }
    }
    if($_POST["metoda"]=="dodajUlogu"){
        $broker->dodajUlogu($_POST["film"],$_POST["glumac"]);
        if(!$broker->getRezultat()){
            echo "greska";
        }else{
            echo "200";
        }
    }
    if($_POST["metoda"]=="izbaciUlogu"){
        $broker->izbaciUlogu($_POST["film"],$_POST["glumac"]);
        if(!$broker->getRezultat()){
            echo "greska";
        }else{
            echo "200";
        }
    }
}
function validanGlumac($ime,$prezime,$starost){
    $god=intval(trim($starost));
    $ime=trim($ime);
    $prezime=trim($prezime);
    return $god<2019 && preg_match("/^[A-Z][a-z]{2,}$/",$ime) && preg_match("/^[A-Z][a-z]{2,}$/",$prezime);
}

?>