<!-- page where librarian can search through database for books -->

<?php
    include "/MAMP/htdocs/TheLibrary/config/database.config.php";
    // connect to db
    $conn = connect();

    $sql = "SELECT * FROM books";
    if ($result = $link->query($sql)) {
        if (isset($_POST['search-for'])) {
            $search = $_REQUEST["search"];
        }
        $query = "SELECT * from books where book_name like '%$search%' OR book_year like '%$search%' OR book_genre like '%$search%' OR book_author like '%$search%';"; //search books table by given parameter
    }

?>

<main>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

    <form>
        <input type="text" name="search">
        <input type="submit" name="search-for">
    </form>
</main>