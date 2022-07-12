<!-- page where member can search through database for books but only by author -->

<!-- page where librarian can search through database for books -->

<?php
    include "/MAMP/htdocs/TheLibrary/config/database.config.php";
    // connect to db
    $conn = connect();

    $sql = "SELECT * FROM books";
    if ($result = $conn->query($sql)) {
        if (isset($_POST['search-for'])) {
            $search = $_REQUEST["search"];
        }
        $query = "SELECT * from authors_books where book_year like '%$search%' OR book_genre like '%$search%' OR author_name like '%$search%';"; //search books table by given parameter
        $result = $conn->query($query);
        
        if ($result->num_rows > 0) {

            while($row = $result->fetch_assoc()) {
                // display books        
                $books .= ' <div class="book">
                                <h4>'.$row["book_name"].'</h4>
                                <p class="author">by '.$row["author_name"].'</p>
                                <p class="genre">'.$row["book_genre"].'</p>
                            </div>';
            };
    
        } ;
    }

?>

<main>

    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

    <form method="post" class="search-form">
        <input type="text" name="search" >
        <input type="submit" name="search-for" value="search" class="btn btn-primary mb-3 buttons-override">
    </form>

    <div class="search-books">
        <?php
            echo $books;
        ?>
    </div>
</main>