<?php
session_start(); 
if(isset($_SESSION['logon']) && $_SESSION['logon'] == true) {
    include("header_admin.html");
}
else {
    $_SESSION['error'] = "Proszę się zalogować.";
    header('Location: login_admin.php');
    exit();
}

if(isset($_POST["name"]) && isset($_POST["surname"]) && isset($_POST["email"]) && isset($_POST["pass"])) {
    if(strlen($_POST['name'])<3 || strlen($_POST['surname'])<3 || strlen($_POST['email'])<3 || strlen($_POST['pass'])<3) {
        $_SESSION['error'] = "Dane muszą mieć więcej niż 3 znaki";
        header('Location: users_add.php');
        exit();
    }
    else {
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        require_once("DBconnect.php");
        
        if($reply = mysqli_query($dbc, "SELECT * FROM users WHERE email = '$email'")) {
            if($reply->num_rows <= 0) {
                $q = "INSERT INTO users (user_id, first_name, last_name, email, pass, registration_date, user_level) VALUES(NULL,'$name','$surname','$email',SHA1('$pass'),NOW(),0)";
                $r = mysqli_query($dbc, $q);
                $dbc -> close();
                echo "<p>Użytkownik został dodany</p>";

                exit();
                }
                else {
                    $_SESSION['error'] = "Dane są nieprawidłowe. odany email istnieje w bazie.";
                    header('Location: login.php');
                    exit();
                }
        }
        else {
            $_SESSION['error'] = "Dane są nieprawidłowe.";
            header('Location: users_add.php');
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