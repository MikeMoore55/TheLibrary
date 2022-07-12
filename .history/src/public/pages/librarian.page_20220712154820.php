<!-- this page is for users who are librarians only -->

<!-- 
    >>> naming convention <<<

    - name-name === html, js, css
    - name_name === php, sql

-->

<?php
    session_start();

    include "/MAMP/htdocs/TheLibrary/config/database.config.php";
    // connect to db
    $conn = connect();

    
    if (isset($_POST["sort-by"])) {
        $sort = $_POST['order'];

        $sql .= "SELECT * FROM books ORDER BY $sort ASC"; // If you Sort it with value of the sort options
    } 
    else{
        $sql .= "SELECT * FROM books ORDER BY book_name ASC"; // Else if you do not pass any value from select option will return this
    };

    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {

        while($row = $result->fetch_assoc()) {
            // display books        
            $books .= ' <div class="book">
                            <h4>'.$row["book_name"].'</h4>
                            <p class="author">by '.$row["book_author"].'</p>
                            <p class="genre">'.$row["book_genre"].'</p>
                        </div>';
        };

    } ;

    // close connection
    $conn -> close();

?>

<main class="librarian-main">
<div class="librarian">
  <!-- buttons for librarian to alter books & author database -->
    <div class="admin-buttons">
        <h3>Control Panel</h3>
        <!-- add books -->
        <p class="btn btn-primary mb-3 buttons-override"><a style="color: white;" href="add">Add a New Book</a></p>
        <!-- add author -->
        <p class="btn btn-primary mb-3 buttons-override"><a style="color: white;" href="add-author">Add a New Author</a></p>
        <!-- update books -->
        <p class="btn btn-primary mb-3 buttons-override"><a style="color: white;" href="update">Update a Book</a></p>
        <!-- delete books -->
        <p class="btn btn-primary mb-3 buttons-override"><a style="color: white;" href="del">Delete a Book</a></p>
        <!-- delete Author -->
        <p class="btn btn-primary mb-3 buttons-override"><a style="color: white;" href="del">Delete an Author</a></p>
        <p class="btn btn-primary mb-3 buttons-override"><a style="color: white;" href="search-librarian">Search for a Book</a></p>
    </div>
    <!-- area where all books will be displayed even once edited -->
    <div class="book-list">
        
        <div class="sort-feature">
            <form method="POST" class="sort-form">
                <select class="form-select" name="order" title="Sort By">
                    <option value="book_name">book_name</option>
                    <option value="book_author">book_author</option>
                    <option value="book_genre">book_genre</option>
                </select>
                <input type="submit" name="sort-by" value="sort" class="btn btn-primary btn-override">
            </form>
        </div>
        

        <h3>Book List</h3>
        
        <div class="book-list-display">
            <div class="results">
                <?php        
                    echo $books;
                ?>
            </div>
        </div>
    </div>
</div>
</main>
