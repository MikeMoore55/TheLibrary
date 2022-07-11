<!-- page for librarian to delete books from database -->
<?php
// DELETE FROM name WHERE condition [SQL]
    include "/MAMP/htdocs/TheLibrary/config/database.config.php";

    $conn = connect();
    // getting all info of books
    $sql = "SELECT * FROM books";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        while($row = $result->fetch_assoc()) {
            // display books        
            $bookOption .= '<option>'.$Row["book_name"].'</option>';
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
        <select class="form-select" aria-label="Default select example" name="userType">
            <?php
                echo $bookOption;
            ?>
        </select>
    </form>
</main>