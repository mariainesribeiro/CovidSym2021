<?php
    $connect = mysqli_connect('localhost', 'root','','COVIDSYM') or die('Error connecting to the server: '.mysqli_error($connect));
    //Sintomas
    $diagnostico = $_POST['newDiag'];
	$observacoes = $_POST['newObs'];
	$risco = 0;	
	
	$sql_insert = 'UPDATE FICHAS_CLINICAS SET 
				DIAGNOSTICO ='.$diagnostico.
				',RISCO='.$risco.
				',DATA_DIAGNOSTICO= CURRENT_TIMESTAMP()
				 WHERE ID ='.$_GET['ficha'];
	$result_insert = mysqli_query($connect,$sql_insert) or die('The query failed: ' . mysqli_error($connect));
	
	$update_OBS = 'UPDATE FICHAS_CLINICAS as U SET U.OBSERVACOES= REPLACE(U.OBSERVACOES,"","'. $observacoes.'") WHERE ID = '.$_GET['ficha'];
	$result_OBS = mysqli_query($connect,$update_OBS) or die('The query failed: ' . mysqli_error($connect));

	echo "<div class='w3-display-topmiddle w3-container w3-panel w3-green'> <h3>A consulta foi registada com sucesso!</h3><br>";
?>
