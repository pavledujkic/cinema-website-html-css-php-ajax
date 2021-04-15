<?php
    include "broker.php";
    $broker=Broker::getBroker();
    if(isset($_POST)){
        $naziv=$_POST["naziv"];
        $ocena=$_POST["ocena"];
        $zanr=$_POST["zanr"];
        $duzina=$_POST["duzina"];
        if(!validanFilm($naziv,$duzina,$ocena,$zanr)){
            echo "Film nije validan";
        }else{
            $filename =(isset($_FILES['slika']))?$_FILES['slika']['name']:"";
            $location = "./img/".$filename;
            if(!move_uploaded_file($_FILES['slika']['tmp_name'],$location)){
                $location="";
            }
            $broker->dodajFilm($naziv,$duzina,$zanr,$ocena,$location);
            if(!$broker->getRezultat()){
                echo "greska";
            }else{
                echo "Ubaceno";
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