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
    <script>
        function showRSS(str) {
            if (str.length==0) {
                document.getElementById("rssOutput").innerHTML="";
                return;
            }
            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp=new XMLHttpRequest();
            } else {  // code for IE6, IE5
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function() {
                if (this.readyState==4 && this.status==200) {
                    document.getElementById("rssOutput").innerHTML=this.responseText;
                }
            }
            xmlhttp.open("GET","getrss.php?q="+str,true);
            xmlhttp.send();
        }
    </script>

    <div class="well">
        <h1>RSS News Feed</h1>
        <div class="row">
            <form>
                <div class="form-group col-sm-3">
                    <select class="form-control" onchange="showRSS(this.value)">
                        <option value="">Select an RSS-feed:</option>
                        <option value="Google">Google News</option>
                        <option value="ZDN">ZDNet News</option>
                    </select>
                </div>
            </form>
        </div>

        <div id="rssOutput">RSS-feed will be listed here...</div>

    </div>


<?php
require "includes/footer.php";
?>