function addItem(dbentry = false, text = null, qnty = null, checked = false, id=null) {
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
    var row = document.createElement("tr");

    //Text aus dem Eingabefeld mit der Anzahl
    var fieldAnzahl = document.createElement("td");
    var anzahlStr = "";
    if(qnty != null){
        anzahlStr = qnty;
    } else {
        anzahlStr = anzahl.value;
    }
    fieldAnzahl.textContent = anzahlStr;
    fieldAnzahl.classList.add("textItem");
    row.appendChild(fieldAnzahl);

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

    //Feld für die ID
    var fieldId = document.createElement("td");
    if(id != null) {
        fieldId.textContent = id;
    }else {
        fieldId.textContent = "-1";
    }
    fieldId.hidden = true;
    row.appendChild(fieldId);

    delete_button.onclick = function() {
        //Datenbankaufruf, dass der Eintrag gelöscht werden soll
        post("delete", fieldId.textContent);
    }

    check_button.onclick = function() {
        //Datenbankaufruf, dass der Eintrag abgehakt werden soll
        var checked = 1
        if(bezeichnung.classList.contains('checked'))
        {
            checked = 0;
        }     
        post("check", fieldId.textContent + "|" + checked);
    }

    if(dbentry == false)
    {
        //Damit keine Schleife entsteht, darf ein Datenbankeintrag nur erstellt werden, wenn der Eintrag vom Benutzer hinzugefügt wurde
        //Das Element nur hinzufügen, wenn das Eingabefeld nicht leer ist
        if(eingabe.value.length > 0)
        {
            post("add", fieldAnzahl.textContent + "x " + bezeichnung.textContent);
        }
    }else {
        document.getElementById("table").appendChild(row);
        if(checked)
        {
            bezeichnung.classList.add('checked');
        }
    }

    //Eingaben zurücksetzen
    eingabe.value = "";
    anzahl.value = "1";
}

function post(name, value)
{
    var form = document.createElement("form");
    form.method = 'post';
    form.action = 'index.php';

    var hiddenField = document.createElement("input");
    hiddenField.type = 'hidden';
    hiddenField.name = name;
    hiddenField.value = value;

    form.appendChild(hiddenField);

    document.body.appendChild(form);
    form.submit();
}

