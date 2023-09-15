<?php
				$connect = mysqli_connect('localhost', 'root','','COVIDSYM') or die('Error connecting to the server: '.mysqli_error($connect));	 
				    
   				$sql_distritos = 'SELECT * FROM DISTRITOS ORDER BY NOME ASC';
    			$result_distritos = mysqli_query ($connect, $sql_distritos) or die ('The query failed: ' .mysqli_error($connect));
    			

    			
    			$select_invest = 'SELECT * FROM UTILIZADORES WHERE ID='.$_GET['id'];
    			$result_invest = mysqli_query ($connect, $select_invest) or die ('The query failed: ' .mysqli_error($connect));
				$invest = mysqli_fetch_array($result_invest);
				
    
?>
<style>
/* Button used to open the contact form - fixed at the bottom of the page */
.open-button {
  background-color: #555;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  opacity: 0.8;
  width: 280px;
}

/* The popup form - hidden by default */
.form-popup {
  display: none;
  bottom: 0;
  border: 3px solid #f1f1f1;
  z-index: 9;
}

/* Add styles to the form container */
.form-container {
  max-width: 300px;
  padding: 10px;
  background-color: white;
}

/* Full-width input fields */
.form-container input[type=text], .form-container input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
}

/* When the inputs get focus, do something */
.form-container input[type=text]:focus, .form-container input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit/login button */
.form-container .btn {
  background-color: #4CAF50;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: red;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}
</style>

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

function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
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
	
</script>	
	
<div class="w3-card-4 w3-container w3-display-topmiddle w3-theme-l5" style="width:70%; height:100%; overflow:scroll;">
	
	<div class="w3-container">
		<br>
		<h3 style="color:#003E63"><strong>Alterar Registo do Investigador</strong></h3>
		<br>				

	</div>
				
<script>
function myHide(id) {
  var x = document.getElementById(id);
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else { 
    x.className = x.className.replace(" w3-show", "");
  }
}
</script>
	
    		
    		<button class="w3-hover-theme w3-button w3-block  w3-theme-d3" onclick="myHide('pass')"><h4><strong>Dados de Sessao</strong></h4></button>
			<form name ="pass" method="POST" action="index.php?op=cPass<?php echo "&id=".$_GET['id'];?>" onsubmit="return ValidaterRegisto()" class="w3-container"  enctype="multipart/form-data" >

			<div class="w3-hide w3-container" id="pass" >
			<br>
			
			<br>
			<input type=hidden id ="old_username" name ="old_username" value="<?php echo $invest['USERNAME']; ?>">
			<label class="w3-text-theme"><strong>Username: </strong></label><input class=" w3-input w3-border-0"  onblur="checkNewUsername(this.value)" type="text" name="newUser" value="<?php echo $invest['USERNAME'];?>" required>
    		
    		<br>

  				
				<div class="w3-row-padding">
 		    			<div class="w3-half">
 		    					<input type=hidden id ="old_pass" name="old_pass" value="<?php echo $invest['PASSWORD']; ?>">
 		    					<label class="w3-text-theme"><strong>Nova Password: </strong></label> <input class ="w3-input w3-border-0" type="password" name="newPass"  >
 		    					</div>
 		    					<div class="w3-half">
 		    					<label class="w3-text-theme"><strong>Confirme a password: </strong></label> <input class ="w3-input w3-border-0"  type="password"   name="newPass2" >
 		    			</div>
 		    	</div>
 		    	<br>
  			<input class="w3-btn w3-hover-theme w3-theme-d3" style="float:right"type="submit" name="submit" id="submit" value="Registar Altera&ccedil;&atilde;o"> 	
			</div>
			</form>
			
			<button class="w3-hover-theme w3-button w3-block  w3-theme-d3" onclick="myHide('sessao')"><h4><strong>Dados Pessoais</strong></h4></button>
			<div class="w3-hide w3-container" id="sessao" >
			
			<form name ="registo" method="POST" action="index.php?op=cAlterarStaff<?php echo "&id=".$_GET['id'];?>" onsubmit="return ValidaterRegisto()" class="w3-container"  enctype="multipart/form-data" >
    		<br>
 		    <h4 style="color:#003E63"><strong>Dados Pessoais</strong></h4>
 		    <br>
 		    <input type=hidden id ="old_nome" name="old_nome" value="<?php echo $invest['NOME']; ?>">

    		<label class="w3-text-theme"><strong>Nome completo: </strong></label> <input class=" w3-input w3-border-0" type="text" name="newName" value="<?php echo $invest['NOME'];?>" required>
		    <br>
		   	<div class="w3-row-padding">
 		    	<div class="w3-half">
 		    	<input type=hidden id ="old_email" name="old_email" value="<?php echo $invest['EMAIL']; ?>">

 		    	<label class="w3-text-theme"><strong>Email: </strong></label> <input class ="w3-input w3-border-0"  type="email" name="newEmail" value="<?php echo $invest['EMAIL'];?>"required >
 		    	</div>
 		    	<div class="w3-half">
 		    	<label class="w3-text-theme"><strong>Telem&oacute;vel: </strong></label> <input class ="w3-input w3-border-0" type="text" name="newTel" value="<?php echo $invest['TELEMOVEL'];?>" required>
 		    	</div>
 		    </div>
			<br>

			<label class="w3-text-theme"><strong>Morada: </strong></label> <input class=" w3-input w3-border-0" type="text" name="newAddress" value="<?php echo $invest['MORADA'];?>" required>
		    <input type=hidden id ="old_morada" name="old_morada" value="<?php echo $invest['MORADA']; ?>">

		    <br>
		    <div class="w3-row-padding">
 		    	<div class="w3-half">
 		    		<label class="w3-text-theme"><strong>Distrito</strong></label>
 		    	      <select name="newDist" id ="newDist" class="w3-select"  onchange="localidadesSelecao(this.value)" selected ="<?php echo $invest['DISTRITO'];?>" required>
                         	<?php
                                        while($rows = mysqli_fetch_array($result_distritos)):
                                            ?>
                						<option value="<?php echo $rows['ID']; ?>"> <?php echo $rows['NOME']; ?></option>
                						<?php endwhile; ?>
           			  </select>
 		    	</div>
 		    	<div class="w3-half">
 		    			<label class="w3-text-theme"><strong>Localidade</strong></label>
  		    	      <select id ="localidade" name="newLocal" class="w3-select"  selected ="<?php echo $invest['LOCALIDADE'];?>" required>
								<?php
								$sql_localidades = 'SELECT * FROM LOCALIDADES WHERE DISTRITO = '.$invest['DISTRITO'].' ORDER BY NOME ASC';
    							$result_localidades = mysqli_query ($connect, $sql_localidades) or die ('The query failed: ' .mysqli_error($connect));
								while($rows = mysqli_fetch_array($result_localidades)):
                                            ?>
                						<option value="<?php echo $rows['ID']; ?>"> <?php echo $rows['NOME']; ?></option>
                						<?php endwhile; ?>


       			  </select>
 		    	</div>
 		    </div>
 		    <br>


    		<input class="w3-btn w3-hover-theme w3-theme-d3" style="float:right"type="submit" name="submit" id="submit" value="Registar Altera&ccedil;&atilde;o"> 

			</div>
</form>
</div>
