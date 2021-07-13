# EinkaufsListe

<!-- Inhaltsverzeichnis -->
<details open="open">
  <summary>Inhaltsverzeichnis</summary>
  <ol>
    <li>
      <a href="#über-das-projekt">Über das Projekt</a>
      <ul>
        <li><a href="###verwendete-programmiersprachen">Verwendete Programmiersprachen</a></li>
      </ul>
    </li>
    <li>
      <a href="#getting-started">Getting Started</a>
      <ul>
        <li><a href="#voraussetzungen">Voraussetzungen</a></li>
        <li><a href="#installation">Installation</a></li>
      </ul>
    </li>
    <li><a href="#Verwendung">Verwendung</a></li>
  </ol>
</details>


<!-- Über das Projekt -->
## Über das Projekt
Diese Projektarbeit wurde als Prüfung für die Veranstaltung Internet Basistechnologien an der Westfälischen Hochschule von Marek Brüning, Fynn Aldenkirchs, Alexander Eisner und Alexander Dall entwickelt.  
Im Zuge der Ausarbeitung haben wir uns für die Entwicklung einer Einkaufsliste entschieden. Diese stellt Funktionen, wie das Hinzufügen, Löschen und Abhaken von Artikeln, bereit. Für den sicheren Zugriff auf die Liste haben wir ein Login-System implementiert, womit man sich registrieren und einloggen kann. Die Daten werden in einem MySQL-Datenbankmanagementsytem gespeichert.
Sofern erreichbar wird das Projekt über 000Webhost gehostet, das über folgenden Link aufzurufen ist:
```
   https://einkaufslisteaafm.000webhostapp.com/login.php
   ```

### Verwendete Programmiersprachen
Grundsätzlich wurde unsere Einkaufsliste angesichts der Anforderungen mit den Programmiersprachen HTML, JavaScript, CSS, PHP und SQL umgesetzt. Benutzt wurden folgende Frameworks:
* [Google Developer API](https://developers.google.com/fonts/docs/developer_api/)

<!-- GETTING STARTED -->
## Getting Started

Hier ist eine kleine Anleitung, wie unsere Einkaufsliste lokal installiert und gestartet werden kann. Grundsätzlich empfehlen wir die Verwendung von XAMPP, da hier bereits viele Funktionen bereitgestellt werden.

### Voraussetzungen
* Aktueller Web-Browser
* MySql Datenbankmanagementsystem
* Apache Web Server

### Installation
1. XAMPP installieren, Server aus dem Dashboard starten
2. Das Repository clonen
    ```sh
   git clone https://github.com/DallAlexander/EinkaufsListe.git
   ```
3. Datenbank-Dump in das Datenbankmanagementsystem einpflegen, siehe: `dump.sql`
4. Die Verbindung zur lokalen Datenbank in `config.php` und `index.php` herstellen
5. Anschließend können die Dateien in dem Pfad `/Applications/XAMPP/xamppfiles/htdocs/einkaufsliste` abgelegt werden. Wichtig: alle Files, auch die aus dem Login-Ordner müssen im selben Pfad wie die übrigen Dateien liegen
6. Nun kann im Browser die [index.php Seite](localhost/einkaufsliste/index.php) geöffnet werden

## Verwendung
Es steht jedem Entwickler und jeder Entwicklerin frei zur Verfügung, dieses Projekt zu clonen und weiter zu verwenden.