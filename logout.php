<?php
session_start();
if(isset($_SESSION['logon']) && $_SESSION['logon']==true) {
    unset($_SESSION['logon']);
    unset($_SESSION['imie']);
    $_SESSION['error'] = "Pomyślnie wylogowano";
    header('Location: login.php');
    exit();

}
else {
    $_SESSION['error'] = "Proszę się zalogować.";
    header('Location: login.php');
    exit();
}


?>