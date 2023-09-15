<?php
				$connect = mysqli_connect('localhost', 'root','','COVIDSYM') or die('Error connecting to the server: '.mysqli_error($connect));	 
				if(	$_GET['estado'] ==0){			
				$update_ESTADO = 'UPDATE UTILIZADORES SET 
				ESTADO = 1 WHERE ID = '.$_GET['id'];
				$result = mysqli_query($connect,$update_ESTADO) or die('The query failed: ' . mysqli_error($connect));
				echo "red";
				}
				else{
				$update_ESTADO = 'UPDATE UTILIZADORES SET 
				ESTADO = 0 WHERE ID = '.$_GET['id'];
				$result = mysqli_query($connect,$update_ESTADO) or die('The query failed: ' . mysqli_error($connect));
				echo "green";
				}
				?>


