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

    $sort = $_POST['order'];
    if (isset($sort)) {
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

<main class="librarian-main">
<div class="librarian">
  <!-- buttons for librarian to alter books & author database -->
    <div class="admin-buttons">
        <h3>Control Panel</h3>
        <!-- add books -->
        <form action="add-book" method="POST">
            <input id="add-btn" type="submit" value="Add a New Book" name="updateBook" class="btn btn-primary mb-3 buttons-override">
        </form>
        <!-- update books -->
        <form action="update-book" method="POST">
            <input id="update-btn" type="submit" value="Update a Book" name="updateBook" class="btn btn-primary mb-3 buttons-override">
        </form>
        <!-- delete books -->
        <form action="del-book" method="POST">
            <input id="del-btn" type="submit" value="Delete a Book" name="delBook" class="btn btn-primary mb-3 buttons-override">
        </form>
    </div>
    <!-- area where all books will be displayed even once edited -->
    <div class="book-list">
        <h3>Book List</h3>
        <div class="sort-feature">
            <form method="POST">
                <select class="form-control" name="order" title="Sort By">
                    <option>sort by ></option>
                    <option value="book_name" title="Title">Title</option>
                    <option value="author_id" title="Author">Author</option>
                    <option value="book_genre" title="Genre">Genre</option>
                </select>
            </form>
        </div>
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
