<?php
$page_title = "Zmiana danych użytkownika";
session_start();
if(isset($_SESSION['logon']) && $_SESSION['logon']==true) {
    include("header_admin.html");
}
else {
    $_SESSION['error'] = "Proszę się zalogować.";
    header('Location: login_admin.php');
    exit();
}

$id = htmlspecialchars($_GET["id"]);
require_once("DBconnect.php");
$zmiana = false;

//Po przesłaniu formularza
if($_SERVER['REQUEST_METHOD'] == 'POST') {

        $new_id = $_POST['id'];
        $new_name = $_POST['name'];
        $new_surname = $_POST['surname'];
        $new_email = $_POST['email'];
        $new_pass = $_POST['pass'];

    //Sprawdzenie połączenia
    if($dbc === false){
        die("ERROR: Nie można połączyć z bazą " . mysqli_connect_error());
    }
    else {
        $q = "UPDATE users SET user_id=$new_id, first_name='$new_name', last_name='$new_surname', email='$new_email', pass=SHA1('$new_pass') WHERE user_id=$id";
        if(mysqli_query($dbc, $q)) {
            echo "Edycja zakończona sukcesem.";
        }
        else {
            echo "Błąd. Nie można wykonać zapytania do bazy. $q. " . mysqli_error($dbc);
        }
    }
}

// Pobieranie i umieszczanie danych domyślnych w formularzu

$sql = "SELECT user_id, last_name, first_name, email, pass, registration_date FROM users WHERE user_id=$id";
$r = mysqli_query($dbc, $sql);
$result = $dbc -> query($sql);
$number = mysqli_num_rows($result);
$row = $result -> fetch_assoc();
mysqli_close($dbc);


?>

<div>
<h1 class="header_title">Edytuj profil</h1>
<form action="edit.php?id=<?php echo $id ?>" method="post">
    <p>Id: <input type="number" name="id" size="20" maxlength="60" value=<?php echo $row["user_id"]?>></p> 
    <p>Imię: <input type="text" name="name" size="20" maxlength="60" value=<?php echo $row["first_name"]?>></p> 
    <p>Nazwisko: <input type="text" name="surname" size="10" maxlength="20" value=<?php echo $row["last_name"]?>></p> 
    <p>Email: <input type="text" name="email" size="10" maxlength="20" value=<?php echo $row["email"]?>></p> 
    <p>Hasło: <input type="password" name="pass" size="10" maxlength="20" value=<?php echo $row["pass"]?>></p> 
    <p class = "submit_button"><input type="submit" value="Zapisz"></p>
</form>
<?php 
if($zmiana) {
    echo "<p style='margin-top:80px'>Dane zostały zmienione.</p>";
    echo "<a href='users_manage.php'>Wróć do panelu użytkowników</a>";
}
?>
</div>
<div><img src="https://www.pngkit.com/png/detail/388-3885743_illustration-of-four-people-hugging-and-smiling-people.png" width=600></div>
 
<?php 
include("footer.html");
?>
