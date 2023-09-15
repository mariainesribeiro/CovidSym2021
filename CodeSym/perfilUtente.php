<?php
				$connect = mysqli_connect('localhost', 'root','','COVIDSYM') or die('Error connecting to the server: '.mysqli_error($connect));	 
				    
   				$sql_distritos = 'SELECT * FROM DISTRITOS ORDER BY NOME ASC';
    			$result_distritos = mysqli_query ($connect, $sql_distritos) or die ('The query failed: ' .mysqli_error($connect));
    			

    			
    			$select_user = 'SELECT * FROM UTILIZADORES WHERE ID='.$_SESSION['ID'];
    			$result_user = mysqli_query ($connect, $select_user) or die ('The query failed: ' .mysqli_error($connect));
				$user = mysqli_fetch_array($result_user);
				
				$select_utente = 'SELECT * FROM utentes WHERE (ID = '.$_SESSION['id_utente'].')';
				$result_utente = mysqli_query($connect,$select_utente) or die('The query failed: ' . mysqli_error($connect));
				$utente = mysqli_fetch_array($result_utente);

				$sql_alergias = 'SELECT * FROM ALERGIAS ORDER BY NOME ASC';
    			$result_alergias = mysqli_query ($connect, $sql_alergias) or die ('The query failed: ' .mysqli_error($connect)); 
    			                                        	
                                        	                                            

?>
<SCRIPT type="text/javascript">

    function localidadesSelecao(distrito) {
    	var xmlhttp = new XMLHttpRequest();
    	xmlhttp.onreadystatechange = function() {
      		if (this.readyState == 4 && this.status == 200) {
        		document.getElementById("localidade").innerHTML = this.responseText;
      		}
    	};
    	xmlhttp.open("GET", "localidadesSelecao.php?newDist=" + distrito, true);
    	xmlhttp.send();
    }
    
     
    //ValidaÃƒÆ’Ã‚Â§ÃƒÆ’Ã‚Â£o do Username
    
    function checkNewUsername(username) {
    var xmlhttp = new XMLHttpRequest();
    var old =document.getElementById("old_username").value;
    if(username==old){
    document.getElementById("submit").disabled = false
    return true
    }
    else{
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) { 
                if (this.responseText != "") {
                	alert("O Username ja existe".concat(this.responseText));
                    document.getElementById("submit").disabled = true;
                    return false;
                }
                else {
                    document.getElementById("submit").disabled = false;
                    return true;
                }
            }
    };
    xmlhttp.open("GET", "checkUsername.php?newUser=" + username, true);
    xmlhttp.send();
    }
    }

    
    
	function ValidateRegisto(){
		var name = document.forms["registo"]["newName"].value;
		var user = document.forms["registo"]["newUser"].value;
		var pass = document.forms["registo"]["newPass"].value;
		var pass2 = document.forms["registo"]["newPass2"].value;
  		if (pass != pass2){
  			alert("As passwords nao correspondem. Por favor, volte a inserir.")
  			return false;
  			}
    	else{
    		return true;
    	}
	}
	
	
	
</SCRIPT>

