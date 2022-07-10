<?php
    session_start();

    include "/MAMP/htdocs/TheLibrary/config/database.config.php";

    $conn = connect();

    $book_name = $book_author = $book_year = $book_genre = "";
    $book_name_error = $book_author_error = $book_year_error = $book_genre_error = "";

    if($_SERVER["REQUEST_METHOD"]== "POST"){

        if (empty(trim($_POST["book_name"]))) {
            $book_name_error = "please fill in the blank area";
            $book_name = "";
        }

        $sql .= "INSERT INTO books (book_name, book_author, book_year, book_genre) VALUES ('$username', '$age', '$password', '$userType')";
            
        if ($conn->multi_query($sql) === TRUE) {
            echo "book added succesfully";
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
</form>