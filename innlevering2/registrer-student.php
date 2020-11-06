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

<h3>Registrer student </h3>

<form method="post" action="" id="registrerStudentSkjema" name="registrerStudentSkjema">
  Brukernavn <input type="text" id="brukernavn" name="brukernavn" required /> <br/>
  Fornavn <input type="text" id="fornavn" name="fornavn" required /> <br/>
  Etternavn <input type="text" id="etternavn" name="etternavn" required /> <br/>
  Klassekode <select name="klassekode" id="klassekode">
 <?php print("<option value=''>velg klasse </option>");
 include("dynamiske-funksjoner.php"); listeboksKlassekode(); ?>
 </select> <br/>
  Bildenr <select name="bildenr" id="bildenr">
 <?php print("<option value=''>velg bildenr </option>"); listeboksBildenr(); ?>
 </select> <br/>
  <input type="submit" value="Registrer student" id="registrerStudentKnapp" name="registrerStudentKnapp" /> 
  <input type="reset" value="Nullstill" id="nullstill" name="nullstill" /> <br />
</form>

<?php 
  if (isset($_POST ["registrerStudentKnapp"]))
    {
      $brukernavn=$_POST ["brukernavn"];
      $fornavn=$_POST ["fornavn"];
      $etternavn=$_POST ["etternavn"];
      $klassekode=$_POST ["klassekode"];
      $bildenr=$_POST ["bildenr"];

      if (!$brukernavn || !$fornavn || !$etternavn || !$klassekode || !$bildenr)
        {
          print ("Brukernavn, fornavn, etternavn, klassekode og bildenr m&aring; fylles ut");

        }
      else
        {
          include("db-tilkobling.php");
          $sqlSetning="SELECT * FROM student WHERE brukernavn='$brukernavn'; ";
          $sqlResultat=mysqli_query($db, $sqlSetning) or die ("Ikke mulig å hente fra database");
          $antallRader=mysqli_num_rows($sqlResultat);
          if ($antallRader!=0)  
            {
              print ("Student er registrert fra f&oslashr");
            }
          else
            {
              $sqlSetning="INSERT INTO student VALUES('$brukernavn', '$fornavn', '$etternavn', '$klassekode', '$bildenr'); ";
              mysqli_query($db, $sqlSetning) or die ("Ikke mulig å hente fra database");
              
              print ("F&oslash;lgende bilde er n&aring; registrert: $brukernavn $fornavn $etternavn $klassekode $bildenr"); 
            }
        }
    }
?> 

</article> 
    <br class="clearfloat" />  
    
  </div>
</body>
</html> 