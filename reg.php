<?php
session_start();
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/stil.css">
</head>
<body>

<p class="naslov"> Registracija </p>

<div class id = "navigacija">

<div class = "navig">
<a href="objave.php" class="link">Timeline</a>
</div>

<div class = "navig">
<a href="unos_objave.php" class="link">Unos objave</a>
</div>

 <?php
    if(!isset($_SESSION["id_aut"]))
    {
echo "<div class = navig>";
echo "<a href='reg.php' class='link'>Registracija</a>";
echo "</div>";

echo "<div class = navig>";
echo "<a href='login.php' class=link>Prijava</a>";
echo "</div>";
    }
        ?>

</div>
<div id = "autori">
<?php
include 'dohvacanje.php';

$autori = dohvatiAutore();
foreach($autori as $autor)
{
echo "<div class='autor'>";

echo "<div class='korime'> <a href='objave.php?korisnik=" . $autor->id . "' id ='linkOsobniProfil'> " . $autor->korime . " </a> (objava:  ";
$zaIspisati;
$autor->brojObjava == 0 ? $zaIspisati = "<span style='color:red'>" : $zaIspisati = "<span style='color:blue'>";
echo $zaIspisati . $autor->brojObjava .  "</span> ) </div>";

echo "</div>";
}
?>
<center>
<div class='autorADD'>
<p class="korimeADD"> Registriraj se: </p>
Datum pristupa: 
<?php 
echo date("d.m.Y H:i:s"). "<br><br>";
?>
<form action="unos_autora.php" method="post">
Korisnicko ime: <input type="text" name="username"><br><br>
Lozinka: <input type="password" name="password"><br><br>
Ponovi lozinku: <input type="password" name="password2"><br><br>
Ime: <input type="text" name="name"><br><br>
Prezime: <input type="text" name="lastname"><br><br>
E-mail: <input type="text" name="email"><br><br>
Datum rodjenja: <input type="date" name="datrodjenja"><br><br>
<input class = "submitButton" type="submit" value = "Registracija!">
</form>
</div>
</center>
</div>


</body>
</html>