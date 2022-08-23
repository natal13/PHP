<?php
$page_title = "Zmiana hasła";
session_start();
if(isset($_SESSION['logon']) && $_SESSION['logon']==true) {
    include("header_admin.html");
}
else {
    $_SESSION['error'] = "Proszę się zalogować.";
    header('Location: login_admin.php');
    exit();
}

// Pobieranie i umieszczanie danych domyślnych w formularzu
$id = htmlspecialchars($_GET["id"]);
require_once("DBconnect.php");
$q = "DELETE FROM `users` WHERE `users`.`user_id` = $id";
$r = mysqli_query($dbc, $q);
echo "<p>Użytkownik został usuniety.</p>"; 

mysqli_close($dbc);
include("footer.html");
exit();

