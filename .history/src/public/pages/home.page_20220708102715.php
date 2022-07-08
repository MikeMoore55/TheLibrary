<!-- this is the page, that once user has been logged in gains access to the books and other features -->

<?php
    session_start();

    if ($_SESSION["is-signed-in"] === false) {
        header("location: signIn"); 
    }
?>

<main class="home">
    
</main>