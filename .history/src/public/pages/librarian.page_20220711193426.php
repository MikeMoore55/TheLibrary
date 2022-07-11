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
    // getting all info of books
    $sql = "SELECT * FROM books";

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

    if (isset($_POST["search"])) {
        $search = $_POST["search-input"];

        $query .= "SELECT * FROM books WHERE book_name like '%$search%' OR book_year like '%$search%' OR book_genre like '%$search%' OR book_author like '%$search%';"; //search books table by given parameter

        $search_result = $conn->query($query);
        
        if ($search_result->num_rows > 0) {
    
            while($new_row = $search_result->fetch_assoc()) {
                $search_books .= ' 
                            <div class="book">
                                <h3>'.$new_row["book_name"].'</h3>
                                <p class="author">by '.$new_row["book_author"].'</p>
                                <p class="genre">'.$new_row["book_genre"].'</p>
                            </div>';
            }; 

        }
    }

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
        <div>
            <form method="POST">
                <input type="text" name="search-input">
                <input type="submit" value="search">
            </form>
        </div>
        <div class="book-list-display">
            <div class="searched">
                <?php
                     echo $search_books
                ?>
            </div>
            <div class="results">
                <?php        
                    echo $books;
                ?>
            </div>
        </div>
    </div>
</div>
</main>
