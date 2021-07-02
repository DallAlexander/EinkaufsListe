<?php

// Connect to the database
$dbconn = pg_connect("host=itbasis dbname=shoplist user=admin password=98765");
// Show the client and server versions
print_r(pg_version($dbconn));

