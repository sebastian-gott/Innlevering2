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

  include("db-tilkobling.php");  /* tilkobling til database-serveren utført og valg av database foretatt */
  
  $sqlSetning="SELECT * FROM klasse;";
  $sqlResultat=mysqli_query($db, $sqlSetning) or die ("Ikke mulig å hente fra database");
  $antallRader=mysqli_num_rows($sqlResultat); 

  print ("<h3>Registrerte klasser</h3>");
  print ("<table border=1>");  
  print ("<tr><th align=left>klassekode</th> <th align=left>klassenavn</th> <th align=left>studiumkode</th> </tr>"); 

  for ($r=1;$r<=$antallRader;$r++)
    {
      $rad=mysqli_fetch_array($sqlResultat);
      $klassekode=$rad["klassekode"]; //eller $rad=["0"]
      $klassenavn=$rad["klassenavn"]; //eller $rad=["1"]
      $studiumkode=$rad["studiumkode"]; //eller $rad=["2"]
      print ("<tr> <td> $klassekode </td> <td> $klassenavn </td><td> $studiumkode </td> </tr>");
    }
  print ("</table>"); 
?>


</article> 
    <br class="clearfloat" />  
    
  </div>
</body>
</html> 

