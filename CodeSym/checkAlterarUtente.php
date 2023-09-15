<?php
   $connect = mysqli_connect('localhost', 'root','','COVIDSYM') or die('Error connecting to the server: '.mysqli_error($connect));
					$nome = $_POST['newName'];		
					$morada = $_POST['newAddress'];
					$email = $_POST['newEmail'];
					$telemovel = $_POST['newTel'];
					$localidade = $_POST['newLocal'];
					$dist = $_POST['newDist'];
 
	$update_TEL = 'UPDATE UTILIZADORES SET 
	TELEMOVEL = '.$telemovel.' WHERE ID = '.$_GET['id'];
	$result = mysqli_query($connect,$update_TEL) or die('The query failed: ' . mysqli_error($connect));

	$update_LOCALIDADE = 'UPDATE UTILIZADORES SET 
	LOCALIDADE= '.$localidade.' WHERE ID = '.$_GET['id'];
	$result_localidade = mysqli_query($connect,$update_LOCALIDADE) or die('The query failed: ' . mysqli_error($connect));
	
	$update_DIST = 'UPDATE UTILIZADORES SET 
	DISTRITO= '.$dist.' WHERE ID = '.$_GET['id'];
	$result_DIST = mysqli_query($connect,$update_DIST) or die('The query failed: ' . mysqli_error($connect));
	
	$update_NOME = 'UPDATE UTILIZADORES as U SET U.NOME= REPLACE(U.NOME,"'.$_POST['old_nome'].'","'. $nome.'") WHERE ID = '.$_GET['id'];
	$result_NOME = mysqli_query($connect,$update_NOME) or die('The query failed: ' . mysqli_error($connect));
		
	$update_EMAIL = 'UPDATE UTILIZADORES as U SET U.EMAIL= REPLACE(U.EMAIL,"'.$_POST['old_email'].'","'. $email.'") WHERE ID = '.$_GET['id'];
	$result_EMAIL = mysqli_query($connect,$update_EMAIL) or die('The query failed: ' . mysqli_error($connect));
	
	$update_MORADA = 'UPDATE UTILIZADORES as U SET U.MORADA= REPLACE(U.MORADA,"'.$_POST['old_morada'].'","'. $morada.'") WHERE ID = '.$_GET['id'];
	$result_MORADA = mysqli_query($connect,$update_MORADA) or die('The query failed: ' . mysqli_error($connect));
	echo "<div class='w3-display-topmiddle w3-container w3-panel w3-green'> <h3>A altera&ccedil;&atilde;o foi registada com sucesso!</h3></div>";

					$sexo = $_POST['newSexo'];
					$nif = $_POST['newNIF'];
					$nus = $_POST['newNUS'];
					$dataNasc = $_POST['newBirth'];

	$update_SEXO = 'UPDATE UTENTES SET 
	SEXO = '.$sexo.' WHERE ID = '.$_GET['id_utente'];
	$result_SEXO = mysqli_query($connect,$update_SEXO) or die($sexo.'The query failed: ' . mysqli_error($connect));

	$update_NIF = 'UPDATE UTENTES SET 
	NIF = '.$nif.' WHERE ID = '.$_GET['id_utente'];
	$result_NIF = mysqli_query($connect,$update_NIF) or die('The query failed: ' . mysqli_error($connect));
	
	$update_NUS = 'UPDATE UTENTES SET 
	NR_UTENTE = '.$nus.' WHERE ID = '.$_GET['id_utente'];
	$result_NUS = mysqli_query($connect,$update_NUS) or die('The query failed: ' . mysqli_error($connect));

	$update_DATA = 'UPDATE UTENTES SET 
	DATA_NASCIMENTO = "'.$dataNasc.'" WHERE ID = '.$_GET['id_utente'];
	$result_DATA = mysqli_query($connect,$update_DATA) or die($update_DATA.'The query failed: ' . mysqli_error($connect));

	$sql_clear_alergias= 'DELETE FROM ALERGIAS_UTENTES WHERE UTENTE = '.$_GET['id_utente'];
    mysqli_query ($connect, $sql_clear_alergias) or die ('The query failed: ' .mysqli_error($connect));
    if(isset($_POST['newAlergias'])) {
        foreach($_POST['newAlergias'] as $a) {
        $insert_alergia = "INSERT INTO ALERGIAS_UTENTES (UTENTE, ALERGIA) VALUES ('".$_GET['id_utente']."', '".$a."')";
        mysqli_query ($connect, $insert_alergia) or die ('The query failed: ' .mysqli_error($connect));
        }
    }

echo "<div class='w3-display-topmiddle w3-container w3-panel w3-green'> <h3>O registo foi efetuado com sucesso!</h3><br>";

	
	?>
