<html>
<head>
<link rel="stylesheet" type="text/css" href="css/stil.css">
</head>
<body>
<center>
<p class ="naslov"> Dodavanje autora </p>
</center>
<div class id = "navigacija">

<div class = "navig">
<a href="autori.php" class="link">Autori</a>
</div>

<div class = "navig">
<a href="objave.php" class="link">Objave</a>
</div>

</div>
<center>
<div id = "autori">


<div class='autorADD labelaADD'>
<?php
$connection = mysql_connect("localhost", "root", "") or die("");
$baza = "projektbaze2_blog";
mysql_select_db($baza, $connection);

$USERNAME = $_POST["username"];
$PASSWORD = $_POST["password"];
$PASSWORD2 = $_POST["password2"];

$paswordDobar = false;
$korimeDobro = true;

if($PASSWORD != $PASSWORD2)
{
	echo "Lozinke se ne podudaraju! <br>";
}
else
{
	$paswordDobar = true;
}

$query = mysql_query("SELECT korime FROM autori");
while($red = mysql_fetch_assoc($query))
{
	if($red["korime"] == $USERNAME)
	{
		echo "Korisnicko ime vec postoji!";
		$korimeDobro = false;
	}
}
if($paswordDobar==true && $korimeDobro==true)
{
	$query = "INSERT INTO autori(korime,lozinka,ime,prezime,email_adresa,datrodjenja) VALUES ('" . $USERNAME . "','" . $PASSWORD . "','" . $_POST["name"] . "','" . $_POST["lastname"] . "','" . $_POST["email"] . "','" . $_POST["datrodjenja"] . "');";

	if(mysql_query($query))
	{
		echo "<script> function myFunction() {	alert('Dodani ste kao autor u bazu! Sada mozete poceti sa objavljivanjem!');}	myFunction();</script>";
		header("Location: autori.php");
	}
	else{
		echo "Pogreska pri dodavanju u bazu!";
	}
}
?>
<p class="korimeADD"> Dodaj novog autora u bazu: </p>
Datum pristupa: 
<?php 
echo date("d.m.Y, H:i:s"). "<br><br>";
?>
<form action="unos_autora.php" method="post">
Korisnicko ime: <input type="text" name="username"><br><br>
Lozinka: <input type="password" name="password"><br><br>
Ponovi lozinku: <input type="password" name="password2"><br><br>
Ime: <input type="text" name="name"><br><br>
Prezime: <input type="text" name="lastname"><br><br>
E-mail: <input type="text" name="email"><br><br>
Datum rodjenja: <input type="date" name="datrodjenja"><br><br>
<input class = "submitButton" type="submit" value = "Dodaj!">
</form>
</div>

</div>
</center>


</body>
</html>