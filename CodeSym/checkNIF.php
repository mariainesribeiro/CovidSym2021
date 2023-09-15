<?php
	$connect = mysqli_connect ('localhost', 'root', '', 'COVIDSYM') or die ('Error connecting to the server: '. mysqli_error($connect));
	$sql_utente = 'SELECT NIF FROM UTENTES WHERE NIF = '.$_GET['newNIF'];
	$result_utente = mysqli_query ($connect, $sql_utente) or die ('The query failed: ' .mysqli_error($connect));
	$n_nif= mysqli_num_rows($result_utente);
	if($n_nif !=0){ echo "!";}
	else{echo "";}
?>