<!-- this page is for users who are librarians only -->
<?
    session_start();

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
<main class="librarian">

    <!-- buttons for librarian to alter books $ author database -->
    <div class="admin-buttons">
        <!-- add books -->
        <form>
            <input type="submit" value="Add a new Book" name="newBook" class="btn btn-primary mb-3">
        </form>
        <!-- update books -->
        <form>
            <input type="submit" value="Update a Book" name="updateBook" class="btn btn-primary mb-3">
        </form>
        <!-- delete books -->
        <form>
            <input type="submit" value="Delete a Book" name="delBook" class="btn btn-primary mb-3">
        </form>
    </div>

    <div class="book-list">
        <?php
            echo $books;
        ?>
    </div>
</main>