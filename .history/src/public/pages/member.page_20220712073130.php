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

    $sort = @$_POST['order'];
    if (!empty($sort)) {
        $sql = "SELECT * FROM books ORDER BY $sort ASC"; // If you Sort it with value of your  select options
    } else {
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
        <form method="post">
            <select class="form-control" name="order" title="Sort By">
                <option value="book_name" title="Title">Title</option>
                <option value="author_id" title="Author">Author</option>
                <option value="book_genre" title="Genre">Genre</option>
            </select>
        </form>
    </div>
    <div class="book-display">
        <?php
            echo $books;
        ?>
    </div>
</main>