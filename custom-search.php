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
        <h1>Custom Search</h1>

        <!--        custom search-->

        <script>
            (function() {
                var cx = '006305013699658622075:nnskpdty41s';
                var gcse = document.createElement('script');
                gcse.type = 'text/javascript';
                gcse.async = true;
                gcse.src = 'https://cse.google.com/cse.js?cx=' + cx;
                var s = document.getElementsByTagName('script')[0];
                s.parentNode.insertBefore(gcse, s);
            })();
        </script>
        <gcse:search></gcse:search>

        <!--        custom search end-->

    </div>

<?php
require "includes/footer.php";
?>