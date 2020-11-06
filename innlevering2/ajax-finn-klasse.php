<?php /* ajax-finn-fag */
 include("db-tilkobling.php"); /* tilkobling til database-serveren utført og valg av database foretatt */
 $klassekode=$_GET ["klassekode"];

 $sqlSetning="SELECT * FROM klasse WHERE klassekode='$klassekode';";
 $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen");
 /* SQL-setning sendt til database-serveren */
 $antallRader=mysqli_num_rows($sqlResultat);
 if ($antallRader!=0) /* poststedet er registrert */
 {
 $rad=mysqli_fetch_array($sqlResultat);
 $klassenavn=$rad["klassenavn"];
 $studiumkode=$rad["studiumkode"];
 print("$klassenavn;$studiumkode");
 }
?>