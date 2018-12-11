<?php
require "includes/classes/user.php";
$user = new user();

$result="";
$count = 0;

//works if user is searching user
if(isset($_POST['query'])){
    $search = $_POST['query'];

    //works if result is found
    if($data = $user->searchUser($search)){
        $result .= '
        
        <div class="table-responsive">
					<table class="table table-bordered">
						<tr>
                            <th>S.N.</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Gender</th>
                            <th>Date of Birth</th>
                            <th>Register Type</th>
						</tr>
        ';
        foreach ($data as $row){
            $count++;
            $result .= '
            <tr>
				<td>'.$count.'</td>
				<td>'.$row["user_name"].'</td>
				<td>'.$row["email"].'</td>
				<td>'.$row["address_line_2"].', '.$row["address_line_1"].'</td>
				<td>'.$row["gender"].'</td>
				<td>'.$row["date_of_birth"].'</td>
				<td>'.$row["register_type"].'</td>
			</tr>
        ';
        }
        echo $result;
    }

    //works if there is no result
    else{
        echo '<div class="alert alert-danger" role="alert">';
        echo 'No Result';
        echo '</div>';
    }

}

//works if user is not searching anything
else{
    if($data = $user->selectAllUser()){
        $result .= '
        <div class="table-responsive">
					<table class="table table-bordered">
						<tr>
                            <th>S.N.</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Gender</th>
                            <th>Date of Birth</th>
                            <th>Register Type</th>
						</tr>
        ';
        foreach ($data as $row){
            $count++;
            $result .= '
            <tr>
				<td>'.$count.'</td>
				<td>'.$row["user_name"].'</td>
				<td>'.$row["email"].'</td>
				<td>'.$row["address_line_2"].', '.$row["address_line_1"].'</td>
				<td>'.$row["gender"].'</td>
				<td>'.$row["date_of_birth"].'</td>			    
				<td>'.$row["register_type"].'</td>
			</tr>
        ';
        }
        echo $result;
    }else{
        echo '<div class="alert alert-danger" role="alert">';
        echo 'No Result';
        echo '</div>';
    }
}