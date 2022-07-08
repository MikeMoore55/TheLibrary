<!-- this is the page, that once user has been logged in gains access to the books and other features -->

<?php
    session_start();

    //ensure user is signed in
    if ($_SESSION["is-signed-in"] === false) {
        header("location: signIn"); 
    };

    if ($_SESSION["user-type"] == "librarian") {
        include "/MAMP/htdocs/TheLibrary/src/public/pages/libarian.page.php";
    }
    else{
        include "/MAMP/htdocs/TheLibrary/src/public/pages/member.page.php";
    }

?>