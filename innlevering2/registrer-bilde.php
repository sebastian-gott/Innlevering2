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

    <h3>Registrer bilde </h3>

<form method="post" action="" enctype="multipart/form-data" id="registrerBildeSkjema" name="registrerBildeSkjema">
  Bildenr <input type="text" id="bildenr" name="bildenr" required /> <br/>
  Beskrivelse <input type="text" id="beskrivelse" name="beskrivelse" required /> <br/>
  Opplastningsdato <input type="date" id="opplastningsdato" name="opplastningsdato" required /> <br />
  Bilde <input type="file" id="fil" name="fil" size="60"/> <br />
  <input type="submit" value="Registrer bilde" id="registrerBildeKnapp" name="registrerBildeKnapp" /> 
  <input type="reset" value="Nullstill" id="nullstill" name="nullstill" /> <br />
</form>

<?php 
  if (isset($_POST ["registrerBildeKnapp"]))
    {
      $bildenr=$_POST ["bildenr"];
      $opplastningsdato=$_POST['opplastningsdato'];
      $beskrivelse=$_POST ["beskrivelse"]; 

      $filnavn=$_FILES ["fil"]["name"];  
      $filtype=$_FILES ["fil"]["type"];  	
      $filstorrelse=$_FILES ["fil"]["size"];  
      $tmpnavn=$_FILES ["fil"]["tmp_name"];    
      $nyttnavn="bilder/".$filnavn;  

      if (!$bildenr || !$opplastningsdato || !$beskrivelse || !$filnavn )
        {
          print ("Alle felt m&aring; fylles ut og bilde m&aring; velges"); 
        }
      else if ($filtype != "image/gif" && $filtype != "image/jpeg" && $filtype != "image/png")
        {
          print ("Det er kun tillatt &aring; laste opp bilder ");
        }
      else if ($filstorrelse > 5000000)    
        {
          print ("Bildet er for stor til &aring; kunne lastes opp ");
        }
      else
        {
          include("db-tilkobling.php"); 

          $sqlSetning="SELECT * FROM bilde WHERE bildenr='$bildenr';";
          $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen");
          $antallRader=mysqli_num_rows($sqlResultat); 
              
          if ($antallRader!=0)  
            {
              print ("Bildenummeret er registrert fra f&oslashr");
            }
          else
            {
              move_uploaded_file($tmpnavn,$nyttnavn) or die ("ikke mulig &aring; laste opp fil");  
               
					
              $sqlSetning="INSERT INTO bilde VALUES('$bildenr', '$opplastningsdato', '$filnavn', '$beskrivelse');";
              if (mysqli_query($db,$sqlSetning)) 
                {
                  print ("F&oslash;lgende bilde er n&aring; registrert:<br/> bildenr: $bildenr <br/> opplastningsdato: $opplastningsdato <br /> filavn: $filnavn <br/> beskrivelse:$beskrivelse <br/>");
                }
              else
                {
                  print ("ikke mulig &aring; registrere data i databasen");
                  unlink($nyttnavn) or die ("ikke mulig &aring; slette bilde pÃ¥ serveren igjen");
                }
            }
        } 
    }
?> 

</article> 
    <br class="clearfloat" />  
    
  </div>
</body>
</html> 