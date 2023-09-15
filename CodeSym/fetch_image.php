<?php

							
				$name=$_GET['name'];
				$connect = mysqli_connect('localhost', 'root','','COVIDSYM') or die('Error connecting to the server: '.mysqli_error($connect));
				$select_image="select * from fotografias where NAME ='$name'";
				$var=mysql_query($select_image);
				if($row=mysql_fetch_array($var)){
					header("content-type:image/png");
 					$image_name=$row["NAME"];
 					$image_content=$row["TMP"];
					}
				print $image_content;
?>