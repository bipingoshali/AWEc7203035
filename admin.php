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

    <div class="well">
        <?php
        require "includes/classes/book.php";
        require "includes/functions/alert.php";
        $book = new book();
        $alert = new alert();
        if (isset($_POST['addBook_btn'])){

            $book_imageName = $_FILES['book_image']['name'];
            $book_image_type =pathinfo($book_imageName,PATHINFO_EXTENSION);

            $book->setBookName($_POST['bookName']);
            $book->setAuthor($_POST['author']);
            $book->setISBN($_POST['ISBN']);
            $book->setPublicationDate($_POST['publicationDate']);
            $book->setPublisher($_POST['publisher']);
            $book->setBookImage($book_imageName);
            $book->setBookGenre($_POST['book_genre']);

            if($book_image_type=="jpg" || $book_image_type=="png" || $book_image_type=="JPG" || $book_image_type=="PNG"){
                move_uploaded_file($_FILES['book_image']['tmp_name'],'assets/images/'.$book_imageName);
                $book->addBook();
                $alert->alert_success('Book added successfully');
            }else{
                $alert->alert_danger("Unsupported File! Please upload .jpg or .png file only.");
            }
        }
        ?>

        <h1>Books</h1>
        <a style="margin-bottom: 10px;" class="btn btn-primary" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            Add Book
        </a>
        <div class="collapse" id="collapseExample">
            <div class="well">
                <form method="post" enctype="multipart/form-data">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Enter Book Name</label>
                            <input name="bookName"  type="text" placeholder="Book Name" class="form-control" required="required">
                        </div>
                        <div class="form-group">
                            <label>Enter ISBN</label>
                            <input name="ISBN" id="ISBN" type="text" placeholder="ISBN" class="form-control" required="required">
                            <span id="ISBN_message"></span>
                        </div>
                        <div class="form-group">
                            <label>Enter Publisher</label>
                            <input name="publisher" type="text" placeholder="Publisher" class="form-control" required="required">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Enter Author Name</label>
                            <input  name="author" type="text" placeholder="Author Name" class="form-control" required="required">
                        </div>
                        <div class="form-group">
                            <label>Enter Publication Date</label>
                            <input name="publicationDate" type="date" class="form-control" required="required">
                        </div>
                        <div class="form-group">
                            <label>Select Genre</label>
                            <Select class="form-control" name="book_genre" required="required">
                                <option value="Science Fiction">Science Fiction</option>
                                <option value="Romance">Romance</option>
                                <option value="Action Drama">Action Drama</option>
                                <option value="Adventure">Adventure</option>
                            </Select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Select Picture</label>
                        <input name="book_image" type="file" class="form-control" required="required">
                    </div>
                    <div class="row">
                        <button name="addBook_btn" id="addBook_btn" type="submit" class="btn btn-success" style="margin-left: 30px;margin-top: 10px;">Add Book</button>
                        <button class="btn btn-danger" type="button" data-toggle="collapse" style="margin-top: 10px;" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                            Close
                        </button>
                    </div>
                </form>

            </div>
        </div> <!-- /.collapse -->

        <table class="table table-bordered" style="font-size: small;">
            <thead>
            <tr>
                <th>S.N.</th>
                <th>Image</th>
                <th>Name</th>
                <th>Details</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $count=0;
            $limit = 4;
            if (isset($_GET["page"])) {
                $page  = $_GET["page"];
            }else{
                $page=1;
            };
            $start_from = ($page-1) * $limit;
            $delete_message = "'Are you sure to delete?'";
            if(!$book->selectBook($start_from,$limit)){
                echo '<div class="alert alert-danger">0 Book added till now</div>';
            }else{
                $fetchBooks= $book->selectBook($start_from,$limit);
                foreach($fetchBooks as $fetchBooksRow){
                    $count++;
                    echo' <tr>';
                    echo' <td>'.$count.'</td>';
                    echo' <td><img style="max-width: 100px;max-height: 100px;" src="assets/images/'.$fetchBooksRow["book_image"].'"></td>';
                    echo'<td>'.$fetchBooksRow["book_name"].'</td>';
                    echo'<td>
                                <strong>Author : </strong>'.$fetchBooksRow["author"].'<br/>
                                <strong>ISBN : </strong>'.$fetchBooksRow["ISBN"].'<br/>
                                <strong>Publication Date : </strong>'.$fetchBooksRow["publication_date"].'<br/>
                                <strong>Publisher : </strong>'.$fetchBooksRow["publisher"].'<br/>
                                <strong>Genre : </strong>'.$fetchBooksRow["book_genre"].'<br/>
                                </td>';
                    echo'<td>
                            <a href="edit_book.php?book_id='.$fetchBooksRow["book_id"].'" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-edit"></span></a>
                            <a onclick ="return confirm('.$delete_message.')" href="delete_book.php?book_id='.$fetchBooksRow["book_id"].'" class="btn btn-danger btn-sm" title="Delete">
                                <span class="glyphicon glyphicon-trash"></span>
                            </a>                            
                            </td>';
                    echo' </tr>';
                }
                $total_records = $book->countBook();
                $total_pages = ceil($total_records / $limit);
                $pagLink = "<nav><ul class='pagination'>";
                for ($i=1; $i<=$total_pages; $i++) {
                    $pagLink .= "<li><a href='index.php?page=".$i."'>".$i."</a></li>";
                };
                echo $pagLink . "</ul></nav>";
            }
            ?>
            </tbody>
        </table>

    </div> <!-- /.well -->

    <script type="text/javascript">
        $(document).ready(function(){
            $('.pagination').pagination({
                items: <?php echo $total_records;?>,
                itemsOnPage: <?php echo $limit;?>,
                cssStyle: 'light-theme',
                currentPage : <?php echo $page;?>,
                hrefTextPrefix : 'admin.php?page='
            });

            $('#ISBN').keyup(function () {
                var ISBN = $(this).val();
                $.post("ISBN_availability.php",{ISBN:ISBN},function (data) {
                    if(data.status==true){
                        $('#ISBN_message').attr('class','label label-success');
                        $("#addBook_btn").removeAttr("disabled");
                        $('#ISBN_message').html("");
                    }else{
                        $('#ISBN_message').attr('class','label label-danger');
                        $("#addBook_btn").attr("disabled","disabled");
                        $('#ISBN_message').html("Sorry! This ISBN is already registered in our system.");
                    }
                },'json');
            });

        });
    </script>


<?php
require "includes/footer.php";
?>