<?php /* sjekk */
/*
/* Programmet inneholder en funksjon for å sjekke om brukernavn og passord er korrekt
*/
function sjekkBrukernavnPassord($brukernavn,$passord)
{
/*
/* Hensikt
/* Funksjonen sjekker om brukernavn og passord er korrekt
/* Parametre
/* $brukernavn = brukernavnet som skal sjekkes
/* $passord = passordet som skal sjekkes
/* Funksjonsverdi/Returverdi
/* Funksjonen returnerer true hvis brukernavn og passord er korrekt
/* Funksjonen returnerer false ellers
*/
 include("db-tilkobling.php"); /* tilkobling til database-server og valg av database utført */
 $lovligBruker=true;
 $sqlSetning="SELECT * FROM bruker WHERE brukernavn='$brukernavn';";
 $sqlResultat=mysqli_query($db,$sqlSetning); /* SQL-setning sendt til database-serveren */
 if (!$sqlResultat) /* SQL-setningen var ikke vellykket (tilsvarer or die) */
 {
 $lovligBruker=false;
 }
 else
 {
 $rad=mysqli_fetch_array($sqlResultat); /* ny rad hentet fra spørringsresultatet */
 $lagretBrukernavn=$rad["brukernavn"];
 $lagretPassord=$rad["passord"]; /* brukernavn og passord hentet fra databasen */
 if($brukernavn!=$lagretBrukernavn || $passord!=$lagretPassord)
 {
 $lovligBruker=false;
 }
 }
 return $lovligBruker;
}
?>