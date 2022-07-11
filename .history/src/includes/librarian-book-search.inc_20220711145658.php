<!-- search feature for librarians -->

<?php
    include "/MAMP/htdocs/TheLibrary/config/database.config.php";
    // connect to db
    $conn = connect();

    $sql = "SELECT * FROM books";
    
    if ($result = $conn->query($sql)) {

        $search = $_REQUEST["search"];
        
        $query = "SELECT * from books where book_name like '%$search%' OR release_year like '%$search%' OR book_genre like '%$search%' OR age_group like '%$search%'"; //search books table by given parameter
        
        $result = mysqli_query($conn,$query); 

        while ($row = $result->fetch_array()) {
            $books .= ' <div class="book">
                            <h3>'.$row["book_name"].'</h3>
                            <p class="author">by '.$row["book_author"].'</p>
                            <p class="genre">'.$row["book_genre"].'</p>
                        </div>';
        }

        $result->free();
    }
    
    $conn -> close();
?>