<?php
/* DEFINE('DB_USER', 'root');
DEFINE('DB_PASSWORD', '');
DEFINE('DB_HOST', 'localhost')
DEFINE('DB_NAME', 'sitename')  */


//nawiązywanie połączenia z bazą
$dbc = @mysqli_connect('localhost', 'root', '', 'sitename') OR die ("Brak połączenia z serwerem MySQL: " . mysqli_connect_error());

?>
