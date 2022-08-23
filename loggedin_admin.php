<?php
session_start();



if(isset($_POST["email"]) && isset($_POST["pass"])) {
    if(strlen($_POST['email'])<3 || strlen($_POST['pass'])<3) {
        $_SESSION['error'] = "Dane muszą mieć więcej niż 3 znaki";
        header('Location: login.php');
        exit();
    }
    else {
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        require_once("DBconnect.php");
        
        if($reply = mysqli_query($dbc, "SELECT * FROM users WHERE email = '$email'")) {
            if($reply->num_rows >0) {
                $row = $reply->fetch_assoc();
                if(SHA1($pass)==$row["pass"] && $row["user_level"] == 1) {
                    $_SESSION['logon'] = true;
                    $_SESSION['imie'] = $row['first_name'];
                    $dbc -> close();
                    header('Location: panel_admin.php');
                    exit();
                }
                else {
                    $_SESSION['error'] = "Dane są nieprawidłowe II";
                    header('Location: login.php');
                    exit();
                }
            }
            else {
                $_SESSION['error'] = "Dane są nieprawidłowe I";
                header('Location: login.php');
                exit();
            }
        }
        else {
            $_SESSION['error'] = "Błąd zapytania bazy danych";
            header('Location: login.php');
            exit();
        }

    }

}
else {
    $_SESSION['error'] = "Proszę wprowadzić dane!";
    header('Location: login.php');
    exit();
}
?>