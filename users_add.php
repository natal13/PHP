<?php
session_start();
$page_title = "Dodawanie użytkownika";
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
            <h1 class="header_title">Dodawanie użytkownika</h1>
            <form action="add_ini.php" method="post">
                <p>Imię: <input type="text" name="name" size="20" maxlength="60"></p> 
                <p>Nazwisko: <input type="text" name="surname" size="10" maxlength="20"></p> 
                <p>Email: <input type="text" name="email" size="10" maxlength="20"></p> 
                <p>Hasło: <input type="password" name="pass" size="10" maxlength="20"></p> 
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