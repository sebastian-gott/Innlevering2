<?php /* ajax-finn-fag */
 include("db-tilkobling.php"); 
    $brukernavn=$_GET ["brukernavn"];

    $sqlSetning="SELECT * FROM student WHERE brukernavn='$brukernavn';";
    $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen");
    
    $antallRader=mysqli_num_rows($sqlResultat);
 if ($antallRader!=0) {
    $rad=mysqli_fetch_array($sqlResultat);
    $fornavn=$rad["fornavn"];
    $etternavn=$rad["etternavn"];
    $klassekode=$rad["klassekode"];
    $bildenr=$rad["bildenr"];
    print("$fornavn;$etternavn;$klassekode;$bildenr");
 }
?>