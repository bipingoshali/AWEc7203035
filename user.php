<?php
require "includes/header.php";
?>

<?php
require "includes/side-nav.php";
?>

<?php
require "includes/classes/user.php";
$user = new user();
$alert = new alert();
?>

<?php
require "includes/functions/session.php";
$session = new session();
$session->adminPageSession();
?>


    <div class="well">
        <h1>User List</h1>

        <div class="row">
            <div class="col-sm-12 col-md-12">

                <!--Search form-->
                <form class="form-inline pull-right" method="get">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">Search User</span>
                            <input type="text"
                                   name="search_text" id="search_text" placeholder="Search User" class="form-control">
                        </div>
                    </div>
                </form>

            </div>
        </div> <!-- /.row -->

        <hr>

        <div id="result"></div>

        <script type="text/javascript">
            $(document).ready(function(){
                load_data();
                function load_data(query) {
                    $.ajax({
                        url:"ajax-live-search.php",
                        method:"post",
                        data:{query:query},
                        success:function (data) {
                            $('#result').html(data);
                        }
                    });
                }


                    $('#search_text').keyup(function(){
                    var search = $(this).val();
                    if(search != ''){
                        load_data(search);
                    }else{
                        load_data();
                    }
                });


            });
        </script>

    </div>


<?php
require "includes/footer.php";
?>