<div class="w3-card-4 w3-container w3-display-topmiddle w3-theme-l5" style="width:70%; height:100%; overflow:scroll;">
	
	<div class="w3-container">
		<h3 style="color:#003E63"><strong>Perfil</strong></h3>
						

	</div>
				
	<?php
				$getname = $_SESSION['id_utente']; 
				$select_image="select * from fotografias where NAME ='$getname'";
				$var=mysqli_query($connect, $select_image);
				if($row=mysqli_fetch_array($var)){
					//header("content-type:image/png");
 					$image_name=$row["NAME"];
 					$image_content=$row["TMP"];
					}
				?>
				<div class="w3-container">
				<img src='data:image/jpg;charset=utf8;base64,<?php echo base64_encode($image_content);?>' style="width:230; height:200;" class="w3-border w3-padding" alt="Fotografia do Utente">
				</div>
	<form name ="registo" method="POST" action="index.php?op=cAlterarUtente<?php echo "&id=".$_SESSION['ID']."&id_utente=".$_SESSION['id_utente'];?>" onsubmit="return ValidaterRegisto()" class="w3-container"  enctype="multipart/form-data" >
						    		
 		    <h4 style="color:#003E63"><strong>Dados Pessoais</strong></h4>
 		    <br>
 		    <input type=hidden id ="old_nome" name="old_nome" value="<?php echo $user['NOME']; ?>">

    		<label class="w3-text-theme"><strong>Nome completo: </strong></label> <input class=" w3-input w3-border-0" type="text" name="newName" value="<?php echo $user['NOME'];?>" required>
		    <br>
		   	<div class="w3-row-padding">
 		    	<div class="w3-half">
 		    	<input type=hidden id ="old_email" name="old_email" value="<?php echo $user['EMAIL']; ?>">

 		    	<label class="w3-text-theme"><strong>Email: </strong></label> <input class ="w3-input w3-border-0"  type="email" name="newEmail" value="<?php echo $user['EMAIL'];?>"required >
 		    	</div>
 		    	<div class="w3-half">
 		    	<label class="w3-text-theme"><strong>Telem&oacute;vel: </strong></label> <input class ="w3-input w3-border-0" type="text" name="newTel" value="<?php echo $user['TELEMOVEL'];?>" required>
 		    	</div>
 		    </div>
			<br>

			<label class="w3-text-theme"><strong>Morada: </strong></label> <input class=" w3-input w3-border-0" type="text" name="newAddress" value="<?php echo $user['MORADA'];?>" required>
		    <input type=hidden id ="old_morada" name="old_morada" value="<?php echo $user['MORADA']; ?>">

		    <br>
		    <div class="w3-row-padding">
 		    	<div class="w3-half">
 		    		<label class="w3-text-theme"><strong>Distrito</strong></label>
 		    	      <select name="newDist" id ="newDist" class="w3-select"  onchange="localidadesSelecao(this.value)" selected ="<?php echo $user['DISTRITO'];?>" required>
                         	<?php
                                        while($rows = mysqli_fetch_array($result_distritos)):
                                            ?>
                						<option value="<?php echo $rows['ID']; ?>"> <?php echo $rows['NOME']; ?></option>
                						<?php endwhile; ?>
           			  </select>
 		    	</div>
 		    	<div class="w3-half">
 		    			<label class="w3-text-theme"><strong>Localidade</strong></label>
  		    	      <select id ="localidade" name="newLocal" class="w3-select"  selected ="<?php echo $user['LOCALIDADE'];?>" required>
								<?php
								$sql_localidades = 'SELECT * FROM LOCALIDADES WHERE DISTRITO = '.$user['DISTRITO'].' ORDER BY NOME ASC';
    							$result_localidades = mysqli_query ($connect, $sql_localidades) or die ('The query failed: ' .mysqli_error($connect));
								while($rows = mysqli_fetch_array($result_localidades)):
                                            ?>
                						<option value="<?php echo $rows['ID']; ?>"> <?php echo $rows['NOME']; ?></option>
                						<?php endwhile; ?>


       			  </select>
 		    	</div>
 		    </div>
 		    <br>

			<div class="w3-row-padding">
 		    	<div class="w3-half">
 		    	<label class="w3-text-theme" id="NIF"><strong>NIF: </strong></label> <input class ="w3-input w3-border-0" type="text" name ="newNIF"value="<?php echo $utente['NIF'];?>" required >
 		    	</div>
 		    	<div class="w3-half">
 		    	<label class="w3-text-theme"><strong>Nr. Utente: </strong></label> <input class ="w3-input w3-border-0" type="text" name ="newNUS"value="<?php echo $utente['NR_UTENTE'];?>" required >
 		    	</div>
 		    </div>
 		    <br>
    		<label class="w3-text-theme"><strong>Sexo: </strong></label> 
    		<?php if($utente['SEXO']==0){
    			echo '<input class="w3-radio" type="radio" name="newSexo" value="0" checked> <label>Male</label>
			<input class="w3-radio" type="radio" name="newSexo" value="1" > <label>Female</label>';
			} 
			else{
				echo '<input class="w3-radio" type="radio" name="newSexo" value="0" > <label>Male</label>
			<input class="w3-radio" type="radio" name="newSexo" value="1" checked> <label>Female</label>';
		
			}
			?>
			<br><br>
			<label class="w3-text-theme"><strong>Data de Nascimento: </strong></label> <input class=" w3-input w3-border-0" type="date" name ="newBirth"value ="<?php echo $utente['DATA_NASCIMENTO'];?>" required>
 		    <br>
 		    <?php
 		   		    ?>
			<label class="w3-text-theme"><strong>Alergias: </strong></label> 
				<select class ="w3-select" name="newAlergias[ ]" multiple="multiple" >
					                     <?php
                                        while($rows = mysqli_fetch_array($result_alergias)):
                                            ?>
                						<option value="<?php echo $rows['ID']; ?>"> <?php echo $rows['NOME']; ?></option>
                						<?php endwhile; ?>

				</select>
 		    <br><br>
			   
			 

    		<input class="w3-btn w3-hover-theme w3-theme-d3" style="float:right"type="submit" name="submit" id="submit" value="Registar Altera&ccedil;&atilde;o"> 


</form>
</div>
