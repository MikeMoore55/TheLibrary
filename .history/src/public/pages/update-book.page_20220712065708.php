<!-- page for librarian to update any book on database -->

<?php

    include "/MAMP/htdocs/TheLibrary/config/database.config.php";

    $conn = connect();
    // getting all info of books
    $sql_1 = "SELECT * FROM books"; // sql statement 1

    $result = $conn->query($sql_1);

    if ($result->num_rows > 0) {

        while($row = $result->fetch_assoc()) {
            // display book option for updating        
            $book_options .= '
                                <option>
                                '.$row["book_name"].'
                                </option>';
                        
        };

    } ;

    
    if($_SERVER["REQUEST_METHOD"]== "POST"){
        // to use the selected option as a "key"
        $selected_book = $_POST["selected-book"];

        // -- initiate variables first -- //

        // initiate book name
        if (empty(trim($_POST["book_name"]))) {
            $book_name_error = "please fill in the blank area";
            $book_name = "";
        } 
        else{
            $book_name_error = "";
            $book_name = trim($_POST["book_name"]);
        }

        // initiate book author
        if (empty(trim($_POST["book_author"]))) {
            $book_author_error = "please fill in the blank area";
            $book_name = "";
        } 
        else{
            $book_author_error = "";
            $book_author = trim($_POST["book_author"]);
        }

        // initiate book year
        if (empty(trim($_POST["book_year"]))) {
            $book_year_error = "please fill in the blank area";
            $book_year = "";
        } 
        else{
            $book_year_error = "";
            $book_year = trim($_POST["book_year"]);
        }

        // initiate book genre
        if (empty(trim($_POST["book_genre"]))) {
            $book_genre_error = "please fill in the blank area";
            $book_genre = "";
        } 
        else{
            $book_genre_error = "";
            $book_genre = trim($_POST["book_genre"]);
        }

        // sql statement 2 for updating
        $sql_2 = "UPDATE `books` SET `book_name` = '$book_name', `book_year` = '$book_year', `book_genre` = '$book_genre'  WHERE `books`.`book_name` = '$selected_book'";

          // when successful, user will be taken back to librarian page, and new book will be added to list
          if ($conn->multi_query($sql_2) === TRUE) {
            header("location: librarian") ;
        }
        else {
            /* echo '<script>alert("Error, could not update book, please try again")</script>'; */
        };
    }

    // close connection
    $conn -> close();

?>

<main class="update">
    <!-- update form -->
    <form class="update-form" method="POST">
        <span id="update-close" class="close-btn">X</span>
        <h3>Update Book</h3>
        <label for="book-option" class="form-label">
            Select the book you wish to edit/update:
        </label>
        <select id="book-option" class="form-control" name="selected-book">
            <?php
                echo $book_options;
            ?>
        </select>
        <label for="book-name" class="form-label">
            enter book name:
        </label>
        <input id="book-name" type="text" class="form-control" name="book_name">
        <div class="invalid-feedback">
            Please fill in your username
        </div>
        <label for="author" class="form-label">
            enter author:
        </label>
        <input id="author" type="text" class="form-control" name="book_author">
        <label for="released-date" class="form-label">
            enter year released:
        </label>
        <input id="released-date" type="text" class="form-control"  name="book_year">
        <label for="genre" class="form-label">
            enter genre:
        </label>
        <input id="genre" type="text" class="form-control"  name="book_genre">
        <br>
        <p>(Please ensure all fields are filled out and new info is entered accordingly)</p>
        <input id="add" type="submit" class="btn btn-primary mb-3 btn-override" name="update" value="Update">
    </form>
</main>