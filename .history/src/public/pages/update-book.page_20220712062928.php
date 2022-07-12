<!-- page for librarian to update any book on database -->


<main class="update">
    <form class="add-form" method="POST">
        <span id="add-close" class="close-btn">X</span>
        <h3>Update Book</h3>
        <label for="book-option" class="form-label">
            Select the book you wish to edit/update::
        </label>
        <select id="book-option" class="form-control">
            <?php

            ?>
        </select>
        <label for="book-name" class="form-label">
            book name:
        </label>
        <input id="book-name" type="text" class="form-control" name="book_name">
        <div class="invalid-feedback">
            Please fill in your username
        </div>
        <label for="author" class="form-label">
            author:
        </label>
        <input id="author" type="text" class="form-control" name="book_author">
        <label for="released-date" class="form-label">
            year released:
        </label>
        <input id="released-date" type="text" class="form-control"  name="book_year">
        <label for="genre" class="form-label">
            genre:
        </label>
        <input id="genre" type="text" class="form-control"  name="book_genre">
        <br>
        <input id="add" type="submit" class="btn btn-primary mb-3 btn-override" name="add" value="Add">
    </form>
</main>