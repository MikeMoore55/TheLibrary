<!-- this page is for users who are librarians only -->
<?
    session_start();

    include "/MAMP/htdocs/TheLibrary/config/database.config.php";
/*     include "/MAMP/htdocs/TheLibrary/src/public/js/admin-modals.js";
 */
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
        <h3>Control Panel</h3>
        <!-- add books -->
        <button id="add-btn" type="submit" name="newBook" class="btn btn-primary mb-3 buttons-override" onclick="openAdd()">
            Add a new Book
        </button>
        <!-- update books -->
        <form>
            <input id="update-btn" type="submit" value="Update a Book" name="updateBook" class="btn btn-primary mb-3 buttons-override">
        </form>
        <!-- delete books -->
        <form>
            <input id="del-btn" type="submit" value="Delete a Book" name="delBook" class="btn btn-primary mb-3 buttons-override">
        </form>
    </div>

    <div class="book-list">
        <h3>Book List</h3>
        <div class="book-list-display">
        <?php
            echo $books;
        ?>
        </div>
    </div>

    <!-- modals for admin controls -->

    <div id="add-modal" class="add-modal">
        <?php

        $book_name = $book_author = $book_year = $book_genre = "";
        $book_name_error = $book_author_error = $book_year_error = $book_genre_error = "";

        if(isset($_POST["add"])){
            // book name
            if (empty(trim($_POST["book_name"]))) {
                $book_name_error = "please fill in the blank area";
                $book_name = "";
            } 
            else{
                $book_name_error = "";
                $book_name = $_POST["book_name"];
            }
            //book author
            if (empty(trim($_POST["book_author"]))) {
                $book_author_error = "please fill in the blank area";
                $book_name = "";
            } 
            else{
                $book_author_error = "";
                $book_author = $_POST["book_author"];
            }
            // book year
            if (empty(trim($_POST["book_year"]))) {
                $book_year_error = "please fill in the blank area";
                $book_year = "";
            } 
            else{
                $book_year_error = "";
                $book_year = $_POST["book_year"];
            }
            //book genre
            if (empty(trim($_POST["book_genre"]))) {
                $book_genre_error = "please fill in the blank area";
                $book_genre = "";
            } 
            else{
                $book_genre_error = "";
                $book_genre = $_POST["book_name"];
            }

            $sql .= "INSERT INTO books (book_name, book_author, book_year, book_genre) VALUES ('$book_name', '$book_author', '$book_year', '$book_genre')";
                
            if ($conn->multi_query($sql) === TRUE) {
                echo "book added successfully";
                header("location: librarian") ;
            }
            else {
                echo "error";        
            };
            
            //close connection
            $conn->close();
        }
    ?>

    <form class="add-form" method="POST">
        <span id="add-close" class="close-btn" onclick="closeAdd()">X</span>
        <h3>New Book</h3>
        <label for="exampleFormControlInput1" class="form-label">
            book name:
        </label>
        <input type="text" class="form-control" id="exampleFormControlInput1" name="book_name">
        <div class="invalid-feedback">
            Please fill in your username
        </div>
        <label for="exampleFormControlInput1" class="form-label">
            author:
        </label>
        <input type="text" class="form-control" id="exampleFormControlInput1" name="book_author">
        <label for="exampleFormControlInput1" class="form-label">
            year released:
        </label>
        <input type="text" class="form-control" id="exampleFormControlInput1" name="book_year">
        <label for="exampleFormControlInput1" class="form-label">
            genre:
        </label>
        <input type="text" class="form-control" id="exampleFormControlInput1" name="book_genre">

        <input type="submit" value="add" name="add" class="btn btn-primary mb-3">
    </form>
    </div>

    <div id="update-modal" class="update-modal">
        <?php
            include "/MAMP/htdocs/TheLibrary/src/includes/update-book-form.inc.php";
        ?>
    </div>

    <div id="del-modal" class="del-modal">
        <?php
            include "/MAMP/htdocs/TheLibrary/src/includes/del-book-form.inc.php";
        ?>
    </div>
</main>