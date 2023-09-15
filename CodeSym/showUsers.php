<?php
    if(isset($_GET['pageNumber'])){
        $page = $_GET['pageNumber'];
    }
    else{
        $page = 1;
    }
    if(isset($_GET['pageSize'])){
        $size = $_GET['pageSize'];
    }
    else{
        $size = 1; #without pagination 
    }
    
    #Query 1: extracts the entries to present in the present page
    $connect = mysqli_connect('localhost', 'root','', 'SIM') or die('Error connecting to the server: '.mysqli_error($connect));
    $sql = 'Select ID, USERNAME, CREAT_DATE FROM USERS ORDER BY ID ASC LIMIT '.$size.' OFFSET '.($page-1 )*$size;
    $result = mysqli_query( $connect, $sql) or die( 'The query has failed: ' . mysqli_error($connect));
    
    #Query 2: to count the total number of entries
    $sql2 = 'Select ID, USERNAME, CREAT_DATE FROM USERS';
    $result2 = mysqli_query( $connect, $sql2) or die( 'The query has failed: ' . mysqli_error($connect));
    $numEntries = mysqli_num_rows($result2);
    
    $numPages = ceil($numEntries/$size);
                 
?>

<html>
	<head>
		<title>Utilizadores</title>
	</head>
    <body>
        <center>
           <table border="1"; width="80%"  >
             

    	     <tr style="background-color:lime">
    			<th>Id</th>
    			<th>Nome</th>
    			<th>Data</th>
    		 </tr>
    		  	
    		 
    		 	<?php
    		 	    //fills in the rows with the entries from query 1
    		 		while($row=mysqli_fetch_array($result)){	 		    
    		 		    echo '<tr>';
    					echo '<td style = "text-align:center">'. $row["ID"].'</td>';
    					echo '<td>'.$row['USERNAME'].'</td>';
    					echo '<td>'.$row['CREAT_DATE'].'</td>';
    					echo '</tr>';
					}
				
					//display the link of the pages in URL  
                    for($page = 1; $page<= $numPages; $page++) {  
                         echo '<a href = "index.php?op=users&pageNumber=' . $page . '&pageSize=' . $size . '">'.$page.'</a>'; 
                         echo '  ';  
    				}  
    		 	?>
    		 	

		</table>
    		 
    	   
        </center>
    </body>
</html>