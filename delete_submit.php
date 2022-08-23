<?php
session_start();
$page_title = "Logowanie";

if(isset($_SESSION['logon']) && $_SESSION['logon'] == true) {
    include("header_admin.html");
}
else {
    $_SESSION['error'] = "Proszę się zalogować.";
    header('Location: login_admin.php');
    exit();
}
$id = htmlspecialchars($_GET["id"]);
?>
         <div>
             <a class="delete_text" href="delete.php?id=<?php echo $id?>">Czy na pewno chcesz usunąć użytkownika?</a>
             <button><a class="delete_text" href="delete.php?id=<?php echo $id?>">Tak</a></button>
             <button class = "submit_button"><a class="delete_text" href="users_manage.php">Nie</a></button>
        <div><img src="https://www.pngkit.com/png/detail/388-3885743_illustration-of-four-people-hugging-and-smiling-people.png" width=600></div>

