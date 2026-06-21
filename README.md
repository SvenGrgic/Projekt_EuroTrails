
PROJEKT ZA KOLEGIJ PROGRAMIRANJE WEB APLIKACIJA
EuroTrails - projekt na temelju bloga/news bloga.
Autor: Sven Grgić
-----------------------------------------------------------------------------------------------------------------------

-----------------------------------------------------------------------------------------------------------------------
Za svaku fazu postoji odvojen folder, te je najbolje extract-ati cijeli "Projekt - EuroTrails - Sven Grgić".zip na localhost na xampp.
Unutar test_faza_3 i test_faza_4 nalaze se eurotrails.sql datoteke koje je potrebno import-ati na localhost.
Nije bitno koja se od dvije navedene import-a, obije su identične po sadržaju.
Faze su odvojene u zasebne foldere zbog lakoće pristupa i lakše provjere izmjena i zadataka.
-----------------------------------------------------------------------------------------------------------------------

----------------------------------------------------------------------------------------------------------------------- 
1. faza: HTML i CSS
Napravljen index.html, te zasebni .html dokumenti u kojima se nalaze članci. 
Napravljen zaseban style.css koji se koristi kao tematika tokom cijelog projekta.
-----------------------------------------------------------------------------------------------------------------------

-----------------------------------------------------------------------------------------------------------------------
2. faza: PHP skripta
Dodan je unos pomoću PHP-a, skripta.php.
Članak koji se napravi pomoću skripte nije nigdje spremljen nego ga samo tada prikaže.
U uputama za 2. fazu ne piše da je taj novi članak bitno spremati, nego da se gleda radi li <form>.
-----------------------------------------------------------------------------------------------------------------------

-----------------------------------------------------------------------------------------------------------------------
3. faza: MySQL
Dodana baza podataka u koju se spremaju unesene promjene na člancima. 
Logika je prenesena u isključivo .php datoteke koje su zamjenile stare, fiksne .html članke.
-----------------------------------------------------------------------------------------------------------------------

-----------------------------------------------------------------------------------------------------------------------
4. faza: Sigurnost
Uvedena sigurnost i zaštita od SQL Injection napada.
Kao primjer sigurnosti pristupa izmjeni članaka, napravljena su 2 korisnika, gost i admin. 
Za login gost - korisnička oznaka: gost, lozinka: gostpass
Za login admin - korisnička oznaka: admin, lozinka: adminpass
Svi unosi nekih podataka prebačeni su na prepared statement način obrade podataka.
-----------------------------------------------------------------------------------------------------------------------
