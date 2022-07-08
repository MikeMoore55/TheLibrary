<!-- this is the page, that once user has been logged in gains access to the books and other features -->

<?php
    session_start();

    //ensure user is signed in
    if ($_SESSION["is-signed-in"] === false) {
        header("location: signIn"); 
    };

    if ($_SESSION["user_type"] === "librarian") {
        header("location: librarian");
    }
  /*   
    else{
        include "/MAMP/htdocs/TheLibrary/src/public/pages/member.page.php";
    } */



    include "/MAMP/htdocs/TheLibrary/config/database.config.php";

    $conn = connect();
    // getting all info of books
    $sql = "SELECT * FROM books";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

            while($row = $result->fetch_assoc()) {
                // display books        
                $books .= ' <div class="book">
                                <h3>'.$row["book_name"].'</h3>
                                <p class="author">by '.$row["book_author"].'</p>
                                <p class="genre">'.$row["book_genre"].'</p>
                            </div>';
            };

        } ;

?>

<main class="home">

<div class="book-display">
    <?php
        echo $books;
    ?>
</div>
</main>

