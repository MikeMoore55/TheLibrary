<!-- page for librarian to add new author to database once the new book has been added -->

<!-- 
    >>> naming convention <<<

    - name-name === html, js, css
    - name_name === php, sql

-->

<!-- note: i used same styling from add book hence why same names -->
<?php
    session_start();

    include "/MAMP/htdocs/TheLibrary/config/database.config.php";
    //connect to db
    $conn = connect();

    /* check if any errors, if there is will display helpers under input boxes */
    if ($_SESSION["error"] = TRUE) {
        echo '  <script>
                    document.querySelector("#error").style.display = "block";
                    document.querySelector("#error").style.color = "red"
                </script>';
    } 
    elseif ($_SESSION["error"] = FALSE){
        echo '  <script>
                    document.querySelector("#error").style.display = "none";
                </script>';
    }
    else{
        echo "error";
    }

    // set variables to blank
    $author_name = $author_age = "";
    $author_name_error = $author_age_error =  "";

    if($_SERVER["REQUEST_METHOD"]== "POST"){
        // -- initiate variables first -- //

        // initiate author name
        if (empty(trim($_POST["author_name"]))) {
            $author_name_error = "please fill in the blank area";
            $author_name = "";
        } 
        else{
            $author_name_error = "";
            $author_name = trim($_POST["author_name"]);
        }

        // initiate author age
        if (empty(trim($_POST["book_author"]))) {
            $author_age_error = "please fill in the blank area";
            $author_age = "";
        } 
        else{
            $author_age_error = "";
            $author_age = trim($_POST["book_author"]);
        }
        // sql insert statement

        $sql .= "INSERT INTO author_info (author_name, author_age) VALUES ('$author_name', '$author_age')";
          
        // when successful, user will be taken back to librarian page, and new book will be added to list
        if ($conn->multi_query($sql) === TRUE) {
            header("location: librarian") ;
        }
        else {
      };
        
        //close connection
        $conn->close();
    }
?>
<main class="add-book">
    <!-- add author form -->
    <form class="add-form" method="POST">
        <h3>New Book</h3>
        <label for="author-name" class="form-label">
            author name:
        </label>
        <input id="author-name" type="text" class="form-control" name="author_name">
        <div class="invalid-feedback">
            Please fill in your username
        </div>
        <label for="author_age" class="form-label">
            author age:
        </label>
        <input id="author_age" type="text" class="form-control" name="book_author">
        <br>
        <input id="add" type="submit" class="btn btn-primary mb-3 btn-override" name="add" value="Add">
        <p><a href="librarian">cancel</a></p>
    </form>
</main>