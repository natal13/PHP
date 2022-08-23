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
$page_title = "Strona główna";
?>
        <div class="page_header">
            <h1 class="header_title"><?php echo '<h1 style="margin-bottom:60px">Witaj administratorze ' . $_SESSION['imie']  ?> </h1>
            <p>Jesteś zalogowany jako administator.</p>
            <p>* Możesz sprawdzić zarejestrowanych użytkowników.</p>
            <p>* Możesz zmodyfikowac dane zarejestrowanych użytkowników.</p>
            <p>* Możesz usunąć użytkownika.</p>
            <p>* Możesz dodać nowego użytkownika.</p>

</br> </br>
        </div>
        <div><img src="https://www.pngkit.com/png/detail/388-3885743_illustration-of-four-people-hugging-and-smiling-people.png" width=600></div>

<?php
    include("footer.html");
?>
    