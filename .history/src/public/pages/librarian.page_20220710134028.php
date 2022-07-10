<!-- this page is for users who are librarians only -->
<?
    session_start();

    include "/MAMP/htdocs/TheLibrary/config/database.config.php";
    include "/MAMP/htdocs/TheLibrary/src/public/js/admin-modals.js";

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

?>
<main class="librarian">

    <!-- buttons for librarian to alter books $ author database -->
    <div class="admin-buttons">
        <h3>Control Panel</h3>
        <!-- add books -->
        <form>
            <input id="add-btn" type="submit" value="Add a new Book" name="newBook" class="btn btn-primary mb-3 buttons-override">
        </form>
        <!-- update books -->
        <form>
            <input id="update-btn" type="submit" value="Update a Book" name="updateBook" class="btn btn-primary mb-3 buttons-override">
        </form>
        <!-- delete books -->
        <form>
            <input id="del-btn" type="submit" value="Delete a Book" name="delBook" class="btn btn-primary mb-3 buttons-override">
        </form>
    </div>

    <div class="book-list">
        <h3>Book List</h3>
        <div class="book-list-display">
        <?php
            echo $books;
        ?>
        </div>
    </div>

    <!-- modals for admin controls -->

    <div id="add-modal" class="add-modal">
        <?php
            include "/MAMP/htdocs/TheLibrary/src/includes/add-book-form.inc.php";
        ?>
    </div>

    <div id="update-modal" class="update-modal">
        <?php
            include "/MAMP/htdocs/TheLibrary/src/includes/update-book-form.inc.php";
        ?>
    </div>

    <div id="del-modal" class="del-modal">
        <?php
            include "/MAMP/htdocs/TheLibrary/src/includes/del-book-form.inc.php";
        ?>
    </div>
</main>