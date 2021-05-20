function neueZeile(){

    var eingabe = document.getElementById("Input1").value 
    var eingabetext = document.createTextNode(eingabe)
    var eintrag = document.createElement("li")
    eintrag.appendChild(eingabetext)
    document.getElementById("ul1").appendChild(eintrag)
      
      

}