<?php
session_start();
$page_title = "Logowanie";
include("header.html");
?>
         <div>
            <h1 class="header_title">Logowanie</h1>
            <form action="loggedin.php" method="post">
                <p>Adres e-mail: <input type="text" name="email" size="20" maxlength="60"></p> 
                <p>Hasło: <input type="password" name="pass" size="10" maxlength="20"></p> 
                <p class = "submit_button"><input type="submit" value="Zaloguj"></p>
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
    