<?php
session_start();
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/stilObjave.css">
</head>
<body>
<div id="naslov">
<?php
include 'dohvacanje.php';
if(!empty($_GET['korisnik']))
{
	$autor = dohvatiAutore($_GET['korisnik']);
	echo "<h1>".$autor[0]->korime . " (" . $autor[0]->ime . " " . $autor[0]->prezime . ")</h1>";
	echo "<div id = 'labelaInfoKorisnik'> Kontakt: " . $autor[0]->emailadresa . " <br><br> Datum rodjenja: " . $autor[0]->datrodjenja . " <br><br> Datum pristupa: " . $autor[0]->datpristupa . "</div>";
	echo "<hr>";
}
if(!empty($_GET['oznaka']))
{
	echo "<h1 style='color:#1088EB'>#" . $_GET["oznaka"] . "</h1>";
	echo "<hr>";
}
?>
</div>

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
    else
    {
        echo "<div class = navig>";
echo "<a href='odjava.php' class=link>Odjava</a>";
echo "</div>";
    }
        ?>
</div>

<div id = "autori">
<?php
if(!empty($_GET['korisnik']))
{
	$objave = dohvatiObjave(null, $_GET['korisnik'], null);
}
elseif(!empty($_GET['oznaka']))
{
	$objave = dohvatiObjave(null, null, $_GET['oznaka']);
}
else
{
	$objave = dohvatiObjave();
}
echo "<h1 class = 'time'> Timeline</h1>";
foreach($objave as $objava)
{
	echo "<div class='objava'>";

	echo "<h1>" . $objava->naslov . "</h1>";
	echo "<p class='tekstObjave'>". $objava->post . "</p>";
	echo "<div id = 'labelaInfo'>";

	echo "<div id = 'tagInfo'>";
	echo "<div class = 'labelaTag'>";

	$oznake = dohvatiOznake($objava->id);
	foreach($oznake as $oz)
	{
		echo "<a href='objave.php?oznaka=" . $oz . "' class='tagLink'>#" . $oz . " </a>";
	}

	echo "</div>";
	echo "</div>";

	echo "<div class = 'labela'> Objavio: <span class = 'infoObjava'>  <a href='objave.php?korisnik=" . $objava->id_autor . "' id ='linkOsobniProfil'>" . $objava->autor . " </a></span>, dana i sata: <span class = 'infoObjava'>" . $objava->datumObjave . "</span> </div>";
	echo "</div>";

	echo "</div>";
	}
if(!empty($_GET['oznaka']))
{
	
echo "<h1 class = 'time'> Sve oznake</h1>";
$oznake = dohvatiOznake(null);
foreach($oznake as $oz)
{
	echo "<a href='objave.php?oznaka=" . $oz . "' class='tagLink'>#" . $oz . " </a>";
}
}

?>

</div>


</body>
</html>