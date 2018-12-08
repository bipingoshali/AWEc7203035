<?php
class alert{

    //alert success message
    public function alert_success($message){
        echo '<div class="alert alert-success">'.$message.'</div>';
    }

    //alert danger message
    public function alert_danger($message){
        echo '<div class="alert alert-danger">'.$message.'</div>';
    }

}