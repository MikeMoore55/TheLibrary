<!-- page for librarian to add new book to database -->

<!-- 
    >>> naming convention <<<

    - name-name === html, js, css
    - name_name === php, sql

-->
<?php
    session_start();

    include "/MAMP/htdocs/TheLibrary/config/database.config.php";
    //connect to db
    $conn = connect();

    // set variables to blank
    $book_name = $book_author = $book_year = $book_genre = "";
    $book_name_error = $book_author_error = $book_year_error = $book_genre_error = "";

    if($_SERVER["REQUEST_METHOD"]== "POST"){
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

        // sql insert statement

        $sql .= "INSERT INTO books (book_name, book_author, book_year, book_genre) VALUES ('$book_name', '$book_author', '$book_year', '$book_genre')";
          
        // when successful, user will be taken back to librarian page, and new book will be added to list
        if ($conn->multi_query($sql) === TRUE) {
            header("location: librarian") ;
        }
        else {
/*             echo '<script>alert("Error, could not add book, please try again")</script>';
 */        };
        
        //close connection
        $conn->close();
    }
?>
<main class="add-book">
    <!-- add book form -->
    <form class="add-form" method="POST">
        <h3>New Book</h3>
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
        <p><a href="librarian">cancel</a></p>
        <br>
        <input id="add" type="submit" class="btn btn-primary mb-3 btn-override" name="add" value="Add">
    </form>
</main>