     <?php
   $connect = mysqli_connect('localhost', 'root','','COVIDSYM') or die('Error connecting to the server: '.mysqli_error($connect));
				// verificar se utilizador ja esta na base de dados 
				$verificaUser = 'SELECT * FROM UTILIZADORES WHERE (username = "'.$_POST['newUser'].'")';
				$result = mysqli_query($connect,$verificaUser) or die('The query failed: ' . mysqli_error($connect));
				$n = mysqli_num_rows($result);
				if($n == 0){
					
					$nome = $_POST['newName'];
					$user = $_POST['newUser'];
					$pass = md5($_POST['newPass']);
					$morada = $_POST['newAddress'];
					$email = $_POST['newEmail'];
					$telemovel = $_POST['newTel'];
					$localidade = $_POST['newLocal'];
					$dist = $_POST['newDist'];
					$tipo = 1;
					$estado = 1;
 					$insertUtilizador = 'INSERT INTO UTILIZADORES(NOME,USERNAME,PASSWORD,MORADA, EMAIL, TELEMOVEL, LOCALIDADE, DISTRITO, TIPO, ESTADO) VALUES("'.$nome.'" , "'.$user.'" , "'.$pass.'","'.$morada.'", "'.$email.'","'.$telemovel.'","'.$localidade.'","'.$dist.'","'.$tipo.'","'.$estado.'")';
					$result_insertUtilizador = mysqli_query($connect, $insertUtilizador) or die(mysqli_error($connect));	
					$sexo = $_POST['newSexo'];
					$nif = $_POST['newNIF'];
					$nus = $_POST['newNUS'];
					$dataNasc = $_POST['newBirth'];
					$id_user = mysqli_insert_id($connect);
					$insertUtente = 'INSERT INTO UTENTES(ID_UTILIZADOR, SEXO, NIF, NR_UTENTE, DATA_NASCIMENTO) VALUES("'.$id_user.'","'.$sexo.'","'.$nif.'","'.$nus.'","'.$dataNasc.'")';
					$result_InsertUtente = mysqli_query($connect, $insertUtente) or die(mysqli_error($connect));
					$id_utente = mysqli_insert_id($connect);
					
					//Inserir foto no registo do utente
					//$imagename=$_FILES["newFoto"]["name"]; 
					$imagename=$id_utente;
					//Get the content of the image and then add slashes to it 
					$imagetmp=addslashes (file_get_contents($_FILES['newFoto']['tmp_name']));
					//Insert the image name and image content in image_table
					$insert_image="INSERT INTO FOTOGRAFIAS(TMP, NAME) VALUES('$imagetmp','$imagename')";
					$result_InsertFoto = mysqli_query($connect, $insert_image) or die(mysqli_error($connect));
					$id_foto = mysqli_insert_id($connect);
					//Inserir FK da fotografia no utente
					$insert_fotofk = 'UPDATE UTENTES SET FOTO='.$id_foto.' WHERE ID = '.$id_utente;	
					$result_Insertfotofk = mysqli_query($connect, $insert_fotofk) or die(mysqli_error($connect));
					
									
					//Inserir as alergias na tabela alergias_utentes
					$alergias = $_POST['newAlergias'];
        			foreach($alergias as $a) {
        			$insertAlergia = "INSERT INTO ALERGIAS_UTENTES (ALERGIA, UTENTE) VALUES ('".$a."', '".$id_utente."')";
        			mysqli_query($connect, $insertAlergia) or die ('The query failed: ' .mysqli_error($connect));
        			}
					
					$_SESSION['registo'] = 1; //sucesso
					
				}
				else{
				
					$_SESSION['registo'] = 0; //insucesso

				}


?>


 <?php
         	if(isset($_SESSION['registo'])){
             if($_SESSION['registo'] == 1){

                  echo "<div class='w3-display-topmiddle w3-container w3-panel w3-green'> <h3>O registo foi efetuado com sucesso!</h3><br>";
                  //echo "<a href='index.php?op=sLogin'><center><button class='w3-button w3-small w3-round w3-theme-l5' style='color:#003E63'><strong><span style ='color:green'>Login</span></strong></button><center></a><br></div>";
 				

             }
             else{
                  echo "<div class = 'w3-display-topmiddle w3-container w3-panel w3-red'> <h3>Registo sem sucesso! O username j&aacute; existe</h3><br>";
                  echo "<a href='index.php?op=sSignInUtentes'><center><button class='w3-button w3-small w3-round w3-theme-l5' style='color:#003E63'><strong><span style ='color:red'>Tentar de novo</span></strong></button><center></a><br></div>";
             }
             }
         ?>
         

