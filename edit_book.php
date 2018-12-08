<?php
require "includes/header.php";
?>

<?php
require "includes/side-nav.php";
?>

<?php
require "includes/functions/session.php";
$session = new session();
$session->adminPageSession();
?>

    <!--    Breadcrumb-->
    <ol class="breadcrumb">
        <li><a href="admin.php">Books</a></li>
        <li class="active">Edit Book</li>
    </ol>

    <div class="well">

        <h1>Edit Book</h1>
        <?php
        require "includes/classes/book.php";
        $book = new book();
        require "includes/functions/alert.php";
        $alert = new alert();
        $fetchBookDetails = array(array(
            "book_name"=>"",
            "author"=>"",
            "ISBN"=>"",
            "publication_date"=>"",
            "publisher"=>"",
            "book_genre"=>""
        ));
        $fetchBookDetails = $book->selectBookByID($_GET['book_id']);

        if(isset($_POST['edit_book_btn'])){
            $book->setBookName($_POST['book_name']);
            $book->setAuthor($_POST['author']);
            $book->setISBN($_POST['ISBN']);
            $book->setPublicationDate($_POST['publication_date']);
            $book->setPublisher($_POST['publisher']);
            $book->setBookGenre($_POST['book_genre']);

            $book->editBook($_GET['book_id']);
            $alert->alert_success("Successfully Edited!");
            $fetchBookDetails = $book->selectBookByID($_GET['book_id']);
        }
        ?>
        <div class="row">
            <form method="post">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Book Name</label>
                        <input class="form-control" name="book_name" type="text" value="<?php echo $fetchBookDetails[0]['book_name'] ?>">
                    </div>
                    <div class="form-group">
                        <label>ISBN</label>
                        <input class="form-control" name="ISBN" type="text" value="<?php echo $fetchBookDetails[0]['ISBN']?>">
                    </div>
                    <div class="form-group">
                        <label>Publisher</label>
                        <input class="form-control" name="publisher" type="text" value="<?php echo $fetchBookDetails[0]['publisher']?>">
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Edit" class="btn btn-success" name="edit_book_btn">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Author</label>
                        <input class="form-control" name="author" type="text" value="<?php echo $fetchBookDetails[0]['author']?>" >
                    </div>
                    <div class="form-group">
                        <label>Publication Date</label>
                        <input class="form-control" name="publication_date" type="date" value="<?php echo $fetchBookDetails[0]['publication_date']?>">
                    </div>
                    <div class="form-group">
                        <label>Select Genre</label>
                        <Select name="book_genre" class="form-control">
                            <option value="<?php echo $fetchBookDetails[0]['book_genre'] ?>"><?php echo $fetchBookDetails[0]['book_genre'] ?></option>
                            <option value="Science Fiction">Science Fiction</option>
                            <option value="Romance">Romance</option>
                            <option value="Action Drama">Action Drama</option>
                            <option value="Adventure">Adventure</option>
                        </Select>
                    </div>
                </div>
            </form>

        </div> <!-- /.row -->
    </div> <!-- /.well -->

<?php
require "includes/footer.php";
?>