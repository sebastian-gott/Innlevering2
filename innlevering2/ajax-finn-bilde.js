/* ajax-finn-klasse */
function finn(bildenr){
 var foresporsel=new XMLHttpRequest(); 

 foresporsel.onreadystatechange=function()
    {
 if (foresporsel.readyState==4 && foresporsel.status==200) 
    {
 var svar=foresporsel.responseText;
 
 var del=svar.split(";");
 var opplastningsdato=del[0];
 var filnavn=del[1];
 var beskrivelse=del[2];
 document.getElementById("opplastningsdato").value=opplastningsdato;
 document.getElementById("filnavn").value=filnavn;
 document.getElementById("beskrivelse").value=beskrivelse.trim();
 
    }
 }
 foresporsel.open("GET","ajax-finn-bilde.php?bildenr="+bildenr);
 foresporsel.send(); 
}