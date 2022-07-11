<!-- search feature for librarians -->

<?php
    include "/MAMP/htdocs/TheLibrary/config/database.config.php";
    // connect to db
    $conn = connect();

    $sql = "SELECT * FROM books";
    
    if ($result = $conn->query($sql)) {
        $search = $_REQUEST["search"];
        $query = "SELECT * from books where book_name like '%$search%' OR release_year like '%$search%' OR book_genre like '%$search%' OR age_group like '%$search%'"; //search books table by given parameter
        $result = mysqli_query($link,$query); 
    } 
?>