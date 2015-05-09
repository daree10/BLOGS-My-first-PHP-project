<?php
include 'klasaObjava.php';

$connection = mysql_connect("localhost", "root", "") or die("");
$baza = "projektbaze2_blog";
mysql_select_db($baza, $connection);

function dohvatiAutore($inId = null)
{
	if(!empty($inId))
	{
		$query = mysql_query("SELECT id, ime, prezime, korime, lozinka, email_adresa, datrodjenja FROM autori WHERE id = " . $inId . " ORDER BY id DESC");
	}
	
	else
	{
		$query = mysql_query("SELECT id, ime, prezime, korime,lozinka, email_adresa, datrodjenja FROM autori ORDER BY id ASC");
	}
	
	$popisAutora = array();
	while($row = mysql_fetch_assoc($query))
	{
		$autor1 = new Autor($row['id'], $row['ime'], $row["prezime"], $row["korime"], $row['lozinka'], $row["email_adresa"], $row["datrodjenja"]);
		array_push($popisAutora, $autor1);
	}
	return $popisAutora;
}

function dohvatiObjave($inId = null, $inIdAutora = null, $inOznaka=null)
{
	if(!empty($inId))
	{
		$query = mysql_query("SELECT id,naslov, tekst_objave, datum_objave, id_autor FROM objave WHERE id = ". $inId ." ORDER BY datum_objave DESC");
	}
	
	elseif(!empty($inIdAutora))
	{
		$query = mysql_query("SELECT id,naslov, tekst_objave, datum_objave, id_autor FROM objave WHERE id_autor = ". $inIdAutora ." ORDER BY datum_objave DESC");
	}
	
	elseif(!empty($inOznaka))
	{
		$query = mysql_query("SELECT objave.id, `naslov`, `tekst_objave`, `datum_objave`, `id_autor` FROM `objave` INNER JOIN `objave_oznake` ON (objave.id=objave_oznake.id_objava) INNER JOIN oznake ON(objave_oznake.id_oznaka = oznake.id) WHERE oznake.opis='" . $inOznaka . "' ORDER BY datum_objave DESC;");
	}
	
	else
	{
		$query = mysql_query("SELECT id, naslov, tekst_objave, datum_objave, id_autor FROM objave ORDER BY datum_objave DESC");
	}
	
	$popisObjava = array();
	while($row = mysql_fetch_assoc($query))
	{
		$objava = new Objava($row['id'], $row['naslov'], $row['tekst_objave'], $row['id_autor'], $row['datum_objave']);
		array_push($popisObjava, $objava);
	}
	return $popisObjava;
}

function dohvatiOznake($inIdObjave = null)
{
	$poljeOznaka = array();

	if(!empty($inIdObjave))
	{
		$poljeID = array();
		$query = mysql_query("SELECT id_oznaka FROM objave_oznake WHERE id_objava =" . $inIdObjave . ";");
		while($row = mysql_fetch_assoc($query))
		{
			array_push($poljeID, $row["id_oznaka"]);
		}
		foreach($poljeID as $ID)
		{
			$query = mysql_query("SELECT opis FROM oznake WHERE id =" . $ID . ";");
			$row = mysql_fetch_assoc($query);
			array_push($poljeOznaka, $row["opis"]);
		}
	}
	
	else
	{
		$query = mysql_query("SELECT opis FROM oznake;");
		while($row = mysql_fetch_assoc($query))
		{
			array_push($poljeOznaka, $row["opis"]);
		}
	}
	
	return $poljeOznaka;
}

?>