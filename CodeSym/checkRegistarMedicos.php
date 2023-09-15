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
					$tipo = 2;
					$estado = 1;
 					$insertUtilizador = 'INSERT INTO UTILIZADORES(NOME,USERNAME,PASSWORD,MORADA, EMAIL, TELEMOVEL, LOCALIDADE, DISTRITO, TIPO, ESTADO) VALUES("'.$nome.'" , "'.$user.'" , "'.$pass.'","'.$morada.'", "'.$email.'","'.$telemovel.'","'.$localidade.'","'.$dist.'","'.$tipo.'","'.$estado.'")';
					$result_insertUtilizador = mysqli_query($connect, $insertUtilizador) or die(mysqli_error($connect));						
					$id_medico = mysqli_insert_id($connect);

					$titulo = $_POST['newTit'];
					$insertTitulo = 'INSERT INTO MEDICOS(ID, TITULO) VALUES("'.$id_medico.'","'.$titulo.'")';
					$result_insertTitulo = mysqli_query($connect, $insertTitulo) or die(mysqli_error($connect));
					
					$_SESSION['registo'] = 1; //sucesso
					
				}
				else{
				
					$_SESSION['registo'] = 0; //insucesso

				}


?>


 <?php
         	if(isset($_SESSION['registo'])){
             if($_SESSION['registo'] == 1){
             	if($titulo = 0){
                  echo '<div class="w3-display-topmiddle w3-container w3-panel w3-green"> <h3>O registo do Dr. '.$nome.' foi efetuado com sucesso!</h3><br>';
                }
                else{
                	echo '<div class="w3-display-topmiddle w3-container w3-panel w3-green"> <h3>O registo da Dr&ordf; '.$nome.' foi efetuado com sucesso!</h3><br>';
                }

                  
             }
             else{
                  echo "<div class = 'w3-display-topmiddle w3-container w3-panel w3-red'> <h3>Registo sem sucesso! O username j&aacute; existe</h3><br>";
                  echo "<a href='index.php?op=sSignInUtentes'><center><button class='w3-button w3-small w3-round w3-theme-l5' style='color:#003E63'><strong><span style ='color:red'>Tentar de novo</span></strong></button><center></a><br></div>";
             }
             }
         ?>
         
