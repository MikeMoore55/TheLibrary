<!-- this page is for users who are members -->

<!-- 
    >>> naming convention <<<

    - name-name === html, js, css
    - name_name === php, sql

-->

<?php

    include "/MAMP/htdocs/TheLibrary/config/database.config.php";

    $conn = connect();
    // getting all info of books

    if (isset($_POST["sort-by"])) {
        $sort = $_POST['order'];
        $sql = "SELECT * FROM books ORDER BY $sort ASC"; // If you Sort it with value of your  select options
    } 
    else {
        $sql = "SELECT * FROM books ORDER BY book_name ASC"; // Else if you do not pass any value from select option will return this
    };


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

    // close connection
    $conn -> close();

?>

<main class="home">
    <!-- area where all books will be displayed even once edited -->
    <div class="sort-feature">
         <form method="POST" class="sort-form">
            <select class="form-control" name="order" title="Sort By">
                <option value="book_name">book_name</option>
                <option value="book_author">book_author</option>
                <option value="book_genre">book_genre</option>
            </select>
            <input type="submit" name="sort-by" value="sort" class="btn btn-primary btn-override" >
        </form>
    </div>
    <div class="book-display">
        <?php
            echo $books;
        ?>
    </div>
</main>