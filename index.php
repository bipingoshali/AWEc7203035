<?php
require "includes/header.php";
?>

<?php
require "includes/side-nav.php";
?>

<?php
require "includes/classes/book.php";
require "includes/functions/alert.php";
$book = new book();
$alert = new alert();
?>

    <div class="well">

        <h1>Welcome to My Website</h1>

        <!-- works only if session is set-->
        <!-- or works only if user has login successfully-->


        <?php
        if(isset($_SESSION['user_id'])){


            //works only if admin has login
            //start
            if($_SESSION['user_id']=="admin"){
                ?>
                    <h3>Admin Area</h3>
                <?php

            //end

            //works only if registered user has login
            //start
            }else{
                ?>
                <h2><span class="glyphicon glyphicon-book"></span> Book List</h2>

                <div class="row">
                    <div class="col-sm-6 col-md-6">

                        <!--Browse form-->
                        <form class="form-inline" method="get">
                            <div class="form-group">
                                <label>Filter Book</label>
                                <select class="form-control" name="browse">
                                    <?php
                                    if(isset($_GET['browse'])){
                                        $browse = $_GET['browse'];
                                        echo '<option value="'.$browse.'">'.$browse.'</option>';
                                    }
                                    ?>
                                    <option value="All">All</option>
                                    <option value="Science Fiction">Science Fiction</option>
                                    <option value="Adventure">Adventure</option>
                                    <option value="Romance">Romance</option>
                                    <option value="Action Drama">Action Drama</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success">Filter</button>
                        </form>

                    </div> <!-- /.col-sm-6 col-md-6 -->
                    <div class="col-sm-6 col-md-6">

                        <!--Search form-->
                        <form class="form-inline pull-right" method="get">
                            <div class="form-group">
                                <label>Search Book</label>
                                <input type="text" class="form-control" placeholder="Search Book" name="search" required="required">
                            </div>
                            <button type="submit" class="btn btn-success">Search</button>
                        </form>

                    </div> <!-- /.col-sm-6 col-md-6 -->
                </div> <!-- /.row -->

                <hr>

                <?php
            }
            ?>
            <?php
        }
        ?>



        <?php
        if(isset($_SESSION['user_id'])){
            if($_SESSION['user_id']!="admin"){
                    if(!isset($_GET['search']) and !isset($_GET['browse'])){
                ?>
                <div class="row">
                    <div class="col-sm-12 col-md-12">

                        <!-- Image Slider -->

                        <div id="myCarousel" class="carousel slide" data-ride="carousel" style="padding: 20px;">
                            <!-- Wrapper for slides -->
                            <div class="carousel-inner">
                                <?php
                                $books = $book->selectGiveaway();
                                foreach ($books as $booksRow){
                                    if($booksRow["carousel_index"]==1){
                                        echo '<div class="item active">';
                                        echo '<h2 style="text-align: center;margin-top:0px;">Book Giveaway</h2>';
                                        echo '<div style="float: left;">';
                                        echo '<img src="assets/images/'.$booksRow["book_image"].'" alt="'.$booksRow["book_image"].'" style="max-width: 250px;max-height: 250px;margin-left: 100px;">';
                                        echo '</div>';
                                        echo '<div style="float: left;margin-left: 50px;">';
                                        echo '<h3 style="margin-left: 100px;">'.$booksRow["book_name"].'</h3>';
                                        echo '<strong>Author : </strong>'.$booksRow["author"].'<br>';
                                        echo '<strong>ISBN : </strong>'.$booksRow["ISBN"].'<br>';
                                        echo '<strong>Publication Date : </strong>'.$booksRow["publication_date"].'<br>';
                                        echo '<strong>Publisher : </strong>'.$booksRow["publisher"].'<br>';
                                        echo '<strong>Genre : </strong>'.$booksRow["book_genre"].'<br>';
                                        echo '<button class="btn btn-success">Claim</button>';
                                        echo '</div>';
                                        echo '</div>';
                                    }else{
                                        echo '<div class="item">';
                                        echo '<h2 style="text-align: center;margin-top:0px;">Book Giveaway</h2>';
                                        echo '<div style="float: left;">';
                                        echo '<img src="assets/images/'.$booksRow["book_image"].'" alt="'.$booksRow["book_image"].'" style="max-width: 250px;max-height: 250px;margin-left: 100px;">';
                                        echo '</div>';
                                        echo '<div style="float: left;margin-left: 50px;">';
                                        echo '<h3 style="margin-left: 100px;">'.$booksRow["book_name"].'</h3>';
                                        echo '<strong>Author : </strong>'.$booksRow["author"].'<br>';
                                        echo '<strong>ISBN : </strong>'.$booksRow["ISBN"].'<br>';
                                        echo '<strong>Publication Date : </strong>'.$booksRow["publication_date"].'<br>';
                                        echo '<strong>Publisher : </strong>'.$booksRow["publisher"].'<br>';
                                        echo '<strong>Genre : </strong>'.$booksRow["book_genre"].'<br>';
                                        echo '<button class="btn btn-success">Claim</button>';
                                        echo '</div>';
                                        echo '</div>';
                                    }
                                }


                                ?>
                            </div>

                            <!-- Left and right controls -->
                            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="right carousel-control" href="#myCarousel" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>

                        <!-- Image Slider - end -->

                    </div> <!-- /.col-sm-12 col-md-12 -->
                </div> <!-- /.row -->
                        <hr>
                <?php
                    }
            }
        }
        ?>




        <div class="row">
            <?php
            $limit = 4;
            if (isset($_GET["page"])) {
                $page  = $_GET["page"];
            }else{
                $page=1;
            };
            $start_from = ($page-1) * $limit;

            if(isset($_SESSION['user_id'])){

                if($_SESSION['user_id']=="admin"){

                }else{

                    //is viewed only if the user is normal user
                    //works in search case
                    if(isset($_GET['search'])){
                        $search = $_GET['search'];
                        if(!$book->searchBook($search)){
                            $alert->alert_danger('Sorry! 0 book found.');
                        }else{
                            $books = $book->searchBook($search);
                            foreach ($books as $booksRow){
                                echo '<div class="col-sm-6 col-md-6 show-book-css">';
                                echo '<div class="image-css">';
                                echo '<img src="assets/images/'.$booksRow["book_image"].'">';
                                echo '</div>';
                                echo '<h4><strong>'.$booksRow["book_name"].'</strong></h4>';
                                echo '<p><strong>Author: </strong>'.$booksRow["author"].'</p>';
                                echo '<p><strong>ISBN: </strong>'.$booksRow["ISBN"].'</p>';
                                echo '<p><strong>Date: </strong>'.$booksRow["publication_date"].'</p>';
                                echo '<p><strong>Publisher: </strong>'.$booksRow["publisher"].'</p>';
                                echo '<p><strong>Genre: </strong>'.$booksRow["book_genre"].'</p>';
                                echo '</div>';
                            }
                        }
                    }

                    //works in browse case
                    elseif(isset($_GET['browse'])){
                        $browse = $_GET['browse'];
                        if($browse=="All"){
                            $books = $book->selectBook($start_from,$limit);
                            foreach ($books as $booksRow){
                                echo '<div class="col-sm-6 col-md-6 show-book-css">';
                                echo '<div class="image-css">';
                                echo '<img src="assets/images/'.$booksRow["book_image"].'">';
                                echo '</div>';
                                echo '<h4><strong>'.$booksRow["book_name"].'</strong></h4>';
                                echo '<p><strong>Author: </strong>'.$booksRow["author"].'</p>';
                                echo '<p><strong>ISBN: </strong>'.$booksRow["ISBN"].'</p>';
                                echo '<p><strong>Date: </strong>'.$booksRow["publication_date"].'</p>';
                                echo '<p><strong>Publisher: </strong>'.$booksRow["publisher"].'</p>';
                                echo '<p><strong>Genre: </strong>'.$booksRow["book_genre"].'</p>';
                                echo '</div>';
                            }
                            $total_records = $book->countBook();
                            $total_pages = ceil($total_records / $limit);
                            $pagLink = "<nav><ul class='pagination'>";
                            for ($i=1; $i<=$total_pages; $i++) {
                                $pagLink .= "<li><a href='index.php?page=".$i."'>".$i."</a></li>";
                            };
                            echo $pagLink . "</ul></nav>";
                        }else{
                            if(!$book->browseBook($browse)){
                                $alert->alert_danger('Sorry! 0 book from this genre');
                            }else{
                                $books = $book->browseBook($browse);
                                foreach ($books as $booksRow){
                                    echo '<div class="col-sm-6 col-md-6 show-book-css">';
                                    echo '<div class="image-css">';
                                    echo '<img src="assets/images/'.$booksRow["book_image"].'">';
                                    echo '</div>';
                                    echo '<h4><strong>'.$booksRow["book_name"].'</strong></h4>';
                                    echo '<p><strong>Author: </strong>'.$booksRow["author"].'</p>';
                                    echo '<p><strong>ISBN: </strong>'.$booksRow["ISBN"].'</p>';
                                    echo '<p><strong>Date: </strong>'.$booksRow["publication_date"].'</p>';
                                    echo '<p><strong>Publisher: </strong>'.$booksRow["publisher"].'</p>';
                                    echo '<p><strong>Genre: </strong>'.$booksRow["book_genre"].'</p>';
                                    echo '</div>';
                                }
                            }
                        }
                    }

                    else{
                        if(!$book->selectBook($start_from,$limit)){
                            $alert->alert_danger('0 Book');
                        }else{
                            $books = $book->selectBook($start_from,$limit);
                            foreach ($books as $booksRow){
                                echo '<div class="col-sm-6 col-md-6 show-book-css">';
                                echo '<div class="image-css">';
                                echo '<img src="assets/images/'.$booksRow["book_image"].'">';
                                echo '</div>';
                                echo '<h4><strong>'.$booksRow["book_name"].'</strong></h4>';
                                echo '<p><strong>Author: </strong>'.$booksRow["author"].'</p>';
                                echo '<p><strong>ISBN: </strong>'.$booksRow["ISBN"].'</p>';
                                echo '<p><strong>Date: </strong>'.$booksRow["publication_date"].'</p>';
                                echo '<p><strong>Publisher: </strong>'.$booksRow["publisher"].'</p>';
                                echo '<p><strong>Genre: </strong>'.$booksRow["book_genre"].'</p>';
                                echo '</div>';
                            }
                        }
                        $total_records = $book->countBook();
                        $total_pages = ceil($total_records / $limit);
                        $pagLink = "<nav><ul class='pagination'>";
                        for ($i=1; $i<=$total_pages; $i++) {
                            $pagLink .= "<li><a href='index.php?page=".$i."'>".$i."</a></li>";
                        };
                        echo $pagLink . "</ul></nav>";
                    }
                }
            }
            ?>

        </div> <!-- /.row -->
    </div> <!-- /.well -->

    <script>
        $(document).ready(function(){
            $('.pagination').pagination({
                items: <?php echo $total_records;?>,
                itemsOnPage: <?php echo $limit;?>,
                cssStyle: 'light-theme',
                currentPage : <?php echo $page;?>,
                hrefTextPrefix : 'index.php?page='
            });
        });
    </script>



<?php
require "includes/footer.php";
?>