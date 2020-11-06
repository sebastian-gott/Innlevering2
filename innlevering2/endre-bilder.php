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

<script src="ajax-finn-bilde.js"> </script>


<h3>Endre bilde (beskrivelse og flnavn) </h3>

<form method="post" action="" id="finnBildeSkjema" name="finnBildeSkjema">
   Bilde
  <select name="bildenr" id="bildenr">
    <?php include("dynamiske-funksjoner.php"); listeboksBildenr(); ?> 
  </select>  <br/>
  <input type="submit"  value="Finn bilde" name="finnBildeKnapp" id="finnBildeKnapp"> 
</form>

<?php
  if (isset($_POST ["finnBildeKnapp"]))
    {
      $bildenr=$_POST ["bildenr"]; 

      include("db-tilkobling.php");

      $sqlSetning="SELECT * FROM bilde WHERE bildenr='$bildenr';";
      $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen");

      $rad=mysqli_fetch_array($sqlResultat); 
      $bildenr=$rad["bildenr"];   
      $filnavn=$rad["filnavn"];    
      $beskrivelse=$rad["beskrivelse"]; 

      print ("<form method='post' action='' id='endreBildeSkjema' name='endreBildeSkjema'>");
      print ("Bildenr <input type='text' value='$bildenr' name='bildenr' id='bildenr' readonly /> <br />");
      print ("Filnavn <input type='text' value='$filnavn' name='filnavn' id='filnavn' readonly /> <br />");
      print ("Nytt filnavn <input type='text' value='$filnavn' name='nyttFilnavn' id='nyttFilnavn' required /> <br />"); 
      print ("Beskrivelse <input type='text' value='$beskrivelse' name='beskrivelse' id='beskrivelse' required /> <br />");
      print ("<input type='submit' value='Endre bilde' name='endreBildeKnapp' id='endreBildeKnapp'>");
      print ("</form>");
    }
	
  if (isset($_POST ["endreBildeKnapp"]))
    {
      $bildenr=$_POST ["bildenr"];
      $filnavn=$_POST ["filnavn"];
      $nyttFilnavn=$_POST ["nyttFilnavn"]; 
      $beskrivelse=$_POST ["beskrivelse"]; 
	  
      if (!$bildenr || !$filnavn || !$beskrivelse)
        {
          print ("Alle felt m&aring; fylles ut");  

        }
      else
        {
          include("db-tilkobling.php");

          $gammeltNavn="bilder/".$filnavn;
          $nyttNavn="bilder/".$nyttFilnavn;
          rename ($gammeltNavn,$nyttNavn) or die ("ikke mulig &aring; endre navn på bildefilen"); 

          $sqlSetning="UPDATE bilde SET filnavn='$nyttFilnavn' , beskrivelse='$beskrivelse' WHERE bildenr='$bildenr';";
          mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; endre data i databasen");				
          print ("Bildet med bildenr $bildenr er n&aring; endret<br />");
        }
    }
?>  

</article> 
    <br class="clearfloat" />  
    
  </div>
</body>
</html> 