
function Insert(){
    




const sqlite3 = require('sqlite3').verbose();

  let db = new sqlite3.Database('./Eisner/notes.db');

  
  db.run(`INSERT INTO TEST VALUES(6,"HALLO")`, function(err) {
    if (err) {
      return console.log(err.message);
    }
    
    console.log(`A row has been inserted with rowid ${this.lastID}`);
  });

  
  db.close();