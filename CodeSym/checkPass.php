<?php
   $connect = mysqli_connect('localhost', 'root','','COVIDSYM') or die('Error connecting to the server: '.mysqli_error($connect));
					
					$username = $_POST['newUser'];
					$pass = md5($_POST['newPass']);
					
 
	$update_PASS = 'UPDATE UTILIZADORES as U SET U.PASSWORD= REPLACE(U.PASSWORD,"'.$_POST['old_pass'].'","'. $pass.'") WHERE ID = '.$_GET['id'];
	$result_PASS = mysqli_query($connect,$update_PASS) or die('The query failed: ' . mysqli_error($connect));
	
	$update_USERNAME = 'UPDATE UTILIZADORES as U SET U.USERNAME= REPLACE(U.USERNAME,"'.$_POST['old_username'].'","'. $username.'") WHERE ID = '.$_GET['id'];
	$result_USERNAME = mysqli_query($connect,$update_USERNAME) or die('The query failed: ' . mysqli_error($connect));

	
	echo "<div class='w3-display-topmiddle w3-container w3-panel w3-green'> <h3>A altera&ccedil;&atilde;o foi registada com sucesso!</h3></div>";


	
	
	?>
