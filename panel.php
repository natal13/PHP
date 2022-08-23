<?php
session_start();
if(isset($_SESSION['logon']) && $_SESSION['logon'] == true) {
}
else {
    $_SESSION['error'] = "Proszę się zalogować.";
    header('Location: login.php');
    exit();
}
$page_title = "Strona główna";
include("header_logged.html");
?>
        <div class="page_header">
            <h1 class="header_title"><?php echo '<h1 style="margin-bottom:60px">Witaj, ' . $_SESSION['imie']  ?> </h1>
            <p>Duis dapibus lacus ullamcorper, vestibulum leo vel, sollicitudin dui. Maecenas semper magna mi, sed
                interdum elit gravida sit amet. Maecenas feugiat id eros vitae mattis. Praesent sagittis laoreet ex, id
                hendrerit ipsum placerat eget. Nullam blandit sapien libero, at sagittis tortor accumsan ac. Nullam eget
                finibus leo, ac euismod nisl. Mauris pharetra congue sem non congue. Nullam aliquet nulla at semper
                consectetur. Maecenas eget diam a nunc imperdiet euismod sit amet ut felis.</p></br>
            <p>Nunc dapibus massa elit, ac pharetra mauris pharetra nec. Aliquam quis lorem nec odio mattis condimentum
                quis sed leo. Vivamus purus augue, luctus sed pharetra sit amet, viverra at turpis. Sed scelerisque
                semper volutpat. Vestibulum ipsum odio, bibendum vel quam imperdiet, efficitur posuere lacus. Morbi ut
                urna sed nulla fermentum egestas. Praesent mattis feugiat nisi, id congue quam vulputate ac. Sed vitae
                semper metus. Vestibulum diam tellus, porttitor sodales massa vitae, efficitur iaculis libero.</p>
</br> </br>
        </div>
        <div><img src="https://www.pngkit.com/png/detail/388-3885743_illustration-of-four-people-hugging-and-smiling-people.png" width=600></div>

<?php
    include("footer.html");
?>
    