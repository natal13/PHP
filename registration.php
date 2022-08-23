<?php
session_start(); 
include("header.html");

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = array();

    //Sprawdzanie imienia
    if (empty($_POST['name'])) {
        $errors[] = "Wpisz imię";
    }
    else {
        $name = trim($_POST['name']);
    }
    //Sprawdzanie nazwiska
    if (empty($_POST['surname'])) {
        $errors[] = "Wpisz nazwisko";
    }
    else {
        $surname = trim($_POST['surname']);
    }
    // Sprawdzanie adresu email
    if (empty($_POST['email'])) {
        $errors[] = "Wpisz adres email";
    }
    else {
        $email = trim($_POST['email']);
    }
    // Sprawdzanie hasła
    if (empty($_POST['pass'])) {
        $errors[] = "Wpisz poprawne hasło";
    }
    else {
        $pass = trim($_POST['pass']);
    }

    if(empty($_POST['pass2'])) {
        $errors[] = "Wpisz powtórzone hasło";
    }
    if($_POST['pass2'] !== $_POST['pass'])
    {
        $errors[] = "Hasła nie są takie same. Wpisz ponownie";
    }

    if(empty($errors)) {

        require_once("DBconnect.php");
        
        if($reply = mysqli_query($dbc, "SELECT * FROM users WHERE email = '$email'")) {
            if($reply->num_rows <= 0) {
                $q = "INSERT INTO users (user_id, first_name, last_name, email, pass, registration_date, user_level) VALUES(NULL,'$name','$surname','$email',SHA1('$pass'),NOW(),0)";
                $r = mysqli_query($dbc, $q);
                $_SESSION['logon'] = true;
                $_SESSION['imie'] = $name;
                $dbc -> close();
                header('Location: panel.php');
                exit();
            }
            else {
                $_SESSION['error'] = "Dane są nieprawidłowe. Podany email istnieje w bazie.";
                header('Location: registration.php');
                exit();
            }
        }
        else {
            $_SESSION['error'] = "Dane są nieprawidłowe.";
            header('Location: registration.php');
            exit();
        }
    }

    else {
        $text = "<div> <h1 class='err_header'>Błąd!</h1> <p class='err'>Wystąpiły następujące błędy: <br>";
        if(is_array($errors) && count($errors)>0) {
            foreach($errors as $msg) {
                $text.="- $msg <br>";
            }
            $text.= "<br>Spróbuj jeszcze raz</p> </div>";
        }  
        $_SESSION['error'] = $text;
    }
}
?>

<div>
            <h1 class="header_title">Zarejestruj</h1>
            <form action="registration.php" method="post">
                <p>Imię: <input type="text" name="name" size="20" maxlength="60"></p> 
                <p>Nazwisko: <input type="text" name="surname" size="10" maxlength="20"></p> 
                <p>Email: <input type="text" name="email" size="10" maxlength="20"></p> 
                <p>Hasło: <input type="password" name="pass" size="10" maxlength="20"></p> 
                <p>Powtórz hasło: <input type="password" name="pass2" size="10" maxlength="20"></p> 
                <p class = "submit_button"><input type="submit" value="Potwierdź"></p>
            </form>

            <?php
            if(isset($_SESSION['error'])) {
                echo '<span style="color:red; font-weight: bold;">' . $_SESSION["error"].'</span>';
                unset($_SESSION['error']);
            }
            ?>
 
        </div>
        <div><img src="https://www.pngkit.com/png/detail/388-3885743_illustration-of-four-people-hugging-and-smiling-people.png" width=600></div>

<?php
    include("footer.html");
?>