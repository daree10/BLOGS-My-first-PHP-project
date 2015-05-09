<?php
session_start();
if(!isset($_SESSION["id_aut"]))
{
    header("Location: login.php");
}
?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="css/stilObjave.css">
</head>
<body>
<div id="naslov" class='time'>
<h1>Dodavanje objave</h1>
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

<form action="unos_objave.php" method="post" id="usrform">
<div class='autorADD labelaADD'>
<?php
$connection = mysql_connect("localhost", "root", "") or die("");
$baza = "projektbaze2_blog";
mysql_select_db($baza, $connection);

if(isset($_POST["submit2"]))
{
    
	$posat = str_replace("'",'',$_POST["posat"]);
	mysql_query("INSERT INTO objave(naslov,tekst_objave,id_autor) VALUES ('" . $_POST["title"] . "','" . $posat . "'," . $_SESSION["id_aut"] . ");");
	$idUmetnuteObjave = mysql_insert_id();

	$stringOznaka = str_replace(' ', '', $_POST["tags"]);
	$poljeOznaka = explode(",",$stringOznaka);
	
	$queryOznake = mysql_query("SELECT opis FROM oznake");
	$poljeOznakauBazi = array();
	while($row = mysql_fetch_assoc($queryOznake))
	{
		array_push($poljeOznakauBazi, $row["opis"]);
	}
	
	foreach($poljeOznaka as $oznaka)
	{
		$nalaziSe = false;
		foreach($poljeOznakauBazi as $oznakauBazi)
		{
			if($oznakauBazi == $oznaka)
			{
				$nalaziSe = true;
			}
		}
		if($nalaziSe == false)
		{
			mysql_query("INSERT INTO oznake(opis) VALUES('" . $oznaka . "');");
		}
		$que = mysql_query("SElECT id FROM oznake WHERE opis = '" . $oznaka . "';");
		$row = mysql_fetch_assoc($que);
		$idOznaka = $row["id"];
		mysql_query("INSERT INTO objave_oznake(id_objava, id_oznaka) VALUES('" . $idUmetnuteObjave . "','" . $idOznaka . "');");
	}
	
	header("Location: objave.php");

}
?>


<br><br>
Datum objave: 
<?php 
echo date("d.m.Y, H:i:s"). "<br><br>";
?>
Naslov: <input type="text" name="title"><br><br>
Tekst:
<br>
<textarea rows="10" cols="50" name="posat" form="usrform">
</textarea>
<br>
Oznake (odvojene zarezima):
<textarea rows="2" cols="50" name="tags" form="usrform">
</textarea>
<br>
<input class = "submitButton" name="submit2" type="submit" value = "Dodaj!">
</form>

</div>

</div>


</body>
</html>