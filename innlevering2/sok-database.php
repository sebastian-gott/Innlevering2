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

<h3>S&oslashk </h3>

<form method="post" action="" id="sokeSkjema" name="sokeSkjema">
    S&oslash;kestreng <input type="text" id="sokestreng" name="sokestreng" required /> <br/>
    <input type="submit" value="Fortsett" id="sokeKnapp" name="sokeKnapp" /> 
    <input type="reset" value="Nullstill" id="nullstill" name="nullstill" /> <br />
</form>

<?php 
  if (isset($_POST ["sokeKnapp"]))
    {
      $sokestreng=$_POST ["sokestreng"];

      include("db-tilkobling.php");  /* tilkobling til database-serveren utfÃ¸rt og valg av database foretatt */

      print ("Treff for s&oslash;kestrengen <strong>$sokestreng</strong> <br /><br />");  
	  
      /* sÃ¸k i STUDIUM-tabellen*/

      $sqlSetning="SELECT * FROM bilde WHERE bildenr LIKE '%$sokestreng' OR filnavn LIKE '%$sokestreng%' OR opplastningsdato LIKE '%$sokestreng' OR beskrivelse LIKE '%$sokestreng%';";
      $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen");
      $antallRader=mysqli_num_rows($sqlResultat); 

      if ($antallRader==0) 
        {
          print ("Treff i BILDE-tabellen: <br /> Ingen <br /> <br />");  
        }
      else 
        {
          print ("Treff i BILDE-tabellen: <br />");  
          print ("<table border=1");  
          print ("<tr><th align=left>bildenr - filnavn - opplastningsdato - beskrivelse</th> </tr>");

          for ($r=1;$r<=$antallRader;$r++)
            {
              $rad=mysqli_fetch_array($sqlResultat);  /* ny rad hentet fra spÃ¸rringsresultatet */
              $bildenr=$rad["bildenr"];     
              $filnavn=$rad["filnavn"];
              $opplastningsdato=$rad["opplastningsdato"];
              $beskrivelse=$rad["beskrivelse"];     

              $sokestrenglengde=strlen($sokestreng);  /* lengden pÃ¥ sokestrengen */
			  
              print("<tr><td> ");
              $tekst="$filnavn $beskrivelse";  /* fÃ¸rste tekststreng */
              $startpos=stripos($tekst,$sokestreng);  /* fÃ¸rste startpos */   

              while ($startpos!==false)
                { 
                  $tekstlengde=strlen($tekst);  /* lengden pÃ¥ teksten */

                  $hode=substr($tekst,0,$startpos);  
                  $sok=substr($tekst,$startpos,$sokestrenglengde);  
                  $hale=substr($tekst,$startpos+$sokestrenglengde,$tekstlengde-$startpos-$sokestrenglengde);

                  print("$hode<strong><font color='blue'>$sok</font></strong>");  /* deler av utskriften*/

                  $tekst=$hale;/* ny tekst = nÃ¥vÃ¦rende hale */
                  $startpos=stripos($tekst,$sokestreng);  /* ny startpos */
                } 
              print("$hale</td></tr>");  /* utskrift av siste hale */
            }
          print ("</table> </br />");
        }

      /* sÃ¸k i KLASSE-tabellen*/

      $sqlSetning="SELECT * FROM klasse WHERE klassekode LIKE '%$sokestreng%' OR klassenavn LIKE '%$sokestreng%' OR studiumkode LIKE '%$sokestreng%';";
      $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen");
      $antallRader=mysqli_num_rows($sqlResultat); 

      if ($antallRader==0) 
        {
          print ("Treff i KLASSE-tabellen: <br /> Ingen <br /> <br />");  
        }
      else 
        {
          print ("Treff i KLASSE-tabellen: <br />");  
          print ("<table border=1>"); 
          print ("<tr><th align=left>fagkode - fagnavn - studiumkode</th> </tr>");

          for ($r=1;$r<=$antallRader;$r++)
            {
              $rad=mysqli_fetch_array($sqlResultat);  /* ny rad hentet fra spÃ¸rringsresultatet */
              $klassekode=$rad["klassekode"];   
              $klassenavn=$rad["klassenavn"];       
              $studiumkode=$rad["studiumkode"];   

              $sokestrenglengde=strlen($sokestreng);  /* lengden pÃ¥ sokestrengen */
			  
              print("<tr><td> ");
              $tekst="$klassekode $klassenavn $studiumkode";  /* fÃ¸rste tekststreng */
              $startpos=stripos($tekst,$sokestreng);  /* fÃ¸rste startpos */

              while ($startpos!==false)
                { 
                  $tekstlengde=strlen($tekst);  /* lengden pÃ¥ teksten */

                  $hode=substr($tekst,0,$startpos);  
                  $sok=substr($tekst,$startpos,$sokestrenglengde);  
                  $hale=substr($tekst,$startpos+$sokestrenglengde,$tekstlengde-$startpos-$sokestrenglengde);

                  print("$hode<strong><font color='blue'>$sok</font></strong>");  /* deler av utskriften*/

                  $tekst=$hale;/* ny tekst = nÃ¥vÃ¦rende hale */
                  $startpos=stripos($tekst,$sokestreng);  /* ny startpos */
                } 
                print("$hale</td></tr>");  /* utskrift av siste hale */
            }
          print ("</table> </br />");  
        }

      /* sÃ¸k i STUDENT-tabellen*/

      $sqlSetning="SELECT * FROM student WHERE brukernavn LIKE '%$sokestreng%' OR fornavn LIKE '%$sokestreng%' OR etternavn LIKE '%$sokestreng%' OR klassekode LIKE '%$sokestreng%' OR bildenr LIKE '%$sokestreng%';";
      $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen");
      $antallRader=mysqli_num_rows($sqlResultat); 

      if ($antallRader==0) 
        {
          print ("Treff i STUDENT-tabellen: <br /> Ingen <br /> <br />");  
        }
      else 
        {
          print ("Treff i STUDENT-tabellen: <br />");  /* starten pÃ¥ tabellen definert */
          print ("<table border=1>");  /* starten pÃ¥ tabellen definert */
          print ("<tr><th align=left>brukernavn - fornavn - etternavn - klassekode - bildenr</th> </tr>");

          for ($r=1;$r<=$antallRader;$r++)
            {
              $rad=mysqli_fetch_array($sqlResultat);  /* ny rad hentet fra spÃ¸rringsresultatet */
              $brukernavn=$rad["brukernavn"];      
              $fornavn=$rad["fornavn"];   
              $etternavn=$rad["etternavn"];
              $klassekode=$rad["klassekode"];
              $bildenr=$rad["bildenr"];   

              $sokestrenglengde=strlen($sokestreng);  /* lengden pÃ¥ sokestrengen */
			  
              print("<tr><td> ");
              $tekst="$brukernavn $fornavn $etternavn $klassekode $bildenr";  /* fÃ¸rste tekststreng */
              $startpos=stripos($tekst,$sokestreng);  /* fÃ¸rste startpos */

              while ($startpos!==false)
                { 
                  $tekstlengde=strlen($tekst);  /* lengden pÃ¥ teksten */

                  $hode=substr($tekst,0,$startpos);  
                  $sok=substr($tekst,$startpos,$sokestrenglengde);  
                  $hale=substr($tekst,$startpos+$sokestrenglengde,$tekstlengde-$startpos-$sokestrenglengde);

                  print("$hode<strong><font color='blue'>$sok</font></strong>");  /* deler av utskriften*/

                  $tekst=$hale;/* ny tekst = nÃ¥vÃ¦rende hale */
                  $startpos=stripos($tekst,$sokestreng);  /* ny startpos */
                } 
                print("$hale</td></tr>");  /* utskrift av siste hale */
            }
          print ("</table> </br />"); 
        }
    }
?> 

</article> 
    <br class="clearfloat" />  
    
  </div>
</body>
</html> 