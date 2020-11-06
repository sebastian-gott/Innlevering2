<?php
session_start();
@$innloggetBruker=$_SESSION["brukernavn"]; 
  
if (!$innloggetBruker)  /* bruker er ikke innlogget */
 {
  print("<meta http-equiv='refresh' content='0;url=innlogging.php'>");
 }
 ?>


<!DOCTYPE HTML>
<html>
<head>
  <title>Obligatorisk Oppgave 1</title>
  <link rel="stylesheet" type="text/css" href="stylesheet.css" media="screen" title="Stilark" /> 
</head>

<body class="gbStil">

  <div id="boks">
  
    <header>
      <h1>Obligatorisk Oppgave 2</h1>
    </header>
    
    <nav>
      <h3>Meny</h3>
      <p><a href="index.php">Hjem</a></p>
      <p>Registrer</p>
      <p><a href="registrer-klasse.php">Registrer klasse</a></p>
      <p><a href="registrer-bilde.php">Registrer bilde</a></p>
      <p><a href="registrer-student.php">Registrer student</a></p>
      <p>Vis</p>
      <p><a href="vis-klasser.php">Vis klasser</a></p>
      <p><a href="vis-bilder.php">Vis bilder</a></p>
      <p><a href="vis-student.php">Vis studenter </a></p>
      <p>Endre</p>
      <p><a href="endre-klasser.php">Endre i klasser</a></p>
      <p><a href="endre-bilder.php">Endre i bilder</a></p>
      <p><a href="endre-studenter.php">Endre i studenter </a></p>
      <p>Slette</p>
      <p><a href="slett-klasse.php">Slett i klasser</a></p>
      <p><a href="slett-bilde.php">Slett i bilder</a></p>
      <p><a href="slett-student.php">Slett i studenter </a></p>
      <p>Søk</p>
      <p><a href="sok-database.php">Søk i database </a></p>
      <p><a href="vis-student-bilde.php"> Vis klasseliste </a></p>
      <p>Brukervalg</p>
      <p><a href="utlogging.php"> Logg ut </a><p>

    </nav>
    
    <article>

    <?php  
?> 

<?php  
?> 

<script src="ajax-finn-klasse.js"> </script>

<h3>Endre i klasse</h3>

<form method="post" action="" id="endreKlasseSkjema" name="endreKlasseSkjema">

 klassekode <select name="klassekode" id="klassekode" onChange="finn(this.value)">
 <?php print("<option value=''>Velg klassekode </option>");
 include("dynamiske-funksjoner.php"); listeboksKlassekode(); ?>
 </select> <br/>

 Klassenavn <input type="text" id="klassenavn" name="klassenavn" required /> <br/>
 studiumkode <input type="text" id="studiumkode" name="studiumkode" required /> <br/>
 <input type="submit" value="Endre klasse" name="endreKlasseKnapp" id="endreKlasseKnapp">
 <input type="reset" value="Nullstill" id="nullstill" name="nullstill" /> <br />
</form>
<?php


 if (isset($_POST ["endreKlasseKnapp"]))
 {
    $klassekode=$_POST["klassekode"];
    $klassenavn=$_POST ["klassenavn"];
    $studiumkode=$_POST ["studiumkode"];
 if (!$klassekode || !$klassenavn || !$studiumkode)
 {
 print ("Alle felt m&aring; fylles ut");
 }
 else
 {
 include("db-tilkobling.php"); /* tilkobling til database-serveren utført og valg av database foretatt */
 $sqlSetning="UPDATE klasse SET klassenavn='$klassenavn', studiumkode='$studiumkode' WHERE klassekode='$klassekode';";
 mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; endre data i databasen");
 /* SQL-setning sendt til database-serveren */
 print ("Klasse med klassekode $klassekode er n&aring; endret<br />");
 }
 }
?> 




</article> 
    <br class="clearfloat" />  
    
  </div>
</body>
</html> 