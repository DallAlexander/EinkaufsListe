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

    table.appendChild(row);
    eintrag.appendChild(table);

    document.getElementById("ul1").appendChild(eintrag);

    //Eingaben zurücksetzen
    eingabe.value = "";
    anzahl.value = "1";

    delete_button.onclick = function() {
        //Eintrag wird entfernt
        document.getElementById("ul1").removeChild(eintrag);
        //Datenbank-Stuff
        post("delete", data1.textContent);
    }

    check_button.onclick = function() {
        //Eintrag wird abgehakt
        data1.classList.toggle('checked');
        //Datenbank-Stuff 
        var checked = 0
        if(data1.classList.contains('checked'))
        {
            checked = 1;
        }     
        post("check", data1.textContent + "|" + checked);
    }

    if(checked)
    {
        data1.classList.add('checked');
    }

    if(dbentry == false)
    {
        post("add", data1.textContent);  
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

