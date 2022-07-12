<!-- page for librarian to update any book on database -->

<?php

    include "/MAMP/htdocs/TheLibrary/config/database.config.php";

    $conn = connect();
    // getting all info of books
    $sql_1 = "SELECT * FROM books"; // sql statement 1

    $result = $conn->query($sql_1);

    if ($result->num_rows > 0) {

        while($row = $result->fetch_assoc()) {
            // display books        
            $book_options .= ' <div class="book">
                            <h3>'.$row["book_name"].'</h3>
                            <p class="author">by '.$row["book_author"].'</p>
                            <p class="genre">'.$row["book_genre"].'</p>
                        </div>';
        };

    } ;

    // close connection
    $conn -> close();

?>

<main class="update">
    <form class="add-form" method="POST">
        <span id="add-close" class="close-btn">X</span>
        <h3>Update Book</h3>
        <label for="book-option" class="form-label">
            Select the book you wish to edit/update::
        </label>
        <select id="book-option" class="form-control">
            <?php

            ?>
        </select>
        <label for="book-name" class="form-label">
            book name:
        </label>
        <input id="book-name" type="text" class="form-control" name="book_name">
        <div class="invalid-feedback">
            Please fill in your username
        </div>
        <label for="author" class="form-label">
            author:
        </label>
        <input id="author" type="text" class="form-control" name="book_author">
        <label for="released-date" class="form-label">
            year released:
        </label>
        <input id="released-date" type="text" class="form-control"  name="book_year">
        <label for="genre" class="form-label">
            genre:
        </label>
        <input id="genre" type="text" class="form-control"  name="book_genre">
        <br>
        <input id="add" type="submit" class="btn btn-primary mb-3 btn-override" name="add" value="Add">
    </form>
</main>