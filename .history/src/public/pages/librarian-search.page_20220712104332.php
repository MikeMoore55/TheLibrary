<!-- page where librarian can search through database for books -->

<?php
    include "/MAMP/htdocs/TheLibrary/config/database.config.php";
    // connect to db
    $conn = connect();

    $sql = "SELECT * FROM books";
    if ($result = $link->query($sql)) {
        $search = $_REQUEST["search"];
        $query = "SELECT * from books where book_name like '%$search%' OR release_year like '%$search%' OR book_genre like '%$search%' OR age_group like '%$search%' OR author_id like '%$search%'"; //search books table by given parameter
        
?>