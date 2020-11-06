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

    <script src="funksjoner.js"> </script>

    <?php  /* slett-bilde */
/*
/*  Programmet lager et skjema for Ã¥ velge et bilde som skal slettes  
/*  Programmet sletter det valgte bildet
*/
?> 

<script src="funksjoner.js"> </script>

<h3>Slett bilde</h3>

<form method="post" action="" id="slettBildeSkjema" name="slettBildeSkjema" onSubmit="return bekreft()">
  Bilde
  <select name="bildenrfilnavn" id="bildenrfilnavn">
    <?php include("dynamiske-funksjoner.php"); listeboksBildenrFilnavn(); ?> 
  </select>  <br/>
  <input type="submit" value="Slett bilde" name="slettBildeKnapp" id="slettBildeKnapp" /> 
</form>

<?php
  if (isset($_POST ["slettBildeKnapp"]))
    {
      $bildenrfilnavn=$_POST ["bildenrfilnavn"];

      $del=explode(";",$bildenrfilnavn);
      $bildenr=$del[0];
      $filnavn=$del[1];  

      include("db-tilkobling.php");
		
      $sqlSetning="DELETE FROM bilde WHERE bildenr='$bildenr';";
      mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; slette data i databasen");
        /* bilde slettet i databasen*/
		
      $bildefil="bilder/".$filnavn;
      unlink($bildefil) or die ("ikke mulig &aring; slette bilde pÃ¥ serveren");
        /* bilde slettet fra serveren */

      print ("F&oslash;lgende bilde er n&aring; slettet: $bildenr $filnavn <br />");
    }
?> 