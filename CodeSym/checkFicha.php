<?php
  				$connect = mysqli_connect('localhost', 'root','','COVIDSYM') or die('Error connecting to the server: '.mysqli_error($connect));
 					$insertUtilizador = 'INSERT INTO FICHAS_CLINICAS(ID_UTENTE, ID_MEDICO) VALUES("'.$_SESSION['id_utente'].'" , "'.$_POST['Medico'].'")';
					$result_insertUtilizador = mysqli_query($connect, $insertUtilizador) or die($_SESSION["id_utente"].mysqli_error($connect));	
					$_SESSION['fichaAberta']=1;					
?>


 <?php
         	if(isset($_SESSION['fichaAberta'])){
             if($_SESSION['fichaAberta'] == 1){
             	echo '<div class="w3-display-topmiddle w3-container w3-panel w3-green"> <h3>A sua consulta foi registada. Por favor, aguarde pelo nosso contacto </h3><br></div>';                  
             }
             else{
                  echo "<div class = 'w3-display-topmiddle w3-container w3-panel w3-red'> <h3>A sua consulta N&Atilde;O foi registada. Tente de novo, por favor.</h3><br>";
                  echo "<a href='index.php?op=sMedico'><center><button class='w3-button w3-small w3-round w3-theme-l5' style='color:#003E63'><strong><span style ='color:red'>Tentar de novo</span></strong></button><center></a><br></div>";
             }
             }
             
 ?>
