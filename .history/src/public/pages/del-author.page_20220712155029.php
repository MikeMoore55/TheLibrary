<!-- page for librarian to delete authorss from database -->

<!-- 
    >>> naming convention <<<

    - name-name === html, js, css
    - name_name === php, sql

-->

<!-- used same styling from delete books hence why same class names -->

<?php

    include "/MAMP/htdocs/TheLibrary/config/database.config.php";
    // connect to db
    $conn = connect();
    // getting all info of books
    $sql_1 = "SELECT * FROM author_info;"; // sql statement 1

    $result = $conn->query($sql_1);
    // display all books
    if ($result->num_rows > 0) {

        while($row = $result->fetch_assoc()) {

            // display book options        
            $Author_Option .= '<option>'.$row["author_name"].'</option>';
        };

    } ;

?>

<main class="del-book">
    <!-- delete book form -->
    <form class="del-form" method="POST">
        <h3>Delete Book</h3>
        <label for="author-name" class="form-label">
            Which Author Would You Like To Remove:
        </label>
        <select id="author-name" class="form-select" aria-label="Default select example" name="Author_Selection">
            <?php
                echo $Author_Option;
            ?>
        </select>
        <br>
        <input id="remove" type="submit" class="btn btn-primary mb-3 btn-override" name="remove" value="Remove">
        <p><a href="librarian">cancel</a></p>
    </form>
</main>

<?php
    $Author_Selection = "";

    if($_SERVER["REQUEST_METHOD"]== "POST"){
        // selected book
        $Author_Selection = $_POST["Author_Selection"];
        // connect to db
        $conn = connect();
        // delete sql statement
        $sql_2 .= "DELETE FROM author_info WHERE author_name = '$Author_Selection'; ";// sql statement 1
    
        if ($conn->multi_query($sql_2) === TRUE) {
            header("location: librarian") ;
        }
        else{
            echo '<script>alert("Error, could not remove book, please try again")</script>';
        }
        // close connection
        $conn->close();

    };
?>