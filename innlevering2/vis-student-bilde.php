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

    <h3>Velg klassekode</h3>
      </div>
      <form method="post" action="" id="bildeliste" name="bildeliste">
      Klasser

          <select name="klassekode" id="klassekode"> 
          <option value="velgklasse">Velg klasse </option>
          <?php include("dynamiske-funksjoner.php"); listeboksKlassekode();?> 
          </select> <br>
          <input type="submit" value="Hent informasjon" name="submit" id="submit">

      </form>

      <?php
  if (isset($_POST ["submit"]))
    {
      $klassekode=$_POST ["klassekode"];
      if (!$klassekode)
        {
           print ("Poststed ikke valgt <br />");
        }
        else
        {
           print ("F&oslash;lgende poststed er valgt: $klassekode <br />");
        }	
    }
?> 

<?php
include("db-tilkobling.php"); 

if (isset($_POST ["submit"])) {


    $klassekode = $_POST["klassekode"];


    $sqlSetning = "SELECT student.etternavn, student.fornavn, bilde.filnavn
               FROM student 
               INNER JOIN bilde
               ON student.bildenr = bilde.bildenr
               WHERE klassekode = '$klassekode';";

    $sqlResultat = mysqli_query ($db, $sqlSetning) or die ("ikke mulig &aring; hente data fra databasen");

    print ("<h3>Registrerte bilder </h3>");

    print ("<table border=1>");
    print ("<tr><th align=left>etternavn</th> <th align=left>fornavn</th> <th align=left>filnavn</th></tr>");

    $antallRader = mysqli_num_rows ($sqlResultat);

    for ( $r = 1; $r <= $antallRader; $r++ ) {
        $rad = mysqli_fetch_array ($sqlResultat);
        $etternavn = $rad["etternavn"];
        $fornavn = $rad["fornavn"];
        $filnavn = $rad["filnavn"];


        print ("<tr> <td> $etternavn </td> <td> $fornavn </td>  <td> <a href='bilder/$filnavn' target='_blank'>$filnavn </a> </td> </tr>");
    }

}

print ("</table>");

?>

</article> 
    <br class="clearfloat" />  
    
  </div>
</body>
</html> 