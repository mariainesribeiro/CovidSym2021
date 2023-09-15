<?php
				$connect = mysqli_connect('localhost', 'root','','COVIDSYM') or die('Error connecting to the server: '.mysqli_error($connect));	 
				    
   				$sql_distritos = 'SELECT * FROM DISTRITOS ORDER BY NOME ASC';
    			$result_distritos = mysqli_query ($connect, $sql_distritos) or die ('The query failed: ' .mysqli_error($connect));
    
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
    
    //Validação do NIF
    function checkNIF(nif) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) { 
                if (this.responseText != "") {
                	alert("O NIF ja existe".concat(this.responseText));
                    document.getElementById("submit").disabled = true;
                    return false;
                }
                else {
                    document.getElementById("submit").disabled = false;
                    return true;
                }
            }
    };
    xmlhttp.open("GET", "checkNIF.php?newNIF=" + nif, true);
    xmlhttp.send();
            if(nif.length != 9){
    		alert("NIF invalido.");
    		document.getElementById("submit").disabled = false;
    		return false;
    		}

    }
    
    //Validação do Nr Utente
    function checkNUS(nus) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) { 
                if (this.responseText != "") {
                	alert("O Nr Utente ja existe".concat(this.responseText));
                    document.getElementById("submit").disabled = true;
                    return false;
                }
                else {
                    document.getElementById("submit").disabled = false;
                    return true;
                }
            }
    };
    xmlhttp.open("GET", "checkNUS.php?newNUS=" + nus, true);
    xmlhttp.send();
      		if(nus.length != 9){
    		alert("Nr utente invalido.");
    		document.getElementById("submit").disabled = false;
    		return false;
    		}
    }
    
    //Validação do Username
    function checkUsername(username) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
    	if(username==""){
    		return true;
    		}
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

    
    
	function ValidateRegisto(){
		var name = document.forms["registo"]["newName"].value;
		var user = document.forms["registo"]["newUser"].value;
		var pass = document.forms["registo"]["newPass"].value;
		var pass2 = document.forms["registo"]["newPass2"].value;
		var nif = document.forms["registo"]["newNIF"].value;
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
		<h3 style="color:#003E63"><strong>Registo do Utente</strong></h3>
	</div>
				

	<form name ="registo" method="POST" action="index.php?op=cRegistarUtentes" onsubmit="return ValidaterRegisto()" class="w3-container"  enctype="multipart/form-data" >
			<br>
			<h4 style="color:#003E63"><strong>Dados de Sess&atilde;o</strong></h4>
			<br>
    		<label class="w3-text-theme"><strong>Username: </strong></label><input class=" w3-input w3-border-0"  onblur="checkUsername(this.value)" type="text" name="newUser" required>
    		<br>
    		<div class="w3-row-padding">
 		    	<div class="w3-half">
 		    	<label class="w3-text-theme"><strong>Password: </strong></label> <input class ="w3-input w3-border-0" type="password" name="newPass" required>
 		    	</div>
 		    	<div class="w3-half">
 		    	<label class="w3-text-theme"><strong>Confirme a password: </strong></label> <input class ="w3-input w3-border-0"  type="password" name="newPass2" required>
 		    	</div>
 		    </div>
 		    <br>
 		    <h4 style="color:#003E63"><strong>Dados Pessoais</strong></h4>
 		    <br>
    		<label class="w3-text-theme"><strong>Nome completo: </strong></label> <input class=" w3-input w3-border-0" type="text" name="newName" required>
		    <br>
		   	<div class="w3-row-padding">
 		    	<div class="w3-half">
 		    	<label class="w3-text-theme"><strong>Email: </strong></label> <input class ="w3-input w3-border-0"  type="email" name="newEmail" required >
 		    	</div>
 		    	<div class="w3-half">
 		    	<label class="w3-text-theme"><strong>Telem&oacute;vel: </strong></label> <input class ="w3-input w3-border-0" type="text" name="newTel" required>
 		    	</div>
 		    </div>
			<br>

			<label class="w3-text-theme"><strong>Morada: </strong></label> <input class=" w3-input w3-border-0" type="text" name="newAddress" required>
		    <br>
		    <div class="w3-row-padding">
 		    	<div class="w3-half">
 		    		<label class="w3-text-theme"><strong>Distrito</strong></label>
 		    	      <select name="newDist" id ="newDist" class="w3-select"   onchange ="localidadesSelecao(this.value)" required>
                         	<?php
                                        while($rows = mysqli_fetch_array($result_distritos)):
                                            ?>
                						<option value="<?php echo $rows['ID']; ?>"> <?php echo $rows['NOME']; ?></option>
                						<?php endwhile; ?>
           			  </select>
 		    	</div>
 		    	<div class="w3-half">
 		    			<label class="w3-text-theme"><strong>Localidade</strong></label>
  		    	      <select id ="localidade" name="newLocal" class="w3-select"  required>
								<?php
								$sql_local = 'SELECT * FROM LOCALIDADES ORDER BY NOME ASC';
    							$result_local = mysqli_query ($connect, $sql_local) or die ('The query failed: ' .mysqli_error($connect));
								while($rows = mysqli_fetch_array($result_local)):
                                            ?>
                						<option value="<?php echo $rows['ID']; ?>"> <?php echo $rows['NOME']; ?></option>
                						<?php endwhile; ?>


       			  </select>
 		    	</div>
 		    </div>
 		    <br>
 		    <div class="w3-row-padding">
 		    	<div class="w3-half">
 		    	<label class="w3-text-theme" id="NIF"><strong>NIF: </strong></label> <input class ="w3-input w3-border-0" type="text" onblur ="checkNIF(this.value)" name="newNIF" required >
 		    	</div>
 		    	<div class="w3-half">
 		    	<label class="w3-text-theme"><strong>Nr. Utente: </strong></label> <input class ="w3-input w3-border-0" type="text" onblur ="checkNUS(this.value)" name="newNUS" required>
 		    	</div>
 		    </div>
 		    <br>
    		<label class="w3-text-theme"><strong>Sexo: </strong></label>     		
    		<input class="w3-radio" type="radio" name="newSexo" value="0" checked > <label>Male</label>
			<input class="w3-radio" type="radio" name="newSexo" value="1"> <label>Female</label>
			<br><br>
			<label class="w3-text-theme"><strong>Data de Nascimento: </strong></label> <input class=" w3-input w3-border-0" type="date" name="newBirth" required>
 		    <br>
			<label class="w3-text-theme"><strong>Alergias: </strong></label> 
				<select class ="w3-select" name="newAlergias[ ]" multiple="multiple" required>
					                     	<?php
                                        while($rows = mysqli_fetch_array($result_alergias)):
                                            ?>
                						<option value="<?php echo $rows['ID']; ?>"> <?php echo $rows['NOME']; ?></option>
                						<?php endwhile; ?>

				</select>
 		    <br><br>
			<label class="w3-text-theme"><strong>Fotografia: </strong></label> <input class=" w3-input w3-border-0" type="file" name="newFoto" required>
 		    <br>

    		<input class="w3-btn w3-hover-theme w3-theme-d3" type="submit" name="submit" id="submit" value="Registar">


</form>
</div>
