<?php
$page_title = "Panel użytkowników - admin";
session_start();
if(isset($_SESSION['logon']) && $_SESSION['logon'] == true) {
    include("header_admin.html");
}
else {
    $_SESSION['error'] = "Proszę się zalogować.";
    header('Location: login_admin.php');
    exit();
}
?>

<div>
            <h1 class="header_title">Użytkownicy</h1>
            <ul>
                <li><a class="admin_users" href="users_manage.php">Zarządzanie użytkownikami</a></li>
                <li><a class="admin_users" href="users_add.php"> Dodawanie użytkowników</a></li>
                <li><a class="admin_users" href="users_manage.php">Lista użytkowników</a></li>
            </ul>

<?php
require_once("DBconnect.php");
if($dbc -> connect_error) {
    die("Connection failed: " . $dbc -> connect_error);
}
$sql = "SELECT last_name, first_name, email, registration_date FROM users";
$result = $dbc -> query($sql);
$number = mysqli_num_rows($result);
echo "<p style='font-size:14px'>Liczba zerejestrowanych użytkowników: " . $number . "</p> <br>";
echo "<table><th>Nazwisko</th><th>Imię</th><th>E-mail</th><th>Data rejestracji</th>";
if($result -> num_rows>0) {
    while($row = $result -> fetch_assoc()) {
        echo "<tr><td>" . $row["last_name"] . "</td><td>" . $row["first_name"] . "</td><td>" . $row["email"] ."</td><td>" . $row["registration_date"] . "</td></tr>";
    }
}
else {
    echo "0 result";
}

$dbc -> close();
echo "</table>";
?>

</div>
        <div><img src="https://www.pngkit.com/png/detail/388-3885743_illustration-of-four-people-hugging-and-smiling-people.png" width=600></div>

<?php
    include("footer.html");
?>
