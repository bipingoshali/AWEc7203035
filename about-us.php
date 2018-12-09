<?php
require "includes/header.php";
?>

<?php
require "includes/side-nav.php";
?>

<?php
require "includes/functions/session.php";
$session = new session();
$session->userPageSession();
?>

    <div class="well">
        <h1>About Us</h1>
        <div id="googleMap" style="width:100%;height:400px;"></div>
    </div>

    <script>
        function myMap() {
            var mapProp= {
                center:new google.maps.LatLng(27.6920485,85.3171415),
                zoom:5,
            };
            var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
        }
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=&callback=myMap"></script>


<?php
require "includes/footer.php";
?>