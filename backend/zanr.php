<?php

include "broker.php";

$broker=Broker::getBroker();
if(isset($_GET)){
    $broker->vratiZanrove();
    $response=array();
    if(!$broker->getRezultat()){
    $response["status"]="greska";
    }else{
        $response["zanrovi"]=array();
        $response["status"]="200";
        while($zanr=$broker->getRezultat()->fetch_object()){
            $response["zanrovi"][]=$zanr;
        }
    }
    echo json_encode($response);
}

?>