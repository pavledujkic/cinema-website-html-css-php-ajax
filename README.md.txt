Opis aplikacije

Ova aplikacija predstavlja veb sajt koji služi za rad sa filmovima i glumcima. Aplikacijom su omogućene CRUD operacije nad filmovima i glumcima kao i njihovo povezivanje i razvezivanje.

Sajt se sastoji iz četiri stranice:
-	Index.html – početna stranica, ne sadrži ništa
-	filmovi.html – služi za prikaz, izmenu i brisanje  filmova i povezivanje i razvezivanje glumaca i filmova. Prilikom učitavanja stranice šalje se GET zahtev za svim filmovima iz baze. Kada podaci stignu sa servera vrši se njihov prikaz u vidu kartica. Svaki film ima dugme izbriši(POST zahtev za brisanjem)  i izmeni. Klikom na dugme izmeni otvara se modalna forma sa popunjenim podacima od filma. Sa desne strane nalazi se lista glumaca u filmu kao i padajući meni sa svim glumcima i dugmići dodaj i obriši koji pozivaju server da uradi pomenute akcije . Klikom na dugme izmeni šalje se POST zahtev za ažuriranjem filma.
-	glumci.html – služi za prikaz, dodavanje, izmenu glumaca u bazi. Sadrži tabelu svih glumaca i formu za unos novog glumca.  Sve CRUD se izvršavaju na isti način kao i u prošlom slučaju sa tim što se pri učitavanju stranice.
-	dodajFilm.html – sadrži formu za unos novog filma. Pri učitavanju šalje se GET zahtev za svim žanrovima, a klikom na dugme šalje se POST zahtev za dodavanjem novog filma u bazu.

Za povezivanje sa serverom koriste se AJAX tehnologije implementirane u jQuery – ju.

Na serveru imamo pet fajla i to:
-	broker.php – služi za konekciju na bazu. 
-	filmovi.php – služi za obradu zahteva vezanih za filmove. Prilikom obrade GET zahteva poziva se broker da vrati podatke iz baze koje se, zatim, pakuju u JSON i kao takve šalju klijentu. Prilikom obrade UPDATE zahteva prvo se vrši validacija podataka pa se tek onda, ako su podaci dobri, poziva broker, a kao odgovor šalje se poruka o tome da li je operacija uspešno izvršena.
-	glumci.php – služi za obradu zahteva vezanih za glumce. Sam proces rada je gotovo identičan kao kod fajla filmovi.php.
-	zanrovi.php – obrađuje samo GET zahtev za svim žanrovima iz baze koje šalje u JSON formatu.
-	dodajFilm.php – prihvata podatake o filmu, skida sliku, validira podatke (isti uslovi kao i za UPDATE) i poziva brokera da ih zapamti.
