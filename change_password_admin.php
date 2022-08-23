<?php
$page_title = "Zmiana hasła";
session_start();
if(isset($_SESSION['logon']) && $_SESSION['logon'] == true) {
    include("header_admin.html");
}
else {
    $_SESSION['error'] = "Proszę się zalogować.";
    header('Location: login_admin.php');
    exit();
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once("DBconnect.php");
    $errors = array();

    // Sprawdzanie adresu email
    if (empty($_POST['email'])) {
        $errors[] = "Wpisz adres email";
    }
    else {
        $e = trim($_POST['email']);
    }

    // Sprawdzanie hasła
    if (empty($_POST['pass'])) {
        $errors[] = "Wpisz poprawne hasło";
    }
    else {
        $p = trim($_POST['pass']);
    }

    // Sprawdzanie nowego hasła
    if(empty($_POST['pass1'])) {
        $errors[] = "Wpisz nowe hasło";
    }
    elseif($_POST['pass2'] != $_POST['pass1'])
    {
        $errors = "Hasła nie są takie same. Wpisz ponownie";
    }
    else {
        $np = $_POST['pass1']; 
    }

    if(empty($errors)) {
        $q = "SELECT user_id FROM users WHERE (email='$e' AND pass=SHA1('$p'))";
        $r = mysqli_query($dbc, $q);
        $num = mysqli_num_rows($r);

        if ($num == 1){
            //pobieramy id użytkownika 
            $row = mysqli_fetch_array($r, MYSQLI_NUM);
            //tworzymy UPDATE 
            $q = "UPDATE users SET pass=SHA1('$np') WHERE user_id=$row[0]"; 
            $r = mysqli_query($dbc, $q);
            //poprawnie wykonana zmiana 
            if (mysqli_affected_rows($dbc) == 1){
            //wyświetlamy komunikat 
            echo "<p>Hasło zostało zmienione</p>"; 
            }
        }
        else {
            //zmiana się nie udała - wyświetlamy komunikat 
            echo "<p class='err'>Hasło nie zostało zmienione z powodu awarii systemu</p>";
        }
        mysqli_close($dbc);
        include("footer.html");
        exit();
    }
    else {
        echo "<div> <h1 class='err_header'>Błąd!</h1> <p class='err'>Wystąpiły następujące błędy: <br>";
        if(is_array($errors) && count($errors)>0) {
            foreach($errors as $msg) {
                echo "- $msg <br>";
            }
            echo "<br>Spróbuj jeszcze raz</p> </div>";
        }

    }
    mysqli_close($dbc);
}
?>

        <div>
            <h1 class="header_title">Zmień hasło</h1>
            <form action="change_password.php" method="post">
                <p>Adres e-mail: <input type="text" name="email" size="20" maxlength="60"></p> 
                <p>Aktualne hasło: <input type="password" name="pass" size="10" maxlength="20"></p> 
                <p>Nowe hasło: <input type="password" name="pass1" size="10" maxlength="20"></p> 
                <p>Potwierdź nowe hasło: <input type="password" name="pass2" size="10" maxlength="20"></p>
                <p class = "submit_button" ><input type="submit" value="Zmień hasło"></p>
            </form>
 
        </div>
        <div><img src="https://www.pngkit.com/png/detail/388-3885743_illustration-of-four-people-hugging-and-smiling-people.png" width=600></div>

<?php
    include("footer.html");
?>  