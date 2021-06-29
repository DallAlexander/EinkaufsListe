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
    var eintrag = document.createElement("li");
    var table = document.createElement("table");
    var row = document.createElement("tr");

    //Text aus dem Eingabefeld mit der Anzahl
    var data1 = document.createElement("td");

    var string = "";
    if(qnty != null) {
        string = qnty + "x";
    }else {
        string = anzahl.value + "x";
    }
    
    if(text != null) {
        string = string + " " + text;
    }else {
        string = string + " " + eingabe.value;
    }
    data1.textContent = string;
    data1.classList.add("textItem");
    row.appendChild(data1);

    //Button zum Abhaken
    var data2 = document.createElement("td");
    data2.appendChild(check_button);
    row.appendChild(data2);

    //Button zum Löschen
    var data3 = document.createElement("td");
    data3.appendChild(delete_button);
    row.appendChild(data3);

    //Feld für die ID
    var data4 = document.createElement("td");
    if(id != null) {
        data4.textContent = id;
    }else {
        data4.textContent = "-1";
    }
    data4.hidden = true;
    row.appendChild(data4);

    table.appendChild(row);
    eintrag.appendChild(table);

    delete_button.onclick = function() {
        //Datenbankaufruf, dass der Eintrag gelöscht werden soll
        post("delete", data4.textContent);
    }

    check_button.onclick = function() {
        //Datenbankaufruf, dass der Eintrag abgehakt werden soll
        var checked = 1
        if(data1.classList.contains('checked'))
        {
            checked = 0;
        }     
        post("check", data4.textContent + "|" + data1.textContent + "|" + checked);
    }

    if(dbentry == false)
    {
        //Damit keine Schleife entsteht, darf ein Datenbankeintrag nur erstellt werden, wenn der Eintrag vom Benutzer hinzugefügt wurde
        //Das Element nur hinzufügen, wenn das Eingabefeld nicht leer ist
        if(eingabe.value.length > 0)
        {
            post("add", data1.textContent);
        }
        
    }else{
        //Die Einträge aus der Datenbank werden hinzugefügt und wenn nötig abgehakt
        document.getElementById("ul1").appendChild(eintrag);
        if(checked)
        {
            data1.classList.add('checked');
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

