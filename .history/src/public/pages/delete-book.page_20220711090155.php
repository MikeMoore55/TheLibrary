<!-- page for librarian to delete books from database -->
<?php

    include "/MAMP/htdocs/TheLibrary/config/database.config.php";
    // connect to db
    $conn = connect();
    // getting all info of books
    $sql_1 = "SELECT * FROM books;"; // sql statement 1

    $result = $conn->query($sql_1);
    // display all books
    if ($result->num_rows > 0) {

        while($row = $result->fetch_assoc()) {

            // display book options        
            $bookOption .= '<option>'.$row["book_name"].'</option>';
        };

    } ;

?>

<main class="del-book">
    <!-- delete book form -->
    <form class="del-form" method="POST">
    <span id="add-close" class="close-btn">X</span>
        <h3>Delete Book</h3>
        <label for="exampleFormControlInput1" class="form-label">
            Which Book Would You Like To Remove:
        </label>
        <select class="form-select" aria-label="Default select example" name="Book_Selection">
            <?php
                echo $bookOption;
            ?>
        </select>
        <br>
        <input type="submit" class="btn btn-primary mb-3 btn-override" name="remove" value="Remove">

    </form>
</main>

<?php
    if($_SERVER["REQUEST_METHOD"]== "POST"){
        // selected book
        $bookSelection = $_POST["Book_Selection"];
        // connect to db
        $conn = connect();
        // delete sql statement
        $sql_2 .= "DELETE FROM books WHERE book_name = '$bookSelection'; ";// sql statement 1
    
        if ($conn->multi_query($sql_2) === TRUE) {
            header("location: librarian") ;
        }
        else{
            echo '<script>alert("Error, could not remove book, please try again")</script>';
        }
        
        $conn->close();

    };
?>