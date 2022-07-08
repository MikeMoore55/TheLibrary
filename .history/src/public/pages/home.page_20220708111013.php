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
                $books .= ' <div class="book">
                                <h3>'.$row["book_name"].'</h3>
                                <p>'.$row["book_author"].'</p>
                                <p>'.$row["book_genre"].'</p>
                            </div>';
            }

        } 

?>

<main class="home">
    <div>
        <?php
            echo $books;
        ?>
    </div>
</main>