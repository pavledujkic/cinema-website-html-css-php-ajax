<?php

    class Broker{
        private $rezultat;
        private $mysqli;
        private static $broker;
        public function getRezultat(){
            return $this->rezultat;
        }
        private function __construct(){
            $this->mysqli = new mysqli("localhost","root","","baza_filmova");
            $this->mysqli->set_charset("utf8");
        }
    
        public static function getBroker(){
            if(!isset($broker)){
                $broker=new Broker();
            }
            return $broker;
        }
        
        private function izvrsiUpit($upit){
            $this->rezultat=$this->mysqli->query($upit);
        }
        public function vratiZanrove(){
            $this->izvrsiUpit("select * from zanr");
        }
        public function dodajFilm($naziv,$duzina,$zanr,$ocena,$location){
           if($location==""){
            $this->izvrsiUpit("insert into film (naziv,minuti_trajanja,ocena,zanr) values ('".$naziv."', ".$duzina.", ".$ocena.", ".$zanr." )");
           }else{
            $this->izvrsiUpit("insert into film (naziv,minuti_trajanja,ocena,zanr,slika) values ('".$naziv."' ,".$duzina.", ".$ocena.", ".$zanr.", '".$location."')");
           }
        }
        public function vratiGlumce(){
            $this->izvrsiUpit("select * from glumac ");
        }
        public function obrisiGlumca($id){
            $this->izvrsiUpit("delete from glumac where id=".$id);
        }
        public function dodajGlumca($ime,$prezime,$starost){
            $this->izvrsiUpit("insert into glumac (ime,prezime,starost) values ('".$ime."','".$prezime."',".$starost.")");
        }
        public function izmeniGlumca($id,$ime,$prezime,$starost){
            $this->izvrsiUpit("update glumac set ime='".$ime."', prezime='".$prezime."', starost=".$starost." where id=".$id);
        }
        public function vratiFilmove(){
            $this->izvrsiUpit("select f.*, z.naziv as 'zanr_naziv' from film f inner join zanr z on (f.zanr=z.id)  ");
        }
        public function obrisiFilm($id){
            $this->izvrsiUpit("delete from film where id=".$id);
        }
        public function vratiIzFilma($film){
            $this->izvrsiUpit("select g.* from glumac g inner join angazovanje a on (g.id=a.glumac) where a.film=".$film);
        }
        public function izmeniFilm($id,$naziv,$duzina,$zanr,$ocena){
            $this->izvrsiUpit("update film set naziv='".$naziv."', zanr=".$zanr.", ocena=".$ocena.", minuti_trajanja=".$duzina." where id=".$id);
        }
        public function vratiFilmoveIzKategorije($zanr,$sort){
            if($sort!=""){
                $this->izvrsiUpit("select f.*, z.naziv as 'zanr_naziv' from film f inner join zanr z on (f.zanr=z.id) where z.id=".$zanr." order by naziv ".$sort);
            }else{
                $this->izvrsiUpit("select f.*, z.naziv as 'zanr_naziv' from film f inner join zanr z on (f.zanr=z.id) where z.id=".$zanr);
            }
        }
        public function vratiFilmoveSortirano($sort,$zanr){
           if($zanr>0){
            $this->izvrsiUpit("select f.*, z.naziv as 'zanr_naziv' from film f inner join zanr z on (f.zanr=z.id) where z.id=".$zanr." order by naziv ".$sort);
           }else{
            $this->izvrsiUpit("select f.*, z.naziv as 'zanr_naziv' from film f inner join zanr z on (f.zanr=z.id) order by naziv ".$sort);
           }
        }
        public function dodajUlogu($film,$glumac){
            $this->izvrsiUpit("insert into angazovanje (film,glumac) values (".$film.",".$glumac.")");
        }
        public function izbaciUlogu($film,$glumac){
            $this->izvrsiUpit("delete from angazovanje where  film=".$film." and glumac=".$glumac);
        }
    }


?>