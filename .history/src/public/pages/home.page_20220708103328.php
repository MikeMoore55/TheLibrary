<!-- this is the page, that once user has been logged in gains access to the books and other features -->

<?php
    session_start();

    if ($_SESSION["is-signed-in"] === false) {
        header("location: signIn"); 
    };

    include "/MAMP/htdocs/TheLibrary/config/database.config.php";

    $conn = connect();

    $sql = "SELECT * FROM books";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

            while($row = $result->fetch_assoc()) {
                // create variables from db        
                echo "id= ".$row["book_id"]." name= ".$row["book_name"]." author= ".$row["book_author"]." genre= ".$row["id"]."";
            }

        } 

?>

<main class="home">
    
</main>