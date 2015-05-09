<?php
class Objava
{
	public $id;
	public $naslov;
	public $post;
	public $autor;
	public $id_autor;
	public $oznake;
	public $datumObjave;
	
	function __construct($inId = null, $inNaslov = null, $inObjava = null, $inIdAutor = null, $inDatumObjave = null)
	{
		$this->id = $inId;
		$this->naslov = $inNaslov;
		$this->post = $inObjava;
		$this->id_autor = $inIdAutor;
		
		$date = new DateTime($inDatumObjave);
		$this->datumObjave = date_format($date, 'd.m.Y, H:i:s');
		
		$query = mysql_query("SELECT korime FROM autori WHERE id = " . $inIdAutor);
		$row = mysql_fetch_assoc($query);
		$this->autor = $row["korime"];
	}
}
class Autor
{
	public $id;
	public $ime;
	public $prezime;
	public $korime;
	public $lozinka;
	public $emailadresa;
	public $datrodjenja;
	public $datpristupa;
	public $brojObjava;
	
	function __construct($inId = null, $inIme = null, $inPrezime = null, $inKorime = null, $inLozinka = null, $inEmail = null, $inDatrodjenja = null, $inDatumPristupa = null)
	{
		$this->id = $inId;
		$this->ime = $inIme;
		$this->prezime = $inPrezime;
		$this->korime = $inKorime;
		$this->lozinka = $inLozinka;
		$this->emailadresa = $inEmail;
		
		$query = mysql_query("SELECT id FROM objave WHERE id_autor = " . $inId .";");
		$rez = mysql_num_rows($query);
		$rez >0 ? $this->brojObjava=$rez : $this->brojObjava='nema';
		
		$splitDate = explode("-", $inDatrodjenja);
		$this->datrodjenja = $splitDate[2] . "." . $splitDate[1] . "." . $splitDate[0];
		
		$date = new DateTime($inDatumPristupa);
		$this->datpristupa = date_format($date, 'd.m.Y, H:i:s');
		
	}
}
?>