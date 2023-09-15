<?php
$connect = mysqli_connect ('localhost', 'root', '', 'COVIDSYM') or die ('Error connecting to the server: '. mysqli_error($connect));
$sql_username = "SELECT USERNAME FROM UTILIZADORES WHERE USERNAME = '".$_GET['newUser']."'";
$result_username = mysqli_query ($connect, $sql_username)
    or die ('The query failed: ' .mysqli_error($connect));
	$n_username= mysqli_num_rows($result_username);
	if($n_username !=0){ echo "!";}
	else{echo "";}
?>