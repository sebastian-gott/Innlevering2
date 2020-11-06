<?php /* dynamiske-funksjoner */
function listeboksKlassekode ()
{
 include("db-tilkobling.php"); /* tilkobling til database-server og valg av database utført */

 $sqlSetning="SELECT * FROM klasse ORDER BY klassekode;";
 $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen");

 $antallRader=mysqli_num_rows($sqlResultat); /* antall rader i resultatet beregnet */
 for ($r=1;$r<=$antallRader;$r++)
 {
 $rad=mysqli_fetch_array($sqlResultat); /* ny rad hentet fra spørringsresultatet */
 $klassekode=$rad["klassekode"];
 $klassenavn=$rad["klassenavn"];
 $studiumkode=$rad["studiumkode"];
 print("<option value='$klassekode'>$klassekode </option>");
 /* ny verdi i listeboksen laget */
 }
}

function listeboksBildenr()
{
  include("db-tilkobling.php");  /* tilkobling til database-server og valg av database utfÃ¸rt */
      
  $sqlSetning="SELECT * FROM bilde ORDER BY bildenr;";
  $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen"); 
      
  $antallRader=mysqli_num_rows($sqlResultat);  /* antall rader i resultatet beregnet */

  for ($r=1;$r<=$antallRader;$r++)
    {
      $rad=mysqli_fetch_array($sqlResultat);  /* ny rad hentet fra spÃ¸rringsresultatet */
      $bildenr=$rad["bildenr"];
      $filnavn=$rad["filnavn"];

      print("<option value='$bildenr'>$bildenr $filnavn</option>");  /* ny verdi i listeboksen laget */
    }
}

function listeboksBildenrFilnavn()
{
  include("db-tilkobling.php");  /* tilkobling til database-server og valg av database utfÃ¸rt */
      
  $sqlSetning="SELECT * FROM bilde ORDER BY bildenr;";
  $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen"); 
      
  $antallRader=mysqli_num_rows($sqlResultat);  /* antall rader i resultatet beregnet */

  for ($r=1;$r<=$antallRader;$r++)
    {
      $rad=mysqli_fetch_array($sqlResultat);  /* ny rad hentet fra spÃ¸rringsresultatet */
      $bildenr=$rad["bildenr"];
      $filnavn=$rad["filnavn"];

      print("<option value='$bildenr;$filnavn'>$bildenr $filnavn</option>");  /* ny verdi i listeboksen laget */
    }
}


function listeboksBrukernavn(){
    include("db-tilkobling.php"); /* tilkobling til database-server og valg av database utført */

 $sqlSetning="SELECT * FROM student ORDER BY brukernavn;";
 $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen");

 $antallRader=mysqli_num_rows($sqlResultat); /* antall rader i resultatet beregnet */
 for ($r=1;$r<=$antallRader;$r++)
 {
 $rad=mysqli_fetch_array($sqlResultat); /* ny rad hentet fra spørringsresultatet */
 $brukernavn=$rad["brukernavn"];
 $fornavn=$rad["fornavn"];
 $etternavn=$rad["etternavn"];
 $klassekode=$rad["klassekode"];
 $bildenr=$rad["bildenr"];
 print("<option value='$brukernavn'>$brukernavn </option>");
 /* ny verdi i listeboksen laget */
 }
}

?>

