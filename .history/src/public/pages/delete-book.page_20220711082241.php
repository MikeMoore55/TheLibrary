<!-- page for librarian to delete books from database -->
<?php
// DELETE FROM name WHERE condition [SQL]

    include "/MAMP/htdocs/TheLibrary/config/database.config.php";

    $conn = connect();
    // getting all info of books
    $sql_1 = "SELECT * FROM books";

    $result = $conn->query($sql_1);

    if ($result->num_rows > 0) {

        while($row = $result->fetch_assoc()) {

            // display book options        
            $bookOption .= '<option>'.$row["book_name"].'</option>';
        };

    } ;

?>

<main class="del-book">
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

        $bookSelection = $_POST["Book_Selection"];

        $conn = connect();

        $sql_2 .= "DELETE FROM books WHERE book_name = '$bookSelection'; ";
    
        if ($conn->multi_query($sql_2) === TRUE) {
            echo "book removed successfully";
            header("location: librarian") ;
        }
        else{
            echo "error";
        }
        
        $conn->close();

    };
?>