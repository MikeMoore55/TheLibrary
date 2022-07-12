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
        $query = "SELECT * from books where book_name like '%$search%' OR book_year like '%$search%' OR book_genre like '%$search%' OR book_author like '%$search%';"; //search books table by given parameter
        $result = $conn->query($query);
        
        if ($result->num_rows > 0) {

            while($row = $result->fetch_assoc()) {
                // display books        
                $books .= ' <div class="book">
                                <h4>'.$row["book_name"].'</h4>
                                <p class="author">by '.$row["book_author"].'</p>
                                <p class="genre">'.$row["book_genre"].'</p>
                            </div>';
            };
    
        } ;
    }

?>

<main>

    <form method="post" class="search-form">
        <input type="text" name="search" class="book-search" >
        <input type="submit" name="search-for" value="search" class="btn btn-primary mb-3 buttons-override">
    </form>

    <div class="search-books">
        <?php
            echo $books;
        ?>
    </div>
</main>