function addItem(dbentry = false, text = null, qnty = null, checked = false) {
    //"Abhaken" Button
    const check_button = document.createElement("img");
    check_button.src = 'checkmark.png';
    check_button.width = '20';
    check_button.height = '20';

    //"Löschen" Button
    const delete_button = document.createElement("img");
    delete_button.src = 'trashcan.png';
    delete_button.width = '20';
    delete_button.height = '20';

    //ListItem
    var eingabe = document.getElementById("Input1");
    var anzahl = document.getElementById("itemQnty");
    var table = document.getElementById("table");
    var row = document.createElement("tr");

    //Text aus dem Eingabefeld mit der Anzahl
    var anzahl = document.createElement("td");
    var anzahlStr = "";
    if(qnty != null){
        anzahlStr = qnty;
    } else {
        anzahlStr = anzahl.value;
    }
    anzahl.textContent = anzahlStr;
    anzahl.classList.add("textItem");
    row.appendChild(anzahl);


    var bezeichnung = document.createElement("td");
    var bezeichnungStr = "";
    if(text != null) {
        bezeichnungStr = text;
    }else {
        bezeichnungStr = eingabe.value;
    }
    bezeichnung.textContent = bezeichnungStr;
    bezeichnung.classList.add("textItem");
    row.appendChild(bezeichnung);

    //Button zum Abhaken
    var btnCheck = document.createElement("td");
    btnCheck.appendChild(check_button);
    row.appendChild(btnCheck);

    //Button zum Löschen
    var btnDelete = document.createElement("td");
    btnDelete.appendChild(delete_button);
    row.appendChild(btnDelete);

    table.appendChild(row);

    //Eingaben zurücksetzen
    eingabe.value = "";
    anzahl.value = "1";

    delete_button.onclick = function() {
        //Eintrag wird entfernt
        table.removeChild(row);

        //Datenbank-Stuff
        post("delete", (anzahl.textContent + "x " + bezeichnung.textContent));
    }

    check_button.onclick = function() {
        //Artikel wird abgehakt
        bezeichnung.classList.toggle('checked');
        //Datenbank-Stuff 
        var checked = 0
        if(bezeichnung.classList.contains('checked'))
        {
            checked = 1;
        }     
        post("check", anzahl.textContent + "x " + bezeichnung.textContent + "|" + checked);

    }

    if(checked)
    {
        bezeichnung.classList.add('checked');
    }

    if(dbentry == false)
    {
        post("add", anzahl.textContent + "x " + bezeichnung.textContent);  
    }
    
}

function post(name, value)
{
    var form = document.createElement("form");
    form.method = 'post';
    form.action = 'index.php';
    form.target = "content";

    var hiddenField = document.createElement("input");
    hiddenField.type = 'hidden';
    hiddenField.name = name;
    hiddenField.value = value;

    form.appendChild(hiddenField);

    document.body.appendChild(form);
    form.submit();
}

